<?php
/*
Template Name: Videos
*/
?>

<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row">
	<div class="sixteen columns">				
		
		<ol class="listing group">		
			<?php								
				$i = 1;
				if ( have_posts() ) : while ( have_posts() ) : the_post();	
				$video_url 	= get_post_meta($post->ID, 'ci_cpt_videos_url', true);
				$video_type = get_post_meta($post->ID, 'ci_cpt_videos_self', true);			
	
			?>		
			<li class="<?php echo ci_column_classes(ci_setting('archive_tpl')); ?> columns">
				<div class="latest-item latest-video">
					<a href="<?php
								 if ($video_type == 1):
								  echo "#player" . $i . "-wrap";
								 else:
								  echo $video_url;
								 endif; ?>" data-rel="prettyPhoto">
						<?php
							$attr = array('class'=> "scale-with-grid");
							the_post_thumbnail('ci_media', $attr);
						?>
						<span></span>
					</a>	
					<p class="album-info">
						<span class="sub-head"><?php the_title(); ?></span>
					</p>
					<?php if ($video_type == 1): ?>
					<div id="player<?php echo $i; ?>-wrap" class="video-player">
						<div id="player<?php echo $i; ?>">Loading the player ...</div>
						<script type="text/javascript">
							jwplayer('player<?php echo $i; ?>').setup({
								autostart: false,
								file: "<?php echo $video_url; ?>",
								width:"500",
								flashplayer: "<?php echo get_template_directory_uri() . "/jwplayer/player.swf" ?>"
							});												
						</script>
					</div><!-- /player-wrapp -->																			
					<?php endif; ?>	
				</div><!-- /latest-album -->
			</li>
			<?php $i++; endwhile; endif; ?>
		</ol><!-- /discography -->
		<?php ci_pagination(); ?>
		
	</div><!-- /sixteen columns -->
</div><!-- /row -->		

<?php get_footer(); ?>