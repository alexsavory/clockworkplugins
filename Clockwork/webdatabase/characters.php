<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
		<title>Characters</title>
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
        if (isset($_GET['page_no']) && $_GET['page_no']!="") {
             $page_no = $_GET['page_no'];
             } else {
                 $page_no = 1;
        }
        $offset = ($page_no-1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = "2";
        $result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM `characters`");
        $total_records = mysqli_fetch_array($result_count);
        $total_records = $total_records['total_records'];
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total pages minus 1

        $result = mysqli_query($conn,"SELECT * FROM `characters` LIMIT $offset, $total_records_per_page");
		?>


		<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
  			<div class="col-md-5 p-lg-5 mx-auto my-5">
    			<h1 class="display-4 font-weight-normal">Characters</h1>
    			<p class="lead font-weight-normal">Here you can view our communities characters, even link to the steam profile!</p>
          <?php
          if(isset($_SESSION["steamid"])){
                      if(issuperadmin($_SESSION['steamid'])){
      echo '

  <form class="form-inline my-2 my-lg-0" action="results.php" method="post">
                     <input type="hidden" name="action" value="player" />
      <div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="SteamID/SteamName" aria-label="" aria-describedby="button-addon2">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button" id="button-addon2">&gt;</button>
  </div>
</div>
    </form> &nbsp

    <form class="form-inline my-2 my-lg-0" action="results.php" method="post">
                     <input type="hidden" name="action" value="character" />
      <div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Character Name" aria-label="" aria-describedby="button-addon2">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button" id="button-addon2">&gt;</button>
  </div>
</div>
    </form>


      ';
    }}
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
             echo "<tr>
             <td>".$row['_Name']."</td>
             <td><a href='http://steamcommunity.com/profiles/$parsed'>". $row['_SteamName'] ."</a>
            </td>
             <td>".date('r',$row['_LastPlayed'])."</td>";
             if(isset($_SESSION["steamid"])){
              if (issuperadmin($_SESSION['steamid'])){
                echo '
                <td> <form action="edit.php" method="post" style="display: inline;">
                    <input type="hidden" name="action" value="charedit" />
                  <input type="hidden" name="key" value="'.$row['_Key'].'" />
                  <input type="hidden" name="admin" value="true" />
                  <button type="submit" class="btn btn-warning btn-sm">Edit Character</button>
                    </form>
                    <form action="edit.php" method="post" style="display: inline;">
                   <input type="hidden" name="action" value="playeredit" />
                 <input type="hidden" name="key" value="'.$row['_SteamID'].'" />
                 <input type="hidden" name="admin" value="true" />
                 <button type="submit" class="btn btn-warning btn-sm">Edit Player</button>
                   </form></td>
                ';
              } 
            }

             echo "
             </tr>";
                    }
            ?>
          </tbody>
        </table>
        <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
          <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
        </div>

        <nav>
        <ul class="pagination">
  <?php // if($page_no > 1){ echo "<li class='page-item'><a class='page-link' href='?page_no=1'>First Page</a></li>"; } ?>
    
  <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
  <a class='page-link' <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
  </li>
       
    <?php 
  if ($total_no_of_pages <= 10){     
    for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
      if ($counter == $page_no) {
       echo "<li class='active'><a class='page-link' class='page-link'>$counter</a></li>";  
        }else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
        }
        }
  }
  elseif($total_no_of_pages > 10){
    
  if($page_no <= 4) {     
   for ($counter = 1; $counter < 8; $counter++){     
      if ($counter == $page_no) {
       echo "<li class='active'><a class='page-link'>$counter</a></li>";  
        }else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
        }
        }
    echo "<li class='page-item'><a class='page-link'>...</a></li>";
    echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
    echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
    }

   elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {     
    echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
    echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
        echo "<li class='page-item'><a class='page-link'>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {     
           if ($counter == $page_no) {
       echo "<li class='active'><a class='page-link'>$counter</a></li>";  
        }else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
        }                  
       }
       echo "<li class='page-item'><a class='page-link'>...</a></li>";
     echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
     echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
    
    else {
        echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
    echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
        echo "<li class='page-item'><a class='page-link'>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
       echo "<li class='active'><a class='page-link'>$counter</a></li>";  
        }else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
        }                   
                }
            }
  }
?>
    
  <li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
  <a class='page-link' <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
  </li>
    <?php if($page_no < $total_no_of_pages){
    echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
    } ?>
</ul></nav>

			</div>
		</div>

	</body>
</html>