<?php 
require("../../inc/pub_func.php"); 
require("../../inc/pub_set.php"); 
$tits=trim($_REQUEST["tits"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>设置</title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css" />
<style> 
.dataTable img{cursor:pointer;}
.field_list a{cursor:pointer;display:inline-block;float:left;height:16px;line-height:17px;margin:2px;padding:2px 2px 2px 20px;position:relative;text-align:center;color:#333;white-space:nowrap;background:url(/images/icons/icon022a1.gif) no-repeat left center;}
.field_list a:hover{text-decoration:none;border:1px solid #F90;}
a.close{width:4px;height:4px;line-height:4px;background:url(/images/tips/tip_bg.gif) no-repeat 0 -26px;position:absolute;right:-10px;top:4px;font-size:1px;border:0;}
a.close:hover{background-position:0 -34px;border:0;}
a.field_list_1{background-color:#FFF;border:1px solid #999;}
a.field_list_2{background-color:#FC6;border:1px solid #F90;}
.field_list_div{background:#FFF;border:2px solid #0C0;display:none;margin:3px auto auto 3px;padding:2px 4px 4px;position:absolute;top:0;width:97%;z-index:100;}
.input_86{width:90%;}
.turn_img{cursor:pointer;float:left;margin-left:6px;margin-top:4px;background: url(/images/icons/up_down.gif) no-repeat -94px top;height: 14px;width: 16px;}
.turn_img img{vertical-align:middle;}
.page_main{_margin-top:-1px;}
.page_main fieldset{margin:2px 8px 8px 8px;}
.td_underline td{border-bottom: 1px dotted #ccc; height:24px;line-height:24px}
.td_underline select{*margin-top:1px}
.o_icos span{background:url(/images/icons/up_down.gif) no-repeat 2px top;display:block;height:14px;width:14px;float:left;margin-top:-2px;cursor:pointer;}
.o_icos .up_e{background-position:-30px top;}
.o_icos .up_d{background-position:-62px top;}
.o_icos .dw_e{background-position:-14px top;}
.o_icos .dw_d{background-position:-46px top;}
.o_icos .add{background-position:-78px top;}
.s_input{width:196px}
.s_option{width:202px}
#tree_list img{margin-right:2px;}
#tree_list input{margin-right:2px;}
span.gray,span.red{
	margin-left:4px
}
 
</style> 
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script>
function check_carrier(){
	if($("#carrier_id").val()!=""){
		
		if($("#carrier_id").val().length>15||$("#carrier_id").val().length<2){
			 
			request_tip("中继ID位数必须介于2-15位字符之间！",0);
			$("#carrier_id").select();
			return false;
		}
		
		var datas="action=check_carrier&carrier_id="+encodeURIComponent($("#carrier_id").val())+times;
		$.ajax({
			 
			url:"send.php",
			data:datas,
			
			async:false,
			success: function(json){
			   if(json.counts!="1"){
					request_tip(json.des,json.counts);
					$("#carrier_id").select();
			   }
			} 
		});
	}
}
 
 
</script>
       
</head>
<body>
 <input name="get_dial_status" id="get_dial_status" type="hidden" value="0" />
 
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>

<div class="field_list_div field_list" id="field_list_div"></div>

<?php
switch($action){
  
case "add_carrier":
?>

<script>

function do_add_carrier(){
 	 
	if($("#carrier_id").val() == "")
	{
		alert("请填写中继ID号！");
		$("#carrier_id").focus();
		return false;
	}else if($("#carrier_id").val().length>15||$("#carrier_id").val().length<2){
		alert("中继ID位数必须介于2-15位字符之间！");
		$("#carrier_id").select();
		return false;
	}
	
	if($("#carrier_name").val() == "")
	{
		alert("请填写中继名称！");
		$("#carrier_name").focus();
		return false;
	}else if($("#carrier_name").val().length>30||$("#carrier_name").val().length<2){
		alert("中继名称位数必须介于2-30位字符之间！");
		$("#carrier_name").select();
		return false;
	}
  	
	$('#load').show();
	var datas="action=carrier_set&do_actions=add&"+$('#form1').serialize()+times;
	//alert(datas);
	//return false;
	
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		    request_tip(json.des,json.counts);
			_DialogInstance.ParentWindow.request_tip(json.des,json.counts);
			if(json.counts=="1"){
 				 
				_DialogInstance.ParentWindow.GetPageCount($(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"count");
				_DialogInstance.ParentWindow.get_datalist($(_DialogInstance.ParentWindow.document).find("#pages").val(),$(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"list",$(_DialogInstance.ParentWindow.document).find("#pagesize").val());
 				setTimeout('Dialog.close();',10);
			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
} 

   
$(document).ready(function(){
 $('.td_underline tr:visible:odd').addClass('alt');
  
});
 
</script>
  
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">中继管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
</div>

<div class="page_main" >
            
<fieldset ><legend ><?php echo $tits ?></legend>
<form action="" method="post" name="form1" id="form1">


<table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
    <tr >
      <td width="30%" align="right">中继ID：</td>
      <td align="left"><input maxlength="15" size="30" class="s_input" name="carrier_id" id="carrier_id" onkeyup="this.value=value.replace(/[^\w\/]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/]/ig,'')" onblur="this.value=value.replace(/[^\w\/]/ig,'');check_carrier()"/><span class="red">※</span><span class="gray">15位以下数字、英文组合</span></td>
    </tr>
    <tr >
      <td align="right">中继名称：</td>
      <td align="left"><input maxlength="30" size="30" class="s_input" name="carrier_name" id="carrier_name"/><span class="red">※</span></td>
    </tr>
    <tr >
      <td align="right">中继描述：</td>
      <td align="left"><input maxlength="255" size="30" class="s_input" name="carrier_description" id="carrier_description"/></td>
    </tr>
    <tr >
      <td align="right">激活使用：</td>
      <td align="left">
       <select name="active" class="s_option" id="active">
          <option value="Y" selected="selected">启用</option>
          <option value="N">禁用</option>
        </select>
        </td>
    </tr>
    <tr >
      <td align="right">使用模板：</td>
      <td align="left">
      	<select name="template_id" class="s_option" id="template_id">
            <option value="--NONE--">不使用</option>
            <?php 
                $sql="select template_id,template_name from vicidial_conf_templates order by template_id";
                 $rows=mysqli_query($db_conn,$sql);
                $row_counts_list=mysqli_num_rows($rows);			
                
                if ($row_counts_list!=0) {
                    while($rs= mysqli_fetch_array($rows)){ 
                    	 
                        echo "<option value='".$rs["template_id"]."' title='".$rs["template_name"]."'>".$rs["template_name"]." [".$rs["template_id"]."]</option>\n";
                    }
                 
                }else {
                     
                }
                mysqli_free_result($rows);
            ?>
            
         </select><span class="gray"></span>
      
      </td>
    </tr>
    <tr >
      <td align="right">注册协议：</td>
      <td align="left">
      <select name="protocol" class="s_option" id="protocol">
          <option value="SIP" selected>SIP</option>
          <option value="Zap">Zap</option>
          <option value="IAX2">IAX2</option>
          <option value="EXTERNAL">EXTERNAL</option>
      </select>
      </td>
    </tr>
    <tr >
      <td align="right">服务器IP：</td>
      <td align="left">
      <select name="server_ip" class="s_option" id="server_ip" >
                        
		<?php 
        
            $sql="select server_ip,server_id,server_description from servers order by server_id";
            
            $rows=mysqli_query($db_conn,$sql);
            $row_counts_list=mysqli_num_rows($rows);			
            
            if ($row_counts_list!=0) {
                while($rs= mysqli_fetch_array($rows)){ 
                
                     echo "<option value='".$rs["server_ip"]."' title='".$rs["server_description"]."'>".$rs["server_id"]." [".$rs["server_ip"]."]</option>";
                }
             
            }
            mysqli_free_result($rows);
        ?>
          
    </select></td>
    </tr>
    <tr >
      <td align="right">注册字符串：</td>
      <td align="left"><input maxlength="255" size="30" class="s_input" name="registration_string" id="registration_string"/></td>
    </tr>
    <tr >
      <td align="right">全局变量：</td>
      <td align="left"><input maxlength="255" size="30" class="s_input" name="globals_string" id="globals_string"/></td>
    </tr>
    <tr >
      <td align="right">账号信息：</td>
      <td align="left"><textarea name="account_entry"  class="input_86" id="account_entry" ></textarea></td>
    </tr>
    <tr >
      <td align="right">拨号计划：</td>
      <td align="left"><textarea name="dialplan_entry"  class="input_86" id="dialplan_entry" ></textarea></td>
    </tr>    
  </table>
      </form>
    </fieldset>
    
      
</div>

<?php 

break;

case "edit_carrier":
?>
<?php

$sql="select carrier_id,carrier_name,registration_string,template_id,account_entry,protocol,globals_string,dialplan_entry,server_ip,active,carrier_description from vicidial_server_carriers where carrier_id='".$carrier_id."'  ";
//echo $sql;
$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

$list_arr=array();
 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
  		$carrier_name=$rs["carrier_name"];
 		$carrier_id=$rs["carrier_id"];
 		$active=$rs["active"];
		$registration_string=$rs["registration_string"];
  		$template_id=$rs["template_id"];
		$account_entry=$rs["account_entry"];
		$protocol=$rs["protocol"];
  		$globals_string=$rs["globals_string"];
 		$dialplan_entry=$rs["dialplan_entry"];
  		$server_ip=$rs["server_ip"];
 		$carrier_description=$rs["carrier_description"];
   		 
    }
 	echo "<script>$(document).ready(
	function(){
     		
 		$('.td_underline tr:visible:odd').addClass('alt');
 		$('#active').val('".$active."');
   		$('#protocol').val('".$protocol."');
  		$('#server_ip').val('".$server_ip."');
  		$('#template_id').val('".$template_id."');
 
	});
</script>";
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("该中继不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>

<script>
 
function do_edit_carrier(){
	
	if($("#carrier_id").val() == "")
	{
		alert("请填写中继ID号！");
		$("#carrier_id").focus();
		return false;
	}else if($("#carrier_id").val().length>15||$("#carrier_id").val().length<2){
		alert("中继ID位数必须介于2-15位字符之间！");
		$("#carrier_id").select();
		return false;
	}
	
	if($("#carrier_name").val() == "")
	{
		alert("请填写中继名称！");
		$("#carrier_name").focus();
		return false;
	}else if($("#carrier_name").val().length>30||$("#carrier_name").val().length<2){
		alert("中继名称位数必须介于2-30位字符之间！");
		$("#carrier_name").select();
		return false;
	}
   	
	$('#load').show();
	var datas="action=carrier_set&do_actions=update&"+$('#form1').serialize()+times;
   	  
 	//alert(datas);
   	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		
		 request_tip(json.des,json.counts);
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts); 
 		 if(json.counts=="1"){
			 
			$(_DialogInstance.ParentWindow.document).find("#carrier_list_<?php echo $carrier_id ?> td").eq(2).attr("title",$("#carrier_name").val()).html("<div class='hide_tit'><span class='green'>"+$("#carrier_name").val()+"</span></div>");
			$(_DialogInstance.ParentWindow.document).find("#carrier_list_<?php echo $carrier_id ?> td").eq(3).attr("title",$("#carrier_description").val()).html("<div class='hide_tit'><span class='green'>"+$("#carrier_description").val()+"</span></div>");
			
			$(_DialogInstance.ParentWindow.document).find("#carrier_list_<?php echo $carrier_id ?> td").eq(4).html("<span class='green'>"+$("#server_ip option:selected").val()+"</span>");
			$(_DialogInstance.ParentWindow.document).find("#carrier_list_<?php echo $carrier_id ?> td").eq(5).html("<span class='green'>"+$("#protocol option:selected").text()+"</span>");
   			$(_DialogInstance.ParentWindow.document).find("#carrier_list_<?php echo $carrier_id ?> td").eq(6).html("<span class='green'>"+$("#active option:selected").text()+"</span>");
  
			setTimeout('Dialog.close();',10);
		  }else{
			  alert(json.des);
		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
 }
  
</script>
 

    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">中继管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
      <fieldset >
      <legend ><?php echo $tits ?></legend>
<form action="" method="post" name="form1" id="form1">
<input type="hidden" name="carrier_id" id="carrier_id" value="<?php echo $carrier_id ?>" /> 
 
<table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
    <tr >
      <td width="30%" align="right">中继ID：</td>
      <td align="left"><strong class="blue"><?php echo $carrier_id ?></strong></td>
    </tr>
    <tr >
      <td align="right">中继名称：</td>
      <td align="left"><input maxlength="30" size="30" class="s_input" name="carrier_name" id="carrier_name" value="<?php echo $carrier_name ?>"/><span class="red">※</span></td>
    </tr>
    <tr >
      <td align="right">中继描述：</td>
      <td align="left"><input maxlength="255" size="30" class="s_input" name="carrier_description" id="carrier_description" value="<?php echo $carrier_description ?>"/></td>
    </tr>
    <tr >
      <td align="right">激活使用：</td>
      <td align="left">
       <select name="active" class="s_option" id="active">
          <option value="Y" selected="selected">启用</option>
          <option value="N">禁用</option>
        </select>
        </td>
    </tr>
    <tr >
      <td align="right">使用模板：</td>
      <td align="left">
      	<select name="template_id" class="s_option" id="template_id">
            <option value="--NONE--">不使用</option>
            <?php 
                $sql="select template_id,template_name from vicidial_conf_templates order by template_id";
                 $rows=mysqli_query($db_conn,$sql);
                $row_counts_list=mysqli_num_rows($rows);			
                
                if ($row_counts_list!=0) {
                    while($rs= mysqli_fetch_array($rows)){ 
                    	 
                        echo "<option value='".$rs["template_id"]."' title='".$rs["template_name"]."'>".$rs["template_name"]." [".$rs["template_id"]."]</option>\n";
                    }
                 
                } 
                mysqli_free_result($rows);
            ?>
            
         </select><span class="gray"></span>
      
      </td>
    </tr>
    <tr >
      <td align="right">注册协议：</td>
      <td align="left">
      <select name="protocol" class="s_option" id="protocol">
          <option value="SIP" selected>SIP</option>
          <option value="Zap">Zap</option>
          <option value="IAX2">IAX2</option>
          <option value="EXTERNAL">EXTERNAL</option>
      </select>
      </td>
    </tr>
    <tr >
      <td align="right">服务器IP：</td>
      <td align="left">
      <select name="server_ip" class="s_option" id="server_ip" >
                        
		<?php 
        
            $sql="select server_ip,server_id,server_description from servers order by server_id";
            
            $rows=mysqli_query($db_conn,$sql);
            $row_counts_list=mysqli_num_rows($rows);			
            
            if ($row_counts_list!=0) {
                while($rs= mysqli_fetch_array($rows)){ 
                
                     echo "<option value='".$rs["server_ip"]."' title='".$rs["server_description"]."' >".$rs["server_id"]." [".$rs["server_ip"]."]</option>";
                }
             
            } 
            mysqli_free_result($rows);
        ?>
          
    </select></td>
    </tr>
    <tr >
      <td align="right">注册字符串：</td>
      <td align="left"><input maxlength="255" size="30" class="s_input" name="registration_string" id="registration_string" title="<?php echo $registration_string ?>" value="<?php echo $registration_string ?>"/></td>
    </tr>
    <tr >
      <td align="right">全局变量：</td>
      <td align="left"><input maxlength="255" size="30" class="s_input" name="globals_string" id="globals_string" title="<?php echo $globals_string ?>" value="<?php echo $globals_string ?>"/></td>
    </tr>
    <tr >
      <td align="right">账号信息：</td>
      <td align="left"><textarea name="account_entry"  class="input_86" id="account_entry" ><?php echo $account_entry ?></textarea></td>
    </tr>
    <tr >
      <td align="right">拨号计划：</td>
      <td align="left"><textarea name="dialplan_entry"  class="input_86" id="dialplan_entry" ><?php echo $dialplan_entry ?></textarea></td>
    </tr>    
  </table>
      </form>
    </fieldset>
    
      
</div>
  
<?php 

break;

//复制活动
case "copy_carrier":
?>
<script>

function do_copy_carrier(){
	if($("#source_carrier_id").val() == "")
	{
		alert("请选择来源中继！");
		$("#source_carrier_id").focus();
		return false;
	}	
	
	if($("#carrier_id").val() == "")
	{
		alert("请填写中继ID号！");
		$("#carrier_id").focus();
		return false;
	}else if($("#carrier_id").val().length>15||$("#carrier_id").val().length<2){
		alert("中继ID位数必须介于2-15位字符之间！");
		$("#carrier_id").select();
		return false;
	}
	
	if($("#carrier_name").val() == "")
	{
		alert("请填写中继名称！");
		$("#carrier_name").focus();
		return false;
	}else if($("#carrier_name").val().length>30||$("#carrier_name").val().length<2){
		alert("中继名称位数必须介于2-30位字符之间！");
		$("#carrier_name").select();
		return false;
	}
   	
  	$('#load').show();
	var datas="action=carrier_set&do_actions=copy&server_ip="+$("#source_carrier_id option:selected").attr("server_ip")+$('#form1').serialize()+times;
	//alert(datas);
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		  request_tip(json.des,json.counts);
		  _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
 		  if(json.counts=="1"){
				_DialogInstance.ParentWindow.GetPageCount($(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"count");
				_DialogInstance.ParentWindow.get_datalist($(_DialogInstance.ParentWindow.document).find("#pages").val(),$(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"list",$(_DialogInstance.ParentWindow.document).find("#pagesize").val());
 				setTimeout('Dialog.close();',10);
		  }else{
			 alert(json.des);
 		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
 }

 
//获取工号列表
function get_carrier_list(){
	//alert(turn_val);
   	var datas="action=get_carrier_all_list"+times;
	//alert(datas);
	$.ajax({
		 
		url: "send.php",
		data:datas,
		
  		success: function(json){ 
			 
			$("select[id='source_carrier_id'] option").remove();
			 
    		$.each(json.datalist,function(index,con){
				 
 				$("<option value='"+con.carrier_id+"' title='"+con.carrier_name+"--"+con.carrier_id+" "+con.carrier_description+"' des='"+con.carrier_description+"' name='"+con.carrier_name+"' server_ip='"+con.server_ip+"' >"+con.carrier_name+" ["+con.carrier_id+"]</option>").appendTo($("select[id='source_carrier_id']"));
 				
			})
		}
	});
	
} 

function copy_set(select_val){
	
	$("#carrier_description").val($("#source_carrier_id option[value='"+select_val+"']").attr("des"));
	$("#carrier_name").val($("#source_carrier_id option[value='"+select_val+"']").attr("name"));
}
 
$(document).ready(function(){
	get_carrier_list();
	 $('.td_underline tr:visible:odd').addClass('alt');
});
</script>
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">中继管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
      
        <fieldset style=""><legend> <?php echo $tits ?> </legend>
     		 <form action="" method="post" name="form1" id="form1">
 			
                <table width="100%" border="0" cellpadding=2 cellspacing=0 class="td_underline" >
                
                <tr>
                   <td  align="right" nowrap="nowrap">来源中继：</td>
                  <td align="left">
                   
                   <select name="source_carrier_id" class="s_option" id="source_carrier_id"  onchange="copy_set(this.value)">
                         
                   </select>
                   <span class="red">※</span><span class="gray">来源中继的所有配置将被复制</span>
                   </td>
                 </tr>
                 <tr>
                   <td width="20%"  align="right" nowrap="nowrap">中继ID：</td>
                   <td align="left"><input maxlength="15" size="30" class="s_input" name="carrier_id" id="carrier_id" onkeyup="this.value=value.replace(/[^\w\/]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/]/ig,'')" onblur="this.value=value.replace(/[^\w\/]/ig,'');check_carrier()"/><span class="red">※</span><span class="gray">15位以下数字、英文组合</span></td>
                 </tr>
                 <tr>
                   <td  align="right" nowrap="nowrap">中继名称：</td>
                   <td align="left"><input maxlength="30" size="30" class="s_input" name="carrier_name" id="carrier_name"/><span class="red">※</span></td>
                 </tr>
                 <tr>
                   <td  align="right" nowrap="nowrap">中继描述：</td>
                   <td align="left"><input maxlength="255" size="30" class="s_input" name="carrier_description" id="carrier_description"/></td>
                 </tr>
                    
                </table>
          </form>
      </fieldset>      
      
</div>
 
<?php
break;

//活动所属客户清单列表
case "carrier_lead_list":
  
?>
<script>

function GetPageCount(a_ctions,doa_ctions)
    {
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
  
	var url="action=get_carrier_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&carrier_id="+$("#carrier_id").val()+"&list_active="+$("#list_active").val()+times;
 	
	$.ajax({
		
		url: "send.php",
		data: url,
 		cache: false,
 		success: function(msg){
			 
			$("#recounts").val(msg.counts);
			max_pages($("#pagesize").val());
			OutputHtml($("#pages").val(),$("#pagesize").val());
		}
	});
	 
}
   
function get_datalist(page_nums,a_ctions,doa_ctions,pagesize){

	$('#load').show();
	//$("#excel_addr").html('');
	max_pages(pagesize);
	var pages=$("#pagecounts").val();
	if(parseInt(page_nums) < 1)page_nums = 1; 
	if(parseInt(page_nums) > parseInt(pages)){
		page_nums = pages;
	}; 
	if(!(parseInt(page_nums) <= parseInt(pages))) page_nums = pages;	 
	
	var url="action=get_carrier_leads_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&carrier_id="+$("#carrier_id").val()+"&list_active="+$("#list_active").val()+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times;
	//alert(url);
	//return false;
 	$.ajax({
		 
		url: "send.php",
		data:url,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
			
			$("#datatable tfoot tr").show();
			if(parseInt(json.counts)>0){
				 
				$("#datatable tbody tr").remove();
				var tits="",td_str="",fun_str="",qua_str="";
				$.each(json.datalist, function(index,con){
					 
					dblclick=" ondblclick='edit_lists(\""+con.list_id+"\")' ";
					do_edit="<a href='javascript:void(0)' onclick='edit_lists(\""+con.list_id+"\")'>修改</a>";
  					
					tr_str="<tr align=\"left\" id=\"list_"+con.list_id+"\" "+dblclick+">";
 					tr_str+="<td>"+con.list_id+"</td>";
					tr_str+="<td title='"+con.list_name+"'><div class='hide_tit'>"+con.list_name+"</div></td>";
					tr_str+="<td>"+con.list_description+"</td>";
					tr_str+="<td>"+con.counts+"</td>";
					tr_str+="<td>"+con.active+"</td>";
					tr_str+="<td>"+con.list_lastcalldate+"</td>";
 					tr_str+="<td>"+do_edit+"</td>";
					tr_str+="</tr>";
					$("#datatable tbody").append(tr_str);
				}); 
				
				OutputHtml(page_nums,pagesize);
  			
			}else{
				 
				$("#datatable tbody tr").remove();
 				$("#datatable tfoot tr").hide();
				tr_str="<tr><td colspan=\"12\" align=\"center\">"+json.des+"</td></tr>"
				$("#datatable").append(tr_str);
 			}  
			d_table_i();
 		} 
	});
	 
}  
$(document).ready(function(){
<?php 
if($carrier_id!=""){
?>	
 	var Sorts_Order=0;
	$("#datatable .dataHead th[sort]").map(function(){
		Sorts_Order=Sorts_Order+1;
		
		html=$(this).html();
		
		$(this).attr("id","DadaSorts_"+Sorts_Order).off().on("click",function(){
			Sorts_new("datatable",$(this).attr("id"),$("#pagesize").val());	
		}).html("<div>"+html+"<span class='sorting'></span></div>");
		
 	}) ;
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="12"/> <input name="sorts" type="hidden" id="sorts" value="carrier_id"/> <input name="order" type="hidden" id="order"/>').appendTo("body");
	
	GetPageCount('search',"count");
	get_datalist(1,"search","list",$('#pagesize').val());
<?php 
}else {
	echo '$("#form1").html("");Dialog.alert("该业务活动不存在，请检查后重试！");';
}
 ?>	 
});
</script>
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">活动管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
      	<input type="hidden" name="list_active" id="list_active" value="<?php echo $list_active ?>" />
        <input type="hidden" name="carrier_id" id="carrier_id" value="<?php echo $carrier_id ?>" />
        <fieldset style=""><legend> <?php echo $tits ?> </legend>
     		 <form action="" method="post" name="form1" id="form1">
 			
                  <table width="100%" border="0" align="center" cellpadding=4 cellspacing=0>
                    
                    <tr>
                      <td align="left" valign="top">
                          
                        
                                <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
                                      <thead>
                                        <tr align="left" class="dataHead">
                                                      
                                          <th sort="a.list_id" >客户清单ID</th>
                                          <th sort="list_name" >客户清单名称</th>
                                          <th sort="list_description">客户清单描述</th>
                                          <th sort="counts">号码数量</th>
                                          <th sort="active" >激活</th>
                                          <th sort="list_lastcalldate">最后话务时间</th>  
                                          <th >操作</th>  
                                        </tr>
                                      </thead>   
                                        <tbody>
                                        </tbody>
                                        <tfoot><tr class='dataTableFoot'><td colspan='14' align='left'><div id='dataTableFoot'><div style='float:right;' id='pagelist'></div><div style='float:left;' id='total'></div></div></td></tr></tfoot>
                        </table>
                               
                            
                      </td>
                    </tr>
                     
                  </table>
          </form>
      </fieldset>      
      
</div>
 
<?php
break;

//活动期望表提取号码列表
case "carrier_lead_hopper_list":
?>
<script>

function GetPageCount(a_ctions,doa_ctions)
    {
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
  
	var url="action=get_carrier_lead_hopper_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&carrier_id="+$("#carrier_id").val()+times;
 	
	$.ajax({
		
		url: "send.php",
		data: url,
 		cache: false,
 		success: function(msg){
			 
			$("#recounts").val(msg.counts);
			max_pages($("#pagesize").val());
			OutputHtml($("#pages").val(),$("#pagesize").val());
		}
	});
	 
}
   
function get_datalist(page_nums,a_ctions,doa_ctions,pagesize){

	$('#load').show();
	//$("#excel_addr").html('');
	max_pages(pagesize);
	var pages=$("#pagecounts").val();
	if(parseInt(page_nums) < 1)page_nums = 1; 
	if(parseInt(page_nums) > parseInt(pages)){
		page_nums = pages;
	}; 
	if(!(parseInt(page_nums) <= parseInt(pages))) page_nums = pages;	 
	
	var url="action=get_carrier_lead_hopper_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&carrier_id="+$("#carrier_id").val()+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times;
	//alert(url);
	//return false;
 	$.ajax({
		 
		url: "send.php",
		data:url,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
			
			$("#datatable tfoot tr").show();
			if(parseInt(json.counts)>0){
				 
				$("#datatable tbody tr").remove();
				var tits="",td_str="",fun_str="",qua_str="";
				$.each(json.datalist, function(index,con){
 
 					tr_str="<tr align=\"left\">";
 					tr_str+="<td>"+con.priority+"</td>";
 					tr_str+="<td>"+con.lead_id+"</td>";
					tr_str+="<td>"+con.list_id+"</td>";
					tr_str+="<td>"+con.list_name+"</td>";
					tr_str+="<td>"+con.phone_number+"</td>";
					tr_str+="<td>"+con.state+"</td>";
 					tr_str+="<td>"+con.status_name+"</td>";
 					tr_str+="<td>"+con.called_count+"</td>";
					tr_str+="<td>"+con.gmt_offset_now+"</td>";
					tr_str+="<td>"+con.alt_dial+"</td>";
 					 
					tr_str+="</tr>";
					$("#datatable tbody").append(tr_str);
				}); 
				
				OutputHtml(page_nums,pagesize);
  			
			}else{
				 
				$("#datatable tbody tr").remove();
 				$("#datatable tfoot tr").hide();
				tr_str="<tr><td colspan=\"12\" align=\"center\">"+json.des+"</td></tr>"
				$("#datatable").append(tr_str);
 			}  
			d_table_i();
 		} 
	});
	 
}

$(document).ready(function(){
 	
<?php 
if($carrier_id!=""){
?>	
 	var Sorts_Order=0;
	$("#datatable .dataHead th[sort]").map(function(){
		Sorts_Order=Sorts_Order+1;
		
		html=$(this).html();
		
		$(this).attr("id","DadaSorts_"+Sorts_Order).off().on("click",function(){
			Sorts_new("datatable",$(this).attr("id"),$("#pagesize").val());	
		}).html("<div>"+html+"<span class='sorting'></span></div>");
		
 	}) ;
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="12"/> <input name="sorts" type="hidden" id="sorts" value="hopper_id"/> <input name="order" type="hidden" id="order"/>').appendTo("body");
	
	GetPageCount('search',"count");
	get_datalist(1,"search","list",$('#pagesize').val());
<?php 
}else {
	echo '$("#form1").html("");Dialog.alert("该业务活动不存在，请检查后重试！");';
}
 ?>	 
});
</script>
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">活动管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
      	<input type="hidden" name="list_active" id="list_active" value="<?php echo $list_active ?>" />
        <input type="hidden" name="carrier_id" id="carrier_id" value="<?php echo $carrier_id ?>" />
        <fieldset style=""><legend> <?php echo $tits ?> </legend>
     		 <form action="" method="post" name="form1" id="form1">
 			
                  <table width="100%" border="0" align="center" cellpadding=4 cellspacing=0>
                    
                    <tr>
                      <td align="left" valign="top">
                          
                        
                                <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
                                      <thead>
                                        <tr align="left" class="dataHead">
                                            
                                          <th sort="a.priority" >优先级</th>
                                          <th sort="a.lead_id">号码编号</th>
                                          <th sort="a.list_id">客户清单ID</th>
                                          <th sort="a.list_name">客户清单</th>
                                          <th sort="b.phone_number" >呼叫号码</th>
                                          <th sort="a.state">准备状态</th>  
                                          <th sort="c.status_name">呼叫状态</th>  
                                          <th sort="b.called_count">计数</th>  
                                          <th sort="a.gmt_offset_now">时区</th>  
                                          <th sort="a.alt_dial">自动测试</th>  
                                          </tr>
                                      </thead>   
                                        <tbody>
                                        </tbody>
                                        <tfoot><tr class='dataTableFoot'><td colspan='14' align='left'><div id='dataTableFoot'><div style='float:right;' id='pagelist'></div><div style='float:left;' id='total'></div></div></td></tr></tfoot>
                                  </table>
                               
                            
                      </td>
                    </tr>
                     
                  </table>
          </form>
      </fieldset>      
      
</div>
 
<?php
break;
  

default:
 
}
mysqli_close($db_conn);

?>


</body>
</html>