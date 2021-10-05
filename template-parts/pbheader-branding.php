<?php 
/**
 * @package Pb
 * 
 * Template for site branding
*/

?>

<div class="site-branding">
    <div class="brand-logo">

<?php
    if (has_custom_logo()):
        the_custom_logo();
    else:
        // svg
    endif;
?>

    </div>
    <h1 class="brand-title">

        <span class="brand-title__kicker">
            <?
            $color = get_theme_mod('brand_color_main');
            echo $color;                
            ?>
        </span>
        <span class="brand-title__main"><?php echo get_bloginfo( 'title' )?></span>
        <span class="brand-title__tagline"><?php echo get_bloginfo( 'description' )?></span>      
        
    </h1>
</div>