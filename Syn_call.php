
<?php
		require('/var/www/html/mysqldb.php');
		$db = new db();
		$link = $db->connect($db_config);
		$sql="SELECT closecallid,lead_id,list_id,campaign_id,call_date,start_epoch,end_epoch, length_in_sec,status,phone_code,phone_number,user,comments,processed,user_group,xfercallid, term_reason,uniqueid,agent_only,queue_position,ring_sec FROM vicidial_closer_log where uniqueid= '1420016974.1370';";
		$campaign_row=$db->row_query_one($sql);
		if($campaign_row != NULL){
			print_r($campaign_row);
			//echo '222222222'.$campaign_row['campaign_id'];
		}
		else{
			echo "error";
		}



?>

