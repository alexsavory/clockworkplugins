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
    <style>
    .highlighted { background: yellow; }
  </style>

  </head>

  <body>

    <div class="container">

      <?php include('header.php');?>
      <?php
	date_default_timezone_set(''.$GMT.'');
	print '<div class="alert alert-info">Current Date/Time : <b>' . date("<big>m/d/y G.i:s A</big><br>", time()) . '</b><br><b>(For Comparison)<br> Timezone:'. $GMT .'</b></div>';
	
  $con = mysql_connect($address,$user,$pass);
if (!$con)
  {
  echo('<div class="alert alert-error">' . mysql_error() . '</div>');
  }
else echo('<div class="alert alert-success">Successfully Connected</div>');


mysql_select_db($database, $con);

$bans = mysql_query("SELECT * FROM bans WHERE `_Schema` = '".$gamemodecode."' ORDER BY _key");


echo "
<center>
<table class='table table-striped filterable'>
<h1>Bans</h1>
Filter: <script type='text/javascript' src='assets/tru/filterTable.js'></script></div>

<tr>
<th>Name</th>
<th>Unban At:</th>
<th>Duration</th>
<th>Reason</th>
";
$steamid = steamid64convert($steam_login_verify);
          if (issuperadmin($steamid) == "1") {
            echo "<th width='150px'>Actions</th>";
          }
echo "
</tr>
</center>
";
$todays_date = date("Y-m-d H:i:s");
$today = strtotime($todays_date);

while($row = @mysql_fetch_array($bans))
  {
	  $steam = $row['_Identifier'];
$parsed = SteamID2CommunityID($steam);
    if ($row['_UnbanTime'] == '0') {
	 echo "<tr class='error'>"; 
     } else if ( $row['_UnbanTime'] < $today ){
		 	 echo "<tr class='success'>"; 
	 } else {
		 	 echo "<tr class='warning'>"; 
	 }

  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>". $row['_SteamName'] ."</a></td>";
  if ($row['_UnbanTime'] == '0') 
     {
	 echo "<td><span class='label label-important'>Permanent Ban</span></td>"; 
     }
  		else
     {
  if ( $row['_UnbanTime'] < $today )
  			{
				echo "<td><span class='label label-success'>" . date("Y-m-d H:i:s", ($row["_UnbanTime"])). "</span></td>";
			}
				else
					{
				echo "<td><span class='label label-warning'>" . date("Y-m-d H:i:s", ($row["_UnbanTime"])). "</span></td>";		
					}
     }
	 if ($row['_Duration'] == '0') 
     {
	 echo "<td><span class='label label-important'>Permanent Ban</span></td>"; 
     }
  		else  echo "<td><span class='label label-warning'>" . date('G \h\o\u\r\s i \m\i\n\u\t\e\s', ($row["_Duration"])). "</span></td>";	
  echo "<td>" . $row['_Reason'] . "</td>";
  if (issuperadmin($steamid) == "1") {
            echo '
<td>
  <form action="banedit.php" method="post" style="display: inline;">
    <input type="hidden" name="action" value="banmanage" />
    <input type="hidden" name="action1" value="edit" />
  <input type="hidden" name="key" value="'.$row['_Key'].'" />
  <button type="submit" class="btn btn-inverse">Edit</button>
    </form>
<form action="banedit.php" method="post" style="display: inline;">
  <input type="hidden" name="action" value="banmanage" />
  <input type="hidden" name="action1" value="delete" />
  <input type="hidden" name="key" value="'.$row['_Key'].'" />
  <button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete the ban on \n'.$row['_SteamName'].'\nwho will be unbanned at \n'.date("l jS \of F Y h:i:s A", ($row["_UnbanTime"])) .'?\')" >Delete</button>
    </form></td>
    ';
          }

  echo "</tr>";
  }
echo "</table>";

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
