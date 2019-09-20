<?php
      
require 'steamauth/steamauth.php';
include("include/config.php");
include("include/func.php");
echo '
<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
    <div class="container"><a class="navbar-brand logo" href="'.$communityurl.'">'.$communityname.'</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse"
            id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="characters.php">Characters</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="administrators.php">Administrators</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="bans.php">Bans</a></li>
            ';
if(!isset($_SESSION['steamid'])) {
echo '

  				<li class="nav-item">
    				'.loginbutton("rectangle").'
  				</li>
			</ul>




    ';

}  else {

    include ('steamauth/userInfo.php'); //To access the $steamprofile array
    echo '
			
  				<li class="nav-item">
    				<a class="nav-link" href="profile.php">Profile</a>
  				</li>

			</ul>




    ';
   

    logoutbutton(); //Logout Button
    
     if(issuperadmin($_SESSION['steamid'])){
      echo '
  &nbsp; <a href="admin.php "class="float-right badge badge-success"> Admin Tools</a>


      ';
    }
}     

            echo '
        </div>
    </div>
</nav>
';
?>
