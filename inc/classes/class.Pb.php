<?php 

defined('ABSPATH') || die();

if ( ! class_exists( 'Pb' ) ) {

    final class Pb{

        private $instance;

        public function __construct( $themeConfig ) {
            if ( ! version_compare( PHP_VERSION, '8.0', '>=' ) ) {
                $this->actionAdminNotice ( 
                    $this->adminNotice( 
                        sprintf( esc_html__( wp_get_theme()->get( 'Name' ) . ' requires PHP version %s+. Theme would not work properly.', 'pb' ), '8.0' )
                        , 'warning' 
                    ) 
                );                            
            }
            if ( ! version_compare( get_bloginfo( 'version' ), '5.7', '>=' ) ) {
                $this->actionAdminNotice (
                    $this->adminNotice( 
                        sprintf( esc_html__( wp_get_theme()->get( 'Name' ) . ' requires WordPress version %s+. Theme would not work properly.', 'pb' ), '4.7' )
                        , 'warning' 
                    )
                ); 
            }
            if ( !function_exists('register_block_type') ) {
                $this->actionAdminNotice (
                    $this->adminNotice( 
                        sprintf( esc_html__( wp_get_theme()->get( 'Name' ) . ' recommend to use %s for WordPress. Theme would not work properly.', 'pb' ), ' Gutenberg WYSIWYG' )
                        , 'warning' 
                    ) 
                ); 
            }
            $this->setupLoop( $this->extendAndOverrideDefaults( $themeConfig ) );
            
        }

        private function extendAndOverrideDefaults( $config ) {
            $defaults = (object) array(
                // TODO: while PSR-1 demands that files 
                //   SHOULD either declare symbols (classes, functions, constants, etc.) 
                //   OR cause side-effects (e.g. generate output, change .ini settings, etc.) 
                //   but SHOULD NOT do both, ini_set must be stand alone

                // 'ini_set' => array(
                //     'upload_max_size'       =>  '64M'
                //     , 'post_max_size'       =>  '64M'
                //     , 'max_execution_time'  =>  '300'
                //     , 'output_buffering'    =>  ''
                // )
                'textdomain' => array(
                    //'name', 'path to theme subfolder'
                    esc_html( wp_get_theme()->get( 'TextDomain' ) ), '/languages'                
                )
                , 'theme_supports' => array(
                    'title-tag'
                    , 'custom-logo' => array(
                        'height'                 => 100
                        , 'width'                => 100
                        , 'flex-height'          => true
                        , 'flex-width'           => true
                        , 'header-text'          => array( 
                            'site-title'
                            , 'site-description' 
                        )
                        , 'unlink-homepage-logo' => true                         
                    )
                    , 'post-tumbnails'
                    , 'wp-block-styles'         
                    , 'responsive-embeds'       
                    , 'editor-styles'           
                    , 'custom-units'            
                    , 'editor-color-palette' => array(
                        array(
                            'name' => esc_attr__( 
                                'strong magenta'
                                , esc_html( wp_get_theme()->get( 'TextDomain' ) ) 
                            )
                            , 'slug' => 'strong-magenta'
                            , 'color' => '#a156b4'
                        )
                        , array(
                            'name' => esc_attr__( 
                                'light grayish magenta'
                                , esc_html( wp_get_theme()->get( 'TextDomain' ) )
                            )
                            , 'slug' => 'light-grayish-magenta'
                            , 'color' => '#d0a5db'
                        )
                        , array(
                            'name' => esc_attr__( 
                                'very light gray'
                                , esc_html( wp_get_theme()->get( 'TextDomain' ) )
                            )
                            , 'slug' => 'very-light-gray'
                            , 'color' => '#eee'
                        )
                        , array(
                            'name' => esc_attr__( 
                                'very dark gray'
                                , esc_html( wp_get_theme()->get( 'TextDomain' ) )
                            )
                            , 'slug' => 'very-dark-gray'
                            , 'color' => '#444'
                        )
                    )
                    , 'html5' => array(
    
                        'search-form'
                        ,'comment-form'
                        ,'comment-list'
                        ,'gallery'
                        ,'caption'
                        ,'style'
                        ,'script'
                    )
                )
                , 'stylesheets' => array(
                    'theme' => array(
                        'path' => '/style.css'
                        , 'version' => esc_html( wp_get_theme()->get( 'Version' ) . "." . filemtime( get_template_directory() . '/style.css') )
                        , 'dependencies' => array()
                    )
                    ,'main' => array(
                        'path' => '/assets/css/main.css'
                        , 'version' => esc_html( wp_get_theme()->get( 'Version' ) . "." . filemtime( get_template_directory() . '/style.css') )
                        , 'dependencies' => array()
                    )
                )
                , 'scripts' => array(
                    'theme-js'  => array(
                        'path' => '/assets/js/bundle.js'
                        , 'version' => esc_html( wp_get_theme()->get( 'Version' ) . "." . filemtime( get_template_directory() . '/style.css') )
                        , 'dependencies' => array()
                    )
                )
                // , 'metatags' => array (
                //     'link'  => array(
                //         'canonical' => ''
                //         , 'mainfest' => ''
                //         , 'wlwmainfest' => ''
                //         , 'opengraph' => ''
                //         , 'profile' => ''
                //         , 'pingback' => ''
                //         , 'prefetch' => ''
                //         , 'dns-prefetch' => ''
                //         // , 'multisite' => ''
                //     )
                //     , 'meta' => array(
                //         // <meta http-equiv="Content-Security-Policy" content="default-src https://cdn.example.net; child-src 'none'; object-src 'none'">
                //         , 'CSP' => "default-src 'self'; child-src 'none'; object-src 'none'"
                //         , 'robots' => 'index, follow'
                //         , 'keywords' => ''
                //         , 'generator' => 'remove'
                        
                //     )
                // )
            );
            
            if (!empty($config)){
                foreach ($config as $property => $argument) {
                    $defaults->{$property} = $argument;
                }
            }
            return $defaults;
        }

        private function setupLoop( $config ) {
            
            foreach ($config as $group => $item){
                foreach ($item as $key => $value){
                    switch ($group) {
                        case 'ini_set':
                            @ini_set( $key , $value );
                            break;
                        case 'textdomain':
                            load_theme_textdomain( 
                                $key
                                , get_template_directory_uri() . $value
                            );
                            break;
                        case 'theme_supports':
                            if (is_int($key)){
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
                            $this->addStyle($key,  $value['path'],  $value['dependencies'], $value['version'], false);
                            break;
                        case 'scripts':
                            $this->addScript($key,  $value['path'],  $value['dependencies'], $value['version'], true);
                            break;
                        case 'site_meta':
                            $this->addSiteMeta( $key, $value);
                        default:
                            $this->actionAdminNotice ( 
                                $this->adminNotice( 
                                    sprintf( esc_html__( wp_get_theme()->get( 'Name' ) . ' config contains unexpected preseted option for %s, so Theme may not work properly. See documentation.', wp_get_theme()->get( 'Name' ) )
                                        , $group 
                                    )
                                    , 'warning' 
                                ) 
                            );                            
                            
                    }
                }
            }
        }

        public function actionAdminNotice ( $function ) {
            add_action ( 'admin_notices', function() use ( $function ) {
                $function;
            });
        }

        private function adminNotice( $message, $noticeType = null ) {

            if (!empty($noticeType)) {
                $class = $noticeType;
            } else {
                $class = 'info';
            }            
            
            $html_message = sprintf( '<div class="notice notice-'. $class .'">%s</div>', wpautop( $message ) );
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