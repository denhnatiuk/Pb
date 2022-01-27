<?php
/**
 * Template for site branding
 *
 * @package Pb
 */

?>

<div class="site-branding">
	<div class="brand-logo">

<?php

if ( ! has_custom_logo()  ) :
	// svg
else :
	the_custom_logo();
endif;

?>
	</div>
	<h1 class="brand-title">
		<span class="brand-title__kicker">
<?php esc_html_e( get_theme_mod('brand_color_main' ), wp_get_theme()->get( 'TextDomain' ) ); ?>
		</span>
		<span class="brand-title__main"><?php esc_html_e( get_bloginfo( 'title' ), wp_get_theme()->get( 'TextDomain' ) ); ?></span>
		<span class="brand-title__tagline"><?php esc_html_e( get_bloginfo( 'description' ), wp_get_theme()->get( 'TextDomain' ) ); ?></span>	  
	</h1>
</div>
