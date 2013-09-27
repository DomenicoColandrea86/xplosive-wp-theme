<?php
//
// artists post type related functions.
//

add_action( 'init', 'ci_create_cpt_artists' );
if( !function_exists('ci_create_cpt_artists') ):
function ci_create_cpt_artists()
{
	$labels = array(
		'name' => _x('Artists', 'post type general name', 'xplosive'),
		'singular_name' => _x('Artist', 'post type singular name', 'xplosive'),
		'add_new' => __('New artist', 'xplosive'),
		'add_new_item' => __('Add New artist', 'xplosive'),
		'edit_item' => __('Edit artists', 'xplosive'),
		'new_item' => __('New artist', 'xplosive'),
		'view_item' => __('View artists', 'xplosive'),
		'search_items' => __('Search artists', 'xplosive'),
		'not_found' =>  __('No artists found', 'xplosive'),
		'not_found_in_trash' => __('No artists found in the trash', 'xplosive'),
		'parent_item_colon' => __('Parent artists Item:', 'xplosive')
	);

	$args = array(
		'labels' => $labels,
		'singular_label' => __('Artists Item', 'xplosive'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => true,
		'rewrite' => array('slug' => 'artists'),
		'menu_position' => 5,
		'supports' => array('title', 'editor', 'thumbnail')
	);

	register_post_type( 'cpt_artists' , $args );

}
endif;
?>
