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

<?php
 error_reporting(E_ALL);
  ini_set("display_errors", 1);

if(!isset($_SESSION['steam_session']) && !isset($_POST['key'])){header("location:mycharacters.php");}
if ($_POST['action'] == "banmanage") {

if (!$con)
  {
  echo('<div class="alert alert-error">' . mysqli_error() . '</div>');
  }


mysqli_select_db(database, $con);

if ($_POST['action1'] == "delete") {

$key = mysqli_real_escape_string($_POST['key']);
    $delete = mysqli_query("DELETE FROM `bans` WHERE `_Key` = ".$key.";");
    if (mysqli_error()==""){ 
echo '<div class="alert alert-success"><h2><center>Successfully Deleted Ban</center></h2><br><a href="bans.php">Go back</a></div>';
}
else{
echo '<div class="alert alert-error"> ERROR'.mysqli_error().'</div>';
}
}


else if ($_POST['action1'] == "edit") {
if (!$con)
  {
  echo('<div class="alert alert-error">' . mysqli_error() . '</div>');
  }


mysqli_select_db($database, $con);

$key = mysqli_real_escape_string($_POST['key']);
  $result = mysqli_query("SELECT * FROM  `bans` WHERE `_Key` LIKE '".$key."'");
  while($row = mysqli_fetch_array($result))
  {
 echo '

<form action="banupdate.php" method="post">
<div class="input-prepend">
  <span class="add-on">SteamID</span>
  <input class="span2" name="steamid" type="text" value="'.$row['_Identifier'].'">
</div>
<div class="well">
Unban Time is in Epoch Time. <br>Please refer to <a href="http://www.csgnetwork.com/epochtime.html">http://www.csgnetwork.com/epochtime.html</a> to create a new time</div>
<div class="input-prepend">
  <span class="add-on">Unban Time</span>
  <input class="span2" name="unbantime" type="text" value="'.$row['_UnbanTime'].'">
</div>

<div class="input-prepend">
  <span class="add-on">Duration</span>
  <input class="span2" name="duration" type="text" value="'.$row['_Duration'].'">
</div>

<div class="input-prepend">
  <span class="add-on">Reason</span>
  <input class="span2" name="reason" type="text" value="'.$row['_Reason'].'">
</div>
<br>

 <input type="hidden" name="admin" value="yes" />
     <input type="hidden" name="key" value="'.$row['_Key'].'" />
     <button type="submit" class="btn btn-large btn-block btn-success">Save</button>
       
       
</form>


 ';
}
}
}
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
