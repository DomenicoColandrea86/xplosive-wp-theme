<?php
//
// discography post type related functions.
//

add_action( 'init', 'ci_create_cpt_discography' );
if( !function_exists('ci_create_cpt_discography') ):
function ci_create_cpt_discography()
{
	$labels = array(
		'name' => _x('Discography', 'post type general name', 'xplosive'),
		'singular_name' => _x('Discography Item', 'post type singular name', 'xplosive'),
		'add_new' => __('New Discography Item', 'xplosive'),
		'add_new_item' => __('Add New Discography Item', 'xplosive'),
		'edit_item' => __('Edit Discography Item', 'xplosive'),
		'new_item' => __('New Discography Item', 'xplosive'),
		'view_item' => __('View Discography Item', 'xplosive'),
		'search_items' => __('Search Discography Items', 'xplosive'),
		'not_found' =>  __('No Discography Items found', 'xplosive'),
		'not_found_in_trash' => __('No Discography Items found in the trash', 'xplosive'),
		'parent_item_colon' => __('Parent Discography Item:', 'xplosive')
	);

	$args = array(
		'labels' => $labels,
		'singular_label' => __('Discography Item', 'xplosive'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => true,
		'rewrite' => array('slug' => 'discography'),
		'menu_position' => 5,
		'supports' => array('title', 'editor', 'thumbnail')
	);

	register_post_type( 'cpt_discography' , $args );

}
endif;

add_action( 'load-post.php', 'discography_meta_boxes_setup' );
add_action( 'load-post-new.php', 'discography_meta_boxes_setup' );

if( !function_exists('discography_meta_boxes_setup') ):
function discography_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'discography_add_meta_boxes' );
	add_action( 'save_post', 'discography_save_meta', 10, 2 );
}
endif;

if( !function_exists('discography_add_meta_boxes') ):
function discography_add_meta_boxes() {
	add_meta_box(
		'discography-box',
		esc_html__( 'Discography Settings', 'xplosive' ),
		'discography_score_meta_box',
		'cpt_discography',
		'normal',
		'default'
	);
}
endif;

if( !function_exists('discography_score_meta_box') ):
function discography_score_meta_box( $object, $box ) { ?>
	<?php wp_nonce_field( basename( __FILE__ ), 'discography_nonce' ); ?>
	<div class="postbox" style="margin-top:20px">
		<h3><?php _e('Album details', 'xplosive'); ?></h3>
		<div class="inside">
			<p>
				<label for="ci_cpt_discography_date"><?php _e( 'Release Date.', 'xplosive' ); ?></label><br>
				<input type="text" id="ci_cpt_discography_date" name="ci_cpt_discography_date" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_discography_date', true ) ); ?>" size="30" style="width:90%;" />
			</p>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$( "#ci_cpt_discography_date" ).datepicker({
						dateFormat: 'yy-mm-dd',
					});
				});
			</script>
			<p>
				<label for="ci_cpt_discography_label"><?php _e( 'Recording Label.', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_discography_label" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_discography_label', true ) ); ?>" size="30" style="width:90%;" />
			</p>
			<p>
				<label for="ci_cpt_discography_cat_no"><?php _e( 'Catalog Number.', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_discography_cat_no" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_discography_cat_no', true ) ); ?>" size="30" style="width:90%;" />
			</p>
		</div><!-- /inside -->
	</div><!-- /postbox -->

	<div class="postbox" style="margin-top:20px">
		<h3><?php _e('Purchase details', 'xplosive'); ?></h3>
		<div class="inside">
			<p>
				<label for="ci_cpt_discography_status"><?php _e( 'Album Status. For example: "This album is now available"', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_discography_status" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_discography_status', true ) ); ?>" size="30" style="width:90%;" />
			</p>
			<p>
				<label for="ci_cpt_discography_purchase_text"><?php _e( 'Purchase text. For example: "You can purchase this album from" OR "Pre-order this album now"', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_discography_purchase_text" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_discography_purchase_text', true ) ); ?>" size="30" style="width:90%;" />
			</p>
			<p>
				<label for="ci_cpt_discography_purchase_text_from1"><?php _e( 'Purchase from text #1. For example: "iTunes"', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_discography_purchase_text_from1" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_discography_purchase_text_from1', true ) ); ?>" size="30" style="width:90%;" />
			</p>
			<p>
				<label for="ci_cpt_discography_purchase_text_url1"><?php _e( 'Purchase from URL #1.', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_discography_purchase_text_url1" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_discography_purchase_text_url1', true ) ); ?>" size="30" style="width:90%;" />
			</p>
			<p>
				<label for="ci_cpt_discography_purchase_text_from2"><?php _e( 'Purchase from text #2. For example: "iTunes"', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_discography_purchase_text_from2" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_discography_purchase_text_from2', true ) ); ?>" size="30" style="width:90%;" />
			</p>
			<p>
				<label for="ci_cpt_discography_purchase_text_url"><?php _e( 'Purchase from URL #2.', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_discography_purchase_text_url2" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_discography_purchase_text_url2', true ) ); ?>" size="30" style="width:90%;" />
			</p>
		</div><!-- /inside -->
	</div><!-- /postbox -->
	<?php
}
endif;

add_action( 'save_post', 'discography_save_meta', 10, 2 );

if( !function_exists('discography_save_meta') ):
function discography_save_meta( $post_id, $post ) {

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;

	if ( !isset( $_POST['discography_nonce'] ) || !wp_verify_nonce( $_POST['discography_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	$post_type = get_post_type_object( $post->post_type );

	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	update_post_meta($post->ID, "ci_cpt_discography_date", (isset($_POST["ci_cpt_discography_date"]) ? $_POST["ci_cpt_discography_date"] : '') );
	update_post_meta($post->ID, "ci_cpt_discography_label", (isset($_POST["ci_cpt_discography_label"]) ? $_POST["ci_cpt_discography_label"] : '') );
	update_post_meta($post->ID, "ci_cpt_discography_cat_no", (isset($_POST["ci_cpt_discography_cat_no"]) ? $_POST["ci_cpt_discography_cat_no"] : '') );

	update_post_meta($post->ID, "ci_cpt_discography_status", (isset($_POST["ci_cpt_discography_status"]) ? $_POST["ci_cpt_discography_status"] : '') );
	update_post_meta($post->ID, "ci_cpt_discography_purchase_text", (isset($_POST["ci_cpt_discography_purchase_text"]) ? $_POST["ci_cpt_discography_purchase_text"] : '') );
	update_post_meta($post->ID, "ci_cpt_discography_purchase_text_from1", (isset($_POST["ci_cpt_discography_purchase_text_from1"]) ? $_POST["ci_cpt_discography_purchase_text_from1"] : '') );
	update_post_meta($post->ID, "ci_cpt_discography_purchase_text_url1", (isset($_POST["ci_cpt_discography_purchase_text_url1"]) ? $_POST["ci_cpt_discography_purchase_text_url1"] : '') );
	update_post_meta($post->ID, "ci_cpt_discography_purchase_text_from2", (isset($_POST["ci_cpt_discography_purchase_text_from2"]) ? $_POST["ci_cpt_discography_purchase_text_from2"] : '') );
	update_post_meta($post->ID, "ci_cpt_discography_purchase_text_url2", (isset($_POST["ci_cpt_discography_purchase_text_url2"]) ? $_POST["ci_cpt_discography_purchase_text_url2"] : '') );

}
endif;
?>
