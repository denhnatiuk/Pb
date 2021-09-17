<?php

/** Admin warn about minimum PHP version */
if ( ! version_compare( PHP_VERSION, '8.0', '>=' ) ) {

	add_action( 'admin_notices', 'pb_fail_php_version' );  

    function pb_fail_php_version() {
        /* translators: %s: PHP version */
        $message      = sprintf( esc_html__( wp_get_theme()->get( 'Name' ) . ' requires PHP version %s+. Theme would not work properly.', 'pb' ), '8.0' );
        $html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
        echo wp_kses_post( $html_message );;
    }

}

/** Admin warn about minimum Wordpress version */
if ( ! version_compare( get_bloginfo( 'version' ), '5.7', '>=' ) ) {

	add_action( 'admin_notices', 'pb_fail_wp_version' );

    function pb_fail_wp_version() {
	/* translators: %s: WordPress version */
        $message      = sprintf( esc_html__( wp_get_theme()->get( 'Name' ) . ' requires WordPress version %s+. Theme would not work properly.', 'pb' ), '4.7' );
        $html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
        echo wp_kses_post( $html_message );
    }

}
/** Admin recomendation to Install Gutenberg */
if ( !function_exists('register_block_type') ) {

    add_action( 'admin_notices', 'pb_recommend_gutenberg' );
        
    function pb_recommend_gutenberg(){
        $message      = sprintf( esc_html__( wp_get_theme()->get( 'Name' ) . ' recommend to use %s for WordPress. Theme would not work properly.', 'pb' ), ' Gutenberg WYSIWYG' );
        $html_message = sprintf( '<div class="warn">%s</div>', wpautop( $message ) );
        echo wp_kses_post( $html_message );
    }

} 