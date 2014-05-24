<?php 

$communityurl = "http://mygamingcommunity.com"; // the url of ur community
$communityname = "My Gaming Community"; // The name of the community

// People who can access the admin part.
// 64bit steamid
// see http://steamid.co/
$admins = array("76561198031633135","76561197977040839");

$config_sender_email = "robot@mygamingcommunity.com"; // Sender of the automated emails
$config_sender_name = "My Gaming Community Robot";
$dbhost = "localhost";	// The host which hosts your database
$dbuser = "user";	// The user for the host/database
$dbpass = "pass";	// The users password
$dbname = "clockwork";	// The name of the database which holds the activationkeys and notifications table

$config_merchant_domain	= 	"merchant@domain.com";					//	The email you want to appear on the email
$config_merchant_name	=	"merchant name";					//	The name you want to appaer on the email

$config_merchant_email 	= 	"merchant@domain.com";				//	IMPORTANT! The email you use with paypal to receive payment

$config_USD 			=	true;							//	Currency, set this to false if using £'s i.e. GBP

// IPN Config
$payPalURL = "https://www.paypal.com/cgi-bin/webscr";
//$payPalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr"; //For Paypal sandbox
$payments = array( '10', '22', '36', "49" ); // enter prices of stuff here to eliminate bad notifications
//

$config_options = array(

	"Admin"=>array(
		"title" 		=> "Admin",
		"color"			=> "danger",
		"price" 		=> 20.00,
		"description"	=> "This will provide you with a code that grants you admin on the server.",
		"number"		=> 1
	),
	"VIP"=>array(
		"title" 		=> "Metropolice Force Whitelist",
		"color"			=> "warning",
		"price" 		=> 15.00,
		"description"	=> "This will provide you with a code that grants you the MPF whitelist.",
		"number"		=>	2
	),
	"Donator"=>array(
		"title" 		=> "Civil Workers Union Whitelist",
		"color"			=> "info",
		"price" 		=> 10.00,
		"description"	=> "You get the CWU whitelist.",
		"number"		=> 3
	),
	"Cash"=>array(
		"title" 		=> "500 Tokens",
		"color" 		=> "success",
		"price" 		=> 5.00,
		"description"	=> "You will recieve a code for 500 in-game tokenshttp://puu.sh/7z0o5.png.",
		"number"		=> 4
	)
);

?>