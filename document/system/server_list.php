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
  	
	var url="action=get_server_simple_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+times+"&"+$('#form1').serialize();
 	
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
   
function get_datalist(page_nums,a_ctions,doa_ctions,pagesize,campaign_id){

	$('#load').show();
	//$("#excel_addr").html('');
	max_pages(pagesize);
	var pages=$("#pagecounts").val();
	if(parseInt(page_nums) < 1)page_nums = 1; 
	if(parseInt(page_nums) > parseInt(pages)){
		page_nums = pages;
	}; 
	if(!(parseInt(page_nums) <= parseInt(pages))) page_nums = pages;	 
	
	var url="action=get_server_simple_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&campaign_id="+campaign_id+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&"+$('#form1').serialize();
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
 					 
					do_edit="<a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv='true' title='重新启动该服务器，请谨慎操作！！！' id='server_do_re_"+con.server_id+"' ><img src='/images/icons/icons_56.png' style='margin-top:6px'/><b>重新启动&nbsp;</b></a><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv='true' title='关闭该服务器，请谨慎操作！！！' id='server_do_sh_"+con.server_id+"'><img src='/images/icons/icons_57.png' style='margin-top:6px' /><b>关闭机器&nbsp;</b></a>";
 					tr_str="<tr align=\"left\" id=\"server_list_"+con.server_id+"\" ip=\""+con.server_ip+"\" >";
					tr_str+="<td align=\"center\"><input name=\"c_id\" type=\"checkbox\" value=\""+con.server_id+"\" /></td>";
					tr_str+="<td>"+con.server_id+"</td>";
					tr_str+="<td><div class='hide_tit'>"+con.server_name+"</div></td>";
					tr_str+="<td>"+con.server_ip+"</td>";
					tr_str+="<td>"+con.server_info+"</td>";
 					tr_str+="<td>"+do_edit+"</td>";
					tr_str+="</tr>";
					$("#datatable tbody").append(tr_str);
					
					$("#server_do_re_"+con.server_id).bind("click",function(){
						server_set(con.server_id,con.server_type,"重启");
					});
					$("#server_do_sh_"+con.server_id).bind("click",function(){
						server_set(con.server_id,con.server_type,"关机");
					});
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
 
function check_form(actions){	
     if (actions == "search") {
  		 
  		$("#datatable").show();
        GetPageCount('search', "count");
        get_datalist(1,"search", "list",$('#pagesize').val());
    }
    	  
}
 
function server_set(id,type,shell_do){
	
	if(confirm("本操作将造成未保存的数据丢失，请先处理未完成的工作！\n\n本操作不可撤销，您确定要执行"+shell_do+"指令吗？")){
 	}else{
		return false;
	}
	if(type=="windows"){
		if(shell_do=="重启"){
			shell_cmd="restart";
			 
		}else{
			shell_cmd="shutdown";	
		}
	}else{
		if(shell_do=="重启"){
			shell_cmd="restart";
		}else{
			shell_cmd="shutdown";	
		}
	}
	var ip=$("#server_list_"+id).attr("ip");
	
	$("#shell_cmd").val(shell_cmd);
	$("#shell_do").val(shell_do);
	$("#server_id").val(id);
 
	//$("#server_form").attr("action","http://"+ip+"/Document/system/server_con.php");
  	
	request_tip("即将执行"+$("#server_list_"+id+" td").eq(2).text()+shell_do+"指令...",1);
	var url="http://"+ip+"/document/system/server_con.php?"+$('#server_form').serialize()+times+"&callback=?";
	//alert(url);
	$.getJSON(url,function(json){
			request_tip(json.des,json.counts);
			if(json.counts=="0"){
				alert(json.des);
			}else{
				$("#server_list_"+json.server_id+" td").eq(5).find("a").addClass("zPushBtnDisabled").unbind();	
			}
		} 
 	);  
 
}
  
$(document).ready(function(){
	//document.domain='192.168.1.172';
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
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="20"/> <input name="sorts" type="hidden" id="sorts" value="campaign_id"/> <input name="order" type="hidden" id="order"/>').appendTo("body");
	request_tip("警告！本功能将使服务器重启、关机，造成不必要的数据丢失，请谨慎使用！！！",0,10000);
	GetPageCount('search',"count");
	get_datalist(1,"search","list",$('#pagesize').val());
});
   
 
</script>
<style>
.hide_tit{width:120px;} 
</style>

</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
 
    
<div class="page_main">
  <table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
     <tr>
            <td style="">
          <input type="hidden" name="get_dial_method" id="get_dial_method" value="0" />
          <input type="hidden" name="get_dial_level" id="get_dial_level" value="0" />
          
           <form action="" method="post" name="server_form" target="" id="server_form">
          	<input type="hidden" name="shell_cmd" id="shell_cmd" value="" />
            <input type="hidden" name="shell_do" id="shell_do" value="" />
            <input type="hidden" name="server_id" id="server_id" value="" />
           </form>
         
          <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
                <thead>
                    <tr align="left" class="dataHead">
                      <th style="width:4%;"><input name="CheckedAll" type="checkbox" id="CheckedAll" /></th>
                      <th sort="server_id" >执行序号</th>
                      <th sort="server_name" >服务器名称</th>
                      <th sort="server_ip" >服务器IP</th>
                      <th sort="server_info" >主要用途</th> 
                      <th style="width:26%;">操作</th>
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
   
