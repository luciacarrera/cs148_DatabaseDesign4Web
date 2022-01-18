<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Lucía Carrera">
        <meta name="description" 
            content="see: https://moz.com/learn/seo/meta-description">
        
        <title>A good title tag</title>
        
        <link rel = "stylesheet" 
            href = "css/custom.css?version=<?php print time(); ?>" 
            type = "text/css">
        <link rel = "stylesheet" media="(max-width:800px)" 
            href = "css/tablet.css?version=<?php print time(); ?>" 
            type = "text/css">
        <link rel = "stylesheet" media="(max-width: 600px)" 
            href = "css/phone.css?version=<?php print time(); ?>" 
            type = "text/css">

<!-- **** include libraries **** -->
<?php
include 'lib/constants.php';

print '<!-- make Database connections -->';
require_once(LIB_PATH . '/Database.php');

$thisDatabaseReader = new DataBase('lcarrera_reader', 'r', 'LCARRERA_cs148_lab2');
print '</head>';
print '<body id="' . PATH_PARTS
['filename'] . '">';

print '<!-- ***** START OF BODY ***** -->';

print PHP_EOL;

include 'header.php';
print PHP_EOL;

include 'nav.php';
print PHP_EOL;
?>

