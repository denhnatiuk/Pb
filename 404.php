<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package         pb
 * @since           1.0.0
 * @link            https://codex.wordpress.org/Creating_an_Error_404_Page
 */

get_header(); 
?>

	<main id="main" class="container site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title">
                    <?php esc_html_e( "Sorry, this page doesn't exist.", esc_html( wp_get_theme()->get( 'TextDomain' ) ) ); ?>
                </h1>
			</header>
			<div class="page-content">

				<p>
                    <?php esc_html_e( "It seems we can't find what you're looking for. Perhaps searching can help.", esc_html( wp_get_theme()->get( 'TextDomain' ) ) ); ?>
                </p>

				<?php get_search_form(); ?>

			</div>
		</section>
        
	</main>

<?php 
get_footer(); 
?>