#!/bin/bash

	echo '##### server_ip change info ####'
	date=`date +%Y/%m/%d%t%H:%M:%S`
	echo 'server time: '$date

	if [ $# -lt 1 ];then
		echo "please input ./xxx server_ip mase gatway"
		exit 1
	fi
	myPath=ifcfg-eth0

	if [  -f "$myPath" ];then
		rm "$myPath"
	fi 

	touch $myPath




	MAC=$(/sbin/ifconfig eth0|grep eth0|awk '{print $5}')

	echo "HWADDR=$MAC" >> ifcfg-eth0

	








