<?php
/**
 * Description:     File for Pb Theme plugins setup
 *
 * @package         pb
 * @since           1.0.0
 * @copyright       Copyright(c) 2021, Den Hnatiuk( @denhnatiuk )
 * @link            https://denyshnatiuk.github.io/Pb/
 */

defined('ABSPATH' ) || die();

// require_once get_template_directory() . '/assets/gutenberg-boilerplate.php';

if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
	require_once get_template_directory() . '/inc/classes/class-tgmpa.php';
}

/**
 * Adding a new( custom ) block category.
 *
 * @param  array                   $block_categories       Array of categories for block types.
 * @param  WP_Block_Editor_Context $block_editor_context   The current block editor context.
 */
function wpdocs_add_new_block_category( $block_categories, $block_editor_context ) {
	// You can add extra validation such as seeing which post type
	// is used to only include categories in some post types.
	// if ( in_array( $block_editor_context->post->post_type, ['post', 'my-post-type'] ) ) { ... }
	return array_merge(
		$block_categories,
		[
			[
				'slug'  => 'my-block-category',
				'title' => esc_html__('My Block Category', wp_get_theme()->get( 'TextDomain' ) ),
				'icon'  => 'wordpress', // Slug of a WordPress Dashicon or custom SVG
			],
		]
	);
}

// add_filter('block_categories_all', 'wpdocs_add_new_block_category' );
add_filter( 'block_categories', 'pb_merge_categories', 10, 2 );
function pb_merge_categires( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'my-slug',
				'title' => 'my-title',
			),
		)
	);
}

add_action('init', 'pb_section_block_init' );
function pb_section_block_init() {
	register_block_type_from_metadata( get_template_directory() . '/assets/pb-section/index.asset.php' );
}
