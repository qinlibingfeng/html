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
function GetPageCount(a_ctions,doa_ctions)
    {
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
  	
	var url="action=get_phone_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+times+"&"+$('#form1').serialize();
 	
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
   
function get_datalist(page_nums,a_ctions,doa_ctions,pagesize,user_id){

	$('#load').show();
	//$("#excel_addr").html('');
	max_pages(pagesize);
	var pages=$("#pagecounts").val();
	if(parseInt(page_nums) < 1)page_nums = 1; 
	if(parseInt(page_nums) > parseInt(pages)){
		page_nums = pages;
	}; 
	if(!(parseInt(page_nums) <= parseInt(pages))) page_nums = pages;	 
	
	var url="action=get_phone_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&user_id="+user_id+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&"+$('#form1').serialize();
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
					 
					disabled="disabled";	
					do_edit="修改 删除";
					dblclick="";
 					
					tr_str="<tr align=\"left\" id=\"phone_list_"+con.extension+"\" "+dblclick+">";
					tr_str+="<td  align=\"center\"><input name=\"c_id\" type=\"checkbox\" value=\""+con.extension+"\" "+disabled+"/></td>";
					tr_str+="<td >"+con.extension+"</td>";
					tr_str+="<td >"+con.fullname+"</td>";
					tr_str+="<td >"+con.protocol+"</td>";
					tr_str+="<td >"+con.server_ip+"</td>";
					tr_str+="<td >"+con.dialplan_number+"</td>";
					tr_str+="<td >"+con.status+"</td>";
					tr_str+="<td >"+con.active+"</td>";
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

function add_user(actions){
	var diag =new Dialog("add_user");
	diag.Width = 700;
	diag.Height = 430;	
 	diag.Title = "新建分机";
	diag.URL = '/document/agent/list.php?action=add_user&tits='+encodeURIComponent("新建分机");
 	diag.OKEvent = set_add_user;
	//diag.CancelEvent = parent_focus;
    diag.show();
}
 
function set_add_user(){
	Zd_DW.do_add_user();
}
  
function edit_user(user_id){
	var diag =new Dialog("edit_user_"+user_id);
	diag.Width = 700;
	diag.Height = 430;	
 	diag.Title = "分机设置";
	diag.URL = '/document/agent/list.php?action=edit_user&user_id='+user_id+'&tits='+encodeURIComponent("分机设置");
 	diag.OKEvent = set_edit_user;
	//diag.CancelEvent = parent_focus;
    diag.show();
}
 
function set_edit_user(){
	Zd_DW.do_edit_user();
}

function parent_focus(){
	Zd_DW.parent_focus();
}
   
   
function copy_user(){
	var diag =new Dialog("copy_user_");
	diag.Width = 580;
	diag.Height = 240;	
 	diag.Title = "复制分机";
	diag.URL = '/document/agent/list.php?action=copy_user&tits='+encodeURIComponent("复制分机");
 	diag.OKEvent = set_copy_user;
    diag.show();
}
 
function set_copy_user(){
	Zd_DW.do_copy_user();
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
 
 
   
function check_form(actions)
 {	
     
    if (actions == "search") {
  		 
  		$("#datatable").show();
        GetPageCount('search', "count");
        get_datalist(1,"search", "list",$('#pagesize').val());
    }
	 
	 
  	  
}


function del_(c_id)
{	
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
	datas="action=del_user&do_actions=user&c_id="+c_id+times;
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
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="20"/> <input name="sorts" type="hidden" id="sorts" value="fullname"/> <input name="order" type="hidden" id="order"/>').appendTo("body");
	
	GetPageCount('search',"count");
	get_datalist(1,"search","list",$('#pagesize').val());
});
   
function select_time_zone(zone){
	if (zone==""){
		$("#time_len").css("display","none");
		$("#time_len").val("");
	}else{
		$("#time_len").css("display","block");
	}
}
</script>
 

</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
 
    
<div class="page_main">
    
     <table border="0" cellpadding="0" cellspacing="0" class="menu_list">
     <tr>
        <td colspan="2"><a href='javascript:void(0);' class='zPushBtn zPushBtnDisabled' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true"  title="新建分机！"><img src="/images/icons/icon004a2.gif" /><b>新建分机&nbsp;</b></a></td>
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
                 <td width="8%" align="right">分机号：</td>
                 <td width="15%" height="">
                 <input name="user" type="text" class="input_text" id="user" title="输入要查询的分机号，多个以英文“,”分隔"  size="21" onkeyup="this.value=value.replace(/[^\w\/,]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/,]/ig,'')" />
                 </td>
                 <td width="8%" height="26" align="right" id="">分机名称：</td>
         		 <td nowrap="nowrap"><input name="full_name" type="text" class="input_text" id="full_name" /></td>
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
                      <th style="width:4%;"><input name="CheckedAll" type="checkbox" id="CheckedAll" disabled="disabled" /></th>             
                      <th sort="extension" >分机号</th>
                      <th sort="fullname" >分机名称</th>
                      <th sort="protocol" >注册协议</th>
                      <th sort="server_ip">注册服务器</th>
                      <th sort="dialplan_number" >呼叫计划</th>
                       <th sort="status">状态</th>
                       <th sort="active">激活</th>
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
   
