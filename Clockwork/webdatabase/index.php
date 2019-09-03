<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
		<title>Home - Clockwork Web Database</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i" />
		<link rel="stylesheet" href="css/smoothproducts.css" />
	</head>
	<body>
		<?php 

		include("header.php"); 

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
        
        // Perform All SQL Queries

        $todays_date = date("Y-m-d H:i:s");
		$today = strtotime($todays_date);
		$banquery = "SELECT * FROM  `bans` ORDER BY  `bans`.`_Key` DESC LIMIT 0 ,6";
		$banresult = mysqli_query($conn, $banquery);
		$charquery = "SELECT * FROM `characters` ORDER BY `characters`.`_Key` DESC LIMIT 0,6";
		$charresult = mysqli_query($conn, $charquery);

        mysqli_close($conn);


		?>


		<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
  			<div class="col-md-5 p-lg-5 mx-auto my-5">
    			<h1 class="display-4 font-weight-normal">Welcome!</h1>
    			<p class="lead font-weight-normal">Here you can view our communities characters, admins and check the latest bans. If you login you can even check your own characters!</p>
    			<?php 
    			if(!isset($_SESSION['steamid'])) {
    			loginbutton("rectangle");

    			}  else {
    			    logoutbutton(); //Logout Button
    			}   

    			if(isset($_GET["m"])){
    				if($_GET["m"] == "Success_Edit_Char"){
    					echo '
    					 <div class="alert alert-success" role="alert">
            				Character Data Updated.
        				 </div>
    					';
    				}elseif($_GET["m"] == "Success_Edit_Ply"){
    					echo '
    					 <div class="alert alert-success" role="alert">
            				Player Data Updated.
        				 </div>
    					';
    				}elseif($_GET["m"] == "Ban_BadTime"){
    					echo '
    					 <div class="alert alert-warning" role="alert">
            				Unable to update ban, the time provided was invalid.
        				 </div>
    					';
    				}elseif($_GET["m"] == "Success_Ban_Edit"){
    					echo '
    					 <div class="alert alert-success" role="alert">
            				Ban Data Updated.
        				 </div>
    					';
    				}elseif($_GET["m"] == "Success_Ban_Delete"){
    					echo '
    					 <div class="alert alert-success" role="alert">
            				Ban Deleted.
        				 </div>
    					';
    				}
    			}  
    			?>
  			</div>
  			<div class="product-device shadow-sm d-none d-md-block"></div>
  			<div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
		</div>
		<div class="container">
			<div class="row">
    			<div class="col-md-6">
    				<div class="card border-success mb-3">
  						<div class="card-header text-center">New Characters</div>
  						<div class="card-body text-success">
    						<ul class="list-group">
  								<?php
  								if($charresult){
  									while ($row = mysqli_fetch_assoc($charresult)) {

        								echo "<li class='list-group-item'>".$row["_Name"]." - ".$row["_SteamName"]."</li>";
    								}
  								}
  								?>
  								
							</ul>
  						</div>
					</div>
    			</div>
    			<div class="col-md-6">
    				<div class="card border-danger mb-3">
  						<div class="card-header text-center">New Bans</div>
  						<div class="card-body text-danger">
    						<ul class="list-group">
  								<?php
  								if($banresult){
  									while ($row = mysqli_fetch_assoc($banresult)) {
  										if ($row["_UnbanTime"] == "0"){
  											echo "<li class='list-group-item list-group-item-danger'>".$row['_SteamName']." - <span class='badge badge-danger'>Permanent Ban</span></li>";
  										}
  										elseif ($row["_UnbanTime"] < $today){
  											echo "<li class='list-group-item list-group-item-success'>".$row['_SteamName']." - <span class='badge badge-primary'>" . date("Y-m-d H:i:s", ($row["_UnbanTime"])). "</span>  <span class='badge badge-primary'>Unbanned</span></li>";
  										} else {
  											echo "<li class='list-group-item list-group-item-warning'>".$row['_SteamName']." - <span class='badge badge-primary'>" . date("Y-m-d H:i:s", ($row["_UnbanTime"])). "</span>  <span class='badge badge-primary'>Banned</span></li>";
  										}
    								}
  								}
  								?>
							</ul>
  						</div>
					</div>
    			</div>
			</div>
		</div>

	</body>
</html>