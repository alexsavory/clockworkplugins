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
      <div class="jumbotron">
        <h1><?php 
if ($logoenabled == 1) {
   echo '<IMG SRC="' .$logo .'"</span>';
} else {
echo $site ;
}?></h1>
        <p class="lead">Welcome to <?php echo $site; echo "'s "; echo $game ;?> Database!</p>
        <a class="btn btn-large btn-info" href="<?php echo $website ?>">Visit <?php echo $site?></a>
      </div>

      <hr>

      <!-- Example row of columns -->
      <div class="row-fluid">
        <div class="span6">
          <h2>Bans</h2>
          <p>View <b>Clockwork</b> Bans here or find a player's characters and file a ban or unban!</p>
          <div class="well">
 <?php 
 $todays_date = date("Y-m-d H:i:s");
$today = strtotime($todays_date);
 $con = mysql_connect($address,$user,$pass);
if (!$con)
  {
  echo('<div class="alert alert-error">' . mysql_error() . '</div>');
  }
mysql_select_db($database, $con);
$bans = mysql_query("SELECT * 
FROM  `bans` 
ORDER BY  `bans`.`_Key` DESC 
LIMIT 0 ,1");
while($row = @mysql_fetch_array($bans))
  {
	  echo "Latest Ban:<b>".$row['_SteamName']."</b><br> Reason: <code>".$row['_Reason']."</code><p>";
	  if ($row['_UnbanTime'] == '0') 
     {
	 echo "<td><span class='label label-important'>Permanent Ban</span></td>"; 
     }
  		else
     {
  if ( $row['_UnbanTime'] < $today )
  			{
				echo "<td><span class='label label-success'>" . date("Y-m-d H:i:s", ($row["_UnbanTime"])). " - Unbanned</span></td>";
			}
				else
					{
				echo "<span class='label label-warning'>" . date("Y-m-d H:i:s", ($row["_UnbanTime"])). " - Still Banned</span></td>";		
					}
     }
  }
?>
			</div>
          <p><a class="btn btn-danger" href="bans.php">View More &raquo;</a></p>
        </div>
        <div class="span4">
          <h2>Characters</h2>
          <p> This web applications gives access to view characters and their owners</p>
          <p><a class="btn" href="characters.php">View details &raquo;</a></p>
       </div>
<?php
if ($enablecustomfeaturebox ==1) {
  echo $customfeatureboxcontent;
} else {echo '
        <div class="span4">
          <h2>Steam integration!</h2>
          <p>You can now login with steam! Click the login with steam icon in the navigation area!</p>
          <p><b><i>No secure or private information is shared</i></b></p>
       </div>

';}
?>
      </div>

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
