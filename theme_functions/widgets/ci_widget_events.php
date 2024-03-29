<?php 
/**
 * Recent Events Widgets.
 */
class CI_Events extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'ci_events_widget', // Base ID
			'-= CI Recent Events =-', // Name
			array( 'description' => __( 'Display your recent events', 'ci_theme' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title 		= apply_filters( 'widget_title', $instance['title'] );
		$events_no 	= $instance['events_no'];

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			
			$latest_events = new WP_Query( array( 
				'post_type' => 'cpt_events',
				'meta_key' => 'ci_cpt_events_date',
				'meta_value' => date('Y-m-d'),
				'meta_compare' => '>=',
				'orderby' => 'meta_value',
				'order' => 'asc',
				'posts_per_page' => $events_no
			));				
					
			echo '<ul class="tour-dates">';
			while ( $latest_events->have_posts() ) : $latest_events->the_post();
			global $post;
			$event_date 	= explode("-",get_post_meta($post->ID, 'ci_cpt_events_date', true));
			$event_location = get_post_meta($post->ID, 'ci_cpt_events_location', true);
			$event_venue 	= get_post_meta($post->ID, 'ci_cpt_events_venue', true);
			$event_status 	= get_post_meta($post->ID, 'ci_cpt_events_status', true);
			$event_wording	= get_post_meta($post->ID, 'ci_cpt_events_button', true);
			$event_url		= "#";
			
			switch ($event_status) {
		    case "buy":
		    	if ($event_wording == "") $event_wording 	= __('Buy Tickets','ci_theme'); 
		    	$event_url		= get_post_meta($post->ID, 'ci_cpt_events_tickets', true);
		        break;
		    case "sold":
		    	if ($event_wording == "") $event_wording 	= __('Sold Out','ci_theme'); 
		        break;
		    case "canceled":
		    	if ($event_wording == "") $event_wording 	= __('Canceled','ci_theme'); 
		        break;
			case "watch":
		    	if ($event_wording == "") $event_wording 	= __('Watch Live','ci_theme');
		    	$event_url		= get_post_meta($post->ID, 'ci_cpt_events_live', true); 
		        break;    
		    }
		    
		    ?>
			<li class="group">						
				<p class="tour-date"><span class="day"><?php echo $event_date[2]; ?></span><?php echo themonth($event_date[1]); ?> <span class="year"><?php echo $event_date[0]; ?></span></p>
				<div class="tour-place">
					<span class="sub-head"><?php if ($post->post_content != ""): ?><a href="<?php the_permalink(); ?>"><?php endif; ?><?php echo $event_venue; ?><?php if ($post->post_content != ""): ?></a><?php endif; ?></span>
					<span class="main-head"><?php echo $event_location; ?></span>							
					<?php if ($event_status != ""): ?><a href="<?php echo $event_url; ?>" class="action-btn <?php echo $event_status; ?>"><?php echo $event_wording; ?></a><?php endif; ?>
				</div>
			</li>		    			
			<?php
			endwhile; wp_reset_postdata();
			echo '</ul>';

		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['events_no'] 	= strip_tags( $new_instance['events_no'] );
		return $instance;
	}

	function form($instance){
		$instance 	= wp_parse_args( (array) $instance, array('title'=>'', 'events_no'=>'') );
		$title 		= htmlspecialchars($instance['title']);
		$events_no 	= htmlspecialchars($instance['events_no']);
		echo '<p><label>' . __('Title:','ci_theme') . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" class="widefat" /></p>';
		echo '<p><label>' . __('Events Number:','ci_theme') . '</label><input id="' . $this->get_field_id('events_no') . '" name="' . $this->get_field_name('events_no') . '" type="text" value="' . $events_no . '" class="widefat" /></p>';
	} // form

} // class CI_Events

add_action( 'widgets_init', create_function( '', 'register_widget( "CI_Events" );' ) );
?>