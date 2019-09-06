<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">

		<link href="//www.google-analytics.com" rel="dns-prefetch">
<!--		<link href="--><?php //echo get_template_directory_uri(); ?><!--/img/icons/favicon.ico" rel="shortcut icon">-->
<!--		<link href="--><?php //echo get_template_directory_uri(); ?><!--/img/icons/touch.png" rel="apple-touch-icon-precomposed">-->

        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon-16x16.png">
        <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/favicon/site.webmanifest">
        <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon/safari-pinned-tab.svg" color="#1681c1">
        <meta name="msapplication-TileColor" content="#1681c1">
        <meta name="theme-color" content="#ffffff">

		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?>>

		<!-- wrapper -->
<!--		<div class="wrapper">-->

			<!-- header -->
			<header class="header clear">

                <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white">
                    <div class="container">
                        <a class="navbar-brand p-0" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
                            <img height="40" src="<?php bloginfo('template_url'); ?>/img/odisea-bMaker-logo@3x.png" />
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                            <?php wpbmaker_nav(); ?>
                            <div class="user-actions">
                                <?php if (get_option('users_can_register')) { ?>
                                    <a href="<?php echo bloginfo('url'); ?>/inscribete?action=register" class="btn btn-primary ml-2">
                                        <?php _e( 'Inscríbete', 'wpbmaker' ); ?>
                                    </a>
                                <?php } ?>
                                <?php if(is_user_logged_in()) { ?>
                                    <a href="<?php echo admin_url( '' ) ?>" class="btn btn-success ml-2">
                                        <?php _e( 'Entra como participante ', 'wpbmaker' ); ?>
                                    </a>
                                <?php } else { ?>
                                    <a href="<?php echo bloginfo('url'); ?>/inscribete?action=login" class="btn btn-success ml-2">
                                        <?php _e( 'Entra como participante ', 'wpbmaker' ); ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.container -->
                </nav>

			</header>
			<!-- /header -->
