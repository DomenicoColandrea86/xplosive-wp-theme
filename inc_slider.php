<?php
 if (ci_setting('slider_show') == 'enabled'): ?>
<!-- ########################### SLIDER ########################### -->
<div class="container slider">
	<div class="sixteen columns">
		
		<div class="flexslider">
		  <ul class="slides">
		    
		    <?php 
				$slider_no = ci_setting('slider-no');
				
				global $post;
				$slider = new WP_Query( array( 
					'post_type' => 'cpt_slider', 
					'posts_per_page' => $slider_no
				)); 
				
				while ( $slider->have_posts() ) : $slider->the_post();
				$img_id = false;
				$img_url = '';
				$img_id = get_post_thumbnail_id($post->ID);
				$img_info = wp_get_attachment_image_src($img_id, 'ci_home_slider');
				$img_url = $img_info[0];

				if(!empty($img_url)):
			?>
				<li>
					<?php $slider_link = get_post_meta($post->ID, 'ci_cpt_slider_url', true);?>
					<a href="<?php echo $slider_link; ?>">
					  <img src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>" />
					  <div class="slide-text">
					  	<h2><?php the_title(); ?></h2>
					  </div>
					</a>
			    </li>
			<?php endif; endwhile; ?>
			<?php wp_reset_postdata(); ?>
		    
		  </ul>
		</div>
		
	</div><!-- /sixteen columns -->
</div><!-- /slider -->
<?php endif; ?>