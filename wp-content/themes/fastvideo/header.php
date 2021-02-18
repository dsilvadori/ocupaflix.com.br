<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fastvideo
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="HandheldFriendly" content="true">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if (get_theme_mod('favicon', '') != null) { ?>
<link rel="icon" type="image/png" href="<?php echo esc_url( get_theme_mod('favicon', '') ); ?>" />
<?php } ?>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700" rel="stylesheet">
<?php wp_head(); ?>

<?php 
	$primary_font = 'Open Sans';
	$theme_color = '#db202c';
?>

<style type="text/css" media="all">
	body,
	h1,h2,h3,h4,h5,h6,
	button,
	.btn,
	input[type="submit"],
	input[type="reset"],
	input[type="button"],
	input,
	textarea,
	table {
		font-family: <?php echo $primary_font; ?>, "Helvetica Neue", Helvetica, Arial, sans-serif;
	}
	.site-title a,
	button,
	.btn,
	input[type="submit"],
	input[type="reset"],
	input[type="button"],
	button:hover,
	.btn:hover,
	input[type="submit"]:hover,
	input[type="reset"]:hover,	
	input[type="button"]:hover,
	#featured-content .slide .watch-now a,
	.pagination .page-numbers:hover,
	.pagination .page-numbers.current,
	.header-upload a:hover,
	.content-block .hentry .thumbnail-wrap .genericon:hover {
		background-color: #db202c;
	}
	
	a:hover,
	.sf-menu li li a:hover,
	.sf-menu li.sfHover li a:hover,
	.sf-menu li.current-menu-item li a:hover, 	
	.section-more a,
	.content-block .entry-title a:hover,
	.entry-related h3 span,
	.author-box .author-meta .author-name a,
	.author-box .author-meta .author-name a:hover,
	.author-box .author-meta .author-desc a,
	.page-content a,
	.entry-content a,
	.page-content a:visited,
	.entry-content a:visited,	
	.comment-author a,
	.comment-content a,
	.comment-reply-title small a:hover,
	.site-footer .widget a,
	.site-footer .widget a:hover,	
	.site-footer ul li a:hover
	.sidebar .widget a,
	.sidebar .widget a:hover,
	.sidebar ul li a:hover,
	.footer-nav ul li a:hover,
	.entry-header .post-author a:hover,
	.entry-header .post-comment a:hover strong {
		color: <?php echo $theme_color; ?>;
	}
	.header-search .search-input:focus {
		border-color: <?php echo $theme_color; ?>;
	}
	.sf-menu li a:hover,
	.sf-menu li.sfHover a,
	.sf-menu li.current-menu-item a {
		border-top-color: <?php echo $theme_color; ?>;
	}
</style>

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header container">

		<div class="site-branding">

			<?php if (get_theme_mod('logo', get_template_directory_uri().'/assets/img/logo.png') != null) { ?>
			
			<div id="logo">
				<span class="helper"></span>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php echo get_theme_mod('logo', get_template_directory_uri().'/assets/img/logo.png'); ?>" alt=""/>
				</a>
			</div><!-- #logo -->

			<?php } else { ?>

			<div class="site-title">
				<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
			</div><!-- .site-title -->

			<?php } ?>

		</div><!-- .site-branding -->

		<nav id="primary-nav" class="main-navigation">

			<?php 
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'sf-menu' ) );
				} else {
			?>

				<ul class="sf-menu">
					<li><a href="<?php echo home_url(); ?>/wp-admin/nav-menus.php"><?php echo __('Add menu for location: Primary Menu', 'fastvideo'); ?></a></li>
				</ul><!-- .sf-menu -->

			<?php } ?>

		</nav><!-- #primary-nav -->

		<div id="slick-mobile-menu"></div>

		<?php if ( get_theme_mod('header-search-on', true) ) : ?>
			
			<span class="search-icon">
				<span class="genericon genericon-search"></span>
				<span class="genericon genericon-close"></span>			
			</span>

		<?php endif; ?>					

		<?php if ( get_theme_mod('header-search-on', true) ) : ?>
				
			<div class="header-search">
				<form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" name="s" class="search-input" placeholder="Pesquisar" autocomplete="off">
					<button type="submit" class="search-submit"><span class="genericon genericon-search"></span></button>		
				</form>
			</div><!-- .header-search -->

		<?php endif; ?>

	</header><!-- #masthead -->

	<div id="content" class="site-content clear">

	<?php if ( is_page() || is_404() ) { ?>
		<div class="inner-wrap">
	<?php } ?>	
