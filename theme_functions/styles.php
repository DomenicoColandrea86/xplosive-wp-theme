<?php
add_action('init', 'ci_register_theme_styles');
if( !function_exists('ci_register_theme_styles') ):
function ci_register_theme_styles()
{
	//
	// Register all front-end styles here. There is no need to register them conditionally, as the enqueueing can be conditional.
	//
	wp_register_style('google-font-lato', 'http://fonts.googleapis.com/css?family=Lato:400,900,400italic');
	wp_register_style('ci-skeleton', get_template_directory_uri().'/css/skeleton.css');
	wp_register_style('flexslider', get_template_directory_uri().'/css/flexslider.css');
	wp_register_style('mediaqueries', get_template_directory_uri().'/css/mediaqueries.css');	
	wp_register_style('ci-style', get_bloginfo('stylesheet_url'), 
		array(
			'google-font-lato',
			'ci-skeleton'
		), CI_THEME_VERSION, 'screen');
		
	wp_register_style('default', get_template_directory_uri().'/colors/'. ci_setting('ci_stylesheet') .'.css');	
}
endif;


add_action('wp_enqueue_scripts', 'ci_enqueue_theme_styles');
if( !function_exists('ci_enqueue_theme_styles') ):
function ci_enqueue_theme_styles()
{
	//
	// Enqueue all (or most) front-end styles here.
	//	
	wp_enqueue_style('ci-style');
	if (ci_setting('responsive') == 'enabled') {
		wp_enqueue_style('mediaqueries');	
	}	
	wp_enqueue_style('flexslider');	
	wp_enqueue_style('default');	
}
endif;

?>