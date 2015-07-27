#! /bin/sh
cd /var/spool/asterisk/monitorDONE/
find . -name "*.wav" -mtime +35 -exec rm {} \;
