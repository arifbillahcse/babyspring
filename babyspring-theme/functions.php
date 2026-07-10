<?php
/**
 * Baby Springs theme functions.
 *
 * @package BabySprings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

define( 'BABYSPRINGS_VERSION', '2.0.0' );

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
	wp_add_inline_style( 'babysprings-main', babysprings_section_spacing_css() );
	wp_add_inline_style( 'babysprings-main', babysprings_footer_logo_css() );

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
		cursor: pointer;
		position: relative;
		z-index: 1;
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
	.container-component.instance-1.columns > .wrapper > .inner {
		align-items: stretch !important;
	}
	.bs-benefit {
		display: flex;
	}
	.bs-benefit-card {
		flex: 1;
		padding: 2.25rem 1.5rem;
		text-align: center;
		background: #f7f5f2;
		border: 1px solid #e2dacb;
		border-radius: 0.85rem;
		box-shadow: 0 1.25rem 2.5rem -1.75rem rgba(90,100,80,.3);
		transition: transform .3s ease, background-color .3s ease, border-color .3s ease, box-shadow .3s ease;
	}
	.bs-benefit .image-component > .frame > img {
		transition: filter .3s ease !important;
	}
	.bs-benefit-title {
		transition: color .3s ease;
	}
	.bs-benefit.is-active .bs-benefit-card,
	.bs-benefit:active .bs-benefit-card {
		transform: translateY(-4px);
		background: #eef1ec;
		border-color: #c9d3c6;
		box-shadow: 0 1.5rem 2.75rem -1.5rem rgba(90,100,80,.4);
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
		.bs-benefit:hover .bs-benefit-card {
			transform: translateY(-4px);
			background: #eef1ec;
			border-color: #c9d3c6;
			box-shadow: 0 1.5rem 2.75rem -1.5rem rgba(90,100,80,.4);
		}
		.bs-benefit:hover .image-component > .frame > img {
			filter: saturate(1.4) brightness(1.08) drop-shadow(0 0 .5rem rgba(116,134,110,.5)) !important;
		}
		.bs-benefit:hover .bs-benefit-title {
			color: #74866E;
		}
	}
	@media (prefers-reduced-motion: reduce) {
		.bs-benefit-card,
		.bs-benefit .image-component > .frame > img,
		.bs-benefit-title {
			transition: none !important;
			transform: none !important;
		}
	}
	';
}

/**
 * Normalizes the vertical spacing of the front page's simple (text/divider)
 * sections: nav, the two dividers, the "Where early development..." heading,
 * the benefits grid, the CTA divider row, FAQ and the footer.
 *
 * The Carrd export gives each of these its own --padding-vertical (0.5rem
 * to 3rem — set on .container-component.instance-N > .wrapper > .inner,
 * *not* on the outer .instance-N element, so an override has to repeat that
 * full selector or it silently no-ops), so consecutive sections read as
 * having noticeably different amounts of breathing room. This unifies them
 * to one consistent value.
 *
 * Deliberately excludes instances 12, 6 and 10 (the hero and the two
 * "Secure Your Spot" form sections): their vertical whitespace comes from
 * align-items: center centering the text column against the taller photo
 * column, not from this padding, so changing it wouldn't visibly help there.
 *
 * @return string
 */
function babysprings_section_spacing_css() {
	return '
	.container-component.instance-2 > .wrapper > .inner,
	.container-component.instance-9 > .wrapper > .inner,
	.container-component.instance-7 > .wrapper > .inner,
	.container-component.instance-1 > .wrapper > .inner,
	.container-component.instance-5 > .wrapper > .inner,
	.container-component.instance-4 > .wrapper > .inner,
	.container-component.instance-11 > .wrapper > .inner {
		--padding-vertical: 1rem;
	}
	';
}

/**
 * CSS for the .ty-footer markup (logo, meta text, social icons) — shared
 * between front-page.php and page-thank-you.php so both footers are
 * identical instead of one being a set of overrides fighting Carrd's own
 * flex layout/CSS custom properties (which is what the previous version of
 * this function did, and kept losing that fight in different ways).
 *
 * page-thank-you.php also carries its own copy of these same rules inline
 * (it's a standalone template with its own <style> block) — keep the two in
 * sync if either changes.
 *
 * @return string
 */
function babysprings_footer_logo_css() {
	return '
	.ty-footer { border-top: 1px solid #e2dacb; padding: 2.5rem 0; }
	.ty-footer .wrap {
		display: grid;
		grid-template-columns: 1fr auto 1fr;
		align-items: center;
		gap: 1.5rem;
	}
	.ty-footer-logo img { height: 3.2rem; width: auto; }
	.ty-footer-meta { font-size: .88rem; color: #6d675c; text-align: center; }
	.ty-footer-meta p + p { margin-top: .3rem; }
	.ty-socials { display: flex; gap: .6rem; justify-content: flex-end; }
	.ty-socials a {
		width: 2.4rem; height: 2.4rem; border-radius: 50%;
		display: flex; align-items: center; justify-content: center;
		background: #f7f5f2; border: 1px solid #e2dacb;
		transition: background-color .2s ease;
	}
	.ty-socials a:hover { background: #74866E; }
	.ty-socials a:hover svg { fill: #fff; }
	.ty-socials svg { width: 1.1rem; height: 1.1rem; fill: #6d675c; transition: fill .2s ease; }
	@media (max-width: 700px) {
		.ty-footer .wrap { grid-template-columns: 1fr; text-align: center; }
		.ty-socials { justify-content: center; }
		.ty-footer-logo { justify-self: center; }
		.ty-footer-logo img { height: auto; width: 12rem; }
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

/**
 * Register the server-side "bridge" REST endpoint the waitlist form submits to.
 *
 * The browser posts the signup here (same-origin, on the site's own domain)
 * instead of calling a.klaviyo.com directly. Ad blockers, privacy browsers
 * (Brave, mobile Safari tracking prevention) and some networks block known
 * marketing/tracker domains like klaviyo.com outright, which silently killed
 * real submissions — especially on mobile — while never affecting a
 * same-origin request to the site itself. The PHP handler then relays the
 * data to Klaviyo server-to-server, where no browser-side blocker can reach.
 */
function babysprings_register_rest_routes() {
	register_rest_route(
		'babysprings/v1',
		'/subscribe',
		array(
			'methods'             => 'POST',
			'callback'            => 'babysprings_handle_subscribe',
			'permission_callback' => '__return_true', // Public: anonymous visitors submit the waitlist.
		)
	);
}
add_action( 'rest_api_init', 'babysprings_register_rest_routes' );

/**
 * Best-effort real client IP, accounting for the CDN/proxy the site sits
 * behind (so geolocation reflects the visitor, not the edge server).
 *
 * @return string Validated IP, or '' if none could be determined.
 */
function babysprings_get_client_ip() {
	$candidates = array();

	if ( ! empty( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) {
		$candidates[] = wp_unslash( $_SERVER['HTTP_CF_CONNECTING_IP'] );
	}
	if ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		// May be a comma-separated chain; the left-most is the original client.
		$forwarded  = explode( ',', wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) );
		$candidates[] = trim( $forwarded[0] );
	}
	if ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
		$candidates[] = wp_unslash( $_SERVER['REMOTE_ADDR'] );
	}

	foreach ( $candidates as $ip ) {
		if ( filter_var( $ip, FILTER_VALIDATE_IP ) ) {
			return $ip;
		}
	}

	return '';
}

/**
 * Resolve an approximate (city-level) location for an IP, server-side.
 *
 * Runs on the server rather than in the browser, so ad blockers — which only
 * intercept the visitor's own outbound requests — can't block it. Always
 * returns gracefully (null on any failure/timeout) so a slow or unreachable
 * lookup never blocks the signup itself.
 *
 * @param string $ip Client IP.
 * @return array|null { city, region, country } or null.
 */
function babysprings_lookup_location( $ip ) {
	if ( '' === $ip || filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) === false ) {
		return null; // No usable public IP (e.g. localhost / private range during testing).
	}

	$response = wp_remote_get(
		'https://ipapi.co/' . rawurlencode( $ip ) . '/json/',
		array(
			'timeout' => 3,
			'headers' => array( 'Accept' => 'application/json' ),
		)
	);

	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
		return null;
	}

	$data = json_decode( wp_remote_retrieve_body( $response ), true );
	if ( ! is_array( $data ) || ! empty( $data['error'] ) ) {
		return null;
	}

	return array(
		'city'    => isset( $data['city'] ) ? (string) $data['city'] : '',
		'region'  => isset( $data['region'] ) ? (string) $data['region'] : '',
		'country' => isset( $data['country_name'] ) ? (string) $data['country_name'] : '',
	);
}

/**
 * Relay a waitlist signup to Klaviyo server-to-server.
 *
 * @param WP_REST_Request $request Incoming request ({ name, email, baby_age }).
 * @return WP_REST_Response
 */
function babysprings_handle_subscribe( WP_REST_Request $request ) {
	$name     = sanitize_text_field( (string) $request->get_param( 'name' ) );
	$email    = sanitize_email( (string) $request->get_param( 'email' ) );
	$baby_age = sanitize_text_field( (string) $request->get_param( 'baby_age' ) );

	if ( '' === $name ) {
		return new WP_REST_Response( array( 'success' => false, 'message' => 'Please enter your name.' ), 400 );
	}
	if ( '' === $email || ! is_email( $email ) ) {
		return new WP_REST_Response( array( 'success' => false, 'message' => 'Please enter a valid email address.' ), 400 );
	}

	$list_id  = babysprings_get_option( 'babysprings_klaviyo_list_id', 'Um8kBy' );
	$api_key  = babysprings_get_option( 'babysprings_klaviyo_public_key', 'Sqxup7' );
	$revision = babysprings_get_option( 'babysprings_klaviyo_revision', '2026-04-15' );

	$profile_attributes = array(
		'email'      => $email,
		'first_name' => $name,
		'properties' => array(
			'full_name' => $name,
			'baby_age'  => $baby_age,
		),
	);

	$location = babysprings_lookup_location( babysprings_get_client_ip() );
	if ( $location ) {
		$profile_attributes['location'] = $location;
	}

	$payload = array(
		'data' => array(
			'type'       => 'subscription',
			'attributes' => array(
				'profile' => array(
					'data' => array(
						'type'          => 'profile',
						'attributes'    => $profile_attributes,
						'subscriptions' => array(
							'email' => array( 'marketing' => array( 'consent' => 'SUBSCRIBED' ) ),
						),
					),
				),
			),
			'relationships' => array(
				'list' => array( 'data' => array( 'type' => 'list', 'id' => $list_id ) ),
			),
		),
	);

	$response = wp_remote_post(
		'https://a.klaviyo.com/client/subscriptions/?company_id=' . rawurlencode( $api_key ),
		array(
			'timeout' => 8,
			'headers' => array(
				'Content-Type' => 'application/json',
				'Accept'       => 'application/json',
				'revision'     => $revision,
			),
			'body'    => wp_json_encode( $payload ),
		)
	);

	if ( is_wp_error( $response ) ) {
		return new WP_REST_Response(
			array( 'success' => false, 'message' => 'Something went wrong — please try again in a moment.' ),
			502
		);
	}

	$code = wp_remote_retrieve_response_code( $response );
	if ( 202 === $code || ( $code >= 200 && $code < 300 ) ) {
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	// Surface Klaviyo's own error detail when it provides one.
	$body    = json_decode( wp_remote_retrieve_body( $response ), true );
	$message = 'Something went wrong — please try again in a moment.';
	if ( is_array( $body ) && ! empty( $body['errors'][0]['detail'] ) ) {
		$message = (string) $body['errors'][0]['detail'];
	}

	return new WP_REST_Response( array( 'success' => false, 'message' => $message ), 502 );
}

require_once get_theme_file_path( 'inc/customizer.php' );
