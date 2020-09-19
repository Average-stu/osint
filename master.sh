#!/bin/bash
#!/bin/sh
banner() {
clear
printf "\e[1;93m  made by - @Aman   \e[0m\n"
printf "\n"
}
menu() {
printf "\e[1;92m[\e[0m\e[1;77m01\e[0m\e[1;92m]\e[0m\e[1;93m Whois Lookup\e[0m\n"
printf "\e[1;92m[\e[0m\e[1;77m02\e[0m\e[1;92m]\e[0m\e[1;93m GEo-IP look up\e[0m\n"
printf "\e[1;92m[\e[0m\e[1;77m03\e[0m\e[1;92m]\e[0m\e[1;93m Grab-banner\e[0m\n"
printf "\e[1;92m[\e[0m\e[1;77m04\e[0m\e[1;92m]\e[0m\e[1;93m DNS-LOOKUP\e[0m\n"
printf "\e[1;92m[\e[0m\e[1;77m05\e[0m\e[1;92m]\e[0m\e[1;93m NMAP-PORT-SCANNER\e[0m\n"
printf "\e[1;92m[\e[0m\e[1;77m06\e[0m\e[1;92m]\e[0m\e[1;93m SUBDOMAIN-SCANNER\e[0m\n"
printf "\e[1;92m[\e[0m\e[1;77m07\e[0m\e[1;92m]\e[0m\e[1;93m SQLI-SCANNER\e[0m\n"
printf "\e[1;92m[\e[0m\e[1;77m08\e[0m\e[1;92m]\e[0m\e[1;93m ALL -THE EASY WAY  \e[0m\n"
printf "\e[1;92m[\e[0m\e[1;77m09\e[0m\e[1;92m]\e[0m\e[1;93m Find-using-username  \e[0m\n"

printf "\n"
printf "\e[1;93m[\e[0m\e[1;77m99\e[0m\e[1;93m]\e[0m\e[1;77m Exit\e[0m\n"
printf "\n"
read -p $'\e[1;92m[*] Choose an option:\e[0m\e[1;77m ' option

if [[ $option == 1 || $option == 01 ]]; then
cd api
php whois.php
elif [[ $option == 2 || $option == 02 ]]; then
cd api
php geo-ip.php
elif [[ $option == 3 || $option == 03 ]]; then
cd api
php grab-banner.php
elif [[ $option == 4 || $option == 04 ]]; then
cd api
php Dns-lookup.php
elif [[ $option == 5 || $option == 05 ]]; then
cd api
php nmap.php
elif [[ $option == 6 || $option == 06 ]]; then
cd api
php subdomain.php
elif [[ $option == 7 || $option == 07 ]]; then
cd api
php sql-vulnability.php
elif [[ $option == 8 || $option == 08 ]]; then
cd api
php all.php
elif [[ $option == 9 || $option == 09 ]]; then
cd bash/
bash username.sh




elif [[ $option  == 99 ]]; then
exit 1
else
printf "\e[5;93m[\e[1;77m!\e[0m\e[1;93m] Invalid option!\e[0m"
sleep 0.5
clear
menu
fi
}
banner
menu

