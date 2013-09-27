<?php
//
// slider post type related functions.
//

add_action( 'init', 'ci_create_cpt_slider' );
if( !function_exists('ci_create_cpt_slider') ):
function ci_create_cpt_slider()
{
	$labels = array(
		'name' => _x('Slider', 'post type general name', 'xplosive'),
		'singular_name' => _x('Slider Item', 'post type singular name', 'xplosive'),
		'add_new' => __('New Slider Item', 'xplosive'),
		'add_new_item' => __('Add New Slider Item', 'xplosive'),
		'edit_item' => __('Edit Slider Item', 'xplosive'),
		'new_item' => __('New Slider Item', 'xplosive'),
		'view_item' => __('View Slider Item', 'xplosive'),
		'search_items' => __('Search Slider Items', 'xplosive'),
		'not_found' =>  __('No Slider Items found', 'xplosive'),
		'not_found_in_trash' => __('No Slider Items found in the trash', 'xplosive'),
		'parent_item_colon' => __('Parent Slider Item:', 'xplosive')
	);

	$args = array(
		'labels' => $labels,
		'singular_label' => __('Slider Item', 'xplosive'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => false,
		'rewrite' => array('slug' => 'sliders'),
		'menu_position' => 4,
		'supports' => array('title', 'editor', 'thumbnail')
	);

	register_post_type( 'cpt_slider' , $args );

}
endif;

add_action( 'load-post.php', 'slider_meta_boxes_setup' );
add_action( 'load-post-new.php', 'slider_meta_boxes_setup' );

if( !function_exists('slider_meta_boxes_setup') ):
function slider_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'slider_add_meta_boxes' );
	add_action( 'save_post', 'slider_save_meta', 10, 2 );
}
endif;

if( !function_exists('slider_add_meta_boxes') ):
function slider_add_meta_boxes() {
	add_meta_box(
		'slider-box',
		esc_html__( 'Slider Settings', 'xplosive' ),
		'slider_score_meta_box',
		'cpt_slider',
		'normal',
		'default'
	);
}
endif;

if( !function_exists('slider_score_meta_box') ):
function slider_score_meta_box( $object, $box ) { ?>
	<?php wp_nonce_field( basename( __FILE__ ), 'slider_nonce' ); ?>
	<div class="postbox" style="margin-top:20px">
		<div class="inside">
			<p>
				<label for="ci_cpt_slider_url"><?php _e( 'Slider URL. If someone clicks on a slider item, this is the link that they will be visiting.', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_slider_url" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_slider_url', true ) ); ?>" size="30" />
			</p>
		</div>
	</div>
	<?php
}
endif;

add_action( 'save_post', 'slider_save_meta', 10, 2 );

if( !function_exists('slider_save_meta') ):
function slider_save_meta( $post_id, $post ) {

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;

	if ( !isset( $_POST['slider_nonce'] ) || !wp_verify_nonce( $_POST['slider_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	$post_type = get_post_type_object( $post->post_type );

	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	update_post_meta($post->ID, "ci_cpt_slider_url", (isset($_POST["ci_cpt_slider_url"]) ? $_POST["ci_cpt_slider_url"] : '') );
}
endif;

?>
