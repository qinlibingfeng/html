#!/bin/bash

proc_name="asterisk";




while true
do

proc_count=`ps aux | grep $proc_name | grep -v grep | grep -v safe | grep -v ".sh"| grep -v screen | wc -l`

if [ $proc_count -lt 1 ]; then

	echo "asterisk reboot at:" `date +%Y/%m/%d%t%H:%M:%S`  >> /var/www/html/ws/asterisk_safe.log
	
	service asterisk start

fi

sleep 10
done


