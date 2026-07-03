/**
 * Baby Springs — front-end behaviour.
 *
 * Sticky nav, scroll-reveal animations, hero parallax, FAQ accordion,
 * mobile menu, and the Klaviyo waitlist form submission.
 *
 * Klaviyo settings are injected by WordPress via wp_localize_script as
 * window.BabySpringsKlaviyo (see functions.php → babysprings_assets).
 */
(function () {
  'use strict';

  // ---- Klaviyo config (from the WordPress Customizer, with fallbacks) ----
  var KLAVIYO = window.BabySpringsKlaviyo || {};
  var KLAVIYO_LIST_ID = KLAVIYO.listId || 'Um8kBy';
  var KLAVIYO_PUBLIC_API_KEY = KLAVIYO.publicKey || 'Sqxup7';
  var KLAVIYO_API_REVISION = KLAVIYO.revision || '2026-04-15';
  var KLAVIYO_SUBSCRIBE_URL =
    'https://a.klaviyo.com/client/subscriptions/?company_id=' + encodeURIComponent(KLAVIYO_PUBLIC_API_KEY);

  // ---- Sticky header ----
  var header = document.getElementById('header');
  if (header) {
    var onScroll = function () {
      header.classList.toggle('scrolled', window.scrollY > 30);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // ---- Scroll reveal ----
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (e) {
          if (e.isIntersecting) {
            e.target.classList.add('in');
            io.unobserve(e.target);
          }
        });
      },
      { threshold: 0.14 }
    );
    document.querySelectorAll('.reveal').forEach(function (el) {
      io.observe(el);
    });
  } else {
    document.querySelectorAll('.reveal').forEach(function (el) {
      el.classList.add('in');
    });
  }

  // ---- Hero parallax ----
  var heroImg = document.querySelector('.hero-media img');
  if (heroImg) {
    window.addEventListener(
      'scroll',
      function () {
        var y = window.scrollY;
        if (y < 700) {
          heroImg.style.transform = 'scale(1.02) translateY(' + y * 0.05 + 'px)';
        }
      },
      { passive: true }
    );
  }

  // ---- FAQ accordion ----
  document.querySelectorAll('.faq-q').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var faq = btn.parentElement;
      var ans = btn.nextElementSibling;
      var isOpen = faq.classList.contains('open');
      document.querySelectorAll('.faq').forEach(function (f) {
        f.classList.remove('open');
        f.querySelector('.faq-a').style.maxHeight = null;
      });
      if (!isOpen) {
        faq.classList.add('open');
        ans.style.maxHeight = ans.scrollHeight + 'px';
      }
    });
  });

  // ---- Mobile menu ----
  var mm = document.getElementById('mobileMenu');
  var menuBtn = document.getElementById('menuBtn');
  var closeMenu = document.getElementById('closeMenu');
  if (mm && menuBtn && closeMenu) {
    menuBtn.addEventListener('click', function () {
      mm.classList.add('open');
    });
    closeMenu.addEventListener('click', function () {
      mm.classList.remove('open');
    });
    mm.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () {
        mm.classList.remove('open');
      });
    });
  }

  // ============================================================
  // KLAVIYO WAITLIST FORM
  // ============================================================
  var form = document.getElementById('waitForm');
  if (!form) {
    return;
  }

  var formInner = document.getElementById('formInner');
  var successEl = document.getElementById('success');
  var submitBtn = document.getElementById('submitBtn');
  var btnLabel = submitBtn.querySelector('.btn-label');
  var errorEl = document.getElementById('formError');

  var DEFAULT_LABEL = btnLabel.textContent;
  var EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  var isSubmitting = false;

  // Map form fields by trying several likely name/id variants, so the
  // integration keeps working even if the field names change.
  function findField(candidates) {
    for (var i = 0; i < candidates.length; i++) {
      var el =
        form.querySelector('[name="' + candidates[i] + '"]') ||
        form.querySelector('#' + candidates[i]);
      if (el) {
        return el;
      }
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

  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    if (isSubmitting) {
      return; // guard against duplicate submissions
    }
    clearError();

    var nameField = findField(['name', 'full_name', 'fullname', 'customer_name']);
    var emailField = findField(['email', 'email_address']);
    var babyField = findField(['baby', 'baby_age', 'due_date', 'dob']);

    var name = nameField ? nameField.value.trim() : '';
    var email = emailField ? emailField.value.trim() : '';
    var babyAge = babyField ? babyField.value.trim() : '';

    // ---- Validation ----
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

    // JSON:API payload for Klaviyo's Client Subscribe Profiles endpoint.
    // Adding the profile to this list triggers the Klaviyo welcome flow.
    var payload = {
      data: {
        type: 'subscription',
        attributes: {
          profile: {
            data: {
              type: 'profile',
              attributes: {
                email: email,
                // Custom profile properties. Add more keys here (and read
                // them from extra form fields) to capture more data.
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
          list: {
            data: { type: 'list', id: KLAVIYO_LIST_ID }
          }
        }
      }
    };

    try {
      var response = await fetch(KLAVIYO_SUBSCRIBE_URL, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          revision: KLAVIYO_API_REVISION
        },
        body: JSON.stringify(payload)
      });

      if (!response.ok) {
        var detail = 'Klaviyo responded with status ' + response.status;
        try {
          var errJson = await response.json();
          if (errJson && errJson.errors && errJson.errors[0] && errJson.errors[0].detail) {
            detail = errJson.errors[0].detail;
          }
        } catch (parseErr) {
          /* success responses (202) have no body to parse */
        }
        throw new Error(detail);
      }

      setLabel("You're on the waitlist!");
      form.reset();
      formInner.style.display = 'none';
      successEl.classList.add('show');
    } catch (err) {
      console.error('Klaviyo subscribe failed:', err);
      setLabel('Please try again.');
      showError('Something went wrong — please try again in a moment.');
    } finally {
      isSubmitting = false;
      submitBtn.disabled = false;
      setTimeout(function () {
        if (formInner.style.display !== 'none') {
          setLabel(DEFAULT_LABEL);
        }
      }, 2500);
    }
  });
})();
