<?php
/**
 * Front page — the Baby Springs landing page.
 *
 * Ported 1:1 from the Carrd static export (index.html): nav, hero,
 * benefits, waitlist form (desktop + mobile), FAQ, and the footer-style
 * closing container. Component markup/classes are left untouched so the
 * bundled assets/main.css and assets/main.js keep working unmodified.
 *
 * @package BabySprings
 */

get_header();

// Footer-style closing container (bottom of this file) pulls its social
// links and meta text from the Customizer — see inc/customizer.php.
$babysprings_socials = array(
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
$babysprings_footer_meta      = babysprings_get_option( 'babysprings_footer_meta', 'Bethesda, Maryland · Opening March 2027' );
$babysprings_footer_copyright = babysprings_get_option( 'babysprings_footer_copyright', '© 2026 Baby Springs. All rights reserved.' );
?>
<div id="container02" class="container-component instance-2 columns full screen">
	<div class="wrapper">
		<div class="inner">
			<div>
				<div id="image03" class="image-component instance-3">
					<a onclick="_scrollToTop();" tabindex="0" class="frame"><img src="<?php echo esc_url( babysprings_asset( 'assets/images/image03.png' ) ); ?>" alt="" /></a>
				</div>
			</div>
			<div>
				<div id="embed02" class="embed-component instance-2">
					<!-- Baby Springs — Nav Menu (sn-nav template, Carrd-safe) -->
					<link rel="preconnect" href="https://fonts.googleapis.com" />
					<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

					<style>
					:root {
					--mbm-main-font: Arial, sans-serif;
					--mbm-font-size-base: 14px;
					--primary-color: #f7f5f2;
					--secondary-color: #2f2f2f;
					--muted-color: #6C6F73;
					--link-hover: #74866E;
					--button-bg: #74866E;
					--button-bg-hover: #5f7e6e;
					--button-text: #fafafa;
					--button-radius: 0.125em;
					--border-color: #d8d3cd;
					}

					.sn-nav *,
					.sn-nav *::before,
					.sn-nav *::after {
					box-sizing: border-box;
					margin: 0;
					padding: 0;
					}

					.sn-nav {
					background: transparent;
					padding: 0 1.5em;
					display: flex;
					align-items: center;
					justify-content: flex-end;
					font-family: var(--mbm-main-font);
					font-size: var(--mbm-font-size-base);
					height: 4.5em;
					position: relative;
					}

					.sn-menu {
					list-style: none;
					display: flex;
					align-items: center;
					gap: 0.5em;
					}

					.sn-menu li a {
					display: block;
					color: var(--muted-color);
					text-decoration: none;
					padding: 0.5em 0.75em;
					position: relative;
					font-family: var(--mbm-main-font);
					font-weight: 400;
					font-size: 0.75em;
					letter-spacing: 0.22em;
					text-transform: uppercase;
					transition: color 0.2s;
					}

					.sn-menu li a:hover {
					color: var(--link-hover);
					}

					.sn-menu li a::after {
					content: "";
					position: absolute;
					bottom: 0.125em;
					left: 50%;
					width: 0;
					height: 0.125em;
					background-color: var(--link-hover);
					transition: width 0.3s ease-in-out, left 0.3s ease-in-out;
					}

					.sn-menu li a:hover::after {
					width: calc(100% - 1.5em);
					left: 0.75em;
					}

					/* ---- CTA BUTTON ---- */
					.sn-menu li a.sn-button-style {
					background-color: var(--button-bg);
					color: var(--button-text);
					border-radius: var(--button-radius);
					padding: 1.15em 2em;
					margin-left: 0.75em;
					font-family: var(--mbm-main-font);
					font-weight: 400;
					font-size: 0.8125em;
					letter-spacing: 0.24em;
					text-transform: uppercase;
					transition: background-color 0.2s ease;
					}

					.sn-menu li a.sn-button-style:hover {
					background-color: var(--button-bg-hover);
					color: var(--button-text);
					}

					.sn-menu li a.sn-button-style::after {
					display: none;
					}

					/* Show desktop CTA only on desktop */
					.sn-cta-desktop { display: list-item; }
					.sn-cta-mobile { display: none; }

					/* ---- HAMBURGER ---- */
					.sn-hamburger {
					display: none;
					cursor: pointer;
					padding: 0.5em;
					}

					.sn-hamburger .sn-bar {
					display: block;
					width: 1.5em;
					height: 0.125em;
					background-color: var(--secondary-color);
					margin: 0.3125em 0;
					border-radius: 0.125em;
					transition: background-color 0.2s;
					}

					#sn-menu-toggle { display: none; }
					.sn-close-button { display: none; }

					/* ---- MOBILE ---- */
					@media (max-width: 768px) {
					.sn-nav {
					justify-content: flex-end;
					}

					.sn-hamburger { display: block; }

					/* Swap CTAs on mobile */
					.sn-cta-desktop { display: none; }
					.sn-cta-mobile { display: list-item; }

					.sn-menu {
					position: absolute;
					width: 100%;
					top: 4.5em;
					left: 0;
					background-color: var(--primary-color);
					border-top: 0.0625em solid var(--border-color);
					text-align: center;
					padding: 1.5em 0 2em;
					display: none;
					flex-direction: column;
					gap: 0;
					z-index: 999;
					box-shadow: 0 0.5em 1.5em #0000001A;
					}

					.sn-menu li { width: 100%; }

					.sn-menu li a {
					padding: 0.875em 1.5em;
					font-size: 0.75em;
					border-bottom: 0.0625em solid var(--border-color);
					color: var(--muted-color);
					}

					.sn-menu li a:hover {
					color: var(--link-hover);
					}

					.sn-menu li a::after { display: none; }

					.sn-menu li a.sn-button-style {
					margin: 1em 1.5em 0;
					width: calc(100% - 3em);
					border-radius: var(--button-radius);
					border-bottom: none;
					display: block;
					text-align: center;
					}

					#sn-menu-toggle:checked ~ .sn-menu { display: flex; }

					.sn-close-button {
					display: block;
					position: absolute;
					top: 1em;
					right: 1.5em;
					background: none;
					border: none;
					font-size: 1.25em;
					color: var(--secondary-color);
					cursor: pointer;
					font-family: var(--mbm-main-font);
					line-height: 1;
					}
					}
					</style>

					<nav class="sn-nav">
					<input type="checkbox" id="sn-menu-toggle" />
					<label for="sn-menu-toggle" class="sn-hamburger">
					<span class="sn-bar"></span>
					<span class="sn-bar"></span>
					<span class="sn-bar"></span>
					</label>
					<ul class="sn-menu">
					<button class="sn-close-button" type="button">&#x2715;</button>
					<li><a href="#about">About</a></li>

					<li><a href="#benefit">Benefits</a></li>
					<li><a href="#faq">FAQ</a></li>
					<li class="sn-cta-desktop"><a href="#spot" class="sn-button-style">Secure Your Spot</a></li>
					<li class="sn-cta-mobile"><a href="#spot-mobile" class="sn-button-style">Secure Your Spot</a></li>
					</ul>
					</nav>

					<unloaded-script>
					(function () {
					var toggle = document.getElementById("sn-menu-toggle");
					var closeBtn = document.querySelector(".sn-close-button");

					if (closeBtn) {
					closeBtn.addEventListener("click", function () {
					if (toggle) toggle.checked = false;
					});
					}

					document.querySelectorAll(".sn-menu a").forEach(function (link) {
					link.addEventListener("click", function () {
					if (toggle) toggle.checked = false;
					});
					});
					})();
					</unloaded-script>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="container12" data-scroll-id="about" data-scroll-behavior="default" data-scroll-offset="0" data-scroll-speed="3" class="container-component instance-12 columns full screen">
	<div class="wrapper">
		<div class="inner">
			<div>
				<p id="text26" class="text-component instance-26">Gentle Care. Stronger Foundations.</p>
				<h1 id="text30" class="text-component instance-30"><span class="p">DMV&#39;s First<br />Infant Hydrotherapy Wellness Studio</span></h1>
				<p id="text31" class="text-component instance-31"><em>Designed to support your baby&#39;s development from the very beginning.</em></p>
				<hr id="divider06" class="divider-component instance-6">
				<p id="text32" class="text-component instance-32">Gentle, development-focused care for your baby — in a calm, private setting, inspired by established wellness practices across Asia and Europe.</p>
				<ul id="buttons08" class="buttons-component instance-8" data-visibility="desktop">
					<li>
						<a href="#spot" class="n01" role="button">Secure Your Spot</a>
					</li>
				</ul>
				<ul id="buttons09" class="buttons-component instance-9" data-visibility="mobile">
					<li>
						<a href="#spot-mobile" class="n01" role="button">Secure Your Spot</a>
					</li>
				</ul>
				<ul id="buttons10" class="buttons-component instance-10">
					<li>
						<a  class="n01" role="button"><svg aria-labelledby="buttons10-icon-1-title"><title id="buttons10-icon-1-title">Lock (Alt)</title><use xlink:href="<?php echo esc_url( babysprings_asset( 'assets/icons.svg' ) ); ?>#lock-alt"></use></svg><span class="label">Limited to first 100 families</span></a>
					</li><li>
						<a  class="n02" role="button"><svg aria-labelledby="buttons10-icon-2-title"><title id="buttons10-icon-2-title">Location</title><use xlink:href="<?php echo esc_url( babysprings_asset( 'assets/icons.svg' ) ); ?>#location"></use></svg><span class="label">Bethesda, Maryland</span></a>
					</li><li>
						<a href="#" class="n03" role="button"><svg aria-labelledby="buttons10-icon-3-title"><title id="buttons10-icon-3-title">Calendar</title><use xlink:href="<?php echo esc_url( babysprings_asset( 'assets/icons.svg' ) ); ?>#calendar"></use></svg><span class="label">Opening March 2027</span></a>
					</li>
				</ul>
			</div>
			<div>
				<div id="image02" class="image-component instance-2 full">
					<span class="frame"><img src="<?php echo esc_url( babysprings_asset( 'assets/images/image02.jpg' ) ); ?>" alt="" /></span>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="container09" data-scroll-id="benefit" data-scroll-behavior="default" data-scroll-offset="0" data-scroll-speed="3" class="container-component instance-9 default full screen">
	<div class="wrapper">
		<div class="inner">
			<hr id="divider04" class="divider-component instance-4">
		</div>
	</div>
</div>
<div id="container07" class="container-component instance-7 default full screen">
	<div class="wrapper">
		<div class="inner">
			<h2 id="text13" class="text-component instance-13">Where early development meets intentional care.</h2>
			<p id="text14" class="text-component instance-14">Across Asia and Europe, infant hydrotherapy and massage are valued for their role in early development and wellbeing.</p>
		</div>
	</div>
</div>
<div id="container01" class="container-component instance-1 columns full screen">
	<div class="wrapper">
		<div class="inner">
			<div class="bs-benefit"><div class="bs-benefit-card">
				<div id="image07" class="image-component instance-7">
					<a onclick="_scrollToTop();" tabindex="0" class="frame"><img src="<?php echo esc_url( babysprings_asset( 'assets/images/image07.png' ) ); ?>" alt="" /></a>
				</div>
				<p id="text15" class="text-component instance-15 bs-benefit-title">Supports development &amp; movement</p>
				<p id="text18" class="text-component instance-18">Encourages healthy physical growth and body awareness.</p>
			</div></div>
			<div class="bs-benefit"><div class="bs-benefit-card">
				<div id="image08" class="image-component instance-8">
					<a onclick="_scrollToTop();" tabindex="0" class="frame"><img src="<?php echo esc_url( babysprings_asset( 'assets/images/image08.png' ) ); ?>" alt="" /></a>
				</div>
				<p id="text27" class="text-component instance-27 bs-benefit-title" data-visibility="desktop"><span class="p">Promotes better<br />sleep</span></p>
				<p id="text16" class="text-component instance-16 bs-benefit-title" data-visibility="mobile">Promotes better sleep</p>
				<p id="text19" class="text-component instance-19">Helps regulate and calm the nervous system.</p>
			</div></div>
			<div class="bs-benefit"><div class="bs-benefit-card">
				<div id="image09" class="image-component instance-9">
					<a onclick="_scrollToTop();" tabindex="0" class="frame"><img src="<?php echo esc_url( babysprings_asset( 'assets/images/image09.png' ) ); ?>" alt="" /></a>
				</div>
				<p id="text17" class="text-component instance-17 bs-benefit-title">Enhances bonding &amp; connection</p>
				<p id="text20" class="text-component instance-20">Creates meaningful, uninterrupted time together.</p>
			</div></div>
			<div class="bs-benefit"><div class="bs-benefit-card">
				<div id="image06" class="image-component instance-6">
					<a onclick="_scrollToTop();" tabindex="0" class="frame"><img src="<?php echo esc_url( babysprings_asset( 'assets/images/image06.png' ) ); ?>" alt="" /></a>
				</div>
				<p id="text28" class="text-component instance-28 bs-benefit-title" data-visibility="desktop"><span class="p">Stimulates the<br />senses</span></p>
				<p id="text06" class="text-component instance-6 bs-benefit-title" data-visibility="mobile">Stimulates the senses</p>
				<p id="text10" class="text-component instance-10">Supports early sensory and cognitive development.</p>
			</div></div>
		</div>
	</div>
</div>
<div id="container05" class="container-component instance-5 default full screen">
	<div class="wrapper">
		<div class="inner">
			<hr id="divider03" class="divider-component instance-3" data-visibility="mobile">
			<ul id="buttons02" class="buttons-component instance-2" data-visibility="desktop">
				<li>
					<a href="#spot" class="n01" role="button">Secure Your Spot</a>
				</li>
			</ul>
			<ul id="buttons06" class="buttons-component instance-6" data-visibility="mobile">
				<li>
					<a href="#spot-mobile" class="n01" role="button">Secure Your Spot</a>
				</li>
			</ul>
			<p id="text05" class="text-component instance-5">Limited access available.</p>
			<hr id="divider05" class="divider-component instance-5">
		</div>
	</div>
</div>
<div id="container06" data-scroll-id="spot" data-scroll-behavior="default" data-scroll-offset="0" data-scroll-speed="3" class="container-component instance-6 columns full screen" data-visibility="desktop">
	<div class="wrapper">
		<div class="inner">
			<div>
				<div id="image01" class="image-component instance-1 full">
					<span class="frame"><img src="<?php echo esc_url( babysprings_asset( 'assets/images/image01.jpg' ) ); ?>" alt="" /></span>
				</div>
			</div>
			<div>
				<h3 id="text01" class="text-component instance-1"><span class="p">For a limited number<br />of founding families</span></h3>
				<p id="text09" class="text-component instance-9">Be among the first to experience a new standard in infant wellness.</p>
				<p id="text21" class="text-component instance-21">Early access to bookings will be offered in limited phases, starting with waitlist members.</p>
				<ul id="buttons01" class="buttons-component instance-1">
					<li>
						<a  class="n01" role="button"><svg aria-labelledby="buttons01-icon-1-title"><title id="buttons01-icon-1-title">Location</title><use xlink:href="<?php echo esc_url( babysprings_asset( 'assets/icons.svg' ) ); ?>#location"></use></svg><span class="label">Bethesda, Maryland</span></a>
					</li><li>
						<a href="#" class="n02" role="button"><svg aria-labelledby="buttons01-icon-2-title"><title id="buttons01-icon-2-title">Calendar</title><use xlink:href="<?php echo esc_url( babysprings_asset( 'assets/icons.svg' ) ); ?>#calendar"></use></svg><span class="label">Opening March 2027</span></a>
					</li><li>
						<a  class="n03" role="button"><svg aria-labelledby="buttons01-icon-3-title"><title id="buttons01-icon-3-title">Lock</title><use xlink:href="<?php echo esc_url( babysprings_asset( 'assets/icons.svg' ) ); ?>#lock"></use></svg><span class="label">Limited to first 100 families.</span></a>
					</li>
				</ul>
			</div>
			<div>
				<form class="bs-wl-form" id="form02" novalidate>
					<!-- Baby Springs — Waitlist Form -->
					<div class="bs-wl-inner">
						<div class="bs-wl-field"><input type="text" name="name" id="form02-name" placeholder="Name" required /></div>
						<div class="bs-wl-field"><input type="email" name="email" id="form02-email" placeholder="Email Address" required /></div>
						<div class="bs-wl-field bs-wl-field-date">
							<div class="bs-wl-date-shell">
								<input type="date" name="baby_age_or_due_date" id="form02-baby_age_or_due_date" class="bs-wl-date-input" aria-label="Baby's Age or Due Date" />
								<span class="bs-wl-date-display bs-wl-placeholder" aria-hidden="true">Baby&#039;s Age or Due Date</span>
							</div>
						</div>
						<button class="bs-wl-btn" type="submit" id="form02-submitBtn">
							<span class="bs-wl-btn-label">Secure Your Spot</span>
							<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
						</button>
						<p class="bs-wl-error" id="form02-error" role="alert"></p>
						<p class="bs-wl-urgency"><span class="bs-wl-dot" aria-hidden="true"></span>Limited waitlist availability.</p>
					</div>
				</form>
				<p id="text22" class="text-component instance-22">You&#39;ll receive early booking access, founding member benefits, and priority scheduling.</p>
			</div>
		</div>
	</div>
</div>
<div id="container10" data-scroll-id="spot-mobile" data-scroll-behavior="default" data-scroll-offset="10" data-scroll-speed="3" class="container-component instance-10 columns full screen" data-visibility="mobile">
	<div class="wrapper">
		<div class="inner">
			<div>
				<div id="image05" class="image-component instance-5 full">
					<span class="frame"><img src="<?php echo esc_url( babysprings_asset( 'assets/images/image05.jpg' ) ); ?>" alt="" /></span>
				</div>
			</div>
			<div>
				<form class="bs-wl-form" id="form03" novalidate>
					<div class="bs-wl-inner">
						<div class="bs-wl-field"><input type="text" name="name" id="form03-name" placeholder="Name" required /></div>
						<div class="bs-wl-field"><input type="email" name="email" id="form03-email" placeholder="Email Address" required /></div>
						<div class="bs-wl-field bs-wl-field-date">
							<div class="bs-wl-date-shell">
								<input type="date" name="baby_age_or_due_date" id="form03-baby_age_or_due_date" class="bs-wl-date-input" aria-label="Baby's Age or Due Date" />
								<span class="bs-wl-date-display bs-wl-placeholder" aria-hidden="true">Baby&#039;s Age or Due Date</span>
							</div>
						</div>
						<button class="bs-wl-btn" type="submit" id="form03-submitBtn">
							<span class="bs-wl-btn-label">Secure Your Spot</span>
							<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
						</button>
						<p class="bs-wl-error" id="form03-error" role="alert"></p>
						<p class="bs-wl-urgency"><span class="bs-wl-dot" aria-hidden="true"></span>Limited waitlist availability.</p>
					</div>
				</form>
				<p id="text29" class="text-component instance-29">You&#39;ll receive early booking access, founding member benefits, and priority scheduling.</p>
			</div>
			<div>
				<h3 id="text23" class="text-component instance-23"><span class="p">For a limited number<br />of founding families</span></h3>
				<p id="text24" class="text-component instance-24">Be among the first to experience a new standard in infant wellness.</p>
				<p id="text25" class="text-component instance-25">Early access to bookings will be offered in limited phases, starting with waitlist members.</p>
				<ul id="buttons03" class="buttons-component instance-3">
					<li>
						<a  class="n01" role="button"><svg aria-labelledby="buttons03-icon-1-title"><title id="buttons03-icon-1-title">Location</title><use xlink:href="<?php echo esc_url( babysprings_asset( 'assets/icons.svg' ) ); ?>#location"></use></svg><span class="label">Bethesda, Maryland</span></a>
					</li><li>
						<a href="#" class="n02" role="button"><svg aria-labelledby="buttons03-icon-2-title"><title id="buttons03-icon-2-title">Calendar</title><use xlink:href="<?php echo esc_url( babysprings_asset( 'assets/icons.svg' ) ); ?>#calendar"></use></svg><span class="label">Opening March 2027</span></a>
					</li><li>
						<a  class="n03" role="button"><svg aria-labelledby="buttons03-icon-3-title"><title id="buttons03-icon-3-title">Lock</title><use xlink:href="<?php echo esc_url( babysprings_asset( 'assets/icons.svg' ) ); ?>#lock"></use></svg><span class="label">Limited to first 100 families.</span></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div id="container04" data-scroll-id="faq" data-scroll-behavior="default" data-scroll-offset="0" data-scroll-speed="3" class="container-component instance-4 default full screen">
	<div class="wrapper">
		<div class="inner">
			<h2 id="text07" class="text-component instance-7">Frequently asked questions</h2>
			<hr id="divider01" class="divider-component instance-1">
			<p id="text08" class="text-component instance-8">Have another question? <a href="mailto:hello@babyspringsstudio.com?subject=Baby%20Springs%20Inquiry&body=Hello%20Baby%20Springs%2C%0D%0A%0D%0AI%27d%20love%20to%20learn%20more%20about%20your%20infant%20wellness%20studio.%0D%0A%0D%0AName%3A%0D%0A%0D%0ABaby%27s%20Age%20(or%20Due%20Date)%3A%0D%0A%0D%0AQuestion%3A">We&#39;d love to hear from you.</a></p>
		</div>
	</div>
</div>
<div id="embed01" class="embed-component instance-1">
	<!-- Baby Springs — FAQ List Embed (Carrd-safe) -->
	<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400&display=swap" rel="stylesheet">

	<style>
	.bs-faq,
	.bs-faq * {
	box-sizing: border-box;
	}

	.bs-faq {
	max-width: 48em;
	margin: 0 auto;
	font-family: "Helvetica Neue";
	color: #5C5C5C;
	line-height: 1.5;
	}

	.bs-faq .bs-faq-list {
	margin: 0;
	padding: 0;
	list-style: none;
	display: flex;
	flex-direction: column;
	gap: 0.75em;
	}

	.bs-faq .bs-faq-item {
	border: 0.0625em solid #d8d3cd;
	background: #f7f5f2;
	border-radius: 0.125em;
	overflow: hidden;
	}

	.bs-faq .bs-faq-q {
	width: 100%;
	display: flex;
	align-items: center;
	justify-content: space-between;
	gap: 1em;
	padding: 1em 1.25em;
	text-align: left;
	font-family: "Helvetica Neue";
	font-size: 0.9375em;
	font-weight: 400;
	color: #5C5C5C;
	background: none;
	border: 0;
	cursor: pointer;
	line-height: 1.4;
	}

	.bs-faq .bs-faq-q svg {
	width: 1em;
	height: 1em;
	flex-shrink: 0;
	color: #8a8580;
	stroke: currentColor;
	fill: none;
	stroke-width: 1.5;
	stroke-linecap: round;
	stroke-linejoin: round;
	display: block;
	}

	.bs-faq .bs-faq-a {
	padding: 0 1.25em 1.25em;
	font-family: "Helvetica Neue";
	font-size: 0.875em;
	line-height: 1.6;
	color: #5C5C5CCC;
	display: none;
	}

	.bs-faq .bs-faq-item.bs-open .bs-faq-a {
	display: block;
	}

	.bs-faq .bs-faq-item.bs-open .bs-icon-plus {
	display: none;
	}

	.bs-faq .bs-faq-item:not(.bs-open) .bs-icon-minus {
	display: none;
	}
	</style>

	<div class="bs-faq">
	<ul class="bs-faq-list">

	<li class="bs-faq-item">
	<button class="bs-faq-q" type="button" aria-expanded="false">
	<span>Is this safe for babies?</span>
	<svg class="bs-icon-plus" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
	<line x1="12" y1="5" x2="12" y2="19"/>
	<line x1="5" y1="12" x2="19" y2="12"/>
	</svg>
	<svg class="bs-icon-minus" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
	<line x1="5" y1="12" x2="19" y2="12"/>
	</svg>
	</button>
	<div class="bs-faq-a">Yes. Sessions are gentle, temperature-controlled, and designed specifically for infants using widely established hydrotherapy practices.</div>
	</li>

	<li class="bs-faq-item">
	<button class="bs-faq-q" type="button" aria-expanded="false">
	<span>What age is this for?</span>
	<svg class="bs-icon-plus" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
	<line x1="12" y1="5" x2="12" y2="19"/>
	<line x1="5" y1="12" x2="19" y2="12"/>
	</svg>
	<svg class="bs-icon-minus" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
	<line x1="5" y1="12" x2="19" y2="12"/>
	</svg>
	</button>
	<div class="bs-faq-a">Baby Springs sessions are designed for infants approximately 1–12 months old. Massage services are also available for toddlers up to 24 months depending on developmental stage and comfort.</div>
	</li>

	<li class="bs-faq-item">
	<button class="bs-faq-q" type="button" aria-expanded="false">
	<span>When are you opening?</span>
	<svg class="bs-icon-plus" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
	<line x1="12" y1="5" x2="12" y2="19"/>
	<line x1="5" y1="12" x2="19" y2="12"/>
	</svg>
	<svg class="bs-icon-minus" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
	<line x1="5" y1="12" x2="19" y2="12"/>
	</svg>
	</button>
	<div class="bs-faq-a">Baby Springs is planned to open in March 2027. Join our waitlist to receive early access, opening updates, and founding member perks.</div>
	</li>

	<li class="bs-faq-item">
	<button class="bs-faq-q" type="button" aria-expanded="false">
	<span>How long is a session?</span>
	<svg class="bs-icon-plus" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
	<line x1="12" y1="5" x2="12" y2="19"/>
	<line x1="5" y1="12" x2="19" y2="12"/>
	</svg>
	<svg class="bs-icon-minus" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
	<line x1="5" y1="12" x2="19" y2="12"/>
	</svg>
	</button>
	<div class="bs-faq-a"> Most sessions last approximately 30
	minutes. A typical session includes gentle stretching, hydrotherapy, a warm rinse-off, infant massage, and a calming facial — all thoughtfully designed in a peaceful private
	setting.</div>
	</li>

	</ul>
	</div>
</div>
<div id="embed07" class="embed-component instance-7">
	<unloaded-script>
	window.addEventListener('load', function () {
	var faq = document.querySelector('.bs-faq');
	if (!faq) return;

	var items = faq.querySelectorAll('.bs-faq-item');

	items.forEach(function (item) {
	var btn = item.querySelector('.bs-faq-q');
	if (!btn) return;

	btn.addEventListener('click', function () {
	var isOpen = item.classList.contains('bs-open');

	items.forEach(function (i) {
	i.classList.remove('bs-open');
	var b = i.querySelector('.bs-faq-q');
	if (b) b.setAttribute('aria-expanded', 'false');
	});

	if (!isOpen) {
	item.classList.add('bs-open');
	btn.setAttribute('aria-expanded', 'true');
	}
	});
	});
	});
	</unloaded-script>
</div>
<footer class="ty-footer">
	<div class="wrap">
		<div class="ty-footer-meta">
			<p><?php echo esc_html( $babysprings_footer_meta ); ?></p>
			<p><?php echo esc_html( $babysprings_footer_copyright ); ?></p>
		</div>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ty-footer-logo"><img src="<?php echo esc_url( babysprings_asset( 'assets/images/logo-horizontal.png' ) ); ?>" alt="Baby Springs" /></a>
		<div class="ty-socials">
			<?php
			foreach ( $babysprings_socials as $babysprings_social_name => $babysprings_social ) {
				if ( '' === trim( (string) $babysprings_social['url'] ) ) {
					continue;
				}
				?>
			<a href="<?php echo esc_url( $babysprings_social['url'] ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $babysprings_social['label'] ); ?>">
				<svg viewBox="0 0 40 40"><use xlink:href="<?php echo esc_url( babysprings_asset( 'assets/icons.svg' ) ); ?>#<?php echo esc_attr( $babysprings_social_name ); ?>"></use></svg>
			</a>
			<?php
			}
			?>
		</div>
	</div>
</footer>
<?php
get_footer();
