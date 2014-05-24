<!DOCTYPE html>
<html lang="en">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">


<body>
<div class="container">
   <div class="hero-unit">
   
  <h1>Welcome!</h1>
  <p><?php include('globalconfig.php');echo $site ?>'s Flag Distribution Terminal</p>
  <p><form action="search.php" method="get">
  			<div class="input-prepend">
  <span class="add-on">Steam ID</span>
  <input class="span2" id="prependedInput" type="text" name="steamid">
			</div><p>
  <button type="submit" class="btn btn-primary">Search</button>
    </form>
  </p>
	</div>
    <hr>
    <div class="footer">
     <center>&copy; <?php echo "<a href='$url'>$site</a>" ?> | By Trurascalz and <a href='
     http://getbootstrap.com'>Bootstrap</a> </p></center>
      </div>
</div>
</body>
</html>
