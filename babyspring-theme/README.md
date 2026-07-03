# Baby Springs — WordPress Theme

A classic (PHP) WordPress theme port of the Baby Springs infant-hydrotherapy
landing page. It keeps the exact design and animations of the static site while
making the menu, logo, footer, and Klaviyo waitlist integration manageable from
**wp-admin** — no code edits required.

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

### 2. Klaviyo waitlist integration
**Appearance → Customize → Klaviyo Waitlist.** Pre-filled with working values;
change them to your own if needed:
- **Klaviyo List ID** — the list new signups join (this is what triggers your
  welcome flow). Audience → Lists & Segments → your list.
- **Klaviyo Public API Key** — Settings → API Keys → *Public* key (Site ID).
  Safe to expose publicly. **Not** the private key.
- **Klaviyo API Revision** — leave as-is unless Klaviyo retires the version.

The form posts to Klaviyo's modern `client/subscriptions` API (CORS-enabled),
maps `Name → full_name`, `Baby's Age or Due Date → baby_age`, and adds the
profile to your list, which fires the **Baby Springs Waitlist Welcome** flow.
If the list uses double opt-in, Klaviyo sends a confirmation email first and the
flow fires after the visitor confirms.

### 3. Navigation menu
**Appearance → Menus** → create a menu → assign it to the **Primary Menu**
location. Use **Custom Links** for the on-page anchors:
`#about`, `#benefits`, `#faq` (and `#waitlist` if you want it in the menu).
If you skip this, a default About / Benefits / FAQ menu is shown automatically.
The "Secure Your Spot" button is always present and links to the form.

### 4. Logo
**Appearance → Customize → Site Identity → Logo.** If none is set, the bundled
Baby Springs logo (`assets/images/image03.png`) is used in the header and footer.

### 5. Footer & social links
**Appearance → Customize → Footer & Social** — edit the location/opening line,
the copyright line, and the Instagram / Facebook / TikTok / Pinterest URLs.
Clear a social field to hide that icon.

## File overview
| File | Purpose |
|------|---------|
| `style.css` | Theme header + all styles |
| `functions.php` | Setup, asset enqueue, menus, logo helper, Klaviyo settings → JS |
| `inc/customizer.php` | Customizer panels (Klaviyo, Footer & Social) |
| `header.php` / `footer.php` | Site chrome, dynamic menus & footer |
| `front-page.php` | The landing page sections |
| `page.php` / `index.php` | Generic page + fallback templates |
| `assets/js/main.js` | Nav, FAQ, reveal animations, Klaviyo form |
| `assets/images/` | Hero, nursery, and logo images |

## Editing section copy
Headlines and body copy live in `front-page.php`, wrapped in translation
functions. Edit the text between the quotes (keep the surrounding markup) to
change wording. The FAQ questions/answers are near the bottom of that file.
