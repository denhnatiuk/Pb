<?php
/**
 * Main theme class
 *
 * @package         pb
 * @since           1.0.0
 * @author          Den Hnatiuk
 * @copyright       Copyright(c ) 2021, Den Hnatiuk(@denhnatiuk)
 * @link            https://denyshnatiuk.github.io/Pb/
 *
 */

namespace Pb;

defined( 'ABSPATH' ) || die();

if ( ! class_exists( 'Pb' ) ) {
	final class Pb {

		// TODO: is there security profit to use singleton?

		// private static $instance;
		// public static function instance() {
		// 	if ( is_null( self::$instance ) ) {
		// 		self::$instance = new self;
		// 	}
		// 	return self::$instance;
		// }

		public function __construct( $theme_config ) {
			if ( ! version_compare( PHP_VERSION, '8.0', '>=' ) ) {
				$this->action_admin_notice(
					sprintf( esc_html__( wp_get_theme()->get( 'Name' ) . ' requires PHP version %s+. Theme would not work properly.', 'pb' ), '8.0' ),
					'warning'
				);
			}
			if ( ! version_compare( get_bloginfo( 'version' ), '5.7', '>=' ) ) {
				$this->action_admin_notice(
					sprintf( esc_html__( wp_get_theme()->get( 'Name' ) . ' requires WordPress version %s+. Theme would not work properly.', 'pb' ), '4.7' ),
					'warning'
				);
			}
			if ( ! function_exists( 'register_block_type' ) ) {
				$this->action_admin_notice(
					sprintf( esc_html__( wp_get_theme()->get( 'Name' ) . ' recommend to use %s for WordPress. Theme would not work properly.', 'pb' ), ' Gutenberg WYSIWYG' ),
					'warning'
				);
			}
			$this->setup_loop( $theme_config );
		}

		/**
		 * Cloning is forbidden.
		 */
		// public function __clone() {
		//   _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'text_domain_example' ), '1.0' );
		// }

		private function extend_and_override_defaults( $theme_config ) {
			// TODO: maybe use other notation. js with comments or thmth else
			$default_config = new RecursiveArrayIterator( json_decode( file_get_contents( get_template_directory() . '/inc/config/pb.config.json' ), true ) );

			if ( ! empty( $theme_config ) && is_array( $theme_config ) ) {
				$overrides = new RecursiveIteratorIterator( new RecursiveArrayIterator( $theme_config ) );

				foreach ( $overrides as $key => $value ) {
					if ( array_key_exists( $key, $default_config ) ) {
						$default_config->$key = $value;
					}
					// if ( is_array( $value ) && array_key_exists( 'special_key', $value ) ) {
					// 	// Here we replace ALL keys with the same value from 'special_key'
					// 	$replaced = array_fill( 0, count( $value ), $value['special_key'] );
					// 	$value = array_combine( array_keys( $value ), $replaced );
					// 	// Add a new key?
					// 	$value['new_key'] = 'new value';

					// 	// Get the current depth and traverse back up the tree, saving the modifications
					// 	$currentDepth = $completeIterator->getDepth();
					// 	for($subDepth = $currentDepth; $subDepth >= 0; $subDepth-- ) {
					// 		// Get the current level iterator
					// 		$subIterator = $completeIterator->getSubIterator($subDepth );
					// 		// If we are on the level we want to change, use the replacements($value ) other wise set the key to the parent iterators value
					// 		$subIterator->offsetSet($subIterator->key(),($subDepth === $currentDepth ? $value : $completeIterator->getSubIterator(($subDepth+1 ) )->getArrayCopy() ) );
					// 	}
					// }
					// if (!$defaultConfig->$key ) {
					// 	$defaultConfig[$key] = $value;
					// 	$iterator->getInnerIterator()->offsetSet($key, $value );
					// } else {

					// 	}
					// foreach($recursive as $key => $value ) {
					// 	 if ()
					// }
					// $recursive->getInnerIterator()->offsetSet($key, $value );
					
				}
			}
			return $default_config;
		}

		private function setup_loop( $theme_config ) {
			$config = $this->extend_and_override_defaults( $theme_config );

			// foreach($config as $group => $item ) {
			if ( is_array( $config ) || is_object( $config ) ) {
				foreach ( $config as $group => $item ) {
					foreach ( $item as $key => $value ) {
						switch ( $group ) {
							case 'ini_set':
								@ini_set( $key, $value );
								break;
							case 'textdomain':
								load_theme_textdomain(
									$key,
									get_template_directory_uri() . $value
								);
								break;
							case 'theme_supports':
								if ( is_bool( $value ) ) {
									if ( ! $value ) {
										$this->remove_support( $key );
									} else {
										$this->add_support( $key );
									}
								} else {
									$this->add_support( $key, $value );
								}
								break;
							case 'remove_supports':
								$this->remove_support( $value );
								break;
							case 'stylesheets':
								//	wp_enqueue_style($key,  get_template_directory() . $value['path'],  $value['dependencies'], $value['version'], 0 );
								$this->add_style( $key, $value['path'], $value['dependencies'], $value['version'], false );
								break;
							case 'scripts':
								$this->add_script( $key, $value['path'], $value['dependencies'], $value['version'], true );
								break;
							case 'site_meta':
								$this->add_site_meta( $key, $value );
								// no break
							default:
								$this->action_admin_notice(
									sprintf(
										esc_html__( wp_get_theme()->get( 'Name' ) . ' config contains unexpected preseted option for %s, so Theme may not work properly. See documentation.', wp_get_theme()->get( 'Name' ) ),
										$group
									),
									'warning'
								);
						}
					}
				}
			} else {
				$this->action_admin_notice(
					sprintf(
						esc_html__( wp_get_theme()->get( 'Name' ) . ' config contains invalid parameters, so Theme may not work properly. See documentation.', wp_get_theme()->get( 'Name' ) ),
						$config
					),
					'warning'
				);
			}
		}

		public function action_admin_notice( $message, $notice_type = null ) {
			add_action(
				'admin_notices',
				function () use ( $message, $notice_type ) {
					$this->admin_notice( $message, $notice_type );
				}
			);
		}

		private function admin_notice( $message, $notice_type = null ) {
			if ( ! empty( $notice_type ) ) {
				$class = $notice_type;
			} else {
				$class = 'info';
			}

			$html_message = sprintf( '<div class="notice is-dismissible notice-' . $class . '">%s</div>', wpautop( $message ) );

			echo wp_kses_post( $html_message );
		}

		private function action_after_setup( $function ) {
			add_action(
				'after_setup_theme',
				function () use ( $function ) {
					$function;
				}
			);
		}

		private function action_enqueue_scripts( $function ) {
			add_action(
				'wp_enqueue_scripts',
				function () use ( $function ) {
					$function();
				}
			);
		}

		private function add_support( $feature, $options = null ) {
			add_theme_support( $feature, $options );
		}

		private function remove_support( $feature ) {
			remove_theme_support( $feature );
		}

		private function add_image_size( $name, $width = 0, $height = 0, $crop = false ) {
			$this->action_after_setup(
				function () use ( $name, $width, $height, $crop ) {
					add_image_size( $name, $width, $height, $crop );
				}
			);
			return $this;
		}

		private function remove_image_size( $name ) {
			$this->action_after_setup(
				function () use ( $name ) {
					remove_image_size( $name );
				}
			);
			return $this;
		}

		public function add_style( $handle, $src = '', $deps = array(), $ver = false, $media = 'all' ) {
			$this->action_enqueue_scripts(
				function () use ( $handle, $src, $deps, $ver, $media ) {
					wp_enqueue_style( $handle, get_template_directory_uri() . $src, $deps, $ver, $media );
				}
			);
			return $this;
		}

		public function add_script( $handle, $src = '', $deps = array(), $ver = false, $in_footer = true ) {
			$this->action_enqueue_scripts(
				function () use ( $handle, $src, $deps, $ver, $in_footer ) {
					wp_enqueue_script( $handle, get_template_directory_uri() . $src, $deps, $ver, $in_footer );
				}
			);
			return $this;
		}

		public function add_comment_script() {
			$this->action_enqueue_scripts(
				function () {
					if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
						wp_enqueue_script( 'comment-reply' );
					}
				}
			);
			return $this;
		}

		public function remove_style( $handle ) {
			$this->action_enqueue_scripts(
				function () use ( $handle ) {
					wp_dequeue_style( $handle );
					wp_deregister_style( $handle );
				}
			);
			return $this;
		}

		public function remove_script( $handle ) {
			$this->action_enqueue_scripts(
				function () use ( $handle ) {
					wp_dequeue_script( $handle );
					wp_deregister_script( $handle );
				}
			);
			return $this;
		}

		public function add_nav_menus( $locations = array() ) {
			$this->action_after_setup(
				function () use ( $locations ) {
					register_nav_menus( $locations );
				}
			);
			return $this;
		}

		public function add_nav_menu( $location, $description ) {
			$this->action_after_setup(
				function () use ( $location, $description ) {
					register_nav_menu( $location, $description );
				}
			);
			return $this;
		}

		public function remove_nav_menu( $location ) {
			$this->action_after_setup(
				function () use ( $location ) {
					unregister_nav_menu( $location );
				}
			);
			return $this;
		}

		public function get_menu_items( $location_id ) {
			//$locations = get_registered_nav_menus();
			$menus		  = wp_get_nav_menus();
			$menu_locations = get_nav_menu_locations();

			if ( isset( $menu_locations[ $location_id ] ) && 0 !== $menu_locations[ $location_id ] ) {
				foreach ( $menus as $menu ) {
					if ( $menu->term_id === $menu_locations[ $location_id ] ) {
						$menu_items = wp_get_nav_menu_items( $menu );
						break;
					}
				}
				return $menu_items;
			}
		}

		public function action_extend_head( $function ) {
			add_action(
				'wp_head',
				function () use ( $function ) {
					$function();
				}
			);
		}

		// public function add_site_meta( $key, $value ) {
		// 	switch ( $key ) {
		//		 case 'canonical':
		//			 break;
		//		 case 'manifest':
		//			 // mainfest added only to child theme
		//			 // if (is_child_theme() ) {
		//				 // TODO: checkout where manifest might be to work properly(in root folder? )
		//				 echo '<link rel="manifest" href="' . get_template_directory_uri() . '/manifest.json">';
		//			 // }
		//			 break;
		//		 case 'profile':
		//			 break;
		//		 case 'pingback':
		//			 break;
		//		 case '':
		//			 break;
		//		 default:
		// 	}
		// }

		// public function addAnalytics() {

		// }
	}

}
