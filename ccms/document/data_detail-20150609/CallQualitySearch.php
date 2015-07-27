<?php require("../../inc/config.ini.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xHTML">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<title> <?php echo $system_name ?></title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css">
<link href="/css/day.css" rel="stylesheet" type="text/css">
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script>
function GetPageCount(a_ctions,doa_ctions){
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
  	
	var url="action=get_quality_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+times+"&"+$('#form1').serialize();
 	
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
	$("#excel_addr").html('');
 	max_pages(pagesize);
 	var pages=$("#pagecounts").val();
 	if(parseInt(page_nums) < 1)page_nums = 1; 
 	if(parseInt(page_nums) > parseInt(pages)){
		page_nums = pages;
  	}; 
 	if(!(parseInt(page_nums) <= parseInt(pages))) page_nums = pages;	 
	 
  	var url="action=get_quality_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&"+$('#form1').serialize();
	
 	//alert(url);
	//return false;
	
 	$.ajax({
		 
		url: "send.php",
		data:url,
		
 		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		   if (doa_ctions!="excel"){
			   
 			  $("#datatable tbody tr").remove();
			   
			   if(parseInt(json.counts)>0){
				$("#datatable tfoot tr").show();
				$("#excels").css("display","block");
	 	    	var tits="",td_str="",fun_str="",qua_str="";
				$.each(json.datalist, function(index,con){
  				if(con.locations){
					
					if (con.locations!="同步中"){
						 
						td_str="<td algin=\"center\">"+qua_str+"<a href=\"javascript:void(0);\" onClick=\"play_wav(event,'play_layer','"+con.locations+"');\" title=\"点击收听本次营销录音\">收听</a>&nbsp;<a href=\""+con.locations+"\" target=\"_blank\" title=\"点击下载本次营销录音\">下载</a></td>";
					}else{
						td_str="<td >"+con.locations+"</td>";
					}
 				}else{
   					td_str="<td >无</td>";
				} 		
 				tr_str="<tr align=\"left\" "+fun_str+">";
				tr_str+="<td >"+con.phone_number+"</td>";
 				tr_str+="<td >"+con.user+" ["+con.call_name+"]</td>";
 				tr_str+="<td >"+con.call_date+"</td>";
   				tr_str+="<td >"+con.campaign_name+"</td>";
				tr_str+="<td >"+con.status_name+"</td>";
				tr_str+="<td >"+con.old_status+"</td>";
				tr_str+="<td >"+con.userid+" ["+con.qua_name+"]</td>";
				tr_str+="<td >"+con.addtime+"</td>";
				tr_str+="<td >"+con.qualityname+"</td>";
				tr_str+="<td >"+con.qualitydes+"</td>";
				tr_str+="<td >"+con.call_des+"</td>";
  				tr_str+=td_str+"</tr>";
				$("#datatable tbody").append(tr_str);
			}); 
   		 
			OutputHtml(page_nums,pagesize);
 			
		   }else{
				$("#excels").css("display","none");
				$("#excel_addr").html('');
				$("#datatable tfoot tr").hide();
				tr_str="<tr><td colspan=\"12\" align=\"center\">"+json.des+"</td></tr>"
				$("#datatable").append(tr_str);
		   }  
			d_table_i();
			
		} else{
			
		   request_tip(json.des,json.counts);
		   if(json.counts=="1"){
			   $("#"+$("#file_type").val()+"_addr").html("下载：<a href='"+json.file_path+json.file_name+"' target='_blank'>"+json.file_name+"</a>");
  		   }else{
			   $("#"+$("#file_type").val()+"_addr").html(json.des);   
		   }
		   
   		}
		    
  		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员！\n"+textStatus);
		}
   	});
	 
}

function veiw_Quality(uniqueid,lead_id,list_id,campaign_id,phone_number,campaign_name){
	var diag =new Dialog(uniqueid);
	diag.Width = 640;
	diag.Height = 300;	
 	diag.Title = "录音质检："+phone_number;
	
	//var pos=$(document).scrollTop();
 	//diag.Top=""+pos+"";
  	diag.URL = 'datacenter/CallOutDataQuality.php?uniqueid='+uniqueid+'&lead_id='+lead_id+'&list_id='+list_id+'&campaign_id='+campaign_id+'&phone_number='+phone_number+'&campaign_name='+campaign_name;
	var pos=$(document).scrollTop()+20;
	diag.Top=""+pos+"";
	diag.OKEvent = setquality;
	diag.CancelEvent = stop_wavs;
    diag.show();
	
 	
}
function stop_wavs(){
	Zd_DW.do_stop_wav();
} 
function setquality(){
	Zd_DW.do_setquality();
}

function layer_quality(callnumber,actions){
   $('#auto_save_res').css("top",$(document).scrollTop()+6).addClass("green_layer");
   $('#auto_save_res').fadeIn("slow");
   $("#auto_save_res").html("<strong>"+callnumber+"</strong> 质检完成！检为："+actions);
   setTimeout("$('#auto_save_res').fadeOut('fast');",2000);
}
 
function check_form(actions){	
   	var agents=$("#agent_list").val();
	
 	if($("#phone_number").val()!=""&&($("#phone_number").val().substr(0,1)==","||$("#phone_number").val().substring($("#phone_number").val().length,$("#phone_number").val().length-1)==",")){
		
 		alert("被叫号码不能以英文逗号开头或结尾！");
		$("#phone_number").select();
 		return false;
 	}
	
	/*if(agents==""){
			
		alert("请选择"+$("#caller_types").html().replace("：","")+"查询！");
		$("#agent_name_list").focus();
		return false;
	}*/
 	
	if($("#time_zone").val()!=""&&$("#time_len").val()==""){
		alert("请选择时长范围数值！");
 		$("#time_len").focus();
		return false;
	}
	
    if (actions == "search") {
  		 
  		$("#datatable").show();
        GetPageCount('search', "count");
        get_datalist(1,"search", "list",$('#pagesize').val());
    }
	 
	if (actions == "excel") {
		//Zd_D.close();
		$("#field_list").val("");
 		$("#datatable").show();
		$("#file_type").val("xls");
		request_tip("系统正在为您导出，此过程较慢，请耐心等候...",1,30000);
 		get_datalist(1,"search", "excel",$('#pagesize').val());
	}
 	  
	if (actions == "csv") {
		$("#field_list").val("");
		request_tip("系统正在为您导出，此过程较慢，请耐心等候...",1,30000);
 		$("#file_type").val("csv");
 		$("#datatable").show();
		get_datalist(1,"search", "excel",$('#pagesize').val());
	}
}
   
 
$(document).ready(function(){
	
   var Sorts_Order=0;
	$("#datatable .dataHead th[sort]").map(function(){
		Sorts_Order=Sorts_Order+1;
		
		html=$(this).html();
		
		$(this).attr("id","DadaSorts_"+Sorts_Order).off().on("click",function(){
			Sorts_new("datatable",$(this).attr("id"),$("#pagesize").val());	
		}).html("<div>"+html+"<span class='sorting'></span></div>");
		
 	}) ;
   $('<input name="a_ctions" type="text" class="dis_none"  id="a_ctions"/> <input name="doa_ctions" type="text" class="dis_none"  id="doa_ctions"/> <input name="recounts" type="text" class="dis_none"  id="recounts"/> <input name="pages" type="text" class="dis_none"  id="pages" value="1"/> <input name="pagecounts" type="text" class="dis_none"  id="pagecounts"/><input name="pagesize" type="text" class="dis_none"  id="pagesize" value="15"/> <input name="sorts" type="text" class="dis_none"  id="sorts" value="a.addtime"/> <input name="order" type="text" class="dis_none"  id="order"/>').appendTo("body");

	$('#datatable').css("display","none");
	$("#excels").css("display","none");
 	days_ready();
	$("#time_len").css("display","none");
	$("#auto_save_res").css("display","none");
});
 
</script>
<script type="text/javascript" src="/js/calendar.js"></script>
 
</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
<div class="page_main">
<table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
        <tr>
            <td style="">
            
    <fieldset><legend> <label onClick="show_div('search_list');" title="点击收缩/展开">查询选项</label></legend>
      <form action="" onSubmit=""  method="post" name="form1" id="form1">       
           <table width="100%" border="0" align="center"  cellspacing="0" id="search_list" class="search_table" >
            
               <tr>
                 <td width="8%"  align="right">被叫号码：</td>
                 <td ><input name="phone_number" type="text" class="input_text" id="phone_number" title="输入要查询的被叫号码，多个以英文“,”分隔"  size="21" onkeyup="this.value=value.replace(/[^\d|,]/g,'')" onafterpaste="this.value=value.replace(/[^\d|,]/g,'')" /></td>
                 
                 <td width="10%" align="right">质检描述：</td>
                 <td><input name="qualitydes" type="text" class="input_text" id="qualitydes" title="输入要查询的质检描述" size="30" /></td>
                 <td align="right">质检人员：</td>
                 <td><input name="quality_user_list" type="text" class="input_text2" id="quality_user_list"  title="双击选择质检人员" size="16" readonly="readonly"  onDblClick="c_quality_user_list('get_quality_user_list');"/><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择质检人员" onClick="c_quality_user_list('get_quality_user_list');"></a></td>
                 <td width="8%"  align="right" id="">号码精度：</td>
     <td  nowrap="nowrap"><select name="search_accuracy" class="s_option" id="search_accuracy">
                      	<option value="=">等于</option>
                      	<option value="in">包含</option>
                      	<option value="not in">不包含</option>
                      	<option value="like_top">匹配开头</option>
                       	<option value="like_end">匹配结尾</option>
                      	<option value="like">模糊</option>
                       </select></td>
                 
                 
               </tr>
               <tr>
                 <td width="8%"  align="right" id="td">质检结果：</td>
                 <td ><input name="quality_status_list" type="text" class="input_text2" id="quality_status_list"  title="双击选择质检结果"  size="14"  readonly="readonly"  onDblClick="c_quality_status_list('get_quality_status_list');" /><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择质检结果" onClick="c_quality_status_list('get_quality_status_list');"></a></td>
                 <td align="right">呼叫描述：</td>
                 <td><input name="call_des" type="text" class="input_text" id="call_des" title="输入要查询的呼叫描述" size="30" /></td>
                 <td width="10%" align="right">业务活动：</td>
                 <td><input name="campaign_id_list" type="text" class="input_text2" id="campaign_id_list"  title="双击选择业务活动"  size="16"  readonly="readonly"  onDblClick="c_campaign_id_list('get_campaign_id_list');" /><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择业务活动" onClick="c_campaign_id_list('get_campaign_id_list');"></a></td>
                  
                 <td width="8%" align="right">坐席工号：</td>
                 <td><input name="agent_name_list" type="text" class="input_text2" id="agent_name_list"  title="双击选择坐席工号" size="16" readonly="readonly"  onDblClick="c_agent_list('get_agent_list');"/><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择坐席工号" onClick="c_agent_list('get_agent_list');"></a></td>
                
               </tr>
               <tr>
                 <td  align="right" nowrap="nowrap">质检时间：</td>
                 <td  colspan="7"><?php select_date("");?></td>
               </tr>
               <tr>
                 <td  align="right"><input type="text" class="dis_none"  name="quality_user" id="quality_user" value="" />
                 <input type="text" class="dis_none"  name="quality_status" id="quality_status" value="" />
                 <input type="text" class="dis_none"  name="agent_list" id="agent_list" value="" />
                 <input type="text" class="dis_none"  name="campaign_id" id="campaign_id" value="" />
                 <input type="text" class="dis_none"  name="phone_lists" id="phone_lists" value="" />
                 <input type="text" class="dis_none"  name="file_type" id="file_type" value="" />
                 <input type="text" class="dis_none"  name="field_list" id="field_list" value="" /></td>
                 <td  colspan="7"><input type="button" name="form_submit" value="提交查询" onClick="check_form('search');" style="cursor:pointer" />
                   <input type="reset" name="button" id="button" value="重置" /></td>
               </tr>
              </table> 
      
            </form>                
          
          
    </fieldset>
             
            <div id="excels"  style="height:22px; line-height:22px;"><span><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="check_form('excel');" title="导出详单到Excel"><img src="/images/icons/excel.png" style="margin-top:4px" /><b>导出Xls&nbsp;</b></a><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="check_form('csv');" title="导出详单到Csv"><img src="/images/icons/notebook.png" style="margin-top:4px"/><b>导出Csv&nbsp;</b></a></span><span id="xls_addr" style="height:22px; line-height:22px;margin-left:10px"></span><span id="csv_addr" style="height:22px; line-height:22px;margin-left:10px"></span></div>
            <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" style="display:block">
                  <thead>
                    <tr align="left" class="dataHead">             
                      <th sort="c.phone_number" >号码</th>
                      <th sort="c.user" >工号</th>
                      <th sort="c.call_date" style="" >呼叫时间</th>
                      <th sort="g.campaign_name">业务活动</th>
                      <th sort="h.status_name" >呼叫结果</th>				
                      <th sort="i.status_name">原结果</th>
                      <th sort="a.userid">质检人员</th>
                      <th sort="a.addtime">质检时间</th>
                      <th sort="b.status_name">质检结果</th>
                      <th sort="a.qualitydes">质检描述</th>
                      <th sort="c.call_des">呼叫描述</th>
                      <th style="" align="center">操作</th>
                    </tr>
                  </thead>   
                    <tbody>
                    </tbody>
                    <tfoot><tr class='dataTableFoot'><td colspan='16' align='left'><div id='dataTableFoot'><div style='float:right;' id='pagelist'></div><div style='float:left;' id='total'></div></div></td></tr></tfoot>
              </table>
               
         </td>
  </tr>
 </table>  
</div>
 
</body>
</html>
   
