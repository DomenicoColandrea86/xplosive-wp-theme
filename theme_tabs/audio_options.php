<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_audio_options', 30);
	if( !function_exists('ci_add_tab_audio_options') ):
		function ci_add_tab_audio_options($tabs)
		{
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Audio Options', 'xplosive');
			return $tabs;
		}
	endif;

	$ci_defaults['jwplayer_active']			= 'disabled';
	$ci_defaults['archive_tpl'] 			= 'wsidebar';


?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('If you want to use the JWPlayer you need to go to http://www.longtailvideo.com/players/jw-flv-player/ and download the player. Unzip and place the contents in a folder called jwplayer inside the theme folder. (/wp_xplosive5/jwplayer). Then activate this option. Refer to documentation on how to use it.', 'xplosive'); ?></p>
		<?php ci_panel_checkbox('jwplayer_active', 'enabled', __('Activate JWPlayer', 'xplosive')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('If you want to use the SoundCloud shortcode you need to download and install the plugin http://wordpress.org/extend/plugins/soundcloud-shortcode Refer to documentation on how to use it.', 'xplosive'); ?></p>
	</fieldset>



<?php endif; ?>
