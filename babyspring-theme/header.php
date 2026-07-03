<?php
/**
 * Site header: <head>, opening <body>, fixed nav and mobile menu.
 *
 * @package BabySprings
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ===== NAV ===== -->
<header id="header" class="site-header">
	<div class="wrap nav">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img class="logo-nav" src="<?php echo esc_url( babysprings_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
		</a>
		<nav class="nav-links" aria-label="<?php esc_attr_e( 'Primary', 'babyspring' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'nav-menu',
					'depth'          => 1,
					'fallback_cb'    => 'babysprings_default_menu',
				)
			);
			?>
			<a class="btn" href="#waitlist"><?php esc_html_e( 'Secure Your Spot', 'babyspring' ); ?></a>
		</nav>
		<button class="menu-btn" id="menuBtn" aria-label="<?php esc_attr_e( 'Open menu', 'babyspring' ); ?>">
			<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#3a3730" stroke-width="1.6"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
		</button>
	</div>
</header>

<div class="mobile-menu" id="mobileMenu">
	<button class="close" id="closeMenu" aria-label="<?php esc_attr_e( 'Close menu', 'babyspring' ); ?>">&times;</button>
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'mobile-nav-menu',
			'depth'          => 1,
			'is_mobile'      => true,
			'fallback_cb'    => 'babysprings_default_menu',
		)
	);
	?>
	<a class="btn" href="#waitlist"><?php esc_html_e( 'Secure Your Spot', 'babyspring' ); ?></a>
</div>
