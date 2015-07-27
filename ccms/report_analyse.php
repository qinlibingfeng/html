<?php 
# report_analyse.php


$version = '2.2.0-52';
$build = '100303-0930';

header ("Content-type: text/html; charset=utf-8");

require("dbconnect_report.php");

if (isset($_GET["reportpath"]))			{$reportpath = $_GET["reportpath"];}
	elseif (isset($_POST["reportpath"]))	{$reportpath = $_POST["reportpath"];}
	
if (isset($_GET["reportname"]))			{$reportname = $_GET["reportname"];}
	elseif (isset($_POST["reportname"]))	{$reportname = $_POST["reportname"];}
	
if (isset($_GET["startdate"]))			{$startdate = $_GET["startdate"];}
	elseif (isset($_POST["startdate"]))	{$startdate = $_POST["startdate"];}
	
if (isset($_GET["enddate"]))			{$enddate = $_GET["enddate"];}
	elseif (isset($_POST["enddate"]))	{$enddate = $_POST["enddate"];}	


#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin FROM system_settings;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysql_num_rows($rslt);
if ($qm_conf_ct > 0)
	{
	$row=mysql_fetch_row($rslt);
	$non_latin =					$row[0];
	}
	
if ($non_latin > 0) { $rslt=mysql_query("SET NAMES 'UTF8'");}

$reporttime = date("Y-m-d H:i:s",time());
$ipaddress  = get_ip();

$sql = "insert into ccms_report_analyse(path,reportfile,reporttime,starttime,endtime,ipaddress) values('$reportpath','$reportname','$reporttime','$startdate','$enddate','$ipaddress');";

if ( !mysql_query($sql,$link)){
     file_put_contents("report_analyse.log", $reporttime ." error :" . $sql . "\r\n",FILE_APPEND);
}


//多得真实IP
function get_ip()
{
    static $realip = NULL;

    if ($realip !== NULL)
    {
        return $realip;
    }

    if (isset($_SERVER))
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
            foreach ($arr AS $ip)
            {
                $ip = trim($ip);

                if ($ip != 'unknown')
                {
                    $realip = $ip;

                    break;
                }
            }
        }
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else
        {
            if (isset($_SERVER['REMOTE_ADDR']))
            {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
            else
            {
                $realip = '0.0.0.0';
            }
        }
    }
    else
    {
        if (getenv('HTTP_X_FORWARDED_FOR'))
        {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif (getenv('HTTP_CLIENT_IP'))
        {
            $realip = getenv('HTTP_CLIENT_IP');
        }
        else
        {
            $realip = getenv('REMOTE_ADDR');
        }
    }

    preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
    $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

    return $realip;
}
