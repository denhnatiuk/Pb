<?php
/**
 * @package         pb
 * @since           1.0.0
 * @author          Den Hnatiuk
 * @copyright       Copyright (c) 2021, Den Hnatiuk (@denhnatiuk)
 * @link            https://denyshnatiuk.github.io/Pb/ * 
 * 
 * Description: Main index file.
*/

// IDEA: use ob_start() and ob_end_flush() for buffering output, check it`s consistency, bundle svgs, add content rythm (before&after section shapes) 
// if ( gutenberg ) {}

get_header();
?>
<div id="content" class=" content-area sidebar-right">
<main id="primary" class="site-main" role="main">

<?php
if ( have_posts() ) :
    get_template_part( 'loop' );
else :
    get_template_part( 'content', 'none' );
endif;
?>

</main>
<aside id="secondary" class="sidebar">

<?php 
get_sidebar();
?>

</aside>
</div>
<?php 
get_footer();

    // DEBUG CODE
    // TODO: not for production, remove it before push
    get_template_part(  'template-parts/temporary', 'themesupports' ); 
?>
