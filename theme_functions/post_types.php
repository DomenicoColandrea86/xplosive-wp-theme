<?php
//
// Include all custom post types here (one custom post type per file)
//
$cpt_files = apply_filters('load_custom_post_type_files', array(
	'theme_functions/post_types/slider',
	'theme_functions/post_types/events',
	'theme_functions/post_types/discography',
	'theme_functions/post_types/videos',
	'theme_functions/post_types/galleries',
	'theme_functions/post_types/artists'
));
foreach($cpt_files as $cpt_file) get_template_part($cpt_file);


add_action( 'init', 'ci_tax_create_taxonomies');
if( !function_exists('ci_tax_create_taxonomies') ):
function ci_tax_create_taxonomies() {
	//
	// Create all taxonomies here.
	//	
}
endif;

add_action('admin_enqueue_scripts', 'ci_load_post_scripts');
if( !function_exists('ci_load_post_scripts') ):
function ci_load_post_scripts($hook)
{
	//
	// Add here all scripts and styles, to load on all admin pages.
	//	
	if('post.php' == $hook or 'post-new.php' == $hook)
	{
			wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
			wp_enqueue_script('jquery-ui-datepicker');
	}
}
endif;

add_filter('request', 'ci_feed_request');
if( !function_exists('ci_feed_request') ):
function ci_feed_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type'])){

		$qv['post_type'] = array();
		$qv['post_type'] = get_post_types($args = array(
	  		'public'   => true,
	  		'_builtin' => false
		));
		$qv['post_type'][] = 'post';
	}
	return $qv;
}
endif;

// Add any CPT Icons here
add_action( 'admin_head', 'cpt_icons' );
function cpt_icons() {
    ?>
    <style type="text/css" media="screen">
        #menu-posts-cpt_slider .wp-menu-image {
            background: url(<?php echo get_template_directory_uri() ?>/images/icon_slider.png) no-repeat 6px -17px !important;
        }
        #menu-posts-cpt_slider:hover .wp-menu-image, #menu-posts-cpt_slider.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
        #menu-posts-cpt_events .wp-menu-image {
            background: url(<?php echo get_template_directory_uri() ?>/images/icon_events.png) no-repeat 6px -17px !important;
        }
        #menu-posts-cpt_events:hover .wp-menu-image, #menu-posts-cpt_events.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
        #menu-posts-cpt_discography .wp-menu-image {
            background: url(<?php echo get_template_directory_uri() ?>/images/icon_discography.png) no-repeat 6px -17px !important;
        }
        #menu-posts-cpt_discography:hover .wp-menu-image, #menu-posts-cpt_discography.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
        #menu-posts-cpt_videos .wp-menu-image {
            background: url(<?php echo get_template_directory_uri() ?>/images/icon_videos.png) no-repeat 6px -17px !important;
        }
        #menu-posts-cpt_videos:hover .wp-menu-image, #menu-posts-cpt_videos.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
        #menu-posts-cpt_galleries .wp-menu-image {
            background: url(<?php echo get_template_directory_uri() ?>/images/icon_galleries.png) no-repeat 6px -17px !important;
        }
        #menu-posts-cpt_galleries:hover .wp-menu-image, #menu-posts-cpt_galleries.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
        #menu-posts-cpt_artists .wp-menu-image {
            background: url(<?php echo get_template_directory_uri() ?>/images/icon_artists.png) no-repeat 6px -17px !important;
        }
        #menu-posts-cpt_artists:hover .wp-menu-image, #menu-posts-cpt_artists.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
    </style>
<?php } ?>