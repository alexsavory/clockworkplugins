<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
		<title>Profile</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i" />
		<link rel="stylesheet" href="css/smoothproducts.css" />
	</head>
	<body>
		<?php include("header.php"); 
    if(!isset($_SESSION['steamid'])) {
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
    exit();
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
    $steamid = steamid64convert($steamprofile["steamid"]);
    $charquery = "SELECT * FROM `characters` WHERE `_SteamID` = '".$steamid."'";
    $charresult = mysqli_query($conn, $charquery);
    $playerinfo = "SELECT * FROM  `players` WHERE `_SteamID` LIKE '".$steamid."'";
    $playerinfores = mysqli_query($conn, $playerinfo);
    ?>


		<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
  			<div class="col-md-5 p-lg-5 mx-auto my-5">
    			<h1 class="display-4 font-weight-normal"><?php    echo "Welcome " . $steamprofile['personaname'] . "</br>";?></h1>
  			</div>
  			<div class="product-device shadow-sm d-none d-md-block"></div>
  			<div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
		</div>
		<div class="container">
			<div class="row">
    			<div class="col-md-8">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Character Name</th>
                  <th scope="col">Cash</th>
                  <th scope="col">Last Played</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if($charresult){
                    while ($row = mysqli_fetch_assoc($charresult)) {
                      echo "<tr>";
                      echo "<td>".$row["_Name"]."</td>";
                      echo "<td>".$row["_Cash"]."</td>";
                      echo "<td>".date("Y-m-d H:i:s", ($row["_LastPlayed"]))."</td>";
                      echo "</tr>";          
                    }
                  }
                ?>
              </tbody>
            </table>
    			</div>
    			<div class="col-md-4">
    				<div class="card border-primary mb-3" style="max-width: 18rem;">
  						<div class="card-header text-center">My Information</div>
  						<div class="card-body text-primary">
    						<ul class="list-group">
  								<?php
                  if($playerinfores){
                    while ($row = mysqli_fetch_assoc($playerinfores)) {
                      $data = $row['_Data'];
                      $whitelist = extract_text($data, '"Whitelisted":["', '"],"');
                      $your_array = explode('","', $whitelist);
                      $arrlength=count($your_array);
                      echo "<li class='list-group-item'>My Whitelists:<br>";
                      for($x=0;$x<$arrlength;$x++)
                        {
                        echo "<code>".$your_array[$x]."</code><br> ";
                        }
                      echo "</li>";  
                      echo "<li class='list-group-item'>My Rank:<br><code>".$row["_UserGroup"]."</code></li>";
                      echo "<li class='list-group-item'>Last Login:<br><code>".date("Y-m-d H:i:s", ($row["_LastPlayed"]))."</code></li>"; 
                      echo "<li class='list-group-item'>Join Date:<br><code>".date("Y-m-d H:i:s", ($row["_TimeJoined"]))."</code></li>"; 
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