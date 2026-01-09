<?php

// The main config file
// $env comes from the command line option (see the readme)
if ($env === 'dev') {
    define('BASE_URL', 'http://localhost/php-md-blog/public/');
} else {
    define('BASE_URL', 'https://phpmd.webandras.hu/');
}

define('DEFAULT_DATE_FORMAT', 'Y-m-d H:i');
define('DEFAULT_TIMEZONE', 'Europe/London');
define('DEFAULT_LANGUAGE', 'en-gb');
define('LANGUAGES', array(
    'en-gb' => 'English',
    'hu-hu' => 'Magyar',
));

define('POST_LIMIT', 10);
