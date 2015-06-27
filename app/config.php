<?php

/*
|--------------------------------------------------------------------------
| Error reporting
|--------------------------------------------------------------------------
*/

error_reporting(E_ALL);
ini_set("display_errors", 1);

/*
|--------------------------------------------------------------------------
| Database config
|--------------------------------------------------------------------------
|
| For DB_TYPE you can choose 'mysql', 'xml', 'json'
|
*/

define('DB_TYPE', 'json');
define('DB_HOST', 'localhost');
define('DB_NAME', 'laravelrssapp');
define('DB_USER', 'root');
define('DB_PASS', 'root1234');

/*
|--------------------------------------------------------------------------
| Catalogs config
|--------------------------------------------------------------------------
*/

define('VIEWS_DIR', 'app/Views/');
define('CSS_DIR', '/app/Views/layouts/css/');
