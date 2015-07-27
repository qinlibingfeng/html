<?php 
require("../../inc/pub_func.php"); 
?>   
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统设置</title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css" />
<style>
.strategySel div{cursor:pointer;}
.strategySel,.bus_strategySel,.strategySel_on,.bus_strategySel_on{background:url("/images/new_map_nav.gif") no-repeat scroll 0 0 transparent;height:26px;line-height:26px;margin:2px 10px 2px 2px;overflow:hidden;width:315px; position:relative}
.strategySel_on,.bus_strategySel_on{background-position:0 -32px;}
.strategySel .sel,.bus_strategySel .sel{font-weight:700;}
.strategySel .noSel,.strategySel .sel{float:left;line-height:26px;overflow:hidden;text-align:center;width:104px;}
.strategySel .noSel,.bus_strategySel .noSel{background:url("/images/new_map_nav.gif") no-repeat scroll -2px -64px transparent;cursor:pointer;}.strategySel .noSel_on,.bus_strategySel .noSel_on{background-position:-2px -96px;}
.strategySel span.lineBg,.bus_strategySel span.lineBg{background:url("/images/new_map_nav.gif") no-repeat scroll 0 -128px transparent;display:block;text-align:center;}.strategySel_r{height:26px;}
.strategySel span.lineBg_on,.bus_strategySel span.lineBg_on{background-position:0 -160px;}
.bus_strategySel .noSel,.bus_strategySel .sel{float:left;line-height:24px;*line-height:26px;margin:0;overflow:hidden;padding:0;text-align:center;width:78px;}
.strategySel_r .leftBorLine,.strategySel_r .rightBorLine{float:left;font-size:0;height:26px;overflow:hidden;width:2px;}
.strategySel_r .leftBorLine{background:url("/images/new_map_nav.gif") no-repeat scroll left 0 transparent;width:1px;}
.strategySel_r .leftBorLine_on{background:url("/images/new_map_nav.gif") no-repeat scroll left -96px transparent;}
.strategySel_r .leftBorLine_active_on{background:url("/images/new_map_nav.gif") no-repeat scroll left -32px transparent;}.strategySel_r .rightBorLine{background:url("/images/new_map_nav.gif") no-repeat scroll right 0 transparent;}
.strategySel_r .rightBorLine_on{background:url("/images/new_map_nav.gif") no-repeat scroll right -96px transparent;}
.strategySel_r .rightBorLine_active_on{background:url("/images/new_map_nav.gif") no-repeat scroll right -32px transparent;}

.td_underline td{border-bottom: 1px dotted #ccc; height:24px;line-height:24px}
.td_underline select{*margin-top:1px}
.s_input{width:196px}
.s_option{width:202px}
span.gray, span.red { margin-left: 4px }
</style>
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script>
$(document).ready(function(){
 	$('.td_underline tr:visible:odd').addClass('alt');
 	
	<?php 
  
	$sql="select version,install_date,use_non_latin,webroot_writable,enable_queuemetrics_logging,queuemetrics_server_ip,queuemetrics_dbname,queuemetrics_login,queuemetrics_pass,queuemetrics_url,queuemetrics_log_id,queuemetrics_eq_prepend,vicidial_agent_disable,allow_sipsak_messages,admin_home_url,enable_agc_xfer_log,db_schema_version,auto_user_add_value,timeclock_end_of_day,timeclock_last_reset_date,vdc_header_date_format,vdc_customer_date_format,vdc_header_phone_format,vdc_agent_api_active,qc_last_pull_time,enable_vtiger_integration,vtiger_server_ip,vtiger_dbname,vtiger_login,vtiger_pass,vtiger_url,qc_features_active,outbound_autodial_active,outbound_calls_per_second,enable_tts_integration,agentonly_callback_campaign_lock,sounds_central_control_active,sounds_web_server,sounds_web_directory,active_voicemail_server,auto_dial_limit,user_territories_active,allow_custom_dialplan,db_schema_update_date,enable_second_webform from system_settings;";

	$rs=mysqli_query($db_conn,$sql);
	$row=mysqli_fetch_row($rs);
	if($rs){
 
 		$use_non_latin =				$row[2];
		$webroot_writable =				$row[3];
		$enable_queuemetrics_logging =	$row[4];
		$queuemetrics_server_ip =		$row[5];
		$queuemetrics_dbname =			$row[6];
		$queuemetrics_login =			$row[7];
		$queuemetrics_pass =			$row[8];
		$queuemetrics_url =				$row[9];
		$queuemetrics_log_id =			$row[10];
		$queuemetrics_eq_prepend =		$row[11];
		$vicidial_agent_disable =		$row[12];
		$allow_sipsak_messages =		$row[13];
		$admin_home_url =				$row[14];
		$enable_agc_xfer_log =			$row[15];
		$db_schema_version =			$row[16];
		$auto_user_add_value =			$row[17];
		$timeclock_end_of_day =			$row[18];
		$timeclock_last_reset_date =	$row[19];
		$vdc_header_date_format =		$row[20];
		$vdc_customer_date_format =		$row[21];
		$vdc_header_phone_format =		$row[22];
		$vdc_agent_api_active =			$row[23];
		$qc_last_pull_time = 			$row[24];
		$enable_vtiger_integration = 	$row[25];
		$vtiger_server_ip = 			$row[26];
		$vtiger_dbname = 				$row[27];
		$vtiger_login = 				$row[28];
		$vtiger_pass = 					$row[29];
		$vtiger_url = 					$row[30];
		$qc_features_active =			$row[31];
		$outbound_autodial_active =		$row[32];
		$outbound_calls_per_second =	$row[33];
		$enable_tts_integration =		$row[34];
		$agentonly_callback_campaign_lock = $row[35];
		$sounds_central_control_active = $row[36];
		$sounds_web_server =			$row[37];
		$sounds_web_directory =			$row[38];
		$active_voicemail_server =		$row[39];
		$auto_dial_limit =				$row[40];
		$user_territories_active =		$row[41];
		$allow_custom_dialplan =		$row[42];
		$db_schema_update_date =		$row[43];
		$enable_second_webform =		$row[44];
		

		echo "$('#use_non_latin').val('".$use_non_latin."');
			$('#webroot_writable').val('".$webroot_writable."');
			$('#enable_queuemetrics_logging').val('".$enable_queuemetrics_logging."');
			$('#queuemetrics_eq_prepend').val('".$queuemetrics_eq_prepend."');
			$('#vicidial_agent_disable').val('".$vicidial_agent_disable."');
			$('#allow_sipsak_messages').val('".$allow_sipsak_messages."');
			$('#enable_agc_xfer_log').val('".$enable_agc_xfer_log."');
			$('#vdc_header_date_format').val('".$vdc_header_date_format."');
			$('#vdc_customer_date_format').val('".$vdc_customer_date_format."');
			$('#vdc_header_phone_format').val('".$vdc_header_phone_format."');
			$('#vdc_agent_api_active').val('".$vdc_agent_api_active."');
			$('#enable_vtiger_integration').val('".$enable_vtiger_integration."');
			$('#qc_features_active').val('".$qc_features_active."');
			$('#enable_tts_integration').val('".$enable_tts_integration."');
			$('#agentonly_callback_campaign_lock').val('".$agentonly_callback_campaign_lock."');
			$('#sounds_central_control_active').val('".$sounds_central_control_active."');
			$('#active_voicemail_server').val('".$active_voicemail_server."');
			$('#outbound_autodial_active').val('".$outbound_autodial_active."');
			$('#auto_dial_limit').val('".$auto_dial_limit."');
			$('#user_territories_active').val('".$user_territories_active."');
			$('#allow_custom_dialplan').val('".$allow_custom_dialplan."');
			$('#enable_second_webform').val('".$enable_second_webform."');
		";
 		
	}else{
		$is_edit=0;	
	}
	mysqli_free_result($rs);
 	 
?>

	$('#strategySel div').click(function(){
		
		$this=$(this);
		
		if(!$this.hasClass("sel")&&confirm("改变中继设置可能会造成接通情况变化或不可呼叫！\n您确定要设置系统默认中继为 \“"+$this.children('span').html()+"\”吗？\n\n点击 确定 继续，点击 取消 返回！")){
			
  			var current_server=$('#strategySel').attr("current_server");
			var carrier_server=$this.attr("server");
			
			if(current_server==""){
				alert("系统当前中继地址不正确，请检查后重试！");
 				return false;
			}else if(carrier_server==""){
				alert("目标中继地址不正确，请检查后重试！");
 				return false;
			}
 			
			var datas="action=set_def_carrier_server&current_server="+current_server+"&carrier_server="+carrier_server+times;
			$.ajax({
				 
				url: "send.php",
				data:datas,
				success: function(json){ 
					request_tip(json.des,json.counts,6000);
					if(json.counts=="1"){
						$('#strategySel').attr("current_server",carrier_server);
					    $this.addClass('sel').removeClass("noSel").siblings().removeClass('sel').addClass("noSel").children("span").removeClass("lineBg_on");
						$this.children("span").addClass("lineBg_on");
					} 
					
				},error:function(XMLHttpRequest,textStatus ){
					 request_tip("修改系统默认中继失败，发生系统错误，请联系系统管理员!",0);
				}
			});	
 			 
 		}
	});
	get_def_carrier_server()
});
 
function do_edit_system(){
  	
	if($("#outbound_autodial_active").val() == "0"){
		if(confirm("您选择禁用了自动外呼功能！\n选择本项后系统自动外呼、列表手动外呼功能将不可用，但可使用手动外呼！\n\n确认要设置为禁用自动外呼吗？")){
			$("#outbound_autodial_active").val("0");
		}else{
			$("#outbound_autodial_active").val("1");	
		}
	} 
   	var auto_dial_limit=$("#auto_dial_limit").val();
	if(auto_dial_limit>4){
		if(!confirm("您选择的自动拨号最大级别大于4\n请考虑使用的服务器性能是否可承受，建议设置为4或以下！\n\n点击 确定 继续设置为 "+auto_dial_limit+"，点 取消  将重设级别为 4 ")){
			$("#auto_dial_limit").val("4");
		}
 		$("#auto_dial_limit").select();
 	}
	
	if($("#outbound_calls_per_second").val() == ""){
		alert("请填写每秒最大呼叫电话数！");
		$("#outbound_calls_per_second").focus();
		return false;
	}else if($("#outbound_calls_per_second").val()>80){
		if(!confirm("您填写的每秒最大呼叫电话数大于80\n请考虑使用的服务器性能是否可承受，建议设置为30或以下！\n\n点击 确定 继续设置为 "+$("#outbound_calls_per_second").val()+"，点 取消 将重设级别为 30 ")){
			$("#outbound_calls_per_second").val("30");
		}
 		$("#outbound_calls_per_second").select();
 	}/*else if($("#outbound_calls_per_second").val()<1){
		alert("每秒最大呼叫电话数不能为0！");
		$("#outbound_calls_per_second").focus();
		return false;
	}*/
	
	var form_value="",v_null=0,v_id="";
 	$('#form1 input[name="max_vicidial_trunks"]').each(function(i){
		
		if($(this).val()!=""&&$(this).val()!="0"){
			server_id=$(this).attr("server_id");
			form_value+=$(this).val()+"#_#"+server_id+"|";
 		}else{
			v_null++;
			v_id=$(this).attr("id");
		}
 	}); 
	
	/*if(v_null>0){
		alert("请填写系统最大中继数！并且中继数不能为0！");
		$("#"+v_id).focus();
		return false;
	}*/
	
	if(form_value!=""&&form_value.substr(form_value.length-1)=="|"){
		form_value=form_value.substr(0,form_value.length-1);
	}
	
	$('#load').show();
	var datas="action=update_system&server_trunks="+form_value+"&"+$('#form1').serialize()+times;
 	 
   	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		
			request_tip(json.des,json.counts);
			
			if(json.counts!="1"){
 			  alert(json.des);
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
}


function edit_trunks(server_id){
	
	if(server_id!=""&&server_id!=undefined){
		
		if($("#max_vicidial_trunks_"+server_id).val() == ""){
			alert("请填写最大中继数！");
			$("#max_vicidial_trunks_"+server_id).focus();
			return false;
		}else if($("#max_vicidial_trunks_"+server_id).val()<1){
			alert("最大中继数不能为0！");
			$("#max_vicidial_trunks_"+server_id).focus();
			return false;
		}
		
		$('#load').show();
		var datas="action=update_server_trunks&server_id="+encodeURIComponent(server_id)+"&max_vicidial_trunks="+$("#max_vicidial_trunks_"+server_id).val()+times;
		 
		//alert(datas);
		$.ajax({
			 
			url: "send.php",
			data:datas,
			
			beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
			complete :function(){$('#load').hide('100');},
			success: function(json){ 
			
				request_tip(json.des,json.counts);
				
				if(json.counts!="1"){ 
				  alert(json.des);
				}
				
			},error:function(XMLHttpRequest,textStatus ){
				alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
			}
		});
	}else{
		alert("请输入要修改的服务器ID！");
		return false;
	}
}
  

function get_def_carrier_server(){
	
	var datas="action=get_def_carrier_server"+times;
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		success: function(json){ 
 			if(json.counts=="1"){
			   $('#strategySel').attr("current_server",json.carrier_server);
			   var server_div=$('#strategySel div[server="'+json.carrier_server+'"]');
			   if(server_div.length>0){
				   server_div.addClass('sel').removeClass('noSel').children('span').addClass('lineBg_on');
			   }else{
				   $('#strategySel div').addClass('sel').removeClass('noSel').children('span').addClass('font_12');	   
			   }
			}else{
				$('#strategySel div').addClass('sel').removeClass('noSel').children('span').addClass('font_12');			
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			$('#strategySel div').addClass('sel').removeClass('noSel').children('span').addClass('font_12');
		}
	});	
}



</script>
</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>

<div class="page_main" >
<table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
    <tr>
        <td style="">

  <fieldset >
    <legend >系统设置</legend>
 	 
    <form action="" method="post" name="form1" id="form1">
       <table width="100%" cellpadding="0" cellspacing="0" class="td_underline" id="test_list">
        <tr >
          <td width="30%" align="right">系统版本：</td>
          <td align="left"><strong class="blue"><?php echo $system_version?></strong></td>
        </tr>
        <tr style="display:none">
          <td align="right">是否支持UTF8编码：</td>
          <td align="left"><select name="use_non_latin" class="s_option" id="use_non_latin">
              <option value="1">支持</option>
              <option value="0">不支持</option>
              
            </select><span class="red">※</span></td>
        </tr>
        <tr style="display:none">
          <td align="right">根目录可写：</td>
          <td align="left"><select name="webroot_writable" class="s_option" id="webroot_writable">
              <option value="1">可写</option>
              <option value="0">不可写</option>
             </select></td>
        </tr>
        <tr style="display:none">
          <td align="right">坐席会话暂停提示：</td>
          <td align="left">
          <select name="vicidial_agent_disable" class="s_option" id="vicidial_agent_disable">
          	  <option value="ALL">所有坐席</option>
              <option value="NOT_ACTIVE">未激活的坐席</option>
              <option value="LIVE_AGENT">激活的坐席</option>
              <option value="EXTERNAL">外部坐席</option>
              
            </select></td>
        </tr>
        <tr style="display:">
          <td align="right">允许发送消息到软电话：</td>
          <td align="left"><select name="allow_sipsak_messages" class="s_option" id="allow_sipsak_messages">
              <option value="1">允许</option>
              <option value="0">不允许</option>
               
            </select>
            <span class="gray"></span></td>
        </tr>
        <tr style="display:none">
          <td align="right">系统欢迎页面地址：</td>
          <td align="left"><input type="text" name="admin_home_url" size="50" maxlength="255" value="<?php echo $admin_home_url ?>"></td>
        </tr>
        <tr >
          <td align="right">坐席电话转接日志：</td>
          <td align="left"><select name="enable_agc_xfer_log" class="s_option" id="enable_agc_xfer_log">
              <option value="1">记录</option>
              <option value="0">不记录</option>
               
            </select></td>
        </tr>
        <tr style="display:none">
          <td align="right">每天时间锁解除时间：</td>
          <td align="left"><input type="text" name="timeclock_end_of_day" size="30" class="s_input" maxlength="4" value="<?php echo $timeclock_end_of_day ?>"></td>
        </tr>
        <tr >
          <td align="right">坐席系统日期格式：</td>
          <td align="left"><select name="vdc_header_date_format" id="vdc_header_date_format" class="s_option">
              <option value="MS_DASH_24HR 2008-06-24 23:59:59" title="年月日 24小时制时间">MS_DASH_24HR 2008-06-24 23:59:59</option>
              <!--<option value="US_SLASH_24HR 06/24/2008 23:59:59" title="美国时间显示格式月日年 24小时制时间">US_SLASH_24HR 06/24/2008 23:59:59</option>
              <option value="EU_SLASH_24HR 24/06/2008 23:59:59" title="欧洲时间显示格式日月年 24小时制时间">EU_SLASH_24HR 24/06/2008 23:59:59</option>
              <option value="AL_TEXT_24HR JUN 24 23:59:59" title="文本时间显示格式缩写的月和日 24小时制时间">AL_TEXT_24HR JUN 24 23:59:59</option>
              <option value="MS_DASH_AMPM 2008-06-24 11:59:59 PM" title="默认时间格式是年月日 12小时制时间">MS_DASH_AMPM 2008-06-24 11:59:59 PM</option>
              <option value="US_SLASH_AMPM 06/24/2008 11:59:59 PM" title="美国的时间显示格式月日年 12小时制时间">US_SLASH_AMPM 06/24/2008 11:59:59 PM</option>
              <option value="EU_SLASH_AMPM 24/06/2008 11:59:59 PM" title="欧洲的时间显示格式日月年 12小时制时间">EU_SLASH_AMPM 24/06/2008 11:59:59 PM</option>
              <option value="AL_TEXT_AMPM JUN 24 11:59:59 PM" title="文本时间显示格式缩写的月和日 24小时制时间">AL_TEXT_AMPM JUN 24 11:59:59 PM</option>-->
               
            </select></td>
        </tr>
        <tr > 
          <td align="right">坐席系统客户信息区日期格式：</td>
          <td align="left"><select name="vdc_customer_date_format" id="vdc_customer_date_format" class="s_option">
              <option value="MS_DASH_24HR 2008-06-24 23:59:59" title="年月日 24小时制时间">MS_DASH_24HR 2008-06-24 23:59:59</option>
              <!--<option value="US_SLASH_24HR 06/24/2008 23:59:59" title="美国时间显示格式月日年 24小时制时间">US_SLASH_24HR 06/24/2008 23:59:59</option>
              <option value="EU_SLASH_24HR 24/06/2008 23:59:59" title="欧洲时间显示格式日月年 24小时制时间">EU_SLASH_24HR 24/06/2008 23:59:59</option>
              <option value="AL_TEXT_24HR JUN 24 23:59:59" title="文本时间显示格式缩写的月和日 24小时制时间">AL_TEXT_24HR JUN 24 23:59:59</option>
              <option value="MS_DASH_AMPM 2008-06-24 11:59:59 PM" title="默认时间格式是年月日 12小时制时间">MS_DASH_AMPM 2008-06-24 11:59:59 PM</option>
              <option value="US_SLASH_AMPM 06/24/2008 11:59:59 PM" title="美国的时间显示格式月日年 12小时制时间">US_SLASH_AMPM 06/24/2008 11:59:59 PM</option>
              <option value="EU_SLASH_AMPM 24/06/2008 11:59:59 PM" title="欧洲的时间显示格式日月年 12小时制时间">EU_SLASH_AMPM 24/06/2008 11:59:59 PM</option>
              <option value="AL_TEXT_AMPM JUN 24 11:59:59 PM" title="文本时间显示格式缩写的月和日 24小时制时间">AL_TEXT_AMPM JUN 24 11:59:59 PM</option>-->
              
            </select></td>
        </tr>
        <tr>
          <td align="right">坐席系统客户来电号码格式：</td>
          <td align="left"><select name="vdc_header_phone_format" id="vdc_header_phone_format" class="s_option">
          	  <option value="MS_NODS 0000000000" title="没有格式：13589104688">MS_NODS 13589104688</option>
              <option value="US_DASH 000-000-0000" title="破折号分隔号码：135-8910-4688">US_DASH 135-8910-4688</option>
              <!--<option value="US_PARN (000)000-0000" title="美国破折号分隔电话号码括号内为区号：(000)0000-0000">US_PARN (000)0000-0000</option>
              <option value="UK_DASH 00 0000-0000" title="英国城市代码空格后破折号分隔电话号码：000 0000-0000">UK_DASH 000 0000-0000</option>
              <option value="AU_SPAC 000 000 000" title="澳大利亚空格分隔电话号码：000 0000 000">AU_SPAC 000 0000 000</option>
              <option value="IT_DASH 0000-000-000" title="意大利破折号分隔电话号码：0000-0000-000">IT_DASH 0000-0000-000</option>
              <option value="FR_SPAC 00 00 00 00 00" title="法国空格分隔电话号码：00 00 00 00 000">FR_SPAC 00 00 00 00 000</option>-->
              
            </select></td>
        </tr>
        <tr style="display:none">
          <td align="right">激活坐席API：</td>
          <td align="left"><select name="vdc_agent_api_active" class="s_option" id="vdc_agent_api_active">
              <option value="1">启用</option>
              <option value="0">禁用</option>
             </select><span class="gray">允许坐席使用API接口功能，默认：禁用</span></td>
        </tr>
        <tr style="display:none">
          <td align="right">坐席只回呼活动锁：</td>
          <td align="left"><select name="agentonly_callback_campaign_lock" class="s_option" id="agentonly_callback_campaign_lock">
              <option value="1">启用</option>
              <option value="0">禁用</option>
              
            </select><span class="gray">坐席只能回呼拨打活动导入的号码</span></td>
        </tr>
        <tr style="display:none">
          <td align="right">激活语音管理功能：</td>
          <td align="left"><select name="sounds_central_control_active" class="s_option" id="sounds_central_control_active">
              <option value="1">启用</option>
              <option value="0">禁用</option>
               
            </select></td>
        </tr>
        <tr style="display:none">
          <td align="right">语音服务器地址：</td>
          <td align="left"><input type="text" name="sounds_web_server" id="sounds_web_server" size="30" class="s_input" maxlength="50" value="<?php echo $sounds_web_server ?>"></td>
        </tr>
        <tr style="display:none">
          <td align="right">存放语音的文件夹名称：</td>
          <td align="left">&nbsp;</td>
        </tr>
        <tr style="display:none">
          <td align="right" >激活语音邮箱服务器：</td>
          <td align="left">
          <select name="active_voicemail_server" id="active_voicemail_server">
          	  <option value="">不激活使用</option>
           <?php 
			$sql="select server_ip,server_description from servers order by server_ip";
			$rs=mysqli_query($db_conn,$sql);
			$servers_to_print = mysqli_num_rows($rs);
			$servers_list='';
	
			$o=0;
			while ($servers_to_print > $o){
				$rowx=mysqli_fetch_row($rs);
				$servers_list .= "<option value=\"$rowx[0]\">$rowx[0] [$rowx[1]]</option>\n";
				$o++;
			}

			echo "$servers_list";
			mysqli_free_result($rs);
		 ?>
            </select></td>
        </tr>
        <tr >
          <td align="right">使用自动拨号功能：</td>
          <td align="left"><select name="outbound_autodial_active" class="s_option" id="outbound_autodial_active">
              <option value="1">启用</option>
              <option value="0">禁用</option>
              
            </select><span class="red">※</span><span class="gray">是否可使用自动外呼功能</span></td>
        </tr>
        <tr>
          <td align="right">自动拨号最大级别：</td>
          <td align="left"><select name="auto_dial_limit" class="s_option" id="auto_dial_limit">
             <?php 
			$adl=1;
			while($adl < 11){
				echo "<option value=\"$adl\">$adl</option>\n";
				if ($adl < 3){
					$adl = ($adl + 0.1);
				}else{
					if ($adl < 4){
						$adl = ($adl + 0.25);
					}else{
						if ($adl < 5){
							$adl = ($adl + 0.5);
						}else{
							if ($adl < 10){
								$adl = ($adl + 1);
							}else{
								if ($adl < 20){
									$adl = ($adl + 2);
								}else{
									if ($adl < 40){
										$adl = ($adl + 5);
									}else{
										if ($adl < 200){
											$adl = ($adl + 10);
										}else{
											if ($adl < 400){
												$adl = ($adl + 50);
											}else{
												if ($adl < 1000){
													$adl = ($adl + 100);
												}else{
													$adl = ($adl + 1);
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
			 
			 ?>
            </select><span class="red">※</span><span class="gray">建议设置为：4</span></td>
        </tr>
        
        <tr >
          <td align="right">每秒最大呼叫电话数：</td>
          <td align="left"><input type="text" name="outbound_calls_per_second" id="outbound_calls_per_second" size="30" class="s_input" maxlength="3" value="<?php echo $outbound_calls_per_second ?>" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"><span class="red">※</span><span class="gray">自动拨号每秒最大呼叫数量，默认：30</span></td>
        </tr>
        <tr>
          <td align="right">最大可用中继数：<br /><span class="red">※</span><span class="gray">系统可用中继资源数</span></td>
          <td align="left">
          
          <table border="0" cellpadding="2" cellspacing="0" class="dataTable" style="margin-top:4px; margin-bottom:4px; width:99%" id="datatables">
              <thead>
            	<tr align="left" class="dataHead">
                  <td style="font-weight:normal">服务器名称</td>
                  <td style="font-weight:normal">服务器IP</td>
                  <td style="font-weight:normal">最大中继数</td>
                  <td style="font-weight:normal">操作</td>
                </tr>
              </thead>
              <tbody>
                  
            <?php 
            
                $sql="select server_id,server_description,server_ip,max_vicidial_trunks from servers order by server_id";
                
                $rows=mysqli_query($db_conn,$sql);
                $row_counts_list=mysqli_num_rows($rows);			
                
                if ($row_counts_list!=0) {
                    $i=0;
                    while($rs= mysqli_fetch_array($rows)){ 
                         
                        echo "<tr $class>\n
                          <td title='".$rs["server_description"]."'><span class='blue'>".$rs["server_id"]."</span></td>\n
                          <td><span class='green'>".$rs["server_ip"]."</span></td>\n
                          <td><input type=\"text\" name=\"max_vicidial_trunks\" server_id=\"".$rs["server_id"]."\" id=\"max_vicidial_trunks_".$rs["server_id"]."\" size=\"12\" maxlength=\"4\" value=\"".$rs["max_vicidial_trunks"]."\" onkeyup=\"this.value=this.value.replace(/\D/g,'')\" onafterpaste=\"this.value=this.value.replace(/\D/g,'')\"/></td>\n
                          <td><a href='javascript:void(0)' title='点此修改最大中继数' onclick=\"edit_trunks('".$rs["server_id"]."')\">修改中继数</a></td>
                           
                        </tr>";
                    }
                 
                }else {
                     
                }
                mysqli_free_result($rows);
            ?>
                 
              </tbody>
               
            </table></td>
        </tr>
        
        <tr >
          <td align="right">中继线路设定：</td>
          <td align="left">
              <div id="route_type" class="bus_strategySel bus_strategySel_on fl" style="width:236px">
                  <div class="strategySel_r">
                    <div id="strategySel" style="width:319px" current_server="">
                      <span class="leftBorLine"></span>
                      <div id="carrier251" class="noSel" server="10.2.16.251" title="点击设定系统使用备用线路 251 呼叫"><span class="lineBg">主线251</span></div>
                      <div id="carrier12" class="noSel" server="58.56.131.12" title="点击设定系统使用备用线路 12 呼叫"><span class="lineBg">主线12</span> </div>
                      <div id="carrier59" class="noSel" server="58.59.84.59" title="点击设定系统使用备用线路 59 呼叫"><span class="lineBg">备用59</span> </div>
                      
                      <span class="rightBorLine"></span> 
                    </div>
                  </div>
                </div>
          		<div style="float:left;width:340px;margin-top:4px; overflow:hidden" class="gray">设定后无需再点击页面下方“提交保存”按钮，默认：251</div>
          </td>
        </tr>
        
        <tr style="display:none">
          <td align="right">允许自定义拨号计划：</td>
          <td align="left"><select name="allow_custom_dialplan" class="s_option" id="allow_custom_dialplan">
              <option value="1">启用</option>
              <option value="0">禁用</option>
               
            </select></td>
        </tr>
        <tr  style="display:none">
          <td align="right">用户域激活使用：</td>
          <td align="left"><select name="user_territories_active" class="s_option" id="user_territories_active">
              <option value="1">启用</option>
              <option value="0">禁用</option>
              
            </select></td>
        </tr>
        <tr  style="display:none">
          <td align="right">启用网页链接参数二：</td>
          <td align="left"><select name="enable_second_webform" class="s_option" id="enable_second_webform">
               <option value="1">启用</option>
              <option value="0">禁用</option>
            </select><span class="gray">是否可使用网页链接二</span></td>
        </tr>
        <tr style="display:none">
          <td align="right">启用文字转语音接口：</td>
          <td align="left"><select name="enable_tts_integration" class="s_option" id="enable_tts_integration">
              <option value="1">启用</option>
              <option value="0">禁用</option>
            </select></td>
        </tr>
        <tr style="display:none">
          <td align="right">激活QC功能：</td>
          <td align="left"><select name="qc_features_active" class="s_option" id="qc_features_active">
              <option value="1">启用</option>
              <option value="0">禁用</option>
            </select></td>
        </tr>
        <tr style="display:none">
          <td align="right">启用QueueMetrics报表：</td>
          <td align="left"><select name="enable_queuemetrics_logging" class="s_option" id="enable_queuemetrics_logging">
              <option value="1">启用</option>
              <option value="0">禁用</option>
            </select></td>
        </tr>
        <tr style="display:none">
          <td align="right">QueueMetrics服务器IP：</td>
          <td align="left"><input type="text" name="queuemetrics_server_ip" id="queuemetrics_server_ip" size="30" class="s_input" maxlength="15" value="<?php echo $queuemetrics_server_ip ?>"></td>
        </tr>
        <tr style="display:none">
          <td align="right">QueueMetrics数据库名称：</td>
          <td align="left"><input type="text" name="queuemetrics_dbname" id="queuemetrics_dbname" size="30" class="s_input" maxlength="50" value="<?php echo $queuemetrics_dbname ?>"></td>
        </tr>
        <tr style="display:none">
          <td align="right">QueueMetrics数据库账号：</td>
          <td align="left"><input type="text" name="queuemetrics_login" id="queuemetrics_login" size="30" class="s_input" maxlength="50" value="<?php echo $queuemetrics_login ?>"></td>
        </tr>
        <tr style="display:none">
          <td align="right">QueueMetrics数据库密码：</td>
          <td align="left"><input type="text" name="queuemetrics_pass" id="queuemetrics_pass" size="30" class="s_input" maxlength="50" value="<?php echo $queuemetrics_pass ?>"></td>
        </tr>
        <tr style="display:none">
          <td align="right">QueueMetrics链接地址：</td>
          <td align="left"><input type="text" name="queuemetrics_url" id="queuemetrics_url" size="50" maxlength="255" value="<?php echo $queuemetrics_url ?>"></td>
        </tr>
        <tr style="display:none">
          <td align="right">QueueMetrics日志ID：</td>
          <td align="left"><input type="text" name="queuemetrics_log_id" id="queuemetrics_log_id" size="30" class="s_input" maxlength="10" value="<?php echo $queuemetrics_log_id ?>"></td>
        </tr>
        <tr style="display:none">
          <td align="right">QueueMetrics定制字段：</td>
          <td align="left"><select name="queuemetrics_eq_prepend" class="s_option" id="queuemetrics_eq_prepend">
              <option value="NONE">NONE</option>
              <option value="lead_id">lead_id</option>
              <option value="list_id">list_id</option>
              <option value="source_id">source_id</option>
              <option value="vendor_lead_code">vendor_lead_code</option>
              <option value="address3">address3</option>
              <option value="security_phrase">security_phrase</option>
             
          </select></td>
        </tr>
        <tr style="display:none">
          <td align="right">启用Vtiger集成功能：</td>
          <td align="left"><select name="enable_vtiger_integration" class="s_option" id="enable_vtiger_integration">
              <option value="1">启用</option>
              <option value="0">禁用</option>
              
          </select></td>
        </tr>
        <tr style="display:none">
          <td align="right">Vtiger数据库IP：</td>
          <td align="left"><input type="text" name="vtiger_server_ip" id="vtiger_server_ip" size="30" class="s_input" maxlength="15" value="<?php echo $vtiger_server_ip ?>"></td>
        </tr>
        <tr style="display:none">
          <td align="right">Vtiger数据库名称：</td>
          <td align="left"><input type="text" name="vtiger_dbname" id="vtiger_dbname" size="30" class="s_input" maxlength="50" value="<?php echo $vtiger_dbname ?>"></td>
        </tr>
        <tr style="display:none">
          <td align="right">Vtiger数据库账号：</td>
          <td align="left"><input type="text" name="vtiger_login" id="vtiger_login" size="30" class="s_input" maxlength="50" value="<?php echo $vtiger_login ?>"></td>
        </tr>
        <tr style="display:none">
          <td align="right">Vtiger数据库密码：</td>
          <td align="left"><input type="text" name="vtiger_pass" id="vtiger_pass" size="30" class="s_input" maxlength="50" value="<?php echo $vtiger_pass ?>"></td>
        </tr>
        <tr style="display:none">
          <td align="right">Vtiger链接地址：</td>
          <td align="left"><input type="text" name="vtiger_url" id="vtiger_url" size="50" maxlength="255" value="<?php echo $vtiger_url  ?>"></td>
        </tr>
        <tr>
        	<td align=""></td>
        	<td align="left">
            	<p>&nbsp;</p>
             	  <input type="button" name="form_submit" value="提交保存" onclick="do_edit_system();" style="cursor:pointer" />
            	  <input type="reset" name="button" id="button" value="重新填写" />
             	<p>&nbsp;</p>
            
            </td>
        </tr>
      </table>
    </form>
  </fieldset>
  
      </td>
  </tr>
 </table> 
</div>
</body>
</html>