<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Sign-in</title>

    <!-- Bootstrap core CSS -->
    <link href="bs/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bs/css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
    <?php
    require('include/functions.php');
    require('include/config.php');

    ?>
  </head>

  <body>

    <div class="container">
<br>
      <div class="form-signin well">
        <h2 class="form-signin-heading">Login Portal</h2>
        <?php
        if ($debug == "1") {
           error_reporting(E_ALL);
        }
// Quick login
if (!empty($_POST['steamid'])) {
  $_SESSION['steamlogin'] = $_POST['steamid'];
}


if (isset($_SESSION['steamlogin'])) {
  $steam_login_verify = $_SESSION['steamlogin'] ;
}
else {$steam_login_verify = SteamSignIn::validate();}

if(!empty($steam_login_verify))
{
//echo "success + $steam_login_verify <br>";
$_SESSION['steamlogin'] = $steam_login_verify;
$_SESSION['steamname'] = steamid64convert($steam_login_verify);

// Get Players Characters

$con = mysql_connect($address,$user,$pass);
if (!$con)
  {
  echo('<div class="alert alert-error">' . mysql_error() . '. Please tell the owner.</div>');
  }


mysql_select_db($database, $con);
$query = ("SELECT DISTINCT _Name FROM characters WHERE _SteamID =  '".$_SESSION["steamname"]."' AND (_Faction = 'Metropolice Force' OR _Faction = 'Overwatch Transhuman Arm')");
$rows = mysql_query($query);
print "

<form action='dash.php' method='post'>
<div class='row'>
  <div class='col-lg-3'>
       <big>Login as:</big>
       </div>
       <div class='col-lg-8'>

"; 

//Get a row 
while($row = MySQL_Fetch_array($rows)){ 

//get a feild 
for($i=0;$i<count($row);$i++){ 

//Grab an element in the array 
$array = next($row); //A function I just learned :) 

//make sure there is something in it 
if($array != ""){ 

//echo it For some reason gmod html doesnt like dropdowns.
echo "<div class='radio'>
  <label>
    <input type='radio' name='unit' id='unitidlist' value=".$array.">
$array
  </label>
</div>"; 

} 
// For some reason this doesnt work o.o maybe i do is empty idk
// else {echo "Looks like you don't have any characters that can use this!";}

if ($debug == 1) {
echo "Mysql QUery:".$query;
}

} 

} 


print "</div></div><br>";
print '        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>';
print '        <a href="logoutsteam.php" class="btn btn-sm btn-warning btn-block">Logout of steam</a></form>';
}
else
{
$steam_sign_in_url = SteamSignIn::genUrl();
echo "<a href=\"$steam_sign_in_url\"><img style=\"margin-top: 8px\" src='http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_small.png' /></a>";
echo "</p>Quick Login:<br>";
echo "<form action='index.php' method='post' >
<div class='form-group'>
    <input type='text' class='form-control input-sm' readonly id='steamid' name='steamid' value=''>
  </div>

 <button class='btn btn-xs btn-success btn-block' type='submit'>Quick login</button>
</form>

";
}
        ?>
      
    </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
