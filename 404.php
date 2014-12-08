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
<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/css/audio.css" type="text/css" media="screen" /> 
<style>
body {
	background-color: #5EC2A6;
	color: #FFF;
	font-family: "Microsoft Tai Le","Microsoft YaHei","Microsoft JhengHei",STHeiti,MingLiu;
	font-weight: lighter;
	text-align: center;
}
#container{
	display: inline-block;
}
h1 {
	font-size: 160px;
	line-height: 0;
	margin-top: 200px;
}
h2{
	font-size: 20px;
	line-height: 60px;
}
#home {
	font-size: 40px;
	padding: 20px 100px;
	line-height: 80px;
	border-radius: 50px;
	border: 2px solid #FFF;
	color: #FFF;
	text-decoration: none;
	transition: all 0.2s ease;
}
#home:hover {

	border: 2px solid  rgba(255,255,255,.4);
	color: rgba(255,255,255,.4);
}
</style>
</head>
<body>
<div id="container">
	<h1>404</h1>
	<h2>您要查看的页面不存在</h2>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="home">Home</a>
</div>

</body>