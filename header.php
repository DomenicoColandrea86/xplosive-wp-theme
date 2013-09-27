<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
	================================================== -->
	<meta charset="utf-8">
	<title><?php ci_e_title(); ?></title>

	<!-- Mobile Specific Metas 
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- JS files are loaded via /theme_functions/scripts.php -->

	<!-- CSS files are loaded via /theme_functions/styles.php -->

	<!--[if lt IE 9]>
		<link rel='stylesheet' href='<?php echo get_template_directory_uri() . "/css/ie.css" ?>' type='text/css' media='all' />
	<![endif]-->

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>

<div id="wrap">
	<div class="container">
		
		<!-- ########################### HEADER ########################### -->
		<header id="header" class="group">

			<hgroup id="logo" class="four columns">
			<?php ci_e_logo('<h1>', '</h1>'); ?>
			</hgroup>
			
			<nav id="nav" class="nav twelve columns">
				<?php 
					if(has_nav_menu('ci_main_menu'))
						wp_nav_menu( array(
							'theme_location' 	=> 'ci_main_menu',
							'fallback_cb' 		=> '',
							'container' 		=> '',
							'menu_id' 			=> 'navigation',
							'menu_class' 		=> 'sf-menu group'
						));
					else
						wp_page_menu();
				?>
			</nav><!-- /nav -->
									
		</header><!-- /header -->	