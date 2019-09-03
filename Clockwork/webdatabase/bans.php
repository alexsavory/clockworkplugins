<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
		<title>Bans</title>
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
        
       date_default_timezone_set(''.$GMT.'');
       $todays_date = date("Y-m-d H:i:s");
$today = strtotime($todays_date);

        $result = mysqli_query($conn,"SELECT * FROM bans WHERE `_Schema` = '".$gamemodecode."' ORDER BY _key");
		?>


		<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
  			<div class="col-md-5 p-lg-5 mx-auto my-5">
    			<h1 class="display-4 font-weight-normal">Ban Log</h1>
    			<p class="lead font-weight-normal">Here you can view our communities bans, even link to the steam profile!</p>

          <?php
  print '<div class="alert alert-info">Current Date/Time : <b>' . date("<big>m/d/y G.i:s A</big><br>", time()) . '</b><br><b>(For Comparison)<br> Timezone:'. $GMT .'</b></div>';
          ?>
  			</div>
  			<div class="product-device shadow-sm d-none d-md-block"></div>
  			<div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
		</div>
		<div class="container">
			<div class="row">
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Unban At</th>
              <th scope="col">Duration</th>
              <th scope="col">Reason</th>
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
              $steam = $row['_Identifier'];
$parsed = SteamID2CommunityID($steam);
    if ($row['_UnbanTime'] == '0') {
   echo "<tr class='table-danger'>"; 
     } else if ( $row['_UnbanTime'] < $today ){
       echo "<tr class='table-success'>"; 
   } else {
       echo "<tr class='table-warning'>"; 
   }

  echo "<td><a href='http://steamcommunity.com/profiles/$parsed'>". $row['_SteamName'] ."</a></td>";
  if ($row['_UnbanTime'] == '0') 
     {
   echo "<td><span class='badge badge-danger'>Permanent Ban</span></td>"; 
     }
      else
     {
  if ( $row['_UnbanTime'] < $today )
        {
        echo "<td><span class='badge badge-success'>" . date("Y-m-d H:i:s", ($row["_UnbanTime"])). "</span></td>";
      }
        else
          {
        echo "<td><span class='badge badge-warning'>" . date("Y-m-d H:i:s", ($row["_UnbanTime"])). "</span></td>";    
          }
     }
   if ($row['_Duration'] == '0') 
     {
   echo "<td><span class='badge badge-important'>Permanent Ban</span></td>"; 
     }
      else  echo "<td><span class='badge badge-warning'>" . date('G \h\o\u\r\s i \m\i\n\u\t\e\s', ($row["_Duration"])). "</span></td>"; 
  echo "<td>" . $row['_Reason'] . "</td>";
   if(isset($_SESSION["steamid"])){
              if (issuperadmin($_SESSION['steamid'])){
                echo '
                <td> <form action="edit.php" method="post" style="display: inline;">
                    <input type="hidden" name="action" value="banedit" />
                  <input type="hidden" name="key" value="'.$row['_Key'].'" />
                  <input type="hidden" name="admin" value="true" />
                  <button type="submit" class="btn btn-warning btn-sm">Edit Ban</button>
                    </form>
                    </td>
                ';
              } 
            }
                    }
            ?>
          </tbody>
        </table>
       </div>
		</div>

	</body>
</html>