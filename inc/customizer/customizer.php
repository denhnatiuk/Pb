<?php 
/**
 * @package         pb
 * @since           1.0.0
 * @copyright       Copyright(c ) 2021, Den Hnatiuk(@denhnatiuk )
 * @link            https://denyshnatiuk.github.io/Pb/
 * 
 * Description:        File for Pb Theme settings
 */

defined('ABSPATH' ) || exit();

add_action('customize_register', 'remove_default_customizer_sections', 15 );
function remove_default_customizer_sections($wp_customize ) {

    // Remove sections.
    // $wp_customize->remove_section('custom_css' );
    $wp_customize->remove_section('static_front_page' );
    $wp_customize->remove_section('background_image' );
    $wp_customize->remove_section('colors' );
}

