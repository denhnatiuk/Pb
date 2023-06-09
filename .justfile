# -- OPTIONS:
set allow-duplicate-recipes
set positional-arguments
set dotenv-load
set export


# -- VARIABLES:
home_dir := env_var('HOME')

# -- RECEIPES:
@_default:
    just --list --unsorted


# install
install:
  composer install
  pnpm install

# install composer
install-composer-globally:
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
  php composer-setup.php
  php -r "unlink('composer-setup.php');"
  sudo mv composer.phar /usr/local/bin/composer

# install php tools
install-php-tools:
  composer require --dev "composer/installers"
  composer require --dev "wpreadme2markdown/wpreadme2markdown"
# composer global require "phpunit/phpunit"
# composer global require "phpunit/dbunit"
# composer global require "phing/phing"
# composer global require "phpdocumentor/phpdocumentor"
# composer global require "phploc/phploc"
# composer global require "phpmd/phpmd"

# php static analysis tool with rules set
  composer require --dev "phpstan/phpstan"
  composer require --dev "phpstan/phpstan-strict-rules"
  composer require --dev "php-stubs/wp-cli-stubs"
  composer require --dev "szepeviktor/phpstan-wordpress"
  composer require --dev "phpstan/extension-installer"

# php code sniffer tool with rules set
  composer require --dev "squizlabs/php_codesniffer"
  composer require --dev "phpcompatibility/php-compatibility"
  composer require --dev "wp-coding-standards/wpcs"
  composer require --dev "dealerdirect/phpcodesniffer-composer-installer"

  composer update

  echo 'export PATH=$PATH:~/.composer/vendor/bin' >> ~/.path_extendings

# phpcs --config-set installed_paths %APPDATA%\Composer\vendor\wp-coding-standards\wpcs
  phpcs -i

