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

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="bs/ico/favicon.png">

    <title>Add Report</title>

    <!-- Bootstrap core CSS -->
    <link href="bs/css/bootstrap.css" rel="stylesheet">
<script language="javascript/text">
function addTxt(txt, field)
{
var myTxt = txt;
var id = field;
document.getElementById(id).value = myTxt;
}
</script>

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



      ?>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
<!-- Can't refresh in derma -->
<A class="btn btn-sm btn-info"HREF="javascript:history.go(0)">Refresh Time</A>

<form class="form-horizontal" action="process/processreport.php" method="post" role="form">
  <div class="form-group">
    <label for="inputunitid" class="col-lg-2 control-label">Unit ID</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="inputunitid" name='unit' readonly value="<?php echo $_SESSION['unitname']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="date" class="col-lg-2 control-label">Date/Time(OOC)</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="date" name='dateooc' readonly value="<?php echo date('m/d/Y h:i:s a'); ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="dateic" class="col-lg-2 control-label">Date/Time(IC)</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="dateic" name='dateic' required value="">
    </div>
  </div>
    <div class="form-group">
    <label for="location" class="col-lg-2 control-label">Location</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="location" name='location' required value="">
    </div>
  </div>
    <div class="form-group">
    <label for="info" class="col-lg-2 control-label">Notes</label>
    <div class="col-lg-5">
      <textarea cols="50"  class="form-control" id="info" required name='notes' value=""></textarea>
    </div>
  </div>
  <input type="hidden" name="unitkey" value="<?php echo $_SESSION['unitid']; ?>" />
  <button class="btn btn-lg btn-info btn-block" type="submit">Submit</button>
</form>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bs/js/jquery.js"></script>
    <script src="bs/js/bootstrap.min.js"></script>
    <script type= "javascript/text" src="include/myjavafunc.js"></script>
  </body>
</html>
