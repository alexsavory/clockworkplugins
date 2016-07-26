<?php
session_start();
/**
 * Project: combinedatapad
 * File: tools.php
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


    <title>Tools & Accessories</title>

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

.glyphicon-refresh-animate {
    -animation: spin .7s infinite linear;
    -webkit-animation: spin2 .7s infinite linear;
}

@-webkit-keyframes spin2 {
    from {
        -webkit-transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    from {
        transform: scale(1) rotate(0deg);
    }
    to {
        transform: scale(1) rotate(360deg);
    }
}

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- C16 Admin Javascript-->
    <script src="js/ajaxpages.js?2"></script>
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
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><b><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Resident Search</b></h3>
                </div>
                <div class="panel-body">
                    <a onclick="LoadPage('Resident')"><button type="button" class="btn btn-primary btn-lg btn-block">Search</button></a>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><b><span class="glyphicon glyphicon-tower" aria-hidden="true"></span> Superior Commanders</b></h3>
                </div>
                <div class="panel-body">
                    <a onclick="LoadPage('Leaders')"><button type="button" class="btn btn-primary btn-lg btn-block">View</button></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><b><span class="glyphicon glyphicon-king" aria-hidden="true"></span> City Administrators</b></h3>
                </div>
                <div class="panel-body">
                    <a onclick="LoadPage('CityAdmin')"><button type="button" class="btn btn-primary btn-lg btn-block">View</button></a>
                </div>
            </div>
        </div>

    </div>
    <hr>
    <div class="row">
    	<div class="container well" id="mainpanel">
    		<div class="alert alert-warning" role="alert">Please Select An Action!</div>
    	</div>
    </div>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>


