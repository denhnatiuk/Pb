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

// if ( gutenberg ) {

// } else {
get_header();
?>

<div id="primary" class="content-area">
<main id="main" class="site-main" role="main">

<?php
if ( have_posts() ) :

    get_template_part( 'loop' );

else :

    get_template_part( 'content', 'none' );

endif;
?>
    </main><!-- #main -->
    </div><!-- #primary --> 

<?php 

get_sidebar();
get_footer();
// }