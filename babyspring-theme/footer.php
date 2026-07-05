<?php
/**
 * Closes the wrapper/section opened in header.php, then prints the
 * enqueued main.js (via wp_footer) followed by the Klaviyo waitlist
 * subscribe script — credentials and the thank-you redirect come from the
 * Customizer (see inc/customizer.php) so nothing here needs code edits.
 *
 * @package BabySprings
 */
?>
			</section>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
<script>
(function () {
'use strict';

var KLAVIYO_LIST_ID = '<?php echo esc_js( babysprings_get_option( 'babysprings_klaviyo_list_id', 'Um8kBy' ) ); ?>';
var KLAVIYO_PUBLIC_API_KEY = '<?php echo esc_js( babysprings_get_option( 'babysprings_klaviyo_public_key', 'Sqxup7' ) ); ?>';
var KLAVIYO_API_REVISION = '<?php echo esc_js( babysprings_get_option( 'babysprings_klaviyo_revision', '2026-04-15' ) ); ?>';
var THANK_YOU_URL = '<?php echo esc_js( babysprings_thank_you_url() ); ?>';
var KLAVIYO_SUBSCRIBE_URL = 'https://a.klaviyo.com/client/subscriptions/?company_id=' + encodeURIComponent(KLAVIYO_PUBLIC_API_KEY);
var EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
var MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

// Native <input type="date"> values are always ISO (YYYY-MM-DD) regardless
// of locale, so this parses that directly rather than via `new Date(value)`
// (which reads it as UTC midnight and can display a day off in the browser's
// local timezone).
function formatDisplayDate(isoValue) {
if (!isoValue) return '';
var parts = isoValue.split('-');
if (parts.length !== 3) return isoValue;
var year = parseInt(parts[0], 10);
var month = MONTH_NAMES[parseInt(parts[1], 10) - 1];
var day = parseInt(parts[2], 10);
if (!month || isNaN(year) || isNaN(day)) return isoValue;
return day + ' ' + month + ', ' + year;
}

// Pairs a hidden native date input with a formatted "7 July, 2026" display
// span (see .bs-wl-date-shell in front-page.php) so the field still opens
// the browser's real calendar picker but shows a friendlier date format.
function setupDateDisplay(form) {
if (!form) return;

var dateInput = form.querySelector('.bs-wl-date-input');
var display = form.querySelector('.bs-wl-date-display');
if (!dateInput || !display) return;

var placeholderText = display.textContent;

function sync() {
var formatted = formatDisplayDate(dateInput.value);
if (formatted) {
display.textContent = formatted;
display.classList.remove('bs-wl-placeholder');
} else {
display.textContent = placeholderText;
display.classList.add('bs-wl-placeholder');
}
}

dateInput.addEventListener('change', sync);
dateInput.addEventListener('input', sync);
sync();
}

function setupWaitlistForm(form) {
if (!form) return;

var errorEl = form.querySelector('.bs-wl-error');
var submitBtn = form.querySelector('.bs-wl-btn');
var btnLabel = submitBtn.querySelector('.bs-wl-btn-label');
var defaultLabel = btnLabel.textContent;
var isSubmitting = false;

// Looks up a field by trying several likely name/id variants, so this
// script keeps working even if the HTML field names change later.
function findField(candidates) {
for (var i = 0; i < candidates.length; i++) {
var el = form.querySelector('[name="' + candidates[i] + '"]') || form.querySelector('#' + candidates[i]);
if (el) return el;
}
return null;
}

function setLabel(text) {
btnLabel.textContent = text;
}
function showError(message) {
errorEl.textContent = message;
errorEl.classList.add('show');
}
function clearError() {
errorEl.textContent = '';
errorEl.classList.remove('show');
}

form.addEventListener('submit', function (e) {
e.preventDefault();
if (isSubmitting) return;
clearError();

var nameField = findField(['name', 'full_name', 'fullname', 'customer_name']);
var emailField = findField(['email', 'email_address']);
var babyField = findField(['baby_age_or_due_date', 'baby', 'baby_age', 'due_date', 'dob']);

var name = nameField ? nameField.value.trim() : '';
var email = emailField ? emailField.value.trim() : '';
var babyAge = babyField ? babyField.value.trim() : '';

if (!name) {
showError('Please enter your name.');
if (nameField) nameField.focus();
return;
}
if (!email) {
showError('Please enter your email address.');
if (emailField) emailField.focus();
return;
}
if (!EMAIL_RE.test(email)) {
showError('Please enter a valid email address.');
if (emailField) emailField.focus();
return;
}

isSubmitting = true;
submitBtn.disabled = true;
setLabel('Submitting...');

var payload = {
data: {
type: 'subscription',
attributes: {
profile: {
data: {
type: 'profile',
attributes: {
email: email,
properties: {
full_name: name,
baby_age: babyAge
}
},
subscriptions: {
email: { marketing: { consent: 'SUBSCRIBED' } }
}
}
}
},
relationships: {
list: { data: { type: 'list', id: KLAVIYO_LIST_ID } }
}
}
};

fetch(KLAVIYO_SUBSCRIBE_URL, {
method: 'POST',
headers: {
'Content-Type': 'application/json',
Accept: 'application/json',
revision: KLAVIYO_API_REVISION
},
body: JSON.stringify(payload)
})
.then(function (response) {
if (!response.ok) {
return response.json().catch(function () { return null; }).then(function (errJson) {
var detail = 'Klaviyo responded with status ' + response.status;
if (errJson && errJson.errors && errJson.errors[0] && errJson.errors[0].detail) {
detail = errJson.errors[0].detail;
}
throw new Error(detail);
});
}

form.reset();
var resetDateInput = form.querySelector('.bs-wl-date-input');
if (resetDateInput) resetDateInput.dispatchEvent(new Event('change'));
window.location.href = THANK_YOU_URL;
})
.catch(function (err) {
console.error('Klaviyo subscribe failed:', err);
setLabel('Please try again.');
showError('Something went wrong — please try again in a moment.');
})
.finally(function () {
isSubmitting = false;
submitBtn.disabled = false;
setTimeout(function () {
setLabel(defaultLabel);
}, 2500);
});
});
}

// Reveals the .bs-benefit hover styling (see babysprings_benefits_css() in
// functions.php) as each benefit card scrolls into view, since touch devices
// have no hover state. Deliberately not a click/tap listener: the card's
// icon frame already carries its own onclick="_scrollToTop()", and adding a
// second listener on the same element would fire both on every tap.
function setupBenefitReveal() {
var cards = document.querySelectorAll('.bs-benefit');
if (!cards.length || !('IntersectionObserver' in window)) return;

var observer = new IntersectionObserver(function (entries) {
entries.forEach(function (entry) {
if (entry.isIntersecting) {
entry.target.classList.add('is-active');
}
});
}, { threshold: 0.5 });

cards.forEach(function (card) { observer.observe(card); });
}

document.addEventListener('DOMContentLoaded', function () {
setupWaitlistForm(document.getElementById('form02'));
setupWaitlistForm(document.getElementById('form03'));
setupDateDisplay(document.getElementById('form02'));
setupDateDisplay(document.getElementById('form03'));
setupBenefitReveal();
});
})();
</script>
</body>
</html>
