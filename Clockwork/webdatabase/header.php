


<div class="masthead">
        <h3 class="muted"><?php define('CHANGEME', TRUE); include('include/globalconfig.php'); include('include/func.php'); 

		echo "<a href='$website'>$site's </a>";

		echo $game ?>

<div style="float: right">
  <?php
if (isset($_SESSION['steamlogin'])) {
  $steam_login_verify = $_SESSION['steamlogin'] ;
}
else {$steam_login_verify = SteamSignIn::validate();}

if(!empty($steam_login_verify))
{
//echo "success + $steam_login_verify <br>";
$_SESSION['steamlogin'] = $steam_login_verify;
$_SESSION['steamname'] = steamid64convert($steam_login_verify);
// Lets get player information since we have the SteamID now.
$xml = simplexml_load_file('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='.$apikey.'&steamids='.$_SESSION['steamlogin'].'&format=xml');
  // Set the session variable
$steampersona = $xml->players->player->personaname;
$hi = array('Hey', 'Hi', 'Howdy', 'Aloha', 'Bonjour', 'Shalom', 'What\'s up', 'Good day');
  echo 
  '
<div class="btn-group">
                <button class="btn dropdown-toggle btn-info" data-toggle="dropdown"><b>'.$hi[array_rand($hi)].' '.$steampersona.' </b><span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><center>My Options</center></li>
                  <li><a href="mycharacters.php"><i class="icon-user"></i> My Characters</a></li>
                  <li><a href="myinfo.php"><i class="icon-info-sign"></i> My Information</a></li>';
         
        $convertedsteamid = steamid64convert($steam_login_verify);
         if (issuperadmin($convertedsteamid) == "1") 
        {
echo '
<li class="divider"></li>
<li><center>Admin Options</center></li>
<li><a href="players.php"><i class="icon-user"></i><b>Players</b></a></li>
';


        }
                  echo '
                  <li class="divider"></li>
                  <li><a href="logout.php"><i class="icon-off"></i><b> Logout</b></a></li>
                </ul>
              </div>
  ';


}
else
{
$steam_sign_in_url = SteamSignIn::genUrl();
echo "<a href=\"$steam_sign_in_url\"><img src='http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_large_noborder.png' /></a>";
}
?>
</div>
  </h3>
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
              <ul class="nav"><?php
                if(basename($_SERVER['PHP_SELF']) == 'index.php') {echo '<li class="active"><a href="#">Home</a></li> <title>Dashboard</title>';} else {echo '<li><a href="index.php">Home</a></li>';}
                if(basename($_SERVER['PHP_SELF']) == 'characters.php') {echo '<li class="active"><a href="#">All Characters</a></li><title>All Characters</title>';} else {echo '<li><a href="characters.php">All Characters</a></li>';}
                if((basename($_SERVER['PHP_SELF']) == 'search.php') || (basename($_SERVER['PHP_SELF']) == 'results.php')) {echo '<li class="active"><a href="#">Search</a></li><title>Search</title>';} else {echo '<li><a href="search.php">Search</a></li>';}
                if(basename($_SERVER['PHP_SELF']) == 'administrators.php') {echo '<li class="active"><a href="#">Administration Team</a></li><title>Administration Team</title>';} else {echo '<li><a href="administrators.php">Administration Team</a></li>';}
if(basename($_SERVER['PHP_SELF']) == 'bans.php') {echo '<li class="active"><a href="#">Bans</a></li><title>Bans</title>';} else {echo '<li><a href="bans.php">Bans</a></li>';}

if(basename($_SERVER['PHP_SELF']) == 'credits.php') {echo '<title>Credits</title>' ;}
				?>
              </ul>
             
            </div>

          </div>

          
        </div><!-- /.navbar -->
        <center></center>
      </div>