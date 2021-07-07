<?php 
/**
 * @package         pb
 * @since           1.0.0
 * @author          Den Hnatiuk
 * @copyright       Copyright (c) 2021, Den Hnatiuk (@denhnatiuk)
 * @link            https://denyshnatiuk.github.io/Pb/
 * @license         https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 * 
 * 
 * Description:     main Pb Theme functions and definitions
*/

defined( 'ABSPATH' ) || exit();
defined( 'PB_VERSION' ) || $PB_VERSION = wp_get_theme()->get( 'Version' );

$INC_dir = get_template_directory() . '/inc';

$INC_components = array(
    '/helpers.php'                           // Helpers 
    , '/setup.php'                           // Theme setup.
    , '/enqueue.php'                         // Enqueue scripts and styles.
    // , '/theme-settings.php'                 // Theme settings.
    // , '/plugins.php'                        // Add preinstalled plugins.
    // , '/customizer.php'                     // Add admin customizations.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {$INC_components[] = '/woocommerce.php';}
// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {	$INC_components[] = '/jetpack.php';}

foreach ( $INC_components as $INC_item ) {
    require_once $INC_dir . $INC_item;
} 