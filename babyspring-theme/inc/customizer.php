<?php
/**
 * Customizer settings for Baby Springs.
 *
 * Adds a "Klaviyo Waitlist" section (integration keys + thank-you redirect)
 * and a "Footer & Social" section (social URLs + footer text) so the site
 * owner can manage everything from Appearance → Customize without touching
 * code.
 *
 * @package BabySprings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Customizer sections, settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function babysprings_customize_register( $wp_customize ) {

	/* -------------------------------------------------------------------
	 * Klaviyo Waitlist integration
	 * ---------------------------------------------------------------- */
	$wp_customize->add_section(
		'babysprings_klaviyo',
		array(
			'title'       => __( 'Klaviyo Waitlist', 'babyspring' ),
			'priority'    => 30,
			'description' => __( 'Connect the waitlist form to your Klaviyo account. Find these in Klaviyo: List ID under Audience → Lists & Segments → your list; Public API Key under Settings → API Keys.', 'babyspring' ),
		)
	);

	$klaviyo_fields = array(
		'babysprings_klaviyo_list_id'    => array(
			'label'   => __( 'Klaviyo List ID', 'babyspring' ),
			'default' => 'Um8kBy',
			'desc'    => __( 'The ID of the list new signups are added to (e.g. Um8kBy). This is what triggers your welcome flow.', 'babyspring' ),
		),
		'babysprings_klaviyo_public_key' => array(
			'label'   => __( 'Klaviyo Public API Key', 'babyspring' ),
			'default' => 'Sqxup7',
			'desc'    => __( 'Your public API key / Site ID (safe to expose publicly). NOT the private key.', 'babyspring' ),
		),
		'babysprings_klaviyo_revision'   => array(
			'label'   => __( 'Klaviyo API Revision', 'babyspring' ),
			'default' => '2026-04-15',
			'desc'    => __( 'API version date. Only change this if Klaviyo retires the current revision.', 'babyspring' ),
		),
	);

	foreach ( $klaviyo_fields as $id => $field ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'       => $field['label'],
				'description' => $field['desc'],
				'section'     => 'babysprings_klaviyo',
				'type'        => 'text',
			)
		);
	}

	$wp_customize->add_setting(
		'babysprings_thankyou_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'babysprings_thankyou_url',
		array(
			'label'       => __( 'Thank You page URL (optional override)', 'babyspring' ),
			'description' => __( 'Leave blank to auto-use the published Page assigned the "Thank You" page template. Only set this if you want to redirect somewhere else.', 'babyspring' ),
			'section'     => 'babysprings_klaviyo',
			'type'        => 'url',
		)
	);

	/* -------------------------------------------------------------------
	 * Footer & Social
	 * ---------------------------------------------------------------- */
	$wp_customize->add_section(
		'babysprings_footer',
		array(
			'title'    => __( 'Footer & Social', 'babyspring' ),
			'priority' => 31,
		)
	);

	$footer_text_fields = array(
		'babysprings_footer_meta'      => array(
			'label'   => __( 'Footer line (location / opening)', 'babyspring' ),
			'default' => 'Bethesda, Maryland · Opening March 2027',
		),
		'babysprings_footer_copyright' => array(
			'label'   => __( 'Copyright line', 'babyspring' ),
			'default' => '© 2026 Baby Springs. All rights reserved.',
		),
	);

	foreach ( $footer_text_fields as $id => $field ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $field['label'],
				'section' => 'babysprings_footer',
				'type'    => 'text',
			)
		);
	}

	// Social URLs — leave blank to hide an icon.
	$social_fields = array(
		'babysprings_social_instagram' => array(
			'label'   => __( 'Instagram URL', 'babyspring' ),
			'default' => 'https://www.instagram.com/babysprings.studio',
		),
		'babysprings_social_facebook'  => array(
			'label'   => __( 'Facebook URL', 'babyspring' ),
			'default' => 'https://www.facebook.com/people/Baby-Springs/61585545691683',
		),
		'babysprings_social_tiktok'    => array(
			'label'   => __( 'TikTok URL', 'babyspring' ),
			'default' => 'https://www.tiktok.com/@babysprings.studio',
		),
		'babysprings_social_pinterest' => array(
			'label'   => __( 'Pinterest URL', 'babyspring' ),
			'default' => 'https://www.pinterest.com/BabySpringsStudio',
		),
	);

	foreach ( $social_fields as $id => $field ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => 'esc_url_raw',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $field['label'],
				'section' => 'babysprings_footer',
				'type'    => 'url',
			)
		);
	}
}
add_action( 'customize_register', 'babysprings_customize_register' );
