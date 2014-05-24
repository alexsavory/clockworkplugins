<!DOCTYPE html>
<html lang="en">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">


<body>
<div class="container">
   <div class="hero-unit">
   
  <h1>Welcome!</h1>
  <p><?php include('globalconfig.php');echo $site ?>'s Flag Distribution Terminal</p>
  <p><?php 
$con = mysql_connect($address,$user,$pass);
if (!$con)
  {
  echo('<div class="alert alert-error">' . mysql_error() . '</div>');
  }
else echo('<div class="alert alert-success">Successfully Connected</div>');

mysql_select_db($database, $con);


if(empty($_POST['key'])){
header( 'Location: index.php' ) ;
}


$key = mysql_real_escape_string($_POST['key']);
$currentflag = $_POST['myflag'];


$result = mysql_query("UPDATE `".$database."`.`".$characters."` SET `_Flags` = '$currentflag$flags'  WHERE `".$characters."`.`_Key` = ".$key."");
if (mysql_error()==""){ 
echo '<div class="alert alert-success">Successfully Added '.$flags.'</div>'; 
}
else

echo '<div class="alert alert-error"> ERROR'.mysql_error().'</div>';







  
?>
<a class="btn btn-large btn-info" href="<?php echo $url ?>">Go back to <?php echo $site?></a>
  </p>
	</div>
    <hr>
    <div class="footer">
     <center>&copy; <?php echo "<a href='$url'>$site</a>"; ?> | By Trurascalz </p></center>
      </div>
</div>
</body>
</html>
