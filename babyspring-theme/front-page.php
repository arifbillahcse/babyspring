<?php
/**
 * Front page — the Baby Springs landing page.
 *
 * @package BabySprings
 */

get_header();
?>

<!-- ===== HERO ===== -->
<section class="hero" id="top">
	<span class="blob b1"></span>
	<div class="wrap hero-grid">
		<div class="hero-copy">
			<span class="eyebrow reveal"><?php esc_html_e( 'Gentle Care. Stronger Foundations.', 'babyspring' ); ?></span>
			<h1 class="reveal d1"><?php esc_html_e( "DMV's First", 'babyspring' ); ?><br /><?php esc_html_e( 'Infant Hydrotherapy Wellness Studio', 'babyspring' ); ?></h1>
			<p class="lede-italic reveal d2"><?php esc_html_e( "Designed to support your baby's development from the very beginning.", 'babyspring' ); ?></p>
			<div class="rule reveal d2"></div>
			<p class="body reveal d2"><?php esc_html_e( 'Gentle, development-focused care for your baby — in a calm, private setting, inspired by established wellness practices across Asia and Europe.', 'babyspring' ); ?></p>
			<div class="reveal d3">
				<a class="btn" href="#waitlist"><?php esc_html_e( 'Secure Your Spot', 'babyspring' ); ?>
					<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
			</div>
			<div class="badges reveal d3">
				<span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg><?php esc_html_e( 'Limited to first 100 families', 'babyspring' ); ?></span>
				<span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 21s-7-6-7-11a7 7 0 0 1 14 0c0 5-7 11-7 11z"/><circle cx="12" cy="10" r="2.4"/></svg><?php esc_html_e( 'Bethesda, Maryland', 'babyspring' ); ?></span>
				<span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="4" y="5" width="16" height="16" rx="2"/><path d="M4 9h16M8 3v4M16 3v4"/></svg><?php esc_html_e( 'Opening March 2027', 'babyspring' ); ?></span>
			</div>
		</div>

		<div class="hero-media reveal d2">
			<div class="frame">
				<img src="<?php echo esc_url( babysprings_img( 'image02.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Baby Springs infant hydrotherapy tub in a calm, spa-like studio', 'babyspring' ); ?>" />
			</div>
			<div class="float-card fc-1">
				<span class="dot"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 15c3 2 5 2 9 0s6-2 9 0M3 10c3 2 5 2 9 0s6-2 9 0"/></svg></span>
				<span><b><?php esc_html_e( 'Warm-water therapy', 'babyspring' ); ?></b><small><?php esc_html_e( 'Soothing & developmental', 'babyspring' ); ?></small></span>
			</div>
			<div class="float-card fc-2">
				<span class="dot"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 3a6 6 0 0 0 0 12 6 6 0 0 1 0 6 9 9 0 0 0 0-18z"/></svg></span>
				<span><b><?php esc_html_e( 'Restful sleep', 'babyspring' ); ?></b><small><?php esc_html_e( 'Calmer nights', 'babyspring' ); ?></small></span>
			</div>
		</div>
	</div>
</section>

<!-- ===== BENEFITS ===== -->
<section class="band sec-pad" id="benefits">
	<span class="blob b2"></span>
	<div class="wrap center">
		<h2 class="sec-title reveal"><?php esc_html_e( 'Where early development meets intentional care.', 'babyspring' ); ?></h2>
		<p class="sec-sub reveal d1"><?php esc_html_e( 'Across Asia and Europe, infant hydrotherapy and massage are valued for their role in early development and wellbeing.', 'babyspring' ); ?></p>

		<div class="cards" id="about">
			<div class="card reveal">
				<span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="9"/><path d="M9 15c1 1 5 1 6 0M9 10h.01M15 10h.01"/></svg></span>
				<h3><?php esc_html_e( 'Supports development & movement', 'babyspring' ); ?></h3>
				<p><?php esc_html_e( 'Encourages healthy physical growth and body awareness.', 'babyspring' ); ?></p>
			</div>
			<div class="card reveal d1">
				<span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 12.8A8 8 0 1 1 11 3a6 6 0 0 0 10 9.8z"/></svg></span>
				<h3><?php esc_html_e( 'Promotes better sleep', 'babyspring' ); ?></h3>
				<p><?php esc_html_e( 'Helps regulate and calm the nervous system.', 'babyspring' ); ?></p>
			</div>
			<div class="card reveal d2">
				<span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.4"/><path d="M3 20c0-3 3-5 6-5s6 2 6 5M15 20c0-2 1.5-3.5 3.5-3.5"/></svg></span>
				<h3><?php esc_html_e( 'Enhances bonding & connection', 'babyspring' ); ?></h3>
				<p><?php esc_html_e( 'Creates meaningful, uninterrupted time together.', 'babyspring' ); ?></p>
			</div>
			<div class="card reveal d3">
				<span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="4"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M5 5l2 2M17 17l2 2M19 5l-2 2M7 17l-2 2"/></svg></span>
				<h3><?php esc_html_e( 'Stimulates the senses', 'babyspring' ); ?></h3>
				<p><?php esc_html_e( 'Supports early sensory and cognitive development.', 'babyspring' ); ?></p>
			</div>
		</div>

		<div class="cta-inline reveal">
			<a class="btn" href="#waitlist"><?php esc_html_e( 'Secure Your Spot', 'babyspring' ); ?></a>
			<small><?php esc_html_e( 'Limited access available.', 'babyspring' ); ?></small>
		</div>
	</div>
</section>

<!-- ===== HOW IT WORKS ===== -->
<section class="sec-pad" id="how-it-works">
	<div class="wrap center">
		<span class="eyebrow reveal"><?php esc_html_e( 'The Baby Springs Experience', 'babyspring' ); ?></span>
		<h2 class="sec-title reveal d1" style="margin-top:1.2rem;"><?php esc_html_e( 'How your first session works', 'babyspring' ); ?></h2>
		<p class="sec-sub reveal d2"><?php esc_html_e( 'A calm, guided process from booking to bath time — designed so both of you feel at ease.', 'babyspring' ); ?></p>

		<div class="steps">
			<div class="step reveal">
				<span class="num">1</span>
				<h3><?php esc_html_e( 'Reserve your spot', 'babyspring' ); ?></h3>
				<p><?php esc_html_e( "Join the founding waitlist in under a minute and secure your family's place before spots fill.", 'babyspring' ); ?></p>
			</div>
			<div class="step reveal d1">
				<span class="num">2</span>
				<h3><?php esc_html_e( 'Share a few details', 'babyspring' ); ?></h3>
				<p><?php esc_html_e( "Tell us about your baby's age and comfort level so we can tailor every session to them.", 'babyspring' ); ?></p>
			</div>
			<div class="step reveal d2">
				<span class="num">3</span>
				<h3><?php esc_html_e( 'Warm-water hydrotherapy', 'babyspring' ); ?></h3>
				<p><?php esc_html_e( 'A private, one-on-one session paced entirely around your baby, with gentle massage included.', 'babyspring' ); ?></p>
			</div>
			<div class="step reveal d3">
				<span class="num">4</span>
				<h3><?php esc_html_e( 'Take-home guidance', 'babyspring' ); ?></h3>
				<p><?php esc_html_e( 'Leave with simple techniques to continue the benefits at home, before your next visit.', 'babyspring' ); ?></p>
			</div>
		</div>

		<div class="cta-inline reveal">
			<a class="btn" href="#waitlist"><?php esc_html_e( 'Secure Your Spot', 'babyspring' ); ?></a>
			<small><?php esc_html_e( 'Only 100 founding spots available.', 'babyspring' ); ?></small>
		</div>
	</div>
</section>

<!-- ===== FOUNDING FAMILIES ===== -->
<section class="band sec-pad" id="founding-families">
	<div class="wrap wl-grid">
		<div class="wl-media reveal">
			<img src="<?php echo esc_url( babysprings_img( 'image01.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Serene infant wellness nursery setting', 'babyspring' ); ?>" />
		</div>

		<div class="wl-copy reveal d1">
			<h2><?php esc_html_e( 'For a limited number of founding families', 'babyspring' ); ?></h2>
			<p><?php esc_html_e( 'Be among the first to experience a new standard in infant wellness.', 'babyspring' ); ?></p>
			<p><?php esc_html_e( 'Early access to bookings will be offered in limited phases, starting with waitlist members.', 'babyspring' ); ?></p>
			<ul class="facts">
				<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 21s-7-6-7-11a7 7 0 0 1 14 0c0 5-7 11-7 11z"/><circle cx="12" cy="10" r="2.4"/></svg><?php esc_html_e( 'Bethesda, Maryland', 'babyspring' ); ?></li>
				<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="4" y="5" width="16" height="16" rx="2"/><path d="M4 9h16M8 3v4M16 3v4"/></svg><?php esc_html_e( 'Opening March 2027', 'babyspring' ); ?></li>
				<li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg><?php esc_html_e( 'Limited to first 100 families.', 'babyspring' ); ?></li>
			</ul>
		</div>
	</div>
</section>

<!-- ===== FOUNDING MEMBER PERKS ===== -->
<section class="sec-pad" id="perks">
	<div class="wrap center">
		<span class="eyebrow reveal"><?php esc_html_e( 'Founding Member Perks', 'babyspring' ); ?></span>
		<h2 class="sec-title reveal d1" style="margin-top:1.2rem;"><?php esc_html_e( 'Join now, and it pays you back', 'babyspring' ); ?></h2>
		<p class="sec-sub reveal d2"><?php esc_html_e( "The first 100 families to join receive benefits that won't be offered again.", 'babyspring' ); ?></p>

		<div class="cards">
			<div class="card reveal">
				<span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg></span>
				<h3><?php esc_html_e( 'Locked founding rate', 'babyspring' ); ?></h3>
				<p><?php esc_html_e( 'Your rate is locked in for life as a founding member — even as regular pricing increases.', 'babyspring' ); ?></p>
			</div>
			<div class="card reveal d1">
				<span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="4" y="5" width="16" height="16" rx="2"/><path d="M4 9h16M8 3v4M16 3v4M9 16l2 2 4-4"/></svg></span>
				<h3><?php esc_html_e( 'First choice of appointments', 'babyspring' ); ?></h3>
				<p><?php esc_html_e( 'Founding families get first access to the schedule, weeks before public booking opens.', 'babyspring' ); ?></p>
			</div>
			<div class="card reveal d2">
				<span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5C10 3 12 8 12 8M16.5 8a2.5 2.5 0 0 0 0-5C14 3 12 8 12 8"/></svg></span>
				<h3><?php esc_html_e( 'A welcome gift, on us', 'babyspring' ); ?></h3>
				<p><?php esc_html_e( 'Enjoy a complimentary add-on during your very first visit to Baby Springs.', 'babyspring' ); ?></p>
			</div>
			<div class="card reveal d3">
				<span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="6" cy="12" r="2.4"/><circle cx="18" cy="6" r="2.4"/><circle cx="18" cy="18" r="2.4"/><path d="M8.2 10.7l7.5-4.3M8.2 13.3l7.5 4.3"/></svg></span>
				<h3><?php esc_html_e( 'Refer & earn', 'babyspring' ); ?></h3>
				<p><?php esc_html_e( 'Invite friends and family and receive rewards toward your future sessions.', 'babyspring' ); ?></p>
			</div>
		</div>

		<div class="cta-inline reveal">
			<a class="btn" href="#waitlist"><?php esc_html_e( 'Secure Your Spot', 'babyspring' ); ?></a>
			<span class="perk-note"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14M13 6l6 6-6 6"/></svg><?php esc_html_e( 'Perks disappear once the first 100 spots are claimed.', 'babyspring' ); ?></span>
		</div>
	</div>
</section>

<!-- ===== WAITLIST FORM ===== -->
<section class="band sec-pad" id="waitlist">
	<div class="wrap center">
		<h2 class="sec-title reveal"><?php esc_html_e( 'Secure your spot', 'babyspring' ); ?></h2>
		<p class="sec-sub reveal d1"><?php esc_html_e( 'Join the founding waitlist and be first in line when booking opens.', 'babyspring' ); ?></p>

		<div class="wl-form-wrap">
			<form class="wl-form reveal d2" id="waitForm" novalidate>
				<div id="formInner">
					<div class="field"><input type="text" name="name" placeholder="<?php esc_attr_e( 'Name', 'babyspring' ); ?>" required /></div>
					<div class="field"><input type="email" name="email" placeholder="<?php esc_attr_e( 'Email Address', 'babyspring' ); ?>" required /></div>
					<div class="field"><input type="text" name="baby" placeholder="<?php esc_attr_e( "Baby's Age or Due Date", 'babyspring' ); ?>" /></div>
					<button class="btn" type="submit" id="submitBtn">
						<span class="btn-label"><?php esc_html_e( 'Secure Your Spot', 'babyspring' ); ?></span>
						<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
					</button>
					<p class="form-error" id="formError" role="alert"></p>
					<p class="form-note"><?php esc_html_e( "You'll receive early booking access, founding member benefits, and priority scheduling.", 'babyspring' ); ?></p>
				</div>
				<div class="success" id="success">
					<div class="check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M5 13l4 4L19 7"/></svg></div>
					<h3><?php esc_html_e( "You're on the list.", 'babyspring' ); ?></h3>
					<p class="form-note"><?php esc_html_e( "Welcome, founding family. We'll be in touch with your early access details soon.", 'babyspring' ); ?></p>
				</div>
			</form>
		</div>
	</div>
</section>

<!-- ===== FAQ ===== -->
<section class="sec-pad" id="faq">
	<div class="wrap center">
		<h2 class="sec-title reveal"><?php esc_html_e( 'Frequently asked questions', 'babyspring' ); ?></h2>
		<p class="sec-sub reveal d1"><?php esc_html_e( 'Have another question?', 'babyspring' ); ?> <a href="#waitlist" style="color:var(--sage-dark);text-decoration:underline;"><?php esc_html_e( "We'd love to hear from you.", 'babyspring' ); ?></a></p>

		<div class="faq-list">
			<div class="faq reveal">
				<button class="faq-q"><?php esc_html_e( 'Is this safe for babies?', 'babyspring' ); ?> <span class="plus"></span></button>
				<div class="faq-a"><p><?php esc_html_e( 'Yes. Sessions are gentle, temperature-controlled, and designed specifically for infants using widely established hydrotherapy practices.', 'babyspring' ); ?></p></div>
			</div>
			<div class="faq reveal d1">
				<button class="faq-q"><?php esc_html_e( 'What age is this for?', 'babyspring' ); ?> <span class="plus"></span></button>
				<div class="faq-a"><p><?php esc_html_e( 'Baby Springs sessions are designed for infants approximately 1–12 months old. Massage services are also available for toddlers up to 24 months depending on developmental stage and comfort.', 'babyspring' ); ?></p></div>
			</div>
			<div class="faq reveal d2">
				<button class="faq-q"><?php esc_html_e( 'When are you opening?', 'babyspring' ); ?> <span class="plus"></span></button>
				<div class="faq-a"><p><?php esc_html_e( 'Baby Springs is planned to open in March 2027. Join our waitlist to receive early access, opening updates, and founding member perks.', 'babyspring' ); ?></p></div>
			</div>
			<div class="faq reveal d3">
				<button class="faq-q"><?php esc_html_e( 'How long is a session?', 'babyspring' ); ?> <span class="plus"></span></button>
				<div class="faq-a"><p><?php esc_html_e( 'Most sessions last approximately 30 minutes. A typical session includes gentle stretching, hydrotherapy, a warm rinse-off, infant massage, and a calming facial — all thoughtfully designed in a peaceful private setting.', 'babyspring' ); ?></p></div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
