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
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
if (!isset($_GET['id'])){header("Location: ?id=all");}

if (isset($_GET['id'])) {
$id = $_GET['id']; 
if ($id == "all"){

	$generalunit = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$general."%'AND `_Faction` LIKE  'Metropolice Force' 
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
END ASC";
	$generalresults = $mysqli->query($generalunit) or die($mysqli->error . __LINE__);
$courtunit = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$court."%' AND `_Faction` LIKE  'Metropolice Force'
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
END ASC";
$courtresults = $mysqli->query($courtunit) or die($mysqli->error . __LINE__);
$medicunit = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$medic."%' AND `_Faction` LIKE  'Metropolice Force'
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
END ASC";
$medicresults = $mysqli->query($medicunit) or die($mysqli->error . __LINE__);
$engineerunit = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$engineer."%' AND `_Faction` LIKE  'Metropolice Force'
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
END ASC";
$engineerresults = $mysqli->query($engineerunit) or die($mysqli->error . __LINE__);
/// Specific Ranks
$sec = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%SeC%' AND `_Faction` LIKE  'Metropolice Force'";
if ($cmdenable == "1") {$cmd = "SELECT * FROM  `characters` WHERE `_Name` LIKE '%".$cmdname."%' AND `_Faction` LIKE  'Metropolice Force'";}
$dvl = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%DvL%' AND `_Faction` LIKE  'Metropolice Force'";
$epu = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%EpU%' AND `_Faction` LIKE  'Metropolice Force'";
$ofc = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%OfC%' AND `_Faction` LIKE  'Metropolice Force'";
$scn = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%SCN%' AND `_Faction` LIKE  'Metropolice Force'";
$rct = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%RCT%' AND `_Faction` LIKE  'Metropolice Force'";

$secres = $mysqli->query($sec) or die($mysqli->error . __LINE__);
if ($cmdenable == "1") {$cmdres = $mysqli->query($cmd) or die($mysqli->error . __LINE__);}
$dvlres = $mysqli->query($dvl) or die($mysqli->error . __LINE__);
$epures = $mysqli->query($epu) or die($mysqli->error . __LINE__);
$ofcres = $mysqli->query($ofc) or die($mysqli->error . __LINE__);
$scnres = $mysqli->query($scn) or die($mysqli->error . __LINE__);
$rctres = $mysqli->query($rct) or die($mysqli->error . __LINE__);


echo "
<center>
<table class='table table-striped'>
<h1>Sectional Leader</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while ($row = $secres->fetch_assoc()) {
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

while ($row = $cmdres->fetch_assoc()) {

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

while ($row = $dvlres->fetch_assoc()) {
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

while ($row = $epures->fetch_assoc())
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

while ($row = $ofcres->fetch_assoc())
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

while ($row = $ofcres->fetch_assoc())
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

while ($row = $courtresults->fetch_assoc())
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

while ($row = $medicresults->fetch_assoc())
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

while ($row = $engineerresults->fetch_assoc())
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

while ($row = $scnres->fetch_assoc())
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

while ($row = $rctres->fetch_assoc())
{
$steam = $row['_SteamID'];
$parsed = SteamID2CommunityID($steam);

  echo "<tr>";
  echo "<td>" . $row['_Name'] . "</td>";
  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>" . $row['_SteamName'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";


	} else if ($id == $general){
		$generalunit = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$general."%'AND `_Faction` LIKE  'Metropolice Force' 
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
END ASC";
	$generalresults = $mysqli->query($generalunit) or die($mysqli->error . __LINE__);

echo "
<center>
<table class='table table-striped'>
<h1>".$general." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while ($row = $generalresults->fetch_assoc())
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
	$courtunit = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$court."%' AND `_Faction` LIKE  'Metropolice Force'
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
END ASC";
$courtresults = $mysqli->query($courtunit) or die($mysqli->error . __LINE__);

echo "
<center>
<table class='table table-striped'>
<h1>".$court." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";


while ($row = $courtresults->fetch_assoc())
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
	$medicunit = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$medic."%' AND `_Faction` LIKE  'Metropolice Force'
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
END ASC";
$medicresults = $mysqli->query($medicunit) or die($mysqli->error . __LINE__);

echo "
<center>
<table class='table table-striped'>
<h1>".$medic." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while ($row = $medicresults->fetch_assoc())
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
	$engineerunit = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$engineer."%' AND `_Faction` LIKE  'Metropolice Force'
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
END ASC";
$engineerresults = $mysqli->query($engineerunit) or die($mysqli->error . __LINE__);

echo "
<center>
<table class='table table-striped'>
<h1>".$engineer." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while ($row = $engineerresults->fetch_assoc())
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
$scn = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%SCN%' AND `_Faction` LIKE  'Metropolice Force'";
$secres = $mysqli->query($scn) or die("MySQL ERROR:".$mysqli->error . __LINE__);


echo "
<center>
<table class='table table-striped'>
<h1>".$scanner." Units</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while ($row = $scnres->fetch_assoc())
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
	$rct = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%RCT%' AND `_Faction` LIKE  'Metropolice Force'";
$rctres = $mysqli->query($rct) or die($mysqli->error . __LINE__);


echo "
<center>
<table class='table table-striped'>
<h1>".$recruit." Units</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";


while ($row = $rctres->fetch_assoc())
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
	$extra1unit = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$extra1."%'AND `_Faction` LIKE  'Metropolice Force' 
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
END ASC";
$extra1res = $mysqli->query($extra1unit) or die($mysqli->error . __LINE__);
echo "
<center>
<table class='table table-striped'>
<h1>".$extra1." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while ($row = $extra1res->fetch_assoc())
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
	$extra2unit = "SELECT * FROM  ".$characters." WHERE `_Name` LIKE '%".$extra2."%'AND `_Faction` LIKE  'Metropolice Force' 
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
END ASC";
$extra2res = $mysqli->query($extra2unit) or die($mysqli->error . __LINE__);
echo "
<center>
<table class='table table-striped'>
<h1>".$extra2." Force</h1>
<tr>
<th>Unit</th>
<th>Steam Name</th>
</tr>
</center>";

while ($row = $extra2res->fetch_assoc())
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
