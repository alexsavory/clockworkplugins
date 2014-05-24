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
        <h2 class="form-signin-heading">Review Report</h2>
        <?php
        if (strposa($_SESSION['unitname'], $highranks, 1)) {} else {header("Location:dash.php");}
        
$con = mysql_connect($address,$user,$pass);
if (!$con)
  {
  echo('<div class="alert alert-error">Error! ' . mysql_error() . '. Please tell the owner.</div>');
  }

// Get report variables
    $id = mysql_real_escape_string($_POST['key']);
    $comments = mysql_real_escape_string(strip_tags($_POST['comments']));
    $status = mysql_real_escape_string($_POST['reviewed']);
    $reviewer = mysql_real_escape_string($_POST['reviewer']);

    if ($status == "yes") {
      $ridstatus = "reviewed";
    } else $ridstatus = "";



mysql_select_db($database, $con);
$result = mysql_query("UPDATE  `combinereports` SET  `reviewed` =  '".$ridstatus."',`reviewer` =  '".$reviewer."',`comments` =  '".$comments."' WHERE  `RID` =  '".$id."' LIMIT 1");
if (!$result) {
    die('<div class="alert alert-danger"><b>Invalid Query. Tell the owner<br> '.mysql_error().'</div>');
} else {

  echo '<div class="alert alert-success"><b>Complete</b> <a href="../dash.php">Go To dashboard</a></div>';
}
        ?>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
