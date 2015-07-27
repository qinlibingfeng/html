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
.td_underline td{border-bottom: 1px dotted #ccc; height:24px;line-height:24px}
.td_underline select{*margin-top:1px}
span.gray, span.red { margin-left: 4px }
</style>
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script>
var set_timeid; 
 
function do_chk_system(){
  	
 	alert("本检查操作将会终止系统内已有连接的运行！\n\n请先告知坐席人员签退登陆，并终止本功能以外的所有操作！");
	
 	if(confirm("确认通知坐席人员签退并终止其他功能操作了吗？\n\n点击 确定 将继续进行检查操作，点 取消 返回！")){}else{
		return false;	
	}
 	
	if($("#run_time").val()!="0"){
		
		if(confirm("当前正在执行修复操作，重新检查将中断正在进行的修复过程，并可能造成数据表损坏！\n\n点击 确定 将继续进行检查操作，点 取消 返回继续修复！")){
			$("#run_time").val(0);
			$("#repair_time").html("00:00:00");
			clearTimeout(set_timeid);
		}else{
			return false;	
		}
	}
	
	$("#chk_count").html(0);
	$("#all_count").html(0);
	$("#bad_count").html(0);
	$("#tab_arr").val("");
	$("#repair_time").html("00:00:00");
 	
	$('#load').show();
	var datas="action=do_chk_system&"+$('#form1').serialize()+times;
 	
	request_tip("系统正在执行检查，本过程可能非常缓慢，请耐心等待执行完毕，不可关闭本页！",1,30000);
	$("#start_repair,#form_submit").unbind("click").attr("disabled","disabled").css({"cursor":"not-allowed","color":"#a0a0a0"});
	 
   	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){
			$("#chk_result_list").show();
			$("#chk_count").html(json.chk_count);
			$("#all_count").html(json.all_count);
			$("#bad_count").html(json.bad_count);
			$("#tab_arr").val(json.tab_arr);
 			 
			if(json.bad_count=="0"){
				counts=1;
				des="恭喜!在本系统内未检查到错误问题!";
				
				$("#form_submit").unbind().bind("click",function(){
					do_chk_system('');	
				}).attr("disabled",false).css({"cursor":"pointer","color":""});
				
			}else{
				counts=0;
				
				if($("#auto_repair").val()=="y"){
					do_des="已自动";
					do_repair_system();
 				}else{
					do_des="请点击“开始修复”按钮";
					$("#start_repair").unbind().bind("click",function(){
						do_repair_system();	
					}).attr("disabled",false).css({"cursor":"pointer","color":""});
				}
				
				des="在本系统内共检查到 <strong style='font-size:14px'>"+json.bad_count+"</strong> 处错误问题!\n\n"+do_des+"进行修复!"
			}
  			request_tip(des,counts);
 			
		},error:function(XMLHttpRequest,textStatus ){
			$("#form_submit").unbind().bind("click",function(){
				do_chk_system('');	
			}).attr("disabled",false).css({"cursor":"pointer","color":""});
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
}
 
function repair_today_call(){
  	
 	if(confirm("本功能主要用于修正当天未正确提交的呼叫结果！\n请在当天外呼结束后再进行本功能的操作，否则可能造成数据丢失！\n\n点击 确定 将继续进行修复操作，点 取消 返回！")){
 	}else{
		return false;	
	}
   	
	$('#load').show();
	var datas="action=repair_today_call"+times;
   	 
   	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){
			 
  			request_tip(json.des,json.counts);
 			
		},error:function(XMLHttpRequest,textStatus ){
 			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
} 
 
 
function do_repair_system(){
	
	$("#run_time").val(0);
 	clearTimeout(set_timeid);
	
	run_time();
	
	$("#start_repair,#form_submit").unbind("click").attr("disabled","disabled").css({"cursor":"not-allowed","color":"#a0a0a0"});
	
	$('#load').show();
	var datas="action=do_repair_system&tab_arr="+$("#tab_arr").val()+"&auto_optimize="+$("#auto_optimize").val()+times;
	//alert(datas);
  	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
			$("#run_time").val(0);
			clearTimeout(set_timeid);
			$("#bad_count").html(0);
			$("#start_repair").unbind("click").attr("disabled","disabled").css({"cursor":"not-allowed","color":"#a0a0a0"});
			$("#form_submit").unbind().bind("click",function(){
				do_chk_system('');	
			}).attr("disabled",false).css({"cursor":"pointer","color":""});
			request_tip(json.des,json.counts,20000);
 			
		},error:function(XMLHttpRequest,textStatus ){
			clearTimeout(set_timeid);
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
 		}
	});
 
}

function time_To_hhmmss(seconds){
   var hh;
   var mm;
   var ss;
   if(seconds==null||seconds<0){
       return;
   }
   
   hh=seconds/3600|0;
   seconds=parseInt(seconds)-hh*3600;
   if(parseInt(hh)<10){
	  hh="0"+hh;
   }
   mm=seconds/60|0;
  
   ss=parseInt(seconds)-mm*60;
   if(parseInt(mm)<10){
	 mm="0"+mm;   
   }
   if(ss<10){
       ss="0"+ss;     
   }
   return hh+":"+mm+":"+ss;
}

function run_time(){
	var run_time=parseInt($("#run_time").val());
	$("#run_time").val(run_time+1);
 	$("#repair_time").html(time_To_hhmmss(run_time+1));
	
	set_timeid=setTimeout("run_time()",1000);
}

$(document).ready(function(e){
	$("#form_submit").unbind().bind("click",function(){do_chk_system('')}).attr("disabled",false).css({"cursor":"pointer","color":""});
	$("#start_repair").unbind("click").attr("disabled","disabled").css({"cursor":"not-allowed","color":"#a0a0a0"});
	$('.td_underline tr:visible:odd').addClass('alt');
	request_tip("本功能操作将会终止系统内已有连接的运行！检查过程可能非常缓慢，请耐心等待执行完毕！",0,10000);
});
  
</script>
</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
<input type="hidden" id="run_time" name="run_time" value=0 />
<input name="tab_arr" type="hidden" id="tab_arr" size="80"  />

<div class="page_main" >

<!--<table border="0" cellpadding="0" cellspacing="0" class="menu_list">
 <tr>
    <td colspan="2"><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="repair_today_call('');" title="修正今日呼叫结果"><img src="/images/icons/telephone6.png" style="margin-top:6px"/><b>修正今日呼叫结果&nbsp;</b></a></td>
  </tr>
</table>-->

<table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
    <tr>
        <td style="">
    
    <fieldset><legend> <label onClick="show_div('search_script');" title="点击收缩/展开">检查选项</label></legend>
        <form action="" onSubmit=""  method="post" name="form1" id="form1">
          <table width="100%" border="0" align="center"  cellspacing="0" id="search_list" class="search_table" >
            
               <tr>
                 <td width="8%" align="right">检查速度：</td>
                 <td height=""><select name="chk_fast" class="s_option" id="chk_fast">
                   <option value="fast QUICK" selected="selected">快速检查</option>
                   <option value="">常规检查</option>
                 </select></td>
                 <td width="8%" height="26" align="right" id="">检查深度：</td>
         		 <td nowrap="nowrap"><select name="chk_rank" class="s_option" id="chk_rank">
         		   <option value="system" title="只检查系统关键基础表，速度较快">系统基础表</option>
         		   <option value="system_data" title="检查系统基础表、业务支撑表，速度较慢">系统基础表、业务支撑表</option>
         		   <option value="all" selected="selected" title="检查系统基础表、业务支撑表、系统归档表，速度最慢">检查全部数据表</option>
       		   </select></td>
                 <td width="8%" align="right">立即修复：</td>
                 <td>
                 	<select name="auto_repair" class="s_option" id="auto_repair" >
                    	<option value="y" selected="selected">是 -> 自动执行修复</option>
                        <option value="n">否 -> 手动执行修复</option>
                    </select>
                 </td>
                 <td width="8%" align="right" id="td">立即优化：</td>
                 <td>
                     <select name="auto_optimize" class="s_option" id="auto_optimize" >
                      	<option value="y">是 -> 修复后优化表（速度较慢）</option>
                        <option value="n">否 -> 不执行优化表（速度较快）</option>
                   </select>
                 </td>
                 
               </tr>
               <tr>
                 <td align="right"> 
                  </td>
                 <td colspan="7"><input type="button" name="form_submit" value="开始检查" id="form_submit" style="cursor:pointer" />
                   <input type="reset" name="button" id="button" value="重置" /> </td>
               </tr>
              </table>
    
        </form>
    </fieldset>


  <fieldset id="chk_result_list" style="display:none">
    <legend >检查结果</legend>
 
        <table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
        <tr >
          <td align="right">系统项目：</td>
          <td align="left"><em class="blue font_18" id="all_count">0</em> 个</td>
        </tr>
        <tr >
          <td align="right">检查项目：</td>
          <td align="left"><em class="blue font_18" id="chk_count">0</em> 个</td>
        </tr>
        <tr >
          <td width="30%" align="right">系统错误：</td>
          <td align="left"><em class="red font_18" id="bad_count">0</em> 个</td>
        </tr>
        <tr >
          <td align="right">修复耗时：</td>
          <td align="left"><em class="green font_18" id="repair_time">00:00:00</em><em class="gray" style="margin-left:10px">修复过程可能会非常耗时，请耐心等待修复完毕，不可中途关闭本页！！！</em></td>
        </tr>
        <tr>
          <td align=""></td>
          <td align="left">
            <p>&nbsp;</p>
            <input type="button" name="start_repair" id="start_repair" value="开始修复" style="cursor:pointer" />
            <input type="button" name="re_check" id="re_check" value="重新检查" onclick="do_chk_system('chk');"/>
            <p>&nbsp;</p>
            
            </td>
        </tr>
      </table>
   </fieldset>
  
      </td>
  </tr>
 </table> 
</div>
</body>
</html>