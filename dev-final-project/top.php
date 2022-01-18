<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Lukas Kopacki Oscar Lonaeus Lucía Carrera">
        <meta name="For our CS 148 Class" 
            content="Ski Area Finder">

        <title>Find a Mountain</title>


        <link rel="icon" href="images/logo.png" type="image/png" sizes="40x40">

        <link rel="stylesheet" 
            href="css/custom.css?version=<?php print time(); ?>" 
            type="text/css">
        <link rel="stylesheet" media="(max-width:800px)" 
            href="css/tablet.css?version=<?php print time(); ?>" 
            type="text/css">
        <link rel="stylesheet" media="(max-width: 600px)"
            href="css/phone.css?version=<?php print time(); ?>" 
             type="text/css">

    <!-- *** Include Libraries **** -->
    <?php
    include 'lib/constants.php';
    print '<!-- make Database connections -->';
    require_once(LIB_PATH . '/database.php');

    $thisDatabaseReader = new Database('lkopacki_reader', 'r', DATABASE_NAME);
    // writer- adds password from pass.php
    include 'lib/pass.php';
    $thisDatabaseWriter = new Database('lkopacki_writer', 'w', DATABASE_NAME);
    print '</head>';

    print '<body id="' . PATH_PARTS['filename'] . '">';
    print '<!-- ***** START OF BODY **** -->';

    print PHP_EOL;

    include 'header.php';
    print PHP_EOL;

    include 'nav.php';
    print PHP_EOL;

    ?>