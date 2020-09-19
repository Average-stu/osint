<?php
function getTitle($url) {
  $data = readcontents($url);
  $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $data, $matches) ? $matches[1] : null;
  return $title;
  }
  function userinput($message){
    global $white, $bold, $greenbg, $redbg, $bluebg, $cln, $lblue, $fgreen;
    $yellowbg = "\e[100m";
    $inputstyle = $cln . $bold . $lblue . "[#] " . $message . ": " . $fgreen ;
  echo $inputstyle;
  }
function WEBserver($urlws){
  stream_context_set_default( [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
]);
  $wsheaders = get_headers($urlws, 1);
  if (is_array($wsheaders['Server'])) { $ws = $wsheaders['Server'][0];}else{
    $ws = $wsheaders['Server'];
  }
  if ($ws == "")
    {
      echo "\e[91mCould Not Detect\e[0m";
    }
  else
    {
      echo "\e[92m$ws \e[0m";
    }
}


function cloudflaredetect($reallink){

  $urlhh    = "http://api.hackertarget.com/httpheaders/?q=" . $reallink;
  $resulthh = file_get_contents($urlhh);
  if (strpos($resulthh, 'cloudflare') !== false)
    {
      echo "\e[91mDetected\n\e[0m";
    }
  else
    {
      echo "\e[92mNot Detected\n\e[0m";
    }
}


function CMSdetect($reallink){
  $cmssc  = readcontents($reallink);
  if (strpos($cmssc, '/wp-content/') !== false)
    {
      $tcms = "WordPress";

    }
  else
    {
      if (strpos($cmssc, 'Joomla') !== false)
        {
          $tcms = "Joomla";
        }
      else
        {
          $drpurl = $reallink . "/misc/drupal.js";
          $drpsc  = readcontents("$drpurl");
          if (strpos($drpsc, 'Drupal') !== false)
            {
              $tcms = "Drupal";
            }
          else
            {
              if (strpos($cmssc, '/skin/frontend/') !== false)
                {
                  $tcms = "Magento";
                }
              else
                {
                  if (strpos($cmssc, 'content="WordPress')!== false) {
                    $tcms = "WordPress";
                  }
                  else {


                  $tcms = "\e[91mCould Not Detect";
                }
                }
            }
        }
    }
    return $tcms;
}
function robotsdottxt($reallink){
  $rbturl    = $reallink . "/robots.txt";
  $rbthandle = curl_init($rbturl);
  curl_setopt($rbthandle, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($rbthandle, CURLOPT_RETURNTRANSFER, TRUE);
  $rbtresponse = curl_exec($rbthandle);
  $rbthttpCode = curl_getinfo($rbthandle, CURLINFO_HTTP_CODE);
  if ($rbthttpCode == 200)
    {
      $rbtcontent = readcontents($rbturl);
      if ($rbtcontent == "")
        {
          echo "Found But Empty!";
        }
      else
        {
          echo "\e[92mFound \e[0m\n";
          echo "\e[36m\n-------------[ contents ]----------------  \e[0m\n";
          echo $rbtcontent;
          echo "\e[36m\n-----------[end of contents]-------------\e[0m";
        }
    }
  else
    {
      echo "\e[91mCould NOT Find robots.txt! \e[0m\n";
    }
}
function gethttpheader($reallink){
  $hdr = get_headers($reallink);
  foreach ($hdr as $shdr) {
    echo "\n\e[92m\e[1m[i]\e[0m  $shdr";
  }
  echo "\n";

}
function extractLINKS($reallink){
  global $bold, $lblue, $fgreen;
  $arrContextOptions=array(
      "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );
  $ip = str_replace("https://","",$reallink);
  $lwwww = str_replace("www.","",$ip);
  $elsc = file_get_contents($reallink, false, stream_context_create($arrContextOptions));
  $eldom     = new DOMDocument;
  @$eldom->loadHTML($elsc);
  $elinks = $eldom->getElementsByTagName('a');
  $elinks_count = 0;
  foreach ($elinks as $ec) {
    $elinks_count++;
  }
  echo $bold . $lblue . "[i] Number Of Links Found In Source Code : " . $fgreen . $elinks_count . "\n";
  userinput("Display Links ? (Y/N) ");
  $bv_show_links = trim(fgets(STDIN, 1024));
  if ($bv_show_links == "y" or $bv_show_links =="Y"){
    foreach ($elinks as $elink) {
      $elhref = $elink->getAttribute('href');
      if (strpos($elhref, $lwwww) !== false ) {
        echo "\n\e[92m\e[1m*\e[0m\e[1m $elhref";

      }
      else {
        echo "\n\e[38;5;208m\e[1m*\e[0m\e[1m $elhref";
      }
    }
    echo "\n";
  }

else {
  // not showing links.
}
}
function readcontents($urltoread){
  $arrContextOptions=array(
      "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );
    $filecntns = file_get_contents($urltoread, false, stream_context_create($arrContextOptions));
    return $filecntns;
}

function MXlookup ($site){
  $Mxlkp = dns_get_record($site, DNS_MX);
	$mxrcrd = $Mxlkp[0]['target'];
	$mxip = gethostbyname($mxrcrd);
	$mx = gethostbyaddr($mxip);
  $mxresult = "\e[1m\e[36mIP      :\e[32m " . $mxip ."\n\e[36mHOSTNAME:\e[32m " . $mx ;
  return $mxresult;
}

function bv_get_alexa_rank($url){
  $xml = simplexml_load_file("http://data.alexa.com/data?cli=10&url=".$url);
    if(isset($xml->SD)):
        return $xml->SD->POPULARITY->attributes()->TEXT;
    endif;
}
function bv_moz_info($url){
  global $bold, $red, $fgreen, $lblue, $blue;
  require ("config.php");
  if (strpos($accessID, " ") !== false OR strpos($secretKey, " ") !== false){
    echo $bold . $red . "\n[!] Some Results Will Be Omited (Please Put Valid MOZ API Keys in config.php file)\n\n";
  }
  else {
  	$expires = time() + 300;
  	$SignInStr = $accessID. "\n" .$expires;
  	$binarySignature = hash_hmac('sha1', $SignInStr, $secretKey, true);
  	$SafeSignature = urlencode(base64_encode($binarySignature));
  	$objURL = $url;
    $flags = "103079231492";
  	$reqUrl = "http://lsapi.seomoz.com/linkscape/url-metrics/".urlencode($objURL)."?Cols=".$flags."&AccessID=".$accessID."&Expires=".$expires."&Signature=".$SafeSignature;
    $opts = array(
  	    CURLOPT_RETURNTRANSFER => true
  	    );
   $curlhandle = curl_init($reqUrl);
  	curl_setopt_array($curlhandle, $opts);
  	$content = curl_exec($curlhandle);
  	curl_close($curlhandle);
  	$resObj = json_decode($content);
    echo $bold . $lblue . "[i] Moz Rank : " . $fgreen . $resObj->{'umrp'} . "\n";
  	echo $bold . $lblue . "[i] Domain Authority : " . $fgreen . $resObj->{'pda'} . "\n";
  	echo $bold . $lblue . "[i] Page Authority : " . $fgreen . $resObj->{'upa'} . "\n";
  }
}
?>
