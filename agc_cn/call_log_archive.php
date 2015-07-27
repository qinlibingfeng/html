<?php
require("dbconnect.php");

//replace info 如果存在primary or unique相同的记录，则先删除掉。再插入新记录
/*
insert ignore into testtb(id,name,age)values(1,"aa",13); 
select * from testtb;//仍是1，“bb”,13，因为id是主键，出现主键重复但使用了ignore则错误被忽略 
replace into testtb(id,name,age)values(1,"aa",12); 
select * from testtb; //数据变为1,"aa",12
*/

$stmtA = "INSERT IGNORE INTO call_log_archive SELECT * from call_log;";

$stmtA = "DELETE FROM call_log WHERE start_time < '$del_time';";

$stmtA = "optimize table call_log;";

$stmtA = "DELETE from call_log_archive where channel LIKE 'Local/9%' and extension not IN('8365','8366','8367','8368','8369','8370','8371','8372','8373','8374') and caller_code LIKE 'V%' and length_in_sec < 75 and start_time < '$del_time';";

$stmtA = "optimize table call_log_archive;";
 

$stmtA = "INSERT IGNORE INTO vicidial_log_archive SELECT * from vicidial_log;";

$stmtA = "DELETE FROM vicidial_log WHERE call_date < '$del_time';";

$stmtA = "optimize table vicidial_log;";

$stmtA = "optimize table vicidial_log_archive;";
 

$stmtA = "DELETE FROM server_performance WHERE start_time < '$del_time';";
$stmtA = "optimize table server_performance;";


$stmtA = "INSERT IGNORE INTO vicidial_agent_log_archive SELECT * from vicidial_agent_log;";

$stmtA = "DELETE FROM vicidial_agent_log WHERE event_time < '$del_time';";
 
$stmtA = "optimize table vicidial_agent_log;";

$stmtA = "optimize table vicidial_agent_log_archive;";


$stmtA = "INSERT IGNORE INTO recording_log_archive SELECT * from recording_log;";

$stmtA = "DELETE FROM recording_log WHERE start_time < '$del_time';";
 
$stmtA = "optimize table recording_log;";

$stmtA = "optimize table recording_log_archive;";



$stmtA = "INSERT IGNORE INTO vicidial_carrier_log_archive SELECT * from vicidial_carrier_log;";

$stmtA = "DELETE FROM vicidial_carrier_log WHERE call_date < '$del_time';";

$stmtA = "optimize table vicidial_carrier_log;";

$stmtA = "optimize table vicidial_carrier_log_archive;";
		 
	 
$stmtA = "INSERT IGNORE INTO data_ask_result_archive SELECT * from data_ask_result;";

$stmtA = "DELETE FROM data_ask_result WHERE call_date < '$del_time';";

$stmtA = "optimize table data_ask_result;";

$stmtA = "optimize table data_ask_result_archive;";
		 


mysql_close($link);
?>

