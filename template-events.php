<?php
/*
Template Name: Events
*/
?>

<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row">
	<div class="sixteen columns">

		<div class="twelve columns content events alpha">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


				<?php if (ci_setting('events_map_show') == 'enabled'): ?>
				<h3 class="widget-title"><?php _e('Event Map', 'xplosive'); ?></h3>
				<div id="map"></div>

				<?php
				$map_events = new WP_Query( array(
						'post_type' => 'cpt_events',
						'meta_key' => 'ci_cpt_events_date',
						'meta_value' => date('Y-m-d'),
						'meta_compare' => '>',
						'orderby' => 'meta_value',
						'order' => 'asc',
						'posts_per_page' => -1
					));
				?>

				<script type="text/javascript">
					var locations = [
						<?php
		  				while ( $map_events->have_posts() ) : $map_events->the_post();
						$map_date 		= explode("-",get_post_meta($post->ID, 'ci_cpt_events_date', true));
						$map_location 	= get_post_meta($post->ID, 'ci_cpt_events_location', true);
						$map_venue 		= get_post_meta($post->ID, 'ci_cpt_events_venue', true);
						$map_status 	= get_post_meta($post->ID, 'ci_cpt_events_status', true);
						$map_lat	 	= get_post_meta($post->ID, 'ci_cpt_events_lat', true);
						$map_lon	 	= get_post_meta($post->ID, 'ci_cpt_events_lon', true);
						$map_wording	= get_post_meta($post->ID, 'ci_cpt_events_button', true);
						$map_url		= "#";

						switch ($map_status) {
					    case "buy":
					    	if ($map_wording == "") $map_wording 	= __('Buy Tickets','xplosive');
					    	$map_url		= get_post_meta($post->ID, 'ci_cpt_events_tickets', true);
					        break;
					    case "sold":
					    	if ($map_wording == "") $map_wording 	= __('Sold Out','xplosive');
					        break;
					    case "canceled":
					    	if ($map_wording == "") $map_wording 	= __('Canceled','xplosive');
					        break;
   					    case "watch":
					    	if ($map_wording == "") $map_wording 	= __('Watch Live','xplosive');
					    	$map_url		= get_post_meta($post->ID, 'ci_cpt_events_live', true);
					        break;
					    }

						?>
						['<h3><?php echo $map_venue; ?></h3><h4><?php echo $map_location; ?></h4><p><?php echo $map_date[2] . "-" . themonth($map_date[1]) . "-" . $map_date[0]; ?></p><a href="<?php echo $map_url; ?>"><?php echo $map_wording; ?></a><p><?php  ?></p>', <?php echo $map_lat; ?>, <?php echo $map_lon; ?>],
						<?php endwhile; wp_reset_postdata(); ?>
					];

					var map = new google.maps.Map(document.getElementById('map'), {
					  zoom: 2,
					  center: new google.maps.LatLng(0, 0),
					  mapTypeId: google.maps.MapTypeId.ROADMAP
					});

					var infowindow = new google.maps.InfoWindow();

					var marker, i;

					for (i = 0; i < locations.length; i++) {
					  marker = new google.maps.Marker({
					    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					    map: map
					  });

					  google.maps.event.addListener(marker, 'click', (function(marker, i) {
					    return function() {
					      infowindow.setContent(locations[i][0]);
					      infowindow.open(map, marker);
					    }
					  })(marker, i));
					}
				</script>
				<?php endif; ?>

				<h3 class="widget-title"><?php _e('Upcoming Events', 'xplosive'); ?></h3>
				<ul class="tour-dates current-dates">
					<?php

					global $post;
					$future_events = new WP_Query( array(
						'post_type' => 'cpt_events',
						'meta_key' => 'ci_cpt_events_date',
						'meta_value' => date('Y-m-d'),
						'meta_compare' => '>=',
						'orderby' => 'meta_value',
						'order' => 'asc',
						'posts_per_page' => -1
					));

					while ( $future_events->have_posts() ) : $future_events->the_post();
						$event_date 	= explode("-",get_post_meta($post->ID, 'ci_cpt_events_date', true));
						$event_location = get_post_meta($post->ID, 'ci_cpt_events_location', true);
						$event_venue 	= get_post_meta($post->ID, 'ci_cpt_events_venue', true);
						$event_status 	= get_post_meta($post->ID, 'ci_cpt_events_status', true);
						$event_wording	= get_post_meta($post->ID, 'ci_cpt_events_button', true);
						$event_url		= "#";

						switch ($event_status) {
					    case "buy":
					    	if ($event_wording == "") $event_wording 	= __('Buy Tickets','xplosive');
					    	$event_url		= get_post_meta($post->ID, 'ci_cpt_events_tickets', true);
					        break;
					    case "sold":
					    	if ($event_wording == "") $event_wording 	= __('Sold Out','xplosive');
					        break;
					    case "canceled":
					    	if ($event_wording == "") $event_wording 	= __('Canceled','xplosive');
					        break;
   					    case "watch":
					    	if ($event_wording == "") $event_wording 	= __('Watch Live','xplosive');
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
					<?php endwhile; wp_reset_postdata(); ?>
				</ul><!-- /tour-dates -->

				<?php if (ci_setting('events_past') == 'enabled'): ?>
				<h3 class="widget-title"><?php _e('Past Events', 'xplosive'); ?></h3>
				<ul class="tour-dates current-dates">
					<?php

					$old_events = new WP_Query( array(
						'post_type' => 'cpt_events',
						'meta_key' => 'ci_cpt_events_date',
						'meta_value' => date('Y-m-d'),
						'meta_compare' => '<',
						'orderby' => 'meta_value',
						'order' => 'asc',
						'posts_per_page' => -1
					));


					while ( $old_events->have_posts() ) : $old_events->the_post();
						$event_date 	= explode("-",get_post_meta($post->ID, 'ci_cpt_events_date', true));
						$event_location = get_post_meta($post->ID, 'ci_cpt_events_location', true);
						$event_venue 	= get_post_meta($post->ID, 'ci_cpt_events_venue', true);
						$event_status 	= get_post_meta($post->ID, 'ci_cpt_events_status', true);
						$event_wording	= get_post_meta($post->ID, 'ci_cpt_events_button', true);
						$event_url		= "#";

						switch ($event_status) {
					    case "buy":
					    	if ($event_wording == "") $event_wording 	= __('Buy Tickets','xplosive');
					    	$event_url		= get_post_meta($post->ID, 'ci_cpt_events_tickets', true);
					        break;
					    case "sold":
					    	if ($event_wording == "") $event_wording 	= __('Sold Out','xplosive');
					        break;
					    case "canceled":
					    	if ($event_wording == "") $event_wording 	= __('Canceled','xplosive');
					        break;
   					    case "watch":
					    	if ($event_wording == "") $event_wording 	= __('Watch Live','xplosive');
					    	$event_url		= get_post_meta($post->ID, 'ci_cpt_events_live', true);
					        break;
					    }
					?>
					<li class="group">
						<p class="tour-date"><span class="day"><?php echo $event_date[2]; ?></span><?php echo themonth($event_date[1]); ?> <span class="year"><?php echo $event_date[0]; ?></span></p>
						<div class="tour-place">
							<span class="sub-head"><a href="<?php the_permalink(); ?>"><?php echo $event_venue; ?></a></span>
							<span class="main-head"><?php echo $event_location; ?></span>
							<a href="<?php echo $event_url; ?>" class="action-btn <?php echo $event_status; ?>"><?php echo $event_wording; ?></a>
						</div>
					</li>
					<?php endwhile; wp_reset_postdata();  ?>
				</ul><!-- /tour-dates -->
				<?php endif; ?>

			<?php endwhile; endif; ?>

		</div><!-- /twelve columns -->

		<aside class="four columns sidebar omega">
			<?php dynamic_sidebar('events-sidebar'); ?>
		</aside><!-- /sidebar -->

	</div><!-- /sixteen columns -->
</div><!-- /row -->

<?php get_footer(); ?>
