<?php 
function insert_record($table_name , $data){
	foreach($data as $key => $value)
	{
	//mysqli_real_escape_string
		$data[$key] = $db->mres($value);
	}
	
	$fields = implode(',' , array_keys($data));
	$values = "'" . implode("','" , array_values($data)) . "'";
	
	//Final query
	$query = "INSERT INTO {$table}($fields) VALUES($values)";
	
	return $db->query($query);
}

$data = array('name' => $name , 'email' => $email  , 'address' => $address , 'phone' => $phone);

insert_record('users' , $data);
 
?>