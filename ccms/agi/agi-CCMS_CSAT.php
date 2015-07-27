#! /usr/bin/php -q
<?php
set_time_limit(60);
ob_implicit_flush(false);
include("phpagi.php");
include("dbconnect.php");
$agi=new AGI;
//$agi->answer();
// Get channels variables
$csat_path="/var/lib/asterisk/sounds/";

$csatname=$agi->request["agi_calleridname"];

$meetme=$agi->request["agi_rdnis"];

$src_uniqueid=$agi->request["agi_uniqueid"];

/*
foreach($src_uniqueid as $key=>$vals)
	{
	$agi->verbose("$key=>$vals");
	}
*/
//get csat name

    //get csat csat_id ending_audio_file option_count csat_timout csat_repeat csat_timeout_prompt csat_invalid_prompt
       $sql="select csat_id,ending_audio_file,csat_timeout,csat_repeat,csat_timeout_prompt,csat_invalid_prompt,campaign_id,csat_voicemail from ccms_csats where csat_name='".$csatname."'";
	$agi->verbose($sql);       
	$res=mysql_query($sql,$link);
       $rows=mysql_fetch_object($res);
		$csat_id=$rows->csat_id;
		$ending_audio_file=$rows->ending_audio_file;
		$csat_timeout=$rows->csat_timeout;
		$csat_repeat=$rows->csat_repeat;
		$csat_timeout_prompt=$rows->csat_timeout_prompt;
		$csat_invalid_prompt=$rows->csat_invalid_prompt;
		$campaign_id=$rows->campaign_id;
		$csat_voicemail=$rows->csat_voicemail;
   //get csat project
	$sql_project="select csat_item_id from ccms_csat_item where csat_id='".$csat_id."'";
	$agi->verbose($sql_project);
        $result_project=mysql_query($sql_project,$link);
	$csat_item_id=mysql_num_rows($result_project);
   //get user_name
        $sql_user="select user from vicidial_live_agents where conf_exten = '$meetme'";
        $agi->verbose($sql_user);
	$res=mysql_query($sql_user,$link);
       	$rows=mysql_fetch_object($res);
        $username=$rows->user;
//put projectname to array and disconnect db
  $array_project=array();
  for($i=0;$i<$csat_item_id;$i++)
      {
       $row_project=mysql_fetch_object($result_project);
       $array_project[$i]=$row_project->csat_item_id;
       $agi->verbose("-----array_project[".$i."]=".$array_project[$i]);
      }


// start the project records.
foreach($array_project as $project_cc)
 {
       $repeatcount=1;
do
  {

  	$sql_audio="select option_count,audio_file from ccms_csat_items where csat_item_id='".$project_cc."'";
  	$agi->verbose($sql_audio);
	$res=mysql_query($sql_audio,$link);
  	$rows=mysql_fetch_object($res);
  	$audio_file=$rows->audio_file;
	$option_count=$rows->option_count;
  	$agi->verbose($audio_file,$option_count);
  	$agi->stream_file($csat_path.$audio_file);

//input repeat
  do
    {
      $res_dtmf=$agi->get_data("beep",$csat_timeout,1);
      $res_num=$res_dtmf["result"];

      if($res_num=='')
       {
	     $res_num=-1;
	     $tmp_res_num=0;

         $u_sql="insert into ccms_csat_result(csat_id,csat_item_id,csat_result,uniqueid,user_name) values('".$csat_id."','".$project_cc."','".$tmp_res_num."','".$src_uniqueid."','".$username."')";
         $agi->verbose($u_sql);
	 mysql_query($u_sql,$link);

		  break; 
        }else{
		      $agi->say_digits($res_num);
				$agi->verbose("res_num=".$res_num);
		}

       if($res_num>=1 && $res_num<=$option_count && $res_num<>'')
        {

         $u_sql="insert into ccms_csat_result(csat_id,csat_item_id,csat_result,uniqueid,user_name) values('".$csat_id."','".$project_cc."','".$res_num."','".$src_uniqueid."','".$username."')";
         $agi->verbose($u_sql);
	 mysql_query($u_sql,$link);

		    break;
         }
       if($res_num<1 || $res_num>$option_count)
         {
           $agi->stream_file($csat_path.$csat_invalid_prompt);
           $repeatcount++;
          }
       if($repeatcount>$csat_repeat)
         {
           $agi->stream_file($csat_path.$csat_timeout_prompt);
          }

        }while($repeatcount<$csat_repeat+1);
 $repeatcount++;
 }while ($res_num=='*');
// end foreach
}
// end if($link)

$agi->stream_file($csat_path.$ending_audio_file);
// Goto Voicemail
if($csat_voicemail=='1')
{
   //get Campaign Voicemail

	$sql_voicemail="select voicemail_ext from vicidial_campaigns where campaign_id ='".$campaign_id."'";
        $agi->verbose($sql_voicemail);
	$res=mysql_query($sql_voicemail,$link);
        $rows=mysql_fetch_object($res);
        $voicemail_ext=$rows->voicemail_ext;
	$voicemailnum="Voicemail ".$voicemail_ext;
	$agi->exec($voicemailnum);
}


?>
