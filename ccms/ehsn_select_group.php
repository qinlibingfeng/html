<?php
	session_start();
	$pre_url	= "http://10.201.209.200/ehsn/et1/ui/internet/cti/screens";

	$option_type		= $_GET['nodeid'];
	$option_value		= $_GET['parentnodeid'];

	//$getCustomerPhoneNumber = $pre_url."/getOrganization.jsp?nodeid=208&parentnodeid=20";
	$getCustomerPhoneNumber = $pre_url."/getOrganization.jsp";
	$arr_job = file($getCustomerPhoneNumber);
	//var_dump($arr_job);


class Tree
{
       public $data=array();
       public $cateArray=array();
      
       function Tree()
       {
            
       }
       function setNode ($id, $parent, $value)
{
       $parent = $parent?$parent:0;
       $this->data[$id]             = $value;
       $this->cateArray[$id]        = $parent;
}
function getChildsTree($id=0)
{
         $childs=array();
         foreach ($this->cateArray as $child=>$parent) 
         {
                   if ($parent==$id) 
                   {
                        $childs[$child]=$this->getChildsTree($child);
                   }
                  
         }
         return $childs;
}
function getChilds($id=0)
{
         $childArray=array();
         $childs=$this->getChild($id);
         foreach ($childs as $child) 
         {
                   $childArray[]=$child;
                   $childArray=array_merge($childArray,$this->getChilds($child));
         }
         return $childArray;
}
function getChild($id)
{
         $childs=array();
         foreach ($this->cateArray as $child=>$parent) 
         {
                   if ($parent==$id) 
                   {
                        $childs[$child]=$child;
                   }
         }
         return $childs;
}
//单线获取父节点
function getNodeLever($id)
{
         $parents=array();
         if (key_exists($this->cateArray[$id],$this->cateArray)) 
         {
                   $parents[]=$this->cateArray[$id];
                   $parents=array_merge($parents,$this->getNodeLever($this->cateArray[$id]));
         }
         return $parents;
}
function getLayer($id,$preStr='|-')
{
         return str_repeat($preStr,count($this->getNodeLever($id)));
}
function getValue ($id)
{
       return $this->data[$id];
} // end func
}

$Tree = new Tree("请选择分类");
$str_agent = array();	

	foreach($arr_job  as $key => $xml_value)
	{
		//print_r($xml_value);
		if(trim($xml_value) != '' && trim($xml_value) != '</EOF>')
		{
//			print_r($xml_value);
			$xml = simplexml_load_string( iconv("gbk", "UTF-8", $xml_value));
//			$xml = simplexml_load_string( $xml_value);

			/* Search for <a><b><c> */
			$result = $xml->xpath('C1');
			//print_r($result);
			while(list( , $node) = each($result)) {
//				echo 'C1: ',$node,"\n<hr>";
				$c1		= $node;
				
			}

			$result = $xml->xpath('C3');
			//print_r($result);
			while(list( , $node) = each($result)) {
//				echo 'C2: ',$node,"\n<hr>";
				$c2		= $node;
			}

			$result = $xml->xpath('C2');
			while(list( , $node) = each($result)) {
				$c3		= $node;
			}
					
			
			
			
			$result = $xml->xpath('C5');
			
			while(list( , $node) = each($result)) {
				$c5		= $node;
			}
			
				//$Tree->setNode(trim($c1), trim($c2), '<input type="radio" name="RadioGroup_type" alt="'.$c3.'" value="'.$c5.'" onclick="getAgent(this)" />'."$c3");
				$Tree->setNode(trim($c1), trim($c2), "$c3");
			$temp = 0;
			if(trim($c1) != 208 && trim($c1) != 1){
				
				foreach(explode(",",$c5	) as $items){
					$temp = $temp+10000;
					if(!empty($items)){
						
						$Tree->setNode($temp + $c1, trim($c1), $items);
					}
				}
			}

		}
		
	}
	$dept10 = str_replace(",,", ",", implode(",", $str_agent[10]));
	$dept20 = str_replace(",,", ",", implode(",", $str_agent[20]));
	//$Tree->setNode(10, 1, '<input type="radio" name="RadioGroup_type" value="'.$dept10.'" onclick="getAgent(this)" alt="通路事业部" />'."通路事业部");
	//$Tree->setNode(20, 1, '<input type="radio" name="RadioGroup_type" value="'.$dept20.'" onclick="getAgent(this)" alt="支持事业部" />'."支持事业部");
	$Tree->setNode(2081, 1, '<input type="radio" name="RadioGroup_type" value="'.$dept20.'" onclick="getAgent(this)" alt="呼叫中心" />'."呼叫中心");
	
		//var_dump($str_agent[20]);
		
$category = $Tree->getChilds();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<style type="text/css">
.menu_list {
	width: 250px;
}
.menu_head {
	padding: 8px 10px;
	cursor: pointer;
	position: relative;
	margin:1px;
    font-weight:bold;
    background: #93cdff;
}
.menu_body {
	display:none;
}
.menu_body a 
{
	padding:8px 0px;
	display:block;
	color:#006699;
	background-color:#EFEFEF;
	 padding-left:10px;
	font-weight:bold;
	text-decoration:none;
}
 .menu_body a:hover {
	color:#7fb2f4;
	background-color:#dfdfdf;
	text-decoration:underline;
}
</style>
<script type="text/javascript">
 $(function(){
            $("#firstpane label:first").click(function()
            {
                //$(this).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");           
				//alert("hello");
            });
            $("#firstpane p.menu_head").mouseover(function()
            {
               $(this).css({background:"#2286c6"});
            });
            $("#firstpane p.menu_head").mouseout(function()
            {
               $(this).css({background:"#93cdff"});
            });
        });
	function getAgent(obj){
		//alert(obj.value.split(","));return false;
		var agentval = obj.value.split(",");
		var new_agent_val = "";
		for(items in agentval){
			if(agentval[items] != ""){
				if(new_agent_val == ""){
					//alert("hello");
					new_agent_val = "'"+agentval[items]+"'";
				}else{
					new_agent_val += ",'"+agentval[items]+"'";
				}
				
			}
		}
		//alert();
		//return false;
		parent.document.getElementById('selected_group').value = obj.alt;
		parent.document.getElementById('et1_group_value').value = new_agent_val;
		parent.document.getElementById('select_group_text').style.display = "none";
	}
</script>
</head>

<body>
<div id="firstpane" class="menu_list">
<?php
	foreach ($category as $key=>$id)
	{
		$lable	= $Tree->getValue($id);

		
			echo $Tree->getLayer($id, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;')."<label>
	     ".$Tree->getValue($id)."</label>\n<br>";
	  


	}
	?>
</div>
</body>
</html>
