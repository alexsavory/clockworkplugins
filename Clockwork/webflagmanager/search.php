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


if(empty($_GET['steamid'])){
die('<div class="alert alert-info">You need to enter a STEAM:ID</div>'); 
}


$steam = mysql_real_escape_string($_GET['steamid']);


$result = mysql_query("SELECT * FROM  `characters` WHERE `_Schema` = '".$gamemodecode."' AND `_SteamID` LIKE  '".$steam."'");
if (mysql_error()==""){ 
echo '<div class="alert alert-success">Successfully Queried</div>'; 
}
else

echo '<div class="alert alert-success"> ERROR'.mysql_error().'</div>';


echo "
<center>
<table class='table table-striped'>
<h1>Results</h1>
<tr>
<th>Name</th>
<th>Faction</th>
<th>Steam ID</th>
<th>Steam Name</th>
<th>Action</th>
</tr>
</center>
";


while($row = @mysql_fetch_array($result))
  {
$lastplayed = $row['_LastPlayed'];

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
    echo "<td>" . $row['_Faction'] . "</td>";
  echo "<td>".$row['_SteamID'] ."</a></td>";
  echo "<td>" . $row['_SteamName'] . "</td>";
  echo '<td> <form action="flags.php" method="post">
  <input type="hidden" name="key" value="'.$row['_Key'].'" />
  <button type="submit" class="btn btn-primary">Add '.$flags.' Flags</button>
    </form></td>';
  echo "</tr>";
  }
echo "</table>";
?>
  </p>
	</div>
    <hr>
    <div class="footer">
     <center>&copy; <?php echo "<a href='$url'>$site</a>" ?> | By Trurascalz </p></center>
      </div>
</div>
</body>
</html>
