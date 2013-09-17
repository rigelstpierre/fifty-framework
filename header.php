<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"><!--<![endif]-->

<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

	<title><?php bloginfo('name'); ?><?php wp_title(" - ",true); ?></title>

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

	<!-- Favicons -->
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.png" type="image/x-icon">
	<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/apple-touch-icon.png" sizes="114x114">
	<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/apple-touch-icon.png" sizes="72x72">
	<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/apple-touch-icon.png">

	<?php wp_head(); ?>
	
	<script>
		// JAVASCRIPT HOOK VARS
		var template_url 			= '<?php bloginfo("template_url"); ?>/';
		var front_page   			= '<?php echo is_front_page(); ?>';
		var page_name 				= "<?php global $post; echo get_post( $post )->post_name; ?>";
		var iOS 							= ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
	</script>

	<!--[if lt IE 9]>
		<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/xbc.js"></script>
	<![endif]-->

	<script>
		// Google Analytics here
	</script>

</head>

<body <?php body_class();?>>


<header class="default">
	<div class="container">
		 		
		<div class="logo span5">
			<?php if( of_get_option('custom_logo','') !== '' ) : ?>
			    <a href="<?php echo home_url(); ?>/" title="<?php get_bloginfo( 'name' ); ?>" rel="home">
			    	<img src="<?php echo of_get_option('custom_logo'); ?>" alt="<?php get_bloginfo( 'name' ) ?>" />
			    </a>
			<?php else: ?>
			    <h2><a href="<?php echo home_url(); ?>/" title="<?php get_bloginfo( 'name' ); ?>" rel="home">
			     	<?php echo get_bloginfo( 'name' ); ?>
			    </a></h2>
			<?php endif; ?>		
		</div>

		<nav class="nav-header span7 omega">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav>

  <div class="clear"></div>
	</div>
</header><!-- header.default.<header_class> -->



