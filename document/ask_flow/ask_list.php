<?php 
require("../../inc/config.ini.php");
$ask_id=trim($_REQUEST["ask_id"]);
?>
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
var tab_sort=[["被叫号码","a.phone_number"],["坐席工号","a.user"],["呼叫结果","a.status"],["业务活动","a.campaign_id"],["质检结果","a.quality_status"],["呼叫时间","a.call_date"]];
 
function GetPageCount(a_ctions,doa_ctions){
		
	$("#que_field_2").val("");
	$("#que_field_1").val("");
	
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
 	var url="action=ask_result_export&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+times+"&"+$('#form1').serialize();
 	//alert(url);
	$.ajax({
		
		url: "send.php",
		data: url,
 		//async: false,
		cache: false,
 		success: function(json){
			$("#que_field_2").val(json.que_field_2);
			$("#que_field_1").val(json.que_field_1);
			$("#datatable thead tr th").remove();
			var td="";
			
			for(var i=0;i<json.field_name_list.length;i++){
				if(json.field_name_list[i]=="被叫号码"||json.field_name_list[i]=="坐席工号"||json.field_name_list[i]=="呼叫结果"||json.field_name_list[i]=="业务活动"||json.field_name_list[i]=="质检结果"||json.field_name_list[i]=="呼叫时间"){
					k=i+1;
					clk_event="  sort='"+tab_sort[i][1]+"' "
					span="<span class='sorting'></span>";
				}else{
					clk_event="";	
					span="";
				}
				td+="<th "+clk_event+">"+json.field_name_list[i]+span+"</th>";
			}
			$("#datatable thead tr").append(td); 
			
			var Sorts_Order=0;
			$("#datatable .dataHead th[sort]").map(function(){
				Sorts_Order=Sorts_Order+1;
				
				html=$(this).html();
				
				$(this).attr("id","DadaSorts_"+Sorts_Order).off().on("click",function(){
					Sorts_new("datatable",$(this).attr("id"),$("#pagesize").val());	
				}).html("<div>"+html+"<span class='sorting'></span></div>");
				
			}) ;
			 
			$("#recounts").val(json.counts);
			max_pages($("#pagesize").val());
			OutputHtml($("#pages").val(),$("#pagesize").val());
		} 
	});
	 
}
   
function get_datalist(page_nums,a_ctions,doa_ctions,pagesize){
	
	$("#load,#datatable").show();
	$("#xls_addr").html('');
	max_pages(pagesize);
	var pages=$("#pagecounts").val(),ask_id=$("#ask_id").val();
	if(parseInt(page_nums) < 1)page_nums = 1; 
	if(parseInt(page_nums) > parseInt(pages)){
		page_nums = pages;
	}; 
	if(!(parseInt(page_nums) <= parseInt(pages))) page_nums = pages;	 
	
	var url="action=ask_result_export&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&"+$('#form1').serialize();
   	//$("#test_des").val(url);
	//return false;
	$.ajax({
		 
		url: "send.php",
		data:url,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){
			jsons=json;
			//request_tip(json.des,1);
			if(doa_ctions=="excel"){
				
			   request_tip(json.des,json.counts);
			   if(json.counts=="1"){
				   $("#"+$("#file_type").val()+"_addr").html("下载：<a href='"+json.file_path+json.file_name+"' target='_blank'>"+json.file_name+"</a>");
			   }else{
				   $("#"+$("#file_type").val()+"_addr").html(json.des);   
			   }
			}else{
  				var td="",tr="",clk_event="",span="";
				
				data_width=data_width1;
				$("#datatable tbody tr").remove();
				$("#datatable tfoot tr").show();
				 
				if(parseInt(json.counts)>0){
					$("#excels").show();
					var tits="";td_str="";
					$.each(json.datalist, function(index,con){
						tr_str="<tr align=\"left\" id=\"ask_result_"+index+"\">";
						for(var key in con){
							kay_v_=con[key];							
							if(kay_v_==null){kay_v_=""}
							
							if(key=="操作"){
								key_v_s=kay_v_;
								if(key_v_s==null){key_v_s="1|2|3"}
								v_ary=key_v_s.split("|");
								uniqueid=v_ary[0];
								lead_id=v_ary[1];
								locations=v_ary[2];
								
								if (locations!="同步中"){									 
									 
 									tr_str+="<td algin=\"center\" nowrap><a href=\"javascript:void(0);\" onClick=\"veiw_Quality('"+uniqueid+"','"+lead_id+"','','"+index+"','"+ask_id+"');\" title=\"点击质检本次营销\">质检</a>&nbsp;<a href=\"javascript:void(0);\" onClick=\"play_wav(event,'play_layer','"+locations+"');\" title=\"点击收听本次营销录音\">收听</a>&nbsp;<a href=\""+locations+"\" target=\"_blank\" title=\"点击下载本次营销录音\">下载</a></td>";
								}else{
									tr_str+="<td nowrap>"+locations+"</td>";
								}
   								 
							}else{
								tr_str+="<td nowrap>"+kay_v_+"</td>";
							}
						}
						tr_str+="</tr>";
						$("#datatable tbody").append(tr_str);
					}); 
					 
					OutputHtml(page_nums,pagesize);
 				}else{
					$("#excels").hide();
					$("#datatable tfoot tr").hide();
					tr_str="<tr><td colspan=\"39\" align=\"left\">"+json.des+"</td></tr>"
					$("#datatable").append(tr_str);
					 
					data_width=data_width3;
				}  
				setTimeout("d_table_i();",300);
 				 
				var div_h=parseInt($("#s_fieldset").outerHeight())+parseInt($("#datatable").outerHeight());
				var win_w=parseInt($(window).width()),o_win_w=parseInt($("#window_width").val());
 				 
				if(win_w<o_win_w){
					win_w=o_win_w;
				}
				/*
				if(div_h<$(window).height()){
					data_width=data_width2;
 				}*/
   				
 				$("#result_div").css({"width":win_w-data_width+"px","height":$("#datatable").height()+30+"px"}); 
				$("#dataTableFoot").css({"width":win_w-data_width+"px"});
			} 
		},error:function(XMLHttpRequest,textStatus ){
		   alert("页面请求错误，请检查重试或联系管理员！\n"+textStatus);
		}
	});
	 
}

function veiw_Quality(uniqueid,lead_id,campaign_name,index,ask_id){
	var diag =new Dialog(uniqueid);
	diag.Width = $(window).width();
    diag.Height = $(window).height();
 	diag.Title = "录音质检";
	campaign_name=$("#ask_result_"+index+" td:eq(2)").html();
   	diag.URL = '/document/ask_flow/ask_detail_qua.php?uniqueid='+uniqueid+'&lead_id='+lead_id+'&ask_id='+encodeURIComponent(ask_id)+'&index='+index;
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

function get_ask_all_list(ask_id){
	 
  	var datas="action=get_ask_list&do_actions=all_list"+times;
	//alert(datas);
	$.ajax({
		 
		url: "send.php",
		data:datas,
		
  		success: function(json){ 
				 
    		$.each(json.datalist,function(index,con){
				 
 				$("<option value='"+con.ask_id+"' title='"+con.ask_title+"--"+con.ask_des+"' >"+con.ask_title+" ["+con.ask_id+"]</option>").appendTo($("#ask_id"));
 				
			})
		}
	});
	
}


function check_form(actions){	
    
	if($("#ask_id").val()==""){
		request_tip("请选择需要查询的问卷！",0);
		$("#ask_id").focus();
		return false;	
	}
	
    if (actions == "search") {
  		 
        GetPageCount('search', "count");
        get_datalist(1,"search","list",$("#pagesize").val());
    }
   	  
	if (actions == "excel_field") {
		
  		request_tip("系统正在为您导出，此过程较慢，请耐心等候...",1,25000);
 		get_datalist(1,"search","excel",$("#pagesize").val());
	}
	  
}

function c_que_list(actions){
 	var diag =new Dialog("diag_c_que_list");
 	diag.Width = 680;
	diag.Height = 380;
 	diag.Title = "选择需导出问题步骤";
  	diag.URL = "/document/ask_flow/list.php?action="+actions+"&tits="+encodeURIComponent("选择需导出问题步骤")+"&ask_id="+$("#ask_id").val();
 	diag.OKEvent = set_que_list;
    diag.show();
}
 
function set_que_list(){
	Zd_DW.do_set_que_list();
} 

function c_field_list(actions,file_type){
	$("#file_type").val(file_type);
 	var diag =new Dialog("diag_get_fields_list");
 	diag.Width = 500;
	diag.Height = 240;
 	diag.Title = "选择详单导出字段";
 	diag.URL = "/document/report/list.php?action="+actions+"&tits="+encodeURIComponent("选择详单导出字段");
  	diag.OKEvent = setfields_list;
    diag.show();
}
 
function setfields_list(){
	Zd_DW.do_setfields_list();
} 

$(document).ready(function(){
	 
	var Sorts_Order=0;
	$("#datatable .dataHead th[sort]").map(function(){
		Sorts_Order=Sorts_Order+1;
		
		html=$(this).html();
		
		$(this).attr("id","DadaSorts_"+Sorts_Order).off().on("click",function(){
			Sorts_new("datatable",$(this).attr("id"),$("#pagesize").val());	
		}).html("<div>"+html+"<span class='sorting'></span></div>");
		
 	});
 
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="20"/> <input name="sorts" type="hidden" id="sorts" value="a.call_date"/> <input name="order" type="hidden" id="order"/>').appendTo("body");
	$("#window_width").val($(window).width());
	days_ready();
	$("#excels,#datatable").hide();
 	if(isIE){
		data_width1=28;
		data_width2=14;
		data_width3=14;
	}else{
		data_width1=38;
		data_width2=24;
		data_width3=12;
	}
});
   
 
</script>
<script type="text/javascript" src="/js/calendar.js"></script>
 
</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
<input type="hidden" name="window_width" id="window_width" value="" />
<div class="page_nav">
     <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
     <div class="nav_">当前位置：<a href="javascript:void(0);">问卷调查</a> &gt; 问卷详单查询</div>
     <div class="nav_other"><a href="javascript:void(0);" onClick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
 
</div>    
<div class="page_main">
  <table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
     <tr>
            <td style="">
          <input type="hidden" name="get_ask_id" id="get_ask_id" value="0" />      
          <fieldset id="s_fieldset"><legend> <label onClick="show_div('search_list');" title="点击收缩/展开">查询选项</label></legend>
            <form action="" onSubmit=""  method="post" name="form1" id="form1">
             <input type="hidden" name="file_type" id="file_type" value="" />   
             <table width="100%" border="0" align="center"  cellspacing="0" id="search_list" class="search_table" >
            
               <tr>
                 <td width="8%" height="26" align="right">被叫号码：</td>
                 <td height="26"><input name="phone_number" type="text" class="input_text" id="phone_number" title="输入要查询的被叫号码，多个以英文“,”分隔"  size="21" onkeyup="this.value=value.replace(/[^\d|,]/g,'')" onafterpaste="this.value=value.replace(/[^\d|,]/g,'')" /></td>
                 <td width="10%" height="26" align="right" id="">号码精度：</td>
         <td height="26" nowrap="nowrap"><select name="search_accuracy" class="s_option" id="search_accuracy">
                      	<option value="=">等于</option>
                      	<option value="in">包含</option>
                      	<option value="not in">不包含</option>
                      	<option value="like_top">匹配开头</option>
                       	<option value="like_end">匹配结尾</option>
                      	<option value="like">模糊</option>
                       </select></td>
                       <td width="8%" height="26" align="right" id="td">质检结果：</td>
                 <td height="26"><input name="quality_status_list" type="text" class="input_text2" id="quality_status_list"  title="双击选择质检结果"  size="14"  readonly="readonly"  onDblClick="c_quality_status_list('get_quality_status_list');" /><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择质检结果" onClick="c_quality_status_list('get_quality_status_list');"></a></td>
                 <td width="8%" align="right">坐席工号：</td>
                 <td><input name="agent_name_list" type="text" class="input_text2" id="agent_name_list"  title="双击选择坐席工号" size="16" readonly="readonly"  onDblClick="c_agent_list('get_agent_list');"/><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择坐席工号" onClick="c_agent_list('get_agent_list');"></a></td>
                  
               </tr>
               <tr>
                 <td align="right">问题步骤：</td>
                 <td><input name="que_name_list" type="text" class="input_text2" id="que_name_list"  title="双击选择问题步骤"  size="16"  readonly="readonly"  onDblClick="c_que_list('get_ask_que_list');" /><a class="sel_" hidefocus="true" href="javascript:void(0);" title="双击选择问题步骤" onClick="c_que_list('get_ask_que_list');"></a></td>
                 <td height="26" align="right">呼叫结果：</td>
                 <td height="26"><input name="status_list" type="text" id="status_list"  title="双击选择呼叫结果" value="成功" size="14" readonly="readonly" onDblClick="c_status_list('get_status_list2');" class="input_text2"/><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择呼叫结果" onClick="c_status_list('get_status_list2');"></a></td>
                 <td width="10%" align="right">业务活动：</td>
                 <td><input name="campaign_id_list" type="text" class="input_text2" id="campaign_id_list"  title="双击选择业务活动"  size="16"  readonly="readonly"  onDblClick="c_campaign_id_list('get_campaign_id_list');" /><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择业务活动" onClick="c_campaign_id_list('get_campaign_id_list');"></a></td>
                 
                 
                 <td align="right">客户清单：</td>
                 <td><input name="phone_lists_list" type="text" class="input_text2" id="phone_lists_list"  title="双击选择客户清单"  size="16"  readonly="readonly"  onDblClick="c_phone_lists('get_phone_lists');" /><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择客户清单" onClick="c_phone_lists('get_phone_lists');"></a></td>
                 
               </tr>
               <tr>
                 <td height="26" align="right" nowrap="nowrap">呼叫时间：</td>
                 <td height="26" colspan="3"><?php select_date("");?></td>
                 
                 <?php if($ask_id!=""){ ?>
                 <td align="right">结果匹配：</td>
                 <td colspan="2"><input name="is_ask_result" type="checkbox" id="is_ask_result" value="y" checked="checked" /><label class="gray" for="is_ask_result">只查提交结果数据</label><input type="hidden" name="ask_id" id="ask_id" value="<?php echo $ask_id ?>" /></td>
                 <td></td>
                 <?php }else{  ?>
                 <td height="26" align="right" >调查问卷：</td>
                 <td height="26"><select name="ask_id" class="s_option" id="ask_id" ><option value="" title="请选择需查询的问卷">请选择需查询的问卷</option><option value="XXXXXNONE" disabled="disabled">------------------------</option></select></td>
                 <td align="right">结果匹配：</td>
                 <td ><input name="is_ask_result" type="checkbox" id="is_ask_result" value="y" checked="checked" /><label class="gray" for="is_ask_result">只查提交结果数据</label><script>get_select_opt('','send.php','get_ask_all_list','ask_id','def','&o_val_type=ask_id');</script></td>
                 <?php } ?>
               </tr>
               <tr>
                 <td height="26" align="right"><input type="hidden" name="status" id="status" value="CG" />
                 <input type="hidden" name="quality_status" id="quality_status" value="" />
                 <input type="hidden" name="agent_list" id="agent_list" value="" />
                 <input type="hidden" name="campaign_id" id="campaign_id" value="" />
                 <input type="hidden" name="phone_lists" id="phone_lists" value="" />
                 <input type="hidden" name="field_list" id="field_list" value="" />
                 <input type="hidden" name="que_id" id="que_id" value="" />
                 
                 <input type="hidden" name="que_field_2" id="que_field_2" value="" />
                 <input type="hidden" name="que_field_1" id="que_field_1" value="" />
                 </td>
                 <td height="26" colspan="7"><input type="button" name="form_submit" value="提交查询" onClick="check_form('search');" style="cursor:pointer" />
                   <input type="reset" name="button" id="button" value="重置" /></td>
               </tr>
              </table> 
      
            </form>
          </fieldset>       
             
            <div id="excels" style="height:22px; line-height:22px; margin-top:8px;position:relative;"><span><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="c_field_list('get_fields_list','xls');"><img src="/images/icons/excel.png" style="margin-top:4px" /><b>导出Xls&nbsp;</b></a><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="c_field_list('get_fields_list','csv');" title="导出详单到txt"><img src="/images/icons/notebook.png" style="margin-top:4px"/><b>导出Csv&nbsp;</b></a></span><span id="xls_addr" style="height:22px; line-height:22px;margin-left:10px"></span><span id="csv_addr" style="height:22px; line-height:22px;margin-left:10px"></span></div> 
            
            <div id="result_div" style="position:relative" >
            
                 <table border="0" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" style="margin-top:4px" >
                      <thead>
                        <tr align="left" class="dataHead">
                          <th >数据加载中...</th>
                        </tr>
                      </thead>   
                    <tbody>
                        <tr><td style="height:1px;line-height:1px;border-bottom:0"></td></tr>
                    </tbody>
                    <tfoot><tr class='dataTableFoot'><td colspan='38' align='left'><div id='dataTableFoot' style="position:relative;"><div style='left:2px;' id='total'></div><div style='right:10px; position:absolute;height:18px;top:0px' id='pagelist'></div></div></td></tr></tfoot>
              </table>
              
            </div>   
      </td>
  </tr>
 </table> 
  
 </div>

 
</body>
</html>
   
