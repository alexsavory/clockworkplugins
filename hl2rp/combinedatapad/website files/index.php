<?php
session_start();

require('include/functions.php');
require('include/configuration.php');

// Login Controls

if(isset($_GET["logout"])){
    unset($_SESSION);
    session_destroy();
}

if(isset($_GET["login"])) {
    if (!isset($_SESSION['unitid'])) {
        $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        $unitkey = $mysqli->real_escape_string($_POST["unit"]);

        $query = ("SELECT * FROM characters WHERE (_Faction = 'Metropolice Force' OR _Faction = 'Overwatch Transhuman Arm') AND _Key =  '" . $unitkey . "' AND _SteamID = '".$_SESSION["steamname"]."' ");
        $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
        while ($data = $result->fetch_assoc()) {
            $_SESSION['unitid'] = $data['_Key'];
            $_SESSION['unitname'] = $data['_Name'];
        }
        header("Location: dash.php");
    } else {
        header("Location: dash.php?msg=already_logged_in");
    }
}


?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="trurascalz">


    <title>Sign-in</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/login_page.css" rel="stylesheet">
    <?php

    // Quick Login

    if (!empty($_POST['steamid'])) {
        $_SESSION['steamlogin'] = $_POST['steamid'];
        
        if(empty($_POST["unitcheck"])){
            echo ' <meta http-equiv="refresh" content="0;url=?quickloginunit">';
        }
        $unitcheck = $_POST["unitcheck"];
    }
echo "bb";
    if (isset($_SESSION['steamlogin'])) {
        $steam_login_verify = $_SESSION['steamlogin'] ;
    }else {
        $steam_login_verify = SteamSignIn::validate();
    }

    if(!empty($steam_login_verify)) {
        $_SESSION['steamlogin'] = $steam_login_verify;
        $_SESSION['steamname'] = steamid64convert($steam_login_verify);

        // Start MYSQL Connection
        $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        // Get Players Characters
        $query = ("SELECT DISTINCT _Name,_Key FROM characters WHERE _SteamID =  '".$_SESSION["steamname"]."' AND (_Faction = 'Metropolice Force' OR _Faction = 'Overwatch Transhuman Arm')");
        $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
        
        // Challange QuickLogin
        if (isset($unitcheck)){
            $query2 = ("SELECT * FROM combinelogins WHERE steamid =  '".$_SESSION["steamname"]."' AND  pin LIKE  '".$unitcheck."'; ");
            $result2 = $mysqli->query($query2) or die($mysqli->error . __LINE__);
            if ($result2->num_rows == 1) {
                            } elseif($result2->num_rows == 0) {
                                            $invalidunit = 1;
                            }
                            
                           
        }
    } else {
        
        $steam_sign_in_url = SteamSignIn::genUrl();
    }
    ?>
    <link href='http://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
</head>

<body>
<div class="middlePage">
    <div class="page-header">
        <h2 class="logo"><?php echo $app_title;?> <br><small style="color:white;"><i><?php echo $app_slogan;?></i></small></h2><b><div class="pull-right bg-danger" style="font-family: Courier New, Courier, monospace;"> &nbsp; Server: <?php echo $city;?> &nbsp; </div></b>
    </div>
    <?php
    if(isset($_GET["nosteam"])){
        $barcolour = "panel-danger";
        $bartext = "<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> We was unable to authenticate you via Steam! Please log back in.";
    } elseif (isset($_GET["nounit"])) {
        $barcolour = "panel-warning";
        $bartext = "<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> We was unable to authenticate your unit! Please log back in";
    } elseif (isset($_GET["quickloginunit"])) {
        $barcolour = "panel-warning";
        $bartext = "<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> We was unable to authenticate your unit! Please login with steam.";
    } else {
        $barcolour = "panel-info";
        $bartext = "<span class='glyphicon glyphicon-question-sign' aria-hidden='true'></span> Please confirm your Identity.";
    }

    ?>
    <div class="panel <?php echo $barcolour;?>">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $bartext; if(!empty($steam_login_verify)){ echo '<a href="?logout=true" class="btn btn-xs btn-warning pull-right">Logout Of Steam</a></form>';}?></h3>
        </div>
        <div class="panel-body" style="height:auto">

            <div class="row">

                <div class="col-md-4" >
                    <img src="images/combine_logo.png" height="160px" width="170px" />
                </div>

                <div class="col-md-8" style="border-left:1px solid #ccc">
                    <?php
                    if(!empty($steam_login_verify)){
                        
                        if(isset($invalidunit)){
                            echo '<div class="alert alert-danger" role="alert">We could not validate you. Is this your first time? You need to sign in with Steam to set a passcode.</div>';
                            echo '<a href="?logout=true&quickloginunit" class="btn btn-xs btn-warning pull-right">Try Again</a>';
                            die();
                        }
                        
                        echo '

                        <form action="?login=true" method="post">


                        ';
                        //Get a row
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="unit" id="unit" value="'.$row['_Key'].'">
                                        '.$row["_Name"].'
                                    </label>
                                </div>';
                            }
                            print '<button class="btn btn-xs btn-primary btn-block" type="submit">Sign in</button>';
                            echo "</form>";
                        } else {
                            echo '<div class="alert alert-danger" role="alert">We were unable to find any Characters for your SteamID</div>';
                        }

                    echo "<hr>";
                    if(isset($_POST["passcodeupdate"])){
                        $passcode = $_POST["passcodeupdate"];
                        $passcode = $mysqli->real_escape_string($passcode);
                        
                        if(!is_numeric($passcode)){
                            echo '<div class="alert alert-danger" role="alert">Your passcode: <code>'.$passcode.'</code> must be a number</div>';
                        } else {
                            $updatepass = ("UPDATE `combinelogins` SET `pin` = '$passcode', `updated` = NOW() WHERE `combinelogins`.`steamid` = '".$_SESSION["steamname"]."'");
                  
                       $passresult = $mysqli->query($updatepass) or die($mysqli->error . __LINE__);
                        
                        echo '<div class="alert alert-success" role="alert">Your passcode has been updated to: <code>'.$passcode.'</code></div>';
                        }
                        
                        
                        
                    }
                    $findcode = ("SELECT * FROM `combinelogins` WHERE `combinelogins`.`steamid` = '".$_SESSION["steamname"]."'");
                    $coderesult = $mysqli->query($findcode) or die($mysqli->error . __LINE__);
                    if ($coderesult->num_rows == 1) {
                            while ($row = $coderesult->fetch_assoc()) {
                                $code = $row["pin"];
                                $date = $row["updated"];
                            }
                    }
                    
                    
                    echo '
                    <form action="index.php" method="post" class="form">

                            
                            <div class="form-group">
                            <span class="label label-info">Passcode:</span>
                            
                                <input type="password" class="form-control" id="passcodeupdate" name="passcodeupdate" minlength="4" required ';
                                if(isset($code)){
                                    echo "value='$code'";
                                }
                                
                                echo'>
                            </div>
                            
                            <div class="row">
                            
                            <div class="col-md-6"><button type="submit" class="btn btn-block btn-success">Update Passcode</button> </div><div class="col-md-6"><button id="Toggle" type="button" onclick="TogglePass()" class="btn btn-block btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Show</button></div>

                            </div></form>
                            
                    
                    ';

                        
                    } else {
                        echo '<a href="'.$steam_sign_in_url.'"><img style="margin-top: 8px" src="http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_small.png" /></a>';
                        echo '<hr>';
                        if (!isset($_GET["quickloginunit"])){
                                                    echo '
                        <div class="well">
                            
                            <form action="index.php" method="post" class="form">

                            <div class="form-group">
                            <span class="label label-info">Steam ID:</span>
                                <input type="text" class="form-control" id="steamid" name="steamid" readonly required>
                            </div>
                            <div class="form-group">
                            <span class="label label-info">Passcode:</span>
                                <input type="number" class="form-control" id="unitcheck" name="unitcheck" minlength="4" required>
                            </div>
                            <div class="row">
                            <div class="col-md-6"><button type="submit" class="btn btn-block btn-success">Quick Login</button> </div>
                            <div class="col-md-6"><b>You must sign in with Steam first to use this login.</b></div>
                            </div>
                            
                            
                        </form>
                        </div>
                        
                        
                        ';
                        }

                        
                    }

                    ?>
                </div>

            </div>

        </div>
    </div>

    <p><a href="https://github.com/trurascalz">About</a> &copy; Trurascalz</p>

</div>

<script>
    function TogglePass() {
  var x = document.getElementById("passcodeupdate");
  if (x.type === "password") {
    x.type = "text";
    document.getElementById("Toggle").innerHTML = '<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span> Hide';
  } else {
    x.type = "password";
    document.getElementById("Toggle").innerHTML = '<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Show';
  }
}
</script>
</body>
</html>
