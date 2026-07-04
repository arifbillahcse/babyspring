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

	// Waitlist form styling, kept out of front-page.php: main.js physically
	// removes desktop/mobile-only containers from the DOM (data-visibility),
	// so a <style> tag nested inside one of those containers would vanish
	// along with it and leave the other form unstyled. Enqueuing it here
	// keeps it in <head>, unaffected by that DOM swap.
	wp_add_inline_style( 'babysprings-main', babysprings_waitlist_form_css() );

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
 * CSS for the .bs-wl-form waitlist form (shared by the desktop and mobile
 * markup in front-page.php). Kept as a PHP string rather than a static file
 * so it can be enqueued via wp_add_inline_style() — see babysprings_assets().
 *
 * @return string
 */
function babysprings_waitlist_form_css() {
	return '
	.bs-wl-form {
		font-size: 15px;
		font-family: Arial, sans-serif;
		background: #f7f5f2;
		border: 1px solid #d8d3cd;
		border-radius: 0.375em;
		padding: 2em;
		box-shadow: 0 1.25em 3em -1.25em rgba(90,80,60,.35);
	}
	.bs-wl-field { position: relative; margin-bottom: 1em; }
	.bs-wl-field input {
		width: 100%;
		padding: 1.05em 1.1em;
		border: 1px solid #d8d3cd;
		border-radius: 0.5em;
		background: #fff;
		font-family: inherit;
		font-size: 1em;
		color: #2f2f2f;
		transition: border-color .3s, box-shadow .3s;
	}
	.bs-wl-field input::placeholder { color: #b3ad9f; }
	.bs-wl-field input:focus {
		outline: none;
		border-color: #74866E;
		box-shadow: 0 0 0 0.1875em rgba(116,134,110,.18);
	}
	.bs-wl-btn {
		width: 100%;
		margin-top: .4em;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: .6em;
		padding: 1em 1.2em;
		border: 0;
		border-radius: 0.125em;
		background: #74866E;
		color: #fafafa;
		font-family: inherit;
		font-size: .8em;
		font-weight: 400;
		letter-spacing: .12em;
		text-transform: uppercase;
		cursor: pointer;
		transition: background-color .2s ease;
	}
	.bs-wl-btn:hover { background: #5f7e6e; }
	.bs-wl-btn:disabled { opacity: .7; cursor: not-allowed; }
	.bs-wl-error { display: none; font-size: .85em; color: #b3453a; margin-top: .9em; text-align: center; }
	.bs-wl-error.show { display: block; }
	';
}

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
