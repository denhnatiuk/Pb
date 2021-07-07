<?php
/**
 * @package         pb
 * @since           1.0.0
 * @author          Den Hnatiuk
 * @copyright       Copyright (c) 2021, Den Hnatiuk (@denhnatiuk)
 * @link            https://denyshnatiuk.github.io/Pb/
 * 
 * Description: Site header file.
*/
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--link rel="profile" href="https://gmpg.org/xfn/11"-->
	<meta name="description" content="<?php echo get_bloginfo( 'description' ) ?>">
	<meta name="keywords" content="">
	<?php wp_head(); ?>
</head>

<body <?php body_class('darklight-light'); ?>>
<?php 	wp_body_open(); ?>


<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary">
		<?php esc_html_e( 'Skip to content', 'geliostrans' ); ?>
	</a>


    <header>
        <h1 class="">
            <span class="brand-title__"></span>
            <span class="brand-title__main"></span>
            <span class="brand-title__"></span>
            <?php echo get_bloginfo( 'title' )?>
        </h1>


    <?php
        wp_get_nav_menus();
    ?>
    </header>