<?php
/**
 * Project: combinedatapad
 * File: header.php
 * Created by PhpStorm.
 * User: Alex
 * Created: 06/08/2015 07:40 PM
 * This remains property of Alex Savory
 */
include("include/configuration.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="images/combine_logo.png" style="max-height:40px;display:inline;margin-top:-10px;margin-left:-10px"> <?php echo $app_title;?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php
                if(basename($_SERVER['PHP_SELF']) == 'dash.php') {echo '<li class="active"><a href="dash.php"><span class="glyphicon glyphicon-home active"></span> Dashboard</a></li>';} else {echo '<li><a href="dash.php"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>';}

                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-inbox"></span> Reports <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="report.php?action=add">Add Report</a></li>
                        <li><a href="report.php?action=myreports">View My Reports</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="tools.php" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-wrench"></span> Tools </a>
                
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-briefcase"></span> Administration <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                            <?php
            if (strposa($_SESSION['unitname'], $adminranks, 1)) {
                echo '

                
                        <li><a href="admin.php?action=open"><span class="glyphicon glyphicon-briefcase"></span> View <b>Open</b> Reports</a></li>
                        <li><a href="admin.php?action=allreports"><span class="glyphicon glyphicon-briefcase"></span> View All Reports</a></li>
                        <li><a href="admin.php?action=newannoucement"><span class="glyphicon glyphicon-bullhorn"></span> Create new announcement</a></li>
                        <li><a href="admin.php?action=announcement"><span class="glyphicon glyphicon-th-list"></span> Manage Annoucements</a></li>
                        ';
                        
                        
                        
                        
                        
            }
            if (in_array($_SESSION['steamlogin'], $admins)) {
                        echo '  <li role="separator" class="divider"></li>';
                        echo '<li><a href="admin.php?action=passcodes"><span class="glyphicon glyphicon-lock"></span> <span class="label label-danger">Admin</span> Manage Passcodes</a></li>';
                        }
            ?></ul></li>
                <li><a href="index.php?logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>

        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>
