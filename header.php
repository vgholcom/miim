<?php 
/**
 * Header Template
 */
?>
<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php bloginfo('name'); wp_title( '|', true, 'left' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico" type="image/x-icon" />
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header id="secondary-header" class="navbar navbar-static-top">
		<div class="container">
			<section id="secondary">
				<article class="pull-right"><?php
					get_search_form();?>
				</article>
				<nav id="secondary-header-nav" class="pull-left"><?php 
					wp_nav_menu(array(
						'theme_location'=>'secondary-menu', 
						'container'=>'',
						'menu_class'=>'nav navbar-nav',
						'menu_id'=>'sub-head-menu',
						'fallback_cb'=>false,
						'depth'=>1
					)); ?>
				</nav>
			</section>
			<div id="secondary-before" class="pull-right"></div>
		</div>
	</header>
	<header id="primary-header" class="navbar navbar-default navbar-static-top">
		<div class="container">
			<article class="pull-left"><?php
					bloginfo('name');?>
			</article>
			<nav id="primary-header-nav" class="pull-right"><?php 
				wp_nav_menu(array(
					'theme_location'=>'primary-menu', 
					'container'=>'',
					'menu_class'=>'nav navbar-nav',
					'menu_id'=>'sub-head-menu',
					'fallback_cb'=>false,
					'depth'=>1
				)); ?>
			</nav>
		</div>
	</header>
	<section id="main-content">
		<div class="container">
