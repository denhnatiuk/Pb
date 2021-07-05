<h1>Pb WordPress Theme</h1>
Disclaimer: this is early dev stage of project. Don`t use it on production.

### File structure
themes/pb/                # → Root of theme
├── index.php             # → Theme template wrapper
├── style.css             # → Theme meta information
├── functions.php         # → Theme bootloader
├── screenshot.png        # → Theme screenshot for WP admin
├── package.json          # → Node.js dependencies and scripts
├── composer.json         # → Autoloading for `app/` files
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







├── bootstrap/            # → Acorn bootstrap
│   ├── cache/            # → Acorn cache location (never edit)
│   └── app.php           # → Acorn application bootloader
├── config/               # → Config files
│   ├── app.php           # → Application configuration
│   ├── assets.php        # → Asset configuration
│   ├── filesystems.php   # → Filesystems configuration
│   ├── logging.php       # → Logging configuration
│   └── view.php          # → View configuration
├── storage/              # → Storage location for cache (never edit)
└── webpack.mix.js        # → Laravel Mix configuration
