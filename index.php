<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row">
	<div class="sixteen columns">
		<div class="twelve columns content alpha">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<article <?php post_class(''); ?>>
					<div class="post-intro">
						<?php the_post_thumbnail('ci_home_listing_long', array('class' => 'scale-with-grid')); ?>
						<h2><a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to', 'xplosive').' '.esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h2>
					</div><!-- /intro -->
					<div class="post-body hyphenate">
						<p class="meta"><time class="post-date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></time> <span class="bull">&bull;</span> <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></p>
						<?php the_excerpt(); ?>
					</div>
				</article><!-- /article -->

			<?php endwhile; endif; ?>
			<?php ci_pagination(); ?>
		</div><!-- /twelve columns -->
		<aside class="four columns omega sidebar">
			<?php dynamic_sidebar('blog-sidebar'); ?>
		</aside><!-- /sidebar -->
	</div><!-- /sixteen columns -->
</div><!-- /row -->

<?php get_footer(); ?>
