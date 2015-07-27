<?php require("../../inc/config.ini.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xHTML">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<title> <?php echo $system_name ?></title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css">
<link href="/css/day.css" rel="stylesheet" type="text/css">
<link href="/css/bootstrap.css" rel="stylesheet" type="text/css">
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script src="/document/plugin/highcharts/js/highcharts.js" ></script> 
<script src="/document/plugin/highcharts/js/themes/grid.js" ></script> 
<script src="/js/calendar.js"></script>
<script>
 
var json_list;
function check_form(actions){
	
 	($("#call_date_type").val()=="hour")?url_page="send.php":url_page="send_min.php";
	
	if (actions == "search") {
		
		json_list="";
		$("#chart_con").hide();
		
		if($("#time_type").val()=="times"){ $("#chart_toolbar").fadeOut();}else{$("#chart_toolbar").fadeIn()}
		
		$("#chart_x_filed_list").val($("#data_type option:selected").attr("chart_x"));
		var url="action=data_report"+times+"&"+$('#form1').serialize();
		
		//alert(url);
		$.ajax({
			 
			url:url_page,
			data:url,
			
			beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
			complete :function(){$('#load').hide('100');},
			success: function(json){
				json_list=json;
				//request_tip(json.des,1);
				$("#chart_f_re").val("2");
 				var th="",td="",tr="",clk_event="",span="";
				
				$("#datatable").show(); 
	
				$("#datatable tbody tr").remove();
				$("#datatable tfoot tr").remove();
				$("#datatable thead tr th").remove();
				
				for(var i=0;i<json.field_name_list.length;i++){
					th+="<th >"+json.field_name_list[i]+"</th>";
				}
				data_width=28;
				$("#datatable thead tr").append(th);
				
				if(parseInt(json.counts)>0){
					$("#excels").show();
					
					if($("#with_rollup").val()==""){
						$("#chart_toolbar").show();
					}else{
						$("#chart_toolbar").hide();
					}
					
					var tits="";td_str="";
					$.each(json.datalist, function(index,con){
						tr_str="<tr align=\"left\">";
						for(var key in con){
							nowrap="";
							if(key=="工号"||key=="日期"||key=="月份"||key=="姓名"||key=="业务"){
								nowrap="nowrap";
							}
							
							key_v=con[key];
							if(key_v==null){
								key_v="";
							}
							if(key_v=="合计"||key_v=="总计"||key_v=="小计"){
								key_v="<strong>"+key_v+"</strong>";
							}
							tr_str+="<td "+nowrap+">"+key_v+"</td>";
						}
						tr_str+="</tr>";
						$("#datatable tbody").append(tr_str);
					}); 
				}else{
					$("#excels").hide();
					$("#datatable tfoot tr").hide();
					tr_str="<tr><td colspan=\"39\" align=\"center\">"+json.des+"</td></tr>"
					$("#datatable").append(tr_str);
					data_width=14;
				}  
				setTimeout("d_table_h();",300);
				
				var div_h=parseInt($("#s_fieldset").outerHeight())+parseInt($("#datatable").outerHeight());
				var win_w=parseInt($(window).width()),o_win_w=parseInt($("#window_width").val());
 				
				if(win_w<o_win_w){
					win_w=o_win_w;
				}
				
				if(div_h<$(window).height()){
					data_width=14;
 				}
   				
 				$("#result_div").css({"width":win_w-data_width+"px","height":$("#datatable").height()+30+"px"}); 
				 
			},error:function(XMLHttpRequest,textStatus ){
			   alert("页面请求错误，请检查重试或联系管理员！\n"+textStatus);
			}
		});	
	}
	
	if (actions == "excel") {
		request_tip("系统正在为您导出，此过程较慢，请耐心等候...",1,25000);
		var url="action=data_report&do_actions=excel"+times+"&"+$('#form1').serialize();
		$.ajax({
			 
			url:url_page,
			data:url,
			
			beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
			complete :function(){$('#load').hide('100');},
			success: function(json){ 
			
				request_tip(json.des,json.counts);
				if(json.counts=="1"){
				   $("#excel_addr").html("下载：<a href='"+json.file_path+json.file_name+"' target='_blank'>"+json.file_name+"</a>");
				}else{
					$("#excel_addr").html(json.des); 
				}
				
			},error:function(XMLHttpRequest,textStatus ){
				alert("页面请求错误，请检查重试或联系管理员！\n"+textStatus);
			}
		});
    }
}
  
 
function set_drop_opt(opt,do_act){
	var url="action=set_drop_opt&drop_opt="+opt+"&do_actions="+do_act+times;
	$.ajax({
		 
		url: "send.php",
		data:url,
		
		success: function(json){ 
			if(do_act=="up"){
				request_tip(json.des,json.counts);
			} 
			//if(json.counts=="1"){
				$("#drop_opt").val(json.drop_opt);
				$(".drop_opt_").removeClass("green");
				$("#"+json.drop_opt).addClass("green");
			//}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员！\n"+textStatus);
		}
	});	
}
 
 
$(document).ready(function(e) {
	set_drop_opt('','sel');
    $("#chart_buttons a").bind("click",function(){
		set_chart_($(this).attr("ch_type"));	
	});
	$("#window_width").val($(window).width());
	days_ready();
	set_chart_("table");
	
	$('#ch_sec_type').dropdown();
	$("#s_min,#e_min").attr("disabled",true);
	
	$("#sec_type_list a").on("click",function(){
		$("#ch_sec_type span").html($(this).text());
		
		t_type=$(this).attr("t_type");
		
		if(t_type=="hour"){
			$("#s_min,#e_min").attr("disabled",true);
			
		}else{
			request_tip("本项设为分钟只能查询时间跨度为 <strong>2</strong> 天数据",1,4000);
			$("#s_min,#e_min").attr("disabled",false);
		}
		
		$("#call_date_type").val(t_type);
	});
	
});
  
</script>
    
</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
<input type="text" class="dis_none"  name="window_width" id="window_width" value="" />  
<input type="text" class="dis_none"  name="call_date_type" id="call_date_type" value="hour" />
<div class="page_main">
  <table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
    <tr>
        <td valign="top" style="">
                   
        <fieldset id="s_fieldset"><legend> <label><strong onClick="show_div('search_list');">查询选项</strong></label></legend>
          <form action="" onSubmit=""  method="post" name="form1" id="form1">       
             <table width="100%" border="0" align="center"  cellspacing="0" id="search_list" class="search_table" >
            
               <tr>
                  
                 <td width="10%" align="right">坐席工号：</td>
                 <td><input name="agent_name_list" type="text" class="input_text2" id="agent_name_list"  title="双击选择坐席工号" size="16" readonly="readonly"  onDblClick="c_agent_list('get_agent_list');"/><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择坐席工号" onClick="c_agent_list('get_agent_list');"></a></td>
                 <td width="10%" align="right">业务活动：</td>
                 <td><input name="campaign_id_list" type="text" class="input_text2" id="campaign_id_list"  title="双击选择业务活动"  size="16"  readonly="readonly"  onDblClick="c_campaign_id_list('get_campaign_id_list');" /><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择业务活动" onClick="c_campaign_id_list('get_campaign_id_list');"></a></td>
                 <td align="right">客户清单：</td>
                 <td><input name="phone_lists_list" type="text" class="input_text2" id="phone_lists_list"  title="双击选择客户清单"  size="16"  readonly="readonly"  onDblClick="c_phone_lists('get_phone_lists');" /><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择客户清单" onClick="c_phone_lists('get_phone_lists');"></a></td>
                
                 <td width="10%" align="right">汇总统计：</td>
                 <td><select name="with_rollup" id="with_rollup" class="s_option">
                         <option value="">不汇总</option>
                        <option value="with rollup">汇总</option>
                    </select></td>
               </tr>
               <tr>
                 <td align="right">统计类型：</td>
                 <td>
                  
                   <select name="data_type" id="data_type" class="s_option">
                    <option value="data_1" chart_x="日期" title="按日期统计">按日期统计</option>
                    <option value="data_1_month" chart_x="月份" title="按月份统计">按月份统计</option>
                    <option value="data_2" chart_x="业务" title="按业务统计">按业务统计</option>
                    <option value="data_3" chart_x="日期、业务" title="按日期、业务统计" selected="selected">按日期、业务统计</option>
                    <option value="data_3_month" chart_x="月份、业务" title="按月份、业务统计">按月份、业务统计</option>
                    <option value="data_4" chart_x="业务、日期" title="按业务、日期统计">按业务、日期统计</option>
                    <option value="data_4_month" chart_x="业务、月份" title="按业务、月份统计">按业务、月份统计</option>
                    <option value="data_5" chart_x="工号、姓名" title="按工号统计">按工号统计</option>
                    <option value="data_6" chart_x="工号、姓名、日期" title="按工号、日期统计">按工号、日期统计</option>
                    <option value="data_6_month" chart_x="工号、月份" title="按工号、月份统计">按工号、月份统计</option>
                    <option value="data_9" chart_x="工号、姓名、日期、业务" title="按工号、日期、业务统计">按工号、日期、业务统计</option>
                    <option value="data_9_month" chart_x="工号、姓名、月份、业务" title="按工号、月份、业务统计">按工号、月份、业务统计</option>
                    <option value="data_7" chart_x="工号、姓名、业务" title="按工号、业务统计">按工号、业务统计</option>
                    <option value="data_8" chart_x="业务、工号、姓名" title="按业务、工号统计">按业务、工号统计</option>
                   </select>
                 
                 </td>
                 <td width="10%" align="right">报表方案：</td>
                 <td>
                 <select name="report_type" id="report_type" class="s_option">
                    <option value="report_1">报表方案一</option>
                    <option value="report_2">报表方案二</option>
                    <option value="report_3">报表方案三</option>
                    <option value="report_4">报表方案四</option>
                    <option value="report_5">报表方案五</option>
                    <option value="report_6">报表方案六</option>
                   </select>
                 
                 </td>
                 <td align="right"><span class="red">丢弃数值</span>：</td>
                 <td>
                 <select name="drop_opt" class="s_option" id="drop_opt">
                   <option value="drop_opt_wrjt" title="将丢弃数并入无人接听">丢弃数并入无人接听量</option>
                   <option value="drop_opt_jt" title="将丢弃数并入接通量" >丢弃数并入接通量</option>
                  </select></td>
                 <td align="right">显示丢弃值：</td>
                 <td><select name="dis_drop" class="s_option" id="dis_drop">
                   <option value="no">不显示</option>
                   <option value="dq_count">显示丢弃量</option>
                   <option value="dq_ratio">显示丢弃率</option>
                   <option value="all">全部显示</option>
                 </select></td>
                 
                 
               </tr>
               
               <tr>
                 <td align="right">&nbsp;</td>
                 <td colspan="7"><span class="gray">
                   
                  丢弃号码是指打通了客户电话,但没有空闲坐席接起此电话,超时后被挂断,实际并没有通话,本数据会影响接通率的相关数据值.丢弃率=丢弃量/(成功量+失败量+丢弃量).<br />
                   <span id="drop_opt_wrjt" class="drop_opt_">原计算方式为:丢弃量并入无人接听,接通量=成功量+失败量、接通率=(成功量+失败量)/呼叫总量.选择并入无人接听方式,结果值为实际和坐席通话比.</span><a href='javascript:void(0)' onclick="set_drop_opt('wrjt','up')" title="点击设置本统计方式为默认">设默认</a><br />
                   <span id="drop_opt_jt" class="drop_opt_">新计算方式为:丢弃量并入接通量,接通量=成功量+失败量+丢弃量、接通率=(成功量+失败量+丢弃量)/呼叫总量.选择并入接通量方式,结果值接近中继平台通话比.</span><a href='javascript:void(0)' onclick="set_drop_opt('jt','up')" title="点击设置本统计方式为默认">设默认</a></span></td>
               </tr>
               <tr>
                 <td height="26" align="right" nowrap="nowrap">
                 
                 <ul class="nav nav-pills">
                  <li class="dropdown"> <a class="dropdown-toggle" id="ch_sec_type" href="javascript:void(0)" title="点击设定时间精确度类型"> <span>呼叫时间(小时)</span> <b class="caret"></b> </a>
                    <ul class="dropdown-menu" id="sec_type_list">
                      <li><a href="javascript:void(0);" title="指定呼叫时间查询精确度到小时" t_type="hour">呼叫时间(小时)</a></li>
                      <li><a href="javascript:void(0);" title="指定呼叫时间查询精确度到分钟,本设定只能查询跨度为2天数据" t_type="minute">呼叫时间(分钟)</a></li>
                    </ul>
                  </li>
                </ul>
                 
                 
                 </td>
                 <td height="26" colspan="7"><?php select_date("");?></td>
               </tr>
               <tr>
                 <td height="26" align="right">
                 <input type="text" class="dis_none"  name="status" id="status" value="CG" />
                 <input type="text" class="dis_none"  name="quality_status" id="quality_status" value="" />
                 <input type="text" class="dis_none"  name="agent_list" id="agent_list" value="" />
                 <input type="text" class="dis_none"  name="campaign_id" id="campaign_id" value="" />
                 <input type="text" class="dis_none"  name="phone_lists" id="phone_lists" value="" />
                 
                 </td>
                 <td height="26" colspan="7"><input type="button" name="form_submit" value="提交查询" onClick="check_form('search');" style="cursor:pointer" />
                   <input type="reset" name="button" id="button" value="重置" /></td>
               </tr>
            </table> 
      
          </form>            
            
        </fieldset>
       
     <input type="text" class="dis_none"  name="chart_x_filed_list" id="chart_x_filed_list" value="" />
     <input type="text" class="dis_none"  name="chart_f_re" id="chart_f_re" value="1" />
     <div id="chart_con"></div>
          
        <div id="excels" style="height:22px; line-height:22px;margin-top:8px;position:relative;display:none">
       	  <div style="float:left"><span><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="check_form('excel');"><img src="/images/icons/excel.png" style="margin-top:4px" /><b>导出Excel&nbsp;</b></a></span><span id="excel_addr" style="height:22px; line-height:22px;margin-left:10px"></span></div>
          <div class="chart_toolbar" id="chart_toolbar"><span class="chart_buttons" id="chart_buttons"><a class="chart_left" id="chart_table" ch_type="table" href="javascript:void(0)" title="显示数据表格，并关闭图表" ><span><img src="/images/icons/icons_63.png" /></span>表格</a><a class="chart_right" id="chart_column" ch_type="column" href="javascript:void(0)" title="显示柱形图"><span><img src="/images/icons/icons_48.png" /></span>柱形图</a><a class="chart_right" id="chart_spline" ch_type="spline" href="javascript:void(0)" title="显示线形图"><span><img src="/images/icons/icons_46.png" /></span>线形图</a><a class="chart_right" id="chart_bar" ch_type="bar" href="javascript:void(0)" title="显示条形图"><span><img src="/images/icons/icons_64.png" height="15" /></span>条形图</a><a class="chart_source" id="chart_pie" ch_type="pie" href="javascript:void(0)" title="显示饼形图"><span><img src="/images/icons/icons_28.png" /></span>饼形图</a></span>
          
         </div>
         
        <div id="chart_f_list">
            <form name="chart_f_list_form">
            <div class="head"><span class="green">&nbsp;选择图表数据值</span><span id="chart_tip" style="margin-left:6px" class="red"></span><a href='javascript:void(0)' hidefocus='true' class="close" title="关闭" onclick="javascript:$('#chart_f_list').fadeOut()"></a></div>
               <div class="chart_c_line blue" id="chart_c_x_line">&nbsp;分类项（X轴）</div>
                    <ul id="chart_x_list">
                    </ul>
                 
              <div class="chart_c_line blue" id="chart_c_y_line">&nbsp;图例项（Y轴）</div>
                    <ul id="chart_y_list">
                        
                              
                    </ul>
                 
              <div class="bottom"><input type="checkbox" name="is_datalab" id="is_datalab" value="yes" /> <label for="is_datalab">显示数值</label>  <input type="button" name="" value="确 定" onclick="get_chart_data('业务活动、工作量统计图表')" /> <span style="margin-right:4px"><input type="reset" name="" value="重 置" onclick="javascript:$('#chart_f_list label').removeClass('blue')" /></span></div>
          </form>
          
     </div>
        
   </div>
  <div id="result_div" >
    <table border="0" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" style="margin-top:4px;display:none;width:100%" >
         <thead>
            <tr align="left" class="dataHead">
              <th >数据加载中...</th>
            </tr>
          </thead>   
        <tbody>
        </tbody>
        <tfoot></tfoot>
      </table>
    </div>
  
    </td>
  </tr>
 </table>  
</div>
  
</body>
</html>
 