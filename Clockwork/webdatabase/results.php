<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content=", clockworkwebviewer, clockwork, web viewer, trurascalz, webviewer,">
    <meta name="author" content="Alex Savory">
<meta name="description" content="A web viewer  which is free and provided by Alex Savory">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 60px;
      }

      /* Custom container */
      .container {
        margin: 0 auto;
        max-width: 1000px;
      }
      .container > hr {
        margin: 60px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 80px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 100px;
        line-height: 1;
      }
      .jumbotron .lead {
        font-size: 24px;
        line-height: 1.25;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }


      /* Customize the navbar links to be fill the entire space of the .navbar */
      .navbar .navbar-inner {
        padding: 0;
      }
      .navbar .nav {
        margin: 0;
        display: table;
        width: 100%;
      }
      .navbar .nav li {
        display: table-cell;
        width: 1%;
        float: none;
      }
      .navbar .nav li a {
        font-weight: bold;
        text-align: center;
        border-left: 1px solid rgba(255,255,255,.75);
        border-right: 1px solid rgba(0,0,0,.1);
      }
      .navbar .nav li:first-child a {
        border-left: 0;
        border-radius: 3px 0 0 3px;
      }
      .navbar .nav li:last-child a {
        border-right: 0;
        border-radius: 0 3px 3px 0;
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="assets/ico/favicon.png">
  </head>

  <body>

    <div class="container">

      <?php include('header.php');?>

      <!-- Jumbotron -->
       <?php 
$con = mysql_connect($address,$user,$pass);
if (!$con)
  {
  echo('<div class="alert alert-error">' . mysql_error() . '</div>');
  }
else echo('<div class="alert alert-success">Successfully Connected</div>');

mysql_select_db($database, $con);


if(empty($_POST['name']) && empty($_POST['faction']) && empty($_POST['steamid'])) {
die('<div class="alert alert-info">You need to search something</div>');
}

if(!empty($_POST['name']) && !empty($_POST['faction']) && !empty($_POST['steamid'])) {
die('<div class="alert alert-info">You Cannot search all three fields</div>');
}

if(!empty($_POST['name']) && !empty($_POST['steamid'])) {
die('<div class="alert alert-info">You cannot search Steam Name and ID</div>');
}

$name = mysql_real_escape_string($_POST['name']);
$faction = mysql_real_escape_string($_POST['faction']);
$steamid = mysql_real_escape_string($_POST['steamid']);

if(empty($_POST['name'])) {
$result = mysql_query("SELECT * FROM  `characters` WHERE `_Schema` = '".$gamemodecode."' AND `_Faction` LIKE  '%".$faction."%'");
}
if(empty($_POST['faction'])) {
$result = mysql_query("SELECT * FROM  `characters` WHERE `_Schema` = '".$gamemodecode."' AND `_SteamName` LIKE  '%".$name."%'");
}
if(empty($_POST['faction']) && empty($_POST['name'])) {
$result = mysql_query("SELECT * FROM  `characters` WHERE `_Schema` = '".$gamemodecode."' AND `_SteamID` LIKE  '".$steamid."'");
}
if(!empty($_POST['faction']) && !empty($_POST['name']) && empty($_POST['steamid']) ) {
$result = mysql_query("SELECT * FROM  `characters` WHERE `_Schema` = '".$gamemodecode."' AND `_SteamName` LIKE  '%".$name."%' AND `_Faction` LIKE  '%".$faction."%'");
}

if (mysql_error()==""){ 
echo '<div class="alert alert-success">Successfully Queried</div>'; 
}
else

echo '<div class="alert alert-success"> ERROR'.mysql_error().'</div>';
echo "
<center>
<table class='table table-striped'>
<h1>All Characters</h1>
<tr>
<th>Name</th>
<th>Faction</th>
<th>Owner</th>
<th>Last Played</th>";

if(!empty($steam_login_verify)){
  $usersteamid = $steam_login_verify;
  $convertedsteamid = steamid64convert($usersteamid);
  if (issuperadmin($convertedsteamid) == "1") {
  echo '<th>Actions</th>';
  }
  
}
echo '
</tr>
</center>';



while($row = @mysql_fetch_array($result))
  {
$lastplayed = $row['_LastPlayed'];
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);
  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
    echo "<td>" . $row['_Faction'] . "</td>";
 echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>". $row['_SteamName'] ."</a></td>";
  echo "<td>" . date('r', $lastplayed) . "</td>";
    if (issuperadmin($convertedsteamid) == "1") {
  echo '<td>
  <form action="edit.php" method="post" style="display: inline;">
  <input type="hidden" name="admin" value="yes" />
  <input type="hidden" name="key" value="'.$row['_Key'].'" />
  <button type="submit" class="btn btn-success" onclick="return confirm(\'Are you sure you want to edit \n'.$row['_Name'].' owned by '.$row['_SteamName'].' ?\')" >Edit</button>
    </form>
    </td>';
  }
  echo "</tr>";
  }
echo "</table>";




?>

      <hr>

   <?php include('footer.php')?>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
