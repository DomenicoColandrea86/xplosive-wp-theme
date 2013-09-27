<?php
//
// videos post type related functions.
//

add_action( 'init', 'ci_create_cpt_videos' );
if( !function_exists('ci_create_cpt_videos') ):
function ci_create_cpt_videos()
{
	$labels = array(
		'name' => _x('Videos', 'post type general name', 'xplosive'),
		'singular_name' => _x('Videos Item', 'post type singular name', 'xplosive'),
		'add_new' => __('New Video Item', 'xplosive'),
		'add_new_item' => __('Add New Video Item', 'xplosive'),
		'edit_item' => __('Edit Video Item', 'xplosive'),
		'new_item' => __('New Video Item', 'xplosive'),
		'view_item' => __('View Video Item', 'xplosive'),
		'search_items' => __('Search Video Items', 'xplosive'),
		'not_found' =>  __('No Video Items found', 'xplosive'),
		'not_found_in_trash' => __('No Video Items found in the trash', 'xplosive'),
		'parent_item_colon' => __('Parent Video Item:', 'xplosive')
	);

	$args = array(
		'labels' => $labels,
		'singular_label' => __('Video Item', 'xplosive'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => true,
		'rewrite' => array('slug' => 'videos'),
		'menu_position' => 5,
		'supports' => array('title', 'editor', 'thumbnail')
	);
	register_post_type( 'cpt_videos' , $args );
}
endif;

add_action( 'load-post.php', 'videos_meta_boxes_setup' );
add_action( 'load-post-new.php', 'videos_meta_boxes_setup' );

if( !function_exists('videos_meta_boxes_setup') ):
function videos_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'videos_add_meta_boxes' );
	add_action( 'save_post', 'videos_save_meta', 10, 2 );
}
endif;

if( !function_exists('videos_add_meta_boxes') ):
function videos_add_meta_boxes() {
	add_meta_box(
		'videos-box',
		esc_html__( 'Video Settings', 'xplosive' ),
		'videos_score_meta_box',
		'cpt_videos',
		'normal',
		'default'
	);
}
endif;

if( !function_exists('videos_score_meta_box') ):
function videos_score_meta_box( $object, $box ) { ?>
	<?php wp_nonce_field( basename( __FILE__ ), 'videos_nonce' ); ?>
		<div>
			<p>
				<label for="ci_cpt_videos_url"><?php _e( 'Video URL', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_videos_url" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_videos_url', true ) ); ?>" size="30" style="width:90%;" />
			</p>
			<p>
				<?php $ci_cpt_videos_self = get_post_meta( $object->ID, 'ci_cpt_videos_self', true ); ?>
				<input type="checkbox" name="ci_cpt_videos_self" value="1" <?php checked(1, $ci_cpt_videos_self); ?> />
				<label for="ci_cpt_videos_self"><?php _e( 'Is it self-hosted?', 'xplosive' ); ?></label><br>
			</p>
		</div><!-- /inside -->
	<?php
}
endif;

add_action( 'save_post', 'videos_save_meta', 10, 2 );

if( !function_exists('videos_save_meta') ):
function videos_save_meta( $post_id, $post ) {

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;

	if ( !isset( $_POST['videos_nonce'] ) || !wp_verify_nonce( $_POST['videos_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	$post_type = get_post_type_object( $post->post_type );

	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	update_post_meta($post->ID, "ci_cpt_videos_url", (isset($_POST["ci_cpt_videos_url"]) ? $_POST["ci_cpt_videos_url"] : '') );
	update_post_meta($post->ID, "ci_cpt_videos_self", (isset($_POST["ci_cpt_videos_self"]) ? $_POST["ci_cpt_videos_self"] : '') );

}
endif;
?>
