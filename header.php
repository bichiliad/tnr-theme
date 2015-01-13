<?php load_theme_textdomain('min'); ?>
<!DOCTYPE html>
<html ng-app="customPlayer" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xml:lang="en" lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0" />
	<title>
	<?php if (is_home()) { ?>
		<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>
	<?php } elseif (is_single() || is_page() || is_archive()) { ?>
		<?php wp_title(''); ?> - <?php bloginfo('name'); ?>
	<?php } elseif  (is_404()) { ?>
		<?php _e('The page you are looking for doesn\'t exist. Sorry.','min'); ?> - <?php bloginfo('name'); ?>
	<?php } elseif (is_search()) { ?>
		<?php _e('You searched for the following','min'); ?>: "<?php echo wp_specialchars($s); ?>" - <?php bloginfo('name'); ?>
	<?php } ?>
	</title>

	<script src="//use.typekit.net/lun7nfj.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>

    <!-- scripts -->
    <script src="<?php bloginfo('template_url'); ?>/js/progress-polyfill.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/background-check.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.8/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.8/angular-animate.min.js"></script>
    <script src="//d2v52k3cl9vedd.cloudfront.net/plangular/2.0-beta-1/ng-plangular.min.js"></script>

    <script>
        var app = angular.module('customPlayer', ['ngAnimate', 'plangular']);

        window.onload = function() {
            BackgroundCheck.init({
                targets: '.check',
                images: '.artwork'
            });
        };
    </script>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<!--[if IE 7]>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie7.css" type="text/css" media="screen" />
	<![endif]-->
	<!--[if IE 6]>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie6.css" type="text/css" media="screen" />
	<![endif]-->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/print.css" type="text/css" media="print" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php bloginfo('name'); ?> <?php _e('RSS Feed','min'); ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php bloginfo('name'); ?> <?php _e('Comments RSS Feed','min'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
<body>
<div id="taglist">
	<?php if ( has_nav_menu ('top-menu') ) { ?> 
		<?php wp_nav_menu( array( 'theme_location' => 'top-menu', 'menu_class' => 'menu', 'container' => false ) ); ?>
	<?php } else { ?>
	<ul class="menu">
		<?php echo wp_list_categories('title_li=&orderby=count&order=DESC&taxonomy=post_tag&number=9'); ?>
	</ul>
	<?php } ?>
</div>
<div id="wrapper">
	<div id="header">
		<a href="<?php echo get_option('home'); ?>/">
			<img id="logo" alt="Thuds and Rumbles" src="<?php bloginfo('template_url');?>/img/tnr.png">
		</a>
		<h1 id="site-title">
			<a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a>
		</h1>
		<div id="header-menu">
			<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'menu', 'container' => false ) ); ?>
		</div>
	</div><!-- /#header -->
