<?php
/**
 * Description:    File for Default WordPress Loop
 *
 * @package        pb
 * @since          1.0.0
 * @copyright      Copyright(c ) 2021, Den Hnatiuk(@denhnatiuk )
 * @link           https://denyshnatiuk.github.io/Pb/
 *
 */

defined( 'ABSPATH' ) || exit();

// TODO: use customizer config to tweak query object
$query = new WP_Query(
	array(
		'posts_per_page' => 5,
		'orderby'        => 'comment_count',
	)
);

global $post;

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();?>

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
			<?php echo json_encode( the_post() ); ?>
		</div>
	</figure>
</article>

<?php
	}
} else {
// no posts
}
wp_reset_postdata();

