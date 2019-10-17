Installation
============

`git clone https://github.com/zaxxx/pp.git`

`composer install`

`cp src/config/config.local.example.neon src/config/config.local.neon`

Modify config.local.neon as needed.

`php www/index.php orm:schema-tool:create --force`

Running tests
=============

`./vendor/bin/phpunit`
