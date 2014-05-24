<!-- Static navbar -->
      <div class="navbar navbar-default">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="dash.php">Combine Report Console</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
<?php
include('include/config.php');
include('include/functions.php');
        if ($debug == "1") {
           error_reporting(E_ALL);
        }
echo '
<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tools<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="tools.php?action=citizenlist"><span class="glyphicon glyphicon-home"></span> Resident Search</a></li>';
if(basename($_SERVER['PHP_SELF']) == 'add.php') {echo '<li class="active"><a href="addreport.php"><span class="glyphicon glyphicon-pencil active"></span> Add Report</a></li> <title>Add Report</title>';} else {echo '<li><a href="addreport.php"><span class="glyphicon glyphicon-pencil"></span> Add Report</a></li>';}
if(basename($_SERVER['PHP_SELF']) == 'myreports.php') {echo '<li class="active"><a href="myreports.php"><span class="glyphicon glyphicon-th-list"></span> View my reports</a></li> <title>Dashboard</title>';} else {echo '<li><a href="myreports.php"><span class="glyphicon glyphicon-th-list"></span> View my reports</a></li>';}
echo '
              </ul>
            </li>
';
?>

          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php
            if (strposa($_SESSION['unitname'], $highranks, 1)) {
    echo '
<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administration <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Administration</li>
                <li><a href="addannouncement.php"><span class="glyphicon glyphicon-bullhorn"></span> New Announcement</a></li>
                <li><a href="reports.php"><span class="glyphicon glyphicon-warning-sign"></span> View Reports</a></li>
              </ul>
            </li>



    ';

} else {

}
            ?>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>