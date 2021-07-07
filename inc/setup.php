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

add_action( 'basic_theme_setup', 'pb' );
function basic_theme_setup(){
    require_once  get_template_directory() . '/inc/classes/class.Pb.php';
}


