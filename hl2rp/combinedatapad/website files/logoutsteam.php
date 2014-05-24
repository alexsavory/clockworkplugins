<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Add Report</title>

    <!-- Bootstrap core CSS -->
    <link href="bs/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bs/css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
<br>
      <form class="form-signin well">
        <h2 class="form-signin-heading">Logout</h2>
        <?php
if(isset($_SESSION['steamlogin']))
  {unset($_SESSION['steamlogin']);}
//echo "Logged Out !";
// Note: Putting echo "Logged Out !" before sending the header could result in a "Headers already sent" warning and won't redirect your page to the login page - pointed out by @Treur - I didn't spot that one.. Thanks...
echo '<div class="alert alert-info">Logged Out of Steam. <a href="index.php">Click here to login again.</a></div>';
exit();
        ?>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
