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
  if(!isset($_SESSION['steam_session']) && !isset($_POST['key'])){header("location:mycharacters.php");}



$con = mysql_connect($address,$user,$pass);
if (!$con)
  {
  echo('<div class="alert alert-error">' . mysql_error() . '</div>');
  }


mysql_select_db($database, $con);


$key = mysql_real_escape_string($_POST['key']);
$nameofchar = mysql_real_escape_string($_POST['name']);
// Deleting or editing?
if ($_POST['action'] == "delete") {
  $delete = mysql_query("DELETE FROM `characters` WHERE `characters`.`_Key` = ".$key.";");
  if (mysql_error()==""){ 
echo '<div class="alert alert-success"><h2><center>Successfully Deleted '.$nameofchar.'</center></h2><br><a href="mycharacters.php">Go back to My Characters</a></div>';
}
else{
echo '<div class="alert alert-error"> ERROR'.mysql_error().'</div>';
}
} else {

if ($_POST['action'] == "playeredit") {
 $result = mysql_query("SELECT * FROM  `players` WHERE `_Schema` = '".$gamemodecode."' AND `_Key` LIKE  '".$key."'");
} else
$result = mysql_query("SELECT * FROM  `characters` WHERE `_Schema` = '".$gamemodecode."' AND `_Key` LIKE  '".$key."'");
if (mysql_error()==""){ 

}
else

echo '<div class="alert alert-error"> ERROR'.mysql_error().'</div>';



?><?php
while($row = @mysql_fetch_array($result))
  {
    if ($_POST['admin'] == "yes") {
      // Admin Editing
      $steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);
echo '<div class="alert alert-error"><strong>Head\'s up!</strong><br> Your editing this as a admin!</div>

<div class="alert alert-info"><strong>Information</strong><br>
This character is owned by <a href="http://steamcommunity.com/profiles/$parsed">'. $row['_SteamName'] .'</a><br>
This character was created on:'.date('r', $row['_TimeCreated']).'<br>
This character was last played on: '.date('r', $row['_LastPlayed']).'
</div>
';


echo '
<form action="insert.php" method="post">
<div class="input-prepend">
  <span class="add-on">Name</span>
  <input class="span2" name="name" type="text" value="'.$row['_Name'].'">
</div>

<div class="input-prepend">
  <span class="add-on">Cash</span>
  <input class="span2" name="cash" type="text" value="'.$row['_Cash'].'">
</div>

<div class="input-prepend">
  <span class="add-on">Faction</span>
  <input class="span2" name="faction" type="text" value="'.$row['_Faction'].'">
</div>

<div class="input-prepend">
  <span class="add-on">Flags</span>
  <input class="span2" name="flags" type="text" value="'.$row['_Flags'].'">
</div>
<br>
<div class="input-prepend">
  <span class="add-on">Model</span>
  <input class="span4" name="model" type="text" value="'.$row['_Model'].'">
</div>
<div class="alert alert-warning"><strong>Extended Editing!</strong><br>To edit cell\'s like Inventory and Data use phpMyAdmin</div>


<br>
 <input type="hidden" name="admin" value="yes" />
     <input type="hidden" name="key" value="'.$row['_Key'].'" />
     <button type="submit" class="btn btn-large btn-block btn-success">Save</button>
       
       
</form>';







    } else if ($_POST['action'] == "playeredit") {

      $steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);
echo '<div class="alert alert-error"><strong>Head\'s up!</strong><br> Your editing this as a admin!</div>

<div class="alert alert-info"><strong>Information</strong><br>
You are editing:'.$row['_SteamName'].'
This Player is a <b>'.$row['_UserGroup'].'</b><br>
They joined on '.date('r', $row['_TimeJoined']).'<br>
They last played on '.date('r', $row['_LastPlayed']).'
</div>
';


echo '
<form action="insert.php" method="post">
<div class="well"><b>Ranks: superadmin,admin,operator,user</b></div>
<div class="input-prepend">
  <span class="add-on">Rank</span>
  <input class="span2" name="rank" type="text" value="'.$row['_UserGroup'].'">
</div>

<div class="alert alert-warning"><h3>Listen up!</h3> This data is not extracted, it is the original so if you don\'t know what your doing,<b>Don\'t Do it!</b><br>Here is the whitelist template:
<code>"Whitelisted":["A Faction","Another Faction"],</code> Too add factions, place a Comma(,) after the last faction in the <code>[ ]</code> and type the faction in " "<br>
Here is the <B>Original Data</B>:<br>
<code>
'.htmlspecialchars($row['_Data']).'
</code>
</div>
<div class="input-prepend">
  <span class="add-on">Data</span>
  <input class="span4" name="cash" type="text" value="'.htmlspecialchars($row['_Data']).'">
</div>



<br>
 <input type="hidden" name="admin" value="yes" />
     <input type="hidden" name="key" value="'.$row['_Key'].'" />
     <button type="submit" class="btn btn-large btn-block btn-success">Save</button>
       
       
</form>';

    } 
 else {

    $data = $row['_Data'];
    $cid = extract_text($data, '"citizenid":"', '","');

 echo '<h1>You are editing '. $row['_Name'].'</h1>
<div class="container-fluid">
  <div class="row-fluid">
      <div class="input-prepend">
  <span class="add-on">Name</span>
    <span class="input-xlarge uneditable-input">'. $row['_Name'].'</span>
  </div>
        <div class="input-prepend">
  <span class="add-on">Citizen ID</span>
    <span class="input-xlarge uneditable-input">

    $cid</span>
  </div>
        <div class="input-prepend">
  <span class="add-on">Money</span>
    <span class="input-xlarge uneditable-input">    '. $row['_Cash'].'</span>
  </div>

      <div class="input-prepend">
  <span class="add-on">Role</span>
    <span class="input-xlarge uneditable-input">'. $row['_Faction'].'</span>
  </div>
          <div class="input-prepend">
  <span class="add-on">Gender</span>
    <span class="input-xlarge uneditable-input">'. $row['_Gender'].'
</span>
  </div>';


    $unit = extract_text($data, '"PhysDesc":"', '","');
    echo '<form action="insert.php" method="post">
            <div class="input-prepend input-append">
  <span class="add-on">Physical Description</span>
    <input name="physdesc" type="text" name="physdesc" class="input-block-level" value="'.$unit.'">
     <input type="hidden" name="key" value="'.$row['_Key'].'" />
     
       
       </div>
       <button type="submit" class="btn btn-block btn-success">Save</button>
     </form>
    ';
    }
    ?>
    

  </div>
</div>






  

<?php


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
