<?php
/*
Template Name: Homepage (Sidebar #1 / Content)
*/
?>

<?php get_header(); ?>
<?php get_template_part('inc_slider'); ?>


<!-- ########################### MAIN ########################### -->
	<div class="row">
		<div class="sixteen columns">

			<aside class="four columns sidebar alpha">
				<?php dynamic_sidebar('homepage-sidebar-one'); ?>
			</aside><!-- /sidebar -->

			<div class="twelve columns omega content">

				<h3 class="widget-title">News</h3>
				<?php
				$news = new WP_Query( array(
					'post_type' => 'post',
					'posts_per_page' => ci_setting('news-no'),
					'cat' => ci_setting('news-cat')
				));
				while ( $news->have_posts() ) : $news->the_post(); ?>
				<article class="post group">
					<div class="post-intro">
						<?php
							$attr = array('class'=> "scale-with-grid");
							the_post_thumbnail('ci_home_listing_long', $attr);
						?>
						<h2><a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to', 'xplosive').' '.esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h2>
					</div><!-- /intro -->
					<div class="post-body">
						<p class="meta"><time class="post-date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></time> <span class="bull">&bull;</span> <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></p>
						<?php the_excerpt(); ?>
					</div>
				</article><!-- /post -->
				<?php endwhile; wp_reset_postdata();  ?>
			</div>

		</div><!-- /sixteen columns -->
	</div><!-- /row -->

<?php get_footer(); ?>
