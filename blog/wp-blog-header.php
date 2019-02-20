<?php
/**
 * Loads the WordPress environment and template.
 *
 * @package WordPress
 */

if ( !isset($wp_did_header) ) {

	$wp_did_header = true;

	// Load the WordPress library.
	require_once( dirname(__FILE__) . '/wp-load.php' );

	// Set up the WordPress query.
	wp();
	// die('heeeeeeeeeee');

	// Load the theme template.
	// echo ( ABSPATH . WPINC . '/template-loader.php' );
	require_once( ABSPATH . WPINC . '/template-loader.php' );
	// die('ddsssssssss');

}
