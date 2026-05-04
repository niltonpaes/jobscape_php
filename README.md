# Jobscape (PHP) — Project documentation

This document is the high-level map of the **custom MVC** codebase: how HTTP requests flow, how folders are organized, which PHP patterns are in play, and how the frontend build works. For step-by-step behavior, read the annotated code (`Framework/`, `App/controllers/`, `routes.php`, and `App/views/`).

Additional notes live under **`_docs/`** (e.g. router/views notes, SQL sample).

---

## Features

-   Job listing **CRUD** (create, read, update, destroy)
-   **Guest** registration and login; **session-based** authentication
-   **Ownership checks** before edit/delete/update (listing `user_id` vs session user)
-   Route **middleware** (`auth`, `guest`) for protected vs public endpoints
-   **Flash messages** (success/error) after redirects
-   **Keyword / location search** (`GET /listings/search`)
-   **PDO** persistence with prepared statements (`listings`, `users` tables)
-   **Tailwind CSS** aligned with Jobscape Laravel tokens (`tailwind.config.cjs`)
-   **Alpine.js** on the CDN for lightweight UI (mobile nav drawer)
-   **Composer PSR-4** autoloading for `Framework\` and `App\`

---

## Tech stack

| Layer | Choice |
| -------- | ----------- |
| Runtime | PHP 8+ recommended (modern syntax; project targets typical shared hosting setups) |
| “Framework” | **Custom**: `Router`, `Database`, `Session`, `Validation`, `Authorization`, `Authorize` middleware |
| HTTP entry | **`public/index.php`** (document root should point here) |
| Routing | Verb + path matching, `{id}` parameters, **`_method`** POST override for PUT/DELETE |
| Views | Plain PHP templates (`.view.php`), partials, `extract()` + `require` via `helpers.php` |
| Persistence | **MySQL** via **PDO** (`Framework/Database.php`, `config/db.php`) |
| Auth | **`password_hash` / `password_verify`**, user array in **`$_SESSION['user']`** |
| Frontend CSS | **Tailwind CSS 3** — `npm run build` emits `public/css/app.css` from `resources/css/app.css` |
| Interactivity | Alpine.js (defer) in layout `head` partial |
| Autoload | **Composer** `psr-4`: `Framework\` → `Framework/`, `App\` → `App/` |

---

## Request lifecycle (mental model)

1. **`public/index.php`** loads Composer autoload, **`Session::start()`**, **`helpers.php`**, instantiates **`Router`**, **`require`**s **`routes.php`** (registers closures on `$router`).
2. **Current URI** is taken from `$_SERVER['REQUEST_URI']` via `parse_url(..., PHP_URL_PATH)`.
3. **`Router::route($uri)`** finds a matching verb + segment pattern (including `{id}`), runs **middleware** hooks (`Authorize` for each role on that route).
4. If matched, **`App\controllers\{Name}Controller`** is instantiated and **`{method}($params)`** is called (route parameters as associative array — e.g. `id`).
5. The **controller** queries **`Database`**, uses **`Validation`**, **`Session`**, **`Authorization`**, then **`loadView()`** / **`redirect()`** (`helpers.php`).

---

## Route map (web)

| Verb(s) | Path | Middleware | Purpose |
| -------- | ----- | ----------- | --------- |
| `GET` | `/` | — | Home — recent listings teaser (`HomeController@index`). |
| `GET` | `/listings` | — | All listings (`ListingController@index`). |
| `GET` | `/listings/search` | — | Keyword/location filter (`ListingController@search`). |
| `GET` | `/listings/{id}` | — | Single listing (`ListingController@show`). |
| `GET` | `/listings/create` | `auth` | Create form (`ListingController@create`). |
| `POST` | `/listings` | `auth` | Store listing (`ListingController@store`). |
| `GET` | `/listings/edit/{id}` | `auth` | Edit form (`ListingController@edit`). |
| `POST` (+ `_method`) | `/listings/{id}` `PUT` | `auth` | Update (`ListingController@update`). |
| `POST` (+ `_method`) | `/listings/{id}` `DELETE` | `auth` | Delete (`ListingController@destroy`). |
| `GET` | `/auth/register` | `guest` | Registration form (`UserController@create`). |
| `POST` | `/auth/register` | `guest` | Register (`UserController@store`). |
| `GET` | `/auth/login` | `guest` | Login form (`UserController@login`). |
| `POST` | `/auth/login` | `guest` | Authenticate (`UserController@authenticate`). |
| `POST` | `/auth/logout` | `auth` | Log out (`UserController@logout`). |

Trailing slash normalization depends on your web server `.htaccess` / nginx rules (`public/.htaccess` fronts pretty URLs).

---

## Folder structure

### `Framework/`

| File / path | Role |
| ----------- | ---- |
| **`Router.php`** | Registers routes, matches URI + HTTP method (with POST `_method` override), dispatches middleware, resolves controller/action. |
| **`Database.php`** | PDO bootstrap (MySQL DSN), `query()` with **named placeholders** (`:param`), default fetch mode **`PDO::FETCH_OBJ`**. |
| **`Session.php`** | Session start wrapper, **get/set/has**, **flash messages** (`getFlashMessage`). |
| **`Validation.php`** | Static helpers: string length bounds, **`filter_var` email**, password match. |
| **`Authorization.php`** | **`isOwner(resourceUserId)`** — compares logged-in **`(int)`** user id to listing **`user_id`** (also cast to `int`; avoids string/int `===` mismatch from PDO). |
| **`Middleware/Authorize.php`** | **`guest`**: redirect authenticated users to **`/`**; **`auth`**: redirect guests to **`/auth/login`**. |

### `App/controllers/`

| Controller | Role |
| ---------- | ---- |
| **`HomeController`** | Home page data (`listings` subset). |
| **`ListingController`** | CRUD, search, sanitization whitelist, **`Authorization::isOwner`** on destructive actions & edit entry. |
| **`UserController`** | Register, login, logout, bcrypt password hashing, session bootstrap. |
| **`ErrorController`** | 404 handling / error views where used. |

> **Note:** Controllers live under `App/controllers/`; class namespace is **`App\Controllers`**. **`Router`** resolves **`App\controllers\{Controller}`** — fine on typical case-insensitive filesystems; on strict case-sensitive deployments, paths and namespaces must match exactly.

### `App/views/`

| Area | Role |
| ---- | ---- |
| **`*.view.php`** | Full pages (home, listings, auth, errors). |
| **`partials/`** | **`head.php`**, **`navbar.php`**, **`footer.php`**, **`main-open.php`**, **`main-close.php`**, flash **`message.php`**, **`errors.php`**, marketing blocks. |

### `public/`

Web root — **`index.php`**, **`css/app.css`** (Tailwind output), **`images/`**, **`/.htaccess`**.

### `config/`

| File | Role |
| ---- | ---- |
| **`db.php`** | Returns PDO connection array (**not** committed — see `.gitignore`); provide `host`, `port`, `dbname`, `username`, `password`. |

### `resources/css/`

| File | Role |
| ---- | ---- |
| **`app.css`** | **`@tailwind` directives** + `[x-cloak]` utility |

### `_docs/`

Project notes, **`jobscape.sql`** sample schema, feature analysis Markdown.

---

## Data model (conceptual)

- **User** — `id`, credentials and profile columns as in your schema; after login, a subset is stored in **`$_SESSION['user']`** (including **`id`** for ownership checks).
- **Listing** — job fields (`title`, `description`, salary, location, tags, requirements, benefits, company, **`user_id`** owner, etc.) as modeled in **`listings`** (see `_docs/jobscape.sql` for reference).

---

## Authorization summary

- **`auth`** middleware — only logged-in users (session carries **`user`**).
- **`guest`** middleware — logged-in users are redirected away (e.g. from login/register routes).
- **Listing mutations** (`edit`, `update`, `destroy`) call **`Authorization::isOwner($listing->user_id)`**; failure sets a flash error and redirects to the listing show page (see inline messages in **`ListingController`**).
- **Show view** — Edit/Delete UI is wrapped in **`Authorization::isOwner($listing->user_id)`** so only the owner sees controls.

---

## Frontend notes

- **Tailwind** theme mirrors Laravel Jobscape **`tailwind.config`** (`jobscape-*` colors, **`max-w-jobscape`**, **`rounded-capsule`**, **`shadow-jobscape-soft`**, etc.). Source: **`tailwind.config.cjs`**; scan paths: **`./App/**/*.php`**.
- Rebuild CSS after markup/class changes: **`npm run build`**. **`npm run dev`** runs Tailwind in watch mode.
- Fonts and Font Awesome URLs are wired in **`App/views/partials/head.php`**.

---

## Common commands

```bash
# From project root
composer dump-autoload     # Refresh PSR-4 map after new classes

npm install               # Frontend dev deps (first time / lockfile refresh)
npm run build             # Compile Tailwind → public/css/app.css
npm run dev               # Tailwind watch while editing views

# PHP built-in server (document root MUST be public/)
php -S localhost:8080 -t public
```

Copy **`config/db.php`** from `.env`/template if your repo omits secrets; never commit production credentials.

---

## Where to edit what

| Task | Likely locations |
| ---- | ---------------- |
| Add a route | `routes.php`, then matching controller method |
| Middleware on a route | Third argument array on **`$router->get/post/…`** (`['auth']` or `['guest']`) |
| Change navbar links | `App/views/partials/navbar.php` |
| Listing form fields / validation | `ListingController@store` / `@update`, `Validation`, views under `App/views/listings/` |
| Search SQL | `ListingController@search` |
| Ownership rule | `Framework/Authorization.php`, `ListingController`, `App/views/listings/show.view.php` |
| Tailwind palette / breakpoints | `tailwind.config.cjs`, rebuild `public/css/app.css` |

---

## PHP features, concepts, and patterns used in this project

Below is how **general PHP mechanics** map onto this repo (study the referenced files for exact usage).

### Language & runtime

| Concept | How it appears here |
| ------- | ------------------- |
| **Namespaces & PSR-4** | `Framework\*`, `App\Controllers\*`; Composer maps prefixes to folders |
| **OOP** | Controllers constructors (DB wiring), **`new Router()`**, **`new Authorize()`** per middleware pass |
| **Static utilities** | **`Session::`**, **`Validation::`**, **`Authorization::`** on framework helpers |
| **Superglobals** | `$_SERVER` (URI, method), `$_POST`, `$_GET`, `$_SESSION` (via **`Session`** wrapper) |
| **Includes** | `require` / **`require`** for bootstrap files, **`loadView`** / **`loadPartial`** with **`extract()`** for view `$data` |
| **Type juggling & casting** | **`(int)`** for ids in ownership checks (**important** vs PDO string columns) |

### Routing & HTTP

| Concept | How it appears here |
| ------- | ------------------- |
| **Custom front controller** | Single **`public/index.php`** entry |
| **Method spoofing** | Forms send **`POST`** + **`_method` = PUT | DELETE`; `Router` promotes to **`PUT`** / **`DELETE`** before matching **`routes.php`** registrations |
| **Path parameters** | `{id}` segments → associative **`$params`** passed to controller methods |
| **Redirects** | **`header('Location: …'); exit`** in **`helpers.php`** **`redirect()`** |
| **Flash messaging** | Write to session before redirect; read/display once in partials (**`Session` flash helpers**) |

### Data & persistence

| Concept | How it appears here |
| ------- | ------------------- |
| **PDO prepared statements** | **`Database::query($sql, $namedParams)`** — binding **`:`** placeholders |
| **`PDO::FETCH_OBJ`** | Rows as **`stdClass`** (**`$listing->user_id`** in views/controllers) |
| **Dynamic INSERT/UPDATE** | Field lists built from **`array_keys`** / whitelisted **`allowedFields`** in **`ListingController`** |
| **`array_intersect_key` / `array_flip`** | Whitelisting **`$_POST`** keys before persist |

### Security-minded patterns

| Concept | How it appears here |
| ------- | ------------------- |
| **Password hashing** | **`password_hash`**, **`password_verify`** in **`UserController`** |
| **XSS mitigation in templates** | **`htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`** on echoed user content |
| **Input sanitization** | **`sanitize()`** (`helpers.php`) wraps **`FILTER_SANITIZE_SPECIAL_CHARS`** |
| **AuthZ not only AuthN** | Session proves *who you are*; **`Authorization::isOwner`** proves *you may mutate this listing* |

### Frontend integration (minimal JS)

| Concept | How it appears here |
| ------- | ------------------- |
| **Alpine.js** (`x-data`, `x-show`, `@click.outside`) | Mobile nav drawer in **`navbar`** partial |
| **Build-time Tailwind** | No runtime Tailwind CDN in production bundle — **`npm run build`** |

### Architectural pattern

**MVC (pragmatic):** **Controllers** orchestrate HTTP; **“models”** are not separate classes — persistence is PDO in controllers; **views** are PHP templates plus partials. **`Framework`** provides cross-cutting/router/DB/session/validation/authorization plumbing.

---

This README is the **map**; **inline comments** in **`Framework/`** and controllers are the **field guide** while you navigate the codebase. For deeper Laravel parity notes, compare with the **`jobscape_laravel`** repository’s **`README.md`**.
