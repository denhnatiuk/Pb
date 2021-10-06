<?php
/**
 * @package         pb
 * @since           1.0.0
 * @copyright       Copyright (c) 2021, Den Hnatiuk (@denhnatiuk)
 * @link            https://denyshnatiuk.github.io/Pb/
 * 
 * Description:		File for Pb Theme setup
 */

defined( 'ABSPATH' ) || exit();




//theme_setup
// add_action( 'basic_theme_setup', esc_html( wp_get_theme()->get( 'TextDomain' ) ) );
// function basic_theme_setup(){
    if ( ! class_exists( 'Pb' ) ) {
        require_once  get_template_directory() . '/inc/classes/class.Pb.php';
        $config = (object) array(
            'theme_supports' => array(
                'title-tag' => false
            ),
            'undefined_option' => array(
                'unexpected' => 'value'
            ),
//         /**
//         * @see https://gist.github.com/ikukuler/b6075c8de885c514337425a93cab0d97                      * 
//         */
//         //disable update check on each admin login
//         //remove_action($key, $value)
//         ,'admin_init' => array(
//             '_maybe_update_core'
//             , '_maybe_update_plugins'
//             , '_maybe_update_themes'
//         )
//         //disable update check on visiting special plugins/themes page in admin panel
//         //remove_action($key, $value)
//         , 'load-plugins.php' => 'wp_update_plugins'
//         , 'load-themes.php' => 'wp_update_themes'
//         //disable update check on core plugins/themes page in admin panel
//         // , 'load-update-core.php'=> 'wp_update_plugins'
//         // , 'load-update-core.php'=> 'wp_update_themes'
//         //inner admin page "Update/Install Plugin" and "Update/Install Page"
//         // , 'load-update.php'=> 'wp_update_plugins'
//         // , 'load-update.php'=> 'wp_update_themes'
//         // Cron events
//         // , 'wp_version_check'=> 'wp_version_check'
//         // , 'wp_update_plugins'=> 'wp_update_plugins'
//         // , 'wp_update_themes'=> 'wp_update_themes'
        );
        $theme = new Pb($config);
    }
// }

// add_action( 'wp_head', 'inc_manifest_link' );
// function inc_manifest_link() {   
//     // mainfest added only to child theme
//     if (is_child_theme()){
//         echo '<link rel="manifest" href="' . get_template_directory_uri() . '/manifest.json">';
//     }  
// }
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');