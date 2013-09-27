<?php
	get_template_part('panel/functions/constants');

	load_theme_textdomain( 'xplosive', get_template_directory() . '/lang' );

	// This is the main options array. Can be accessed as a global in order to reduce function calls.
	$ci = get_option(THEME_OPTIONS);
	$ci_defaults = array();

	// The $content_width needs to be before the inclusion of the rest of the files, as it is used inside of some of them.
	if ( ! isset( $content_width ) ) $content_width = 640;

	//
	// Let's bootstrap the theme.
	//
	get_template_part('panel/functions/bootstrap');
	get_template_part('theme_functions/shortcodes');


	//
	// Define our various image sizes.
	//
	add_theme_support( 'post-thumbnails' );
	add_image_size('ci_home_slider', 940, 470, true);
	add_image_size('ci_home_listing_short', 460, 300, true);
	add_image_size('ci_home_listing_long', 700, 457, true);
	add_image_size('ci_discography', 438, 438, true);
	add_image_size('ci_event', 438, 9999, false);
	add_image_size('ci_media', 438, 246, true);
	add_image_size('ci_fullwidth', 940, 400, true);

	//
	// Columns helper
	//
	function ci_column_classes($cols_number, $reset=false) {
	  static $i = 1;

	  if($reset) {
	    $i = 1;
	    return;
	  }

	  $cols = array(
	    2 => 'eight',
	    3 => 'one-third',
	    4 => 'four',
	    8 => 'two'
	  );

	  $classes = $cols[$cols_number].' ';

	  if ( $i == 1 || $i%$cols_number == 1 ) $classes .= 'alpha';
	  if ( $i == $cols_number || $i%$cols_number == 0 ) $classes .= 'omega';

	  $i++;
	  return $classes;
	}

	//
	// Date helper
	//
	function themonth($m) {
		$t = mktime(0, 0, 0, $m, 1, 2000);
		return date("M", $t);
	}
?>
