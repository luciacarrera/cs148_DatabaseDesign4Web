<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Lukas Kopacki">
        <meta name="For my CS 148 Class" 
            content="Find a Mountain">

        <title>Find a Mountain</title>

        <link rel="icon" href="../images/logo.png" type="image/png" sizes="40x40">

        <link rel="stylesheet" 
            href="../css/custom.css?version=<?php print time(); ?>" 
            type="text/css">
        <link rel="stylesheet" media="(max-width:800px)" 
            href="../css/tablet.css?version=<?php print time(); ?>" 
            type="text/css">
        <link rel="stylesheet" media="(max-width: 600px)"
            href="../css/phone.css?version=<?php print time(); ?>" 
             type="text/css">
    <!-- *** Include Libraries **** -->
    <?php
    include '../lib/constants.php';
    print '<!-- make Database connections -->';
    require_once('../' . LIB_PATH . '/database.php');

    $thisDatabaseReader = new Database('lkopacki_reader', 'r', DATABASE_NAME);
    // writer- adds password from pass.php
    //include '../lib/pass.php';
    $thisDatabaseWriter = new Database('lkopacki_writer', 'w', DATABASE_NAME);
    print '</head>';

    print '<body id="' . PATH_PARTS['filename'] . '">';

    //require passcode
    $netId = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");
    $sql = 'SELECT netId FROM tblAdmin ';
    $sql .= 'WHERE netId =  ?;';

    $data = array($netId);
    $names = $thisDatabaseReader->select($sql, $data);
    $message = 'Sorry, you are not authorized';
    if(is_array($names)){
        foreach($names as $name){
            if($name['netId'] != $netId){
                die($message);
            }
        }
    }
    print '<!-- ***** START OF BODY **** -->';

    print PHP_EOL;

    include 'header.php';
    print PHP_EOL;

    include 'nav.php';
    print PHP_EOL;
// sanitizing data with getData function
    function getData($field){
        if(!isset($_POST[$field])){
        $data ="";
        }else{
            $data = trim($_POST[$field]);
            $data = htmlspecialchars($data, ENT_QUOTES);
        }
        return $data;
    }
    ?>