# grad-zagreb-web-2024

WordPress theme for the Grad Zagreb website. Custom theme built on a thin MVC-style
structure: post types, taxonomies and REST routes are declared in PHP classes, page
templates delegate to controllers and repositories, and the front end is built with
Webpack (SCSS + ES modules).

The theme is self-contained. It has no external first-party package dependencies; the
WordPress helper framework it relies on is vendored into `app/lib` (see
[app/lib/README.md](app/lib/README.md)).

## Requirements

- PHP 8.1+
- Node.js 22 (see `.nvmrc`)
- Composer 2
- WordPress with Advanced Custom Fields (ACF) and Contact Form 7

## Install

The theme uses Composer for PHP autoloading (PSR-4, prefix `gradZagrebWeb2024\` -> `app`)
and npm for the front-end build.

```bash
composer install   # generates vendor/autoload.php; run from the theme root
npm install
npm run build
```

`functions.php` boots the theme: it loads `vendor/autoload.php`, includes
`app/global-theme-functions.php`, then instantiates `app/core/Core.php`, which wires up
every feature (post types, taxonomies, REST routes, blocks, admin menus, optimizations).

## Front-end build

Entry points are `static/js/index.js` and `static/scss/style.scss`; output goes to
`static/dist`.

| Command | What it does |
| --- | --- |
| `npm run build` | Formats `static/**` with Prettier, then a production Webpack build |
| `npm run dev` | Webpack watch build for development |
| `npm run format` | Prettier write over `static/**/*.{scss,js}` |
| `npm run lint:scss` | Stylelint over `static/**/*.scss` |

ESLint is configured in `eslint.config.mjs`, Stylelint in `.stylelintrc.json`
(BEM naming via `@namics/stylelint-bem`), Prettier in `.prettierrc.json`, and PHP Mess
Detector rules in `phpmd.xml`.

## Structure

```
app/
  config/        theme configuration (API namespace, image sizes, date format)
  core/          Core bootstrap that initializes all feature classes
  controllers/   hub/listing page controllers (news, services, projects, ...)
  repositories/  data access for each post type
  postTypes/     custom post type and taxonomy registration
  blocks/        Gutenberg block registration
  modules/       reusable ACF-driven content modules
  rest/          custom REST routes and callbacks (namespace: grad-zagreb/v1)
  optimization/  WordPress defaults and plugin tweaks
  adminMenus/    custom admin menus and theme options
  helpers/       breadcrumb, date, image, menu helpers
  acf/           ACF defaults
  addons/        standalone features (e.g. scheduled unpublish)
  adapters/ interfaces/ traits/ exception/
  lib/           vendored WordPress helper framework (base classes used above)
acf-json/        ACF field group definitions (version controlled)
page-templates/  WordPress page templates
partials/        reusable template partials (layout + components)
static/          front-end source (js, scss) and build output (dist)
```

## REST API

Custom endpoints are registered under the `grad-zagreb/v1` namespace
(`app/config/Config.php`, `app/rest`). The front end reads the namespace from localized
script data, so changing it in `Config::get_api_namespace()` is enough.

## License

The theme is released under the GNU General Public License, version 2 or later
(GPL-2.0-or-later). The full text is in [LICENSE](LICENSE).

The bundled fonts in `static/fonts` (Apfel Grotezk, © 2023 Luigi Gorlero & Collletttivo)
are licensed separately under the SIL Open Font License 1.1
(https://openfontlicense.org).
