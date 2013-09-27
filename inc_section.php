<?php if ( is_page() ) : ?>
	<h3 class="section-title"><?php single_post_title(); ?></h3>
<?php elseif ( is_single() and ( get_post_type() == 'post' ) or get_post_type() == 'post' ): ?>
	<h3 class="section-title"><?php _e('From the blog', 'xplosive'); ?></h3>
<?php elseif ( is_single() and ( get_post_type() == 'cpt_discography' ) or is_post_type_archive('cpt_discography') ): ?>
	<h3 class="section-title"><?php _e('Discography', 'xplosive'); ?></h3>
<?php elseif ( is_single() and ( get_post_type() == 'cpt_artists' ) or is_post_type_archive('cpt_artists') ): ?>
	<h3 class="section-title"><?php _e('Artists', 'xplosive'); ?></h3>
<?php elseif ( is_post_type_archive('cpt_galleries') ): ?>
	<h3 class="section-title"><?php _e('Photo Galleries', 'xplosive'); ?></h3>
<?php elseif ( is_post_type_archive('cpt_videos') ): ?>
	<h3 class="section-title"><?php _e('Videos', 'xplosive'); ?></h3>
<?php elseif ( is_single() and ( get_post_type() == 'cpt_galleries') ): ?>
	<h3 class="section-title"><?php single_post_title(); ?></h3>
<?php elseif ( is_single() and ( get_post_type() == 'cpt_events') ): ?>
	<h3 class="section-title"><?php _e('Events', 'xplosive'); ?></h3>
<?php elseif ( is_category()): ?>
	<h3 class="section-title"><?php single_term_title(); ?></h3>
<?php elseif ( is_month()): ?>
	<h3 class="section-title"><?php single_month_title(); ?></h3>
<?php elseif ( is_search() ): ?>
	<h3 class="section-title"><?php _e('Search Results', 'xplosive'); ?></h3>
<?php elseif ( is_404() ): ?>
	<h3 class="section-title"><?php _e('Oops! 404', 'xplosive'); ?></h3>
<?php endif; ?>
