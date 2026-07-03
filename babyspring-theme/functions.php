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
 * Theme setup: features and menu locations.
 */
function babysprings_setup() {
	// Let WordPress manage the document <title>.
	add_theme_support( 'title-tag' );

	// Post thumbnails (used if the site later adds blog posts / pages).
	add_theme_support( 'post-thumbnails' );

	// Custom logo — replaces the bundled logo image when set in the Customizer.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 364,
			'width'       => 457,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Feed links, HTML5 markup, responsive embeds.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support( 'responsive-embeds' );

	// Navigation menu locations — these appear under Appearance → Menus.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu (header & mobile)', 'babyspring' ),
		)
	);
}
add_action( 'after_setup_theme', 'babysprings_setup' );

/**
 * Enqueue styles and scripts.
 */
function babysprings_assets() {
	// Google Fonts (Cormorant Garamond + Jost) used by the design.
	wp_enqueue_style(
		'babysprings-fonts',
		'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Jost:wght@300;400;500&display=swap',
		array(),
		null
	);

	// Main theme stylesheet (style.css in the theme root).
	wp_enqueue_style(
		'babysprings-style',
		get_stylesheet_uri(),
		array( 'babysprings-fonts' ),
		BABYSPRINGS_VERSION
	);

	// Front-end behaviour (nav, FAQ, reveal animations, Klaviyo form).
	wp_enqueue_script(
		'babysprings-main',
		get_theme_file_uri( 'assets/js/main.js' ),
		array(),
		BABYSPRINGS_VERSION,
		true
	);

	// Pass the Klaviyo settings (from the Customizer) to the front-end script
	// so the waitlist form knows which list/account to subscribe to. This is
	// the "integration" glue — nothing needs to be edited in code once the
	// keys are entered under Appearance → Customize → Klaviyo Waitlist.
	wp_localize_script(
		'babysprings-main',
		'BabySpringsKlaviyo',
		array(
			'listId'    => babysprings_get_option( 'babysprings_klaviyo_list_id', 'Um8kBy' ),
			'publicKey' => babysprings_get_option( 'babysprings_klaviyo_public_key', 'Sqxup7' ),
			'revision'  => babysprings_get_option( 'babysprings_klaviyo_revision', '2026-04-15' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'babysprings_assets' );

/**
 * Small helper: read a theme_mod (Customizer value) with a fallback default.
 *
 * @param string $key     Setting key.
 * @param string $default Default value if unset.
 * @return string
 */
function babysprings_get_option( $key, $default = '' ) {
	$value = get_theme_mod( $key, $default );
	return ( '' === $value || null === $value ) ? $default : $value;
}

/**
 * Return the logo image URL — the Customizer custom logo if one is set,
 * otherwise the bundled Baby Springs logo shipped with the theme.
 *
 * @return string
 */
function babysprings_logo_url() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( $custom_logo_id ) {
		$src = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		if ( $src ) {
			return $src[0];
		}
	}
	return get_theme_file_uri( 'assets/images/image03.png' );
}

/**
 * URL for a bundled theme image, used by the front-page template.
 *
 * @param string $file File name inside assets/images/.
 * @return string
 */
function babysprings_img( $file ) {
	return get_theme_file_uri( 'assets/images/' . $file );
}

/**
 * Add the ".link" class to each header menu <a> so WordPress menu items get
 * the same underline-on-hover styling as the original hand-coded links.
 *
 * @param array   $atts HTML attributes for the menu link.
 * @param WP_Post $item The menu item.
 * @param stdClass $args wp_nav_menu args (used to scope this to the primary menu).
 * @return array
 */
function babysprings_nav_link_class( $atts, $item, $args ) {
	if ( isset( $args->theme_location ) && 'primary' === $args->theme_location && empty( $args->is_mobile ) ) {
		$atts['class'] = trim( ( isset( $atts['class'] ) ? $atts['class'] . ' ' : '' ) . 'link' );
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'babysprings_nav_link_class', 10, 3 );

/**
 * Fallback menu shown when no menu has been assigned to the "primary"
 * location yet — reproduces the original About / Benefits / FAQ anchors so
 * the header is never empty on a fresh install.
 *
 * @param array $args wp_nav_menu args.
 */
function babysprings_default_menu( $args ) {
	$is_mobile = ! empty( $args['is_mobile'] );
	$class     = $is_mobile ? 'mobile-nav-menu' : 'nav-menu';
	$link_cls  = $is_mobile ? '' : ' class="link"';
	echo '<ul class="' . esc_attr( $class ) . '">';
	echo '<li><a' . $link_cls . ' href="#about">' . esc_html__( 'About', 'babyspring' ) . '</a></li>';
	echo '<li><a' . $link_cls . ' href="#benefits">' . esc_html__( 'Benefits', 'babyspring' ) . '</a></li>';
	echo '<li><a' . $link_cls . ' href="#faq">' . esc_html__( 'FAQ', 'babyspring' ) . '</a></li>';
	echo '</ul>';
}

require_once get_theme_file_path( 'inc/customizer.php' );
