     <?php
	 ## FUNCTIONS
     function get_content($URL){
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_URL, $URL);
          $data = curl_exec($ch);
          curl_close($ch);
          return $data;
      };
	  
function SteamID2CommunityID($steamid) { 
    $parts = explode(':', str_replace('STEAM_', '' ,$steamid)); 

    return bcadd(bcadd('76561197960265728', $parts['1']), bcmul($parts['2'], '2')); 
} 
 ?>