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
	wp_add_inline_style( 'babysprings-main', babysprings_benefits_css() );

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
	.bs-wl-label {
		display: block;
		font-size: .78em;
		color: #6d675c;
		margin-bottom: .4em;
	}
	.bs-wl-date-shell { position: relative; }
	.bs-wl-date-shell .bs-wl-date-input {
		position: absolute;
		inset: 0;
		width: 100%;
		height: 100%;
		margin: 0;
		padding: 0;
		border: 0;
		opacity: 0;
		cursor: pointer;
		z-index: 2;
	}
	.bs-wl-date-display {
		display: block;
		width: 100%;
		padding: 1.05em 1.1em;
		border: 1px solid #d8d3cd;
		border-radius: 0.5em;
		background: #fff;
		font-family: inherit;
		font-size: 1em;
		color: #2f2f2f;
		pointer-events: none;
	}
	.bs-wl-date-display.bs-wl-placeholder { color: #b3ad9f; }
	.bs-wl-date-input:focus + .bs-wl-date-display {
		border-color: #74866E;
		box-shadow: 0 0 0 0.1875em rgba(116,134,110,.18);
	}
	.bs-wl-btn {
		width: 100%;
		height: 3.5rem;
		margin-top: .4em;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: .6em;
		padding: 0 1.2em;
		border: 0;
		border-radius: 0;
		background-color: #74866E;
		color: #FAFAFA;
		font-family: Arial, sans-serif;
		font-size: 1em;
		font-weight: 400;
		letter-spacing: 0;
		text-transform: uppercase;
		cursor: pointer;
		transition: background-color .25s ease, box-shadow .25s ease;
		animation: bs-wl-btn-pulse 2.2s ease-in-out infinite;
	}
	.bs-wl-btn:hover,
	.bs-wl-btn:focus-visible {
		background-color: #607E6E;
		animation-play-state: paused;
	}
	.bs-wl-btn:disabled {
		opacity: .7;
		cursor: not-allowed;
		animation: none;
	}
	@keyframes bs-wl-btn-pulse {
		0%, 100% { box-shadow: 0 0 0 0 rgba(116,134,110,.55); }
		50% { box-shadow: 0 0 0 .55em rgba(116,134,110,0); }
	}
	.bs-wl-error { display: none; font-size: .85em; color: #b3453a; margin-top: .9em; text-align: center; }
	.bs-wl-error.show { display: block; }
	.bs-wl-urgency {
		display: flex;
		align-items: center;
		justify-content: center;
		gap: .55em;
		margin-top: 1em;
		font-family: Arial, sans-serif;
		font-size: .82em;
		color: #4f5a4d;
		text-align: center;
	}
	.bs-wl-dot {
		width: .55em;
		height: .55em;
		border-radius: 50%;
		background: #3fae4c;
		flex: none;
		box-shadow: 0 0 0 0 rgba(63,174,76,.6);
		animation: bs-wl-dot-pulse 1.8s ease-out infinite;
	}
	@keyframes bs-wl-dot-pulse {
		0% { box-shadow: 0 0 0 0 rgba(63,174,76,.55); }
		70% { box-shadow: 0 0 0 .5em rgba(63,174,76,0); }
		100% { box-shadow: 0 0 0 0 rgba(63,174,76,0); }
	}
	@media (prefers-reduced-motion: reduce) {
		.bs-wl-btn, .bs-wl-dot { animation: none; }
	}
	';
}

/**
 * CSS for the interactive "benefit" cards (Supports development & movement /
 * Promotes better sleep / etc. in front-page.php). The lit state applies on
 * desktop hover, on tap (native :active — no click handler is used, since one
 * would collide with the icon frame's existing onclick="_scrollToTop()"), and
 * via the .is-active class, which footer.php's setupBenefitReveal() adds as
 * each card scrolls into view on touch devices.
 *
 * @return string
 */
function babysprings_benefits_css() {
	return '
	.bs-benefit {
		position: relative;
		border-radius: 0.85rem;
		transition: transform .4s ease;
	}
	.bs-benefit::before {
		content: "";
		position: absolute;
		inset: -0.85rem -1rem;
		border-radius: 1rem;
		background: rgba(116,134,110,.08);
		box-shadow: 0 1.5rem 2.5rem -1.5rem rgba(90,100,80,.35);
		opacity: 0;
		transform: scale(.96);
		transition: opacity .4s ease, transform .4s ease;
		z-index: -1;
		pointer-events: none;
	}
	.bs-benefit .image-component > .frame > img {
		transition: filter .4s ease !important;
	}
	.bs-benefit-title {
		transition: color .4s ease;
	}
	.bs-benefit.is-active::before,
	.bs-benefit:active::before {
		opacity: 1;
		transform: scale(1);
	}
	.bs-benefit.is-active,
	.bs-benefit:active {
		transform: translateY(-4px);
	}
	.bs-benefit.is-active .image-component > .frame > img,
	.bs-benefit:active .image-component > .frame > img {
		filter: saturate(1.4) brightness(1.08) drop-shadow(0 0 .5rem rgba(116,134,110,.5)) !important;
	}
	.bs-benefit.is-active .bs-benefit-title,
	.bs-benefit:active .bs-benefit-title {
		color: #74866E;
	}
	@media (hover: hover) and (pointer: fine) {
		.bs-benefit:hover::before {
			opacity: 1;
			transform: scale(1);
		}
		.bs-benefit:hover {
			transform: translateY(-4px);
		}
		.bs-benefit:hover .image-component > .frame > img {
			filter: saturate(1.4) brightness(1.08) drop-shadow(0 0 .5rem rgba(116,134,110,.5)) !important;
		}
		.bs-benefit:hover .bs-benefit-title {
			color: #74866E;
		}
	}
	@media (prefers-reduced-motion: reduce) {
		.bs-benefit,
		.bs-benefit::before,
		.bs-benefit .image-component > .frame > img,
		.bs-benefit-title {
			transition: none !important;
			transform: none !important;
		}
	}
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
