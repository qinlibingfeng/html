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
<!--<script src="/js/clipboard.js"></script> -->
<script>
function GetPageCount(a_ctions,doa_ctions){
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
  	
	var url="action=get_ask_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+times+"&"+$('#form1').serialize();
 	
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

var urls="<?php echo "http://".$_SERVER["HTTP_HOST"]."/document/ask_flow/ask_sub.php?ask_id=" ?>";
 
function get_datalist(page_nums,a_ctions,doa_ctions,pagesize,ask_id){
 	
	/*var params = {
		wmode: "transparent",
		allowScriptAccess: "always"
	};*/
 
	$('#load').show();
	max_pages(pagesize);
	var pages=$("#pagecounts").val();
	if(parseInt(page_nums) < 1)page_nums = 1; 
	if(parseInt(page_nums) > parseInt(pages)){
		page_nums = pages;
	}; 
	if(!(parseInt(page_nums) <= parseInt(pages))) page_nums = pages;	 
	
	var url="action=get_ask_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&ask_id="+ask_id+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&"+$('#form1').serialize();
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
				if (ask_id=="0"||ask_id==undefined||ask_id==""){
 					$("#datatable tbody tr").remove();
					var tits="",td_str="",fun_str="",qua_str="";
					$.each(json.datalist, function(index,con){
						
						var ask_url=urls+con.ask_id;
						
						tr_str="<tr align=\"left\" id=\"ask_list_"+con.ask_id+"\" ondblclick='edit_ask(\""+con.ask_id+"\")' onmouseover=\"javascript:$('#url').val('"+ask_url+"')\">";
						
						tr_str+="<td align=\"center\"><input name=\"c_id\" type=\"checkbox\" value=\""+con.ask_id+"\"/></td>";
						tr_str+="<td >"+con.ask_title+"</td>";
						tr_str+="<td >"+con.ask_des+"</td>";
						tr_str+="<td >"+con.counts+"</td>";
						tr_str+="<td >"+con.ask_type+"</td>";
						tr_str+="<td >"+con.user+"</td>";
						tr_str+="<td >"+con.addtime+"</td>";
						tr_str+="<td ><span><a href='javascript:void(0)' onclick='result_ask(\""+con.ask_id+"\")' title='点击查询本问卷结果详单'>详单</a></span> <span><a href='ask_view.php?ask_id="+con.ask_id+"' target='_blank' title='点击预览本问卷'>预览</a></span> <span><a href='javascript:void(0)' onclick='edit_ask(\""+con.ask_id+"\")' title='点击修改本问卷'>修改</a></span> <span><a href='javascript:void(0)' onclick='del_(\""+con.ask_id+"\")' title='点击删除本问卷'>删除</a></span></td>";
						tr_str+="</tr>";
						$("#datatable tbody").append(tr_str);						
						
						/*var flashvars = {
							content: encodeURIComponent(ask_url),
							uri: '/images/icons/icons_68.gif'
						};
 						swfobject.embedSWF("/js/clipboard.swf","clip_btn_"+con.ask_id+"","24","15","9.0.0",null,flashvars,params);*/
						
					}); 
					
 					OutputHtml(page_nums,pagesize);
 					 
 				}else{
					 
					$("#ask_list_"+ask_id+" td").eq(1).html("<span class='green'>"+json.datalist[0].ask_title+"</span>");
					$("#ask_list_"+ask_id+" td").eq(2).html("<span class='green'>"+json.datalist[0].ask_des+"</span>");
					$("#ask_list_"+ask_id+" td").eq(3).html("<span class='green'>"+json.datalist[0].counts+"</span>");
					$("#ask_list_"+ask_id+" td").eq(4).html("<span class='green'>"+json.datalist[0].ask_type+"</span>");
 				} 
 			
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

function add_ask(actions){
	var diag =new Dialog("add_ask");
	diag.Width = 780;
	diag.Height = 426;	
 	diag.Title = "新建问卷";
	diag.URL = '/document/ask_flow/list.php?action=add_ask&tits='+encodeURIComponent("新建问卷");
 	diag.OKEvent = set_add_ask;
    diag.show();
 }
 
function set_add_ask(){
	Zd_DW.do_add_ask();
}


function save_ask(ask_id){
	get_datalist($("#pages").val(),$("#a_ctions").val(),"list",$('#pagesize').val(),ask_id);
}

function edit_ask(ask_id){
	var diag =new Dialog("edit_ask_"+ask_id);
    diag.Width = $(window).width()+20;
    diag.Height = $(window).height();
 	diag.Title = "设置问题步骤";
	diag.URL = '/document/ask_flow/ask_set.php?ask_id='+ask_id+'&tits='+encodeURIComponent("设置问题步骤");
 	diag.OKEvent = set_save_ask;
	//diag.CancelButton.hide();
    diag.show();
}
 
function set_save_ask(){
	Zd_DW.save_ask();
}

function result_ask(ask_id){
	var diag =new Dialog("result_ask_"+ask_id);
    diag.Width = $(window).width();
    diag.Height = $(window).height();
 	diag.Title = "问卷详单查询";
	diag.URL = '/document/ask_flow/ask_list.php?ask_id='+ask_id+'&tits='+encodeURIComponent("问卷详单查询");
	diag.show();
 	diag.OKButton.hide();
	diag.CancelButton.value="关 闭";
}

function view_ask_result(){
	var diag =new Dialog("view_ask_result");
    diag.Width = $(window).width();
    diag.Height = $(window).height();
 	diag.Title = "问卷详单查询";
	diag.URL = '/document/ask_flow/ask_list.php?tits='+encodeURIComponent("问卷详单查询");
	diag.show();
 	diag.OKButton.hide();
	diag.CancelButton.value="关 闭";
}
  
function copySuccess(){
 	alert("该问卷引用地址已成功复制到剪贴板！\n---------------------------------------\n"+$("#url").val()+"\n---------------------------------------");
}    
	
function check_form(actions){	
     
    if (actions == "search") {
  		 
  		$("#datatable").show();
        GetPageCount('search', "count");
        get_datalist(1,"search", "list",$('#pagesize').val(),0);
    }
	 
	if (actions == "excel") {
		$("#field_list").val("");
 		$("#datatable").show();
		
		$('#auto_save_res').css("top",$(document).scrollTop()+6).addClass("green_layer");
		$('#auto_save_res').fadeIn("slow");
		$("#auto_save_res").html("系统正在为您导出，此过程较慢，请耐心等候...",25000);
		setTimeout("$('#auto_save_res').fadeOut('fast');",6000);
		
		get_datalist(1,"search", "excel",$('#pagesize').val(),0);
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
	datas="action=del_ask&do_actions=ask&c_id="+c_id+times;
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
					get_datalist($("#pages").val(),$("#a_ctions").val(),"list",$('#pagesize').val(),0);
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
	
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="20"/> <input name="sorts" type="hidden" id="sorts" value="a.ask_id"/> <input name="order" type="hidden" id="order"/>').appendTo("body");
	
	GetPageCount('search',"count");
	get_datalist(1,"search","list",$('#pagesize').val(),0);
	days_ready();
  	
});
  
</script>
<script type="text/javascript" src="/js/calendar.js"></script>
 
</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
     
<div class="page_main">
    
     <table border="0" cellpadding="0" cellspacing="0" class="menu_list">
     <tr>
        <td colspan="2"><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="add_ask('');" title="新建问卷！"><img src="/images/icons/icon042a2.gif" /><b>新建问卷&nbsp;</b></a><a href='javascript:void(0)'  class='zPushBtn zPushBtnDisabled' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" title="导入问卷结构" ><img src="/images/icons/icon042a7.gif" /><b>导入问卷&nbsp;</b></a><a href='javascript:void(0)'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" title="问卷详单查询、质检" onclick="view_ask_result()" ><img src="/images/icons/icon042a20.gif" /><b>问卷详单查询&nbsp;</b></a></td>
      </tr>
    </table>
    
    <input type="hidden" name="url" id="url" value="" />
                 
     <table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
        <tr>
            <td style="">
             
          <fieldset><legend> <label onClick="show_div('search_list');" title="点击收缩/展开">查询选项</label></legend>
            <form action="" onSubmit=""  method="post" name="form1" id="form1">       
             <table width="100%" border="0" align="center"  cellspacing="0" id="search_list" class="search_table" >
            
               <tr>
                 <td width="8%" height="26" align="right">问卷标题：</td>
                 <td width="12%" height="26"><input name="ask_title" type="text" class="input_text" id="ask_title" title="输入要查询的问卷标题"  size="21" /></td>
                 <td width="8%" height="26" align="right" id="">问卷描述：</td>
                 <td width="12%" height="26"><input name="ask_des" type="text" class="input_text" id="ask_des" title="输入要查询的问卷描述" size="21" /></td>
                 <td width="8%" align="right">结束语：</td>
                 <td width="12%"><input name="yes_des" type="text" class="input_text" id="yes_des" title="输入要查询的成功、失败结束语" size="21" /></td>
                 <td width="8%" align="right">&nbsp;</td>
                 <td>&nbsp;</td>
               </tr>
               <tr>
                 <td height="26" align="right">创建时间：</td>
                 <td height="26" colspan="7"><?php select_date("none");?></td>
               </tr>
               <tr>
                 <td height="26" align="right">&nbsp;</td>
                 <td height="26" colspan="7"><input type="button" name="form_submit" value="提交查询" onClick="check_form('search');" style="cursor:pointer" />
                   <input type="reset" name="button" id="button" value="重置" /></td>
               </tr>
              </table> 
      
            </form>
          </fieldset>       
             
            <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
                  <thead>
                    <tr align="left" class="dataHead">
                      <th style="width:4%"><input name="CheckedAll" type="checkbox" id="CheckedAll" /><a href="javascript:void(0);" onclick="del_(0);" title="删除选定数据" style="font-weight:normal">删除</a></th>             
                      <th sort="a.ask_title"  >问卷标题</th>
                      <th sort="a.ask_des" >问卷描述</th>
                      <th sort="b.counts" >问题个数</th>
                      <th sort="a.ask_type" >问卷类型</th>
                      <th sort="a.user" >工号</th>
                      <th sort="a.addtime" >创建时间</th>
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
   
