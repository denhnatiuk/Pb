<?php
/**
 * Description:    main Pb Theme functions and definitions
 *
 * @package        pb
 * @since          1.0.0
 * @author         Den Hnatiuk
 * @copyright      Copyright(c ) 2021, Den Hnatiuk(@denhnatiuk )
 * @link           https://denyshnatiuk.github.io/Pb/
 * @license        https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 */

defined( 'ABSPATH' ) || exit();
defined( 'PB_VERSION' ) || $PB_VERSION = wp_get_theme()->get('Version' );

$INC_dir = get_template_directory() . '/inc';

$INC_components = array(
	'/setup.php',                 // Theme setup.
	//'/helpers.php',             // Helpers
	//'/enqueue.php',             // Enqueue scripts and styles.
	'/theme-settings.php',        // Theme settings.
	//'/plugins.php',             // Add preinstalled plugins.
	'/customizer/customizer.php', // Add admin customizations.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists('WooCommerce' ) ) {
	$INC_components[] = '/woocommerce.php';
}
// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$INC_components[] = '/jetpack.php';
}

foreach ( $INC_components as $INC_item ) {
	require_once $INC_dir . $INC_item;
}

// purify | remove the unwanted <meta> links
remove_action('wp_head', 'wp_generator' );
remove_action('wp_head', 'woo_version' );
remove_action('wp_head', 'wlwmanifest_link' );


/**
 * Header hook to load name-based layouts
*/
// add_action('get_header', 'pb_header_hook' );
//function pb_header_hook($name ) {
//	if ('new' == $name ) {
//		add_action('wp_enqueue_scripts', 'wpdocs_themeslug_header_style' );
//	}
//}
 
// function wpdocs_themeslug_header_style() {
//	 wp_enqueue_style('wpdocs-header-new-style', get_template_directory_uri() . '/css/header-new.css' );
// }

// function pb_header_extend()
// {
// }

// add_action('wp_head', '_wp_render_title_tag', 1 );
// add_action('wp_head', 'wp_enqueue_scripts', 1 );
// add_action('wp_head', 'wp_resource_hints', 2 );
// add_action('wp_head', 'feed_links', 2 );
// add_action('wp_head', 'feed_links_extra', 3 );
// add_action('wp_head', 'rsd_link' );
// add_action('wp_head', 'wlwmanifest_link' );
// add_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
// add_action('wp_head', 'locale_stylesheet' );
// add_action('publish_future_post', 'check_and_publish_future_post', 10, 1 );
// add_action('wp_head', 'noindex', 1 );
// add_action('wp_head', 'print_emoji_detection_script', 7 );
// add_action('wp_head', 'wp_print_styles', 8 );
// add_action('wp_head', 'wp_print_head_scripts', 9 );
// add_action('wp_head', 'wp_generator' );
// add_action('wp_head', 'rel_canonical' );
// add_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
// add_action('wp_head', 'wp_custom_css_cb', 101 );
// add_action('wp_head', 'wp_site_icon', 99 );
