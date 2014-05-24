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


$result = mysql_query("SELECT * FROM  `characters` WHERE `_Schema` = '".$gamemodecode."' AND `_Key` LIKE  '".$key."'");
if (mysql_error()==""){ 
echo '<div class="alert alert-success">Successfully Queried</div>'; 
}
else

echo '<div class="alert alert-success"> ERROR'.mysql_error().'</div>';





while($row = @mysql_fetch_array($result))
  {
	  $currentflag = $row['_Flags'];
	  echo '
<form action="insert.php" method="post">
Unique ID: <input name="key" type="text" size="150" readonly style="width: 300px;" value="'.$row['_Key'].'"><br>
Character Name: <input name="charname" type="text" size="150" readonly style="width: 300px;" value="'.$row['_Name'].'"><br>
Steam Name: <input name="steamname" type="text" size="150" readonly style="width: 300px;" value="'.$row['_SteamName'].'"><br>
Current Flags: <input name="myflag" type="text" size="150" readonly style="width: 300px;" value="'.$row['_Flags'].'"><br>
';
if(false !== stripos($currentflag, $flags)){
  echo '<div class="alert alert-warning">'.$row['_Name'].' Already has '.$flags.'!</div>';
} else {echo'<button type="submit" class="btn btn-primary">Add Flags</button>';}

echo"</form>";
  }
?>
  </p>
	</div>
    <hr>
    <div class="footer">
     <center>&copy; <?php echo "<a href='$url'>$site</a>"; ?> | By Trurascalz </p></center>
      </div>
</div>
</body>
</html>
