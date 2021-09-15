<?php
/**
 * @package 		Pb
 * @since   		version 1.0.0
 * @copyright       Copyright (c) 2021, Den Hnatiuk (@denhnatiuk)
 * @link            https://denyshnatiuk.github.io/Pb/
 * 
 * Description:	 	Enqueue scripts and styles.
 */
defined( 'ABSPATH' ) || exit();

add_action( 'wp_enqueue_scripts', 'pb_scripts' );

function pb_scripts() {
	
    $css_version = esc_html( wp_get_theme()->get( 'Version' ) ) . '.' . filemtime( get_template_directory().'/assets/css/main.css');

	wp_enqueue_style('theme-css', get_stylesheet_uri(), array(), esc_html( wp_get_theme()->get( 'Version' ) ));
	wp_enqueue_style('css', get_template_directory_uri() . '/assets/css/main.css', array(), $css_version);
	// wp_enqueue_style('css-vars', get_template_directory_uri() . '/assets/css/colors.php', array(), $css_version);

	wp_style_add_data( 'theme-rtl', 'rtl', 'replace' );
	// wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/lib/bootstrap/dist/css/bootstrap.min.css', array(), $css_version);

	// wp_enqueue_script( 'jquery', get_template_directory_uri() . '/lib/jquery/dist/jquery.min.js', array(),  $css_version, true );
	// wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/lib/bootstrap/dist/js/bootstrap.min.js', array('jquery'),  $css_version, true );
	// wp_enqueue_script( 'anime-js', get_template_directory_uri() . '/lib/anime.min.js', array('jquery'),  $css_version, true );
	// wp_enqueue_script( 'darklight', get_template_directory_uri() . '/template-parts/prefences/darklight/darklight.js', array(),  $css_version, true );
	// wp_enqueue_script( 'langSwitch', get_template_directory_uri() . '/template-parts/prefences/langSwitch/langSwitch.js', array(),  $css_version, true );
	// wp_enqueue_script( 'gelios-navigation', get_template_directory_uri() . '/js/navigation.js', array(),  $css_version, true );


	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}
