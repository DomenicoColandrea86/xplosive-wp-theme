<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row">
	<div class="sixteen columns">				
		
		<ol class="listing group">		
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

				$args = array( 'post_type' => 'attachment', 'posts_per_page' => -1, 'post_status' => 'inherit', 'post_parent' => $post->ID, 'order' => 'ASC', 'orderby' => 'menu_order');
				$attachments = new WP_Query($args);
				while ( $attachments->have_posts() ) : $attachments->the_post();				
					$attr = array(
						'alt'   => trim(strip_tags( get_post_meta($post->ID, '_wp_attachment_image_alt', true) )),
						'title' => trim(strip_tags( $post->post_title )),
						'class'	=> 'scale-with-grid'
					);
					$img_attrs = wp_get_attachment_image_src( $post->ID, 'ci_media' );													
					$img_attrf = wp_get_attachment_image_src( $post->ID, 'large' );
					echo '<li class="' . ci_column_classes(ci_setting('archive_tpl')) . ' columns"><div class="latest-item gallery-item">';
					echo '<a href="'. $img_attrf[0] .'" rel="'.$img_attrs[0].'" title="" data-rel="prettyPhoto[pp_gal]">'. wp_get_attachment_image( $post->ID, 'ci_media', false, $attr ).'</a>';
					echo '<p class="album-info"><span class="main-head">';
					echo $post->post_title;
					echo '</span></p></div></li>';
				endwhile;
			
			endwhile; endif; ?>
		</ol><!-- /discography -->
		<?php ci_pagination(); ?>
		
	</div><!-- /sixteen columns -->
</div><!-- /row -->		

<?php get_footer(); ?>