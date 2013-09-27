<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_color_options', 40);
	if( !function_exists('ci_add_tab_color_options') ):
		function ci_add_tab_color_options($tabs)
		{
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Color Options', 'xplosive');
			return $tabs;
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );

	$ci_defaults['ci_stylesheet'] = 'default';

	load_panel_snippet('custom_background');

?>
<?php else: ?>

		<fieldset class="set">
			<p class="guide"><?php _e('Select your color scheme', 'xplosive'); ?></p>
			<fieldset>
				<?php
					$options = array(
						'default'	=> __('Default', 'xplosive'),
						'purple' 	=> __('Purple', 'xplosive'),
						'purple2' 	=> __('Purple 2', 'xplosive'),
						'blue' 		=> __('Blue', 'xplosive'),
						'green' 	=> __('Green', 'xplosive'),
						'orange' 	=> __('Orange', 'xplosive'),
						'cream' 	=> __('Cream', 'xplosive')
					);
					ci_panel_dropdown('ci_stylesheet', $options, __('Default', 'ci_theme'));
				?>
			</fieldset>
		</fieldset>

	<?php load_panel_snippet('custom_background'); ?>

<?php endif; ?>
