<?php
/**
 * Project: combinedatapad
 * File: admin.php
 * Created by PhpStorm.
 * User: Alex
 * Created: 06/08/2015 08:19 PM
 * This remains property of Alex Savory
 */
session_start();
include("include/configuration.php");
include("include/functions.php");

if (!isset($_SESSION['unitid'])) {
    header("Location:index.php");
}
if (!isset($_SESSION['steamlogin'])) {
    header("Location:index.php");
}
            if (strposa($_SESSION['unitname'], $adminranks, 1)) {
            	$allow = true;
            } else {
            	$allow = false;
            }
            
if (in_array($_SESSION['steamlogin'], $admins)) {
    $allow = true;
}
            if($allow == false){
            	header("Location:dash.php");
            }
if($_GET["action"] == "open") {
    date_default_timezone_set($zone);
    date("I");
    echo '
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Open Reports</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        body {
        background: -webkit-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Chrome 10+, Saf5.1+ */
            background:    -moz-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* FF3.6+ */
            background:     -ms-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* IE10 */
            background:      -o-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Opera 11.10+ */
            background:         linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* W3C */
            font-family: "Raleway", sans-serif;
        }
        body {
        padding-top: 20px;
            padding-bottom: 20px;
        }

    </style>
    <script language="javascript/text">
        function addTxt(txt, field){
            var myTxt = txt;
            var id = field;
            document.getElementById(id).value = myTxt;
        }
    </script>

</head>

<body>

<div class="container">
    ';


    include("header.php");

    echo '


    <!-- Main component for a primary marketing message or call to action -->
    <div class="well">
        <h2 style="margin-top: 2px">Open Reports</h2>';

    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $per_page=10;
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page=1;
    }

    $start_from = ($page-1) * $per_page;

    $query = "SELECT * FROM  `combinereports` WHERE  `unitid` != '".$_SESSION['unitid']."' AND `reviewed` = 'no' LIMIT $start_from , $per_page";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
    if($result){
       echo '
       <table class="table table-striped">
       <tr>
       <th>#</th>
       <th>Date(OOC)</th>
       <th>Date(IC)</th>
       <th>Location</th>
       <th>Unit</th>
       <th>Actions</th>
       </tr>
       ';
        $rowidnum = 0;
        while($row = $result->fetch_assoc()){
            $rowidnum++;
            echo '<tr>';
            echo '<td>'.$rowidnum.'</td>';
            echo '<td>'.$row["dateooc"].'</td>';
            echo '<td>'.$row["dateic"].'</td>';
            echo '<td>'.$row["location"].'</td>';
            echo '<td>'.$row["unitname"].'</td>';

            echo '<td><a class="btn btn-xs btn-primary" href="admin.php?action=viewreport&id='.$row["RID"].'">Review</a></td>';

            echo '</tr>';
        }
        echo '
       </table>

       ';
        $query = "SELECT * FROM  `combinereports` WHERE  `unitid` != '".$_SESSION['unitid']."' AND `reviewed` = 'no'";
        $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
        $total_records = mysqli_num_rows($result);
        $total_pages = ceil($total_records / $per_page);

        $total_pages = ceil($total_records / $per_page);

        //Build Pagination
        echo '
        <nav class="text-center">
        <ul class="pagination">
        ';
        //Going to first page
        echo '
            <li>
            <a href="admin.php?action=open&page=1" aria-label="Previous">
                <span aria-hidden="true">First Page</span>
            </a>
            </li>';

        for ($i=1; $i<=$total_pages; $i++) {
            echo "<li><a href='admin.php?action=open&page=".$i."''>".$i."</a></li>";
        };
        // Going to last page
        echo "<li><a href='admin.php?action=open&page=$total_pages'>".'Last Page'."</a></li> ";
        echo '</ul></nav>';

    }
    echo '
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type= "javascript/text" src="include/myjavafunc.js"></script>
</body>
</html>
    ';
}
if($_GET["action"] == "allreports") {
    date_default_timezone_set($zone);
    date("I");
    echo '
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>All Reports</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        body {
        background: -webkit-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Chrome 10+, Saf5.1+ */
            background:    -moz-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* FF3.6+ */
            background:     -ms-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* IE10 */
            background:      -o-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Opera 11.10+ */
            background:         linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* W3C */
            font-family: "Raleway", sans-serif;
        }
        body {
        padding-top: 20px;
            padding-bottom: 20px;
        }

    </style>
    <script language="javascript/text">
        function addTxt(txt, field){
            var myTxt = txt;
            var id = field;
            document.getElementById(id).value = myTxt;
        }
    </script>

</head>

<body>

<div class="container">
    ';


    include("header.php");

    echo '


    <!-- Main component for a primary marketing message or call to action -->
    <div class="well">
        <h2 style="margin-top: 2px">Open Reports</h2>';

    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $per_page=10;
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page=1;
    }

    $start_from = ($page-1) * $per_page;

    $query = "SELECT * FROM  `combinereports` WHERE  `unitid` != '".$_SESSION['unitid']."' LIMIT $start_from , $per_page";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
    if($result){
       echo '
       <table class="table table-striped">
       <tr>
       <th>#</th>
       <th>Date(OOC)</th>
       <th>Date(IC)</th>
       <th>Location</th>
       <th>Unit</th>
       <th>Status</th>
       <th>Actions</th>
       </tr>
       ';
        $rowidnum = 0;
        while($row = $result->fetch_assoc()){
            $rowidnum++;
            echo '<tr>';
            echo '<td>'.$rowidnum.'</td>';
            echo '<td>'.$row["dateooc"].'</td>';
            echo '<td>'.$row["dateic"].'</td>';
            echo '<td>'.$row["location"].'</td>';
            echo '<td>'.$row["unitname"].'</td>';
            	if ($row['reviewed'] == "reviewed") {
  echo '<td><span class="glyphicon glyphicon-ok"></span> Reviewed</td>';
} else {echo '<td><span class="glyphicon glyphicon-remove"></span><small>Not Reviewed</small></td>';}
            echo '<td><a class="btn btn-xs btn-primary" href="admin.php?action=viewreport&id='.$row["RID"].'">Review</a></td>';

            echo '</tr>';
        }
        echo '
       </table>

       ';
        $query = "SELECT * FROM  `combinereports` WHERE  `unitid` != '".$_SESSION['unitid']."'";
        $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
        $total_records = mysqli_num_rows($result);
        $total_pages = ceil($total_records / $per_page);

        $total_pages = ceil($total_records / $per_page);

        //Build Pagination
        echo '
        <nav class="text-center">
        <ul class="pagination">
        ';
        //Going to first page
        echo '
            <li>
            <a href="admin.php?action=allreports&page=1" aria-label="Previous">
                <span aria-hidden="true">First Page</span>
            </a>
            </li>';

        for ($i=1; $i<=$total_pages; $i++) {
            echo "<li><a href='admin.php?action=allreports&page=".$i."''>".$i."</a></li>";
        };
        // Going to last page
        echo "<li><a href='admin.php?action=allreports&page=$total_pages'>".'Last Page'."</a></li> ";
        echo '</ul></nav>';

    }
    echo '
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type= "javascript/text" src="include/myjavafunc.js"></script>
</body>
</html>
    ';
}
if($_GET["action"] == "viewreport" && isset($_GET["id"])) {
    echo ' <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>View Report</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        body {
        background: -webkit-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Chrome 10+, Saf5.1+ */
            background:    -moz-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* FF3.6+ */
            background:     -ms-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* IE10 */
            background:      -o-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Opera 11.10+ */
            background:         linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* W3C */
            font-family: "Raleway", sans-serif;
        }
        body {
        padding-top: 20px;
            padding-bottom: 20px;
        }

    </style>


</head>

<body>

<div class="container">
    ';


    include("header.php");

    echo '


    <!-- Main component for a primary marketing message or call to action -->
    <div class="well">
        <h2 style="margin-top: 2px">Review Report</h2>';

    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $reportid = $_GET["id"];
    $reportid = $mysqli->real_escape_string($reportid);
    $query = "SELECT * FROM  `combinereports` WHERE  `unitid` != '".$_SESSION['unitid']."' AND `RID` = '".$reportid."'";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
    if($result){

        while($row = $result->fetch_assoc()){
            echo '
                       <form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="inputunitid" class="col-lg-2 control-label">Unit ID</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="inputunitid" name="unit" readonly value="'.$row['unitname'].'">
                </div>
            </div>
            <div class="form-group">
                <label for="date" class="col-lg-2 control-label">Date/Time(OOC)</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="date" name="dateooc" readonly value="'.$row["dateooc"].'">
                </div>
            </div>
            <div class="form-group">
                <label for="dateic" class="col-lg-2 control-label">Date/Time(IC)</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="dateic" name="dateic" readonly value="'.$row["dateic"].'">
                </div>
            </div>
            <div class="form-group">
                <label for="location" class="col-lg-2 control-label">Location</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="location" name="location" readonly value="'.$row["location"].'">
                </div>
            </div>
            <div class="form-group">
                <label for="info" class="col-lg-2 control-label">Notes</label>
                <div class="col-lg-5">
                   <textarea  cols="50" readonly rows="10" class="form-control" id="info" required name="notes">
                   '.$row["notes"].'
                   </textarea>
                </div>
            </div>
            <hr>
            <button class="btn btn-lg btn-outline btn-block" id="save" disabled ">Add Your Response Below</button>
            <hr>
            </form>
            <form class="form-horizontal" action="admin.php?action=respond&id='.$row["RID"].'" method="post" role="form">
            <div class="form-group">
                <label for="info" class="col-lg-2 control-label">Response</label>
                <div class="col-lg-5">
                   <textarea  cols="50" rows="10" class="form-control" id="response" required name="response">
               
                   </textarea>
                </div>
            </div>
            <button class="btn btn-lg btn-warning btn-block" id="save">Save Response</button>

        </form>

            ';
        }

    }
    echo '
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type= "javascript/text" src="include/myjavafunc.js"></script>
    <script>
function EditReport(){

    document.getElementById("dateic").removeAttribute("readonly");
    document.getElementById("location").removeAttribute("readonly");
    document.getElementById("info").removeAttribute("readonly");
    document.getElementById("info").removeAttribute("readonly");
    document.getElementById("save").removeAttribute("disabled");

};
    </script>
</body>
</html>
    ';
}
if($_GET["action"] == "respond" && isset($_GET["id"])){
    echo '
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Responding Report</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        body {
            background: -webkit-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Chrome 10+, Saf5.1+ */
            background:    -moz-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* FF3.6+ */
            background:     -ms-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* IE10 */
            background:      -o-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Opera 11.10+ */
            background:         linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* W3C */
            font-family: "Raleway", sans-serif;
        }
        body {
            padding-top: 20px;
            padding-bottom: 20px;
        }

    </style>
    <script language="javascript/text">
        function addTxt(txt, field){
            var myTxt = txt;
            var id = field;
            document.getElementById(id).value = myTxt;
        }
    </script>

</head>

<body>

<div class="container">
    ';


    include("header.php");

    echo '


    <!-- Main component for a primary marketing message or call to action -->
    <div class="well">
        <h2 style="margin-top: 2px">Updating Report on Combine Network...</h2>';

    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $reportid = $_GET["id"];
    $unitid = $_SESSION["unitid"];

    $find = "SELECT * FROM `combinereports` WHERE RID = '$reportid'";
    $findq = $mysqli->query($find) or die($mysqli->error);

    if(mysqli_num_rows($findq) == 1){
        $reviewerid = $mysqli->real_escape_string($_SESSION["unitid"]);
        $unitname = $mysqli->real_escape_string($_SESSION["unitname"]);
        $response = $mysqli->real_escape_string($_POST["response"]);
        $response = nl2br($response);
        $query = "UPDATE `combinereports` SET reviewed='reviewed',reviewer='$unitname',comments='$response'WHERE RID=$reportid";
        $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
        if($result){
            echo "<div class='alert alert-success'> Responded. Redirecting.</div>";
            echo '
        <script type="text/javascript">
            window.location = "admin.php?action=open";
        </script>
        ';
        }
    } else {
        echo "<div class='alert alert-danger'> Unable to Complete Update! Cannot Find ReportID!</div>";

    }


    echo '
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type= "javascript/text" src="include/myjavafunc.js"></script>
</body>
</html>
    ';

}
if($_GET["action"] == "newannoucement"){
    echo '
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>New Announcement</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        body {
            background: -webkit-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Chrome 10+, Saf5.1+ */
            background:    -moz-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* FF3.6+ */
            background:     -ms-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* IE10 */
            background:      -o-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Opera 11.10+ */
            background:         linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* W3C */
            font-family: "Raleway", sans-serif;
        }
        body {
            padding-top: 20px;
            padding-bottom: 20px;
        }

    </style>
    <script language="javascript/text">
        function addTxt(txt, field){
            var myTxt = txt;
            var id = field;
            document.getElementById(id).value = myTxt;
        }
    </script>

</head>

<body>

<div class="container">
    ';


    include("header.php");

    echo '
    <div class="well">
    	<form class="form-horizontal" action="admin.php?action=addannouncement" method="post" role="form">
  <div class="form-group">
    <label for="inputunitid" class="col-lg-2 control-label">Unit ID</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="inputunitid" name="unit" readonly value="'.$_SESSION["unitname"].'">
    </div>
  </div>
Color<br>
    <div class="radio">
  <label>
    <input type="radio" name="color" id="color" value="alert-success" checked>
<span class="text-success">Green </span>
  </label>
</div>
    <div class="radio">
  <label>
    <input type="radio" name="color" id="color" value="alert-info">
<span class="text-info">Blue </span>
  </label>
</div>
    <div class="radio">
  <label>
    <input type="radio" name="color" id="color" value="alert-warning">
<span class="text-warning">Orange/Yellow </span>
  </label>
</div>
    <div class="radio">
  <label>
    <input type="radio" name="color" id="color" value="alert-danger">
<span class="text-danger">Red </span>
  </label>
</div>

      <div class="form-group">
    <label for="title" class="col-lg-2 control-label">Title</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="title" name="title" required value="">
    </div></div>
          <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Only &lt;a&gt;,&lt;br&gt; and &lt;p&gt; tags are allowed here.</h3>
        </div>
        <div class="panel-body">
          <div class="form-group">
    <label for="body" class="col-lg-2 control-label">Body</label>
    <div class="col-lg-5">
      <textarea style="max-width: 200%;"cols="50"  class="form-control" idinfo="body" required name="body" value=""></textarea>
    </div>
        </div>
      </div></div>

  <button class="btn btn-lg btn-info btn-block" type="submit">Add Announcement</button>
</form>
    </div></div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type= "javascript/text" src="include/myjavafunc.js"></script>
</body>
</html>
    ';

}
if($_GET["action"] == "addannouncement"){
    echo '
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Responding Report</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        body {
            background: -webkit-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Chrome 10+, Saf5.1+ */
            background:    -moz-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* FF3.6+ */
            background:     -ms-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* IE10 */
            background:      -o-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Opera 11.10+ */
            background:         linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* W3C */
            font-family: "Raleway", sans-serif;
        }
        body {
            padding-top: 20px;
            padding-bottom: 20px;
        }

    </style>
    <script language="javascript/text">
        function addTxt(txt, field){
            var myTxt = txt;
            var id = field;
            document.getElementById(id).value = myTxt;
        }
    </script>

</head>

<body>

<div class="container">
    ';


    include("header.php");

    echo '


    <!-- Main component for a primary marketing message or call to action -->
    <div class="well">
        <h2 style="margin-top: 2px">Adding Local Announcement...</h2>';

    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $unitname = $mysqli->real_escape_string($_SESSION["unitname"]);
    $color = $mysqli->real_escape_string($_POST["color"]);
    $title = $mysqli->real_escape_string(strip_tags($_POST['title']));
    $body = $mysqli->real_escape_string(strip_tags($_POST['body']));
    $date = date("Y-m-d H:i:s");
    $query = "INSERT INTO `combineannoucements` (`creator`,`type`, `title`, `info`, `date`,`RID`) VALUES ('$unitname', '$color','$title', '$body', '$date', NULL)";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
        if($result){
            echo "<div class='alert alert-success'> Added. Redirecting.</div>";
            echo '
        <script type="text/javascript">
            window.location = "dash.php";
        </script>
        ';
 
    } else {
        echo "<div class='alert alert-danger'> Error!</div>";

    }


    echo '
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type= "javascript/text" src="include/myjavafunc.js"></script>
</body>
</html>
    ';

}
if($_GET["action"] == "announcement") {
    date_default_timezone_set($zone);
    date("I");
    echo '
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Manage Announcements</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        body {
        background: -webkit-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Chrome 10+, Saf5.1+ */
            background:    -moz-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* FF3.6+ */
            background:     -ms-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* IE10 */
            background:      -o-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Opera 11.10+ */
            background:         linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* W3C */
            font-family: "Raleway", sans-serif;
        }
        body {
        padding-top: 20px;
            padding-bottom: 20px;
        }

    </style>
    <script language="javascript/text">
        function addTxt(txt, field){
            var myTxt = txt;
            var id = field;
            document.getElementById(id).value = myTxt;
        }
    </script>

</head>

<body>

<div class="container">
    ';


    include("header.php");

    echo '


    <!-- Main component for a primary marketing message or call to action -->
    <div class="well">
        <h2 style="margin-top: 2px">Manage Announcements </h2>';

    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $per_page=10;
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page=1;
    }

    $start_from = ($page-1) * $per_page;

    $query = "SELECT * FROM  `combineannoucements` LIMIT $start_from , $per_page";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
    if($result){
       echo '
       <table class="table table-striped">
       <tr>
       <th>#</th>
       <th>Title</th>
       <th>Description</th>
       <th>Creator</th>
       <th>Actions</th>
       </tr>
       ';
        $rowidnum = 0;
        while($row = $result->fetch_assoc()){
            $rowidnum++;
            echo '<tr>';
            echo '<td>'.$rowidnum.'</td>';
            echo '<td>'.$row["title"].'</td>';
             echo '<td>'.$row["info"].'</td>';
            echo '<td>'.$row["creator"].'</td>';
            echo '<td><a class="btn btn-xs btn-danger" href="admin.php?action=deleteannoucement&id='.$row["RID"].'">Delete</a></td>';

            echo '</tr>';
        }
        echo '
       </table>

       ';
        $query = "SELECT * FROM  `combineannoucements` ";
        $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
        $total_records = mysqli_num_rows($result);
        $total_pages = ceil($total_records / $per_page);

        $total_pages = ceil($total_records / $per_page);

        //Build Pagination
        echo '
        <nav class="text-center">
        <ul class="pagination">
        ';
        //Going to first page
        echo '
            <li>
            <a href="admin.php?action=announcement&page=1" aria-label="Previous">
                <span aria-hidden="true">First Page</span>
            </a>
            </li>';

        for ($i=1; $i<=$total_pages; $i++) {
            echo "<li><a href='admin.php?action=announcement&page=".$i."''>".$i."</a></li>";
        };
        // Going to last page
        echo "<li><a href='admin.php?action=announcement&page=$total_pages'>".'Last Page'."</a></li> ";
        echo '</ul></nav>';

    }
    echo '
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type= "javascript/text" src="include/myjavafunc.js"></script>
</body>
</html>
    ';
}

if($_GET["action"] == "deleteannoucement"){
    echo '
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Delete Announcement</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        body {
            background: -webkit-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Chrome 10+, Saf5.1+ */
            background:    -moz-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* FF3.6+ */
            background:     -ms-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* IE10 */
            background:      -o-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Opera 11.10+ */
            background:         linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* W3C */
            font-family: "Raleway", sans-serif;
        }
        body {
            padding-top: 20px;
            padding-bottom: 20px;
        }

    </style>
    <script language="javascript/text">
        function addTxt(txt, field){
            var myTxt = txt;
            var id = field;
            document.getElementById(id).value = myTxt;
        }
    </script>

</head>

<body>

<div class="container">
    ';


    include("header.php");

    echo '


    <!-- Main component for a primary marketing message or call to action -->
    <div class="well">
        <h2 style="margin-top: 2px">Delete Local Announcement...</h2>';

    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
   
    $RID = $mysqli->real_escape_string(strip_tags($_GET['id']));

    $query = "DELETE FROM `combineannoucements` WHERE `RID` = '$RID'";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
        if($result){
            echo "<div class='alert alert-success'> Deleted. Redirecting.</div>";
            echo '
        <script type="text/javascript">
            window.location = "dash.php";
        </script>
        ';
 
    } else {
        echo "<div class='alert alert-danger'> Error!</div>";

    }


    echo '
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type= "javascript/text" src="include/myjavafunc.js"></script>
</body>
</html>
    ';

}

if($_GET["action"] == "passcodes") {
    
    if (!in_array($_SESSION['steamlogin'], $admins)) {
  header('Location:../index.php');
}
    date_default_timezone_set($zone);
    date("I");
    echo '
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Passcodes</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        body {
        background: -webkit-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Chrome 10+, Saf5.1+ */
            background:    -moz-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* FF3.6+ */
            background:     -ms-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* IE10 */
            background:      -o-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Opera 11.10+ */
            background:         linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* W3C */
            font-family: "Raleway", sans-serif;
        }
        body {
        padding-top: 20px;
            padding-bottom: 20px;
        }

    </style>
    <script language="javascript/text">
        function addTxt(txt, field){
            var myTxt = txt;
            var id = field;
            document.getElementById(id).value = myTxt;
        }
    </script>

</head>

<body>

<div class="container">
    ';


    include("header.php");

    echo '


    <!-- Main component for a primary marketing message or call to action -->
    <div class="well">
        <div class="row"><div class=".col-md-12"><div class="alert alert-warning text-center" role="alert"><h2><span class="label label-danger">Admin Tools</span> Manage user passcodes</div></div></div>';

    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    
                    if(isset($_POST["passcodeupdate"])){
                        $passcode = $_POST["passcodeupdate"];
                        $passcode = $mysqli->real_escape_string($passcode);
                        $usersteamid = $_POST["usersteamid"];
                        $usersteamid = $mysqli->real_escape_string($usersteamid);
                        
                        if(!is_numeric($passcode)){
                            echo '<div class="alert alert-danger" role="alert">The passcode: <code>'.$passcode.'</code> must be a number</div>';
                        } else {
                            $updatepass = ("UPDATE `combinelogins` SET `pin` = '$passcode', `updated` = NOW() WHERE `combinelogins`.`steamid` = '".$usersteamid."'");
                  
                       $passresult = $mysqli->query($updatepass) or die($mysqli->error . __LINE__);
                        
                        echo '<div class="alert alert-success" role="alert">The passcode for <code>'.$usersteamid.'</code> has been updated to: <code>'.$passcode.'</code></div>';
                        }
                        
                        
                        
                    }
    
    
    $per_page=10;
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page=1;
    }

    $start_from = ($page-1) * $per_page;

    $query = "SELECT * FROM  `combinelogins` LIMIT $start_from , $per_page";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
    if($result){
       echo '
       <table class="table table-striped">
       <tr>
       <th>#</th>
       <th>SteamID</th>
       <th>Passcode</th>
       <th>Updated</th>
       <th>Actions</th>
       </tr>
       ';

        while($row = $result->fetch_assoc()){
            echo '<tr>';
            echo '<td>'.$row["id"].'</td>';
            echo '<td>'.$row["steamid"].'</td>';
            echo '<td>'.$row["pin"].'</td>';
            echo '<td>'.$row["updated"].'</td>';
            echo '<td>
            
            <form action="admin.php?action=passcodes" method="post" class="form">
            <input type="hidden" id="usersteamid" name="usersteamid" value="'.$row["steamid"].'">
                            <div class="input-group">
                                <input type="text" class="form-control" id="passcodeupdate" name="passcodeupdate" minlength="4" required>
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="submit">Update</button>
                                </span>
                            </div><!-- /input-group -->
                    </form>
            
            </td>';

            echo '</tr>';
        }
        echo '
       </table>

       ';
        $query = "SELECT * FROM  `combinelogins` ";
        $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
        $total_records = mysqli_num_rows($result);
        $total_pages = ceil($total_records / $per_page);

        $total_pages = ceil($total_records / $per_page);

        //Build Pagination
        echo '
        <nav class="text-center">
        <ul class="pagination">
        ';
        //Going to first page
        echo '
            <li>
            <a href="admin.php?action=passcodes&page=1" aria-label="Previous">
                <span aria-hidden="true">First Page</span>
            </a>
            </li>';

        for ($i=1; $i<=$total_pages; $i++) {
            echo "<li><a href='admin.php?action=passcodes&page=".$i."''>".$i."</a></li>";
        };
        // Going to last page
        echo "<li><a href='admin.php?action=passcodes&page=$total_pages'>".'Last Page'."</a></li> ";
        echo '</ul></nav>';

    }
    echo '
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type= "javascript/text" src="include/myjavafunc.js"></script>
</body>
</html>
    ';
}
?>

