<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hl2RP Roster</title>

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">

<?php
/*
Configuration
*/
 
include('header.php');

include('globalconfig.php');
$con = mysql_connect($address,$user,$pass);
if (!$con)
  {
  die('<div class="alert alert-error">ERROR! Unable to connect: ' . mysql_error().'</div>');
  } else {echo "<div class='alert alert-success'>Connected to database </div>";}

mysql_select_db($database, $con);
if (!isset($_GET['id'])){header("Location: ?id=all");}

if (isset($_GET['id'])) {
$id = $_GET['id']; 
if ($id == "all"){

	$generalunit = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$general."%'AND `_Faction` LIKE  'Metropolice Force' 
ORDER BY CASE
	WHEN `_Name` LIKE '%DvL%' THEN 1
	WHEN `_Name` LIKE '%EpU%' THEN 2
	WHEN `_Name` LIKE '%OfC%' THEN 3
	WHEN `_Name` LIKE '%".$prefixbefore."01".$prefixafter."%' THEN 4
	WHEN `_Name` LIKE '%".$prefixbefore."02".$prefixafter."%' THEN 5
	WHEN `_Name` LIKE '%".$prefixbefore."03".$prefixafter."%' THEN 6
	WHEN `_Name` LIKE '%".$prefixbefore."04".$prefixafter."%' THEN 7
	WHEN `_Name` LIKE '%".$prefixbefore."05".$prefixafter."%' THEN 8
	WHEN `_Name` LIKE '%-RCT.%' THEN 9
END ASC");
$courtunit = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$court."%' AND `_Faction` LIKE  'Metropolice Force'
ORDER BY CASE
	WHEN `_Name` LIKE '%DvL%' THEN 1
	WHEN `_Name` LIKE '%EpU%' THEN 2
	WHEN `_Name` LIKE '%OfC%' THEN 3
	WHEN `_Name` LIKE '%".$prefixbefore."01".$prefixafter."%' THEN 4
	WHEN `_Name` LIKE '%".$prefixbefore."02".$prefixafter."%' THEN 5
	WHEN `_Name` LIKE '%".$prefixbefore."03".$prefixafter."%' THEN 6
	WHEN `_Name` LIKE '%".$prefixbefore."04".$prefixafter."%' THEN 7
	WHEN `_Name` LIKE '%".$prefixbefore."05".$prefixafter."%' THEN 8
	WHEN `_Name` LIKE '%-RCT.%' THEN 9
END ASC");
$medicunit = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$medic."%' AND `_Faction` LIKE  'Metropolice Force'
ORDER BY CASE
	WHEN `_Name` LIKE '%DvL%' THEN 1
	WHEN `_Name` LIKE '%EpU%' THEN 2
	WHEN `_Name` LIKE '%OfC%' THEN 3
	WHEN `_Name` LIKE '%".$prefixbefore."01".$prefixafter."%' THEN 4
	WHEN `_Name` LIKE '%".$prefixbefore."02".$prefixafter."%' THEN 5
	WHEN `_Name` LIKE '%".$prefixbefore."03".$prefixafter."%' THEN 6
	WHEN `_Name` LIKE '%".$prefixbefore."04".$prefixafter."%' THEN 7
	WHEN `_Name` LIKE '%".$prefixbefore."05".$prefixafter."%' THEN 8
	WHEN `_Name` LIKE '%-RCT.%' THEN 9
END ASC");
$engineerunit = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$engineer."%' AND `_Faction` LIKE  'Metropolice Force'
ORDER BY CASE
	WHEN `_Name` LIKE '%DvL%' THEN 1
	WHEN `_Name` LIKE '%EpU%' THEN 2
	WHEN `_Name` LIKE '%OfC%' THEN 3
	WHEN `_Name` LIKE '%".$prefixbefore."01".$prefixafter."%' THEN 4
	WHEN `_Name` LIKE '%".$prefixbefore."02".$prefixafter."%' THEN 5
	WHEN `_Name` LIKE '%".$prefixbefore."03".$prefixafter."%' THEN 6
	WHEN `_Name` LIKE '%".$prefixbefore."04".$prefixafter."%' THEN 7
	WHEN `_Name` LIKE '%".$prefixbefore."05".$prefixafter."%' THEN 8
	WHEN `_Name` LIKE '%-RCT.%' THEN 9
END ASC");

/// Specific Ranks
$sec = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%SeC%' AND `_Faction` LIKE  'Metropolice Force'");
if ($cmdenable == "1") {$cmd = mysql_query("SELECT * FROM  `characters` WHERE `_Name` LIKE '%".$cmdname."%' AND `_Faction` LIKE  'Metropolice Force'");}
$dvl = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%DvL%' AND `_Faction` LIKE  'Metropolice Force'");
$epu = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%EpU%' AND `_Faction` LIKE  'Metropolice Force'");
$ofc = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%OfC%' AND `_Faction` LIKE  'Metropolice Force'");
$scn = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%SCN%' AND `_Faction` LIKE  'Metropolice Force'");
$rct = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%RCT%' AND `_Faction` LIKE  'Metropolice Force'");

echo "
<center>
<table class='table table-striped'>
<h1>Sectional Leader</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($sec))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";

if($cmdenable == 1){
echo "
<center>
<table class='table table-striped'>
<h1>Commander</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($cmd))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";
};


///////////////////////////////////

echo "
<center>
<table class='table table-striped'>
<h1>Divisional Leaders</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($dvl))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";

///////////////////////////////////////

echo "
<center>
<table class='table table-striped'>
<h1>Elite Protection Units</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($epu))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";


////////////////////////////////

echo "
<center>
<table class='table table-striped'>
<h1>Officers</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($ofc))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";

/////////////////////////////////


echo "
<center>
<table class='table table-striped'>
<h1>".$general." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($generalunit))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";

/////////////////////


echo "
<center>
<table class='table table-striped'>
<h1>".$court." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($courtunit))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";

/////////////////////////////////////////



echo "
<center>
<table class='table table-striped'>
<h1>".$medic." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($medicunit))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";


//////////////////////////////////

echo "
<center>
<table class='table table-striped'>
<h1>".$engineer." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($engineerunit))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";

///////////////////////////////////////////

echo "
<center>
<table class='table table-striped'>
<h1>Scanners</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($scn))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";



/////////////////////////



echo "
<center>
<table class='table table-striped'>
<h1>Recruits</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($rct))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";

mysql_close($con);

	} else if ($id == $general){
	$generalunit = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$general."%'AND `_Faction` LIKE  'Metropolice Force' 
ORDER BY CASE
	WHEN `_Name` LIKE '%DvL%' THEN 1
	WHEN `_Name` LIKE '%EpU%' THEN 2
	WHEN `_Name` LIKE '%OfC%' THEN 3
	WHEN `_Name` LIKE '%".$prefixbefore."01".$prefixafter."%' THEN 4
	WHEN `_Name` LIKE '%".$prefixbefore."02".$prefixafter."%' THEN 5
	WHEN `_Name` LIKE '%".$prefixbefore."03".$prefixafter."%' THEN 6
	WHEN `_Name` LIKE '%".$prefixbefore."04".$prefixafter."%' THEN 7
	WHEN `_Name` LIKE '%".$prefixbefore."05".$prefixafter."%' THEN 8
	WHEN `_Name` LIKE '%-RCT.%' THEN 9
END ASC");

echo "
<center>
<table class='table table-striped'>
<h1>".$general." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($generalunit))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";
	}
else if ($id == $court){
	$judgeunit = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$court."%'AND `_Faction` LIKE  'Metropolice Force' 
ORDER BY CASE
	WHEN `_Name` LIKE '%DvL%' THEN 1
	WHEN `_Name` LIKE '%EpU%' THEN 2
	WHEN `_Name` LIKE '%OfC%' THEN 3
	WHEN `_Name` LIKE '%".$prefixbefore."01".$prefixafter."%' THEN 4
	WHEN `_Name` LIKE '%".$prefixbefore."02".$prefixafter."%' THEN 5
	WHEN `_Name` LIKE '%".$prefixbefore."03".$prefixafter."%' THEN 6
	WHEN `_Name` LIKE '%".$prefixbefore."04".$prefixafter."%' THEN 7
	WHEN `_Name` LIKE '%".$prefixbefore."05".$prefixafter."%' THEN 8
	WHEN `_Name` LIKE '%-RCT.%' THEN 9
END ASC");

echo "
<center>
<table class='table table-striped'>
<h1>".$court." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($judgeunit))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";
	}
	else if ($id == $medic){
	$medicunit = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$medic."%'AND `_Faction` LIKE  'Metropolice Force' 
ORDER BY CASE
	WHEN `_Name` LIKE '%DvL%' THEN 1
	WHEN `_Name` LIKE '%EpU%' THEN 2
	WHEN `_Name` LIKE '%OfC%' THEN 3
	WHEN `_Name` LIKE '%".$prefixbefore."01".$prefixafter."%' THEN 4
	WHEN `_Name` LIKE '%".$prefixbefore."02".$prefixafter."%' THEN 5
	WHEN `_Name` LIKE '%".$prefixbefore."03".$prefixafter."%' THEN 6
	WHEN `_Name` LIKE '%".$prefixbefore."04".$prefixafter."%' THEN 7
	WHEN `_Name` LIKE '%".$prefixbefore."05".$prefixafter."%' THEN 8
	WHEN `_Name` LIKE '%-RCT.%' THEN 9
END ASC");

echo "
<center>
<table class='table table-striped'>
<h1>".$medic." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($medicunit))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";
	}
	else if ($id == $engineer){
	$engineerunit = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$engineer."%'AND `_Faction` LIKE  'Metropolice Force' 
ORDER BY CASE
	WHEN `_Name` LIKE '%DvL%' THEN 1
	WHEN `_Name` LIKE '%EpU%' THEN 2
	WHEN `_Name` LIKE '%OfC%' THEN 3
	WHEN `_Name` LIKE '%".$prefixbefore."01".$prefixafter."%' THEN 4
	WHEN `_Name` LIKE '%".$prefixbefore."02".$prefixafter."%' THEN 5
	WHEN `_Name` LIKE '%".$prefixbefore."03".$prefixafter."%' THEN 6
	WHEN `_Name` LIKE '%".$prefixbefore."04".$prefixafter."%' THEN 7
	WHEN `_Name` LIKE '%".$prefixbefore."05".$prefixafter."%' THEN 8
	WHEN `_Name` LIKE '%-RCT.%' THEN 9
END ASC");

echo "
<center>
<table class='table table-striped'>
<h1>".$engineer." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($engineerunit))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";
	}
	else if ($id == $scanner){
	$scn = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%SCN%' AND `_Faction` LIKE  'Metropolice Force'");


echo "
<center>
<table class='table table-striped'>
<h1>".$scanner." Units</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($scn))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";
	}
	else if ($id == $recruit){
	$rct = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%RCT%' AND `_Faction` LIKE  'Metropolice Force'");


echo "
<center>
<table class='table table-striped'>
<h1>".$recruit." Units</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($rct))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";
	}
	else if ($enableextra1 == 1 && $id == $extra1){
	$extra1unit = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$extra1."%'AND `_Faction` LIKE  'Metropolice Force' 
ORDER BY CASE
	WHEN `_Name` LIKE '%DvL%' THEN 1
	WHEN `_Name` LIKE '%EpU%' THEN 2
	WHEN `_Name` LIKE '%OfC%' THEN 3
	WHEN `_Name` LIKE '%".$prefixbefore."01".$prefixafter."%' THEN 4
	WHEN `_Name` LIKE '%".$prefixbefore."02".$prefixafter."%' THEN 5
	WHEN `_Name` LIKE '%".$prefixbefore."03".$prefixafter."%' THEN 6
	WHEN `_Name` LIKE '%".$prefixbefore."04".$prefixafter."%' THEN 7
	WHEN `_Name` LIKE '%".$prefixbefore."05".$prefixafter."%' THEN 8
	WHEN `_Name` LIKE '%-RCT.%' THEN 9
END ASC");

echo "
<center>
<table class='table table-striped'>
<h1>".$extra1." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($extra1unit))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";
	}
	else if ($enableextra2 == 1 && $id == $extra2){
	$extra2unit = mysql_query("SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$extra2."%'AND `_Faction` LIKE  'Metropolice Force' 
ORDER BY CASE
	WHEN `_Name` LIKE '%DvL%' THEN 1
	WHEN `_Name` LIKE '%EpU%' THEN 2
	WHEN `_Name` LIKE '%OfC%' THEN 3
	WHEN `_Name` LIKE '%".$prefixbefore."01".$prefixafter."%' THEN 4
	WHEN `_Name` LIKE '%".$prefixbefore."02".$prefixafter."%' THEN 5
	WHEN `_Name` LIKE '%".$prefixbefore."03".$prefixafter."%' THEN 6
	WHEN `_Name` LIKE '%".$prefixbefore."04".$prefixafter."%' THEN 7
	WHEN `_Name` LIKE '%".$prefixbefore."05".$prefixafter."%' THEN 8
	WHEN `_Name` LIKE '%-RCT.%' THEN 9
END ASC");

echo "
<center>
<table class='table table-striped'>
<h1>".$extra2." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while($row = @mysql_fetch_array($extra2unit))
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";
	}

}


	
	
	

?>
</div>

</body>
</html>
