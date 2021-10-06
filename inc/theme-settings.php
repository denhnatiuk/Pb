<?php
/**
 * @package         pb
 * @since           1.0.0
 * @copyright       Copyright (c) 2021, Den Hnatiuk (@denhnatiuk)
 * @link            https://denyshnatiuk.github.io/Pb/
 * 
 * Description:		File for Pb Theme settings
 */

defined( 'ABSPATH' ) || exit();

function pb_buffering_Loop_to_JSON( $args = array() ){
    ob_start();
    query_posts(array( $args ));

    while (have_posts()) {
        json_encode(the_post());
    }
    $data   =   ob_get_contents();
    ob_end_clean();
    // echo $data;
}