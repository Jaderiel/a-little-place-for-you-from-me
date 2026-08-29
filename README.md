# A Little Place for You, from Me

A small, private website built for one person: a friendship archive with a timeline, memories,
photos, inside jokes, a soundtrack, a yearly "Wrapped", and a hidden page that only opens with a
password.

Everything on the site comes from the database, so new memories, photos, songs, trivia questions
and Wrapped years can be added from `/admin` without touching a single Blade file.

## Requirements

- PHP 8.2+ (with the `gd` extension if you want to run the test suite)
- Composer
- MySQL 8
- Node.js 20.19+ / 22.12+

## Setup

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate

# create the database first, e.g.
#   mysql -u root -e "CREATE DATABASE little_place; \
#     CREATE USER 'little'@'localhost' IDENTIFIED BY 'little'; \
#     GRANT ALL ON little_place.* TO 'little'@'localhost';"
php artisan migrate --seed

php artisan storage:link   # required so uploaded photos are served
npm run build              # or: npm run dev
php artisan serve
```

Then open http://localhost:8000.

### Environment settings worth knowing

| Variable | What it does |
| --- | --- |
| `FRIENDSHIP_NAME` | Name shown throughout the site |
| `FRIENDSHIP_START_DATE` | The day the counter counts from (`2024-04-06`) |
| `FRIENDSHIP_TIMEZONE` | Timezone used by the counter (`Asia/Manila`) |
| `SECRET_PAGE_PASSWORD` | Password for the hidden `/secret` page |
| `ADMIN_NAME` / `ADMIN_EMAIL` / `ADMIN_PASSWORD` | The admin account the seeder creates |

**Change `SECRET_PAGE_PASSWORD` and `ADMIN_PASSWORD` before deploying.** The password is only ever
compared on the server, never sent to the browser.

## Pages

| Route | What's there |
| --- | --- |
| `/` | Landing page, live friendship counter, highlights, achievements |
| `/story` | The timeline, from the first time we saw each other to IVN training |
| `/memories` | Photo gallery with categories + lightbox, and the memory that stayed |
| `/lore` | Justine Lore™, things I like about you, trivia, the soundtrack, bad-day messages |
| `/wrapped/{year?}` | Our Friendship Wrapped, one tab per year |
| `/about` | Why this exists, if you ever need me, the closing note |
| `/secret` | Hidden. Not linked anywhere. Password-protected. |
| `/admin` | Content manager (login at `/admin/login`) |

## Adding photos

There are two ways, and neither one requires editing templates.

**1. Through the admin (recommended)**

1. Log in at `/admin/login`.
2. Go to **Photos → New photo**.
3. Upload the image, pick a category, and optionally attach it to a timeline event or memory.
4. Leave "Placeholder" unchecked so it renders as a real photo instead of a marked placeholder.

Uploads land in `storage/app/public/friendship/gallery` and are served through the
`public/storage` symlink.

**2. By hand**

Drop files into `storage/app/public/friendship/…` and add a row to the `photos` table with
`image_path` set to the path relative to the public disk (e.g. `friendship/gallery/sm-day.jpg`).

**Recommended formats**

- JPEG or WebP for photos, PNG for graphics — max 8 MB per file (enforced on upload)
- Roughly 1600px on the long edge is plenty; the layout never needs more
- Portrait shots look best in the timeline, landscape in the gallery grid
- Always fill in a title or caption: it is used as the image's alt text

**Categories** drive the gallery filters: `Timeline`, `Random`, `Hangouts`, `Funny`, `Favorite`,
`Special Days`, `Graduation`, `IVN Training`. Edit the list in `config/friendship.php`.

Every seeded photo is a **placeholder** — a marked, empty frame. Replace each one by editing it in
the admin and uploading the real picture; nothing else needs to change.

## The admin area

`/admin` manages timeline events, memories, photos, things I like about you, songs, achievements,
bad-day messages, trivia questions, lore facts, Wrapped years and the secret notes.

Every screen is generated from `config/admin.php`. To make a new field editable: add the column in
a migration, then add it to that resource's `fields` array. Field types available are `text`,
`textarea`, `date`, `number`, `boolean`, `select`, `image`, `lines` (one item per line, stored as
JSON) and `relation`.

## The secret page

`/secret` is not linked from any navigation, sitemap or footer. It asks for a password, compares it
server-side against `SECRET_PAGE_PASSWORD`, and keeps the unlock in the session only. Its content
is never rendered — not even hidden in the HTML — until the password is correct, it is excluded
from the service worker cache, and there is a "lock it again" button at the bottom of the page.

## PWA

`public/manifest.webmanifest` and `public/sw.js` make the site installable on a phone. The service
worker pre-caches the shell and the offline page, and deliberately skips `/secret` and `/admin`.
Icons live in `public/icons/`.

## Tests, formatting, build

```bash
php artisan test          # feature tests for the public pages, secret page and admin
./vendor/bin/pint         # code style
npm run build             # production assets
```

## Project layout

```
app/Http/Controllers/     public pages, JSON interactions, secret page, admin
app/Models/               one model per content type
app/Support/              the friendship counter and stats
config/friendship.php     name, dates, password, photo categories and folders
config/admin.php          every admin screen, described as data
database/seeders/         the real content this site started with
resources/views/pages/    one Blade file per page
resources/views/components/ small reusable pieces (cards, nav, photo frames)
resources/js/components/  Alpine components (counter, gallery, quiz, easter eggs)
```

## A note on the content

Nothing here is invented. The dates, memories and jokes in the seeder are the real ones; anything
that was missing is left as a clearly marked placeholder instead of being filled in with something
made up. There are no fabricated statistics — the numbers on the site are counted from the
database or from the calendar.
