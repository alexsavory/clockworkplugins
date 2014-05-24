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

    <title>Announcements</title>

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
      <?php include('header.php');

$con = mysql_connect($address,$user,$pass);

if (!$con)
  {
  echo('<div class="alert alert-danger">' . mysql_error() . '</div>');
  }

mysql_select_db($database, $con);
$result = mysql_query("SELECT * FROM  `combineannoucements` ORDER BY  `RID` DESC");
while($row = @mysql_fetch_array($result))
  {
      ?>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="well">
        <p><div class="alert <?php echo $row['type'];?>"><big><?php echo $row['title'];?></big><br><?php echo $row['info'];?><br>- <?php echo $row['creator'];?></div></p>
      </div>
      <?php 
  }
      ?>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bs/js/jquery.js"></script>
    <script src="bs/js/bootstrap.min.js"></script>
  </body>
</html>
