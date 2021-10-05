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
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--link rel="profile" href="https://gmpg.org/xfn/11"-->
    <!-- <link rel="pingback" href="<?php //bloginfo( 'pingback_url' ); ?>"> -->
    <meta name="description" content="<?php echo get_bloginfo( 'description' ) ?>">
    <meta name="keywords" content="">
    <?php wp_head(); ?>
</head>
<body <?php body_class( esc_html( wp_get_theme()->get( 'TextDomain' ) ) ); ?>>

<?php 
    wp_body_open(); 
?>

    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary">

<?php 
    esc_html_e( 'Skip to content', esc_html( wp_get_theme()->get( 'TextDomain' ) ) ); 
?>

        </a>

        <header id="masthead" class="site-header">
            <div class="container">
<?php 
    //TODO: add if/else branding statements
    get_template_part(  'template-parts/pbheader', 'branding' ); 
?>
<?php

    wp_get_nav_menus();
?>
            </div>            
        </header>
