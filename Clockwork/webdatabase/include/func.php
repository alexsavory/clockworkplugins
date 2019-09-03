<?php
// A function to convert 64 BIT steamID to STEAM:ID
function steamid64convert($steamid64){
$communityid = $steamid64 ; 
$authserver = bcsub($communityid, '76561197960265728') & 1;
//Get the third number of the steamid
$authid = (bcsub($communityid, '76561197960265728')-$authserver)/2;
//Concatenate the STEAM_ prefix and the first number, which is always 0, as well as colons with the other two numbers
$steamid = "STEAM_0:$authserver:$authid";

return $steamid;
};
// A Function To convert a STEAM:ID to a 64bit id
function SteamID2CommunityID($steamid) { 
    $parts = explode(':', str_replace('STEAM_', '' ,$steamid)); 

    return bcadd(bcadd('76561197960265728', $parts['1']), bcmul($parts['2'], '2')); 
};

// A function to extract text

function extract_text($string, $start, $end)
{
$pos = stripos($string, $start);

$str = substr($string, $pos);

$str_two = substr($str, strlen($start));

$second_pos = stripos($str_two, $end);

$str_three = substr($str_two, 0, $second_pos);

$unit = trim($str_three); // remove whitespaces

return $unit;
}

// A function to check superadmin rights
function issuperadmin($id){
include('config.php');

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);
         if (empty($id)){
         	die;
         }
         if(mysqli_connect_errno()){
         	return "Error. MYSQL";
         }
$id = steamid64convert($id);
 $user = mysqli_query($conn,"SELECT * FROM players WHERE `_SteamID` = '".$id."'");
while($row = mysqli_fetch_array($user))
  {
$rank = $row['_UserGroup'];
    }
if ($rank == "superadmin") {
    $status = "1";
} else if ($rank != "superadmin") {
    $status = "0";
} else $status = "?";
return $status;
}
?>