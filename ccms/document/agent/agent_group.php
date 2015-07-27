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
  	
	var url="action=get_user_group_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+times+"&"+$('#form1').serialize();
 	
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
   
function get_datalist(page_nums,a_ctions,doa_ctions,pagesize,user_group){

	$('#load').show();
	//$("#excel_addr").html('');
	max_pages(pagesize);
	var pages=$("#pagecounts").val();
	if(parseInt(page_nums) < 1)page_nums = 1; 
	if(parseInt(page_nums) > parseInt(pages)){
		page_nums = pages;
	}; 
	if(!(parseInt(page_nums) <= parseInt(pages))) page_nums = pages;	 
	
	var url="action=get_user_group_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&user_group="+user_group+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&"+$('#form1').serialize();
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
					 
					dblclick=" ondblclick=\"edit_user_group(this.id.replace('group_list_',''))\" ";
 					do_edit="<a href='javascript:void(0)' onclick='edit_group_user(\""+con.user_group+"\",\""+con.group_name+"\")' title='点击设置该组成员操作权限'>组成员设置</a> <a href='javascript:void(0)' onclick='edit_pope_group(\""+con.user_group+"\",\""+con.group_name+"\")'>权限设置</a> <a href='javascript:void(0)' onclick='edit_user_group(\""+con.user_group+"\")'>修改</a> <a href='javascript:void(0)' onclick='del_(\""+con.user_group+"\")'>删除</a>";
 					
					tr_str="<tr align=\"left\" id=\"group_list_"+con.user_group+"\" "+dblclick+">";
					tr_str+="<td  align=\"center\"><input name=\"c_id\" type=\"checkbox\" value=\""+con.user_group+"\"/></td>";
					tr_str+="<td >"+con.user_group+"</td>";
					tr_str+="<td >"+con.group_name+"</td>";									
					tr_str+="<td >"+con.user_count+"</td>";
					<!--tr_str+="<td >"+con.forced_timeclock_login+"</td>"; -->
					tr_str+="<td >"+con.shift_enforcement+"</td>";
					tr_str+="<td ><div class=\"hide_tit\" title=\""+con.allowed_campaigns+"\">"+con.allowed_campaigns+"</div></td>";
					tr_str+="<td ><div class=\"hide_tit\" title=\""+con.allowed_campaigns+"\">"+con.agent_status_viewable_groups+"</div></td>";
					 
					tr_str+="<td >"+do_edit+"</td>";
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
  		
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员！\n"+textStatus);
		}
	});
	 
}

function add_user_group(actions){
	var diag =new Dialog("add_user_group");
	diag.Width = 760;
	diag.Height = 460;	
 	diag.Title = "新建坐席组";
	diag.URL = '/document/agent/list.php?action=add_user_group&tits='+encodeURIComponent("新建坐席组");
 	diag.OKEvent = set_add_user_group;
	//diag.CancelEvent = parent_focus;
    diag.show();
}
 
function set_add_user_group(){
	Zd_DW.do_add_user_group();
}
  
function edit_user_group(user_group){
	var diag =new Dialog("edit_user_group_"+user_group);
	diag.Width = 760;
	diag.Height = 460;	
 	diag.Title = "坐席组设置";
	diag.URL = '/document/agent/list.php?action=edit_user_group&user_group='+user_group+'&tits='+encodeURIComponent("坐席组设置");
 	diag.OKEvent = set_edit_user_group;
	//diag.CancelEvent = parent_focus;
    diag.show();
}
 
function set_edit_user_group(){
	Zd_DW.do_edit_user_group();
}

function edit_pope_group(user_group,group_name){
	var diag =new Dialog("edit_pope_group_"+user_group);
	diag.Width = 680;
	diag.Height = 360;	
 	diag.Title = "坐席组权限设置";
	diag.URL = '/document/agent/list.php?action=get_pope_group&group_id='+user_group+'&tits='+encodeURIComponent(group_name);
 	diag.OKEvent = set_pope_group;
	diag.show();
}
 
function set_pope_group(){
	Zd_DW.do_set_pope_group();
}
 
function edit_group_user(user_group,group_name){
	var diag =new Dialog("edit_group_user_"+user_group);
	diag.Width = 880;
	diag.Height = 460;	
 	diag.Title = "坐席组成员操作权限设置";
	diag.URL = '/document/agent/list.php?action=set_group_user&user_group='+user_group+'&tits='+encodeURIComponent(group_name);
 	diag.OKEvent = set_group_user;
	diag.show();
}
 
function set_group_user(){
	Zd_DW.do_set_group_user();
}
 
 
function user_group_change(){
	var diag =new Dialog("user_group_change");
	diag.Width = 580;
	diag.Height = 280;	
 	diag.Title = "坐席组转移";
	diag.URL = '/document/agent/list.php?action=user_group_change&tits='+encodeURIComponent("坐席组转移");
 	diag.show();
	diag.OKButton.hide();
	diag.CancelButton.value="关 闭";
}
    
function get_user_group(){
    if($("#get_group").val()=="0"){
		var datas="action=get_user_group"+times;
		$.ajax({
			 
			url: "send.php",
			data:datas,
			
			success: function(json){ 
			   if(json.counts=="1"){
 				   $.each(json.datalist,function(index,con){
						
						$("#user_group").append("<option value='"+con.user_group+"'>"+con.group_name+"</opton>");
 				   });
				  $("#get_group").val("1");
			   } 
			  
			} 
		});
	
	}
} 
 
 
   
function check_form(actions){	
     
    if (actions == "search") {
  		 
  		$("#datatable").show();
        GetPageCount('search', "count");
        get_datalist(1,"search", "list",$('#pagesize').val());
    }
    	  
}


function del_(c_id){	
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
	datas="action=del_user_group&do_actions=user_group&c_id="+c_id+times;
 	//alert(datas);
    if(confirm("删除后不可恢复，您确定要删除吗？")){
 
		$('#load').show();
		$.ajax({
			 
			url: "send.php",
			data:datas,
			
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
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="20"/> <input name="sorts" type="hidden" id="sorts" value="a.user_group"/> <input name="order" type="hidden" id="order"/>').appendTo("body");
	
	GetPageCount('search',"count");
	get_datalist(1,"search","list",$('#pagesize').val());
});
   
 
</script>
 

</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
 
    
<div class="page_main">
    
     <table border="0" cellpadding="0" cellspacing="0" class="menu_list">
     <tr>
        <td colspan="2"><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="add_user_group('');" title="新建坐席组！"><img src="/images/icons/icon021a12.gif" /><b>新建坐席组&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="user_group_change();" title="将坐席组内用户转移到另一组"><img src="/images/icons/icon025a7.gif" /><b>坐席组转移&nbsp;</b></a></td>
      </tr>
    </table>
                  
     <table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
        <tr>
            <td style="">
          <input type="hidden" name="get_group" id="get_group" value="0" />
          <fieldset><legend> <label onClick="show_div('search_list');" title="点击收缩/展开">查询选项</label></legend>
            <form action="" onSubmit=""  method="post" name="form1" id="form1">       
             <table width="100%" border="0" align="center"  cellspacing="0" id="search_list" class="search_table" >
            
               <tr>
                 <td width="8%" align="right">坐席组ID：</td>
                 <td width="15%" height="">
                 <input name="user_group" type="text" class="input_text" id="user_group" title="输入要查询的坐席组ID，多个以英文“,”分隔"  size="21" onkeyup="this.value=value.replace(/[^\w\/,]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/,]/ig,'')" />
                 </td>
                 <td width="8%" height="26" align="right" id="">坐席组名：</td>
         		 <td nowrap="nowrap"><input name="group_name" type="text" class="input_text" id="group_name" /></td>
                 <td width="8%" align="right">&nbsp;</td>
                 <td>&nbsp;</td>
                 <td width="8%" align="right" id="td">&nbsp;</td>
                 <td>&nbsp;</td>
                 
               </tr>
               <tr>
                 <td align="right"> 
                  </td>
                 <td colspan="7"><input type="button" name="form_submit" value="提交查询" onClick="check_form('search');" style="cursor:pointer" />
                   <input type="reset" name="button" id="button" value="重置" /></td>
               </tr>
              </table> 
      
            </form>
          </fieldset>       
             
            <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
              <thead>
                <tr align="left" class="dataHead">
                  <th style="width:4%;"><input name="CheckedAll" type="checkbox" id="CheckedAll" /><a href="javascript:void(0);" onclick="del_(0);" title="删除选定数据" style="font-weight:normal">删除</a></th>             
                  <th sort="a.user_group" >坐席组ID</th>
                  <th sort="group_name" >坐席组名</th>
                  
                  <th sort="user_count" >用户数</th>
                 <!-- <th sort="forced_timeclock_login">强制时间锁登陆</th> -->
                  <th sort="shift_enforcement">强制班次</th>
                  
                  <th sort="allowed_campaigns" >可使用业务</th>
                  <th sort="agent_status_viewable_groups">可查看组</th>
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
   
