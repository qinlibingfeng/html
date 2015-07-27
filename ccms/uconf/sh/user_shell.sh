#!/bin/bash

function user_check()
{
	echo '##### server info ####'
	date=`date +%Y/%m/%d%t%H:%M:%S`
	echo 'server time: '$date
	
	ip=`ifconfig | grep "inet addr" | grep -v '127.0.0.1' | awk '{print $2}' | awk -F: '{print $2}'`
	echo 'server ip: '$ip
	
	gateway=`netstat -r | grep default | awk '{print $2}'`
	echo 'server gateway: '$gateway
	
	echo '##### server ping ####'
	ping 172.17.1.1 -c 1 | grep rom
	ping 172.17.1.1 -c 1 | grep rom
	ping 172.17.1.1 -c 1 | grep rom
	
	echo '##### server check over ####'
	exit 0
	
}

#################################################################
#begin

if [ $# != 1 ];then
	echo "sh update_sh file"
	exit 1
fi


if [ $1 = "user_reboot" ];then
	reboot
	exit 0
fi


if [ $1 = "user_asterisk" ];then
	echo "restart asterisk "
	/etc/init.d/asterisk restart

	whoami
	
	exit 0
fi

if [ $1 = "user_httpd" ];then
	echo "restart httpd "
	/etc/init.d/httpd restart &&
	exit 0
fi
if [ $1 = "user_check" ];then
	user_check
	exit 0
fi



exit 0




