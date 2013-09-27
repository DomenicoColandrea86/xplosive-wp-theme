<?php
add_action( 'widgets_init', 'ci_widgets_init' );
if( !function_exists('ci_widgets_init') ):
function ci_widgets_init() {

	register_sidebar(array(
		'name' => __( 'Homepage sidebar #1', 'xplosive'),
		'id' => 'homepage-sidebar-one',
		'description' => __( 'Place here the widgets that you want to display on your homepage sidebar #1', 'xplosive'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __( 'Homepage sidebar #2', 'xplosive'),
		'id' => 'homepage-sidebar-two',
		'description' => __( 'Place here the widgets that you want to display on your homepage sidebar #2', 'xplosive'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __( 'Pages Sidebar', 'xplosive'),
		'id' => 'pages-sidebar',
		'description' => __( 'Place here the widgets that you want to display on your pages', 'xplosive'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));


	register_sidebar(array(
		'name' => __( 'Blog Sidebar', 'xplosive'),
		'id' => 'blog-sidebar',
		'description' => __( 'Place here the widgets that you want to display on your blog sidebar', 'xplosive'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __( 'Events Sidebar', 'xplosive'),
		'id' => 'events-sidebar',
		'description' => __( 'Place here the widgets that you want to display on your events sidebar', 'xplosive'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __( 'Album Sidebar', 'xplosive'),
		'id' => 'album-sidebar',
		'description' => __( 'Place here the widgets that you want to display in the details page of each album under the featured image', 'xplosive'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __( 'Artist Sidebar', 'xplosive'),
		'id' => 'discography-sidebar',
		'description' => __( 'Place here the widgets that you want to display in the details page of each artist under the featured image', 'xplosive'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __( 'Footer sidebar #1', 'xplosive'),
		'id' => 'footer-sidebar-one',
		'description' => __( 'Place here the widgets that you want to display on your footer column #1', 'xplosive'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __( 'Footer sidebar #2', 'xplosive'),
		'id' => 'footer-sidebar-two',
		'description' => __( 'Place here the widgets that you want to display on your footer column #2', 'xplosive'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __( 'Footer sidebar #3', 'xplosive'),
		'id' => 'footer-sidebar-three',
		'description' => __( 'Place here the widgets that you want to display on your footer column #3', 'xplosive'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __( 'Footer sidebar #4', 'xplosive'),
		'id' => 'footer-sidebar-four',
		'description' => __( 'Place here the widgets that you want to display on your footer column #4', 'xplosive'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

}
endif;
?>
