<?php session_start();
// You shouldnt be here if your not logged in
// Get Unit and set session
require('include/config.php');




if (!isset($_SESSION['unitid'])) {
$con = mysql_connect($address,$user,$pass);
if (!$con)
  {
  echo('<div class="alert alert-error">' . mysql_error() . '. Please tell the owner.</div>');
  }


mysql_select_db($database, $con);
$result = mysql_query("SELECT * FROM characters WHERE (_Faction = 'Metropolice Force' OR _Faction = 'Overwatch Transhuman Arm') AND _Name =  '".mysql_real_escape_string($_POST['unit'])."' ");

while($row = @mysql_fetch_array($result))
  {
    $_SESSION['unitid'] = $row['_Key'];
    $_SESSION['unitname'] = $row['_Name'];
  }
}

       if (!isset($_SESSION['unitid'])) {
header("Location:index.php");
       }
       if (!isset($_SESSION['steamlogin'])) {
header("Location:index.php");
       }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="bs/ico/favicon.png">

    <title>Results</title>

    <!-- Bootstrap core CSS -->
    <link href="bs/css/bootstrap.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="bs/js/html5shiv.js"></script>
      <script src="bs/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
<br>
      <?php include('header.php');?>

<?php 
$con = mysql_connect($address,$user,$pass);
if (!$con)
  {
  echo('<div class="alert alert-error">' . mysql_error() . '</div>');
  }
else echo('<div class="alert alert-success">Successfully Connected</div>');

mysql_select_db($database, $con);


if(empty($_POST['name']) && empty($_POST['citizenid'])) {
die('<div class="alert alert-info">You need to search something</div>');
}


$name = mysql_real_escape_string($_POST['name']);
$citizenid = mysql_real_escape_string($_POST['citizenid']);


if(empty($_POST['name'])) {
$result = mysql_query("SELECT * FROM  `characters` WHERE `_Data` LIKE  '%".$citizenid."%' AND  `_Faction` !=  'Metropolice Force'");
}
if(empty($_POST['citizenid'])) {
$result = mysql_query("SELECT * FROM  `characters` WHERE `_Name` LIKE  '%".$name."%' AND  `_Faction` !=  'Metropolice Force' ");
}

echo "
<center>
<table class='table table-striped'>
<h1>Results</h1>
<tr>
<th>Name</th>
<th>Gender</th>
<th>Owner(<b>OOC</b>)</th>
</tr>
</center>";



while($row = @mysql_fetch_array($result))
  {

$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);
  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
    echo "<td>" . $row['_Gender'] . "</td>";
 echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>". $row['_SteamName'] ."</a></td>";
  echo "</tr>";
  }
echo "</table>";




?>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bs/js/jquery.js"></script>
    <script src="bs/js/bootstrap.min.js"></script>
  </body>
</html>
