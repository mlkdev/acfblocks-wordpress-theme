<?php

	/* =========== */
	/* = ACF PRO = */
	/* =========== */

	require_once( get_stylesheet_directory().'/includes/acf/acf.php' );
	add_filter( 'acf/settings/url', function( $url ) {
		return get_stylesheet_directory_uri().'/includes/acf/';
	} );

	// Uncomment for prod...
	// add_filter( 'acf/settings/show_admin', '__return_false' );
	// add_filter( 'acf/settings/show_updates', '__return_false', 100 );

	add_action( 'init', function() {

		foreach( glob( __DIR__.'/includes/blocks/*' ) as $block ) {

			/* Block Registration */
			register_block_type( $block );

			/* Field Definitions */
			if( file_exists( $block.'/fields.php' ) ) {
				include( $block.'/fields.php' );
			}

		}

	} );

	add_filter( 'acf/blocks/wrap_frontend_innerblocks', function( $wrap, $name ) {
		return false;
	}, 10, 2 );

	// Foundation front-end...

	wp_register_style( 'theme', get_stylesheet_directory_uri().'/style.css' );
	wp_enqueue_style( 'theme' );

	wp_register_script( 'theme', get_stylesheet_directory_uri().'/script.js' );
	wp_enqueue_script( 'theme' );
