<!DOCTYPE html >
<html <?php language_attributes(); ?>>
<head>
<!-- Custom Title Setup -->
<title><?php if (is_home()||is_search()) { bloginfo('name'); } else { wp_title(''); } ?></title>
<!-- Meta -->
<meta name="description" content="<?php echo get_option('mytheme_description'); ?>" />
<meta content="<?php bloginfo('name'); ?>"/>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Syndication -->
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php echo get_bloginfo_rss('rss2_url'); ?>" />
<link rel="shortcut icon" href="<?php echo esc_url( home_url( '/' ) ); ?>favicon.ico" >
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
<!-- Stylesheets -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" /> 
<!-- Script -->
<!--[if lt IE 9]>
<script src="<?php bloginfo('stylesheet_directory') ?>/js/selectivizr-min.js"></script>
<![endif]-->
<!-- WP Headers -->
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/css/audio.css" type="text/css" media="screen" /> 
<style>
#banner {
	background-color: <?php echo stripslashes(get_option('mytheme_bannercolor')); ?>;
}
<?php echo stripslashes(get_option('mytheme_customstyle')); ?>
</style>
</head>
<body id="windsays">
	<div id="top">
        		<?php wp_nav_menu( array('theme_location'  => 'primary','container_class' => 'menu-nav-container','menu_class' => 'menu') ) ;?>
	</div>
		<i class="fa fa-search searchicon" title="搜索"></i>
	<?php include(TEMPLATEPATH . '/searchform.php'); ?>
	<div class="container">
		<div id="site" class="hfeed site">
			<div id="banner" class="site-header" role="banner">
				<div class="blogtitle">
					<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					<h3><?php bloginfo( 'description' ); ?></h3>
				</div>
			</div>
			<div id="main" class="wrapper">
				<div id="primary" class="site-content">
