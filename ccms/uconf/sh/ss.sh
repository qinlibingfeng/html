#!/bin/bash

echo '##### server_ip change info ####'
date=`date +%Y/%m/%d%t%H:%M:%S`
echo 'server time: '$date

if [ $# -lt 3 ];then
	echo "please input ./xxx server_ip mase gatway"
	exit 1
fi
myPath=ifcfg-eth0

if [  -f "$myPath" ];then
	rm "$myPath"
fi 

touch $myPath



echo "DEVICE=eth0" >> ifcfg-eth0
echo "BOORPROTO=yes" >> ifcfg-eth0

MAC=$(/sbin/ifconfig eth0|grep eth0|awk '{print $5}')

echo "HWADDR=$MAC" >> ifcfg-eth0

echo "TYPE=Ethernet" >> ifcfg-eth0

#echo "please input IP address:"
#read Ip_address

#echo "please input mask_address:"
#read mask_address

#echo "please input gat_address:"
#read gat_address


echo "NETMASK=$2" >> ifcfg-eth0
echo "IPADDR=$1" >> ifcfg-eth0
echo "GATEWAY=$3" >> ifcfg-eth0
echo "BOOTPROTO=none" >> ifcfg-eth0

#mv $myPath /etc/sysconfig/network-scripts/
#ifconfig eth0 $1 netmask $2 gw $3


#reboot


	
	 









