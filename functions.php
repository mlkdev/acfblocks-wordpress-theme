<?php

	// Including ACF Pro in theme (documentation):
	// advancedcustomfields.com/resources/including-acf-within-a-plugin-or-theme

	// Define path and URL to the ACF plugin...

	define( 'MLKDEV_THEME_ACF_PATH', get_stylesheet_directory().'/includes/acf/' );
	define( 'MLKDEV_THEME_ACF_URL', get_stylesheet_directory_uri().'/includes/acf/' );

	// Include the ACF plugin...

	include_once( MLKDEV_THEME_ACF_PATH.'acf.php' );

	// Customize the url setting to fix incorrect asset URLs...

	function mlkdev_theme_acfsettings( $url ) {

		return MLKDEV_THEME_ACF_URL;

	}
	add_filter( 'acf/settings/url', 'mlkdev_theme_acfsettings' );

	// (Optional) Hide the ACF admin menu item...
	// add_filter( 'acf/settings/show_admin', '__return_false' );

	// When including the PRO plugin, hide the ACF Updates menu...
	add_filter( 'acf/settings/show_updates', '__return_false', 100 );

	// Strip the ACF innerblock wrappers...

	function mlkdev_theme_acfnowrap( $wrap, $name ) {

		return false;

	}
	add_filter( 'acf/blocks/wrap_frontend_innerblocks', 'mlkdev_theme_acfnowrap', 10, 2 );

	// Base theme styles and scripts...

	wp_register_style( 'mlkdev-theme', '/theme-css/' );
	wp_enqueue_style( 'mlkdev-theme' );

	wp_register_script( 'mlkdev-theme', get_stylesheet_directory_uri().'/script.js' );
	wp_enqueue_script( 'mlkdev-theme' );

	// Initialize theme...

	function mlkdev_theme_init() {

		// Autowiring...

		$css = null;
		foreach( glob( __DIR__.'/includes/blocks/*' ) as $block ) {

			// Block registrations...

			register_block_type( $block );

			// Block field definitions...

			if( file_exists( $block.'/fields.php' ) ) {
				include( $block.'/fields.php' );
			}

		}

	}
	add_action( 'init', 'mlkdev_theme_init' );

	// Drop default Gutenberg block CSS...

	add_action( 'wp_enqueue_scripts', function() {

		wp_dequeue_style( 'global-styles' );
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );

	}, 100 );

	// Drop default Gutenberg block skip links...

	remove_action( 'wp_footer', 'the_block_template_skip_link' );

	// Drop core's emoji head tag junk...

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	// Drop core's rss+xml head tag junk...

	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'wc_products_rss_feed' );

	// Drop core's rest API head tag junk...

	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

	// Drop core's edit & manifest head tag junk...
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// Drop core's canonical head tag...

	remove_action( 'wp_head', 'rel_canonical' );

	// Drop core's shortlink head tag...

	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
	remove_action( 'template_redirect', 'wp_shortlink_header', 11 );

	// Drop core's generator head tag...

	remove_action( 'wp_head', 'wp_generator' );


	// Drop core's duo-tone svg filter junk...

	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
	remove_action( 'in_admin_header', 'wp_global_styles_render_svg_filters' );
