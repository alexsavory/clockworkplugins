<?php
/**
 * Project: combinedatapad
 * File: configuration.php
 * Created by PhpStorm.
 * User: Alex
 * Created: 06/08/2015 05:58 PM
 */


///////////////////
//    Global     //
// Configuration //
///////////////////
//    Database   //
// Configuration //
///////////////////


$DB_HOST = "127.0.0.1";
$DB_USER = "username";
$DB_PASS = "password";
$DB_NAME = "database_name";


///////////////////
//      UI       //
// Configuration //
///////////////////
$app_title = "Combine Data Systems";
$app_slogan = "It's great to be part of the greater good.";
$city = "City 17";
///////////////////
//     Other     //
// Configuration //
///////////////////
// Timezone For OOC Time View allowed timezone's here http://php.net/manual/en/timezones.php
$zone = "Europe/London";
// Enable Debug Messages
$debug = 0;
// This is Case Sensitive! These are people who can review the reports.
$adminranks = array('sec', 'dvl', 'cmd', 'epu', "DvL");
// This allows us to use the STEAM API to fetch data (And use Steam Login)
// ??????????? MUST BE SET!
$apikey ="";  // Visit http://steamcommunity.com/dev !!!! THIS IS A MUST TO CONFIGURE !!!!
// ??????????? MUST BE SET!

// View Character Data in the Resident List True / False
$enablecombinedata = true;

// Edit Character Data in Resident List True/ Flase
$enableedit = true;

// Enable for support of Better View Data Plugin
$enablebetterviewdata = true;

// People who can access the admin part.
// 64bit steamid
// see http://steamid.co/
// last entry should not have a , 
$admins = array("76561198031633135","76561198031633135");


?>