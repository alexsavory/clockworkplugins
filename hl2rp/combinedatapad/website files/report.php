<?php
/**
 * Project: combinedatapad
 * File: report.php
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

if($_GET["action"] == "add") {
    date_default_timezone_set($zone);
    date("I");
    echo '
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Report</title>

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
<script type="javascript/text">

/**************************************
 * Date class extension
 * 
 */
    // Provide month names
    Date.prototype.getMonthName = function(){
        var month_names = [
                            "January",
                            "February",
                            "March",
                            "April",
                            "May",
                            "June",
                            "July",
                            "August",
                            "September",
                            "October",
                            "November",
                            "December"
                        ];

        return month_names[this.getMonth()];
    }

    // Provide month abbreviation
    Date.prototype.getMonthAbbr = function(){
        var month_abbrs = [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "May",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Oct",
                            "Nov",
                            "Dec"
                        ];

        return month_abbrs[this.getMonth()];
    }

    // Provide full day of week name
    Date.prototype.getDayFull = function(){
        var days_full = [
                            "Sunday",
                            "Monday",
                            "Tuesday",
                            "Wednesday",
                            "Thursday",
                            "Friday",
                            "Saturday"
                        ];
        return days_full[this.getDay()];
    };

    // Provide full day of week name
    Date.prototype.getDayAbbr = function(){
        var days_abbr = [
                            "Sun",
                            "Mon",
                            "Tue",
                            "Wed",
                            "Thur",
                            "Fri",
                            "Sat"
                        ];
        return days_abbr[this.getDay()];
    };

    // Provide the day of year 1-365
    Date.prototype.getDayOfYear = function() {
        var onejan = new Date(this.getFullYear(),0,1);
        return Math.ceil((this - onejan) / 86400000);
    };

    // Provide the day suffix (st,nd,rd,th)
    Date.prototype.getDaySuffix = function() {
        var d = this.getDate();
        var sfx = ["th","st","nd","rd"];
        var val = d%100;

        return (sfx[(val-20)%10] || sfx[val] || sfx[0]);
    };

    // Provide Week of Year
    Date.prototype.getWeekOfYear = function() {
        var onejan = new Date(this.getFullYear(),0,1);
        return Math.ceil((((this - onejan) / 86400000) + onejan.getDay()+1)/7);
    } 

    // Provide if it is a leap year or not
    Date.prototype.isLeapYear = function(){
        var yr = this.getFullYear();

        if ((parseInt(yr)%4) == 0){
            if (parseInt(yr)%100 == 0){
                if (parseInt(yr)%400 != 0){
                    return false;
                }
                if (parseInt(yr)%400 == 0){
                    return true;
                }
            }
            if (parseInt(yr)%100 != 0){
                return true;
            }
        }
        if ((parseInt(yr)%4) != 0){
            return false;
        } 
    };

    // Provide Number of Days in a given month
    Date.prototype.getMonthDayCount = function() {
        var month_day_counts = [
                                    31,
                                    this.isLeapYear() ? 29 : 28,
                                    31,
                                    30,
                                    31,
                                    30,
                                    31,
                                    31,
                                    30,
                                    31,
                                    30,
                                    31
                                ];

        return month_day_counts[this.getMonth()];
    } 

    // format provided date into this.format format
    Date.prototype.format = function(dateFormat){
        // break apart format string into array of characters
        dateFormat = dateFormat.split("");

        var date = this.getDate(),
            month = this.getMonth(),
            hours = this.getHours(),
            minutes = this.getMinutes(),
            seconds = this.getSeconds();
        // get all date properties ( based on PHP date object functionality )
        var date_props = {
            d: date < 10 ? "0"+date : date,
            D: this.getDayAbbr(),
            j: this.getDate(),
            l: this.getDayFull(),
            S: this.getDaySuffix(),
            w: this.getDay(),
            z: this.getDayOfYear(),
            W: this.getWeekOfYear(),
            F: this.getMonthName(),
            m: month < 10 ? "0"+(month+1) : month+1,
            M: this.getMonthAbbr(),
            n: month+1,
            t: this.getMonthDayCount(),
            L: this.isLeapYear() ? "1" : "0",
            Y: this.getFullYear(),
            y: this.getFullYear()+"".substring(2,4),
            a: hours > 12 ? "pm" : "am",
            A: hours > 12 ? "PM" : "AM",
            g: hours % 12 > 0 ? hours % 12 : 12,
            G: hours > 0 ? hours : "12",
            h: hours % 12 > 0 ? hours % 12 : 12,
            H: hours,
            i: minutes < 10 ? "0" + minutes : minutes,
            s: seconds < 10 ? "0" + seconds : seconds           
        };

        // loop through format array of characters and add matching data else add the format character (:,/, etc.)
        var date_string = "";
        for(var i=0;i<dateFormat.length;i++){
            var f = dateFormat[i];
            if(f.match(/[a-zA-Z]/g)){
                date_string += date_props[f] ? date_props[f] : "";
            } else {
                date_string += f;
            }
        }

        return date_string;
    };
</script>
<script type="javascript/text">
function RefreshTime(){
    var d = new Date(); 
    d_string = d.format("m/d/Y h:i:s");
    document.getElementsById("date").Value = d_string;
};
</script>
</head>

<body>

<div class="container">
    ';


   include("header.php");

    echo '


    <!-- Main component for a primary marketing message or call to action -->
    <div class="well">
        <h2 style="margin-top: 2px">Create Report</h2>
        <!-- Cant refresh in gmod derma -->
        <A class="btn btn-sm btn-primary btn-block" onclick="RefreshTime()" >Refresh OOC Time</A>
        <hr>
        <form class="form-horizontal" action="report.php?action=new" method="post" role="form">
            <div class="form-group">
                <label for="inputunitid" class="col-lg-2 control-label">Unit ID</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="inputunitid" name="unit" readonly value="'.$_SESSION['unitname'].'">
                </div>
            </div>
            <div class="form-group">
                <label for="date" class="col-lg-2 control-label">Date/Time(OOC)</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="date" name="dateooc" readonly value="'.date('m/d/Y h:i:s a').'">
                </div>
            </div>
            <div class="form-group">
                <label for="dateic" class="col-lg-2 control-label">Date/Time(IC)</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="dateic" name="dateic" required value="">
                </div>
            </div>
            <div class="form-group">
                <label for="location" class="col-lg-2 control-label">Location</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="location" name="location" required value="">
                </div>
            </div>
            <div class="form-group">
                <label for="info" class="col-lg-2 control-label">Notes<br> You can use &lt;br&gt; for new lines</label>
                <div class="col-lg-5">
                    <textarea cols="50" rows="10" class="form-control" id="info" required name="notes" value=""></textarea>
                </div>
            </div>
            <input type="hidden" name="unitkey" value="'.$_SESSION['unitid'].'" />
            <button class="btn btn-lg btn-info btn-block" type="submit">Submit</button>
        </form>
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

if($_GET["action"] == "new") {
    echo '
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Submitting Report</title>

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
        <h2 style="margin-top: 2px">Uploading Report to Combine Network...</h2>';

    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $unitid = $_SESSION["unitid"];
    $unitkey = $mysqli->real_escape_string($_POST["unitkey"]);
    $unitname = $mysqli->real_escape_string($_POST["unit"]);
    $dateooc = $mysqli->real_escape_string($_POST["dateooc"]);
    $dateic  = $mysqli->real_escape_string($_POST["dateic"]);
    $location = $mysqli->real_escape_string($_POST["location"]);
    $notes = $mysqli->real_escape_string($_POST["notes"]);
    $notes = nl2br($notes);
    $query = "INSERT INTO `combinereports` (`unitid`,`unitname`, `dateooc`, `dateic`, `location`, `notes`, `reviewed`, `reviewer`, `comments`, `RID`) VALUES ('$unitid', '$unitname','$dateooc', '$dateic', '$location', '$notes', 'no', '','',null)";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
    if($result){
        echo "<div class='alert alert-success'> Upload Complete. Redirecting.</div>";
        echo '
        <script type="text/javascript">
            window.location = "report.php?action=myreports";
        </script>
        ';
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
if($_GET["action"] == "myreports") {
   echo ' <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Reports</title>

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
        <h2 style="margin-top: 2px">My Reports <a class="btn btn-success" href="report.php?action=add">Add New Report</a>
</h2>';

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

    $query = "SELECT * FROM  `combinereports` WHERE  `unitid` LIKE '".$_SESSION['unitid']."' LIMIT $start_from , $per_page";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
    if($result){
       echo '
       <table class="table table-striped">
       <tr><th>#</th><th>Date(OOC)</th><th>Date(IC)</th><th>Location</th><th>Status</th><th>Actions</th></tr>
       ';
        $rowidnum = 0;
        while($row = $result->fetch_assoc()){
            $rowidnum++;
            echo '<tr>';
            echo '<td>'.$rowidnum.'</td>';
            echo '<td>'.$row["dateooc"].'</td>';
            echo '<td>'.$row["dateic"].'</td>';
            echo '<td>'.$row["location"].'</td>';
            if($row["reviewed"] == "reviewed") {
                echo '<td class="success">Reviewed</td>';
            } else {
                echo '<td class="danger">Not Reviewed</td>';

            }
            echo '<td><a class="btn btn-xs btn-primary" href="report.php?action=viewreport&id='.$row["RID"].'">View</a></td>';

            echo '</tr>';
        }
        echo '
       </table>

       ';
        $query = "SELECT * FROM  `combinereports` WHERE  `unitid` LIKE '".$_SESSION['unitid']."'";
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
            <a href="report.php?action=myreports&page=1" aria-label="Previous">
                <span aria-hidden="true">First Page</span>
            </a>
            </li>';

        for ($i=1; $i<=$total_pages; $i++) {
            echo "<li><a href='report.php?action=myreports&page=".$i."''>".$i."</a></li>";
        };
        // Going to last page
        echo "<li><a href='report.php?action=myreports&page=$total_pages'>".'Last Page'."</a></li> ";
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
        <h2 style="margin-top: 2px">View Report <button class="btn btn-info" id="editbutton" onclick="EditReport()">Edit</button></a>
</h2>';

    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if (mysqli_connect_errno()) {
        printf("Unable to Connect to Network! Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $reportid = $_GET["id"];
    $reportid = $mysqli->real_escape_string($reportid);
    $query = "SELECT * FROM  `combinereports` WHERE  `unitid` LIKE '".$_SESSION['unitid']."' AND `RID` = '".$reportid."'";
    $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
    if($result){

        while($row = $result->fetch_assoc()){
            echo '
            <form class="form-horizontal" action="report.php?action=edit&id='.$row["RID"].'" method="post" role="form">
            <div class="form-group">
                <label for="inputunitid" class="col-lg-2 control-label">Unit ID</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="inputunitid" name="unit" readonly value="'.$_SESSION['unitname'].'">
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
            <button class="btn btn-lg btn-warning btn-block" id="save" disabled type="submit">Save</button>



        </form>

        <hr>
        <div class="alert alert-info">
        If a response has been recorded, it will be shown below.
        </div>
        ';

        if($row["reviewed"] == "reviewed"){
            echo '
            <div class="alert alert-warning">
                Response By: '.$row["reviewer"].'
            </div>
            <textarea  cols="50" readonly rows="10" class="form-control" id="reponse" required name="reponse">
                   '.$row["comments"].'
            </textarea>

            
            ';
        } else {
            echo '
            <div class="alert alert-danger">
        No response has been recorded yet.
        </div>
        ';
        }
        
        
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
if($_GET["action"] == "edit" && isset($_GET["id"])){
    echo '
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Editing Report</title>

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

    $find = "SELECT * FROM `combinereports` WHERE RID = '$reportid' AND unitid = '$unitid' ";
    $findq = $mysqli->query($find) or die($mysqli->error);

    if(mysqli_num_rows($findq) == 1){
        $unitkey = $mysqli->real_escape_string($_POST["unitkey"]);
        $unitname = $mysqli->real_escape_string($_POST["unit"]);
        $dateic  = $mysqli->real_escape_string($_POST["dateic"]);
        $location = $mysqli->real_escape_string($_POST["location"]);
        $notes = $mysqli->real_escape_string($_POST["notes"]);
        $notes = nl2br($notes);
        $query = "UPDATE `combinereports` SET unitname='$unitname',dateic='$dateic',location='$location',notes='$notes' WHERE RID=$reportid";
        $result = $mysqli->query($query) or die($mysqli->error . __LINE__);
        if($result){
            echo "<div class='alert alert-success'> Update Complete. Redirecting.</div>";
            echo '
        <script type="text/javascript">
            window.location = "report.php?action=viewreport&id='.$reportid.'";
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
?>

