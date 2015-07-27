#!/usr/bin/php -q
<?php
include_once("phpagi.php"); 
include_once("phpagi-asmanager.php");

# 实例化asterisk agi
$Asterisk_agi = new AGI();
# 初始化tid,cid变量
$tid = 0;
$cid = 0;

$tid = $Asterisk_agi->get_variable("IVRSINFO_2");
$cid = $Asterisk_agi->get_variable("IVRSINFO_1"); 
$tid = $tid["data"];
$cid = $cid["data"];
$goto_tab = "";
$host = "192.168.101.231";
$user = "ticket";
$pass = "ticket";
$port = "1521";
$db = "ticket2";
$conn = FALSE;
$orancle = new Orancle_connect($host, $user, $pass, $port);
$orancle->set_db($db);
$conn = $orancle->connect();

//var_dump($conn);
if ($conn) 
	{	
	if ($cid)
		{
		$stmtA = "SELECT VIP,SVIP from t_customer_info where CUSTOMER_ID=".$cid;
		$stid = OCIParse($conn, $stmtA);
		OCIExecute($stid, OCI_DEFAULT);
		
		while ($succ = OCIFetchInto($stid, $row)) 
			{
			$vip = $row[0];
		 	$svip = $row[1];		
			}	
		if ($svip == 2) 
			{ 
			$goto_tab = "CCVST";
			$Asterisk_agi->set_variable('TOEXTEN',$goto_tab); 
			$Asterisk_agi->verbose($goto_tab);
			exit;
			}
		if ($vip == 1) 
			{
			$goto_tab = "GSTVIP";
			$Asterisk_agi->set_variable('TOEXTEN',$goto_tab); 
			$Asterisk_agi->verbose($goto_tab);
			exit;
			}
		}
		
//    elseif($cid)
	if($tid)
		{
		$stmtA = "SELECT a.vip,a.svip from t_ticket_info t,t_customer_info a where t.customer_id = a.customer_id and t.ticket_id = $tid";
		$stid = OCIParse($conn, $stmtA);
		OCIExecute($stid, OCI_DEFAULT);
		while ($succ = OCIFetchInto($stid, $row)) 
			{
			$vip = $row[0];
		 	$svip = $row[1];
			}
			
		//根据返回值判断跳转到extension的那个标签
		if ($svip == 2)
			{
			$goto_tab = "CCVST";
			$Asterisk_agi->set_variable('TOEXTEN',$goto_tab); 
			$Asterisk_agi->verbose($goto_tab);
			exit;
			}
		if ($vip == 1)
			{
			$goto_tab = "GSTVIP";
			$Asterisk_agi->set_variable('TOEXTEN',$goto_tab); 
			$Asterisk_agi->verbose($goto_tab);
			exit;
			}
		}
	
//	 echo "VIP:".$vip." SVIP:".$svip;
//	 echo "<br/>";
//	 echo $goto_tab;
	 
	}
	

OCICommit($conn);
oci_close($conn);

class Orancle_connect
{
 private $host = "";
 private $username = "";
 private $password = "";
 private $port = 1521;
 public  $dbname = "";
 private $conn = FALSE;
 
 function __construct($host=NULL, $user=NULL, $pass=NULL, $port=1521)
 	{
	if(!is_null($host)) { $this->host = trim($host); }
 	if(!is_null($user)) { $this->username = trim($user); }
	if(!is_null($pass)) { $this->passowrd = trim($pass); }
	if(is_int($port)) { $this->prot = int($port); }	
	}
  
  private function __clone() {}
   
  public function set_db($dbname=NULL)
  	{
	if(!is_null($dbname)) $this->dbname = $dbname;
	}
  
  private function get_db()
  	{
	return $this->dbname;
	}

  public function connect()
  	{
    if(!is_null($this->host) && !is_null($this->username) && !is_null($this->password) && is_int($this->port) && !is_null($this->get_db())) 
		{ 
		$db="(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=".$this->host.")(PORT=".$this->port.")))(CONNECT_DATA=(SERVICE_NAME=".$this->get_db().")))";
		$conn = OCILogon($this->username, $this->passowrd, $db, 'zhs16gbk');
		//	$conn = OCILogon($username, $password, $db, 'zhs16gbk');
		//	echo $this->host."|".$this->username."|".$this->passowrd."|".$this->port."|".$this->get_db();
		//  var_dump($conn);
		return $conn;
		}
	}
}























?>
