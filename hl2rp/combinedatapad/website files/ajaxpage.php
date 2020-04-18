<?php
session_start();
include("include/configuration.php");
include("include/functions.php");
$action = $_GET["action"];

if(isset($_POST["action"])){
    $action = $_POST["action"];
} else 


if(!isset($action)){
    die("No Input.");
}

if (!isset($_SESSION['unitid'])) {
    header("Location:index.php?nounit");
}
if (!isset($_SESSION['steamlogin'])) {
    header("Location:index.php?nosteam");
}

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

if($action == "searchcitizenid" or $action == "searchcitizenname") {

	if(isset($_GET["id"])){
	    $citizenid = $_GET["id"];
	    $search = "id";
	}elseif(isset($_GET["name"])){
	    $citizenid = $_GET["name"];
	    $search = "name";
	} else {
	    die("No Search Query.");
	}
	
	
	
	$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
 
    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s", mysqli_connect_error());
        exit();
    }
    $citizenid = $mysqli->real_escape_string($citizenid);
    
    if($search == "id"){
            $query = "SELECT * FROM  `characters` WHERE `_Data` LIKE  '%".$citizenid."%' AND  `_Faction` !=  'Metropolice Force' AND `_Faction` = 'Citizen'";

    }elseif($search == "name"){
            $query = "SELECT * FROM  `characters` WHERE `_Name` LIKE  '%".$citizenid."%' AND  `_Faction` !=  'Metropolice Force' AND `_Faction` = 'Citizen'";
    }
    
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
    
    echo '
    <table class="table table-striped" style="max-width:1100px">
<h1>Results</h1>
<th>Data</th>
<th>Citizen ID</th>
<th>Name</th>
<th>Gender</th>
<th>SteamID (OOC)</th>

</tr>
';


	if($result){
		while($row = $result->fetch_assoc()){
			$citizenid = extract_text($row["_Data"], '"citizenid":"', '",');
			$key = $row["_Key"];
			
			if($enablecombinedata == true){
			    if (strpos($row["_Data"], 'combinedata') !== false) {
			        $combinedata = extract_text($row["_Data"], 'combinedata":"', '","');
			        $combinedata = stripcslashes($combinedata);
                    $combinedata = nl2br($combinedata);
                } else {
                    $combinedata = "No Data";
                }
			} else {
			    $combinedata = "Unable to fetch Citizen's profile data. <i>Please see in-game /viewdata</i>";
			}
            
           
           
           


            
  			echo "<tr>";
  			if($enablecombinedata == true){
  			   if($citizenid != ""){
  			       echo '<td><button onclick=Edit('.$key.') class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></td>';
  			   } else {
  			       echo '<td></td>';
  			   }
  			    
  			
  			} else {
  			    echo '<td><button data-toggle="collapse" data-target="#accordion'.$row["_Key"].'" class="btn btn-xs btn-default" type="submit"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></button></td>';
  			
  			}
  			echo "<td>".$citizenid."</td>";
  			echo "<td>" . $row['_Name'] . "</td>";
    		echo "<td>" . $row['_Gender'] . "</td>";
    		echo "<td>" . $row['_SteamID'] . "</td>";
  			echo "</tr>";
  			
  			
  			if($enablecombinedata == true){
  			} else {
  			    echo '<tr>';
  			echo '<td colspan="5">';
  			    echo '<div id="accordion'.$row["_Key"].'" class="collapse">';
      			    echo '<div class="container">';
          			    echo '<div class="row">';
          			    echo '<div class="alert alert-info">'.$combinedata.'</div>';
          			                      		echo '</div>';
                    echo '</div>';
                    echo '</div>';
                        echo '</td>';
    echo '</tr>';
  			}
  			    
  			


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


if($action == "editcitizen") {
	if(!isset($_GET["id"])){
		die("No Input");
	}
	$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
 
    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s", mysqli_connect_error());
        exit();
    }
    $key = $mysqli->real_escape_string($_GET["id"]);
    $query = "SELECT * FROM  `characters` WHERE `_Key` =  '$key' AND  `_Faction` !=  'Metropolice Force' AND `_Faction` = 'Citizen'";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
	if($result){
		while($row = $result->fetch_assoc()){
		    $pkey = $row["_Key"];
  			$citizenid = extract_text($row["_Data"], '"citizenid":"', '",');
  			$name = $row["_Name"];
  			$sex = $row["_Gender"];
  			$data = $row["_Data"];
	    }
$array = json_decode($data, true);


//$combinedata = stripcslashes($combinedata);
                    //$combinedata = nl2br(strip_tags($combinedata));

if(!array_key_exists("combinedata",$array)){
    $nodata = true;
} else {
    $nodata = false;
    $combinedata = $array["combinedata"];
}
if(!array_key_exists("combinepoints",$array)){
    $nopoints = true;
} else {
    $nopoints = false;
}
    echo '<div class="container">';
        echo '<div class="row">';
            echo '<div class="col-md-5">';
                echo '<div class="panel panel-primary">';
                    echo '<div class="panel-heading">';
                        echo '<h3 class="panel-title">Citizen: <code>'.$name.'</code>  <div class="pull-right">ID: <code>'.$citizenid.'</code></div></h3>';
                    echo '</div>';
                    echo '<div class="panel-body">';
                        if($nodata == true){
                            echo "<pre>";
                            echo "No Citizen Data Available";
                            echo '</pre>';
                        } else {
                            if($enableedit == true){
                                echo '<form id="CharData">';
                                echo '<textarea id="data" name="data" style="resize:vertical;" class="form-control">';
                                echo $combinedata;
                                echo '</textarea>';
                                echo '<hr>';
                                echo '<input type="hidden" id="action" name="action" value="updatedata">';
                                echo '<input type="hidden" id="pkey" name="pkey" value="'.$pkey.'">';
                                echo '<button type="submit" onclick="UpdateData()" class="btn btn-block btn-primary">Update</button>';
                                echo '</form>';
                            } else {
                                echo '<form>';
                                echo '<textarea id="data" name="data" style="resize:vertical;" disabled class="form-control">';
                                echo $combinedata;
                                echo '</textarea>';
                               
                                echo '</form>';                                
                            }
                            
                        }
                        echo "</pre>";
                    echo '</div>';
                echo '</div>';
            echo '</div>'; //col
            echo '<div class="col-md-6">';
                echo '<div class="panel panel-warning">';
                  	echo '<div class="panel-heading">';
                  		echo '<h3 class="panel-title text-center"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Loyalty/Penalty Points</h3>';
                    echo '</div>';
                    echo '<div class="panel-body">';
                    if($enablebetterviewdata == true){
                        if($nopoints == true){
                                echo "No Citizen Data Available";
                            } else {
                                echo '<ul class="list-group">';
                                    if($enableedit == true){
                                        echo '<li class="list-group-item list-group-item-info">';
                                        echo '<form id="addpoint" class="form-horizontal">';
                                        echo '<div class="form-group">';
                                        echo '<label for="reason">Reason</label>';
                                        echo '<input type="text" class="form-control" name="reason" id="reason" placeholder="Rebel Information">';
                                        echo '</div>';
                                        echo '<div class="form-group">';
                                        echo '<label for="points">Points</label>';
                                        echo '<input type="text" class="form-control" name="points" id="points" placeholder="eg. 4 or -2">';
                                        echo '</div>';
                                        echo '<button type="submit" onclick="AddPoint()" class="btn btn-block btn-default">Add Point</button>';
                                        echo '<input type="hidden" id="action" name="action" value="addpoint">';
                                        echo '<input type="hidden" id="pkey" name="pkey" value="'.$pkey.'">';
                                        echo '</form>';
                                        echo '</li>';
                                    }

                                    
                                    foreach($array["combinepoints"] as $key =>$element){
                                    if ($element["loy"] == 1) {
                                        $badge = "badge-success";
                                        $val = "+ ";
                                    } else {
                                        $badge = "badge-error";
                                        $val = "- ";
                                    }
                                    echo '<li class="list-group-item">';
                                        echo '<span class="badge '.$badge.'">'.$val.$element["num"].'</span>';
                                        echo $element["rsn"];
                                        echo '<hr> Added by: <code>'.$element["usr"].'</code>';
                                        if($enableedit == true){
                                            echo '<div class="pull-right"><button type="button" onclick="DeletePoint('.$pkey.','.$key.')"class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button></div>';
                                        }
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }
                    } else {
                        echo '<div class="alert alert-info"> This section is only visible if the Better Viewdata Plugin is installed.<br> See <a href="https://github.com/JakeDaBoss/Clockwork-Plugins">https://github.com/JakeDaBoss/Clockwork-Plugins</a></div>';
                    }

                    
                    echo '</div>';
                echo '</div>';
            echo '</div>'; //col
        echo '</div>'; //row
    echo '</div>'; //container

	} else {
		echo "No results!";
	}

}

if($action == "deletepoint"){
    if(!isset($_GET["pid"])){
		die("No Input");
	}
	if(!isset($_GET["cid"])){
		die("No Input");
	}
	$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
 
    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s", mysqli_connect_error());
        exit();
    }
    $key = $mysqli->real_escape_string($_GET["cid"]);
    $query = "SELECT * FROM  `characters` WHERE `_Key` =  '$key' AND  `_Faction` !=  'Metropolice Force' AND `_Faction` = 'Citizen'";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
	if($result){
		while($row = $result->fetch_assoc()){
  			$citizenid = extract_text($row["_Data"], '"citizenid":"', '",');
  			$name = $row["_Name"];
  			$sex = $row["_Gender"];
  			$data = $row["_Data"];
	    }
$array = json_decode($data, true);

if(!array_key_exists("combinedata",$array)){
    $nodata = true;
} else {
    $nodata = false;
}
if(!array_key_exists("combinepoints",$array)){
    $nopoints = true;
} else {
    $nopoints = false;
}
    echo '<div class="container">';
        echo '<div class="row">';
            $pid = $_GET["pid"];
            unset($array["combinepoints"][$pid]);
            $newentry = json_encode($array);
            $newentry = $mysqli->real_escape_string($newentry);
            $update = "UPDATE `characters` SET `_Data` = '$newentry' WHERE `_Key` =  '$key' AND  `_Faction` !=  'Metropolice Force' AND `_Faction` = 'Citizen'";
            $result = $mysqli->query($update) or die($mysqli->error . __LINE__);


            echo '<script type="text/javascript">Edit('.$key.')</script>';
        echo '</div>'; //row
    echo '</div>'; //container

	} else {
		echo "No results!";
	}
 
}

if($action == "addpoint"){
    if(!isset($_GET["reason"])){
		die("No Input");
	}
	if(!isset($_GET["points"])){
		die("No Input");
	} 
		if(!isset($_GET["pkey"])){
		die("No Input");
	} 
	
	$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
 
    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s", mysqli_connect_error());
        exit();
    }
    $key = $mysqli->real_escape_string($_GET["pkey"]);
    $reason = html_entity_decode($_GET["reason"]);
    $reason = $mysqli->real_escape_string($reason);
    $points = $mysqli->real_escape_string($_GET["points"]);
         
       
            
    $query = "SELECT * FROM  `characters` WHERE `_Key` =  '$key' AND  `_Faction` !=  'Metropolice Force' AND `_Faction` = 'Citizen'";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
	if($result){
		while($row = $result->fetch_assoc()){

  			$data = $row["_Data"];
	    }
$array = json_decode($data, true);

if(!array_key_exists("combinedata",$array)){
    $nodata = true;
} else {
    $nodata = false;
}
if(!array_key_exists("combinepoints",$array)){
    $nopoints = true;
} else {
    $nopoints = false;
}

if(strpos($points, "-") !== false){
    $points = ltrim($points, '-');
    $newdata =  array (
          'rsn' => $reason,
          'num' => $points,
          'usr' => 'test',
          'loy' => false
        ); 
} else{
    $points = ltrim($points, '+');
   $newdata =  array (
          'rsn' => $reason,
          'num' => $points,
          'usr' => 'test',
          'loy' => true
        );  
}


        
        
    echo '<div class="container">';
        echo '<div class="row">';
            array_push($array["combinepoints"],$newdata);
            
            $newentry = json_encode($array);
            $newentry = $mysqli->real_escape_string($newentry);
            $update = "UPDATE `characters` SET `_Data` = '$newentry' WHERE `_Key` =  '$key' AND  `_Faction` !=  'Metropolice Force' AND `_Faction` = 'Citizen'";
            $result = $mysqli->query($update) or die($mysqli->error . __LINE__);


            echo '<script type="text/javascript">Edit('.$key.')</script>';
        echo '</div>'; //row
    echo '</div>'; //container

	} else {
		echo "No results!";
	}
 
}


if($action == "updatedata"){
    if(!isset($_GET["data"])){
		die("No Input");
	}
		if(!isset($_GET["pkey"])){
		die("No Input");
	} 
	
	$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
 
    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s", mysqli_connect_error());
        exit();
    }
    $key = $mysqli->real_escape_string($_GET["pkey"]);
    //$ndata = html_entity_decode($_GET["data"]);
        $ndata = $_GET["data"];

    //$ndata = $mysqli->real_escape_string($ndata);
            
    $query = "SELECT * FROM  `characters` WHERE `_Key` =  '$key' AND  `_Faction` !=  'Metropolice Force' AND `_Faction` = 'Citizen'";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
	if($result){
		while($row = $result->fetch_assoc()){

  			$data = $row["_Data"];
	    }
$array = json_decode($data, true);



    echo '<div class="container">';
        echo '<div class="row">';
            
            $array['combinedata'] = $ndata;
            
            $newentry = json_encode($array);
            $newentry = $mysqli->real_escape_string($newentry);
            $update = "UPDATE `characters` SET `_Data` = '$newentry' WHERE `_Key` =  '$key' AND  `_Faction` !=  'Metropolice Force' AND `_Faction` = 'Citizen'";
            $result = $mysqli->query($update) or die($mysqli->error . __LINE__);


            echo '<script type="text/javascript">Edit('.$key.')</script>';
        echo '</div>'; //row
    echo '</div>'; //container

	} else {
		echo "No results!";
	}
 
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

?>