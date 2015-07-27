<?php
//SAE数据库测试
$host = SAE_MYSQL_HOST_M;
$user = SAE_MYSQL_USER;
$pwd = SAE_MYSQL_PASS;
$db = SAE_MYSQL_DB;
$port = SAE_MYSQL_PORT;


//创建自己的数据库连接类，利用mysqli
class MyDB {
	private $link; //数据库连接标识
	private $rs; //结果集对象
	
	public function __construct($host, $user, $pwd, $dbname, $port = SAE_MYSQL_PORT, $charset = "utf8") {
		
		//实例化mysqli类
		$this -> link = new mysqli($host, $user, $pwd, $dbname, $port);
	
		//判断是否连接成功，出错直接退出，兼容PHP < 5.3.0写法
		/*if(mysqli_connect_error()) {
			$errno = mysqli_connect_errno();
			$err = mysqli_connect_error();
			die("Connect Error:" . $errno . ":" . $err);
		}*/

		//如果PHP > 5.3.0可以这样写
		if($this -> link -> connect_error) {
			$errno = $this -> link -> connect_errno;
			$err = $this -> link -> connect_error;
			die("Connect Error:" . $errno . ":" . $err);
		}
		$this -> setCharset($charset);
	}

	//设定MySQL的传输字符集
	private function setCharset($charset) {
		//这个函数是设定字符集的首选方式，不建议使用set names ....的方式
		$this -> link -> set_charset($charset);	
	}

	//这个方法主要执行没有结果集的查询，如update,insert,delete等
	public function execute($sql) {
		return $this -> link -> query($sql);
	
	}

	//这个方法主要执行有结果集的查询，如select
	public function query($sql) {
		$this -> rs = $this -> link -> query($sql);	
	}
	
	//获取执行上条SQL语句受影响的行数
	public function getAffectedRows() {
		return $this -> link -> affected_rows;	
	}

	//获取结果集
	public function getResult($all=false, $type = MYSQLI_ASSOC) {
		if(!$all) {
			//仅获取一条记录		
			return $this -> rs -> fetch_array($type);
		} else {
			//获取全部记录
			return $this -> rs -> fetch_all($type);	
		}
	}

	//获取上一条语句自动生成的ID
	public function getLastID() {
		return $this -> link -> insert_id;	
	}
	//查询出错，返回错误信息，主要是测试的时候用
	public function getError() {
		return "<div>Error NO: " . $this -> link -> errno . "<br />Error MSG: " . $this -> link -> error . "</div>";	
	}

	//获取服务器的信息，主要是测试的时候用
	public function getServerInfo() {
		//获取服务器连接使用的类型
		$server_info = array();
		$server_info["host_info"] = $this -> link -> host_info;
		//获取MySQL的版本
		$server_info["server_info"] = $this -> link -> server_info . "({$this -> link -> server_version})";
		var_dump($server_info);
		exit;
	}

}
//测试程序
$db = new MyDB($host, $user, $pwd, $db);
#var_dump($db -> execute("insert into demo(name, address) values('李光亮', '北京海淀')"));
$db -> query("select * from demo");
echo "<pre>";
print_r($db -> getResult(True))
?>
