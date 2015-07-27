#!/bin/bash

function xtarfile()
{
	if [ ! -f $1 ];then
		echo "file not found:"$1
		return 1
	fi
	
	if [ ${1:0-4} = "des3" ];then
		#tar xvf $1 -C $src_path > /dev/null
		dd if=$1 |openssl des3 -d -k dongjiekeji123|tar zxf -
		return $?
	fi	
	
	if [ ${1:0-4} = "des1" ];then
		dd if=$1 |openssl des -d -k dongjiekeji123|tar zxf - 
		return $?
	fi	

	echo "unknow file ext :"${1:0-3}
	return 1
	
}

#################################################################
###tar -zcvf - path_sh.sh path_sh.tar|openssl des3 -salt -k dongjiekeji123 | dd of=path_sh.des3
#begin
src_path="/var/www/html/ccms/uconf/attachment/path/"


if [ $# != 1 ];then
	echo "sh update_sh file"
	exit 1;
fi

cd $src_path
cd ..

if [ ! -f $1 ];then
	echo "file not found:"$1
	exit 1
fi


pwd
mv -f $1 $src_path

cd $src_path

xtarfile $1

if [ $? != 0 ];then
	echo "xtar file error "
	exit 1
fi

sh path_sh.sh


rm $src_path/* -fr

exit 0




