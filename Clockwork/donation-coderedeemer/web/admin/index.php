<?php session_start();
require('func.php');

if (isset($_SESSION['steamlogin'])) {
  $steam_login_verify = $_SESSION['steamlogin'] ;
}
else {$steam_login_verify = SteamSignIn::validate();}

if(!empty($steam_login_verify))
{
	$_SESSION['steamlogin'] = $steam_login_verify;
echo "<h1>Welcome. <a href=dash.php>Continue</a></h1>";
}
else
{
$steam_sign_in_url = SteamSignIn::genUrl();

echo '

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don\'t actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin well" role="form">
        <h2 class="form-signin-heading">Please Login.</h2>
        <a href="'.$steam_sign_in_url.'"><img src="http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_large_noborder.png" /></a>
      <p><a href="http://steampowered.com">Powered By Steam</a></p>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>


';
echo "";
}






?>

