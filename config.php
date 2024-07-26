<?php

define('HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', '');
define('DB_NAME', 'coffee_latera');
define('DIR_PATH', __DIR__);
define('FILE_PATH', __FILE__);
define('TITLE', 'Coffee Latera');
define('FOLDER', 'Hujuzati');
define('CURRENCY', 'SAR ');

date_default_timezone_set('Asia/Karachi');

$host = $_SERVER['HTTP_HOST'];
define('SITE_URL', ($host == 'localhost') ? 'http://' . $host . '/' . FOLDER : 'https://' . $host . '/' . FOLDER);
