<?php
/**
 * Description:     File for Pb Theme settings
 *
 * @package         pb
 * @since           1.0.0
 * @copyright       Copyright(c ) 2021, Den Hnatiuk(@denhnatiuk )
 * @link            https://denyshnatiuk.github.io/Pb/
 */

defined('ABSPATH' ) || exit();

function pb_buffering_loop_to_json( $args = array() ) {
	ob_start();
	$query = new WP_Query( array( $args ) );

	while ( $query->have_posts() ) {
		wp_json_encode( $query->the_post() );
	}
	$data = ob_get_contents();
	ob_end_clean();

	// echo $data;
}
