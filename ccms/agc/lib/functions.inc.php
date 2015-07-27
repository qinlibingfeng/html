<?php
function listTable($table, $fieldv, $fieldo, $selectedc, $con,$order,$link)
{
        if($con == "")
        {
                $sql = "select ".$fieldv.",".$fieldo." from ".$table." order by $order";
        }else{
                $sql = "select ".$fieldv.",".$fieldo." from ".$table." where ".$con." order by $order";
        }
	//	echo $sql;
        $res = @mysql_query($sql,$link) or die($sql.mysql_error());
		$test = 0;
        while($data = mysql_fetch_object($res))
        {
//                echo "sssssssss";
				if($data->$fieldv == $selectedc)
                {
                        echo '<option value="'.$data->$fieldv.'" selected>'.$data->$fieldo.'</option>';
                }else{
                        echo '<option value="'.$data->$fieldv.'">'.$data->$fieldo.'</option>';
                }
				$test++;
        }
		if($test == 0)
		{
                echo '<option value="0" selected>无</option>';
		}

        //mysql_free_result($res);
}

function listTableDistinct($table, $fieldv, $fieldo, $selectedc, $con)
{
        if($con == "")
        {
                $sql = "select distinct ".$fieldv.",".$fieldo." from ".$table;
        }else{
                $sql = "select distinct ".$fieldv.",".$fieldo." from ".$table." where ".$con;
        }
		echo $sql;
        $res = @mysql_query($sql) ;
		$test = 0;
        while($data = mysql_fetch_object($res))
        {
                if($data->$fieldv == $selectedc)
                {
                        echo '<option value="'.$data->$fieldv.'" selected>'.$data->$fieldo.'</option>';
                }else{
                        echo '<option value="'.$data->$fieldv.'">'.$data->$fieldo.'</option>';
                }
				$test++;
        }
		if($test == 0)
		{
                echo '<option value="0" selected>无</option>';
		}

        //mysql_free_result($res);
}

function listTableDistinctMuch($table, $fieldv, $fieldo, $selectedc, $con)
{
        if($con == "")
        {
                $sql = "select distinct ".$fieldv.",".$fieldo." from ".$table;
        }else{
                $sql = "select distinct ".$fieldv.",".$fieldo." from ".$table." where ".$con;
        }
		echo $sql;
        $res = @mysql_query($sql) ;
//		$test = 0;
        while($data = mysql_fetch_object($res))
        {
                if($data->$fieldv == $selectedc)
                {
                        echo '<option value="'.$data->$fieldv.'" selected>'.$data->$fieldo.'</option>';
                }else{
                        echo '<option value="'.$data->$fieldv.'">'.$data->$fieldo.'</option>';
                }
				$test++;
        }
}
function listTableDistinctMuchGbk2utf8($table, $fieldv, $fieldo, $selectedc, $con)
{
        if($con == "")
        {
                $sql = "select distinct ".$fieldv.",".$fieldo." from ".$table;
        }else{
                $sql = "select distinct ".$fieldv.",".$fieldo." from ".$table." where ".$con;
        }
		echo $sql;
        $res = @mysql_query($sql) ;
//		$test = 0;
        while($data = mysql_fetch_object($res))
        {
                if($data->$fieldv == $selectedc)
                {
                        echo '<option value="'.$data->$fieldv.'" selected>'.$data->$fieldo.'</option>';
                }else{
                        echo '<option value="'.$data->$fieldv.'">'.mb_convert_encoding($data->$fieldo,"utf-8","gbk").'</option>';
                }
				$test++;
        }
}


function getFieldValue($table, $field, $con)
{
        $sql = "select ".$field." from ".$table." where ".$con;
//		echo $sql;
        $resf = @mysql_query($sql) ;
        if($resf)
        {
                if($data=mysql_fetch_object($resf))
                {
                        return $data->$field;
                }
        }
		else
	   {
		 return "  ";
		}
        //mysql_free_result($res);
}

function getFieldValueUtf8($table, $field, $con)
{
        $sql = "select ".$field." from ".$table." where ".$con;
//		echo $sql;
        $resf = @mysql_query($sql) ;
        if($resf)
        {
                if($data=mysql_fetch_object($resf))
                {
                        return mb_convert_encoding($data->$field,"utf8",'gbk');
                }
        }
		else
	   {
		 return "  ";
		}
        //mysql_free_result($res);
}

function getFieldValues($table, $field, $con)
{
        $sql = "select ".$field." as tag from ".$table." where ".$con;
//		echo $sql;
        $resf = @mysql_query($sql) ;
//		print_r($resf);
        if($resf)
        {
                $str = "";
				$k = 0;
				while($data=mysql_fetch_object($resf))
                {
//                       	print_r($data);
						if($k ==0)  $str = $data->tag;
						else $str .= ", ".$data->tag;
//						return $data->$field;
						$k++;
//						echo $str;
                }
				return  $str;
        }
		else
	   {
		 return "  ";
		}
        //mysql_free_result($res);
}

function getFieldValuesSplit($table, $field, $con,$split)
{
        $sql = "select ".$field." as tag from ".$table." where ".$con;
//		echo $sql;
        $resf = @mysql_query($sql) ;
//		print_r($resf);
        if($resf)
        {
                $str = "";
				$k = 0;
				while($data=mysql_fetch_object($resf))
                {
//                       	print_r($data);
						if($k ==0)  $str = $data->tag;
						else $str .= $split.$data->tag;
//						return $data->$field;
						$k++;
//						echo $str;
                }
				return  $str;
        }
		else
	   {
		 return "  ";
		}
        //mysql_free_result($res);
}


function get_user_name($id)
{
        $name = "";
        $sql = "select sName from tbStaff where iStaffId=$id";
//		echo $sql;
        $res = @mysql_query($sql) ;
        $data = @mysql_fetch_object($res);
        if(!$data)
                return $name;

        $name = $data->sName;
        @mysql_free_result($res);
        return $name;
}


function getFieldTime($table, $field, $con)
{		 
        $sql = "select convert(varchar(15),$field, 102)+' '+convert(varchar(20),$field, 108) as time1 from ".$table." where ".$con;
//		echo $sql;
        $resf = @mysql_query($sql) ;
        if($resf)
        {
                if($data=mysql_fetch_object($resf))
                {
                        return str_replace(".","-",$data->time1);
                }
        }
		else
	   {
		 return "  ";
		}
        //mysql_free_result($res);
}


function set_error($str)
{
        echo '<script language="javascript">
             alert("'.$str.'");
        window.location.href = "javascript:history.back(-1);"
        </script>';
        exit;
}

function set_finish($str, $url)
{
        echo '<script language="javascript">
             alert("'.$str.'");
        window.location.href ="'.$url.'";
        </script>';
        exit;
}

function set_alert($str)
{
        echo '<script language="javascript">
             alert("'.$str.'");
        </script>';
//        exit;
}

function substr_cut($str_cut,$length = 30)
{  
	$str_cut = iconv("UTF-8", "gb2312", $str_cut);
	if (strlen($str_cut) > $length)
	{ 
		for($i=0; $i < $length; $i++) 
	   	if (ord($str_cut[$i]) > 128) $i++; 
  		$str_cut = substr($str_cut,0,$i) . "..."; 
		
	} 
	$str_cut = iconv("gb2312", "UTF-8", $str_cut);
	return $str_cut; 
} 

function substr_cut2($str_cut,$length = 30)
{  
	$str_cut = iconv("UTF-8", "gb2312", $str_cut);
	if (strlen($str_cut) > $length)
	{ 
		for($i=0; $i < $length; $i++) 
	   	if (ord($str_cut[$i]) > 128) $i++; 
  		$str_cut = substr($str_cut,0,$i) ; 
		
	} 
	$str_cut = iconv("gb2312", "UTF-8", $str_cut);
	return $str_cut; 
}

function NextMonth($dStarDate) 
{
	 $dOldTime = $dStarDate;
	 $Hi = date(" H:i",strtotime($dStarDate));
	 $iOne = date("Ym",strtotime($dOldTime));
	 $iTwo = date("Ym",strtotime("+1month $dOldTime"));
	 $dEndDate = date("Y-m-d",strtotime("+1month $dOldTime"));

	 $PeriodOne = date("t",strtotime("$dOldTime"));
	 if(($iTwo - $iOne) == 2)
	 {
		 $iTempDay = date("t",strtotime("+3day $dOldTime"));
		 $iTempYMonth = date("Y-m",strtotime("+3day $dOldTime")); 
		 if($iTempDay < $PeriodOne)
			$dEndDate = $iTempYMonth."-".$iTempDay;
		 else
			$dEndDate = $iTempYMonth."-".date("j",strtotime("$dOldTime"));
	 }
	 return $dEndDate.$Hi;
}