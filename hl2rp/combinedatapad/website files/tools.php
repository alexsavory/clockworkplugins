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

    <title>Resident Search</title>

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
if ($_GET['action'] == "citizenlist" ) {
  echo '
  <div class="page-header">
  <h1>Query Database<small> Find Current Residents by either:</small></h1>
</div>
  <div class="panel panel-default">
  <div class="panel-body">
<form action="results.php" method="post">
  <div class="form-group">
    <label for="citizenid" class="col-lg-1 control-label">CitizenID</label>
    <div class="col-lg-2">
      <input type="text" class="form-control" name="citizenid" placeholder="CitizenID" maxlength="10">
    </div>
  </div>

      <button type="submit" class="btn btn-default">Search</button>

    <input type="hidden" name="action" value="citizenid" />
</form>
  </div>
</div>
<h1>Or</h1>
  <div class="panel panel-default">
  <div class="panel-body">
<form action="results.php" method="post">
  <div class="form-group">
    <label for="name" class="col-lg-1 control-label">Name</label>
    <div class="col-lg-2">
      <input type="text" class="form-control" name="name" placeholder="Name" maxlength="10">
    </div>
  </div>

      <button type="submit" class="btn btn-default">Search</button>

    <input type="hidden" name="action" value="citizenname" />
</form>
  </div>
</div>


  ';
}
if ($_POST['action'] == "deletereport" ) {

$con1 = mysql_connect($address,$user,$pass);
if (!$con1)
  {
  echo('<div class="alert alert-error">Error! ' . mysql_error() . '. Please tell the owner.</div>');
  }

// Get report variables
    $id = mysql_real_escape_string($_POST['key']);



mysql_select_db($database, $con1);
$result = mysql_query("DELETE FROM `combinereports` WHERE `RID` = '".$id."' ");
if (!$result) {
    die('<div class="alert alert-danger"><b>Invalid Query. Tell the owner<br> '.mysql_error().'</div>');
} else {

  echo '<div class="alert alert-success"><b>Deleted</b> <a href="dash.php">Go To dashboard</a></div>';
}

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
