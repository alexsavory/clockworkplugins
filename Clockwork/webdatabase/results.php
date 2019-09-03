<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
		<title>Results</title>
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
         if(!isset($_SESSION['steamid'])) {
    echo '<meta http-equiv="refresh" content="0;url=index.php?e=session">';
    exit();
    } 
    if (issuperadmin($_SESSION['steamid']) == "0"){
echo '<meta http-equiv="refresh" content="0;url=index.php?e=admin">';
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
        $search = ltrim(rtrim($_POST["searchvalue"]));
if($_POST["action"] ==  "player"){
  $charsearch = "false";
   if(preg_match("/STEAM/", $search)){
      $query1 = "SELECT COUNT(*) As total_records FROM `players` WHERE `_STEAMID` LIKE '%$search%'";
      $query2 = "SELECT * FROM `players` WHERE `_STEAMID` LIKE '%$search%' LIMIT $offset, $total_records_per_page";
      $querydesc = "Searching for all <b>players</b> where 'STEAMID' is like <code>$search</code>";
    
   } else {
      $query1 = "SELECT COUNT(*) As total_records FROM `players` WHERE `_SteamName` LIKE '%$search%'";
      $query2 = "SELECT * FROM `players` WHERE `_SteamName` LIKE '%$search%' LIMIT $offset, $total_records_per_page";
            $querydesc = "Searching for all <b>players</b> where 'STEAM NAME' is like <code>$search</code>";
    }
  } elseif($_POST["action"] == "character")
  
  {
    $charsearch = "true";
    if(preg_match("/STEAM/", $search)){
      $query1 = "SELECT COUNT(*) As total_records FROM `characters` WHERE `_STEAMID` LIKE '%$search%'";
      $query2 = "SELECT * FROM `characters` WHERE `_STEAMID` LIKE '%$search%' LIMIT $offset, $total_records_per_page";
      $querydesc = "Searching for all <B>characters</b> where 'STEAMID' is like <code>$search</code>";
    
   } else {
      $query1 = "SELECT COUNT(*) As total_records FROM `characters` WHERE `_Name` LIKE '%$search%'";
      $query2 = "SELECT * FROM `characters` WHERE `_Name` LIKE '%$search%' LIMIT $offset, $total_records_per_page";
      $querydesc = "Searching for all <B>characters</b> where 'STEAM NAME' is like <code>$search</code>";
    }
  } else {
          die("<div class='position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light'><div class='container'><div class='alert alert-info'>No results, <a href='admin.php'>go back</a></div></div></div>");
 
  }

        $result_count = mysqli_query($conn,$query1);
        $total_records = mysqli_fetch_array($result_count);
        $total_records = $total_records['total_records'];
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total pages minus 1

        $result = mysqli_query($conn,$query2);
        if(mysqli_num_rows($result)==0) {

          die("<div class='position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light'><div class='container'><div class='alert alert-info'>No results, <a href='admin.php'>go back</a></div></div></div>");
        }
  
		?>


		<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
  			<div class="col-md-5 p-lg-5 mx-auto my-5">
    			<h1 class="display-4 font-weight-normal">Results</h1>
    			<p class="lead font-weight-normal"><?php echo $querydesc;?></p>
  			</div>
  			<div class="product-device shadow-sm d-none d-md-block"></div>
  			<div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
		</div>
		<div class="container">
			<div class="row">
        <table class="table table-sm">
          <thead>
            <tr>
              <?php if($charsearch == "true") {
                echo '<th scope="col">Character Name</th>';
              }?>
              <th scope="col">Steam ID</th>
              <th scope="col">Steam Name</th>
              <th scope="col">Last Played</th>
              <?php
              if (issuperadmin($_SESSION['steamid'])){
                echo '<th scope="col"><span class="badge badge-danger">Admin Tools</span></th>';
              } 
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
            while($row = mysqli_fetch_array($result)){
              $steam = $row['_SteamID'];
              $parsed = SteamID2CommunityID($steam);
             echo "<tr>";
             if($charsearch == "true") {
                echo "<td>".$row['_Name']."</td>";
              }
             echo "
             <td>".$row['_SteamID']."</td>
             <td><a href='http://steamcommunity.com/profiles/$parsed'>". $row['_SteamName'] ."</a>
            </td>
             <td>".date('r',$row['_LastPlayed'])."</td>";
              if (issuperadmin($_SESSION['steamid'])){
                echo '
                <td>                     <form action="edit.php" method="post" style="display: inline;">
                   <input type="hidden" name="action" value="playeredit" />
                 <input type="hidden" name="key" value="'.$row['_SteamID'].'" />
                 <input type="hidden" name="admin" value="true" />
                 <button type="submit" class="btn btn-warning btn-sm">Edit Player</button>
                   </form></td>
                ';
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