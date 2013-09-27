<?php
//
// events post type related functions.
//

add_action( 'init', 'ci_create_cpt_events' );
if( !function_exists('ci_create_cpt_events') ):
function ci_create_cpt_events()
{
	$labels = array(
		'name' => _x('Events', 'post type general name', 'xplosive'),
		'singular_name' => _x('Events Item', 'post type singular name', 'xplosive'),
		'add_new' => __('New Events Item', 'xplosive'),
		'add_new_item' => __('Add New Events Item', 'xplosive'),
		'edit_item' => __('Edit Events Item', 'xplosive'),
		'new_item' => __('New Events Item', 'xplosive'),
		'view_item' => __('View Events Item', 'xplosive'),
		'search_items' => __('Search Events Items', 'xplosive'),
		'not_found' =>  __('No Events Items found', 'xplosive'),
		'not_found_in_trash' => __('No Events Items found in the trash', 'xplosive'),
		'parent_item_colon' => __('Parent Events Item:', 'xplosive')
	);

	$args = array(
		'labels' => $labels,
		'singular_label' => __('Events Item', 'xplosive'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => false,
		'rewrite' => array('slug' => 'events'),
		'menu_position' => 5,
		'supports' => array('title', 'editor', 'thumbnail')
	);

	register_post_type( 'cpt_events' , $args );

}
endif;

add_action( 'load-post.php', 'events_meta_boxes_setup' );
add_action( 'load-post-new.php', 'events_meta_boxes_setup' );

if( !function_exists('events_meta_boxes_setup') ):
function events_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'events_add_meta_boxes' );
	add_action( 'save_post', 'events_save_meta', 10, 2 );
}
endif;

if( !function_exists('events_add_meta_boxes') ):
function events_add_meta_boxes() {
	add_meta_box(
		'events-box',
		esc_html__( 'Events Settings', 'xplosive' ),
		'events_score_meta_box',
		'cpt_events',
		'normal',
		'default'
	);
}
endif;

if( !function_exists('events_score_meta_box') ):
function events_score_meta_box( $object, $box ) { ?>
	<?php wp_nonce_field( basename( __FILE__ ), 'events_nonce' ); ?>
	<div class="postbox" style="margin-top:20px">
		<h3><?php _e('Event details', 'xplosive'); ?></h3>
		<div class="inside">
			<p>
				<label for="ci_cpt_events_venue"><?php _e( 'Event Venue. For example: Ushuaia', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_events_venue" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_events_venue', true ) ); ?>" size="30" style="width:90%;" />
			</p>
			<p>
				<label for="ci_cpt_events_location"><?php _e( 'Event Location. For example: Ibiza, Spain', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_events_location" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_events_location', true ) ); ?>" size="30" style="width:90%;" />
			</p>
			<p>
				<label for="ci_cpt_events_date"><?php _e( 'Event Date. Use the Date Picker (Click inside the field).', 'xplosive' ); ?></label><br>
				<input type="text" id="ci_cpt_events_date" name="ci_cpt_events_date" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_events_date', true ) ); ?>" size="30" style="width:90%;" />
			</p>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$( "#ci_cpt_events_date" ).datepicker({
						dateFormat: 'yy-mm-dd',
					});
				});
			</script>
		</div><!-- /inside -->
	</div><!-- /postbox -->

	<div class="postbox" style="margin-top:20px">
		<h3><?php _e('Event status', 'xplosive'); ?></h3>
		<div class="inside">
			<p>
				<label for="ci_cpt_events_status"><?php _e( 'Select the event status.', 'xplosive' ); ?></label><br>
				<select name="ci_cpt_events_status">
					<option value="" <?php if ('' == esc_attr( get_post_meta( $object->ID, 'ci_cpt_events_status', true ) )): ?>selected="selected"<?php endif; ?>>&nbsp;</option>
					<option value="buy" <?php if ('buy' == esc_attr( get_post_meta( $object->ID, 'ci_cpt_events_status', true ) )): ?>selected="selected"<?php endif; ?>><?php _e('Tickets Available','xplosive'); ?></option>
					<option value="sold" <?php if ('sold' == esc_attr( get_post_meta( $object->ID, 'ci_cpt_events_status', true ) )): ?>selected="selected"<?php endif; ?>><?php _e('Sold Out','xplosive'); ?></option>
					<option value="canceled" <?php if ('canceled' == esc_attr( get_post_meta( $object->ID, 'ci_cpt_events_status', true ) )): ?>selected="selected"<?php endif; ?>><?php _e('Canceled','xplosive'); ?></option>
					<option value="watch" <?php if ('watch' == esc_attr( get_post_meta( $object->ID, 'ci_cpt_events_status', true ) )): ?>selected="selected"<?php endif; ?>><?php _e('Watch Live','xplosive'); ?></option>
				</select>
			</p>
			<p>
				<label for="ci_cpt_events_button"><?php _e( 'Set the button text like "Buy now" or "Join us" etc', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_events_button" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_events_button', true ) ); ?>" size="30" style="width:90%;" />
			</p>
			<p>
				<label for="ci_cpt_events_tickets"><?php _e( 'If the event is still available enter the URL where someone can buy tickets.', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_events_tickets" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_events_tickets', true ) ); ?>" size="30" style="width:90%;" />
			</p>
			<p>
				<label for="ci_cpt_events_live"><?php _e( 'Is there a live streaming available from the event? Enter it here.', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_events_live" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_events_live', true ) ); ?>" size="30" style="width:90%;" />
			</p>
		</div><!-- /inside -->
	</div><!-- /postbox -->

	<div class="postbox" style="margin-top:20px">
		<h3><?php _e('Event Map', 'xplosive'); ?></h3>
		<div class="inside">
			<p>
				<label for="ci_cpt_events_lat"><?php _e( 'Location Latitude. You can find the coordinates of a location at http://www.getlatlon.com', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_events_lat" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_events_lat', true ) ); ?>" size="30" style="width:90%;" />
			</p>
			<p>
				<label for="ci_cpt_events_lon"><?php _e( 'Location Longtitude.', 'xplosive' ); ?></label><br>
				<input type="text" name="ci_cpt_events_lon" value="<?php echo esc_attr( get_post_meta( $object->ID, 'ci_cpt_events_lon', true ) ); ?>" size="30" style="width:90%;" />
			</p>
		</div><!-- /inside -->
	</div><!-- /postbox -->
	<?php
}
endif;

add_action( 'save_post', 'events_save_meta', 10, 2 );

if( !function_exists('events_save_meta') ):
function events_save_meta( $post_id, $post ) {

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;

	if ( !isset( $_POST['events_nonce'] ) || !wp_verify_nonce( $_POST['events_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	$post_type = get_post_type_object( $post->post_type );

	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	update_post_meta($post->ID, "ci_cpt_events_venue", (isset($_POST["ci_cpt_events_venue"]) ? $_POST["ci_cpt_events_venue"] : '') );
	update_post_meta($post->ID, "ci_cpt_events_location", (isset($_POST["ci_cpt_events_location"]) ? $_POST["ci_cpt_events_location"] : '') );
	update_post_meta($post->ID, "ci_cpt_events_date", (isset($_POST["ci_cpt_events_date"]) ? $_POST["ci_cpt_events_date"] : '') );
	update_post_meta($post->ID, "ci_cpt_events_status", (isset($_POST["ci_cpt_events_status"]) ? $_POST["ci_cpt_events_status"] : '') );
	update_post_meta($post->ID, "ci_cpt_events_tickets", (isset($_POST["ci_cpt_events_tickets"]) ? $_POST["ci_cpt_events_tickets"] : '') );
	update_post_meta($post->ID, "ci_cpt_events_button", (isset($_POST["ci_cpt_events_button"]) ? $_POST["ci_cpt_events_button"] : '') );
	update_post_meta($post->ID, "ci_cpt_events_live", (isset($_POST["ci_cpt_events_live"]) ? $_POST["ci_cpt_events_live"] : '') );
	update_post_meta($post->ID, "ci_cpt_events_lon", (isset($_POST["ci_cpt_events_lon"]) ? $_POST["ci_cpt_events_lon"] : '') );
	update_post_meta($post->ID, "ci_cpt_events_lat", (isset($_POST["ci_cpt_events_lat"]) ? $_POST["ci_cpt_events_lat"] : '') );
}
endif;

//
// Event post type custom admin list
//
	add_filter("manage_edit-events_columns", "ci_cpt_event_edit_columns");
	add_action("manage_posts_custom_column",  "ci_cpt_event_custom_columns");

	function ci_cpt_event_edit_columns($columns)
	{
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __('Event Name', 'xplosive'),
			"event_location" => __("Event location", 'xplosive'),
			"event_date" => __("Event Date", 'xplosive'),
			"date" => __("Date", 'xplosive')
		);

		return $columns;
	}

	function ci_cpt_event_custom_columns($column)
	{
		global $post;
		$custom = get_post_custom();
		switch ($column)
		{
			case "event_location":
				echo get_post_meta($post->ID, 'ci_cpt_events_location', true);
				break;
			case "event_date":
				echo get_post_meta($post->ID, 'ci_cpt_events_date', true);
				break;

		}
	}
?>
