<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php

	$ci_defaults['favicon'] = get_template_directory_uri().'/panel/ci_panel/img/favicon.ico';


	add_action('wp_head', 'ci_favicon');
	if( !function_exists('ci_favicon') ):
		function ci_favicon()
		{
			if(ci_setting('favicon')): 
				?><link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_attr(ci_setting('favicon')); ?>" /><?php 
			endif;
		}
	endif;

?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('Here you can upload your favicon. The favicon is a small, 16x16 icon that appears besides your URL in the address bar, in open tabs and/or in bookmarks. We recommend you create your favicon from an existing square image, using appropriate online services such as http://tools.dynamicdrive.com/favicon/ and http://www.favicon.cc/', 'ci_theme'); ?></p>
		<?php ci_panel_upload_image('favicon', __('Upload your favicon', 'ci_theme')); ?>
	</fieldset>
	
<?php endif; ?>