#! /usr/local/php/bin/php -q
<?php
set_time_limit(60);
ob_implicit_flush(false);
include("phpagi.php");
$agi=new AGI;
$agi->answer();
// Get source channels variables
$survey_path="/var/lib/asterisk/sounds/ivrs/DYX/";
$maxretrys=3;

$temp_uniqueid=$agi->get_variable("SRC_UNIQUEID");
$src_uniqueid=$temp_uniqueid['data'];
//$agi->verbose("src_uniqueid=".$src_uniqueid);

$temp_surveyname=$agi->get_variable("surveyname");
$surveyid=$temp_surveyname['data'];
//$agi->verbose("surveyname=".$surveyname);


//play music lang
//; 1 - Cantonese zh_HK
//; 2 - Manderine zh_CN
//; 3 - English   en_US

//get survey Project
$conn=db_conn();
if ($conn)
   {
   //get survey Langid and survey name

       $sql="select surveyname,surveylang from ccms_csc_surveyobj where id=".$surveyid;
       $res=mysql_query($sql,$conn);
       $rows=mysql_fetch_object($res);
       $src_LANGID=$rows->surveylang;
	   $surveyname=$rows->surveyname;
	   
   //get survey project
	$sql_project="select surveyproject from ccms_csc_ccsurvey where surveyname='".$surveyname."'";
        $result_project=mysql_query($sql_project,$conn);
	$projectsum=mysql_num_rows($result_project);
//put projectname to array and disconnect db
  $array_project=array();
  for($i=0;$i<$projectsum;$i++)
      {
       $row_project=mysql_fetch_object($result_project);
       $array_project[$i]=$row_project->surveyproject;
      }
   }
  mysql_close($conn);

 switch($src_LANGID)
     {
     case '1':
       $LANGNAME="zh_HK";
       break;
     case '2':
       $LANGNAME="zh_CN";
        break;
     default:
       $LANGNAME="en_US";
       break;
     }

   $surveyproject_path=$survey_path.$surveyname."/".$LANGNAME."/";
   $agi->stream_file($surveyproject_path."1");
// start the project records.
foreach($array_project as $project_cc)
 {
       $repeatcount=1;
do
  {
    $agi->stream_file($surveyproject_path.$project_cc);

//input repeat
  do
    {
      $res_dtmf=$agi->get_data(beep,5000,1);
      $res_num=$res_dtmf["result"];
      $agi->say_digits($res_num);
      if($res_num=='')
       {
	     $res_num=-1;
         $conn=db_conn();
         mysql_query($u_sql,$conn);
         mysql_close($conn);
		  break;
        }

       if($res_num>=1 && $res_num<=4 && $res_num<>'')
        {
          //update input data.
         $conn=db_conn();
         $u_sql="insert into ccms_csc_surveyresult(uniqueid,surveyname,surveyproject,surveyvalue) values('".$src_uniqueid."','".$surveyname."','".$project_cc."',".$res_num.")";
         mysql_query($u_sql,$conn);
         mysql_close($conn);
		  break;
         }
       if($res_num<1 || $res_num>4)
         {
           $agi->stream_file($surveyproject_path."6");
           $repeatcount++;
          }
       if($repeatcount>$maxretrys)
         {
           $agi->stream_file($surveyproject_path."5");
          }

        }while($repeatcount<$maxretrys+1);
      $repeatcount++;
 }while ($res_num=='*');

// end foreach
}
// end if($conn)


$agi->stream_file($surveyproject_path."4");


function db_conn(){
    $conn=mysql_connect("127.0.0.1","root","anlaigz");
if(!$conn)
  {
    return false;
  }
else
   {
     if(!mysql_select_db("vicidial",$conn))
       {
        return false;
       }
      else
          {
           mysql_query("set names gb2312",$conn);
           return $conn;
          }
   }

}

?>
