<?php
/**
 * Baby Springs theme functions.
 *
 * @package BabySprings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

define( 'BABYSPRINGS_VERSION', '1.0.0' );

/**
 * Theme setup.
 */
function babysprings_setup() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'babysprings_setup' );

/**
 * Enqueue styles and scripts.
 */
function babysprings_assets() {
	wp_enqueue_style(
		'babysprings-fonts',
		'https://fonts.googleapis.com/css2?display=swap&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500',
		array(),
		null
	);

	wp_enqueue_style(
		'babysprings-main',
		get_theme_file_uri( 'assets/main.css' ),
		array( 'babysprings-fonts' ),
		BABYSPRINGS_VERSION
	);

	wp_enqueue_script(
		'babysprings-main',
		get_theme_file_uri( 'assets/main.js' ),
		array(),
		BABYSPRINGS_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'babysprings_assets' );

/**
 * Read a theme_mod (Customizer value), falling back to $default only when
 * the setting has never been saved. A field explicitly cleared to "" in the
 * Customizer (e.g. a social URL, to hide that icon) is returned as "" —
 * get_theme_mod() already makes this distinction correctly, so this is a
 * thin, intention-revealing wrapper around it.
 *
 * @param string $key     Setting key.
 * @param string $default Default value if unset.
 * @return string
 */
function babysprings_get_option( $key, $default = '' ) {
	return get_theme_mod( $key, $default );
}

/**
 * URL for a bundled theme asset (images, icons.svg, etc).
 *
 * @param string $path Path relative to the theme root, e.g. "assets/images/image03.png".
 * @return string
 */
function babysprings_asset( $path ) {
	return get_theme_file_uri( $path );
}

/**
 * Work out where the waitlist form should send visitors after a successful
 * Klaviyo subscription.
 *
 * Priority: an explicit override in the Customizer, then a published Page
 * using the "Thank You" page template, then a sensible /thank-you/ default.
 *
 * @return string
 */
function babysprings_thank_you_url() {
	$override = babysprings_get_option( 'babysprings_thankyou_url', '' );
	if ( $override ) {
		return esc_url_raw( $override );
	}

	$pages = get_posts(
		array(
			'post_type'      => 'page',
			'meta_key'       => '_wp_page_template',
			'meta_value'     => 'page-thank-you.php',
			'posts_per_page' => 1,
			'post_status'    => 'publish',
		)
	);

	if ( ! empty( $pages ) ) {
		return get_permalink( $pages[0] );
	}

	return home_url( '/thank-you/' );
}

require_once get_theme_file_path( 'inc/customizer.php' );
