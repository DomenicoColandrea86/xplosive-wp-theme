<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php

	$ci_defaults['bg_custom_disabled']	= 'enabled';
	$ci_defaults['bg_color']			= '';
	$ci_defaults['bg_image_disable']	= '';
	$ci_defaults['bg_image_footer_disable']	= '';
	$ci_defaults['bg_image']			= '';
	$ci_defaults['bg_image_repeat']		= 'repeat';
	$ci_defaults['bg_image_horizontal']	= 'left';
	$ci_defaults['bg_image_vertical']	= 'top';
	$ci_defaults['bg_image_attachment']	= '';

	// 100 is the priority. It's important to be a big number, i.e. low priority.
	// Low priority means it will execute AFTER the other hooks, hence this will override other styles previously set.
	add_action('wp_head', 'ci_custom_background', 100);
	if( !function_exists('ci_custom_background')):
		function ci_custom_background()
		{ ?>
			<?php if (ci_setting('bg_custom_disabled')!='enabled'): ?>
				<style type="text/css">
					<?php
						$custom_bg = array(
							'bg_color' => ci_setting('bg_color'),
							'bg_image' => ci_setting('bg_image'),
							'bg_image_horizontal' => ci_setting('bg_image_horizontal'),
							'bg_image_vertical' => ci_setting('bg_image_vertical'),
							'bg_image_attachment' => ci_setting('bg_image_attachment'),
							'bg_image_repeat' => ci_setting('bg_image_repeat'),
							'bg_image_disable' => ci_setting('bg_image_disable'),
							'bg_image_footer_disable' => ci_setting('bg_image_footer_disable')

						);
						do_action( 'ci_custom_background', apply_filters('ci_custom_background_options', $custom_bg) );
					?>
				</style>
			<?php endif; ?>
			<?php
		}
	endif;

	add_action('ci_custom_background', 'ci_custom_background_handler');
	// Default handler for custom background.
	if( !function_exists('ci_custom_background_handler')):
	function ci_custom_background_handler($options)
	{
		echo apply_filters('ci_custom_background_applied_element', 'body');
		echo '{';
			if ($options['bg_color']) echo 'background-color: #'.$options['bg_color'].';';
		echo '}';

		echo ' #wrap { ';
			if ($options['bg_image_disable'] != 'enabled')
			{
				echo 'background-image: url('.$options['bg_image'].'); ';
				echo ' background-position: '.$options['bg_image_horizontal'].' '.$options['bg_image_vertical'].';';
				if ($options['bg_image_repeat']) echo 'background-repeat: '.$options['bg_image_repeat'].';';
				if ($options['bg_image_disable'] =='enabled') echo 'background-image: none;';
				if ($options['bg_image_attachment'] == 'fixed') echo 'background-attachment: fixed;';
			}
		echo '}';

		echo ' #footer-wrap { ';
			if ($options['bg_image_footer_disable'] == 'enabled')
			{
				echo 'background-image: none; ';
			}
		echo '}';
	}
	endif;
?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('Control whether you want to override the theme\'s background, by enabling the custom background option and tweaking the rest as you please.', 'ci_theme'); ?></p>
		<fieldset>
			<?php $fieldname = 'bg_custom_disabled'; ?>
			<input type="checkbox" class="check toggle-button" id="<?php echo $fieldname; ?>" name="<?php echo THEME_OPTIONS.'['.$fieldname.']'; ?>" value="enabled" <?php checked($ci[$fieldname], 'enabled'); ?> />
			<label for="<?php echo $fieldname; ?>"><?php _e('Disable custom background', 'ci_theme'); ?></label>
		</fieldset>
	</fieldset>

	<div class="toggle-pane">

		<fieldset class="set">
			<p class="guide"><?php _e('You can set the background color of the page here. This option overrides the background color set by the Color Scheme Option above, so leave it empty if you want the default. You may select a color using the color picker (pops up when you click on the input box), or enter its hex number in the input box (without a #).', 'ci_theme'); ?></p>
			<fieldset>
				<?php ci_panel_input('bg_color', __('Background Color', 'ci_theme'));  ?>
			</fieldset>
		</fieldset>

		<fieldset class="set">
			<p class="guide"><?php _e('When this option is checked, the body background image is disabled, whether it\'s set by the default stylesheets or by you, from the option below.', 'ci_theme'); ?></p>
			<fieldset>
				<?php ci_panel_checkbox('bg_image_disable', 'enabled', __('Disable background image', 'ci_theme')); ?>
			</fieldset>
		</fieldset>

		<fieldset class="set">
			<p class="guide"><?php _e('When this option is checked, the footer background image is disabled', 'ci_theme'); ?></p>
			<fieldset>
				<?php ci_panel_checkbox('bg_image_footer_disable', 'enabled', __('Disable footer background image', 'ci_theme')); ?>
			</fieldset>
		</fieldset>

		<fieldset class="set">
			<p class="guide"><?php _e('You can upload an image to use as custom background for your site. You can also choose whether you want the image to repeat.', 'ci_theme'); ?></p>
			<?php ci_panel_upload_image('bg_image', __('Upload your background image', 'ci_theme')); ?>
			<fieldset>
				<?php
					$options = array(
						'no-repeat'	=> __('No Repeat', 'ci_theme'),
						'repeat' 	=> __('Repeat', 'ci_theme'),
						'repeat-x' 	=> __('Repeat X', 'ci_theme'),
						'repeat-y' 	=> __('Repeat Y', 'ci_theme')
					);
					ci_panel_dropdown('bg_image_repeat', $options, __('Repeat background', 'ci_theme'));
				?>
			</fieldset>
		</fieldset>

		<fieldset class="set">
			<p class="guide"><?php _e('You can select the placement of your image in the background.', 'ci_theme'); ?></p>
			<fieldset>
				<?php
					$options = array(
						'left'		=> __('Left', 'ci_theme'),
						'center'	=> __('Center', 'ci_theme'),
						'right'		=> __('Right', 'ci_theme')
					);
					ci_panel_dropdown('bg_image_horizontal', $options, __('Background Horizontal Placement', 'ci_theme'));
				?>
			</fieldset>

			<fieldset>
				<?php
					$options = array(
						'top'		=> __('Top', 'ci_theme'),
						'center'	=> __('Center', 'ci_theme'),
						'bottom'		=> __('Bottom', 'ci_theme')
					);
					ci_panel_dropdown('bg_image_vertical', $options, __('Background Vertical Placement', 'ci_theme'));
				?>
			</fieldset>
		</fieldset>

		<fieldset class="set">
			<p class="guide"><?php _e('When the fixed background option is checked, the background image will not scroll along with the rest of the page.', 'ci_theme'); ?></p>
			<fieldset>
				<?php ci_panel_checkbox('bg_image_attachment', 'fixed', __('Fixed background', 'ci_theme')); ?>
			</fieldset>
		</fieldset>

	</div>

<?php endif; ?>
