<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Add Report</title>

    <!-- Bootstrap core CSS -->
    <link href="../bs/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../bs/css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
    <?php
    require('../include/functions.php');
    require('../include/config.php');
    ?>
  </head>

  <body>

    <div class="container">
<br>
      <form class="form-signin well">
        <h2 class="form-signin-heading">Adding Report</h2>
        <?php
                if (empty($_POST['unit'])) {
          header("Location:dash.php");
        }
$con = mysql_connect($address,$user,$pass);
if (!$con)
  {
  echo('<div class="alert alert-error">Error! ' . mysql_error() . '. Please tell the owner.</div>');
  }

// Get report variables
    $unitid = mysql_real_escape_string($_POST['unitkey']);
    $unitname = mysql_real_escape_string($_POST['unit']);
    $dateooc = mysql_real_escape_string($_POST['dateooc']);
    $dateic = mysql_real_escape_string($_POST['dateic']);
    $location = mysql_real_escape_string($_POST['location']);
    $notes = mysql_real_escape_string($_POST['notes']);


mysql_select_db($database, $con);
$result = mysql_query("INSERT INTO `combinereports` (`unitid`,`unitname`, `dateooc`, `dateic`, `location`, `notes`, `reviewed`, `RID`,`reviewer`) VALUES ('$unitid', '$unitname','$dateooc', '$dateic', '$location', '$notes', 'no', NULL,'Nobody')");
if (!$result) {
    die('<div class="alert alert-danger"><b>Invalid Query. Tell the owner<br> '.mysql_error().'</div>');
} else {

  echo '<div class="alert alert-success"><b>Reported</b> View your reports <a href="../myreports.php"> Here</a></div>';
}
        ?>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
