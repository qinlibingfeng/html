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
  	
	var url="action=get_filter_lists&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+times+"&"+$('#form1').serialize();
 	//alert(url);
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
	
	var url="action=get_filter_lists&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&"+$('#form1').serialize();
	//alert(url);
	//return false;
	
	$.ajax({
		 
		url: "send.php",
		data:url,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop());$('#load').show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
			
			$("#datatable tfoot tr").show();
			if(parseInt(json.counts)>0){
				 
				$("#datatable tbody tr").remove();
				var tits="";td_str="";fun_str="";qua_str="";
				$.each(json.datalist, function(index,con){
					 
					do_edit="<a href='javascript:void(0)' onclick='edit_filter(\""+con.lead_filter_id+"\")'>修改</a> <a href='javascript:void(0)' onclick=\"del_('"+con.lead_filter_id+"')\">删除</a>";
 					tr_str="<tr align=\"left\" ondblclick='edit_filter(\""+con.lead_filter_id+"\")' id='filter_list_"+con.lead_filter_id+"' >";
					tr_str+="<td align=\"center\"><input name=\"c_id\" type=\"checkbox\" value=\""+con.lead_filter_id+"\" /></td>";
					tr_str+="<td>"+con.lead_filter_id+"</td>";
					tr_str+="<td><div class='hide_tit' title='"+con.lead_filter_name+"'>"+con.lead_filter_name+"</div></td>";
 					tr_str+="<td><div class='hide_tit' title='"+con.lead_filter_comments+"'>"+con.lead_filter_comments+"</div></td>";
					tr_str+="<td>"+con.counts+"</td>";
 					tr_str+="<td>"+do_edit+"</td>";
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

   
function add_filter_list(){
	var diag =new Dialog("add_filter_list_");
    diag.Width = 720;
    diag.Height = 380;
    diag.Width = $(window).width() - 26;
    diag.Height = $(window).height() -60;
 	diag.Title = "添加过滤规则";
	diag.URL = '/document/lists/list.php?action=add_filter&tits='+encodeURIComponent("添加过滤规则");
 	diag.OKEvent = set_add_filter;
    diag.show();
}
 
function set_add_filter(){
	Zd_DW.do_add_filter();
}
   
function edit_filter(lead_filter_id){
	var diag =new Dialog("edit_filter_"+lead_filter_id);
    diag.Width = 720;
    diag.Height = 400;
    diag.Width = $(window).width() - 26;
    diag.Height = $(window).height() -60;
 	diag.Title = "客户清单设置";
	diag.URL = '/document/lists/list.php?action=edit_filter&lead_filter_id='+lead_filter_id+'&tits='+encodeURIComponent("过滤规则设置");
 	diag.OKEvent = set_edit_filter;
    diag.show();
}
 
function set_edit_filter(){
	Zd_DW.do_edit_filter();
}
    
function check_form(actions){	
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
	datas="action=del_lead_filter&c_id="+c_id+times;
 	//alert(datas);
	//return false;
    if(confirm("删除过滤规则将造成使用本规则的客户清单数据读取变化！\n\n您确定要删除过滤规则吗？")){
 
		$('#load').show();
		$.ajax({
			 
			url: "send.php",
			data:datas,
			
			beforeSend:function(){$('#load').css("top",$(document).scrollTop());$('#load').show('100');},
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
		
 	});
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="20"/> <input name="sorts" type="hidden" id="sorts" value=""/> <input name="order" type="hidden" id="order"/>').appendTo("body");
	
	request_tip("警告！本功能条件的设置将会限制客户清单的使用，请谨慎使用！！！",0,10000);
	
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
    
     <table border="0" cellpadding="0" cellspacing="0" class="menu_list">
     <tr>
        <td colspan="2"><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="add_filter_list();" title="添加黑名单！"><img src="/images/icons/icons_34.png" style="margin-top:6px"/><b>添加规则&nbsp;</b></a></td>
      </tr>
    </table>
                  
     <table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
        <tr>
            <td style="">
          <input type="hidden" name="get_campaign" id="get_campaign" value="0" />
           
          
          <fieldset><legend> <label onClick="show_div('search_list');" title="点击收缩/展开">查询选项</label></legend>
            <form action="" onSubmit=""  method="post" name="form1" id="form1">   
             <table width="100%" border="0" align="center"  cellspacing="0" id="search_list" class="search_table" >
            
               <tr>
                 <td width="8%" align="right">规则ID:</td>
                 <td width="10%" height="">
                 <input name="lead_filter_id" type="text" class="input_text" id="lead_filter_id" title="输入要查询的规则ID，多个以英文“,”分隔"  size="21" onkeyup="this.value=value.replace(/[^\w\/,]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/,]/ig,'')" />
                 </td>
                 <td width="8%" height="26" align="right" id="">规则名称：</td>
         		 <td width="10%" nowrap="nowrap"><input name="lead_filter_name" type="text" class="input_text" id="lead_filter_name"  size="21" maxlength="20"  /></td>
                 <td width="8%" align="right">规则描述：</td>
                 <td width="10%"><input name="lead_filter_comments" type="text" class="input_text" id="lead_filter_comments"   size="21" maxlength="20"  /></td>
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
                      <th sort="a.lead_filter_id" onClick="Sorts_new('datatable','DadaSorts_1',$('#pagesize').val())" >规则ID</th>
                      <th sort="lead_filter_name" onClick="Sorts_new('datatable','DadaSorts_2',$('#pagesize').val())" >规则名称</th>
                      <th sort="lead_filter_comments" onClick="Sorts_new('datatable','DadaSorts_3',$('#pagesize').val())" >规则描述</th>
                      <th sort="counts" onClick="Sorts_new('datatable','DadaSorts_4',$('#pagesize').val())" >条件个数</th>
                      <th >操作</th>
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
</div>
 
</body>
</html>
   
