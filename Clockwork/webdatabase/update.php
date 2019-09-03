<?php include("header.php"); 
    if(!isset($_SESSION['steamid'])) {
    echo '<meta http-equiv="refresh" content="0;url=index.php?e=session">';
    exit();
    } 
    if (issuperadmin($_SESSION['steamid']) == "0"){
echo '<meta http-equiv="refresh" content="0;url=index.php?e=admin">';
              } 

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);
   
         if(mysqli_connect_errno()){
          echo '
          
            We are having trouble connecting. Please Contact the Administrator:
           '.mysqli_connect_error().'


          ';

            die();
         }
    $key = mysqli_escape_string($conn,$_POST["key"]);
    $action = mysqli_escape_string($conn,$_POST["action"]);

    if ($_POST['action'] == "charupdate") {
      
      $name = mysqli_escape_string($conn,$_POST['name']);
      $cash = mysqli_escape_string($conn,$_POST['cash']);
      $faction = mysqli_escape_string($conn,$_POST['Faction']);
      $flags = mysqli_escape_string($conn,$_POST['Flags']);
      $model = htmlspecialchars($_POST['Model']);
      $sql = 
      "UPDATE  `characters` SET  
      `_Name` =  '$name',
      `_Cash` =  '$cash',
      `_Model` =  '$model',
      `_Flags` =  '$flags',
      `_Faction` =  '$faction' 
      WHERE  `_Key` = $key";
      
      $charresult = mysqli_query($conn, $sql);
      echo '<meta http-equiv="refresh" content="0;url=index.php?m=Success_Edit_Char">';
    } elseif($_POST["action"] == "playerupdate"){

      $rank = mysqli_escape_string($conn,$_POST['Rank']);
      $data = mysqli_escape_string($conn,$_POST['Data']);
      $sql = 
      "UPDATE  `players` SET  
      `_UserGroup` =  '$rank',
      `_Data` =  '$data'
      WHERE `_Key` = $key";
     
      $charresult = mysqli_query($conn, $sql);
      echo '<meta http-equiv="refresh" content="0;url=index.php?m=Success_Edit_Ply">';
    } elseif($_POST["action"] == "banupdate"){

      $unbandate = mysqli_escape_string($conn,$_POST['Unban']);
      $reason = mysqli_escape_string($conn,$_POST['Reason']);
      $unban_converted = strtotime($unbandate);
      if($unbandate == "0"){
        $unban_converted = "0";
      }
      if (((strtotime($unbandate)) === false) && ($unbandate != "0")) {
      echo '<meta http-equiv="refresh" content="0;url=index.php?m=Ban_Badtime">';
      }
      $reason = $reason." [This Ban Has been modified by ".steamid64convert($_SESSION["steamid"])."]";
      $sql = 
      "UPDATE  `bans` SET  
      `_Reason` =  '$reason',
      `_UnbanTime` =  '$unban_converted'
      WHERE `_Key` = $key";
     
       $charresult = mysqli_query($conn, $sql);
      echo '<meta http-equiv="refresh" content="0;url=index.php?m=Success_Ban_Edit">';
    }elseif($_POST["action"] == "bandelete"){

      $sql = 
      "DELETE * FROM `bans` WHERE `_Key` = '$key'";
    
      $charresult = mysqli_query($conn, $sql);
      echo '<meta http-equiv="refresh" content="0;url=index.php?m=Success_Ban_Delete">';
    }


    ?>