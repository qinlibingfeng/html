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
  	
	var url="action=get_user_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+times+"&"+$('#form1').serialize();
 	
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
	
	var url="action=get_user_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&"+$('#form1').serialize();
	//alert(url);
	//return false;
	
	$.ajax({
		 
		url: "send.php",
		data:url,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
			if (doa_ctions!="excel"){
				$("#datatable tfoot tr").show();
				if(parseInt(json.counts)>0){
					 
					$("#datatable tbody tr").remove();
					$("#excels").show();
					
					var tits="",td_str="",fun_str="",qua_str="";
					
					$.each(json.datalist, function(index,con){
						if(con.user =='VDAD'||con.user =='1000'){
							disabled="disabled";	
							do_edit="修改 删除";
							dblclick="";
						}else{
							dblclick=" ondblclick='edit_user(\""+con.user_id+"\")' ";
							if(con.user_id=='3'){
								disabled="disabled";
								do_edit="<a href='javascript:void(0)' onclick='edit_user(\""+con.user_id+"\")'>修改</a> 删除";
							}else{
								disabled="";
								do_edit="<a href='javascript:void(0)' onclick='edit_user(\""+con.user_id+"\")'>修改</a> <a href='javascript:void(0)' onclick='del_(\""+con.user_id+"\")'>删除</a>";
							}
						}
						
						tr_str="<tr align=\"left\" id=\"user_list_"+con.user_id+"\" "+dblclick+">";
						tr_str+="<td align=\"center\"><input name=\"c_id\" type=\"checkbox\" value=\""+con.user_id+"\" "+disabled+"/></td>";
						tr_str+="<td >"+con.user+"</td>";
						tr_str+="<td id='name_"+con.user_id+"'>"+con.full_name+"</td>";
						tr_str+="<td id='level_"+con.user_id+"'>"+con.user_level+"</td>";
						tr_str+="<td id='group_"+con.user_id+"'>"+con.group_name+"</td>";
						tr_str+="<td >"+con.phone_login+"</td>";
						tr_str+="<td id='active_"+con.user_id+"'>"+con.active+"</td>";
						tr_str+="<td >"+do_edit+"</td>";
						tr_str+="</tr>";
						$("#datatable tbody").append(tr_str);
					}); 
					
					OutputHtml(page_nums,pagesize);
				
				}else{
					$("#excels").hide();
					$("#datatable tbody tr").remove();
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

function add_user(actions){
	var diag =new Dialog("add_user");
	diag.Width = 880;
	diag.Height = 500;	
 	diag.Title = "新建坐席";
	diag.URL = '/document/agent/list.php?action=add_user&tits='+encodeURIComponent("新建坐席");
 	diag.OKEvent = set_add_user;
    diag.show();
}
 
function set_add_user(){
	Zd_DW.do_add_user();
}
  
function edit_user(user_id){
	var diag =new Dialog("edit_user_"+user_id);
	diag.Width = 880;
	diag.Height = 500;	
 	diag.Title = "坐席设置";
	diag.URL = '/document/agent/list.php?action=edit_user&user_id='+user_id+'&tits='+encodeURIComponent("坐席设置");
 	diag.OKEvent = set_edit_user;
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
 	diag.Title = "复制坐席";
	diag.URL = '/document/agent/list.php?action=copy_user&tits='+encodeURIComponent("复制坐席");
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
 
 
   
function check_form(actions){	
     
    if (actions == "search") {
  		 
  		$("#datatable").show();
        GetPageCount('search', "count");
        get_datalist(1,"search", "list",$('#pagesize').val());
    }
   	
	if (actions == "excel") {
		 
		$("#field_list").val("");
 		$("#datatable").show();
		$("#file_type").val("xls");
		request_tip("系统正在为您导出，此过程较慢，请耐心等候...",1,30000);
 		get_datalist(1,"search", "excel",$('#pagesize').val());
	}
	
	if (actions == "csv") {
		//Zd_D.close();
		$("#field_list").val("");
 		$("#datatable").show();
		$("#file_type").val("csv");
		request_tip("系统正在为您导出，此过程较慢，请耐心等候...",1,30000);
 		get_datalist(1,"search", "excel",$('#pagesize').val());
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
	$('<input name="a_ctions" type="text" class="dis_none"  id="a_ctions"/> <input name="doa_ctions" type="text" class="dis_none"  id="doa_ctions"/> <input name="recounts" type="text" class="dis_none"  id="recounts"/> <input name="pages" type="text" class="dis_none"  id="pages" value="1"/> <input name="pagecounts" type="text" class="dis_none"  id="pagecounts"/><input name="pagesize" type="text" class="dis_none"  id="pagesize" value="15"/> <input name="sorts" type="text" class="dis_none"  id="sorts" value="a.user"/> <input name="order" type="text" class="dis_none"  id="order"/>').appendTo("body");
	
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
        <td colspan="2"><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="add_user('');" title="新建坐席！"><img src="/images/icons/icon021a2.gif" /><b>新建坐席&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="copy_user();" title="复制坐席！"><img src="/images/icons/icon025a7.gif" /><b>复制坐席&nbsp;</b></a></td>
      </tr>
    </table>
                  
     <table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
        <tr>
            <td style="">
          <input type="text" class="dis_none"  name="get_group" id="get_group" value="0" />
          <fieldset><legend> <label onClick="show_div('search_list');" title="点击收缩/展开">查询选项</label></legend>
            <form action="" onSubmit=""  method="post" name="form1" id="form1">       
             <table width="100%" border="0" align="center"  cellspacing="0" id="search_list" class="search_table" >
            
               <tr>
                 <td width="8%" align="right">坐席工号：</td>
                 <td height="">
                 <input name="user" type="text" class="input_text" id="user" title="输入要查询的工号，多个以英文“,”分隔"  size="21" onkeyup="this.value=value.replace(/[^\w\/,]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/,]/ig,'')" />
                 </td>
                 <td width="8%" height="26" align="right" id="">坐席姓名：</td>
         		 <td nowrap="nowrap"><input name="full_name" type="text" class="input_text" id="full_name" /></td>
                 <td width="8%" align="right">坐席级别：</td>
                 <td>
                 	<select name="user_level" class="s_option" id="user_level">
                    	<option value="">未指定</option>
                      	<?php
                        	for($i=1;$i<10;$i++){
 						?>
                        <option value="<?php echo $i?>"><?php echo $i?></option>
                        
                        <?php
                        	}
						?>
                      	 
                       </select>
                 </td>
                 <td width="8%" align="right" id="td">坐席组别：</td>
                 <td>
                     <select name="user_group" class="s_option" id="user_group" onfocus="get_user_group()">
                      	<option value="">未指定</option>
                           
                       </select>
                  </td>
                 
               </tr>
               <tr>
                 <td align="right">使用分机：</td>
                 <td><input name="phone_login" type="text" class="input_text" id="phone_login" title="输入要查询的分机号，多个以英文“,”分隔"  size="21" onkeyup="this.value=value.replace(/[^\d|,]/g,'')" onafterpaste="this.value=value.replace(/[^\d|,]/g,'')" /></td>
                 <td height="" align="right" id="td2">&nbsp;</td>
                 <td height="" nowrap="nowrap">&nbsp;</td>
                 <td align="right">&nbsp;</td>
                 <td>&nbsp;</td>
                 <td height="" align="right" id="td3">&nbsp;</td>
                 <td>&nbsp;</td>
               </tr>
               <tr>
                 <td align="right"> 
                  </td>
                 <td colspan="7">
                 <input type="text" class="dis_none"  name="file_type" id="file_type" value="" />
                 <input type="button" name="form_submit" value="提交查询" onClick="check_form('search');" style="cursor:pointer" />
                   <input type="reset" name="button" id="button" value="重置" /></td>
               </tr>
              </table> 
      
            </form>
          </fieldset>       
             <div id="excels"  style="height:22px; line-height:22px;"><span><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="check_form('excel');" title="导出详单到Excel"><img src="/images/icons/excel.png" style="margin-top:4px" /><b>导出Xls &nbsp;</b></a> <a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="check_form('csv');" title="导出详单到Csv"><img src="/images/icons/notebook.png" style="margin-top:4px"/><b>导出Csv &nbsp;</b></a> </span><span id="xls_addr" style="height:22px; line-height:22px;margin-left:10px"></span><span id="csv_addr" style="height:22px; line-height:22px;margin-left:10px"></span><span id="txt_n_addr" style="height:22px; line-height:22px;margin-left:10px"></span></div>
            <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
                  <thead>
                    <tr align="left" class="dataHead">
                      <th style="width:4%;"><input name="CheckedAll" type="checkbox" id="CheckedAll" /><a href="javascript:void(0);" onclick="del_(0);" title="删除选定数据" style="font-weight:normal">删除</a></th>             
                      <th sort="a.user" >坐席工号</th>
                      <th sort="a.full_name" >坐席姓名</th>
                      <th sort="a.user_level">坐席级别</th>
                      <th sort="b.group_name">坐席组</th>
                      
                      <th sort="a.phone_login" >使用分机</th>
                      <th sort="a.active">激活</th>
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
   
