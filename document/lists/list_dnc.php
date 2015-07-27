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
  	
	var url="action=get_dnc_lists&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+times+"&"+$('#form1').serialize();
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
	
	var url="action=get_dnc_lists&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&"+$('#form1').serialize();
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
					 
					do_edit="<a href='javascript:void(0);' onclick=\"del_('"+con.phone_number+"|"+con.campaign_id+"')\">删除</a>";
 					tr_str="<tr align=\"left\" >";
					tr_str+="<td align=\"center\"><input name=\"c_id\" type=\"checkbox\" value=\""+con.phone_number+"|"+con.campaign_id+"\" /></td>";
					tr_str+="<td>"+con.phone_number+"</td>";
 					tr_str+="<td>"+con.campaign_name+"</td>";
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

   
function add_dnc_list(){
	var diag =new Dialog("add_dnc_list_");
    diag.Width = 660;
    diag.Height = 380;
 	diag.Title = "添加黑名单";
	diag.URL = '/document/lists/list.php?action=add_dnc_list&tits='+encodeURIComponent("添加黑名单");
 	diag.OKEvent = set_add_dnc_list;
	
    diag.show();
	diag.CancelButton.value="关 闭";
}
 
function set_add_dnc_list(){
	Zd_DW.do_add_dnc_list();
}
    
function check_form(actions)
{	
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
	datas="action=del_dnc_list&c_id="+c_id+times;
 	//alert(datas);
	//return false;
    if(confirm("删除黑名单号码将造成不必要的呼叫！\n\n您确定要删除黑名单号码吗？")){
 
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
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="20"/> <input name="sorts" type="hidden" id="sorts" value=""/> <input name="order" type="hidden" id="order"/>').appendTo("body");
	
	GetPageCount('search',"count");
	get_datalist(1,"search","list",$('#pagesize').val());
});
 
function get_campaign_list(){
	if($("#get_campaign").val()=="0"){
		var datas="action=get_campaign_all_list"+times;
		 
		$.ajax({
			 
			url: "../campaign/send.php",
			data:datas,
			
			success: function(json){
				
			  if(json.counts=="1"){
					$("#get_campaign").val("1");
					$("#campaign_id option").remove();
					$("<option value=''>请选择归属业务活动</option><option value='system'>系统黑名单</option>").appendTo($("#campaign_id"));
					
					$.each(json.datalist,function(index,con){
						 
						$("<option value='"+con.campaign_id+"' title='"+con.campaign_name+"--"+con.campaign_id+" "+con.campaign_description+"'  name='"+con.campaign_name+"' des='"+con.campaign_description+"'>"+con.campaign_name+" ["+con.campaign_id+"]</option>").appendTo($("#campaign_id"));
						
					});
			  }
			  
			}
		});
	}
} 
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
        <td colspan="2"><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="add_dnc_list();" title="添加黑名单！"><img src="/images/icons/telephone2.png" style="margin-top:6px"/><b>添加黑名单&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn zPushBtnDisabled' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="" title="各业务黑名单转移！"><img src="/images/icons/telephone3.png" style="margin-top:6px"/><b>黑名单转移&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn zPushBtnDisabled' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="" title="黑名单统计与删除！"><img src="/images/icons/telephone10.gif" style="margin-top:6px"/><b>统计与管理&nbsp;</b></a></td>
      </tr>
    </table>
                  
     <table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
        <tr>
            <td style="">
          <input type="hidden" name="get_campaign_id" id="get_campaign_id" value="0" />
           
          
          <fieldset><legend> <label onClick="show_div('search_list');" title="点击收缩/展开">查询选项</label></legend>
            <form action="" onSubmit=""  method="post" name="form1" id="form1">   
             <table width="100%" border="0" align="center"  cellspacing="0" id="search_list" class="search_table" >
            
               <tr>
                 <td width="8%" align="right">电话号码</td>
                 <td width="10%" height="">
                 <input name="phone_number" type="text" class="input_text" id="phone_number" title="输入要查询的电话号码，多个以英文“,”分隔"  size="21" onkeyup="this.value=value.replace(/[^\w\/,]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/,]/ig,'')" />
                 </td>
                 <td width="8%" height="26" align="right" id="">业务活动：</td>
         		 <td nowrap="nowrap">
                  <select name="campaign_id" id="campaign_id" onclick="get_select_opt('','../campaign/send.php','get_campaigns_list','campaign_id','group_def')" >
                      <option value=''>请选择归属业务活动</option>
                  </select>
                 </td>
                 <td width="8%" align="right"></td>
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
                      <th sort="phone_number" >电话号码</th>
                      <th sort="campaign_name" >业务活动</th>
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
</div>
 
</body>
</html>
   
