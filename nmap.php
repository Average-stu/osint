<?php
error_reporting(0);
require 'functions.php';
require 'var.php';
echo $cln;

if (extension_loaded('curl') || extension_loaded('dom'))
  {
  }
else
  {
    if (!extension_loaded('curl'))
      {
        echo $bold . $red . "\n[!] cURL Module Is Missing! Try 'fix' command OR Install php-curl" . $cln;
      }
    if (!extension_loaded('dom'))
      {
        echo $bold . $red . "\n[!] DOM Module Is Missing! Try 'fix' command OR Install php-xml\n" . $cln;
      }
  }
start:
echo "\n";
userinput("Enter The Website You Want To Scan ");
$ip = trim(fgets(STDIN, 1024));
if ($ip == "help")
  {
    echo "\n\n[+] Help Screen [+] \n\n";
    echo $bold . $lblue . "Commands\n";
    echo "========\n";
    echo $fgreen . "[1] help:$cln View The Help Menu\n";
    echo $bold . $fgreen . "[2] fix:$cln Installs All Required Modules (Suggested If You Are Running The Tool For The First Time)\n";
    echo $bold . $fgreen . "[3] URL:$cln Enter The Domain Name Which You Want To Scan (Format:www.sample.com / sample.com)\n";
    goto start;
  }
elseif ($ip == "fix")
  {
    echo "\n\e[91m\e[1m[+]  FiX MENU [+]\n\n$cln";
    echo $bold . $blue . "[+] Checking If cURL module is installed ...\n";
    if (!extension_loaded('curl'))
      {
        echo $bold . $red . "[!] cURL Module Not Installed ! \n";
        echo $yellow . "[*] Installing cURL. (Operation requires sudo permission so you might be asked for password) \n" . $cln;
        system("sudo apt-get -qq --assume-yes install php-curl");
        echo $bold . $fgreen . "[i] cURL Installed. \n";
      }
    else
      {
        echo $bold . $fgreen . "[i] cURL is already installed, Skipping To Next \n";
      }
    echo $bold . $blue . "[+] Checking If php-XML module is installed ...\n";
    if (!extension_loaded('dom'))
      {
        echo $bold . $red . "[!] php-XML Module Not Installed ! \n";
        echo $yellow . "[*] Installing php-XML. (Operation requires sudo permission so you might be asked for password) \n" . $cln;
        system("sudo apt-get -qq --assume-yes install php-xml");
        echo $bold . $fgreen . "[i] DOM Installed. \n";
      }
    else
      {
        echo $bold . $fgreen . "[i] php-XML is already installed, You Are All SET ;) \n";
      }
    echo $bold . $fgreen . "[i] Job finished successfully! Please Restart  \n";
    exit;
  }
elseif (strpos($ip, '://') !== false)
  {
    echo $bold . $red . "\n[!] (HTTP/HTTPS) Detected In Input! Enter URL Without Http/Https\n" . $CURLOPT_RETURNTRANSFER;
    goto start;
  }
elseif (strpos($ip, '.') == false)
  {
    echo $bold . $red . "\n[!] Invalid URL Format! Enter A Valid URL\n" . $cln;
    goto start;
  }
elseif (strpos($ip, ' ') !== false)
  {
    echo $bold . $red . "\n[!] Invalid URL Format! Enter A Valid URL\n" . $cln;
    goto start;
  }
else
  {
    echo "\n";
    userinput("Enter 1 For HTTP OR Enter 2 For HTTPS");
    echo $cln . $bold . $fgreen;
    $ipsl = trim(fgets(STDIN, 1024));
    if ($ipsl == "2")
      {
        $ipsl = "https://";
      }
    else
      {
        $ipsl = "http://";
      }

{
  $reallink = $ipsl . $ip;
            $lwwww    = str_replace("www.", "", $ip);
            echo "\n$cln" . $lblue . $bold . "[+] Scanning Begins ... \n";
            echo $blue . $bold . "[i] Scanning Site:\e[92m $ipsl" . "$ip \n";
            echo $bold . $yellow . "[S] Scan Type : Nmap Port Scan" . $cln;
            echo $bold . $lblue . "\n[~] Port Scan Result: \n\n" . $cln;
            $urlnmap    = "http://api.hackertarget.com/nmap/?q=" . $lwwww;
            $resultnmap = readcontents($urlnmap);
            echo $bold . $fgreen . $resultnmap;
            echo "\n\n";
            echo $bold . $yellow . "[*] Scanning Complete. Press Enter To Continue OR CTRL + C To Stop\n\n";
            trim(fgets(STDIN, 1024));
                                }
            }
?>
