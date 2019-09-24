<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
		<title>Server Administrators</title>
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
        
       

        $result = mysqli_query($conn,"SELECT * FROM players WHERE `_Schema` = '".$gamemodecode."' AND (_UserGroup='superadmin' OR _UserGroup='operator' OR _UserGroup='admin') ORDER BY FIELD(_UserGroup,'operator','admin','superadmin')");
		?>


		<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
  			<div class="col-md-5 p-lg-5 mx-auto my-5">
    			<h1 class="display-4 font-weight-normal">Adminstrators</h1>
    			<p class="lead font-weight-normal">Here you can view our communities Administrators, even link to the steam profile!</p>
  			</div>
  			<div class="product-device shadow-sm d-none d-md-block"></div>
  			<div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
		</div>
		<div class="container">
			<div class="row">
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">Rank</th>
              <th scope="col">Steam Name</th>
              <th scope="col">Last Played</th>
                  <?php
                  if(isset($_SESSION["steamid"])){
              if (issuperadmin($_SESSION['steamid'])){
                echo '<th scope="col"><span class="badge badge-danger">Admin Tools</span></th>';
              } 
            }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
            while($row = mysqli_fetch_array($result)){
              $steam = $row['_SteamID'];
              $parsed = SteamID2CommunityID($steam);
             if ($row['_UserGroup'] == "operator") {echo "<tr class='table-success'>";} else if ($row['_UserGroup'] == "admin") {echo "<tr class='table-warning'>";} else if ($row['_UserGroup'] == "superadmin") {echo "<tr class='table-danger'>";};

             echo "
             <td>".$row['_UserGroup']."</td>
             <td><a href='http://steamcommunity.com/profiles/$parsed'>". $row['_SteamName'] ."</a></td>
             <td>".date('r',$row['_LastPlayed'])."</td>";
             if(isset($_SESSION["steamid"])){
             if (issuperadmin($_SESSION['steamid'])){
                echo '
                <td> 
                    <form action="edit.php" method="post" style="display: inline;">
                   <input type="hidden" name="action" value="playeredit" />
                 <input type="hidden" name="key" value="'.$row['_SteamID'].'" />
                 <input type="hidden" name="admin" value="true" />
                 <button type="submit" class="btn btn-warning btn-sm">Edit Player</button>
                   </form></td>
                ';
              } 
            }

            echo " </tr>";
                    }
            ?>
          </tbody>
        </table>
       </div>
		</div>

	</body>
</html>