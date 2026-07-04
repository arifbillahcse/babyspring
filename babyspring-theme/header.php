<?php
/**
 * Site header: <head>, opening <body> and the outer Carrd wrapper divs.
 *
 * The rest of the page (nav, hero, benefits, waitlist form, FAQ, footer
 * content) lives in front-page.php / page.php, all inside the same
 * <section id="home-section"> that this file opens and footer.php closes —
 * this mirrors the original static export's markup exactly.
 *
 * @package BabySprings
 */

?><!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
	<title><?php
	if ( is_front_page() ) {
		echo 'Baby Springs &#8212; DMV&#8217;s First Infant Hydrotherapy Wellness Studio';
	} else {
		echo esc_html( wp_get_document_title() );
	}
	?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<meta name="color-scheme" content="light only" />
	<?php if ( is_front_page() ) : ?>
	<meta name="description" content="Gentle, development-focused infant hydrotherapy and wellness in Bethesda, Maryland. Join the founding waitlist. Opening March 2027." />
	<?php endif; ?>
	<link rel="icon" type="image/png" href="<?php echo esc_url( babysprings_asset( 'assets/images/favicon.png' ) ); ?>" />
	<link rel="apple-touch-icon" href="<?php echo esc_url( babysprings_asset( 'assets/images/apple-touch-icon.png' ) ); ?>" />
	<noscript><link rel="stylesheet" href="<?php echo esc_url( babysprings_asset( 'assets/noscript.css' ) ); ?>" /></noscript>
	<script type="text/javascript">
	(function(c,l,a,r,i,t,y){
	c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
	t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
	y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
	})(window, document, "clarity", "script", "wqiiqhjcs1");
	</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'is-loading' ); ?>>
<?php wp_body_open(); ?>
<div class="site-wrapper">
	<div class="site-main" role="main">
		<div class="inner">
			<section id="home-section">
