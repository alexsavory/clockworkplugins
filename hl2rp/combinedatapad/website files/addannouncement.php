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

    <title>New Announcement</title>

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
if (strposa($_SESSION['unitname'], $highranks, 1)) {} else {header("Location:dash.php");}
      ?>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <form class="form-horizontal" action="process/processannouncement.php" method="post" role="form">
  <div class="form-group">
    <label for="inputunitid" class="col-lg-2 control-label">Unit ID</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="inputunitid" name='unit' readonly value="<?php echo $_SESSION['unitname']; ?>">
    </div>
  </div>
Color<br>
    <div class='radio'>
  <label>
    <input type='radio' name='color' id='color' value="alert-success" checked>
<span class="text-success">Green </span>
  </label>
</div>
    <div class='radio'>
  <label>
    <input type='radio' name='color' id='color' value="alert-info">
<span class="text-info">Blue </span>
  </label>
</div>
    <div class='radio'>
  <label>
    <input type='radio' name='color' id='color' value="alert-warning">
<span class="text-warning">Orange/Yellow </span>
  </label>
</div>
    <div class='radio'>
  <label>
    <input type='radio' name='color' id='color' value="alert-danger">
<span class="text-danger">Red </span>
  </label>
</div>

      <div class="form-group">
    <label for="title" class="col-lg-2 control-label">Title</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="title" name='title' required value="">
    </div></div>
          <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Only &lt;a&gt;,&lt;br&gt; and &lt;p&gt; tags are allowed here.</h3>
        </div>
        <div class="panel-body">
          <div class="form-group">
    <label for="body" class="col-lg-2 control-label">Body</label>
    <div class="col-lg-5">
      <textarea style="max-width: 200%;"cols="50"  class="form-control" idinfo="body" required name='body' value=""></textarea>
    </div>
        </div>
      </div></div>

  <button class="btn btn-lg btn-info btn-block" type="submit">Add Announcement</button>
</form>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bs/js/jquery.js"></script>
    <script src="bs/js/bootstrap.min.js"></script>
  </body>
</html>
