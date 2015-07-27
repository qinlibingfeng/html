<?php  
$name = $_POST['name'];  
$sex = $_POST['sex'];  
$birthday = $_POST['birthday'];  
$qq = $_POST['qq'];  
$mobile = $_POST['mobile'];  
$email = $_POST['email'];  
$address = $_POST['address'];  
//需要执行的SQL语句(这里是插入数据功能)  
/*$sql = "INSERT INTO 'addrlist' 
    ( `Name` , `Sex` , `Birthday` , `QQ` , `Mobile` , `Email` , `Address`) 
    VALUES 
    ('$name', '$sex', '$birthday', '$qq', '$mobile', '$email', '$address')"; 
//调用conn.php文件进行数据库操作 
echo $sql;*/  
$sql = "INSERT INTO `mydb`.`addrlist` (  
`Name` , `Sex` , `Birthday` , `QQ` , `Mobile` , `Email` , `Address`   
)  
VALUES (  
'$name', '$sex', '$birthday', '$qq', '$mobile', '$email', '$address'  
);";  
require('conn.php'); //将$sql交由conn.php处理了  
//提示操作成功信息，注意：$result存在于conn.php文件中，被调用出来  
if($result)  
{  
  echo '恭喜，操作成功！<p>';  
}  
?>  
