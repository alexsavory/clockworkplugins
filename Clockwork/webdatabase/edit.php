<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
		<title>Edit Details</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i" />
		<link rel="stylesheet" href="css/smoothproducts.css" />
	</head>
	<body>
		<?php include("header.php"); 
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
    $key = mysqli_escape_string($conn,$_POST["key"]);


    if ($_POST['action'] == "charedit") {

    $charquery = "SELECT * FROM `characters` WHERE `_key` = '".$key."'";
    $charresult = mysqli_query($conn, $charquery);
    
  
echo '

		<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
  			<div class="col-md-5 p-lg-5 mx-auto my-5">
    			<h1 class="display-4 font-weight-normal">Character Editing</h1>

          <div class="alert alert-danger" role="alert">
            <B>IMPORTANT!</B> A player must not be logged in if you are editing their character!
          </div>
  			</div>
  			<div class="product-device shadow-sm d-none d-md-block"></div>
  			<div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
		</div>
		<div class="container">
			<div class="row">
    			<div class="col-md-8">';
          
            while($row = mysqli_fetch_array($charresult)){
            echo '
            <form action="update.php" method="post">
<input type="hidden" name="key" value="'.$row['_Key'].'" />
<input type="hidden" name="action" value="charupdate" />
  <div class="form-group row">
    <label for="character" class="col-sm-3 col-form-label">Character Name</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="name" id="character"  value="'.$row['_Name'].'">
    </div>
    <label for="cash" class="col-sm-3 col-form-label">Cash</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="cash" id="cash"  value="'.$row['_Cash'].'">
    </div>
    <label for="Faction" class="col-sm-3 col-form-label">Faction</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="Faction" id="Faction"  value="'.$row['_Faction'].'">
    </div>
    <label for="Flags" class="col-sm-3 col-form-label">Character Flags</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="Flags" id="Flags"  value="'.$row['_Flags'].'">
    </div>
    <label for="Model" class="col-sm-3 col-form-label">Character Model</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="Model" id="Model"  value="'.$row['_Model'].'">
    </div>
  </div>
  
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </div>
</form>
                    </div>
                    <div class="col-md-4">
                      <div class="card border-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header text-center">Character Info</div>
                        <div class="card-body text-primary">
                          <ul class="list-group">
                          <li class="list-group-item">Owner:<br><code>'.$row["_SteamName"].'</code></li>
                          <li class="list-group-item">Created:<br><code>'.date('r', $row['_TimeCreated']).'</code></li>
                          <li class="list-group-item">Last Used:<br><code>'.date('r', $row['_LastPlayed']).'</code></li>
                          </ul>

            ';
         

         }//***************************************** mysql while 
         /// if character
         echo '
                      </div>
                  </div>
                  </div>
              </div>
            </div>

          </body>
         </html>



         ';
       } elseif($_POST["action"] == "playeredit") {
        
        $playerid = $_POST["key"];
 $charquery = "SELECT * FROM `players` WHERE `_SteamID` = '".$playerid."'";
    $charresult = mysqli_query($conn, $charquery);
    echo $charquery;
    echo '


    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
          <h1 class="display-4 font-weight-normal">Player Editing</h1>

          <div class="alert alert-danger" role="alert">
            <B>IMPORTANT!</B> A player must not be logged in if you are editing their profile!
          </div>
          <div class="alert alert-secondary"><b>Valid Ranks:</b><i> superadmin,admin,operator,user</i></div>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>
    <div class="container">
      <div class="row">
          <div class="col-md-8">';
     

            while($row = mysqli_fetch_array($charresult)){
            echo '
            <form action="update.php" method="post">
<input type="hidden" name="key" value="'.$row['_Key'].'" />
<input type="hidden" name="action" value="playerupdate" />
  <div class="form-group row">

    <label for="character" class="col-sm-3 col-form-label">Rank</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="Rank" id="Rank"  value="'.$row['_UserGroup'].'">
    </div>
    &nbsp;
    <div class="alert alert-warning"><b>Listen up!</b><hr> This data is not extracted, it is the original so if you don\'t know what your doing,<b>Don\'t Do it!</b><br>Here is the whitelist template:
    <code>"Whitelisted":["A Faction","Another Faction"],</code> Too add factions, place a Comma(,) after the last faction in the <code>[ ]</code> and type the faction in " ", the last faction in the list should not have a <code>,</code><hr>
    Here is the <B>Original Data</B>:<br>
    <code>
    '.htmlspecialchars($row['_Data']).'
    </code></div>
    <label for="Data" class="col-sm-1 col-form-label">Data</label>
    <div class="col-sm-11">
      <textarea type="text" class="form-control" name="Data" id="Data"  value="">'.htmlspecialchars($row['_Data']).'</textarea>
    </div>
  </div>
  <hr>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </div>
</form>
                    </div>
                    <div class="col-md-4">
                      <div class="card border-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header text-center">Info</div>
                        <div class="card-body text-primary">
                          <ul class="list-group">
                          <li class="list-group-item">Steam Name:<br><code>'.$row["_SteamName"].'</code></li>
                          <li class="list-group-item">Steam ID:<br><code>'.$row["_SteamID"].'</code></li>
                          <li class="list-group-item">Last IP:<br><code>'.$row["_IPAddress"].'</code></li>
                          <li class="list-group-item">First Joined:<br><code>'.date('r', $row['_TimeJoined']).'</code></li>
                          <li class="list-group-item">Last Joined:<br><code>'.date('r', $row['_LastPlayed']).'</code></li>
                          </ul>

            ';
       
       }
       echo '

                    </div>
                </div>
                </div>
            </div>
          </div>

        </body>
       </html>';
     } elseif($_POST["action"] == "banedit"){

        $key = $_POST["key"];
    $query = "SELECT * FROM `bans` WHERE `_Key` = '".$key."'";
    $result = mysqli_query($conn, $query);

    echo '


    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
          <h1 class="display-4 font-weight-normal">Ban Editing</h1>

          <div class="alert alert-danger" role="alert">
            <B>IMPORTANT!</B> A player must not be logged in if you are editing their ban!
          </div>
          &nbsp;
          <div class="alert alert-danger" role="alert">
            <B>IMPORTANT!</B> To Permanent Ban, Enter <code>0</code> as the unban time.
          </div>
          
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>
    <div class="container">
      <div class="row">
          <div class="col-md-8">';
     

            while($row = mysqli_fetch_array($result)){
            echo '
            <form action="update.php" method="post">
<input type="hidden" name="key" value="'.$row['_Key'].'" />
<input type="hidden" name="action" value="banupdate" />
  <div class="form-group row">

    <label class="col-sm-3 col-form-label">Unban Time</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="Unban" id="Unban"  value="'.date("Y-m-d H:i:s", ($row["_UnbanTime"])).'">
    </div>
        <label class="col-sm-3 col-form-label">Reason</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="Reason" id="Reason"  value="'.$row["_Reason"].'">
    </div>

    
  </div>
  <hr>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </div>
</form>
            <form action="update.php" method="post">
<input type="hidden" name="key" value="'.$row['_Key'].'" />
<input type="hidden" name="action" value="bandelete" />
    <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-danger"><B>Delete</b></button>
    </div>
  </div>
</form>
                    </div>
                    <div class="col-md-4">
                      <div class="card border-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header text-center">Info</div>
                        <div class="card-body text-primary">
                          <ul class="list-group">
                          <li class="list-group-item">Steam Name:<br><code>'.$row["_SteamName"].'</code></li>
                          <li class="list-group-item">Steam ID:<br><code>'.$row["_Identifier"].'</code></li>                              </ul>

            ';
       
       }
       echo '

                    </div>
                </div>
                </div>
            </div>
          </div>

        </body>
       </html>';
     }
            ?>
                    
						
  						</div>
					</div>
    			</div>
			</div>
		</div>

	</body>
</html>