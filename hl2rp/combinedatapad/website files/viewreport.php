<?php session_start();
require 'include/config.php';
// You shouldnt be here if your not logged in
// Get Unit and set session
       if (!isset($_SESSION['unitid'])) {
header("Location:index.php");
       }
       if (!isset($_SESSION['steamlogin'])) {
header("Location:index.php");
       }
       if(empty($_POST['key'])){
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

    <title>View Report</title>

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
      
  date_default_timezone_set($zone);
  date('I');
if ($_POST['action'] == "view" ) {

 $rid = $_POST['key'];

 $con = mysql_connect($address,$user,$pass);

if (!$con)
  {
  echo('<div class="alert alert-error">' . mysql_error() . '</div>');
  }

mysql_select_db($database, $con);
$result = mysql_query("SELECT * FROM  `combinereports` WHERE  `RID` = '".$rid."'");
while($row = @mysql_fetch_array($result))
  {
    if ($row['reviewed'] == "reviewed") {
      echo '<div class="alert alert-success">This has been reviewed by '.$row['reviewer'].', If they commented, it will be at the bottom. </div>';
    } else {

      echo '<form action="tools.php" method="post" style="display: inline;">
    <input type="hidden" name="action" value="deletereport" />
  <input type="hidden" name="key" value="'.$row['RID'].'" />
  <button type="submit" class="btn btn-block btn-danger" onclick="return confirm(\'Are you sure?\');">Delete</button>
    </form><br>';
    }
  echo '
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
<form class="form-horizontal" action="addreport.php" method="post" role="form">
  <div class="form-group">
    <label for="inputunitid" class="col-lg-2 control-label">Unit ID</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="inputunitid" readonly value="'.$row['unitname'].'">
    </div>
  </div>
  <div class="form-group">
    <label for="date" class="col-lg-2 control-label">Date/Time(OOC)</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="date" readonly value="'.$row['dateooc'].'">
    </div>
  </div>
  <div class="form-group">
    <label for="dateig" class="col-lg-2 control-label">Date/Time(IC)</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="dateig"  readonly value="'.$row['dateic'].'">
    </div>
  </div>
    <div class="form-group">
    <label for="location" class="col-lg-2 control-label">Location</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="location" readonly value="'.$row['location'].'">
    </div>
  </div>
    <div class="form-group">
    <label for="info" class="col-lg-2 control-label">Notes</label>
    <div class="col-lg-5">
      <textarea cols="50"  class="form-control" idinfo="info" readonly >'.$row['notes'].'</textarea>
    </div>
  </div>

  

          <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Reviewed By:'.$row['reviewer'].'</h3>
        </div>
        <div class="panel-body">
          <div class="form-group">
    <label for="comments" class="col-lg-2 control-label">Comments</label>
    <div class="col-lg-5">
      <textarea cols="50"  class="form-control" idinfo="comments" readonly name="comments" >'.$row['comments'].'</textarea>
    </div>
  </div>
        </div>
      </div></div>

</form>


  ';
}
}

if ($_POST['action'] == "review" ) {

 $rid = $_POST['key'];
         if (strposa($_SESSION['unitname'], $highranks, 1)) {} else {header("Location:dash.php");}
 $con = mysql_connect($address,$user,$pass);

if (!$con)
  {
  echo('<div class="alert alert-error">' . mysql_error() . '</div>');
  }

mysql_select_db($database, $con);
$result = mysql_query("SELECT * FROM  `combinereports` WHERE  `RID` = '".$rid."'");
while($row = @mysql_fetch_array($result))
  {
  echo '
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
<form class="form-horizontal" action="process/reviewreport.php" method="post" role="form">
 <input type="hidden" name="reviewer" value="'.$_SESSION['unitname'].'" />
  <input type="hidden" name="key" value="'.$row['RID'].'" />
  <div class="form-group">
    <label for="inputunitid" class="col-lg-2 control-label">Unit ID</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="inputunitid" readonly value="'.$row['unitname'].'">
    </div>
  </div>
  <div class="form-group">
    <label for="date" class="col-lg-2 control-label">Date/Time(OOC)</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="date" readonly value="'.$row['dateooc'].'">
    </div>
  </div>
  <div class="form-group">
    <label for="dateig" class="col-lg-2 control-label">Date/Time(IC)</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="dateig"  readonly value="'.$row['dateic'].'">
    </div>
  </div>
    <div class="form-group">
    <label for="location" class="col-lg-2 control-label">Location</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="location" readonly value="'.$row['location'].'">
    </div>
  </div>
    <div class="form-group">
    <label for="info" class="col-lg-2 control-label">Notes</label>
    <div class="col-lg-5">
      <textarea cols="50"  class="form-control" id="info" readonly >'.$row['notes'].'</textarea>
    </div>
  </div>
<div class="form-group">
    <label for="comments" class="col-lg-2 control-label">Comments</label>
    <div class="col-lg-5">
      <textarea cols="50"  class="form-control" id="comments" name="comments" value="">'.$row['comments'].'</textarea>
    </div>
  </div>
  <input type="checkbox" name="reviewed" value="yes">Set Status to reviewed<br>
  <button type="submit" class="btn btn-success">Submit</button>
</form>


  ';
}
}

      ?>




      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bs/js/jquery.js"></script>
    <script src="bs/js/bootstrap.min.js"></script>
  </body>
</html>
