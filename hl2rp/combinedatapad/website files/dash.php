<?php
session_start();
/**
 * Project: combinedatapad
 * File: dash.php
 * Created by PhpStorm.
 * User: Alex
 * Created: 06/08/2015 07:25 PM
 * This remains property of Alex Savory
 */

if (!isset($_SESSION['unitid'])) {
    header("Location:index.php?nounit");
}
if (!isset($_SESSION['steamlogin'])) {
    header("Location:index.php?nosteam");
}
require('include/functions.php');
require('include/configuration.php');

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// Get Total Reports
$totalopenreports = ("SELECT COUNT(*) as total FROM combinereports WHERE `reviewed` = 'no'");
$totalopenresults = $mysqli->query($totalopenreports) or die($mysqli->error . __LINE__);
while ($data = $totalopenresults->fetch_assoc()) {
            $totalopen = $data["total"];
        }
$totalclosedreports = ("SELECT COUNT(*) as total FROM combinereports WHERE `reviewed` = 'reviewed'");
$totalclosedresults = $mysqli->query($totalclosedreports) or die($mysqli->error . __LINE__);
while ($data = $totalclosedresults->fetch_assoc()) {
            $totalclosed = $data["total"];
        }
$totalcitizencount = ("SELECT COUNT(*) as total FROM characters WHERE `_Faction` = 'Citizen'");
$totalcitizenresults = $mysqli->query($totalcitizencount) or die($mysqli->error . __LINE__);
while ($data = $totalcitizenresults->fetch_assoc()) {
            $totalcitzien = $data["total"];
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        body {
            background: -webkit-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Chrome 10+, Saf5.1+ */
            background:    -moz-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* FF3.6+ */
            background:     -ms-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* IE10 */
            background:      -o-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Opera 11.10+ */
            background:         linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* W3C */
            font-family: 'Raleway', sans-serif;
        }
        body {
            padding-top: 20px;
            padding-bottom: 20px;
        }

    </style>

</head>

<body>

<div class="container">

    <!-- Static navbar -->
    <?php
    include("header.php");
    ?>

    <!-- Main component for a primary marketing message or call to action -->
    <div class="row">
        <?php
        if(isset($_GET["msg"])){
            $msg = $_GET["msg"];
            echo '<div class="alert alert-info"><b>';
            switch ($msg){
                case "already_logged_in":
                    echo 'Your already logged in! To switch user please logout first!';
                    break;
            }
            echo '</b></div>';
        }
        ?>
        <div class="col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><b>Open Reports</b></h3>
                </div>
                <div class="panel-body">
                    <h1 class="text-center"><?php echo $totalopen;?></h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><b>Closed/Replied Reports</b></h3>
                </div>
                <div class="panel-body">
                    <h1 class="text-center"><?php echo $totalclosed;?></h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><b>Registered Citizen Count</b></h3>
                </div>
                <div class="panel-body">
                    <h1 class="text-center"><?php echo $totalcitzien;?></h1>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="page-header">
            <h1 style="color: white;">Announcements - Last 10 Days</h1>
        </div>

        <?php
        $announcements = ("SELECT * FROM combineannoucements WHERE date > current_date - 10 ORDER BY date");
        $announcementsresult = $mysqli->query($announcements) or die($mysqli->error . __LINE__);
        while ($data = $announcementsresult->fetch_assoc()) {
           echo '
           <div class="alert '.$data["type"].'" role="alert">
            <b>'.$data["title"].' - '.$data["date"].'</b>
                <p>
                   '.$data["info"].'
                </p>
                <p>From: '.$data["creator"].'</p>
        </div>

           ';
        }
        ?>
        
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>


