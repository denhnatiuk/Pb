<?php
/**
 * Description: Site header file.
 *
 * @package        pb
 * @since          1.0.0
 * @author         Den Hnatiuk
 * @copyright      Copyright(c ) 2021, Den Hnatiuk(@denhnatiuk )
 * @link           https://denyshnatiuk.github.io/Pb/
 *
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--link rel="profile" href="https://gmpg.org/xfn/11"-->
	<!-- <link rel="pingback" href="<?php //bloginfo('pingback_url' ); ?>"> -->
	<meta name="description" content="<?php esc_html_e( get_bloginfo( 'description' ), wp_get_theme()->get( 'TextDomain' ) ); ?>">
	<meta name="keywords" content="">
	<?php wp_head(); ?>
</head>
<body <?php body_class( esc_html( wp_get_theme()->get( 'TextDomain' ) ) ); ?>>

<?php
	wp_body_open();
?>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary">
<?php esc_html_e('Skip to content', wp_get_theme()->get( 'TextDomain' ) ); ?>
		</a>
		<header id="masthead" class="site-header">
			<div class="container">
<?php
if ( ! has_header_video() ) {
	if ( ! has_header_image() ) {
		//echo 'has no header image';
		the_custom_header_markup();
	} else {
?>
			<img 
				src="<?php header_image(); ?>" 
				height="<?php echo esc_html( get_custom_header()->height ); ?>" 
				width="<?php echo esc_html( get_custom_header()->width ); ?>" 
				alt="" 
			/>
<?php
	}
} else {
	if ( is_header_video_active() && ! empty(get_header_video_url() ) ) {
		echo esc_url(
			wp_video_shortcode(
				array(
					'src'      => get_header_video_url(),
					'poster'   => '',
					'loop'     => true, // str. "off" by default
					'autoplay' => 'true', // str. "off" by default
					'preload'  => 'metadata',
					'height'   => 480,
					'width'    => ! empty( $content_width ) ? $content_width : 640,
					'class'    => '', // 'class' attr of `<video>` elem. 'wp-video-shortcode' by default
					'id'       => '', // 'id' attr of `<video>` elem. 'video-{$post_id}-{$instances}' by default
				)
			)
		);
		the_custom_header_markup();
	}
}
	//TODO: add if/else branding statements
	get_template_part('template-parts/pbheader', 'branding' );?>

<?php
	wp_get_nav_menus();
?>
			</div>			
		</header>
