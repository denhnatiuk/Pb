<h1>Pb WordPress Theme</h1>
Disclaimer: this is early dev stage of project. Don`t use it on production.

### Reqirements

WordPress: 4.7
Tested up to: 4.7
Requires PHP: 8.1

Dev requires the following dependencies:

- [Node.js](https://nodejs.org/)
- [Composer](https://getcomposer.org/) 

### Installation

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload Theme and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

### Frequently Asked Questions

= Does this theme support any plugins? =

geliostrans includes support for WooCommerce and for Infinite Scroll in Jetpack.

### Changelog
* Initial release

### Credits
* normalize.css https://necolas.github.io/normalize.css/, (C) 2012-2018 Nicolas Gallagher and Jonathan Neal, [MIT](https://opensource.org/licenses/MIT)

Inspired by:
* Underscores https://underscores.me/, (C) 2012-2020 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* Sage https://roots.io/sage/, (C) 2012-2020 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)


### File structure
themes/pb/                # → Root of theme  
├── index.php             # → Theme template wrapper  
├── style.css             # → Theme meta information  
├── functions.php         # → Theme bootloader  
├── screenshot.png        # → Theme screenshot for WP admin  
├── package.json          # → Node.js dependencies and scripts  
├── composer.json         # → Autoloading for `src/` files  
├── assets/               # → Theme assets and templates  
│   ├── fonts/            # → Theme fonts  
│   ├── images/           # → Theme images  
│   ├── scripts/          # → Theme javascript  
│   ├── scss/             # → Theme stylesheets  
│   │   ├── components/   # → Component templates  
│   │   ├── form/         # → Form templates  
│   │   ├── layouts/      # → Base templates  
│   │   └── partials/     # → Partial templates  
│   └── views/            # → Theme templates  
│       ├── components/   # → Component templates  
│       ├── form/         # → Form templates  
│       ├── layouts/      # → Base templates  
│       └── partials/     # → Partial templates  
├── src/                  # → Theme PHP  
│   ├── Classes/          # → Theme PHP Classes  
│   ├── View/             # → View models  
│   ├── Providers/        # → Service providers  
│   ├── admin.php         # → Theme customizer setup  
│   ├── filters.php       # → Theme filters  
│   ├── helpers.php       # → Helper functions  
│   └── setup.php         # → Theme setup  
├── docs/                 # → Theme docs  
│   ├── issues/           # → Theme issues  
│   ├── wiki/             # → Theme wiki  
│   ├── forum/            # → Theme forum  
│   └── LICENSE.TXT       # → Theme license  
├── node_modules/         # → Node packages (never edit)  
├── vendor/               # → Composer packages (never edit)  
├── composer.lock         # → Composer lock file (never edit)  
├── package-lock.json     # → NPM lock file (never edit)  
├── yarn-lock.json        # → Yarn lock file (never edit)  
└── public/               # → Built theme assets (never edit)  
  

