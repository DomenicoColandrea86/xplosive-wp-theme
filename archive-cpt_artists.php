<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row">
	<div class="sixteen columns">

		<ol class="listing group">
			<?php
				if ( have_posts() ) : while ( have_posts() ) : the_post();
			?>

			<li class="<?php echo ci_column_classes(ci_setting('archive_tpl')); ?> columns">
				<div class="latest-item">
					<a href="<?php the_permalink(); ?>">
						<?php
							$attr = array('class'=> "scale-with-grid");
							the_post_thumbnail('ci_discography', $attr);
						?>
					</a>
					<p class="album-info">
						<span class="main-head"><?php the_title(); ?></span>
						<span class="album-actions">
							<a href="<?php the_permalink(); ?>" class="action-btn buy"><?php _e('Learn more','xplosive'); ?></a>
						</span>
					</p>
				</div><!-- /latest-album -->
			</li>

			<?php endwhile; endif; ?>
		</ol><!-- /discography -->
		<?php ci_pagination(); ?>

	</div><!-- /sixteen columns -->
</div><!-- /row -->

<?php get_footer(); ?>
