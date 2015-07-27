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
  	
	var url="action=get_lead_lists&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+times+"&"+$('#form1').serialize();
 	
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
	
	var url="action=get_lead_lists&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&"+$('#form1').serialize();
	
	//return false;
	
	$.ajax({
		 
		url: "send.php",
		data:url,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');if(doa_ctions=="xls"||doa_ctions=="txt"){request_tip("系统正在为您导出，此过程较慢，请耐心等候...","1",25000);}},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
			
			if(doa_ctions=="list"){
				$("#datatable,#excels").show();
				$("#datatable tfoot tr").show();
				if(parseInt(json.counts)>0){
					 
					$("#datatable tbody tr").remove();
					var tits="",td_str="",fun_str="",qua_str="";
					$.each(json.datalist, function(index,con){
						 
						disabled="";
						dblclick=" ondblclick='edit_lead(\""+con.lead_id+"\")' ";
						do_edit="<a href='javascript:void(0)' onclick='edit_lead(\""+con.lead_id+"\")'>修改</a> <a href='javascript:void(0)' onclick='del_(\""+con.lead_id+"\",\""+ con.list_id+ "\")'>删除</a>";
						 
						tr_str="<tr align=\"left\" id=\"leads_"+con.lead_id+"\" "+dblclick+" >";
						tr_str+="<td align=\"center\"><input name=\"c_id\" type=\"checkbox\" value=\""+con.lead_id+"\" "+disabled+" /></td>";
						tr_str+="<td>"+con.phone_number+"</td>";
						tr_str+="<td><div class='hide_tit' title='"+con.title+"'>"+con.title+"</div></td>";
						tr_str+="<td><div class='hide_tit' title='"+con.comments+"'>"+con.comments+"</div></td>";
						tr_str+="<td>"+con.status_names+"</td>";
						tr_str+="<td>"+con.list_names+"</td>";
						tr_str+="<td>"+con.called_since_last_reset+"</td>";
						tr_str+="<td>"+con.last_local_call_time+"</td>";
						tr_str+="<td>"+con.entry_date+"</td>";
						tr_str+="<td>"+do_edit+"</td>";
						tr_str+="</tr>";
						$("#datatable tbody").append(tr_str);
					}); 
					
					OutputHtml(page_nums,pagesize);
				
				}else{
					$("#datatable tfoot tr").hide();
					$("#datatable tbody tr").remove();
					$("#excels").hide();
					tr_str="<tr><td colspan=\"12\" align=\"center\">"+json.des+"</td></tr>"
					$("#datatable").append(tr_str);
				}  
				d_table_i();
				
			}else{
				
			    request_tip(json.des,json.counts);
				if(doa_ctions=="xls"){
					
				   if(json.counts=="1"){
					   $("#excel_addr").html("下载：<a href='"+json.file_path+json.file_name+"' target='_blank'>"+json.file_name+"</a>");
				   }else{
					   $("#excel_addr").html(json.des);   
				   }
				   
				}else{
					
				   if(json.counts=="1"){
					   $("#csv_addr").html("下载：<a href=\"javascript:void(0);\" onclick=\"file_down('../.."+json.file_path+json.file_name+"','"+json.file_name+"')\" title=\"点击下载导出清单,请不要使用迅雷下载！\">"+json.file_name+"</a>");
				   }else{
					   $("#csv_addr").html(json.des);   
				   }
				}
			}
  		
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员！\n"+textStatus);
		}
	});
	 
}

function add_list(actions){
	var diag =new Dialog("add_list");
    diag.Width = 620;
    diag.Height = 320;
 	diag.Title = "新建客户清单";
	diag.URL = '/document/lists/list.php?action=add_list&tits='+encodeURIComponent("新建客户清单");
 	diag.OKEvent = set_add_list;
	//diag.CancelEvent = parent_focus;
    diag.show();
}
 
function set_add_list(){
	Zd_DW.do_add_list();
}
  
function edit_lead(lead_id){
	var diag =new Dialog("edit_list_"+lead_id);
    diag.Width = 800;
    diag.Height = 420;
 	diag.Title = "号码信息设置";
	diag.URL = '/document/lists/list.php?action=edit_leads&lead_id='+lead_id+'&tits='+encodeURIComponent("号码信息设置");
 	diag.OKEvent = set_edit_lead;
	//diag.CancelEvent = parent_focus;
    diag.show();
}
 
function set_edit_lead(){
	Zd_DW.do_edit_lead();
}
 
function leads_load(){
	var diag =new Dialog("leads_load_");
    diag.Width = $(window).width() - 26;
    diag.Height = $(window).height()-50;
 	diag.Title = "导入清单号码";
	diag.URL = '/document/lists/list.php?action=leads_load&tits='+encodeURIComponent("导入清单号码");
  	diag.show();
	diag.OKButton.hide();
	diag.CancelButton.value="关 闭";
}
    
    
function check_form(actions){	
     if (actions == "search") {
  		 
  		$("#datatable").show();
        GetPageCount('search', "count");
        get_datalist(1,"search", "list",$('#pagesize').val());
    }
	 
	if (actions == "xls") {
		if($("#recounts").val()>30000){
			if(confirm("当前查询数据量过大，导出Excel将耗费较大的系统资源，同时产生的文件会较大！\n\n是否转为导出csv格式？\n点 确定 导出文本文档Txt，点 取消 继续导出Excel！")){
				
				get_datalist(1,"search", "csv",$('#pagesize').val());
			}else{
				get_datalist(1,"search", "xls",$('#pagesize').val());
			}
		
		}else{
			get_datalist(1,"search", "xls",$('#pagesize').val());
		}
		
	}
	 
	if (actions == "csv") {
  		get_datalist(1,"search", "csv",$('#pagesize').val());
	}
 	
    if (actions == "del") {
		
		if(confirm("删除操作将会把号码基本资料、呼叫描述等信息一并删除！\n如果近期呼叫过本号码，建议先导出备份或隔段时间后再行删除！\n\n点 确定 继续执行删除，点 取消 返回！")){
			
			var url="action=get_lead_lists&pages=1&actions=&do_actions=del&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&"+$('#form1').serialize();
			request_tip("系统正在执行删除，请稍候...","1");
			$('#load').show();
			
			$.ajax({
				 
				url: "send.php",
				data:url,
				
				beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
				complete :function(){$('#load').hide('100');},
				success: function(json){ 
					request_tip(json.des,json.counts);
					if(json.counts=="1"){
						GetPageCount($("#a_ctions").val(),"count");
						get_datalist($("#pages").val(),$("#a_ctions").val(),"list",$('#pagesize').val());
					}else{
						alert(json.des);   
					}
										
				},error:function(XMLHttpRequest,textStatus ){
					alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
				}
			});			
			
		}
		
    }
  	  
}


function del_(c_id,l_id){	
 	var datas="";
 	if (c_id!="0"&&c_id!=""){
 	}else{
		c_id="";
 		$('input[name="c_id"]:checked').each(function(i){
			c_id+=""+$(this).val()+",";
 		}); 
		
		if(c_id!=""&&c_id.substr(c_id.length-1)==","){
			c_id=c_id.substr(0,c_id.length-1);
		}
 	}
	if (c_id==""){
		alert("请选择要删除的行！");
		return false;
	}
	datas="action=del_leads&c_id="+c_id + "&list_id="+ l_id +times;
 	//alert(datas);
    if(confirm("删除操作将会把号码基本资料、呼叫描述等信息一并删除！\n如果近期呼叫过本号码，建议先导出备份或隔段时间后再行删除！\n\n点 确定 继续执行删除，点 取消 返回！")){
 
		$('#load').show();
		$.ajax({
			 
			url: "send.php",
			data:datas,
			
			beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
			complete :function(){$('#load').hide('100');},
			success: function(json){ 
				request_tip(json.des,json.counts);
				if(json.counts=="1"){
					$("#CheckedAll").attr("checked",false);
					GetPageCount($("#a_ctions").val(),"count");
					get_datalist($("#pages").val(),$("#a_ctions").val(),"list",$('#pagesize').val());
 				}else{
					alert(json.des);   
				}
 									
			},error:function(XMLHttpRequest,textStatus ){
				alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
			}
		});
   	}
}
  
 
$(document).ready(function(){
	$("#CheckedAll").click(function(){
		var checkbox=$('[name=c_id]:checkbox:enabled');
 		if(this.checked==true){
			$(checkbox).attr("checked",this.checked).parent().parent().addClass("click");
 		}else{
			$(checkbox).attr("checked",this.checked).parent().parent().removeClass("click");
		}
	});	
	
 	var Sorts_Order=0;
	$("#datatable .dataHead th[sort]").map(function(){
		Sorts_Order=Sorts_Order+1;
		
		html=$(this).html();
		
		$(this).attr("id","DadaSorts_"+Sorts_Order).off().on("click",function(){
			Sorts_new("datatable",$(this).attr("id"),$("#pagesize").val());	
		}).html("<div>"+html+"<span class='sorting'></span></div>");
		
 	}) ;
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="20"/> <input name="sorts" type="hidden" id="sorts" value="entry_date"/> <input name="order" type="hidden" id="order"/>').appendTo("body");
	days_ready();
	$("#datatable,#excels").hide();
	get_select_opt('','../campaign/send.php','get_dial_status','dial_status','def');
});
    
 
</script>
<script type="text/javascript" src="/js/calendar.js"></script>

<style>
.hide_tit{width:120px;}
</style>

</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
 
    
<div class="page_main">
    
     <table border="0" cellpadding="0" cellspacing="0" class="menu_list">
     <tr>
        <td colspan="2"><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="leads_load();" title="导入清单号码！"><img src="/images/icons/telephone11.png" style="margin-top:6px"/><b>导入清单号码&nbsp;</b></a></td>
      </tr>
    </table>
                  
     <table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
        <tr>
            <td >
          <input type="hidden" name="get_dial_method" id="get_dial_method" value="0" />
          <input type="hidden" name="get_dial_status" id="get_dial_status" value="0" />
          
          <fieldset><legend> <label onClick="show_div('search_list');" title="点击收缩/展开">查询选项</label></legend>
            <form action="" onSubmit=""  method="post" name="form1" id="form1">   
             <table width="100%" border="0" align="center"  cellspacing="0" id="search_list" class="search_table" >
            
               <tr>
                 <td width="8%" align="right">号码ID：</td>
                 <td height="">
                 <input name="lead_id" type="text" class="input_text" id="lead_id" title="输入要查询的号码ID，多个以英文“,”分隔"  size="21" onkeyup="this.value=value.replace(/[^\w\/,]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/,]/ig,'')" />
                 </td>
                 <td width="8%" height="26" align="right" id="">电话号码：</td>
         		 <td nowrap="nowrap"><input name="phone_number" type="text" class="input_text" id="phone_number"  onkeyup="this.value=value.replace(/[^\d|,]/g,'')" onafterpaste="this.value=value.replace(/[^\d|,]/g,'')"/></td>
                  <td width="8%"  align="right" id="">号码精度：</td>
                 <td  nowrap="nowrap"><select name="search_accuracy" class="s_option" id="search_accuracy">
                      	<option value="=">等于</option>
                      	<option value="in">包含</option>
                      	<option value="not in">不包含</option>
                      	<option value="like_top">匹配开头</option>
                       	<option value="like_end">匹配结尾</option>
                      	<option value="like">模糊</option>
                       </select>
                  </td>

                 <td align="right">呼叫状态：</td>
                 <td><select name="dial_status" class="s_option" id="dial_status"><option value="" selected="selected">请选择呼叫状态</option><option value="XXXXXNONE" disabled="disabled">------------------------</option></select></td>
                 
               </tr>
               <tr>
                 <td align="right">客户清单：</td>
                 <td><input name="phone_lists_list" type="text" class="input_text2" id="phone_lists_list"  title="双击选择客户清单"  size="16"  readonly="readonly"  onDblClick="c_phone_lists('get_phone_lists');" /><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择客户清单" onClick="c_phone_lists('get_phone_lists');"></a></td>
                 <td  align="right">号码标题：</td>
                 <td ><input name="title" type="text" class="input_text" id="title" title="输入要查询的号码标题"  maxlength="30" /></td>
                 <td  align="right">号码描述：</td>
                 <td ><input name="comments_des" type="text" class="input_text" id="comments_des" title="输入要查询的备注描述" maxlength="30" /></td>
                 <td align="right">是否可拨：</td>
                 <td>
                 <select name="called_since_last_reset" class="s_option" id="called_since_last_reset">
                 	<option value="" selected="selected">请选择是否可拨打</option>
                    <option value="N" >是</option>
                    <option value="Y" >否</option>
                    
                 </select>
                 </td>
               </tr>
               <tr>
                 <td  align="right" nowrap="nowrap">导入时间：</td>
                 <td  colspan="7"><?php select_date("");?></td>
               </tr>
               <tr>
                 <td  align="right"> 
                 <input type="hidden" name="phone_lists" id="phone_lists" value="" />
                  
                 <td  colspan="7"><input type="button" name="form_submit" value="提交查询" onClick="check_form('search');" style="cursor:pointer" />
                   <input type="reset" name="button" id="button" value="重置" /></td>
               </tr>
              </table> 
      
            </form>
          </fieldset>       
            <div id="excels"  style="height:22px; line-height:22px;"><span><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="check_form('xls');" title="导出到Excel"><img src="/images/icons/excel.png" style="margin-top:4px" /><b>导出到Xls&nbsp;</b></a><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="check_form('csv');" title="导出文本文档"><img src="/images/icons/notebook.png" style="margin-top:4px" /><b>导出到Csv&nbsp;</b></a><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="check_form('del');" title="将本查询结果的所有数据删除，请谨慎操作！"><img src="/images/icon_cancel.gif" style="margin-top:4px"/><b>删除全部&nbsp;</b></a></span><span id="excel_addr" style="height:22px; line-height:22px;margin-left:10px"></span><span id="csv_addr" style="height:22px; line-height:22px;margin-left:10px"></span></div> 
        <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
                  <thead>
                    <tr align="left" class="dataHead">
                      <th style="width:4%;"><input name="CheckedAll" type="checkbox" id="CheckedAll" /><a href="javascript:void(0);" onclick="del_(0,0);" title="删除选定数据" style="font-weight:normal">删除</a></th>             
                      <th sort="vicidial_list.phone_number" >电话号码</th>
                      <th sort="vicidial_list.title" >标题</th>
                      
                      <th sort="vicidial_list.comments">描述</th>
                      <th sort="vicidial_list.status">呼叫状态</th>
                      <th sort="c.list_name" >客户清单</th>
                      <th sort="called_since_last_reset" title="指该号码是否被重置呼叫">是否可拨</th>
                      <th sort="vicidial_list.last_local_call_time">最后呼叫</th>
                      <th sort="vicidial_list.entry_date">导入时间</th>
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
</div>
 
</body>
</html>
   
