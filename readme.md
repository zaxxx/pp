Installation
============

Clone the repo:
---------------
`git clone https://github.com/zaxxx/pp.git`

Install dependencies:
---------------------

`composer install`

Create config.local.neon:
-------------------------

`cp src/config/config.local.example.neon src/config/config.local.neon`

Modify config.local.neon as needed:
-----------------------------------
If the app is running at `http://localhost/pp/www`, then the basePath parameter should
be `/pp/www`. If it's running at `http://localhost`, then it should be empty string.

Create database schema from entities:
-------------------------------------
`php www/index.php orm:schema-tool:create`

Enable debug mode:
------------------
`touch src/config/dev.neon`

Run the tests:
--------------

`./vendor/bin/phpunit`

Download shops from API:
------------------------

`php www/index.php pp:api:sync-shops`
