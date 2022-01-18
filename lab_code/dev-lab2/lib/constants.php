<?php 

// define constant flag debug
define('DEBUG', false);

// sanitizing tge server
$_SERVER = filter_input_array
(INPUT_SERVER, FILTER_SANITIZE_STRING);

// DEFINING CONSTANTS
// server with sanitized $server...
define('SERVER', $_SERVER['SERVER_NAME']);

// domain that adds 2 slashes + server constant
define('DOMAIN', '//' . SERVER);

// sanitized server var php_self
define('PHP_SELF', $_SERVER['PHP_SELF']);

// will pull up filenames top.php and nav.php
define('PATH_PARTS', pathinfo(PHP_SELF));

// domain + slash (identifies absolute path structure)
define('BASE_PATH', DOMAIN . PATH_PARTS['dirname'] . '/');

// has relative path to lib folder
define('LIB_PATH', 'lib/');

// Debug statement to print out values of domain, php_self, php_parts, base_path and lib_path
if (DEBUG) {
    print '<p>Domain: ' .  DOMAIN;
    print '<p>PHP SELF: ' .  PHP_SELF;

    // !!! Ask Bob why he put <pre> at the end
    print '<p>PATH_PARTS<pre>';
    print_r(PATH_PARTS);
    print '</pre></p>';
    print '<p>BASE_PATH: ' .  BASE_PATH;
    print '<p>LIB_PATH: ' .  LIB_PATH;
}
?>