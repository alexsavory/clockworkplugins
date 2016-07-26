<?php
include("include/configuration.php");
include("include/functions.php");
$action = $_GET["action"];

if ($action == "search"){
	echo '
<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->


<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: "Courier New", Courier, monospace; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: #ffffff !important;} .asteriskField{color: red;}</style>

<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="formden_header">
     <h2>
      '.$city.' Resident Database
     </h2>
     <p>
      Search current resident\'s in this city.
     </p>
    </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="citizenid">
       CitizenID
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="citizenid" name="citizenid" placeholder="#123456789" type="text"/>
      <span class="help-block" id="hint_citizenid">
       Search Citizen Database via Citizen ID Number.
      </span>
     </div>
     <div class="form-group">
      <div>
       <button onclick=SearchCitizenID(document.getElementById(\'citizenid\').value) class="btn btn-primary btn-lg btn-block" name="submit" type="submit">
        Submit
       </button>
      </div>
     </div>
    <hr>
     <div class="form-group ">
      <label class="control-label requiredField" for="citizenid">
       Citizen Name
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="citizenname" name="citizenname" placeholder="John Doe" type="text"/>
      <span class="help-block" id="hint_citizenname">
       Search Citizen Database via Citizen Name.
      </span>
     </div>
     <div class="form-group">
      <div>
       <button onclick=SearchCitizenName(document.getElementById(\'citizenname\').value) class="btn btn-primary btn-lg btn-block" name="submit" type="submit">
        Submit
       </button>
      </div>
     </div>
   </div>
  </div>
 </div>
</div>

	';
}

if($action == "searchcitizenid") {
	if(!isset($_GET["id"])){
		die("No Input");
	}
	$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
 
    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s", mysqli_connect_error());
        exit();
    }
    $citizenid = $mysqli->real_escape_string($_GET["id"]);
    $query = "SELECT * FROM  `characters` WHERE `_Data` LIKE  '%".$citizenid."%' AND  `_Faction` !=  'Metropolice Force' AND `_Faction` = 'Citizen'";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
    echo '
    <table class="table table-striped">
<h1>Results</h1>
<th>Citizen ID</th>
<th>Name</th>
<th>Gender</th>
<th>SteamID (OOC)</th>

</tr>
';
	if($result){
		while($row = $result->fetch_assoc()){
			$citizenid = extract_text($row["_Data"], '"citizenid":"', '",');
  			echo "<tr>";
  			echo "<td>".$citizenid."</td>";
  			echo "<td>" . $row['_Name'] . "</td>";
    		echo "<td>" . $row['_Gender'] . "</td>";
    		echo "<td>" . $row['_SteamID'] . "</td>";
  			echo "</tr>";

	    }
	    
	} else {
		echo "No results!";
	}
	echo "</table>";
}

if($action == "searchcitizenname") {
	if(!isset($_GET["name"])){
		die("No Input");
	}
	$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
 
    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s", mysqli_connect_error());
        exit();
    }
    $citizenid = $mysqli->real_escape_string($_GET["id"]);
    $query = "SELECT * FROM  `characters` WHERE `_Name` LIKE  '%".$citizenid."%' AND  `_Faction` !=  'Metropolice Force' AND `_Faction` = 'Citizen'";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
    echo '
    <table class="table table-striped">
<h1>Results</h1>
<th>Citizen ID</th>
<th>Name</th>
<th>Gender</th>
<th>SteamID (OOC)</th>

</tr>
';
	if($result){
		while($row = $result->fetch_assoc()){
  			$citizenid = extract_text($row["_Data"], '"citizenid":"', '",');
  			echo "<tr>";
  			echo "<td>".$citizenid."</td>";
  			echo "<td>" . $row['_Name'] . "</td>";
    		echo "<td>" . $row['_Gender'] . "</td>";
    		echo "<td>" . $row['_SteamID'] . "</td>";
  			echo "</tr>";

	    }
	    
	} else {
		echo "No results!";
	}
	echo "</table>";
}

if ($action == "leaders"){
	$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
 
    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s", mysqli_connect_error());
        exit();
    }
    $query = "SELECT * FROM  `characters` WHERE `_Faction` LIKE  'Metropolice Force' AND (`_Name` LIKE '%SeC%' or `_Name` LIKE '%CmD%' or `_Name` LIKE '%DvL%' or `_Name` LIKE '%EpU%' or `_Name` LIKE '%OfC%')
ORDER BY CASE
	WHEN `_Name` LIKE '%SeC%' THEN 1
	WHEN `_Name` LIKE '%CmD%' THEN 2
	WHEN `_Name` LIKE '%DvL%' THEN 3
	WHEN `_Name` LIKE '%EpU%' THEN 4
	WHEN `_Name` LIKE '%OfC%' THEN 5
	END ASC";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
    echo '
    <table class="table table-striped">
<h1>Results</h1>
<th>Name</th>
<th>Gender</th>
<th>SteamID (OOC)</th>

</tr>
';
	if($result){
		while($row = $result->fetch_assoc()){
  			echo "<tr>";
  			echo "<td>" . $row['_Name'] . "</td>";
    		echo "<td>" . $row['_Gender'] . "</td>";
    		echo "<td>" . $row['_SteamID'] . "</td>";
  			echo "</tr>";

	    }
	    
	} else {
		echo "No results!";
	}
	echo "</table>";
}
if ($action == "cityadmin"){
		$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
 
    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s", mysqli_connect_error());
        exit();
    }
    $query = "SELECT * FROM  `characters` WHERE `_Faction` LIKE  'Administrator' ";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
    echo '
    <table class="table table-striped">
<h1>Results</h1>
<th>Name</th>
<th>Gender</th>
<th>SteamID (OOC)</th>

</tr>
';
	if($result){
		while($row = $result->fetch_assoc()){
  			echo "<tr>";
  			echo "<td>" . $row['_Name'] . "</td>";
    		echo "<td>" . $row['_Gender'] . "</td>";
    		echo "<td>" . $row['_SteamID'] . "</td>";
  			echo "</tr>";

	    }
	    
	} else {
		echo "No results!";
	}
	echo "</table>";
}


?>