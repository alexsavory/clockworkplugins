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


 <?php include('header.php'); ?>
  <?php 
  if(!isset($_SESSION['steamlogin'])){header("location:index.php");}




$con = mysql_connect($address,$user,$pass);
if (!$con)
  {
  echo('<div class="alert alert-error">' . mysql_error() . '</div>');
  }


mysql_select_db($database, $con);


$steamid = mysql_real_escape_string($_SESSION['steamname']);

$result = mysql_query("SELECT * FROM  `players` WHERE `_Schema` = '".$gamemodecode."' AND `_SteamID` LIKE  '".$steamid."'");
if (mysql_error()==""){ 

}
else

echo '<div class="alert alert-error"> ERROR'.mysql_error().'</div>';



?><?php
while($row = @mysql_fetch_array($result))
  {
?>

<center><h1>Hello <?php echo $steampersona;?>.</h1></center>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
      <!--Whitelists content-->
      <?php
      $data = $row['_Data'];

    $whitelist = extract_text($data, '"Whitelisted":["', '"],"');
$your_array = explode('","', $whitelist);
$arrlength=count($your_array);
echo "<div class='well'>";
echo "<h2>Your Whitelists</h2>";
for($x=0;$x<$arrlength;$x++)
  {
  echo $your_array[$x];
  echo "<br>";
  }
echo "</div>";
      ?>
    </div>
    <div class="span8">
      <!--Other content-->
      <div class="container-fluid">
  <div class="row-fluid">
      <div class="input-prepend">
  <span class="add-on">Unique ID</span>
    <span class="input-xlarge uneditable-input"><?php echo $row['_Key'];?></span>
  </div>
        <div class="input-prepend">
  <span class="add-on">Usergroup</span>
    <span class="input-xlarge uneditable-input"><?php 
echo $row['_UserGroup'];
    ?></span>
  </div>
        <div class="input-prepend">
  <span class="add-on">IP</span>
    <span class="input-xlarge uneditable-input">    <?php echo $row['_IPAddress'];?></span>
  </div>
          <div class="input-prepend">
  <span class="add-on">Last Played</span>
    <span class="input-xlarge uneditable-input">    
      <?php 
$lastplayed = $row['_LastPlayed'];
  echo "" . date('D M j G:i:s Y', $lastplayed) . "";
    ?>
  </span>
  </div>
            <div class="input-prepend">
  <span class="add-on">Joined</span>
    <span class="input-xlarge uneditable-input">    
      <?php 
$joined = $row['_TimeJoined'];
  echo "" . date('D M j G:i:s Y', $joined) . "";
    ?>
  </span>
  </div>
    </div>
  </div>
</div>

  </div>
</div>
<?php

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
