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
    }

    if (isset($_SESSION['steamlogin'])) {
        $steam_login_verify = $_SESSION['steamlogin'] ;
    }
    else {
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

                <div class="col-md-8" style="border-left:1px solid #ccc;height:160px">
                    <?php
                    if(!empty($steam_login_verify)){
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
                        } else {
                            echo '<div class="alert alert-danger" role="alert">We were unable to find any Characters for your SteamID</div>';
                        }


                        print '<button class="btn btn-xs btn-primary btn-block" type="submit">Sign in</button>';
                    } else {
                        echo '<a href="'.$steam_sign_in_url.'"><img style="margin-top: 8px" src="http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_small.png" /></a>';
                        echo '<hr>';
                        echo "</p>Quick Login:<br>";
                        echo " <form action='index.php' method='post' >
                                <div class='form-group'>
                                    <input type='text' class='form-control input-sm' readonly id='steamid' name='steamid' value=''>
                                </div>
                                <button class='btn btn-xs btn-success btn-block' type='submit'>Quick login</button>
                               </form>
";
                    }

                    ?>
                </div>

            </div>

        </div>
    </div>

    <p><a href="https://github.com/trurascalz">About</a> &copy; Trurascalz</p>

</div>
</body>
</html>