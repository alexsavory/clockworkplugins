<?php session_start();
require 'include/config.php';
// You shouldnt be here if your not logged in
// Get Unit and set session
       if (!isset($_SESSION['unitid'])) {
header("Location:index.php");
       }
       if (!isset($_SESSION['steamlogin'])) {
header("Location:index.php");
       }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="bs/ico/favicon.png">

    <title>My Reports</title>

    <!-- Bootstrap core CSS -->
    <link href="bs/css/bootstrap.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="bs/js/html5shiv.js"></script>
      <script src="bs/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
<br>
      <?php include('header.php');

      ?>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron"><?php
$con = mysql_connect($address,$user,$pass);

if (!$con)
  {
  echo('<div class="alert alert-error">' . mysql_error() . '</div>');
  }

mysql_select_db($database, $con);
$result = mysql_query("SELECT * FROM  `combinereports` WHERE  `unitid` LIKE '".$_SESSION['unitid']."' LIMIT 0 , 30");
?>
    <div class="container">
<?php
$perpage = 10;

if(isset($_GET["page"]))

{

$page = intval($_GET["page"]);

}

else

{

$page = 1;

}

$calc = $perpage * $page;

$start = $calc - $perpage;

if (mysql_error()==""){ } else echo '<div class="alert alert-warning">'.mysql_error().'</div>';
echo "
<center>
<h1>My Reports</h1>
<div class='table-responsive'>
<table class='table table-condensed'>

<tr>
<th>Unit Name</th>
<th>Date(OOC)</th>
<th>Date(IC)</th>
<th>Location</th>
<th>Status</th>
<th>Action</th>
</tr>
</center>

";


$rows = mysql_num_rows($result);

if($rows)

{

$i = 0;

}

while($row = @mysql_fetch_array($result))
  {

if ($row['reviewed'] == "reviewed") {
  echo '<tr class="success">';
} else {echo '<tr class="warning">';}
  echo "<td>" . $row['unitname'] . "</td>";
  echo "<td>" . $row['dateooc'] . "</td>";
  echo "<td>" . $row['dateic'] . "</td>";
  echo "<td>" . $row['location'] . "</td>";
  if ($row['reviewed'] == "reviewed") {
  echo '<td><span class="glyphicon glyphicon-ok"></span> Reviewed</td>';
} else {echo '<td><span class="glyphicon glyphicon-remove"></span>Not Reviewed</td>';}
echo '<td>
  <form action="viewreport.php" method="post" style="display: inline;">
    <input type="hidden" name="action" value="view" />
  <input type="hidden" name="key" value="'.$row['RID'].'" />
  <button type="submit" class="btn btn-default">View</button>
    </form></td>';
  echo "</tr>";
  }
echo "</table></div>";
echo"<ul class='pagination'>";


if(isset($page))

{

$result = mysql_query("select Count(*) As Total from combinereports");

$rows = mysql_num_rows($result);

if($rows)

{

$rs = mysql_fetch_array($result);

$total = $rs["Total"];

}

$totalPages = ceil($total / $perpage);

if($page <=1 )

{

echo "<li class='disabled'><a href='#'>&laquo;</a></li>";

}

else

{

$j = $page - 1;

echo "    <li><a href='{$_SERVER['PHP_SELF']}?page=$j'>&laquo;</a></li>";

}

for($i=1; $i <= $totalPages; $i++)

{

if($i<>$page)

{

echo "    <li><a href='{$_SERVER['PHP_SELF']}?page=$i'>$i</a></li>";

}

else

{

echo "<li class='active'><a href='#'>$i</a></li>";

}

}

if($page == $totalPages )

{

echo "    <li class='disabled'><a href='#'>&raquo;</a></li>";

}

else

{

$j = $page + 1;

echo "<li><a href='{$_SERVER['PHP_SELF']}?page=$j'>&raquo;</a></li>";

}

}
echo "</ul>";

?>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bs/js/jquery.js"></script>
    <script src="bs/js/bootstrap.min.js"></script>
  </body>
</html>
