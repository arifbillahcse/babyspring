# Baby Springs — WordPress Theme

A classic (PHP) WordPress theme port of the current Baby Springs landing page.
It reproduces the live design **1:1** — the same markup, `assets/main.css`, and
`assets/main.js` from the static site — while making the Klaviyo waitlist,
footer text, and social links manageable from **wp-admin** with no code edits.
It also ships a matching **Thank You** page template that the waitlist form
redirects to after a successful signup.

Standard WordPress hooks (`wp_head`, `wp_body_open`, `wp_footer`) are wired up,
so tag-manager and analytics plugins — **Google Tag Manager**, Site Kit,
WPCode, etc. — inject their snippets correctly without editing theme files.

## Requirements
- WordPress 6.0+
- PHP 7.4+

## Installation
1. Zip the **`babyspring-theme`** folder so the archive contains
   `babyspring-theme/style.css` at its top level:
   ```
   cd babyspring-theme && zip -r ../babyspring-theme.zip .
   ```
   (or zip the folder itself from your file manager).
2. In wp-admin go to **Appearance → Themes → Add New → Upload Theme**, choose
   the zip, install, and **Activate**.

## First-time setup (5 minutes)

### 1. Make the landing page the homepage
The design lives in `front-page.php`, which WordPress shows automatically when a
static front page is set:
- Create a Page (e.g. "Home") — it can be empty.
- **Settings → Reading → Your homepage displays → A static page → Homepage: Home.**

### 2. Create the Thank You page
- **Pages → Add New**, title it "Thank You" (an empty body is fine).
- In **Page Attributes → Template**, choose **Thank You**, then Publish.

The waitlist form finds this page automatically and redirects to it after a
successful signup. (If no such page exists it falls back to `/thank-you/`. You
can also force a specific URL under **Customize → Klaviyo Waitlist → Thank You
page URL**.)

### 3. Klaviyo waitlist integration
**Appearance → Customize → Klaviyo Waitlist.** Pre-filled with working values;
change them to your own if needed:
- **Klaviyo List ID** — the list new signups join (this is what triggers your
  welcome flow). Audience → Lists & Segments → your list.
- **Klaviyo Public API Key** — Settings → API Keys → *Public* key (Site ID).
  Safe to expose publicly. **Not** the private key.
- **Klaviyo API Revision** — leave as-is unless Klaviyo retires the version.

Both the desktop and mobile forms post to Klaviyo's modern
`client/subscriptions` API (CORS-enabled), map `Name → full_name` and
`Baby's Age or Due Date → baby_age`, add the profile to your list, then redirect
to the Thank You page.

### 4. Set up Google Tag Manager / analytics
Install any GTM/analytics plugin (e.g. **GTM4WP**, **Site Kit**, or **WPCode**)
and paste your container ID. The theme fires `wp_head`, `wp_body_open`, and
`wp_footer` in the right places, so the plugin's head script and `<body>`
noscript snippet land correctly — nothing to edit in the theme.

### 5. Footer & social links
**Appearance → Customize → Footer & Social** — edit the location/opening line,
the copyright line, and the Instagram / Facebook / TikTok / Pinterest URLs.
Clear a social field to hide that icon. These feed both the homepage footer and
the Thank You page footer.

## File overview
| File | Purpose |
|------|---------|
| `style.css` | Theme header (styling lives in `assets/main.css`) |
| `functions.php` | Setup, asset enqueue, Customizer helpers, thank-you URL resolver |
| `inc/customizer.php` | Customizer panels (Klaviyo Waitlist, Footer & Social) |
| `header.php` / `footer.php` | Opens/closes the page wrapper; footer prints the Klaviyo subscribe script |
| `front-page.php` | The landing page — nav, hero, benefits, waitlist forms, FAQ, footer |
| `page-thank-you.php` | "Thank You" page template (post-signup confirmation) |
| `page.php` / `index.php` | Generic page + fallback templates |
| `assets/main.css` / `assets/main.js` | The design's compiled CSS + JS (unchanged from the static site) |
| `assets/icons.svg` | Sprite of UI + social icons |
| `assets/images/` | Hero, nursery, and logo images |

## Editing section copy
Headlines, body copy, and the FAQ questions/answers live in `front-page.php`.
Edit the text (keep the surrounding markup) to change wording. Nav labels and
on-page anchors (`#about`, `#benefit`, `#faq`, `#spot`) are in the `sn-nav`
block near the top of that file.
