<?php
//
// Galleries post type related functions.
//

add_action( 'init', 'ci_create_cpt_galleries' );
if( !function_exists('ci_create_cpt_galleries') ):
function ci_create_cpt_galleries()
{
	$labels = array(
		'name' => _x('Galleries', 'post type general name', 'xplosive'),
		'singular_name' => _x('Gallery Item', 'post type singular name', 'xplosive'),
		'add_new' => __('New Gallery Item', 'xplosive'),
		'add_new_item' => __('Add New Gallery Item', 'xplosive'),
		'edit_item' => __('Edit Gallery Item', 'xplosive'),
		'new_item' => __('New Gallery Item', 'xplosive'),
		'view_item' => __('View Gallery Item', 'xplosive'),
		'search_items' => __('Search Gallery Items', 'xplosive'),
		'not_found' =>  __('No Gallery Items found', 'xplosive'),
		'not_found_in_trash' => __('No Gallery Items found in the trash', 'xplosive'),
		'parent_item_colon' => __('Parent Gallery Item:', 'xplosive')
	);

	$args = array(
		'labels' => $labels,
		'singular_label' => __('Gallery Item', 'xplosive'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => true,
		'rewrite' => array('slug' => 'galleries'),
		'menu_position' => 5,
		'supports' => array('title', 'editor', 'thumbnail')
	);

	register_post_type( 'cpt_galleries' , $args );

}
endif;

add_action( 'load-post.php', 'galleries_meta_boxes_setup' );
add_action( 'load-post-new.php', 'galleries_meta_boxes_setup' );

if( !function_exists('galleries_meta_boxes_setup') ):
function galleries_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'galleries_add_meta_boxes' );
	add_action( 'save_post', 'galleries_save_meta', 10, 2 );
}
endif;

if( !function_exists('galleries_add_meta_boxes') ):
function galleries_add_meta_boxes() {
	add_meta_box(
		'galleries-box',
		esc_html__( 'Gallery Settings', 'xplosive' ),
		'galleries_score_meta_box',
		'cpt_galleries',
		'normal',
		'default'
	);
}
endif;

if( !function_exists('galleries_score_meta_box') ):
function galleries_score_meta_box( $object, $box ) { ?>
	<?php wp_nonce_field( basename( __FILE__ ), 'galleries_nonce' ); ?>
	<div style="margin-top:20px">
		<p>
			<label for="ci_cpt_galleries_venue"><?php _e( 'Photo gallery Venue. For example: Ushuaia', 'xplosive' ); ?></label><br>
			<input type="text" name="ci_cpt_galleries_venue" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_galleries_venue', true ) ); ?>" size="30" style="width:90%;" />
		</p>
		<p>
			<label for="ci_cpt_galleries_location"><?php _e( 'Photo gallery Location. For example: Ibiza, Spain', 'xplosive' ); ?></label><br>
			<input type="text" name="ci_cpt_galleries_location" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_galleries_location', true ) ); ?>" size="30" style="width:90%;" />
		</p>
	</div><!-- /postbox -->
	<?php
}
endif;

add_action( 'save_post', 'galleries_save_meta', 10, 2 );

if( !function_exists('galleries_save_meta') ):
function galleries_save_meta( $post_id, $post ) {

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;

	if ( !isset( $_POST['galleries_nonce'] ) || !wp_verify_nonce( $_POST['galleries_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	$post_type = get_post_type_object( $post->post_type );

	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	update_post_meta($post->ID, "ci_cpt_galleries_venue", (isset($_POST["ci_cpt_galleries_venue"]) ? $_POST["ci_cpt_galleries_venue"] : '') );
	update_post_meta($post->ID, "ci_cpt_galleries_location", (isset($_POST["ci_cpt_galleries_location"]) ? $_POST["ci_cpt_galleries_location"] : '') );
}
endif;
?>
