<?php
/**
 * Site footer.
 *
 * @package BabySprings
 */

// Social links from the Customizer. Empty / "#" values are hidden.
$babysprings_socials = array(
	'instagram' => array(
		'url' => babysprings_get_option( 'babysprings_social_instagram', '#' ),
		'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>',
	),
	'facebook'  => array(
		'url' => babysprings_get_option( 'babysprings_social_facebook', '#' ),
		'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 9h3V6h-3c-2 0-3 1-3 3v2H8v3h3v7h3v-7h2.5l.5-3H14v-1.5c0-.6.4-1 1-1z"/></svg>',
	),
	'tiktok'    => array(
		'url' => babysprings_get_option( 'babysprings_social_tiktok', '#' ),
		'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M16 3c.3 2 1.7 3.6 4 4v3c-1.5 0-3-.5-4-1.3V15a6 6 0 1 1-6-6v3a3 3 0 1 0 3 3V3h3z"/></svg>',
	),
	'pinterest' => array(
		'url' => babysprings_get_option( 'babysprings_social_pinterest', '#' ),
		'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-4 19.2c-.1-.8-.2-2 0-2.9l1.2-5s-.3-.6-.3-1.5c0-1.4.8-2.4 1.8-2.4.9 0 1.3.6 1.3 1.5 0 .9-.6 2.2-.9 3.4-.2 1 .5 1.8 1.5 1.8 1.8 0 3-2.3 3-5 0-2-1.4-3.6-3.9-3.6-2.9 0-4.6 2.1-4.6 4.4 0 .9.3 1.5.7 2 .2.2.2.3.1.6l-.2.9c-.1.3-.3.4-.6.2-1.2-.5-1.8-1.9-1.8-3.5 0-2.6 2.2-5.7 6.6-5.7 3.5 0 5.8 2.5 5.8 5.3 0 3.6-2 6.3-4.9 6.3-1 0-1.9-.5-2.2-1.1l-.6 2.4c-.2.8-.7 1.7-1 2.3A10 10 0 1 0 12 2z"/></svg>',
	),
);
?>

<!-- ===== FOOTER ===== -->
<footer class="site-footer">
	<div class="wrap foot">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img class="logo-foot" src="<?php echo esc_url( babysprings_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
		</a>
		<div class="socials">
			<?php
			foreach ( $babysprings_socials as $name => $social ) {
				// Hide an icon only if its field was cleared out entirely.
				if ( '' === trim( (string) $social['url'] ) ) {
					continue;
				}
				$is_placeholder = ( '#' === $social['url'] );
				printf(
					'<a href="%1$s" aria-label="%2$s"%3$s>%4$s</a>',
					esc_url( $social['url'] ),
					esc_attr( ucfirst( $name ) ),
					$is_placeholder ? '' : ' target="_blank" rel="noopener noreferrer"',
					$social['svg'] // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static inline SVG.
				);
			}
			?>
		</div>
		<div class="divider"></div>
		<div class="meta">
			<?php echo esc_html( babysprings_get_option( 'babysprings_footer_meta', 'Bethesda, Maryland · Opening March 2027' ) ); ?><br />
			<?php echo esc_html( babysprings_get_option( 'babysprings_footer_copyright', '© 2026 Baby Springs. All rights reserved.' ) ); ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
