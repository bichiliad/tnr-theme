<?php load_theme_textdomain('min'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xml:lang="en" lang="en">
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
	<ul>
		<?php echo wp_list_categories('title_li=&orderby=count&order=DESC&taxonomy=post_tag&number=9'); ?>
	</ul>

</div>
<div id="wrapper">
	<div id="header">
		<a href="<?php echo get_option('home'); ?>/">
			<img id="logo" alt="Thuds and Rumbles" src="<?php bloginfo('template_url');?>/img/tnr.png">
		</a>
		<h1>
			<a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a>
		</h1>
		<div id="header-menu">
			<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
		</div>
	</div><!-- /#header -->
