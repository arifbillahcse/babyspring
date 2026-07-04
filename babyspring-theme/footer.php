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

document.addEventListener('DOMContentLoaded', function () {
setupWaitlistForm(document.getElementById('form02'));
setupWaitlistForm(document.getElementById('form03'));
});
})();
</script>
</body>
</html>
