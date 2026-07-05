<?php
/**
 * Template Name: Thank You
 *
 * Standalone confirmation page (ported from thank-you.html) shown after a
 * successful Klaviyo waitlist subscription. Create a WordPress Page and
 * assign this template under Page Attributes — the waitlist form
 * auto-detects it (see babysprings_thank_you_url() in functions.php).
 *
 * @package BabySprings
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<meta name="color-scheme" content="light only" />
	<title>Thank You &#8212; Baby Springs</title>
	<meta name="description" content="Thank you for joining the Baby Springs founding waitlist." />
	<meta name="robots" content="noindex" />
	<link rel="icon" type="image/png" href="<?php echo esc_url( babysprings_asset( 'assets/images/favicon.png' ) ); ?>" />
	<link rel="apple-touch-icon" href="<?php echo esc_url( babysprings_asset( 'assets/images/apple-touch-icon.png' ) ); ?>" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?display=swap&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400" rel="stylesheet" type="text/css" />
	<style>
		* { margin: 0; padding: 0; box-sizing: border-box; }
		html { scroll-behavior: smooth; }
		body {
			font-family: Arial, Helvetica, sans-serif;
			background: #F8F3EF;
			color: #2f2f2f;
			line-height: 1.6;
			min-width: 320px;
		}
		a { color: inherit; text-decoration: none; }
		img { max-width: 100%; display: block; }
		.wrap { width: min(1180px, 92%); margin: 0 auto; }

		.ty-main { padding: clamp(2.5rem, 6vw, 5.5rem) 0; }
		.ty-grid {
			display: grid;
			grid-template-columns: 1.05fr 1fr;
			gap: clamp(2rem, 5vw, 4rem);
			align-items: center;
		}
		.ty-title {
			font-family: 'Cormorant Garamond', serif;
			font-weight: 500;
			font-size: clamp(2.4rem, 4.2vw, 3.2rem);
			color: #2f2f2f;
			margin-bottom: 1.2rem;
		}
		.ty-divider { width: 4.5rem; height: 2px; background: #d8d3cd; border: 0; margin-bottom: 1.4rem; }
		.ty-copy {
			font-family: 'Cormorant Garamond', serif;
			font-weight: 500;
			font-size: 1.35rem;
			line-height: 1.5;
			color: #6C816B;
			max-width: 30rem;
			margin-bottom: 1.6rem;
		}

		.ty-btn {
			display: inline-flex; align-items: center; gap: .6rem;
			padding: .95rem 1.8rem;
			background: #74866E; color: #fafafa; border-radius: 2px;
			font-size: .82rem; font-weight: 400; letter-spacing: .12em; text-transform: uppercase;
			transition: background-color .2s ease;
		}
		.ty-btn:hover { background: #5f7e6e; }

		.ty-image { border-radius: 6px; overflow: hidden; }
		.ty-image img { width: 100%; height: 100%; object-fit: cover; }

		@media (max-width: 860px) {
			.ty-grid { grid-template-columns: 1fr; }
			.ty-image { order: -1; max-height: 60vh; }
		}

		.ty-footer { border-top: 1px solid #e2dacb; padding: 2.5rem 0; }
		.ty-footer .wrap {
			display: grid;
			grid-template-columns: 1fr auto 1fr;
			align-items: center;
			gap: 1.5rem;
		}
		.ty-footer-logo img { height: 3.2rem; width: auto; }
		.ty-footer-logo-mobile { display: none; }
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
			.ty-footer-logo-desktop { display: none; }
			.ty-footer-logo-mobile { display: inline-block; }
			.ty-footer-logo-mobile img { height: auto; width: 12rem; }
		}
	</style>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<main class="ty-main">
		<div class="wrap">
			<div class="ty-grid">
				<div>
					<h1 class="ty-title">Thank you!</h1>
					<hr class="ty-divider" />
					<p class="ty-copy">Welcome to Baby Springs. You&#8217;re officially on the waitlist. We&#8217;ll be in touch soon with exciting updates.</p>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ty-btn">Back to homepage</a>
				</div>
				<div class="ty-image">
					<img src="<?php echo esc_url( babysprings_asset( 'assets/images/image04.jpg' ) ); ?>" alt="" />
				</div>
			</div>
		</div>
	</main>

	<footer class="ty-footer">
		<div class="wrap">
			<div class="ty-footer-meta">
				<p><?php echo esc_html( babysprings_get_option( 'babysprings_footer_meta', 'Bethesda, Maryland · Opening March 2027' ) ); ?></p>
				<p><?php echo esc_html( babysprings_get_option( 'babysprings_footer_copyright', '© 2026 Baby Springs. All rights reserved.' ) ); ?></p>
			</div>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ty-footer-logo ty-footer-logo-desktop"><img src="<?php echo esc_url( babysprings_asset( 'assets/images/image10.png' ) ); ?>" alt="Baby Springs" /></a>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ty-footer-logo ty-footer-logo-mobile"><img src="<?php echo esc_url( babysprings_asset( 'assets/images/logo-horizontal.png' ) ); ?>" alt="Baby Springs" /></a>
			<div class="ty-socials">
				<?php
				$babysprings_ty_socials = array(
					'instagram' => array(
						'url'   => babysprings_get_option( 'babysprings_social_instagram', 'https://www.instagram.com/babysprings.studio' ),
						'label' => 'Instagram',
					),
					'facebook'  => array(
						'url'   => babysprings_get_option( 'babysprings_social_facebook', 'https://www.facebook.com/people/Baby-Springs/61585545691683' ),
						'label' => 'Facebook',
					),
					'tiktok'    => array(
						'url'   => babysprings_get_option( 'babysprings_social_tiktok', 'https://www.tiktok.com/@babysprings.studio' ),
						'label' => 'TikTok',
					),
					'pinterest' => array(
						'url'   => babysprings_get_option( 'babysprings_social_pinterest', 'https://www.pinterest.com/BabySpringsStudio' ),
						'label' => 'Pinterest',
					),
				);
				foreach ( $babysprings_ty_socials as $babysprings_ty_name => $babysprings_ty_social ) {
					if ( '' === trim( (string) $babysprings_ty_social['url'] ) ) {
						continue;
					}
					?>
				<a href="<?php echo esc_url( $babysprings_ty_social['url'] ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $babysprings_ty_social['label'] ); ?>">
					<svg viewBox="0 0 40 40"><use xlink:href="<?php echo esc_url( babysprings_asset( 'assets/icons.svg' ) ); ?>#<?php echo esc_attr( $babysprings_ty_name ); ?>"></use></svg>
				</a>
				<?php
				}
				?>
			</div>
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>
