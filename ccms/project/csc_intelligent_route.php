<?php
$num=$_GET["num"];

$link=connectdb();
if($link)
{
$sql_num="select leadaddressid from vtiger_leadaddress where mobile ='".$num."'";
$res=mysql_query($sql_num,$link);
$rows=mysql_fetch_object($res);
$leadaddressid=$rows->leadaddressid;

$sql_rating="select rating from vtiger_leaddetails where leadid ='".$leadaddressid."'";
$res=mysql_query($sql_rating,$link);
$rows=mysql_fetch_object($res);
$rating=$rows->rating;

echo "$rating";
}
function connectdb(){
        mysql_query("SET NAMES utf8;");
    $conn=mysql_connect("10.201.107.82","root","anlaigz");
if(!$conn)
  {
    return false;
  }
else
   {
     if(!mysql_select_db("crm_default",$conn))
       {
        return false;
       }
      else
          {
           mysql_query("set names utf8",$conn);
           return $conn;
          }
   }

}
?>
