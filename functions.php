<?php

	/* =========== */
	/* = ACF PRO = */
	/* =========== */

	require_once( get_stylesheet_directory().'/includes/acf/acf.php' );
	add_filter( 'acf/settings/url', function( $url ) {
		return get_stylesheet_directory_uri().'/includes/acf/';
	} );

	add_filter( 'acf/blocks/wrap_frontend_innerblocks', function( $wrap, $name ) {
		return false;
	}, 10, 2 );

	// Uncomment for prod...
	// add_filter( 'acf/settings/show_admin', '__return_false' );
	// add_filter( 'acf/settings/show_updates', '__return_false', 100 );

	// Base theme styles and scripts...

	wp_register_style( 'mlkdev-theme', '/theme-css/' );
	wp_enqueue_style( 'mlkdev-theme' );

	wp_register_script( 'mlkdev-theme', get_stylesheet_directory_uri().'/script.js' );
	wp_enqueue_script( 'mlkdev-theme' );

	// Block editor auto-wiring...

	add_filter( 'query_vars', function( $query_vars ) {

		$query_vars[] = 'route';
		return $query_vars;

	} );

	add_action( 'init', function() {

		$css = null;
		foreach( glob( __DIR__.'/includes/blocks/*' ) as $block ) {

			/* Block Registration */
			register_block_type( $block );

			/* Field Definitions */
			if( file_exists( $block.'/fields.php' ) ) {
				include( $block.'/fields.php' );
			}

		}

		add_rewrite_rule( 'theme-css/?$', 'index.php?route=theme-css', 'top' );

	} );

	add_action( 'parse_request', function( $query ) {

		// Serve digest of block CSS (or redirect)...
		if( array_key_exists( 'route', $query->query_vars ) ) {
			if( !empty( $query->query_vars[ 'route' ] ) ) {
				if( $query->query_vars[ 'route' ] == 'theme-css' ) {
					if( empty( $query->request ) ) {

						// Redirect the index.php format...
						wp_redirect( site_url( '/theme-css/' ) );
						exit;

					} else {

						// Output CSS...

						$css = file_get_contents( __DIR__.'/style.css' );

						foreach( glob( __DIR__.'/includes/blocks/*' ) as $block ) {
							if( file_exists( $block.'/style.css' ) ) {
								$css .= file_get_contents( $block.'/style.css' );
							}
						}

						header( 'Content-Type: text/css' );
						die( $css );

					}
				}
			}
		}

		return $query;

	} );

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
