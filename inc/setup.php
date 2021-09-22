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
            // 'remove_supports' => array(
            //     'title-tag'
            // ),
            // 'undefined_option' => array(
            //     'unexpected' => 'value'
            // ),
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