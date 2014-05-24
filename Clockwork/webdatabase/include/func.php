<?php
$version = "4";
	 ## FUNCTIONS


/**
* Check to see if the steam user is superadmin
* For Character managment
*/

function issuperadmin($id){
include('globalconfig.php');

$con = mysql_connect($address,$user,$pass);

if (!$con)
  {
  echo('function:issuperadmin error :'.mysql_error());
  }
mysql_select_db($database, $con);

$user = mysql_query("SELECT * FROM players WHERE `_SteamID` = '".$id."'");

while($row = @mysql_fetch_array($user))
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

/**
 * Get a web file (HTML, XHTML, XML, image, etc.) from a URL.  Return an
 * array containing the HTTP server response header fields and content.
 */
function get_web_page( $url )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
    );

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header;
}

function steamid64convert($steamid64){
$communityid = $steamid64 ; 
$authserver = bcsub($communityid, '76561197960265728') & 1;
//Get the third number of the steamid
$authid = (bcsub($communityid, '76561197960265728')-$authserver)/2;
//Concatenate the STEAM_ prefix and the first number, which is always 0, as well as colons with the other two numbers
$steamid = "STEAM_0:$authserver:$authid";

return $steamid;
};

function SteamID2CommunityID($steamid) { 
    $parts = explode(':', str_replace('STEAM_', '' ,$steamid)); 

    return bcadd(bcadd('76561197960265728', $parts['1']), bcmul($parts['2'], '2')); 
};

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

/**
*
* @package Steam Community API
* @copyright (c) 2010 ichimonai.com
* @license http://opensource.org/licenses/mit-license.php The MIT License
*
*/

class SteamSignIn
{
    const STEAM_LOGIN = 'https://steamcommunity.com/openid/login';

    /**
    * Get the URL to sign into steam
    *
    * @param mixed returnTo URI to tell steam where to return, MUST BE THE FULL URI WITH THE PROTOCOL
    * @param bool useAmp Use &amp; in the URL, true; or just &, false.
    * @return string The string to go in the URL
    */
    public static function genUrl($returnTo = false, $useAmp = true)
    {
        $returnTo = (!$returnTo) ? (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] : $returnTo;

        $params = array(
            'openid.ns'            => 'http://specs.openid.net/auth/2.0',
            'openid.mode'        => 'checkid_setup',
            'openid.return_to'    => $returnTo,
            'openid.realm'        => (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'],
            'openid.identity'    => 'http://specs.openid.net/auth/2.0/identifier_select',
            'openid.claimed_id'    => 'http://specs.openid.net/auth/2.0/identifier_select',
        );

        $sep = ($useAmp) ? '&amp;' : '&';
        return self::STEAM_LOGIN . '?' . http_build_query($params, '', $sep);
    }

    /**
    * Validate the incoming data
    *
    * @return string Returns the SteamID64 if successful or empty string on failure
    */
    public static function validate()
    {
        // Star off with some basic params
        $params = array(
            'openid.assoc_handle'    => $_GET['openid_assoc_handle'],
            'openid.signed'            => $_GET['openid_signed'],
            'openid.sig'            => $_GET['openid_sig'],
            'openid.ns'                => 'http://specs.openid.net/auth/2.0',
        );

        // Get all the params that were sent back and resend them for validation
        $signed = explode(',', $_GET['openid_signed']);
        foreach($signed as $item)
        {
            $val = $_GET['openid_' . str_replace('.', '_', $item)];
            $params['openid.' . $item] = get_magic_quotes_gpc() ? stripslashes($val) : $val;
        }

        // Finally, add the all important mode.
        $params['openid.mode'] = 'check_authentication';

        // Stored to send a Content-Length header
        $data =  http_build_query($params);
        $context = stream_context_create(array(
            'http' => array(
                'method'  => 'POST',
                'header'  =>
                    "Accept-language: en\r\n".
                    "Content-type: application/x-www-form-urlencoded\r\n" .
                    "Content-Length: " . strlen($data) . "\r\n",
                'content' => $data,
            ),
        ));

        $result = file_get_contents(self::STEAM_LOGIN, false, $context);

        // Validate wheather it's true and if we have a good ID
        preg_match("#^http://steamcommunity.com/openid/id/([0-9]{17,25})#", $_GET['openid_claimed_id'], $matches);
        $steamID64 = is_numeric($matches[1]) ? $matches[1] : 0;

        // Return our final value
        return preg_match("#is_valid\s*:\s*true#i", $result) == 1 ? $steamID64 : '';
    }
}
 ?>