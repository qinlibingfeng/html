<?
    function get_page_list($get_var,$total_record,$page_size=20,$list_len=5)
	{
		//echo $total_record;exit;
		$page = $_POST['page'];
		if($total_record!=0){
		if(!ereg("\?",$get_var)) $get_var.="?tag=0";
		if($page=="") $page=1;
		
		if($total_record%$page_size!=0)
		$total_page=ceil($total_record/$page_size);
		
		else
		$total_page=$total_record/$page_size;
		$prepage = $page-1;
		$nextpage = $page+1;
		$str .= "共".$total_record."条记录 ".$page."/".$total_page."页 ";
		if($prepage>0){
			//$str .= "<a href='".$get_var."&total_record=".$total_record."'>首页</a>\r\n";
			$nullpage = '';
			$str .= "<a href='#' onClick='submit_link(1)'>首页</a>\r\n";
			//$str .= "<a href='".$get_var."&total_record=".$total_record."&page=".$prepage."'>上一页</a>\r\n";
			$str .= "<a href='#' onClick='submit_link(".$prepage.")'>上一页</a>\r\n";
		}
		$total_list = $list_len * 2 + 1;
			if($page>=$total_list) 
			{
				$i=$page-$list_len;
				$total_list=$page+$list_len;
				if($total_list>$total_page) $total_list=$total_page;
			}	
			else
			{ 
				$i=1;
				if($total_list>$total_page) $total_list=$total_page;
			}
			for($i;$i<=$total_list;$i++)
			{
				if($i==$page) $str .= "$i ";
				//else $str .= "<a href='".$get_var."&total_record=".$total_record."&page=".$i."'>[".$i."]</a>\r\n";
				else $str .= "<a href='#' onClick='submit_link(".$i.")'>[".$i."]</a>\r\n";
			}
			if($nextpage<=$total_page){
			//$str .= "<a href='".$get_var."&page=".$nextpage."&total_record=".$total_record."'>下一页</a>\r\n";
			$str .= "<a href='#' onClick='submit_link(".$nextpage.")'>下一页</a>\r\n";
			//$str .= "<a href='".$get_var."&total_record=".$total_record."&page=".$total_page."'>未页</a>\r\n";
			$str .= "<a href='#' onClick='submit_link(".$total_page.")'>未页</a>\r\n";
		}
	   }
	   else
	   {
		$str = "没任何记录！";
	   }
	   return $str;
		
	}
	/*-----------------------计算总页数--------------------------*/
	function get_total_page($total_record,$page_size)
	{
		return ceil($total_record/$page_size);
	}
	/*---------------get_limit，返回mysql分页查询时的 limit 条件-----*/
	function get_limit($page_size)
	{
		global $page;
		$page = $_POST["page"];
		//
		if($page=="") $page=1;
		$limit_start = ($page-1)*$page_size;
		return " limit ".$limit_start.",".$page_size." ";
	}
	function test()
	{
		return "test";
	}


?>