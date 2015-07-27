<?php

class up {
    
public $f_size;//定义的文件大小
public $f_sys;//接收文件属性
public $f_name;//自定义的文件名
public $f_dir;//自定义上传目录
public $is_success;//自定义上传目录

 
//参数：文件流，目录，大小，文件名
function __construct($sys,$dir="",$size="1",$name=""){
 $this->f_size=$size*1000000;
 $this->f_sys=$sys;
 $this->f_name=$name;
 $this->f_dir=$dir;
 $this->is_success=false;
 $this->f_mv();
}
 
//判断文件大小
   function is_size(){
      if($this->f_sys['size']<=$this->f_size){
   return true;
 }else{
   return false;
 }
   } //end
   
   //判断文件类型，返回扩展名
   function is_type(){ 
   //echo $this->f_sys['type'];exit;
switch($this->f_sys['type']){
case "image/x-png": $ok=".png";
break;
case "image/png": $ok=".png";
break;
case "application/pdf": $ok=".pdf";
break;
case "image/pjpeg": $ok=".jpg";
break;
case "image/jpeg": $ok=".jpg";
break;
case "image/jpg": $ok=".jpg";
break;
case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet": $ok=".xlsx";
break;
default: $ok=false;
break;
}
return $ok;
     }
   
   //终止函数
   function f_over($n){
     echo $n;
exit();
   }
   
   //判断文件夹是否存在，并创建
   function is_dirs(){
    if($this->f_dir){
if(!is_dir($this->f_dir)){ 
  mkdir($this->f_dir);
}
return $this->f_dir;
}else{
if(!is_dir(date("Ymd"))){ 
  mkdir(date("Ymd"));
}
return date("Ymd");
}
   }
   
   
   //文件名的定义，不定义而使用时间戳
   function is_name(){
      if($this->f_name){
  $fn=$this->f_name;
 }else{
  $fn=time().rand(100,999).$this->is_type();
 }
 return $this->is_dirs()."/".$fn;
   }
 
 
   //上传文件
   function f_mv(){
 $this->is_size()?null:$this->f_over("文件超过大小");
 //$this->is_type()?null:$this->f_over("文件类型不正确");;

if (move_uploaded_file($this->f_sys['tmp_name'],$this->is_name()))
{
	$this->is_success = true;
}
;

}
 
//请继续完善，水印，等等
 }
 

?>