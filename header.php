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
				<article class="pull-right">
					<?php $option = get_option('miim_theme_options'); ?>
					<span><?php if (isset($option['tw_username'])) { ?><a href="http://www.twitter.com/<?php echo $option['tw_username']; ?>"><i class="fa fa-twitter-square"></i><?php /*echo $option['tw_username'];*/ }?></a></span>
					<span><?php if (isset($option['fb_username'])) { ?><a href="http://www.facebook.com/<?php echo $option['fb_username']; ?>"><i class="fa fa-facebook-square"></i><?php /*echo $option['fb_username'];*/ }?></a></span>
					<span><?php if (isset($option['ig_username'])) { ?><a href="http://www.instagram.com/<?php echo $option['ig_username']; ?>"><i class="fa fa-instagram"></i><?php /*echo $option['ig_username'];*/ }?></a></span>
					<span><?php if (isset($option['yt_username'])) { ?><a href="http://www.youtube.com/channel/<?php echo $option['yt_username']; ?>"><i class="fa fa-youtube-square"></i><?php /*echo $option['yt_username'];*/ }?></a></span>
					<span><?php if (isset($option['fk_username'])) { ?><a href="http://www.flickr.com/photos/<?php echo $option['fk_username']; ?>"><i class="fa fa-flickr"></i><?php /*echo $option['fk_username'];*/ }?></a></span><?php
					//get_search_form();?>
				</article>
			</section>
			<div id="secondary-before" class="pull-right"></div>
		</div>
	</header>
	<header id="primary-header" class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<article id="logo" class="pull-left">
				<a href="<?php bloginfo('url'); ?>"><?php bloginfo('name');?></a>
			</article>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary-header-nav">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
			<nav id="primary-header-nav" class="pull-right collapse navbar-collapse"><?php 
				wp_nav_menu(array(
					'theme_location'=>'primary-menu', 
					'container'=>'',
					'menu_class'=>'nav navbar-nav',
					'menu_id'=>'sub-head-menu',
					'fallback_cb'=>false,
					'depth'=>2
				)); ?>
			</nav>
		</div>
	</header>
	<?php 
		if (is_front_page() || is_home()) {
		} else { ?>
			<div class="content-banner">
				<div class="container">
					<?php breadcrumbs(); ?>
				</div>
			</div><?php
		} ?>
	<section id="main-content">
	<div class="container">
