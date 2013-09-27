<?php
add_action('init', 'ci_register_theme_scripts');
if( !function_exists('ci_register_theme_scripts') ):
function ci_register_theme_scripts()
{
	//
	// Register all front-end scripts here. There is no need to register them conditionally, as the enqueueing can be conditional.
	//
	
	wp_register_script('jwplayer', get_template_directory_uri().'/jwplayer/jwplayer.js','',false,false);
	wp_register_script('google-maps', 'http://maps.googleapis.com/maps/api/js?v=3.5&sensor=false');
	wp_register_script('jquery-superfish', get_template_directory_uri().'/js/superfish.js', array('jquery'), false, false);
	wp_register_script('jquery-flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'), false, false);
	wp_register_script('jquery-equalheights', get_template_directory_uri().'/js/jquery.equalHeights.js', array('jquery'), false, false);
	wp_register_script('jquery-fitvids', get_template_directory_uri().'/js/jquery.fitvids.js', array('jquery'), false, false);
	wp_register_script('jquery-prettyphoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array('jquery'), false, false);
	wp_register_script('hyphenator', get_template_directory_uri().'/js/hyphenator.js', array('jquery'), false, false);	
	wp_register_script('ci-front-scripts', get_template_directory_uri().'/js/scripts.js',
		array(
			'jquery',
			'jquery-superfish',
			'jquery-flexslider',
			'jquery-equalheights',
			'jquery-fitvids',
			'jquery-prettyphoto',
			'hyphenator'
		),
		false, false);
	
	wp_register_script('modernizr', get_template_directory_uri().'/js/modernizr.js');		
}
endif;

add_action('wp_enqueue_scripts', 'ci_enqueue_theme_scripts');
if( !function_exists('ci_enqueue_theme_scripts') ):
function ci_enqueue_theme_scripts()
{
	//
	// Enqueue all (or most) front-end scripts here.
	// They can be also enqueued from within template files.
	//	
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_enqueue_script('ci-front-scripts');

	$params['theme_url'] = get_template_directory_uri();
	wp_localize_script('ci-front-scripts', 'ThemeOption', $params);

	if (ci_setting('jwplayer_active') == 'enabled') wp_enqueue_script('jwplayer');
	wp_enqueue_script('modernizr');
	wp_enqueue_script('google-maps');	

}
endif;


add_action('wp_header', 'ci_print_html5shim');
if( !function_exists('ci_ci_print_html5shim') ):
function ci_print_html5shim()
{	
	wp_enqueue_script('ci-front-scripts');	
}
endif;


add_action('wp_footer', 'ci_print_selectivizr', 100);
if( !function_exists('ci_print_selectivizr') ):
function ci_print_selectivizr()
{	
	?>
	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/selectivizr-min.js"></script>
	<![endif]-->
	<?php
}
endif;

?>