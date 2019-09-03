<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
		<title>Admin Tools</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i" />
		<link rel="stylesheet" href="css/smoothproducts.css" />
	</head>
	<body>
		<?php 

		include("header.php"); 
    if(!isset($_SESSION['steamid'])) {
    echo '<meta http-equiv="refresh" content="0;url=index.php?e=session">';
    exit();
    } 
    if (issuperadmin($_SESSION['steamid']) == "0"){
echo '<meta http-equiv="refresh" content="0;url=index.php?e=admin">';
              } 
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);
   
         if(mysqli_connect_errno()){
         	echo '
         	<div class="container">

         		<div class="alert alert-danger" role="alert">
  					We are having trouble connecting. Please Contact the Administrator.
  					<code>'.mysqli_connect_error().'</code>
				</div>
			</div>


         	';

            die();
         }
        


		?>


		<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
  			<div class="col-md-5 p-lg-5 mx-auto my-5">
    			<h1 class="display-4 font-weight-normal">Admin tools!</h1>
    			<p class="lead font-weight-normal">Some Admin search tools are below:</p>
    			
  			</div>
  			<div class="product-device shadow-sm d-none d-md-block"></div>
  			<div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>

		</div>
		<div class="container">
      <?php
        if(issuperadmin($_SESSION['steamid'])){
      echo '
Search Player By SteamID / Steam Name
  <form class="form-inline my-2 my-lg-0" action="results.php" method="post">
                     <input type="hidden" name="action" value="player" />
      <div class="input-group mb-3">
  <input required type="text" class="form-control" name="searchvalue" placeholder="SteamID/SteamName" aria-label="" aria-describedby="button-addon2">
  <div class="input-group-append">
    <button  type="submit" class="btn btn-outline-secondary" type="button" id="button-addon2">&gt;</button>
  </div>
</div>
    </form> &nbsp
Search For Character By Character Name or SteamID
    <form class="form-inline my-2 my-lg-0" action="results.php" method="post">
                     <input type="hidden" name="action" value="character" />
      <div class="input-group mb-3">
  <input required type="text" class="form-control" name="searchvalue" placeholder="Character Name" aria-label="" aria-describedby="button-addon2">
  <div class="input-group-append">
    <button  type="submit" class="btn btn-outline-secondary" type="button" id="button-addon2">&gt;</button>
  </div>
</div>
    </form>


      ';
    }
        ?>
		</div>

	</body>
</html>