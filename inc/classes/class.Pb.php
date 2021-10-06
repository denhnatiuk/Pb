<?php 

defined('ABSPATH') || die();

if ( ! class_exists( 'Pb' ) ) {

    final class Pb{

        public function __construct( $themeConfig ) {
            if ( ! version_compare( PHP_VERSION, '8.0', '>=' ) ) {
                $this->actionAdminNotice ( 
                        sprintf( esc_html__( wp_get_theme()->get( 'Name' ) . ' requires PHP version %s+. Theme would not work properly.', 'pb' ), '8.0' )
                        , 'warning' 
                );}
            if ( ! version_compare( get_bloginfo( 'version' ), '5.7', '>=' ) ) {
                $this->actionAdminNotice (
                        sprintf( esc_html__( wp_get_theme()->get( 'Name' ) . ' requires WordPress version %s+. Theme would not work properly.', 'pb' ), '4.7' )
                        , 'warning' 
                );}
            if ( !function_exists('register_block_type') ) {
                $this->actionAdminNotice (
                        sprintf( esc_html__( wp_get_theme()->get( 'Name' ) . ' recommend to use %s for WordPress. Theme would not work properly.', 'pb' ), ' Gutenberg WYSIWYG' )
                        , 'warning' 
                );}
            $this->setupLoop( $themeConfig );            
        }

        private function extendAndOverrideDefaults( $themeConfig ) {
            // TODO: maybe use other notation. js with comments or thmth else
            $defaultConfig = new RecursiveArrayIterator( json_decode( file_get_contents( get_template_directory() . '/inc/config/pb.config.json' ), true ));
            
            if (!empty($themeConfig)){
                foreach ($themeConfig as $property => $argument) {
                    $defaultConfig->{$property} = $argument;
                }
            }

            return $defaultConfig;
        }

        private function setupLoop( $themeConfig ) {

            $config = $this->extendAndOverrideDefaults( $themeConfig );

            // foreach ( $config as $group => $item){
            if (is_array($config) || is_object($config)) {
                foreach ($config as $group => $item) {
                    foreach ($item as $key => $value) {
                        switch ($group) {
                        case 'ini_set':
                            @ini_set($key, $value);
                            break;
                        case 'textdomain':
                            load_theme_textdomain(
                                $key,
                                get_template_directory_uri() . $value
                            );
                            break;
                        case 'theme_supports':
                            if (is_int($key)) {
                                $this->addSupport($value);
                            } else {
                                $this->addSupport($key, $value);
                            }
                            break;
                        case 'remove_supports':
                            $this->removeSupport($value);
                            break;
                        case 'stylesheets':
                            //    wp_enqueue_style($key,  get_template_directory() . $value['path'],  $value['dependencies'], $value['version'], 0);
                            $this->addStyle($key, $value['path'], $value['dependencies'], $value['version'], false);
                            break;
                        case 'scripts':
                            $this->addScript($key, $value['path'], $value['dependencies'], $value['version'], true);
                            break;
                        case 'site_meta':
                            $this->addSiteMeta($key, $value);
                            // no break
                        default:
                            $this->actionAdminNotice(
                                    sprintf(
                                        esc_html__(wp_get_theme()->get('Name') . ' config contains unexpected preseted option for %s, so Theme may not work properly. See documentation.', wp_get_theme()->get('Name')),
                                        $group
                                    ),
                                    'warning'
                            );
                            
                    }
                    }
                }
            } else {
                $this->actionAdminNotice(
                        sprintf(
                            esc_html__(wp_get_theme()->get('Name') . ' config contains invalid parameters, so Theme may not work properly. See documentation.', wp_get_theme()->get('Name')),
                            $config
                        ),
                        'warning'
                );                
            }
        }

        public function actionAdminNotice ( $message, $noticeType = null  ) {
            add_action ( 'admin_notices', function() use ( $message, $noticeType ) {
                $this->adminNotice( $message, $noticeType);
            });
        }

        private function adminNotice( $message, $noticeType = null ) {

            if ( !empty($noticeType) ) {
                $class = $noticeType;
            } else {
                $class = 'info';
            }            
            
            $html_message = sprintf( '<div class="notice is-dismissible notice-'. $class .'">%s</div>', wpautop( $message ) );

            echo wp_kses_post( $html_message );
        }

        private function actionAfterSetup ( $function ) {
            add_action ( 'after_setup_theme', function() use ( $function ) {
                $function;
            });
        }

        private function actionEnqueueScripts( $function ) {
            add_action('wp_enqueue_scripts', function() use ($function){
                $function();
            });
        }

        private function addSupport ( $feature, $options = null ) {
            add_theme_support( $feature, $options );
        }

        private function removeSupport($feature) {
            remove_theme_support($feature);
        }

        private function addImageSize($name, $width = 0, $height = 0, $crop = false) {
            $this->actionAfterSetup(function() use ($name, $width, $height, $crop){
                add_image_size($name, $width, $height, $crop);
            });
            return $this;
        }

        private function removeImageSize($name) {
            $this->actionAfterSetup(function() use ($name){
                remove_image_size($name);
            });
            return $this;
        }

        public function addStyle($handle,  $src = '',  $deps = array(), $ver = false, $media = 'all') {
            $this->actionEnqueueScripts(function() use ($handle, $src, $deps, $ver, $media){
                wp_enqueue_style($handle,  get_template_directory_uri() . $src,  $deps, $ver, $media);
            });
            return $this;
        }

        public function addScript($handle,  $src = '',  $deps = array(), $ver = false, $in_footer = true) {
            $this->actionEnqueueScripts(function() use ($handle, $src, $deps, $ver, $in_footer) {
                wp_enqueue_script($handle,  get_template_directory_uri() . $src,  $deps, $ver, $in_footer);
            });
            return $this;
        }

        public function addCommentScript() {
            $this->actionEnqueueScripts(function() {
                if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                    wp_enqueue_script( 'comment-reply' );
                }
            });
            return $this;
        }

        public function removeStyle($handle) {
            $this->actionEnqueueScripts(function() use ($handle){
                wp_dequeue_style($handle);
                wp_deregister_style($handle); 
            });
            return $this;
        }

        public function removeScript($handle) {
            $this->actionEnqueueScripts(function() use ($handle){
                wp_dequeue_script($handle);
                wp_deregister_script($handle);   
            });
            return $this;
        }

        public function addNavMenus($locations = array()) {
            $this->actionAfterSetup(function() use ($locations){
                register_nav_menus($locations);
            });
            return $this;
        }

        public function addNavMenu($location, $description) {
            $this->actionAfterSetup(function() use ($location, $description){
                register_nav_menu($location, $description);
            });
            return $this;
        }

        public function removeNavMenu($location) {
            $this->actionAfterSetup(function() use ($location){
                unregister_nav_menu($location);
            });
            return $this;
        }

        public function getMenuItems($location_id){
            //$locations = get_registered_nav_menus();
            $menus = wp_get_nav_menus();
            $menu_locations = get_nav_menu_locations();

            if (isset($menu_locations[ $location_id ]) && $menu_locations[ $location_id ]!=0) {
                foreach ($menus as $menu) {
                    if ($menu->term_id == $menu_locations[ $location_id ]) {
                        $menu_items = wp_get_nav_menu_items($menu);
                        break;
                    }
                }
                return $menu_items;
            }
        }

        public function actionExtendHead($function){
            add_action('wp_head', function() use ($function){
                $function();
            });
        }

        public function addSiteMeta( $key, $value ){
            switch ($key){
                case "canonical":
                    break;    
                case "manifest":
                    // mainfest added only to child theme
                    // if (is_child_theme()){
                        // TODO: checkout where manifest might be to work properly (in root folder?)
                        echo '<link rel="manifest" href="' . get_template_directory_uri() . '/manifest.json">';
                    // }  
                    break;
                case "profile":
                    break;
                case "pingback":
                    break;
                case "":
                    break;                
                default:
            }            
        }

        public function addAnalytics() {
            
        }
    }

}