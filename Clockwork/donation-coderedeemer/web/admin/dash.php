<?php session_start();
include('../config.php');
if (!isset($_SESSION['steamlogin'])) {
  header('Location:index.php');
}
if (!in_array($_SESSION['steamlogin'], $admins)) {
  header('Location:../index.php');
}
function get_new_key(){
    $keycharacters = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $key = "";
    for($i = 0; $i < 10; $i++){
      $key .= $keycharacters[rand(0,strlen($keycharacters)-1)];
    }
    return $key;
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
.lead { font-size: 33px;margin-bottom:0px; }
    </style>
  </head>
  <body>
    
   <div class="container">

<div class="page-header">

  <h1><a href='<?php echo $communityurl;?>'><?php echo $communityname;?></a><small> Admin Dashboard</small></h1>
</div>
        <div class="container">
          <div class="btn-group btn-group-justified">
             <div class="btn-group">
   <a class="btn btn-default" href="dash.php" role="button">Dashboard</a>
  </div>
  <div class="btn-group">
   <a class="btn btn-success" href="?action=new" role="button">Add new Key</a>
  </div>
  <div class="btn-group">
    <a class="btn btn-warning" href="?action=disable" role="button">Disable Key</a>
  </div>
  <div class="btn-group">
    <a class="btn btn-info" href="?action=enable" role="button">Enable Key</a>
  </div>
  <div class="btn-group">
    <a class="btn btn-primary" href="?action=logout" role="button">Logout</a>
  </div>
</div>
<hr>
      <?php
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
if (isset($_GET['action'])) {
  if ($_GET['action'] == "new") {
    if ($_GET['processed'] == 1) {

      $packageid = $_POST['packageid'];
      $packageid = $mysqli->real_escape_string($packageid);

      $packagename = $_POST['packagename'];
      $packagename = $mysqli->real_escape_string($packagename);

      $cost = $_POST['cost'];
      $cost = $mysqli->real_escape_string($cost);

      $email = $_POST['email'];
      $email = $mysqli->real_escape_string($email);

      $newkey = get_new_key();
      $transid = mt_rand();

      $insertkey = "INSERT INTO `activationkeys` (`ID`, `transid`, `activationkey`, `used`, `type`, `package`) VALUES (NULL, '".$transid."', '".$newkey."', '0', '".$packageid."', '".$packagename."');";
      $result = $mysqli->query($insertkey) or die($mysqli->error.__LINE__);

      $inserttrans = "INSERT INTO `notifications` (`ID`, `item_name`, `item_number`, `payment_status`, `payment_amount`, `payment_currency`, `transaction_id`, `receiver_email`, `payer_email`) VALUES (NULL, '".$packagename."', '".$packageid."', 'MANUAL', '".$cost."', 'USD', '".$transid."', 'MANUAL', '".$email." ');";
      $result2 = $mysqli->query($inserttrans) or die($mysqli->error.__LINE__);


    }
   echo '
   <form class="form-horizontal" action="dash.php?action=new&processed=1" method="post">
<fieldset>

<!-- Form Name -->
<legend>Add new key</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="packageid">Package ID</label>  
  <div class="col-md-1">
  <input id="packageid" name="packageid" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="packagename">Package Name</label>  
  <div class="col-md-5">
  <input id="packagename" name="packagename" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cost">Cost</label>  
  <div class="col-md-2">
  <input id="cost" name="cost" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email</label>  
  <div class="col-md-4">
  <input id="email" name="email" type="text" placeholder="" class="form-control input-md" required="">
  <span class="help-block">Email of the receiver</span>  
  </div>
</div>


</fieldset>
<input type="submit" class="btn btn-info "value="Submit">
</form>

';
  }
  if ($_GET['action'] == "disable") {
    if ($_GET['processed'] == 1) {
      $key = $_POST['key'];
      $key = $mysqli->real_escape_string($key);

      $insertkey = "UPDATE `activationkeys` SET `used` = '1' WHERE `activationkey` = '".$key."'";
      $result = $mysqli->query($insertkey) or die($mysqli->error.__LINE__);
    }
    echo '
<form class="form-horizontal" action="dash.php?action=disable&processed=1" method="post" >
<fieldset>

<!-- Form Name -->
<legend>Disable Key</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="key">Key</label>  
  <div class="col-md-4">
  <input id="key" name="key" type="text" placeholder="" class="form-control input-md" required=""><br>
    <input type="submit" class="btn btn-info "value="Submit">
  </div>
</div>

</fieldset>
</form>

    ';
  }
  if ($_GET['action'] == "enable") {
    if ($_GET['processed'] == 1) {
      $key = $_POST['key'];
      $key = $mysqli->real_escape_string($key);

      $insertkey = "UPDATE `activationkeys` SET `used` = '0' WHERE `activationkey` = '".$key."'";
      $result = $mysqli->query($insertkey) or die($mysqli->error.__LINE__);
    }
    echo '
<form class="form-horizontal" action="dash.php?action=enable&processed=1" method="post" >
<fieldset>

<!-- Form Name -->
<legend>Enable Key</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="key">Key</label>  
  <div class="col-md-4">
  <input id="key" name="key" type="text" placeholder="" class="form-control input-md" required=""><br>
    <input type="submit" class="btn btn-info "value="Submit">
  </div>
</div>

</fieldset>
</form>

    ';
  }
   if ($_GET['action'] == "logout") {
    session_destroy();
    echo'<script type="JavaScript>window.location.reload()</script>';
   }
} else {

// A QUICK QUERY ON A FAKE USER TABLE
  $query = "SELECT * FROM activationkeys t1 JOIN notifications t2 ON t2.transaction_id = t1.transid";
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);

// GOING THROUGH THE DATA
  echo "<table class='table table-striped'>
<tr>
<th>Package ID</th>
<th>Package</th>
<th>Cost</th>
<th>Code</th>
<th>Status</th>
<th>Email</th>
<th>Transaction ID</th>
</tr>";
  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if ($row['used'] == 0) {
    echo "<tr class='success'>";
  } else if ($row['used'] == 1) {
   echo "<tr class='danger'>";
  }
    echo "<td>" . $row['item_number'] . "</td>";
  echo "<td>" . $row['package'] . "</td>";
  echo "<td>" . $row['payment_amount'] . "</td>";
  echo "<td>" . $row['activationkey'] . "</td>";
  if ($row['used'] == 0) {
    echo "<td>Unredeemed</td>";
  } else if ($row['used'] == 1) {
   echo "<td>Redeemed</td>";
  }
  
  echo "<td>" . $row['payer_email'] . "</td>";
  echo "<td>" . $row['transid'] . "</td>";
  echo "</tr>";
  }
echo "</table>";
  }
  else {
    echo 'NO RESULTS';  
  }

}

  
// CLOSE CONNECTION
  mysqli_close($mysqli);
      ?>

      </div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>