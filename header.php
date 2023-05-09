<!DOCTYPE HTML>
<html class="js" lang="en" style="background-color:<?php echo html_classes(); ?>;">
<head>

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
	<link rel="icon" type="image/x-icon" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/favicon.ico">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0"/>
	<meta name="keywords" content="<?php echo get_bloginfo('name'); ?>">
	<meta name="copyright" content="<?php echo get_bloginfo('name'); ?>">
	<meta name="publisher" content="<?php echo get_bloginfo('name'); ?>">
	<meta property="og:url" content="<?php echo home_url(); ?>"/>
	<meta name="robots" content="all"/>

	<link rel="preload" href="<?php echo get_template_directory_uri() . '/fonts/garnett-bold.woff2' ?>" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?php echo get_template_directory_uri() . '/fonts/helmet-regular.woff2' ?>" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?php echo get_template_directory_uri() . '/fonts/fiascons.woff2' ?>" as="font" type="font/woff2" crossorigin="anonymous">

	<?php wp_head(); ?>

	<?php get_template_part('inc/analytics'); ?>
</head>

<body <?php body_class(); ?>>

	<?php get_template_part('parts/artist-support-sessions-modal'); ?>

	<?php get_template_part('parts/newsletter-modal'); ?>

    <?php get_template_part('parts/heads-up-modal'); ?>

	<nav class="nav" role="navigation">
		<div class="nav__content">
			<a class="site-logo site-logo--mobile" href="<?php echo bloginfo('url'); ?>/" title="<?php bloginfo('name') ?>">
				<?php include('img/site-logo.svg') ?>
			</a>
			<?php wp_nav_menu( array( 'theme_location' => 'mobile', 'menu_class' => 'nav__mobile', 'container' => 'ul', 'items_wrap' => '<ul id="%1$s" class="%2$s"><ul>%3$s</ul></ul>', ) ); ?>
			<div class="nav__menu">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => '', 'container' => 'div' ) ); ?>
				<a class="site-logo" href="<?php echo bloginfo('url'); ?>/" title="<?php bloginfo('name') ?>">
					<?php include('img/site-logo.svg') ?>
				</a>
				<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => '', 'container' => 'div' ) ); ?>
			</div>
			<a class="nav__icon" href="#" title="Menu"><div><span></span><span></span><span></span></div></a>
		</div>
	</nav>

	<main id="main" class="site-main" role="main">
