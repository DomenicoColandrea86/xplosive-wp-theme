<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_display_options', 30);
	if( !function_exists('ci_add_tab_display_options') ):
		function ci_add_tab_display_options($tabs)
		{
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Display Options', 'xplosive');
			return $tabs;
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	load_panel_snippet('excerpt');
	load_panel_snippet('seo');
	load_panel_snippet('comments');

	$ci_defaults['responsive']				= 'enabled';
	$ci_defaults['featured_single_show']	= 'enabled';
	$ci_defaults['archive_tpl'] 			= 'archive_tpl_fourcol';
	$ci_defaults['events_map_show']			= 'enabled';
	$ci_defaults['events_past']				= 'enabled';

?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('Control whether you want the theme to be responsive or not.', 'xplosive'); ?></p>
		<?php ci_panel_checkbox('responsive', 'enabled', __('Enable responsive styles', 'xplosive')); ?>
	</fieldset>

	<?php load_panel_snippet('excerpt'); ?>

	<?php load_panel_snippet('seo'); ?>

	<?php load_panel_snippet('comments'); ?>


	<fieldset class="set">
		<p class="guide"><?php _e('Control whether you want the featured image of each post to be displayed when viewing that post\'s page.', 'xplosive'); ?></p>
		<?php ci_panel_checkbox('featured_single_show', 'enabled', __('Show featured images on posts / pages', 'xplosive')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Select the template for the archive templates of Discography, Videos and Photo Galleries listing pages.', 'xplosive'); ?></p>
		<?php ci_panel_radio('archive_tpl', 'archive_tpl_threecol', '3', __('3 Columns (Fullwidth)', 'xplosive')); ?>
		<?php ci_panel_radio('archive_tpl', 'archive_tpl_fourcol', '4', __('4 Columns (Fullwidth)', 'xplosive')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Control whether you want the events map to be displayed when viewing the Events page.', 'xplosive'); ?></p>
		<?php ci_panel_checkbox('events_map_show', 'enabled', __('Show events map', 'xplosive')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Control whether you want the past events to be displayed when viewing the Events page.', 'xplosive'); ?></p>
		<?php ci_panel_checkbox('events_past', 'enabled', __('Show past events', 'xplosive')); ?>
	</fieldset>

<?php endif; ?>
