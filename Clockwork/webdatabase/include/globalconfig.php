<?php
//////////////
// SECURITY //
//////////////
if(!defined('CHANGEME')){die('Direct Access not premitted');}
///////////////////
//    Global     //
// Configuration //
///////////////////
//    Database   //
// Configuration //
///////////////////

define('adress', 'localhost');
define('user', 'aname');
define('pass', 'password');
define('database', 'adatabase');

$con = mysqli_connect(adress, user, pass, database); // DO NOT EDIT!

///////////////////
//     Other     //
// Configuration //
///////////////////

$website = "http://www.mygamingcommunity.com"; // A URL

$site = "My Gaming Community"; // This is a friendly version of your community name, no URL jargon, If logo is disabled this is shown instead

$logoenabled = 0; // enable Logo?

$logo = "http://cdn01.androidauthority.com/wp-content/uploads/2011/03/Google-Logo.jpg"; // Full image path for a logo to display on the dashboard | 

$GMT = "Europe/London"; // time Zone?

$manyperpage = 10; // How many results per page( Part of Characters,Search,My Characters) // Something around 10-20, else you get a fuck load of pagination

// ▼▼▼▼▼▼▼▼▼▼▼ MUST BE SET!
$apikey ="A6EBFABC7281CDB8F79245EDA0B5FAA8";  // Visit http://steamcommunity.com/dev !!!! THIS IS A MUST TO CONFIGURE !!!!
// ▲▲▲▲▲▲▲▲▲▲▲ MUST BE SET!

$enablecustomfeaturebox = 0;
$customfeatureboxcontent = "

";

///////////////////
//     Game      //
// Configuration //
///////////////////
$game = "Half life 2 Roleplay"; // gamemode
$gamemodecode = "cwhl2rp"; // gamemode code

///////////////////////
// END GLOBAL CONFIG //
///////////////////////



$released = "3/5/13";
// Created 18/01/13 at 5:10PM


?>
