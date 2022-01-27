<?php
/**
 * @package		 pb
 * @since		   1.0.0
 * @copyright	   Copyright(c ) 2021, Den Hnatiuk(@denhnatiuk )
 * @link			https://denyshnatiuk.github.io/Pb/
 *
 * Description:		File for Default Wordpress Loop
 */

defined( 'ABSPATH'  ) || exit();


// if (have_posts() ) {
//	 while(have_posts() ) {
//		 the_post();
//	 }
// } else {
//	 //	 get_template_part('content', 'none' );
?>
<!--	 <p><?php //esc_html_e('Sorry, no posts matched your criteria.' ); ?></p> -->
	 <?php
		// }

		// alternate

		global $post;
		// $myposts = get_posts('numberposts=5&offset=1&category=1' );
		$myposts = get_posts();

		foreach ( $myposts as $post  ) {
			setup_postdata( $post  );
			// the_post();
			?>

<article id="<?php the_ID(); ?>" class="post ">
	<figure>
		<img src="<?php the_post_thumbnail(); ?>">
		<figcaption>
			<h3 class="post-title"><?php the_title(); ?></h3>
			<p><?php the_excerpt(); ?></p>
			<div>
				<?php the_content(); ?>
			</div>
		</figcaption>
		<div>
			<?php echo json_encode( the_post()  ); ?>
		</div>
	</figure>
			</article>

			<?php
		}
		wp_reset_postdata();


		// $query = new WP_Query([
		//	 'posts_per_page' => 5,
		//	 'orderby'		=> 'comment_count'
		// ] );
		// // Цикл
		// global $post;
		// if ($query->have_posts() ) {
		//	 while($query->have_posts() ) {
		//		 $query->the_post();
		//		 the_title();
		//	 }
		// } else {
		//	 // Постов не найдено
		// }
		// wp_reset_postdata();
