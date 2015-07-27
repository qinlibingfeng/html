<?php 
require("../../inc/pub_func.php"); 
require("../../inc/pub_set.php"); 
$tits=trim($_REQUEST["tits"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>设置</title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css" />
<link href="/css/list.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css" />
<style>
.s_input{width:196px}
.s_option{width:202px}
</style>
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script>   
function choose_fields(action){
	var diag =new Dialog("choose_fields");
 	diag.Width = 460;
	diag.Height = 240;
	diag.Title = "选择可显示客户资料字段";
 	diag.URL = "/document/lists_flow/list.php?cid=0&tits="+encodeURIComponent("选择客户资料字段")+"&action="+action;
  	diag.OKEvent = set_choose_fields;
	diag.show();
}

function set_choose_fields(){
	Zd_DW.do_set_choose_fields();
} 
  
 
function order_datatable_(){
	
	$("#datatable tbody tr").removeClass("alt").find(".up_d").addClass("up_e").removeClass("up_d");
	$("#datatable tbody tr").find(".dw_d").addClass("dw_e").removeClass("dw_d");
	$("#datatable tbody tr:first").find(".up_e").addClass("up_d").removeClass("up_e").unbind("click");
	$("#datatable tbody tr:last").find(".dw_e").addClass("dw_d").removeClass("dw_e").unbind("click");
	$("#datatable tbody tr:odd").addClass("alt");
	$("#datatable tbody tr").mouseover(function(){$(this).addClass("over")}).mouseout(function(){$(this).removeClass("over")});
}
  
function set_tree_class(){
	$("#tree_list p").removeClass("cur");
	$("#tree_list label").click(function(){
		$(this)	.parent().addClass("cur");
	});
}

function check_list(){
	if($("#list_id").val()!=""){
		
		if($("#list_id").val().length>9||$("#list_id").val().length<2){
			 
			request_tip("客户清单ID位数必须介于2-8位字符之间！",0);
			$("#list_id").select();
			return false;
		}
		
		var datas="action=check_list&list_id="+$("#list_id").val()+times;
		$.ajax({
			 
			url:"send.php",
			data:datas,
			
			async:false,
			success: function(json){
			   if(json.counts!="1"){
					request_tip(json.des,json.counts);
					$("#list_id").select();
			   }
			} 
		});
	}
}

function get_field_list(form_id,turn_val){
	 
	var json={"counts":1,"des":"success","datalist":[{"field_name":"客户清单ID","field_id":"list_id"},{"field_name":"电话号码ID","field_id":"lead_id"},{"field_name":"电话号码","field_id":"phone_number"},{"field_name":"呼叫结果","field_id":"status"},{"field_name":"导入时间","field_id":"entry_date"},{"field_name":"呼叫时间","field_id":"last_local_call_time"},{"field_name":"标题","field_id":"title"},{"field_name":"名字","field_id":"first_name"},{"field_name":"中间名","field_id":"middle_initial"},{"field_name":"姓氏","field_id":"last_name"},{"field_name":"地址1","field_id":"address1"},{"field_name":"地址2","field_id":"address2"},{"field_name":"地址3","field_id":"address3"},{"field_name":"城市","field_id":"city"},{"field_name":"地区","field_id":"state"},{"field_name":"邮编","field_id":"postal_code"},{"field_name":"省份","field_id":"province"},{"field_name":"性别","field_id":"gender_list"},{"field_name":"生日","field_id":"date_of_birth"},{"field_name":"备用电话","field_id":"alt_phone"},{"field_name":"邮箱","field_id":"email"},{"field_name":"描述","field_id":"comments"},{"field_name":"工号","field_id":"user"}]};
	
	if(form_id=="0"){
		selects="name=field_id";
	}else{
		selects="id="+form_id;
	}
	$("select["+selects+"] option").remove();
	 
	$.each(json.datalist,function(index,con){
		var selected="";
		if (con.field_id==turn_val){selected=" selected";}
		$("<option value='"+con.field_id+"' title='"+con.field_name+"' "+selected+">"+con.field_name+"</option>").appendTo($("select["+selects+"]"));
 	})
}
  
//显示子选项设置表单
function show_field_table(do_,is_re){
	if(do_=="show"){
		var c_id=parseInt($("#field_index").val());
    		
		$("#form_table").html("<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" class=\"dataTable\" style=\"margin-top:4px; margin-bottom:4px; width:99%\" id=\"datatable\"><thead><tr align=\"left\" class=\"dataHead\"><td style=\"font-weight:normal\">号码字段</td><td style=\"font-weight:normal\">运算符</td><td style=\"font-weight:normal\">值</td><td style=\"font-weight:normal\">关系</td><td style=\"font-weight:normal\">操作</td>\</tr></thead><tbody><tr align=\"left\" valign=\"middle\" id=\"list_1\" nowrap fid=\"1\"><td><span id=\"field_id_1\"><select name=\"filter_field\" id=\"filter_field_1\" style=\"width:90px\" fid=\"1\"><option value=\"\">请选择类型</option></select></span></td><td><select name=\"filter_term\" id=\"filter_term_1\" fid=\"1\"><option value=\"=\" selected=\"selected\">等于</option><option value=\"!=\">不等于</option><option value=\">\">大于</option><option value=\"<\">小于</option><option value=\"in\">包含</option><option value=\"not in\">不包含</option><option value=\"=''\">为空</option><option value=\"!=''\">不为空</option><option value=\"between\">区间</option><option value=\"like\">模糊匹配</option><option value=\"%like\">匹配开头</option><option value=\"like%\">匹配结尾</option></select></td><td><span id=\"value_1\"><input type=\"text\" name=\"filter_value\" id=\"filter_value_1\" maxlength=\"100\" size=\"36\" fid=\"1\"/></td><td><select name=\"field_if\" id=\"field_if_1\" fid=\"1\"><option value='and'>并且(and)</option><option value='or'>或者(or)</option></select><td class='o_icos'><span class='add' onclick=\"set_field('add','1','0');\"></span><span class='up_e' onclick=\"set_field('up','0','1')\"></span><span class='dw_e' onclick=\"set_field('dw','0','1')\"></span><span onclick=\"set_field('del','0','1');\"></span></td></tr></tbody><tfoot><tr><td colspan='6'><a href='javascript:void(0)' onclick=\"set_field('add','-1','0');\" >增加一项</a></td></tr></tfoot></table>");
		
 		$("#filter_value_1").addClass("inputText").hover(function(){if($(this).hasClass("input_focus")==false){$(this).addClass("inputTextHover")}},function(){$(this).removeClass("inputTextHover")}).focus(function(){$(this).removeClass("inputText inputTextHover input_focus").addClass("input_focus")}).blur(function(){$(this).addClass("inputText").removeClass("input_focus inputTextHover")});
		
		get_field_list("filter_field_1");
		
  		order_datatable_();
 		goto_anchor("list_1");
		get_filter_(1);
		
		$("#filter_term_1").bind("change",function(){
			filter_term_(this.value,"1");
		});
		
		$("#list_1 :input").blur(function(){
  			get_filter_("1","update");
		});
		$("#filter_list span").show();
		$("#filter_list span:last").hide();
		
		$("#datatable tbody tr:last").find("select[name='field_if']").attr("disabled","disabled");
  
 	}else{
		$("#form_table").html("<a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv=\"true\" title=\"添加子选项\" onClick=\"show_field_table('show','y');\" style=\"margin-top:4px\"><img src=\"/images/butCollapse.gif\" align=\"absmiddle\" style=\"margin-top:5px\"/><b>添加子选项&nbsp;</b></a>");
	}
}
 
//插入子选项表单
function set_field(do_,c_id,id){
 	var tr_str="",form_select="",tr_this = $("#list_"+id),f_l_this = $("#filter_l_"+id),insert_="";
 
	if(do_=="add"){
		
		var field_index=$("#field_index").val();
 		indexs=parseInt(field_index)+1;
		
		if(c_id=="-1"||$("#list_"+c_id).length<1){c_id=$("#datatable tbody tr:last").attr("fid");}
  		
		if($("#filter_field_"+c_id).val()==""||$("#filter_field_"+c_id).val()==undefined||$("#filter_field_"+c_id).val()==null){
			selects="<select name=\"filter_field\" id=\"filter_field_"+indexs+"\" fid=\""+indexs+"\"></select>";
 			is_resend=1;
			clone_id=indexs;
			is_load=1;
  		}else{
 			selects=$("#field_id_"+c_id).clone(true);
			is_resend=0;
			clone_id=c_id;
			is_load=0;
		}
     		
   		tr_str="<tr align=\"left\" id=\"list_"+indexs+"\" nowrap fid=\""+indexs+"\"><td><span id=\"field_id_"+indexs+"\"></span></td><td><span><select name=\"filter_term\" id=\"filter_term_"+indexs+"\" fid=\""+indexs+"\"><option value=\"=\" selected=\"selected\">等于</option><option value=\"!=\">不等于</option><option value=\">\">大于</option><option value=\"<\">小于</option><option value=\"in\">包含</option><option value=\"not in\">不包含</option><option value=\"=''\">为空</option><option value=\"!=''\">不为空</option><option value=\"between\">区间</option><option value=\"like\">模糊匹配</option><option value=\"%like\">匹配开头</option><option value=\"like%\">匹配结尾</option></select></span></td><td><span id=\"value_"+indexs+"\"><input type=\"text\" name=\"filter_value\" id=\"filter_value_"+indexs+"\" fid=\""+indexs+"\" maxlength=\"100\" size=\"36\" /></span></td><td><span><select name=\"field_if\" id=\"field_if_"+indexs+"\" fid=\""+indexs+"\"><option value='and'>并且(and)</option><option value='or'>或者(or)</option></select></span></td><td class='o_icos'><span class='add' onclick=\"set_field('add','"+indexs+"','0');\"></span><span class='up_e' onclick=\"set_field('up','0','"+indexs+"')\"></span><span class='dw_e' onclick=\"set_field('dw','0','"+indexs+"')\"></span><span onclick=\"set_field('del','0','"+indexs+"');\"></span></td></tr>";
		
  		if(c_id=="-1"&&id=="0"){
  			$("#datatable tbody").append(tr_str);
			insert_="-1";			
		}else{
 			$("#list_"+c_id).after(tr_str);
			insert_=c_id;
		}
 		
		$("#field_id_"+indexs).html(selects);
 		$("#field_id_"+indexs+" [name=filter_field]").attr("id","filter_field_"+indexs).attr("fid",indexs).unbind();	
		
		if(is_load==1){
			get_field_list("filter_field_"+indexs);
		}else{
			var option_index=$("#filter_field_"+clone_id+" option:selected").attr("index")+1;
			$("#filter_field_"+indexs).get(0).selectedIndex=option_index;
		}
 		
		$("#field_if_"+indexs).val($("#field_if_"+clone_id).val());
		$("#filter_term_"+indexs).val($("#filter_term_"+clone_id).val()).bind("change",function(){
			filter_term_(this.value,$(this).attr("fid"));
		});
		
 		$("#field_index").val(indexs);
 		
		if($("#filter_term_"+indexs).val()=="!=''"||$("#filter_term_"+indexs).val()=="=''"){
			$("#filter_value_"+indexs).attr("disabled","disabled");
		}else if($("#filter_term_"+indexs).val()=="between"){
			$("#value_"+indexs).html("<input type=\"text\" name=\"filter_if_begin\" id=\"filter_if_begin_"+indexs+"\" maxlength=\"100\" size=\"13\" fid=\""+indexs+"\"/> 至 <input type=\"text\" name=\"filter_if_end\" id=\"filter_if_end_"+indexs+"\" maxlength=\"100\" size=\"13\"  fid=\""+indexs+"\"/>");
		} 
 		
 		$("#list_"+indexs+" input[type='text']").addClass("inputText").hover(function(){if($(this).hasClass("input_focus")==false){$(this).addClass("inputTextHover")}},function(){$(this).removeClass("inputTextHover")}).focus(function(){$(this).removeClass("inputText inputTextHover input_focus").addClass("input_focus")}).blur(function(){$(this).addClass("inputText").removeClass("input_focus inputTextHover")});
 		
		$("#list_"+indexs+"").addClass('over');
		setTimeout("$('#list_"+indexs+"').removeClass('over');",1200);
		
		$("#list_"+indexs+" :input").unbind("blur").bind("blur",function(){
   			get_filter_($(this).attr("fid"),'update');
		})
 		
		goto_anchor("list_"+indexs);
		get_filter_(indexs,insert_);
    		
  	}else if(do_=="up"){
		
		var tr_up = tr_this.prev();
		$(tr_up).before(tr_this);
		
		var f_l_up = f_l_this.prev();
		$(f_l_up).before(f_l_this);
 		
		$("#list_"+id+"").addClass('over');
 		setTimeout("$('#list_"+id+"').removeClass('over');",1200);
 	}else if(do_=="dw"){
		
		var tr_down = tr_this.next();
 		$(tr_down).after(tr_this);
		
		var f_l_down = f_l_this.next();
 		$(f_l_down).after(f_l_this);
		
		$("#list_"+id+"").addClass('over');
		setTimeout("$('#list_"+id+"').removeClass('over');",1200);
  	}else{
  		$(tr_this).remove();
		$(f_l_this).remove();
 		if($("#datatable tbody tr").length==0){
			show_field_table("show");
		} 
 	}
	order_datatable_();
	$("#filter_list span").show();
	$("#filter_list span:last").hide();
	$("#datatable tbody tr").find("select[name='field_if']").attr("disabled",false);
	$("#datatable tbody tr:last").find("select[name='field_if']").attr("disabled","disabled");
}

function filter_term_(term,indexs){
	
	if(term=="!=''"||term=="=''"){
		$("#value_"+indexs).html("<input type=\"text\" name=\"filter_value\" id=\"filter_value_"+indexs+"\" maxlength=\"100\" size=\"36\" fid=\""+indexs+"\" disabled/>");
 		
	}else if(term=="between"){
		
		$("#value_"+indexs).html("<input type=\"text\" name=\"filter_if_begin\" id=\"filter_if_begin_"+indexs+"\" maxlength=\"100\" size=\"13\" fid=\""+indexs+"\"/> 至 <input type=\"text\" name=\"filter_if_end\" id=\"filter_if_end_"+indexs+"\" maxlength=\"100\" size=\"13\" fid=\""+indexs+"\"/>");
		
	}else{
		$("#value_"+indexs).html("<input type=\"text\" name=\"filter_value\" id=\"filter_value_"+indexs+"\" maxlength=\"100\" size=\"36\" fid=\""+indexs+"\"/>");
	}
	$("#list_"+indexs+" input[type='text']").addClass("inputText").hover(function(){if($(this).hasClass("input_focus")==false){$(this).addClass("inputTextHover")}},function(){$(this).removeClass("inputTextHover")}).focus(function(){$(this).removeClass("inputText inputTextHover input_focus").addClass("input_focus")}).blur(function(){$(this).addClass("inputText").removeClass("input_focus inputTextHover");get_filter_(indexs,"update");});
  	 
} 
 
 
function get_filter_(index,insert_){
	
	var filter_warp="<span id='filter_l_"+index+"'>";
	var filter_list="（ ";
 	var filter_term=$("#list_"+index).find("select[name='filter_term']").val();
	var filter_value="";
	
	if(filter_term=="!=''"||filter_term=="=''"){
		filter_value="";
	}else if(filter_term=="between"){
		filter_value="‘<span class='yellow_tip'>"+$("#list_"+index).find("input[name='filter_if_begin']").val()+"</span>’ 至 ‘<span class='yellow_tip'>"+$("#list_"+index).find("input[name='filter_if_end']").val()+"</span>’";
	}else{
		filter_value="‘<span class='yellow_tip'>"+$("#list_"+index).find("input[name='filter_value']").val()+"</span>’";
	}
	
 	filter_list+="<span class='blue_tip'>"+$("#list_"+index).find("select[name='filter_field'] option:selected").text()+"</span>  ";
	filter_list+=$("#list_"+index).find("select[name='filter_term'] option:selected").text()+"  ";
	filter_list+=filter_value+" ） ";
 	filter_list+="<span class='green field_if'>"+$("#list_"+index).find("select[name='field_if'] option:selected").text()+"</span> ";
 	filter_warp+=filter_list+"</span>";
 	
 	if(insert_==""||insert_=="-1"||insert_==undefined){
		$("#filter_list").append(filter_warp);
 	}else if(insert_=="update"){
		$("#filter_l_"+index).html(filter_list);
		$("#filter_list span:last").hide();
	}else{
		$("#filter_l_"+insert_).after(filter_warp);
	}
}

function get_filter_sql_(){
	var insert_="",field_="",filter_sql="";
	var last_index=$("#datatable tbody tr:last").attr("fid");
	
	$("#datatable tbody tr").map(function(){
 		var index=$(this).attr("fid");
 		 
		filter_sql+="(";
		var filter_field=$("#list_"+index).find("select[name='filter_field']").val();
		var filter_term=$("#list_"+index).find("select[name='filter_term']").val();
		var filter_value="",field_f_value="",filter_if_begin="",filter_if_end="";
  		var field_if=$("#list_"+index).find("select[name='field_if']").val();
  		
		if(filter_term=="!=''"||filter_term=="=''"){
			filter_value="";
			field_f_value="";
		}else if(filter_term=="between"){
			filter_if_begin=$("#list_"+index).find("input[name='filter_if_begin']").val();
			filter_if_end=$("#list_"+index).find("input[name='filter_if_end']").val();
			filter_value="'"+filter_if_begin+"' and '"+filter_if_end+"'";
		}else if(filter_term=="like%"){
			filter_term="like";
			field_f_value=$("#list_"+index).find("input[name='filter_value']").val();
			filter_value="'"+field_f_value+"%'";
		}else if(filter_term=="%like"){
			filter_term="like";
			field_f_value=$("#list_"+index).find("input[name='filter_value']").val();
			filter_value="'%"+field_f_value+"'";
		}else if(filter_term=="like"){
			field_f_value=$("#list_"+index).find("input[name='filter_value']").val();
			filter_value="'%"+field_f_value+"%'";
		}else if(filter_term=="in"||filter_term=="not in"){
			field_f_value=$("#list_"+index).find("input[name='filter_value']").val();
			filter_value="("+field_f_value+")";
		}else{
			field_f_value=$("#list_"+index).find("input[name='filter_value']").val();
			filter_value="'"+field_f_value+"'";
		}
 		
		filter_sql+=filter_field+"  ";
		filter_sql+=filter_term+"  ";
		filter_sql+=filter_value+")  ";
		if(index!=last_index){
			filter_sql+=field_if+"  ";
 		}
 		
 		field_+=filter_field+"#_#"+filter_term+"#_#"+field_f_value+"#_#"+filter_if_begin+"#_#"+filter_if_end+"#_#"+field_if+"|";
 	});
	if (field_!=""){field_=field_.substr(0,field_.length-1)}
	$("#lead_filter_field").val(field_);
	$("#lead_filter_sql").val(filter_sql);
}
   
</script>
       
</head>
<body>
<input type="hidden" name="current_input" id="current_input"/> 
<input type="hidden" name="step_id" id="step_id"/> 
<input name="get_dial_status" id="get_dial_status" type="hidden" value="0" />
<input type="hidden" name="get_dial_method" id="get_dial_method" value="0" />
<input type="hidden" name="get_dial_level" id="get_dial_level" value="0" />
<input type="hidden" name="get_campaign_id" id="get_campaign_id" value="0" />

<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>

<div class="field_list_div field_list" id="field_list_div"></div>

<?php
switch($action){
  
case "add_list":
?>

<script>

function do_add_list(){
	 
	if($("#list_id").val() == ""){
		alert("请填写客户清单ID号！");
		$("#list_id").focus();
		return false;
	}else if($("#list_id").val().length>8||$("#list_id").val().length<2){
		alert("客户清单ID位数必须介于2-8位字符之间！");
		$("#list_id").select();
		return false;
	}else if($("#list_id").val().substring(0,1)=="0"){
		alert("客户清单ID首位数字不能为 0 ！");
		$("#list_id").select();
		return false;
	}
	
	if($("#list_name").val() == ""){
		alert("请填写客户清单名称！");
		$("#list_name").focus();
		return false;
	}else if($("#list_name").val().length>20||$("#list_name").val().length<2){
		alert("客户清单名称位数必须介于2-20位字符之间！");
		$("#list_name").select();
		return false;
	}
  	
	if($("#campaign_id").val() == ""){
		alert("请选择所属业务活动！");
		$("#campaign_id").focus();
		return false;
	}
  	
	$('#load').show();
	var datas="action=leads_list_set&do_actions=add&"+$('#form1').serialize()+times;
	//alert(datas);
	//return false;
	
 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		    request_tip(json.des,json.counts);
			_DialogInstance.ParentWindow.request_tip(json.des,json.counts);
			if(json.counts=="1"){
 				 
				_DialogInstance.ParentWindow.GetPageCount($(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"count");
				_DialogInstance.ParentWindow.get_datalist($(_DialogInstance.ParentWindow.document).find("#pages").val(),$(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"list",$(_DialogInstance.ParentWindow.document).find("#pagesize").val());
 				setTimeout('Dialog.close();',10);
			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
} 


$(document).ready(function(){
	$('.td_underline tr:visible:odd').addClass('alt');
	get_select_opt('','../campaign/send.php','get_campaigns_list','campaign_id','group_def')
});
 
</script>
  
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">客户清单管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
</div>

<div class="page_main" >
            
<fieldset ><legend ><?php echo $tits ?></legend>
<form action="" method="post" name="form1" id="form1">
   
    <table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
    <tr >
      <td width="30%" align="right">客户清单ID：</td>
      <td align="left"><input maxlength="8" size="30" class="s_input" name="list_id" id="list_id" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" onblur="this.value=this.value.replace(/\D/g,'');check_list()"/><span class="red">※</span><span class="gray">纯数字,最长8位,首位不能为0</span></td>
    </tr>
    <tr >
      <td align="right">客户清单名称：</td>
      <td align="left"><input maxlength="30" size="30" class="s_input" name="list_name" id="list_name"/><span class="red">※</span></td>
    </tr>
    <tr >
      <td align="right">客户清单描述：</td>
      <td align="left"><input maxlength="255" size="30" class="s_input" name="list_description" id="list_description"/></td>
    </tr>
    <tr >
      <td align="right">激活使用：</td>
      <td align="left"><select name="active" class="s_option" id="active">
          <option value="Y" selected="selected">启用</option>
          <option value="N">禁用</option>
        </select></td>
    </tr>
    <tr >
      <td align="right">所属业务活动：</td>
      <td align="left">
      <select name="campaign_id" id="campaign_id" class="s_option">
            <option value="">未指定</option>
            <option value="XXXXXNONE" disabled="disabled">------------------------</option> 
      </select>
      <span class="gray">设定本客户清单所属业务活动</span>
       
      </td>
    </tr>    
    </table>
    
 </form>
 
</fieldset>
    
      
</div>

<?php 

break;

case "edit_list":
 
$sql="select vicidial_lists.list_id,list_name,campaign_id,active,list_description,list_changedate,list_lastcalldate,reset_time,ifnull(lead_counts,0) as lead_counts from  vicidial_lists left join(select count(*) as lead_counts,list_id from vicidial_list where list_id='".$list_id."' group by list_id)datas on vicidial_lists.list_id=datas.list_id where vicidial_lists.list_id='".$list_id."'  ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
  		$list_name=$rs["list_name"];
 		$list_id=$rs["list_id"];
 		$active=$rs["active"];
		$list_description=$rs["list_description"];
  		$list_changedate=$rs["list_changedate"];
		$list_lastcalldate=$rs["list_lastcalldate"];
		$reset_time=$rs["reset_time"];
  		$campaign_id=$rs["campaign_id"];
		$lead_counts=$rs["lead_counts"];
    }
 	echo "<script>$(document).ready(
	function(){
    		 
  		$('.td_underline tr:visible:odd').addClass('alt');
   
		$('#active').val('".$active."');
   		get_select_opt('".$campaign_id."','../campaign/send.php','get_campaigns_list','campaign_id','group_def');
		
		get_leads_count('status_count','1');
  		show_div('datatable_2');
		show_div('datatable_3');
  		show_div('datatable_4');
		show_div('datatable_5');
		
 		
  	});
</script>";
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("该客户清单不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>

<script>
  
function do_edit_list(is_campaign){
	 
	if($("#list_name").val() == ""){
		alert("请填写客户清单名称！");
		$("#list_name").focus();
		return false;
	}else if($("#list_name").val().length>20||$("#list_name").val().length<2){
		alert("客户清单名称位数必须介于2-20位字符之间！");
		$("#list_name").select();
		return false;
	}
  	
	/*if($("#campaign_id").val() == ""){
		alert("请选择所属业务活动！");
		$("#campaign_id").focus();
		return false;
	}*/
	
	if($("#reset_list").val() == "Y"){
		if(confirm("重置选项将把本客户清单内号码设置为可呼叫状态，您确定要重置本清单吗？")){}else{$("#reset_list").val("N")}
	}
  	
	$('#load').show();
	var datas="action=leads_list_set&do_actions=update&"+$('#form1').serialize()+times;
   	  
 	//alert(datas);
   	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		
		 request_tip(json.des,json.counts);
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts); 
 		 if(json.counts=="1"){
			 
			if(is_campaign==""||is_campaign==undefined){
				$(_DialogInstance.ParentWindow.document).find("#leads_list_<?php echo $list_id ?> td").eq(2).attr("title",$("#list_name").val()+" "+$("#list_description").val()).html("<div class='hide_tit'><span class='green'>"+$("#list_name").val()+"</span></div>");
				if($("#reset_list").val() == "Y"){
					$(_DialogInstance.ParentWindow.document).find("#leads_list_<?php echo $list_id ?> td").eq(3).html("<span class='green'>"+json.set_time+"</span>");
				}
				 
				$(_DialogInstance.ParentWindow.document).find("#leads_list_<?php echo $list_id ?> td").eq(5).html("<span class='green'>"+$("#campaign_id option:selected").text()+"</span>");
				$(_DialogInstance.ParentWindow.document).find("#leads_list_<?php echo $list_id ?> td").eq(7).html("<span class='green'>"+$("#active option:selected").text()+"</span>");
			
			}else{
				$(_DialogInstance.ParentWindow.document).find("#leads_list_<?php echo $list_id ?> td").eq(1).html("<div class='hide_tit' title='"+$("#list_name").val()+"'><span class='green'>"+$("#list_name").val()+"</span><div>");
				$(_DialogInstance.ParentWindow.document).find("#leads_list_<?php echo $list_id ?> td").eq(2).html("<div class='hide_tit' title='"+$("#list_description").val()+"'><span class='green'>"+$("#list_description").val()+"</span><div>");
				$(_DialogInstance.ParentWindow.document).find("#leads_list_<?php echo $list_id ?> td").eq(5).html("<span class='green'>"+$("#active option:selected").text()+"</span>");

			}
			setTimeout('Dialog.close();',10);
		  }else{
			  alert(json.des);
		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
}

  
function del_list(){

	datas="action=del_leads_list&c_id="+$("#list_id").val()+times;
 	//alert(datas);
    if(confirm("客户清单包含号码基本资料、呼叫描述等信息，删除后不可恢复！\n如果近期呼叫过本清单号码，建议先导出备份或隔段时间后再行删除！\n\n您确定要删除本客户清单吗？")){
 
		$('#load').show();
		$.ajax({
			 
			url: "send.php",
			data:datas,
			
			beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
			complete :function(){$('#load').hide('100');},
			success: function(json){ 

				request_tip(json.des,json.counts);
				_DialogInstance.ParentWindow.request_tip(json.des,json.counts);
				if(json.counts=="1"){
					 
					_DialogInstance.ParentWindow.GetPageCount($(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"count");
					_DialogInstance.ParentWindow.get_datalist($(_DialogInstance.ParentWindow.document).find("#pages").val(),$(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"list",$(_DialogInstance.ParentWindow.document).find("#pagesize").val());
					setTimeout('Dialog.close();',10);
				}else{
					alert(json.des);  
				}
 									
			},error:function(XMLHttpRequest,textStatus ){
				alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
			}
		});
   	}	
} 

function reset_list_all(){

	datas="action=leads_list_set&do_actions=reset&list_id="+$("#list_id").val()+times;
 	//alert(datas);
    if(confirm("您确定要重置本客户清单号码为可呼叫状态吗？！\n重置成功后请将相应状态加入活动可呼叫状态中！")){
 
		$('#load').show();
		$.ajax({
			 
			url: "send.php",
			data:datas,
			
			beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
			complete :function(){$('#load').hide('100');},
			success: function(json){ 

				request_tip(json.des,json.counts);
			
				if(json.counts=="1"){
					$("#reset_time").html("<span class='green'>"+json.set_time+"</span>");
					$(_DialogInstance.ParentWindow.document).find("#leads_list_<?php echo $list_id ?> td").eq(3).html("<span class='green'>"+json.set_time+"</span>");
					get_leads_count('status_count','1');
					get_leads_count('entry_date_status_count','2');
					get_leads_count('entry_date_count','3');
					//get_leads_count('owner_count','4');
					 
				}else{
					alert(json.des);  
				}
 									
			},error:function(XMLHttpRequest,textStatus ){
				alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
			}
		});
   	}	

}

function export_list_all(file_type){

	datas="action=export_leads_list&list_id="+$("#list_id").val()+"&file_type="+file_type+times;
 	
    if(confirm("您确定要导出本清单数据到"+file_type+"吗？！")){
 
		$('#load').show();
		$.ajax({
			 
			url: "send.php",
			data:datas,
			
			beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
			complete :function(){$('#load').hide('100');},
			success: function(json){ 

				request_tip(json.des,json.counts);
			
				if(json.counts=="1"){
					$("#export_list_all").fadeIn();
					if(file_type=="xls"){
						$('#export_xls').html("下载：<a href=\""+json.file_path+json.file_name+"\" target=\"_blank\" title=\"点击下载导出清单\">"+json.file_name+"</a>&nbsp;&nbsp;");	
					}else{
						$('#export_csv').html("下载：<a href=\"javascript:void(0);\" onclick=\"file_down('../.."+json.file_path+json.file_name+"','"+json.file_name+"')\" title=\"点击下载导出清单,请不要使用迅雷下载！\">"+json.file_name+"</a>");	
					}
  					 
				}else{
					alert(json.des);  
				}
 									
			},error:function(XMLHttpRequest,textStatus ){
				alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
			}
		});
   	}	

}
  
function view_list_hopper_list(action,list_id){
	var diag =new Dialog("view_list_hopper_list");
 	diag.Width = 780;
	diag.Height = 450;
	diag.Title = "查看期望表提取号码";
 	diag.URL = "/document/lists/list.php?list_id="+list_id+"&tits="+encodeURIComponent("查看期望表提取号码")+"&action="+action;
  	diag.show();
	diag.OKButton.hide();
	diag.CancelButton.value="关闭";
}
   
function view_list_lead_list(action,list_id,list_active){
	var diag =new Dialog("view_list_lead_list");
 	diag.Width = 760;
	diag.Height = 420;
	diag.Title = "查看业务所属客户清单";
 	diag.URL = "/document/lists/list.php?list_id="+list_id+"&list_active="+list_active+"&tits="+encodeURIComponent("查看业务所属客户清单")+"&action="+action;
  	diag.show();
	diag.OKButton.hide();
	diag.CancelButton.value="关闭";
}
    
function get_leads_count(action,table_id){
 	//$("#reset_result_"+table_id).hide().html("");
	var url="action=get_leads_count&do_actions="+action+"&list_id="+$("#list_id").val()+times;
	//alert(url);
	//return false;
 	$.ajax({
		 
		url: "send.php",
		data:url,
		
		beforeSend:function(){$('#load_'+table_id).show('100');},
		complete :function(){$('#load_'+table_id).hide('100');},
		success: function(json){ 
 		 	$("#datatable_"+table_id+" tbody tr").remove();
			if(parseInt(json.counts)>0){
 				$("#show_lead_count_"+table_id).val("1");
 				$.each(json.datalist, function(index,con){
					 
 					strong="";
					b_strong="";
					do_edit="";
 					tr_str="<tr align=\"left\">";
 					
					if(table_id=="1"){
						if(con.status=="合计"){
							strong="<strong>";
							b_strong="</strong>";
						}
						do_edit="<div><span id='csv_"+table_id+"_"+index+"'></span> <span id='xls_"+table_id+"_"+index+"'></span> <a class='close'></a></div><a href='javascript:void(0)' onclick=\"reset_list_('','"+con.status+"','','export','"+table_id+"','"+index+"','xls')\" title='导出到Excel文档'>导出Xls</a> <a href='javascript:void(0)' onclick=\"reset_list_('','"+con.status+"','','reset','"+table_id+"','"+index+"')\">重置</a> 禁用 启用 <a href='javascript:void(0)' onclick=\"reset_list_('','"+con.status+"','','del','"+table_id+"','"+index+"')\">删除</a>";
 						tr_str+="<td><span class='green'>"+strong+con.status+b_strong+"</span></td>";
						tr_str+="<td>"+strong+con.status_name+b_strong+"</td>";
						tr_str+="<td>"+strong+con.call_1+b_strong+"</td>";
						tr_str+="<td>"+strong+con.call_0+b_strong+"</td>";
					}else if(table_id=="2"){
						if(con.entry_date=="总计"||con.status=="合计"){
							strong="<strong>";
							b_strong="</strong>";
						}
						do_edit="<div><span id='csv_"+table_id+"_"+index+"'></span> <span id='xls_"+table_id+"_"+index+"'></span> <a class='close'></a></div><a href='javascript:void(0)' onclick=\"reset_list_('"+con.entry_date+"','"+con.status+"','entry_date','export','"+table_id+"','"+index+"','xls')\" title='导出到Excel文档'>导出Xls</a> <a href='javascript:void(0)' onclick=\"reset_list_('"+con.entry_date+"','"+con.status+"','entry_date','reset','"+table_id+"','"+index+"')\">重置</a> 禁用 启用 <a href='javascript:void(0)' onclick=\"reset_list_('"+con.entry_date+"','"+con.status+"','entry_date','del','"+table_id+"','"+index+"')\">删除</a>";

						tr_str+="<td><span class='green'>"+strong+con.entry_date+b_strong+"</span></td>";
						tr_str+="<td>"+strong+con.status+b_strong+"</td>";
						tr_str+="<td>"+strong+con.status_name+b_strong+"</td>";
						tr_str+="<td>"+strong+con.call_1+b_strong+"</td>";
						tr_str+="<td>"+strong+con.call_0+b_strong+"</td>";
					}else if(table_id=="3"){
						if(con.entry_date=="合计"){
							strong="<strong>";
							b_strong="</strong>";
						}
						do_edit="<div><span id='csv_"+table_id+"_"+index+"'></span> <span id='xls_"+table_id+"_"+index+"'></span> <a class='close'></a></div><a href='javascript:void(0)' onclick=\"reset_list_('"+con.entry_date+"','','entry_date','export','"+table_id+"','"+index+"','xls')\" title='导出到Excel文档'>导出Xls</a> <a href='javascript:void(0)' onclick=\"reset_list_('"+con.entry_date+"','','entry_date','reset','"+table_id+"','"+index+"')\">重置</a> 禁用 启用 <a href='javascript:void(0)' onclick=\"reset_list_('"+con.entry_date+"','','entry_date','del','"+table_id+"','"+index+"')\">删除</a>";

						tr_str+="<td><span class='green'>"+strong+con.entry_date+b_strong+"</span></td>";
 						tr_str+="<td>"+strong+con.call_1+b_strong+"</td>";
						tr_str+="<td>"+strong+con.call_0+b_strong+"</td>";
						
					}else if(table_id=="4"){
						if(con.last_local_call_time=="总计"||con.status=="合计"){
							strong="<strong>";
							b_strong="</strong>";
						}
						do_edit="<div><span id='csv_"+table_id+"_"+index+"'></span> <span id='xls_"+table_id+"_"+index+"'></span> <a class='close'></a></div><a href='javascript:void(0)' onclick=\"reset_list_('"+con.last_local_call_time+"','"+con.status+"','last_local_call_time','export','"+table_id+"','"+index+"','xls')\" title='导出到Excel文档'>导出Xls</a> <a href='javascript:void(0)' onclick=\"reset_list_('"+con.last_local_call_time+"','"+con.status+"','last_local_call_time','reset','"+table_id+"','"+index+"')\">重置</a> 禁用 启用 <a href='javascript:void(0)' onclick=\"reset_list_('"+con.last_local_call_time+"','"+con.status+"','last_local_call_time','del','"+table_id+"','"+index+"')\">删除</a>";

						tr_str+="<td><span class='green'>"+strong+con.last_local_call_time+b_strong+"</span></td>";
						tr_str+="<td>"+strong+con.status+b_strong+"</td>";
						tr_str+="<td>"+strong+con.status_name+b_strong+"</td>";
						tr_str+="<td>"+strong+con.call_1+b_strong+"</td>";
						tr_str+="<td>"+strong+con.call_0+b_strong+"</td>";
					}else if(table_id=="5"){
						if(con.last_local_call_time=="合计"){
							strong="<strong>";
							b_strong="</strong>";
						}
						do_edit="<div><span id='csv_"+table_id+"_"+index+"'></span> <span id='xls_"+table_id+"_"+index+"'></span> <a class='close'></a></div><a href='javascript:void(0)' onclick=\"reset_list_('"+con.last_local_call_time+"','','last_local_call_time','export','"+table_id+"','"+index+"','xls')\" title='导出到Excel文档'>导出Xls</a> <a href='javascript:void(0)' onclick=\"reset_list_('"+con.last_local_call_time+"','','last_local_call_time','reset','"+table_id+"','"+index+"')\">重置</a> 禁用 启用 <a href='javascript:void(0)' onclick=\"reset_list_('"+con.last_local_call_time+"','','last_local_call_time','del','"+table_id+"','"+index+"')\">删除</a>";

						tr_str+="<td><span class='green'>"+strong+con.last_local_call_time+b_strong+"</span></td>";
 						tr_str+="<td>"+strong+con.call_1+b_strong+"</td>";
						tr_str+="<td>"+strong+con.call_0+b_strong+"</td>";
						
					}
  					tr_str+="<td>"+do_edit+"</td>";
					tr_str+="</tr>";
					$("#datatable_"+table_id+" tbody").append(tr_str);
				}); 
				
    			$("#datatable_"+table_id+" tbody tr").removeClass().hover(function(){$(this).addClass("over")},function(){$(this).removeClass("over")});
				$("#datatable_"+table_id+" tbody tr:odd").addClass("alt");
				$("#datatable_"+table_id+" a.close").bind("click",function(){$(this).parent().fadeOut()}).attr("title","关闭");
				
			}else{
   			 
				tr_str="<tr><td colspan=\"12\" align=\"center\">"+json.des+"</td></tr>"
				$("#datatable_"+table_id+"").append(tr_str);
 			}  
			 
 		} 
	});
	 
}

function reset_list_(f1,f2,f3,action,table_id,td_id,file_type){
	if(action=="del"){
		if(confirm("客户清单包含号码基本资料、呼叫描述等信息，删除后不可恢复！\n如果近期呼叫过本清单号码，建议先导出备份或隔段时间后再行删除！\n\n您确定要删除本状态所属号码吗？")){}else{return false;}
	}
   	
	datas="action=reset_list_&do_actions="+action+"&list_id="+$("#list_id").val()+"&file_type="+file_type+"&f1="+encodeURIComponent(f1)+"&f2="+encodeURIComponent(f2)+"&f3="+encodeURIComponent(f3)+times;
 	//alert(datas);
	//return false;
	$('#load').show();
	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){request_tip("系统正在处理，请稍候...","1");$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){
			 request_tip(json.des,json.counts);
 			
			 if(json.counts=="1"){
				 
				if(action=='export'){
					 
 					$("#xls_"+table_id+"_"+td_id).parent().fadeIn();
					if(file_type=="xls"){
						$("#xls_"+table_id+"_"+td_id).html("&nbsp;<a href=\""+json.file_path+json.file_name+"\" target=\"_blank\" title=\"点击下载导出清单\">下载Xls</a>&nbsp;");	
					}else{
						$("#csv_"+table_id+"_"+td_id).html("&nbsp;<a href=\"javascript:void(0);\" onclick=\"file_down('../.."+json.file_path+json.file_name+"','"+json.file_name+"')\" title=\"点击下载导出清单,请不要使用迅雷下载！\">下载csv</a>&nbsp;");	
					}
				}else{
					
					if(action=='reset'){
						$("#reset_time").html("<span class='green'>"+json.set_time+"</span>");
						$(_DialogInstance.ParentWindow.document).find("#leads_list_<?php echo $list_id ?> td").eq(3).html("<span class='green'>"+json.set_time+"</span>");
					}
					get_leads_count('status_count','1');
					
					if($("#show_lead_count_2").val()=="1"){
						get_leads_count('entry_date_status_count','2');
					}
					
					if($("#show_lead_count_3").val()=="1"){
						get_leads_count('entry_date_count','3');
					}
					
					if($("#show_lead_count_4").val()=="1"){
						get_leads_count('last_call_status_count','4');
					}
					
					if($("#show_lead_count_5").val()=="1"){
						get_leads_count('last_call_count','5');
					}
					
					
				}
				 
			}else{
				alert(json.des);  
			} 
								
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	
}

function show_leads_count_list(table_id){
	
	if($("#show_lead_count_"+table_id).val()=="0"){
		switch(table_id){
			case "1":
				get_leads_count('status_count','1');
			break;
			case "2":
				get_leads_count('entry_date_status_count','2');
			break;
			case "3":
				get_leads_count('entry_date_count','3');
			break;
			case "4":
				get_leads_count('last_call_status_count','4');
			break;
			case "5":
				get_leads_count('last_call_count','5');
			break;
 		
		}
	}
	show_div("datatable_"+table_id);
	 
}

</script>
<style>
.count_layer{position:absolute;background:#FFFF99;border:1px solid #999;line-height:20px;height: 20px;padding:2px 4px 0 4px; z-index:10; display:none}
.dataTable div{position:relative;width:80%;height:20px;line-height:20px;background:#FEFEE9;border:1px solid #B1B1B1;position:relative; display:none}
.dataTable a.close{width:8px;height:8px;line-height:8px;background:url(/images/tips/tip_bg.gif) no-repeat 0 -26px;display:inline;position:absolute;right:4px;top:6px;cursor:pointer;font-size:1px;}
.dataTable a.close:hover{background-position:0 -34px;}
 
</style> 

    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">客户清单管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
    
<table border="0" cellpadding="0" cellspacing="0" class="menu_list">
     <tr>
        <td colspan="2"><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="export_list_all('csv');" title="导出本清单号码文本文档"><img src="/images/icons/notebook.png" style="margin-top:6px" /><b>导出本清单号码到Csv&nbsp;</b></a><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="export_list_all('xls');" title="导出本清单号码到Excel"><img src="/images/icons/excel.png" style="margin-top:6px" /><b>导出本清单号码到Xls&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="reset_list_all();" title="重置本清单号码为可呼叫状态"><img src="/images/icons/telephone4.png" style="margin-top:6px" /><b>重置本清单号码&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="del_list();" title="删除本客户清单"><img src="/images/icon_cancel.gif" style="margin-top:4px"/><b>删除本清单&nbsp;</b></a></td>
    </tr>
</table>
<div class="menu_list" id="export_list_all" style="display:none"><span id="export_csv" style="margin-right:10px"></span><span id="export_xls"></span></div>        

<input type="hidden" name="list_active" id="list_active" value="" />
<form action="" method="post" name="form1" id="form1">
<input type="hidden" name="list_id" id="list_id" value="<?php echo $list_id ?>" />
<input type="hidden" name="old_campaign_id" id="old_campaign_id" value="<?php echo $campaign_id ?>" />
 
 <fieldset> <legend style="font-weight:normal" onclick="show_div('list_info')">基本信息</legend>
  
    <table width="100%" cellpadding="0" cellspacing="0" class="td_underline" id="list_info">
     
    <tr >
      <td align="right">客户清单ID：</td>
      <td align="left"><span class="blue"><strong><?php echo $list_id ?></strong></span></td>
    </tr>
    <tr >
      <td align="right">号码数量：</td>
      <td align="left"><span class="green"><strong><?php echo $lead_counts ?></strong></span></td>
    </tr>
    <tr >
      <td width="30%" align="right">客户清单名称：</td>
      <td align="left"><input name="list_name" id="list_name" value="<?php echo $list_name ?>" size="30" class="s_input" maxlength="30"/><span class="red">※</span></td>
    </tr>
    <tr >
      <td align="right">客户清单描述：</td>
      <td align="left"><input name="list_description" id="list_description" value="<?php echo $list_description ?>" size="30" class="s_input" maxlength="255"/></td>
    </tr>
    <tr >
      <td align="right">激活使用：</td>
      <td align="left">
       <select name="active" class="s_option" id="active">
          <option value="Y">启用</option>
          <option value="N">禁用</option>
        </select>
        </td>
    </tr>
    <tr >
      <td align="right">重置号码：</td>
      <td align="left">
        <select name="reset_list" class="s_option" id="reset_list">
          <option value="Y">重置</option>
          <option value="N" selected="selected">不重置</option>
        </select><span class="gray">设置本客户清单号码重新呼叫</span>
      </td>
    </tr>
    <tr >
      <td align="right">所属业务活动：</td>
      <td align="left">
      <select name="campaign_id" class="s_option" id="campaign_id">
            <option value="">未指定</option>
            <option value="XXXXXNONE" disabled="disabled">------------------------</option> 
            
         </select><span class="red">※</span><span class="gray">设定本客户清单所属业务活动</span>
       
      </td>
    </tr>
    
    <tr > 
      <td align="right">最后重置时间：</td>
      <td align="left"><span id="reset_time"><?php echo $reset_time ?></span></td>
    </tr>
    <tr > 
      <td align="right">最后更改时间：</td>
      <td align="left"><?php echo $list_changedate ?></td>
    </tr>
    <tr >
      <td align="right">最后话务时间：</td>
      <td align="left"><?php echo $list_lastcalldate ?></td>
    </tr>
    
  </table>
</fieldset>
     <fieldset>
       <legend style="font-weight:normal" onclick="show_leads_count_list('1')" title="点击收缩/展开">呼叫状态统计</legend>
       <div id="load_1" class="count_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
        <input type="hidden" name="show_lead_count_1" id="show_lead_count_1" value="0"/>
        <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable_1" >
              <thead>
                <tr align="left" class="dataHead">
                  <th >状态码</th>
                  <th >呼叫结果</th>
                  <th >已呼叫</th>
                  <th >未呼叫</th>
                  <th width="24%" >操作</th>  
                </tr>
              </thead>   
                <tbody>
                </tbody>
         </table>
               
     </fieldset> 
     
    <fieldset>
       <legend style="font-weight:normal" onclick="show_leads_count_list('2')" title="点击收缩/展开">导入日期、呼叫状态统计</legend>
       <div id="load_2" class="count_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
        <input type="hidden" name="show_lead_count_2" id="show_lead_count_2" value="0"/>
        <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable_2" >
              <thead>
                <tr align="left" class="dataHead">
                              
                  <th>导入日期</th>
                  <th>状态码</th>
                  <th>呼叫结果</th>
                  <th>已呼叫</th>
                  <th >未呼叫</th>
                  <th width="26%" >操作</th>   
                </tr>
              </thead>   
                <tbody>
                </tbody>
         </table>
               
     </fieldset>     
     
    <fieldset>
       <legend style="font-weight:normal" onclick="show_leads_count_list('3')" title="点击收缩/展开">导入日期统计</legend>
        <div id="load_3" class="count_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
         <input type="hidden" name="show_lead_count_3" id="show_lead_count_3" value="0"/>
        <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable_3" >
              <thead>
                <tr align="left" class="dataHead">
                              
                  <th width="20%">导入日期</th>
                  <th width="20%">已呼叫</th>
                  <th >未呼叫</th>
                  <th width="26%" >操作</th>   
                </tr>
              </thead>   
            <tbody>
            </tbody>
                 
        </table>
               
     </fieldset> 
      
    <fieldset>
       <legend style="font-weight:normal" onclick="show_leads_count_list('4')" title="点击收缩/展开">呼叫日期、呼叫状态统计</legend>
       <div id="load_4" class="count_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
        <input type="hidden" name="show_lead_count_4" id="show_lead_count_4" value="0"/>
        <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable_4" >
              <thead>
                <tr align="left" class="dataHead">
                              
                  <th>呼叫日期</th>
                  <th>状态码</th>
                  <th>呼叫结果</th>
                  <th>已呼叫</th>
                  <th >未呼叫</th>
                  <th width="26%" >操作</th>   
                </tr>
              </thead>   
                <tbody>
                </tbody>
         </table>
               
     </fieldset>     
     
    <fieldset>
       <legend style="font-weight:normal" onclick="show_leads_count_list('5')" title="点击收缩/展开">呼叫日期统计</legend>
        <div id="load_5" class="count_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
         <input type="hidden" name="show_lead_count_5" id="show_lead_count_5" value="0"/>
        <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable_5" >
              <thead>
                <tr align="left" class="dataHead">
                              
                  <th width="20%">呼叫日期</th>
                  <th width="20%">已呼叫</th>
                  <th >未呼叫</th>
                  <th width="26%" >操作</th>   
                </tr>
              </thead>   
            <tbody>
            </tbody>
                 
        </table>
               
     </fieldset> 
</form>
      
</div>
  
<?php 

break;
 
case "edit_leads":
?>
<?php

$sql="select phone_number,status,called_since_last_reset,title,first_name,middle_initial,last_name,address1,address2,address3,city,state,postal_code,province,gender,alt_phone,email,comments,date_of_birth,DATE_ADD(last_local_call_time,INTERVAL 8 hour) as 'last_local_call_time',entry_date,modify_date from vicidial_list where lead_id='".$lead_id."'  ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
  		$phone_number=$rs["phone_number"];
 		$status=$rs["status"];
 		$called_since_last_reset=$rs["called_since_last_reset"];
		$title=$rs["title"];
  		$first_name=$rs["first_name"];
		$middle_initial=$rs["middle_initial"];
		$last_name=$rs["last_name"];
  		$address1=$rs["address1"];
		
  		$address2=$rs["address2"];
 		$address3=$rs["address3"];
 		$city=$rs["city"];
   		$state=$rs["state"];
		$province=$rs["province"];
		$gender=$rs["gender"];
  		$alt_phone=$rs["alt_phone"];
		$postal_code=$rs["postal_code"];
  		$email=$rs["email"];
 		$comments=$rs["comments"];
 		$date_of_birth=$rs["date_of_birth"];
		$last_local_call_time=$rs["last_local_call_time"];
  		$entry_date=$rs["entry_date"];
		$modify_date=$rs["modify_date"];
 		
    }
 	echo "<script>$(document).ready(
	function(){
    		 
  		$('.td_underline tr:visible:odd').addClass('alt');
   
		$('#called_since_last_reset').val('".$called_since_last_reset."');
   		 
 		get_select_opt('".$status."','../campaign/send.php','get_dial_status','status','def');
		
		$('#CheckedAll').click(function(){
			$('[name=c_id]:checkbox:enabled').attr('checked',this.checked);
		});
		
		var Sorts_Order=0;
		$('#datatable .dataHead th[sort]').map(function(){
			Sorts_Order=Sorts_Order+1;
			
			html=$(this).html();
			
			$(this).attr('id','DadaSorts_'+Sorts_Order).off().on('click',function(){
				Sorts_new('datatable',$(this).attr('id'),$('#pagesize').val());	
			}).html('<div>'+html+'<span class=\'sorting\'></span></div>');
			
		});
		
		$('<input name=\"a_ctions\" type=\"hidden\" id=\"a_ctions\"/> <input name=\"doa_ctions\" type=\"hidden\" id=\"doa_ctions\"/> <input name=\"recounts\" type=\"hidden\" id=\"recounts\"/> <input name=\"pages\" type=\"hidden\" id=\"pages\" value=\"1\"/> <input name=\"pagecounts\" type=\"hidden\" id=\"pagecounts\"/><input name=\"pagesize\" type=\"hidden\" id=\"pagesize\" value=\"15\"/> <input name=\"sorts\" type=\"hidden\" id=\"sorts\" value=\"\"/> <input name=\"order\" type=\"hidden\" id=\"order\"/>').appendTo(\"body\");
 
        GetPageCount('search','count');
        get_datalist(1,'search','list',$('#pagesize').val());
        get_custom_fields();
  		
  	});
</script>";
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("该号码不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>

<script>
  
function do_edit_lead(is_campaign){
	 
   	
	if($("#status").val() == "")
	{
		alert("请选择呼叫状态！");
		$("#status").focus();
		return false;
	}
    	
	$('#load').show();
	var datas="action=update_leads&"+$('#form1').serialize()+times;
  	//alert(datas);
   	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		
		 request_tip(json.des,json.counts);
		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts); 
 		 if(json.counts=="1"){
			 
			$(_DialogInstance.ParentWindow.document).find("#leads_<?php echo $lead_id ?> td").eq(2).html("<div class='hide_tit' title='"+$("#title").val()+"'><span class='green'>"+$("#title").val()+"</span></div>");
			$(_DialogInstance.ParentWindow.document).find("#leads_<?php echo $lead_id ?> td").eq(3).html("<div class='hide_tit' title='"+$("#comments").val()+"'><span class='green'>"+$("#comments").val()+"</span></div>");

			$(_DialogInstance.ParentWindow.document).find("#leads_<?php echo $lead_id ?> td").eq(4).html("<span class='green'>"+$("#status option:selected").text()+"</span>");
  
			$(_DialogInstance.ParentWindow.document).find("#leads_<?php echo $lead_id ?> td").eq(6).html("<span class='green'>"+$("#called_since_last_reset option:selected").text()+"</span>");
			
			 
			setTimeout('Dialog.close();',10);
		  }else{
			  alert(json.des);
		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
} 

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
	
	var url="action=get_lead_call_lists&lead_id=<?php echo $lead_id ?>&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&"+$('#form1').serialize();
	//alert(url);
	//return false;
	
	$.ajax({
		 
		url: "send.php",
		data:url,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');if(doa_ctions=="xls"||doa_ctions=="csv"){request_tip("系统正在为您导出，此过程较慢，请耐心等候...","1",25000);}},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		
			$("#datatable tfoot tr").show();
			if(parseInt(json.counts)>0){
				 
				$("#datatable tbody tr").remove();
				var tits="",td_str="",fun_str="",qua_str="";
				$.each(json.datalist, function(index,con){
   					
					if (con.location!="同步中"&&con.location !== undefined && con.location!="" && con.location!=null){
						 
						do_edit="<a href=\"javascript:void(0);\" onClick=\"play_wav(event,'play_layer','"+con.location+"');\" title=\"点击收听本次营销录音\">收听</a>";
					}else{
						do_edit=con.location;
					}
 					
					tr_str="<tr align=\"left\" >";
 					tr_str+="<td>"+con.phone_number+"</td>";
  					tr_str+="<td>"+con.users+"</td>";
					tr_str+="<td>"+con.call_status+"</td>";
					tr_str+="<td>"+con.campaign_name+"</td>";
					tr_str+="<td>"+con.qua_status+"</td>";
					tr_str+="<td>"+con.call_date+"</td>";
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
    		
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员！\n"+textStatus);
		}
	});
	 
}
 
 
 function get_custom_fields(){
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
  	
	var url="action=get_custom_fields&s&lead_id=<?php echo $lead_id ?>";
 	
	$.ajax({
		
		url: "send.php",
		data: url,
 		
		cache: false,
 		success: function(json){

			 	
				$("#list_id").val(json.listId);
	 	
		   $.each(json.datalist, function(index,con){
		   	
		   	switch(con.field_type)
				{
					case "TEXT"://TEXT					  
					  var newRow = '<tr><td width="20%" align="right">'+con.field_label+'</td><td align="left"><input maxlength="98" size="30" class="s_input" name="'+con.field_name+'" id="'+con.field_name+'"/> ';				
					  
					  
					  break;
					case "SELECT"://SELECT
					  var newRow = '<tr><td width="20%" align="right">'+con.field_label+'</td><td align="left"><select class="s_option" name="'+con.field_name+'" id="'+con.field_name+'">';
					  
					  $.each(con.field_options,function(index2,ccon){
					  	newRow += '<option value="'+ccon+'">'+ccon+'</option>';
						}); 		
					  newRow += '</select> ';

				  break;
					default:
				 
				}	 		
					
					newRow += '</td>';
				 /* newRow += '<td><a  value ='+con.field_id+' a href="javascript:void(0);" onclick="modify_custom_field('+con.field_id+')">修改</a></td>';
				  newRow += '<td><a>&nbsp;</a></td>';*/
				  //newRow += '<td><a  value ='+con.field_id+' a href="javascript:void(0);" onclick="remove_custom_field('+con.field_id+',\''+con.field_name+'\','+con.list_id+')">删除</a></td></tr>';
				 $("#list_custom_info tr:last").after(newRow);

				 $("#"+con.field_name).val(con.value);
			

		   });							 	

			
		}
	});
	 
}
 
 
 
 
</script>
<style>
.count_layer{position:absolute;background:#FFFF99;border:1px solid #999;line-height:20px;height: 20px;padding:2px 4px 0 4px; z-index:10; display:none}
  
</style> 

    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">客户清单管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
      <div class="menu_list" id="export_list_all" style="display:none"><span id="export_xls"></span><span id="export_csv"></span></div>        

<input type="hidden" name="list_active" id="list_active" value="" />
<input type="hidden" name="get_status" id="get_status" value="0" />
<form action="" method="post" name="form1" id="form1">
<input type="hidden" name="lead_id" id="lead_id" value="<?php echo $lead_id ?>" />
<input type="hidden" name="list_id" id="list_id"  />
 
 <fieldset> <legend style="font-weight:normal" onclick="show_div('list_info')">基本信息</legend>
      
  
<table width="100%" cellpadding="0" cellspacing="0" class="td_underline" id="list_info">
     
    <tr >
      <td width="20%" align="right">电话号码：</td>
      <td align="left"><span class="blue"><strong><?php echo $phone_number ?></strong></span> <span class="gray">ID:<?php echo $lead_id ?></span></td>
      <td width="20%" align="right">导入时间：</td>
      <td align="left"><?php echo $entry_date ?></td>
    </tr>
    <tr >
      <td align="right">最后更改时间：</td>
      <td align="left"><?php echo $modify_date ?></td>
      <td align="right">最后话务时间：</td>
      <td align="left"><?php echo $last_local_call_time ?></td>
    </tr>
    <tr >
      <td align="right">标题：</td>
      <td align="left"><input name="title" id="title" value="<?php echo $title ?>" size="30" class="s_input" maxlength="98"/></td>
      <td align="right">名字：</td>
      <td align="left"><input name="first_name" id="first_name" value="<?php echo $first_name ?>" size="30" class="s_input" maxlength="98"/></td>
    </tr>
    <tr >
      <td align="right">中间名：</td>
      <td align="left"><input name="middle_initial" id="middle_initial" value="<?php echo $middle_initial ?>" size="30" class="s_input" maxlength="98"/></td>
      <td align="right">姓氏：</td>
      <td align="left"><input name="last_name" id="last_name" value="<?php echo $last_name ?>" size="30" class="s_input" maxlength="98"/></td>
    </tr>
    <tr >
      <td align="right">地址1：</td>
      <td align="left"><input name="address1" id="address1" value="<?php echo $address1 ?>" size="30" class="s_input" maxlength="98"/></td>
      <td align="right">地址2：</td>
      <td align="left"><input name="address2" id="address2" value="<?php echo $address2 ?>" size="30" class="s_input" maxlength="98"/></td>
    </tr>
    <tr >
      <td align="right">地址3：</td>
      <td align="left"><input name="address3" id="address3" value="<?php echo $address3 ?>" size="30" class="s_input" maxlength="98"/></td>
      <td align="right">城市：</td>
      <td align="left"><input name="city" id="city" value="<?php echo $city ?>" size="30" class="s_input" maxlength="98"/></td>
    </tr>
    <tr >
      <td align="right">省份：</td>
      <td align="left"><input name="province" id="province" value="<?php echo $province ?>" size="30" class="s_input" maxlength="98"/></td>
      <td align="right">地区：</td>
      <td align="left"><input name="state" id="state" value="<?php echo $state ?>" size="30" class="s_input" maxlength="98"/></td>
    </tr>
    <tr >
      <td align="right">邮编：</td>
      <td align="left"><input name="postal_code" id="postal_code" value="<?php echo $postal_code ?>" size="30" class="s_input" maxlength="98"/></td>
      <td align="right">邮箱：</td>
      <td align="left"><input name="email" id="email" value="<?php echo $email ?>" size="30" class="s_input" maxlength="98"/></td>
    </tr>
    <tr >
      <td align="right">备用电话：</td>
      <td align="left"><input name="alt_phone" id="alt_phone" value="<?php echo $alt_phone ?>" size="30" class="s_input" maxlength="98"/></td>
      <td align="right">性别：</td>
      <td align="left"><input name="gender" id="gender" value="<?php echo $gender?>" size="30" class="s_input" maxlength="98"/></td>
    </tr>
    <tr >
      <td align="right">生日：</td>
      <td align="left"><input name="date_of_birth" id="date_of_birth" value="<?php echo $date_of_birth ?>" size="30" class="s_input" maxlength="98"/></td>
      <td align="right">描述：</td>
      <td align="left"><input name="comments" id="comments" value="<?php echo $comments ?>" size="30" class="s_input" maxlength="98"/></td>
    </tr>
    <tr >
      <td align="right">呼叫状态：</td>
      <td align="left">
        <select name="status" class="s_option" id="status"><option value="" selected="selected">请选择呼叫状态</option><option value="XXXXXNONE" disabled="disabled">------------------------</option> </select><span class="red">※</span></td>
      <td align="right">是否可拨：</td>
      <td align="left"><select name="called_since_last_reset" class="s_option" id="called_since_last_reset">
        <option value="N" >是</option>
        <option value="Y" >否</option>
        </select></td>
    </tr>
    
  </table>  
  
</fieldset>

<fieldset>

	<table width="100%" cellpadding="0" cellspacing="0" class="td_underline" id="list_custom_info">
     <tr>
     </tr>
  
  </table>  

</fieldset>

<fieldset>
 <legend style="font-weight:normal" onclick="show_leads_count_list('1')" title="点击收缩/展开">呼叫日志</legend>
 <div id="load_1" class="count_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
  <input type="hidden" name="show_lead_count_1" id="show_lead_count_1" value="0"/>
  <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
    <thead>
      <tr align="left" class="dataHead">
          
        <th sort="a.phone_number" >电话号码</th>
        <th sort="a.user">工号</th>
        <th sort="c.status_name">呼叫结果</th>
        <th sort="f.campaign_name">业务活动</th>
        <th sort="d.status_name" >质检结果</th>  
        <th sort="a.call_date">呼叫时间</th>    
        <th >操作</th>  
        </tr>
    </thead>   
      <tbody>
      </tbody>
      <tfoot><tr class='dataTableFoot'><td colspan='14' align='left'><div id='dataTableFoot'><div style='float:right;' id='pagelist'></div><div style='float:left;' id='total'></div></div></td></tr></tfoot>
</table>

</fieldset>
</form>

    
      
</div>
  
<?php 

break;
 
//活动所属客户清单列表
case "campaign_lead_list":
  
?>
<script>

function GetPageCount(a_ctions,doa_ctions){
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
  
	var url="action=get_list_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&list_id="+$("#list_id").val()+"&list_active="+$("#list_active").val()+times;
 	
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
	
	var url="action=get_list_leads_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&list_id="+$("#list_id").val()+"&list_active="+$("#list_active").val()+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times;
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
					 
					dblclick=" ondblclick='edit_lists(\""+con.list_id+"\")' ";
					do_edit="<a href='javascript:void(0)' onclick='edit_lists(\""+con.list_id+"\")'>修改</a>";
  					
					tr_str="<tr align=\"left\" id=\"list_"+con.list_id+"\" "+dblclick+">";
 					tr_str+="<td>"+con.list_id+"</td>";
					tr_str+="<td title='"+con.list_name+"'><div class='hide_tit'>"+con.list_name+"</div></td>";
					tr_str+="<td>"+con.list_description+"</td>";
					tr_str+="<td>"+con.counts+"</td>";
					tr_str+="<td>"+con.active+"</td>";
					tr_str+="<td>"+con.list_lastcalldate+"</td>";
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
 		} 
	});
	 
}  
$(document).ready(function(){
<?php 
if($list_id!=""){
?>	
 	var Sorts_Order=0;
	$("#datatable .dataHead th[sort]").map(function(){
		Sorts_Order=Sorts_Order+1;
		
		html=$(this).html();
		
		$(this).attr("id","DadaSorts_"+Sorts_Order).off().on("click",function(){
			Sorts_new("datatable",$(this).attr("id"),$("#pagesize").val());	
		}).html("<div>"+html+"<span class='sorting'></span></div>");
		
 	}) ;
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="12"/> <input name="sorts" type="hidden" id="sorts" value="list_id"/> <input name="order" type="hidden" id="order"/>').appendTo("body");
	
	GetPageCount('search',"count");
	get_datalist(1,"search","list",$('#pagesize').val());
<?php 
}else {
	echo '$("#form1").html("");Dialog.alert("该客户清单不存在，请检查后重试！");';
}
 ?>	 
});
</script>
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">客户清单管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
      	<input type="hidden" name="list_active" id="list_active" value="<?php echo $list_active ?>" />
        <input type="hidden" name="list_id" id="list_id" value="<?php echo $list_id ?>" />
        <fieldset ><legend> <?php echo $tits ?> </legend>
     		 <form action="" method="post" name="form1" id="form1">

            <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
                  <thead>
                    <tr align="left" class="dataHead">
                                  
                      <th sort="a.list_id" >客户清单ID</th>
                      <th sort="list_name" >客户清单名称</th>
                      <th sort="list_description">客户清单描述</th>
                      <th sort="counts">号码数量</th>
                      <th sort="active" >激活</th>
                      <th sort="list_lastcalldate">最后话务时间</th>  
                      <th >操作</th>  
                     </tr>
                  </thead>   
                    <tbody>
                    </tbody>
                    <tfoot><tr class='dataTableFoot'><td colspan='14' align='left'><div id='dataTableFoot'><div style='float:right;' id='pagelist'></div><div style='float:left;' id='total'></div></div></td></tr></tfoot>
              </table>
                               
          </form>
      </fieldset>      
      
</div>
 
<?php
break;

//活动期望表提取号码列表
case "campaign_lead_hopper_list":
?>
<script>

function GetPageCount(a_ctions,doa_ctions){
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
  
	var url="action=get_list_lead_hopper_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&list_id="+$("#list_id").val()+times;
 	
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
	
	var url="action=get_list_lead_hopper_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&list_id="+$("#list_id").val()+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times;
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
 
 					tr_str="<tr align=\"left\">";
 					tr_str+="<td>"+con.priority+"</td>";
 					tr_str+="<td>"+con.lead_id+"</td>";
					tr_str+="<td>"+con.list_id+"</td>";
					tr_str+="<td>"+con.list_name+"</td>";
					tr_str+="<td>"+con.phone_number+"</td>";
					tr_str+="<td>"+con.state+"</td>";
 					tr_str+="<td>"+con.status_name+"</td>";
 					tr_str+="<td>"+con.called_count+"</td>";
					tr_str+="<td>"+con.gmt_offset_now+"</td>";
					tr_str+="<td>"+con.alt_dial+"</td>";
 					 
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
 		} 
	});
	 
}

$(document).ready(function(){
 	
<?php 
if($list_id!=""){
?>	
 	var Sorts_Order=0;
	$("#datatable .dataHead th[sort]").map(function(){
		Sorts_Order=Sorts_Order+1;
		
		html=$(this).html();
		
		$(this).attr("id","DadaSorts_"+Sorts_Order).off().on("click",function(){
			Sorts_new("datatable",$(this).attr("id"),$("#pagesize").val());	
		}).html("<div>"+html+"<span class='sorting'></span></div>");
		
 	}) ;
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="12"/> <input name="sorts" type="hidden" id="sorts" value="hopper_id"/> <input name="order" type="hidden" id="order"/>').appendTo("body");
	
	GetPageCount('search',"count");
	get_datalist(1,"search","list",$('#pagesize').val());
<?php 
}else {
	echo '$("#form1").html("");Dialog.alert("该客户清单不存在，请检查后重试！");';
}
?>	 
});
</script>
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">客户清单管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
      	<input type="hidden" name="list_active" id="list_active" value="<?php echo $list_active ?>" />
        <input type="hidden" name="list_id" id="list_id" value="<?php echo $list_id ?>" />
        <fieldset ><legend> <?php echo $tits ?> </legend>
     		 <form action="" method="post" name="form1" id="form1">
                        
            <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
                  <thead>
                    <tr align="left" class="dataHead">
                        
                      <th sort="a.priority" >优先级</th>
                      <th sort="a.lead_id">号码编号</th>
                      <th sort="a.list_id">客户清单ID</th>
                      <th sort="a.list_name">客户清单</th>
                      <th sort="b.phone_number" >呼叫号码</th>
                      <th sort="a.state">准备状态</th>  
                      <th sort="c.status_name">呼叫状态</th>  
                      <th sort="b.called_count">计数</th>  
                      <th sort="a.gmt_offset_now">时区</th>  
                      <th sort="a.alt_dial">自动测试</th>  
                      </tr>
                  </thead>   
                    <tbody>
                    </tbody>
                    <tfoot><tr class='dataTableFoot'><td colspan='14' align='left'><div id='dataTableFoot'><div style='float:right;' id='pagelist'></div><div style='float:left;' id='total'></div></div></td></tr></tfoot>
              </table>
                               
          </form>
      </fieldset>      
      
</div>
 
<?php
break;
 
//导入号码
case "leads_load":
?>
<script src="/js/jquery.uploadify.min.js"></script>
<script>
 
$(document).ready(function () {
	$('.td_underline tr:visible:odd').addClass('alt');
	$("#file_path,#file_name").val("");
 	
	$("#leadfile").uploadify({
		swf: '/js/uploadify.swf', 
		uploader:'../plugin/upload.php', 
		checkExisting:false,
		//auto : false,
		buttonClass:'JQButton', 
		buttonText: '', 
 		cancelImage: '/images/icon_cancel.gif', 
		fileTypeDesc: '文本文档(txt)，Excel(xls,xlsx); ', 
		fileTypeExts: '*.txt; *.xlsx; *.xls', 
		height: 29, 
		width:84, 
		fileSizeLimit:2000,
		multi: false, 
  		removeCompleted : false,
		onUploadStart: function(){
			$("#file_path").val("");
			if($("#list_id_override").val()==""){
				alert("请选择要导入的目标客户清单！");
 				$("#list_id_override").focus();
				$("#leadfile").uploadifyStop($("#leadfile_queue .uploadifyQueueItem").attr("id"));
				return false;
			}else{
				$("#list_name").val($("#list_id_override option:selected").text());
				request_tip("文件正在上传，请稍候...",1,30000);
			}
 		},
		onQueueComplete: function(){},
		onSelect: function(file){
 			$("#file_name").val(file.name);
			//$("#file_type").val(file.name.substr(file.name.lastIndexOf(".")+1,file.name.length));
			if($("#leadfile_queue .uploadifyQueueItem").length>1){
  				$("#leadfile").uploadifyCancel($("#leadfile_queue .uploadifyQueueItem:first").attr("id"));
 			}
 			 
 		},onUploadSuccess: function(event,response,status){
  			var json =eval("("+response+")");
			request_tip(json.des,json.counts);
			$("#file_path").val(json.file_path);
			lead_import_select();
   		}
	});

	$("#step_2").hide();
	$("#step_3").hide();
	get_select_opt('','send.php','get_cam_lists','list_id_override','group_a','&active=Y');
	
	
	var iFlash = null;
  
	var plugin;
	var isIE = navigator.userAgent.toLowerCase().indexOf("msie") != -1
	if (isIE) {
		if (window.ActiveXObject) {
			var control = null;
			try {
				control = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
			} catch(e) {
				iFlash = false;
			}
			if (control) {
				iFlash = true;
			}
		}
	} else {
		if (navigator.plugins) {
			for (var i = 0; i < navigator.plugins.length; i++) {
				if (navigator.plugins[i].name.toLowerCase().indexOf("shockwave flash") >= 0) {
					iFlash = true;
					version = navigator.plugins[i].description.substring(navigator.plugins[i].description.toLowerCase().lastIndexOf("Flash ") + 6, navigator.plugins[i].description.length);
				}
			}
		}
	}
	 
	if ($.browser.msie && $.browser.version == "6.0") {
		$("#ie6-warning").show();
	}
	if (!player && !plugin) {
		$("#warning_wmp").show();
	}
	if (!iFlash) {
		$("#warning_flash").show();
		if ($.browser.msie) {
			$("#install_flash_link").attr("href", "http://get.adobe.com/cn/flashplayer/download/?installer=Flash_Player_11_for_Internet_Explorer&os=Windows 7&browser_type=MSIE&browser_dist=OEM&d=McAfee_Security_Scan_Plus_IE_Browser&p=gtb,chr&dualoffer=false")
		} else {
			$("#install_flash_link").attr("href", "http://get.adobe.com/cn/flashplayer/download/?installer=Flash_Player_11_for_Other_Browsers&os=Windows%207&browser_type=Gecko&browser_dist=Firefox&d=McAfee_Security_Scan_Plus_FireFox_Browser&dualoffer=false")
		}
	}
	var top = 0;
	$("div.ie6-warning:visible").map(function() {
		index = $(this).index();
		if (index != 0) {
			top += 29;
			$("div.ie6-warning:visible:eq(" + index + ")").css({
				"top": top + "px"
			});
		}
	});
	
	
});

function check_is_upload(){
	
	if($("#file_name").val()==""||$("#leadfile_queue .uploadifyQueueItem").length<1){
		alert("请先选择上传号码文件！\n\n支持类型：xls、xlsx、txt");
		return false;
	} 	
}

function lead_import_select(){
 	
	$('#load').show();
	var url="action=lead_import_select&"+$('#form1').serialize()+times;
 	//alert(url);
	$.ajax({
		type: "post",
		dataType: "html",
		url: "send.php",
		data: url,
 		cache: false,
		beforeSend:function(){
			$('#load').css("top",$(document).scrollTop()).show('100');
			request_tip("文件正在解析，请稍候...",1,30000);
		},
		complete :function(){$('#load').hide('100');request_tip("文件解析完成，请选择文件导入字段！",1);},
 		success: function(re_html){
			$("#step_1").fadeOut("fast");
			$("#step_2").fadeIn("fast");
			
			$("#view_lead_import_select").html(re_html);
			$("#view_lead_import_select .dataTable tbody tr").hover(function(){$(this).addClass("over")},function(){$(this).removeClass("over")});
  		}
	});
 
}

function lead_import_insert(){
	
	if($("#phone_number_field").val()=="-1"||$("#phone_number_field").val()==""){
		alert("请选择电话号码对应文件字段！");
		$("#phone_number_field").focus();
		return false;
	}
	
	if($("#dupcheck").val()=="DUPTITLEALTPHONELIST"||$("#dupcheck").val()=="DUPTITLEALTPHONESYS"){
		
		if($("#title_field").val()=="-1"||$("#title_field").val()==""){
			alert("请选择标题对应文件字段！");
			$("#title_field").focus();
			return false;
		}
		
		if($("#alt_phone_field").val()=="-1"||$("#alt_phone_field").val()==""){
			alert("请选择备用电话对应文件字段！");
			$("#alt_phone_field").focus();
			return false;
		}
 		
	}
 	
	$('#load').show();
	var url="action=lead_import_insert&"+$('#form2').serialize()+times;
 	//alert(url);
	//return false;
	$.ajax({
		type: "post",
		dataType: "html",
		url: "send.php",
		data: url,
 		cache: false,
		beforeSend:function(){
			$('#load').css("top",$(document).scrollTop()).show('100');
			request_tip("正在执行导入，本过程较慢，请耐心等候...",1,60000);
		},
		complete :function(){$('#load').hide('100');},
 		success: function(re_html){
			
			$("#step_2").fadeOut("fast");
			$("#step_3").fadeIn("fast");
 			$("#view_lead_import_insert").html(re_html);
 			$("#view_lead_import_insert .dataTable tbody tr").hover(function(){$(this).addClass("over")},function(){$(this).removeClass("over")});
			request_tip("导入完成，结果如下...",1);
  		}
	});
 
}

function reload_file(){
 	
	$("#step_3").fadeOut("fast");
	$("#step_2").fadeOut("fast");
	$("#step_1").fadeIn("fast");
 	
	$("#leadfile").uploadifyCancel($("#leadfile_queue .uploadifyQueueItem:first").attr("id"));
	$("#view_lead_import_select").html("");
	$("#file_path").val("");
	$("#file_name").val("");
	//$("#file_type").val("");
}

</script>

<style>
.uploadifyButton{-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;color: #FFF;font: 12px;text-align: center;width: 84px;background: url(/images/select_file_button.png) no-repeat left top;height: 29px;}
.uploadify:hover .uploadifyButton{background-color: #808080;}
.uploadifyQueueItem{background-color: #F5F5F5;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;font: 11px Verdana, Geneva, sans-serif;margin-top: 5px;max-width: 350px;padding: 6px;border: 2px solid #CCC;}
.uploadifyError{background-color: #FDE5DD !important;border: 2px solid #F79371;}
.uploadifyQueueItem .cancel{float: right;}
.uploadifyQueue .completed{background-color: #E5E5E5;}
.uploadifyProgress{background-color: #E5E5E5;margin-top: 10px;width: 100%;}
.uploadifyProgressBar{background-color: #0099FF;height: 3px;width: 1px;} 

.ie6-warning{display:none;width:100%;position:absolute;top:0;left:0;background:#ffffe1;padding:5px 0;font-size:12px; text-align:center;z-index:400}
.ie6-warning p{width:960px;margin:0 auto;}

</style> 
<div class="ie6-warning" id="warning_flash"><p>尊敬的用户您好，您正在使用的浏览器不支持<strong>Flash</strong>插件，请<a id="install_flash_link" href="" target="_blank"><strong> 安装Flash </strong></a>插件后，关闭浏览器重新打开本系统！</p></div>


    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">客户清单管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
<input type="hidden" name="list_active" id="list_active" value="<?php echo $list_active ?>" />
<input type="hidden" name="list_id" id="list_id" value="<?php echo $list_id ?>" />
<input type="hidden" name="get_list_id_override" id="get_list_id_override" value="0" />

<fieldset id="step_1"><legend>上传号码文件</legend>
<input type="hidden" name="file_name" id="file_name" value="" />
<form action="" method="post" name="form1" id="form1">
 <input type="hidden" name="file_layout" id="file_layout" value="custom" />
 <input type="hidden" name="leadfile_name" id="leadfile_name" value="" />
 <input type="hidden" name="phone_code_override" id="phone_code_override" value="086" />
 <input type="hidden" name="postalgmt" id="postalgmt" value="AREA" />
 <input type="hidden" name="file_type" id="file_type" value="" />
 <input type="hidden" name="list_name" id="list_name" value="" />
 <input type="hidden" name="file_path" id="file_path" value="" />
 
<table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
          <tr>
            <td align=right width="30%">选择号码文件：</td>
            <td align=left >
                <div style="position:relative;margin-bottom:2px; display:block;width:100%">
                    <input type="file" name="leadfile" id="leadfile" value=""> 
                       
                    <div style="position:absolute;top:2px;left:86px"><span class="red">※</span><span class="gray">选择导入的号码文件，支持txt、xls、xlsx</span></div>
               </div>
          </tr>
          <tr>
            <td align=right width="35%">目标客户清单：</td>
            <td align=left style="height:40px">
            <select name="list_id_override" id="list_id_override" class="s_option">
                <option value="">请选择目标客户清单</option>
                <option value="XXXXXNONE" disabled="disabled">------------------------</option>
                
             </select><span class="red">※</span><span class="gray">指定要导入的客户清单</span>
            
            </td>
          </tr>
            <tr>
              <td align=right>重复号码校验规则：</td>
              <td align=left >
                
                <select name="dupcheck" id="dupcheck" class="s_option" style="margin-top:14px;float:left">
                  <option value="NONE">无重复性校验</option>
                  <option value="DUPLIST">在同一客户清单中校验</option>
                  <option value="DUPCAMP" selected="selected">在同一业务活动中校验</option>
                  <option value="DUPSYS">在全系统中校验</option>
                  <option value="DUPTITLEALTPHONELIST">在同一客户清单中(标题、备用号)校验</option>
                  <option value="DUPTITLEALTPHONESYS">在全系统中(标题、备用号)校验</option>
                </select><span class="red fl" style="line-height:16px; float:left"><span class="gray">提示：</span><br />1、请不要一次性导入过多数据，以5000及以下为宜.<br /> 2、请尽量不在外呼时间导入.</span>
              </td>
            </tr>
            <tr>
              <td align=right>&nbsp;</td>
              <td align=left style="height:50px">
              <input type="button" name="do_upload" id="do_upload" onclick="check_is_upload();$('#leadfile').uploadifyUpload()" value="开始上传" />
              <input type="reset" name="do_upreset" id="do_upreset" value="重置" />
              </td>
            </tr>
        </table>
     
</form>

</fieldset>      
      
       
<fieldset id="step_2"><legend >选择数据字段</legend>
        
<form action="" method="post" name="form2" id="form2">
  
    <table width="100%" align="center" cellspacing="0">
         
        <tr>
          <td valign="top" id="view_lead_import_select" class="td_underline">
      
          </td>
        </tr>
    </table>
    	 
 </form>
 
</fieldset>      
      

<fieldset id="step_3"><legend >查看导入结果</legend>
        
     <table width="100%" align="center" cellspacing="0">
         <tr>
            <td valign="top" id="view_lead_import_insert" class="td_underline">
             
            </td>
        </tr>
    </table>
   
</fieldset>      
      
</div>
 
<?php
break;

//添加黑名单 
case "add_dnc_list":
?>
<script>
 

function get_phone_count(){
	$("#phone_counts").html($("#phones").val().split("\n").length);
}

function do_add_dnc_list(){
 
   	if($("#campaign_id").val()==""){
		alert("请选择归属业务活动！");
		get_select_opt('','../campaign/send.php','get_campaigns_list','campaign_id','group_def');
 		return false;
	}
 
   	if($("#phones").val()==""){
		alert("请填写电话号码！");
 		return false;
	}
 	
	var url="action=add_dnc_list&"+$('#form1').serialize();
	//alert(url);
	$("#result_list li").remove();
   	$.ajax({
		 
		url: "send.php",
		data:url,
		
  		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
 		success: function(json){ 
 		    
			request_tip(json.des,json.counts,60000);
  			
			$("#result_list li").remove();
			if(json.phone_bad>0){
				$.each(json.datalist, function(index,con){
					$("#result_list").append("<li>"+con.phone+"</li>");
				});
			}else{
				$("#result_list").append("<li><span class='green'>"+json.des+"</span></li>");
			}
			
			_DialogInstance.ParentWindow.GetPageCount($(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"count");
			_DialogInstance.ParentWindow.get_datalist($(_DialogInstance.ParentWindow.document).find("#pages").val(),$(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"list",$(_DialogInstance.ParentWindow.document).find("#pagesize").val());
			
			$("#result_list_tr").css("display","");
            $("#result_list").css({"overflow":"scroll","overflow-x":"hidden","overflow-y":"scroll","width":"360px","height":"130px"});
						
  		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员！\n"+textStatus);
		}
   	});
	
 }
</script>
<style>
.result_list li{float:left; width:60%}
</style>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">黑名单管理</a> &gt; <?php echo $tits ?> </div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main">
    	<input name="get_campaign" type="hidden" id="get_campaign" value="0" />
      <fieldset><legend><?php echo $tits ?></legend>
         <form action="" method="post" name="form1" id="form1">
              
             <table width="100%" border="0" align="center" cellpadding=2 cellspacing=0>
                
                <tr>
                  <td width="22%" height="24" align="right">业务活动：</td>
                  <td height="24">
                      <select name="campaign_id" class="s_option" id="campaign_id" onclick="get_select_opt('','../campaign/send.php','get_campaigns_list','campaign_id','group_def')" >
                          
                          <option value="">请选择归属业务活动</option> <optgroup label="系统全局黑名单"><option value='system' title="系统全局黑名单：针对所有业务活动">系统全局黑名单</option></optgroup> 
                      </select><span class="red">※</span>
                    </td>
                </tr>
                <tr>
                  <td width="22%" height="" align="right">黑名单号码：</td>
                  <td align="left" valign="middle"><textarea name="phones" id="phones" cols="60" rows="5" style="height:130px" onchange="get_phone_count()"></textarea><span class="red">※</span> <span id="phone_counts" style="color: #CC1B1B;font-family:Arial, Helvetica, sans-serif;font-size: 16px;">0</span> 行</td>
                </tr>
                             
               </table>
            </form>
      </fieldset>
      <fieldset><legend>添加结果</legend>
      	<table width="100%" border="0" align="center" cellpadding=2 cellspacing=0>                    
                     
            <tr id="result_list_tr" style="display:">
              <td width="22%" height="" align="right">添加结果：</td>
              <td align="left" valign="middle">
                
                  <ul id="result_list" class="result_list">
                    
                  </ul>
              </td>
            </tr>                    
        </table>
      </fieldset>
</div>

<?php 

break;
  
case "add_filter":
?>

<script>
function do_add_filter(){
	 
	if($("#lead_filter_id").val() == ""){
		alert("请填写规则ID号！");
		$("#lead_filter_id").focus();
		return false;
	}else if($("#lead_filter_id").val().length>10||$("#lead_filter_id").val().length<2){
		alert("规则ID位数必须介于2-10位字符之间！");
		$("#lead_filter_id").select();
		return false;
	}
	
	if($("#lead_filter_name").val() == ""){
		alert("请填写规则名称！");
		$("#lead_filter_name").focus();
		return false;
	}else if($("#lead_filter_name").val().length>20||$("#lead_filter_name").val().length<2){
		alert("规则名称位数必须介于2-20位字符之间！");
		$("#lead_filter_name").select();
		return false;
	}
   	get_filter_sql_();
	
	$('#load').show();
	var datas="action=lead_filter_set&do_actions=add&"+$('#form1').serialize()+times;
	//alert(datas);
  	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		    request_tip(json.des,json.counts);
			_DialogInstance.ParentWindow.request_tip(json.des,json.counts);
			if(json.counts=="1"){
 				 
				_DialogInstance.ParentWindow.GetPageCount($(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"count");
				_DialogInstance.ParentWindow.get_datalist($(_DialogInstance.ParentWindow.document).find("#pages").val(),$(_DialogInstance.ParentWindow.document).find("#a_ctions").val(),"list",$(_DialogInstance.ParentWindow.document).find("#pagesize").val());
 				setTimeout('Dialog.close();',10);
			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
} 

function check_filter(){
	if($("#lead_filter_id").val()!=""){
		 
		if($("#lead_filter_id").val().length>10||$("#lead_filter_id").val().length<2){
 			request_tip("筛选规则ID位数必须介于2-10位字符之间！",0);
			$("#lead_filter_id").select();
			return false;
		}
		
		var datas="action=check_lead_filter_id&lead_filter_id="+$("#lead_filter_id").val()+times;
		$.ajax({
			 
			url:"send.php",
			data:datas,
			
			async:false,
			success: function(json){
			    
			   if(json.counts!="1"){
					request_tip(json.des,json.counts);
					$("#lead_filter_id").select();
			   }
			} 
		});
	}
}
   
$(document).ready(function(){
	$('.td_underline tr:visible:odd').addClass('alt');
	show_field_table('show','y');
});
 
</script>
  
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">过滤规则管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
</div>

<div class="page_main" >
            
<fieldset ><legend ><?php echo $tits ?></legend>
<input name="field_index" type="hidden" id="field_index" value="1" /><br />
<form action="" method="post" name="form1" id="form1">
  <input name="lead_filter_field" type="hidden" id="lead_filter_field" />
   <input name="lead_filter_sql" type="hidden" id="lead_filter_sql" />
    <table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
        <tr >
          <td width="30%" align="right">规则ID：</td>
          <td align="left"><input maxlength="10" size="30" class="s_input" name="lead_filter_id" id="lead_filter_id" onkeyup="this.value=value.replace(/[^\w\/_]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/_]/ig,'')" onblur="this.value=value.replace(/[^\w\/_]/ig,'');check_filter()"/><span class="red">※</span><span class="gray">数字、英文、下划线组合,最长10位</span></td>
        </tr>
        <tr >
          <td align="right">规则名称：</td>
          <td align="left"><input maxlength="30" size="30" class="s_input" name="lead_filter_name" id="lead_filter_name"/><span class="red">※</span></td>
        </tr>
        <tr >
          <td align="right">规则描述：</td>
          <td align="left"><input maxlength="255" size="30" class="s_input" name="lead_filter_comments" id="lead_filter_comments"/></td>
        </tr>
        <tr >
          <td align="right">筛选条件：</td>
          <td align="left" id="form_table">
           <a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" title="添加子选项" onclick="show_field_table('show','y');" style="margin-top:4px"><img src="/images/butCollapse.gif" align="absmiddle" style="margin-top:5px"/><b>添加子选项&nbsp;</b></a> 
          </td>
        </tr>
        <tr>
            <td width="16%" align="right" nowrap="nowrap">条件预览：</td>
            <td align="left" valign="middle" style="padding-top:4px; padding-bottom:4px">
             <div id="filter_list"></div>
            </td>
        </tr>
        </table>
    
 </form>
 
</fieldset>
    
      
</div>

<?php 

break;
  
case "edit_filter":

$sql="select lead_filter_id,lead_filter_name,lead_filter_comments from vicidial_lead_filters  where lead_filter_id='".$lead_filter_id."'  ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);
 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
  		$lead_filter_id=$rs["lead_filter_id"];
 		$lead_filter_name=$rs["lead_filter_name"];
 		$lead_filter_comments=$rs["lead_filter_comments"];
    }
 	echo "<script>$(document).ready(
	function(){
    		 
  		$('.td_underline tr:visible:odd').addClass('alt');
   		get_filter_field_list();
   	});
</script>";
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("该规则ID不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
?>
<script>
function get_filter_field_list(){
           	  
	$('#load').show();
	var datas="action=get_filter_field_list&lead_filter_id="+$('#lead_filter_id').val()+times;
   	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
 		   if(json.counts=="1"){
			   show_field_table('show','y');
			   $("#filter_list").html("");
			   
			   $("#datatable tbody tr").remove();
 			   var tr_str="",form_select="",filter_value="",insert_="";
			   $.each(json.datalist,function(index,con){
 					
					if(con.filter_term=="!=''"||con.filter_term=="=''"){
 						filter_value="<input type=\"text\" name=\"filter_value\" id=\"filter_value_"+con.id+"\" fid=\""+con.id+"\" maxlength=\"100\" size=\"36\" disabled/>";
					}else if(con.filter_term=="between"){
						filter_value="<input type=\"text\" name=\"filter_if_begin\" id=\"filter_if_begin_"+con.id+"\" maxlength=\"100\" size=\"13\" fid=\""+con.id+"\" value=\""+con.filter_if_begin+"\"/> 至 <input type=\"text\" name=\"filter_if_end\" id=\"filter_if_end_"+con.id+"\" maxlength=\"100\" size=\"13\"  fid=\""+con.id+"\" value=\""+con.filter_if_end+"\"/>";
					}else{
						filter_value="<input type=\"text\" name=\"filter_value\" id=\"filter_value_"+con.id+"\" fid=\""+con.id+"\" maxlength=\"100\" size=\"36\" value=\""+con.filter_value+"\"/>";
					}
 					
 					tr_str="<tr align=\"left\" id=\"list_"+con.id+"\" nowrap fid=\""+con.id+"\"><td><span id=\"field_id_"+con.id+"\"><select name=\"filter_field\" id=\"filter_field_"+con.id+"\" style=\"width:90px\" fid=\""+con.id+"\"></select></span></td><td><span><select name=\"filter_term\" id=\"filter_term_"+con.id+"\" fid=\""+con.id+"\"><option value=\"=\" selected=\"selected\">等于</option><option value=\"!=\">不等于</option><option value=\">\">大于</option><option value=\"<\">小于</option><option value=\"in\">包含</option><option value=\"not in\">不包含</option><option value=\"=''\">为空</option><option value=\"!=''\">不为空</option><option value=\"between\">区间</option><option value=\"like\">模糊匹配</option><option value=\"%like\">匹配开头</option><option value=\"like%\">匹配结尾</option></select></span></td><td><span id=\"value_"+con.id+"\">"+filter_value+"</span></td><td><span><select name=\"field_if\" id=\"field_if_"+con.id+"\" fid=\""+con.id+"\"><option value='and'>并且(and)</option><option value='or'>或者(or)</option></select></span></td><td class='o_icos'><span class='add' onclick=\"set_field('add','"+con.id+"','0');\"></span><span class='up_e' onclick=\"set_field('up','0','"+con.id+"')\"></span><span class='dw_e' onclick=\"set_field('dw','0','"+con.id+"')\"></span><span onclick=\"set_field('del','0','"+con.id+"');\"></span></td></tr>";				
 					
					$("#datatable tbody").append(tr_str);
					get_field_list("filter_field_"+con.id,con.filter_field);
					 
 					$("#filter_term_"+con.id).val(con.filter_term);
					$("#field_if_"+con.id).val(con.filter_if);
					 
 					$("#form_index").val(con.id);
					
					$("#list_"+con.id+" input[type='text']").addClass("inputText").hover(function(){if($(this).hasClass("input_focus")==false){$(this).addClass("inputTextHover")}},function(){$(this).removeClass("inputTextHover")}).focus(function(){$(this).removeClass("inputText inputTextHover input_focus").addClass("input_focus")}).blur(function(){$(this).addClass("inputText").removeClass("input_focus inputTextHover")});
					
					$("#list_"+con.id+" :input").bind("blur",function(){
						get_filter_($(this).attr("fid"),'update');
					})
					
 					get_filter_(con.id,insert_);
					
			   });
	
		   }else{
			   show_form_table("show");
		   }
			order_datatable_();
			$("#filter_list span").show();
			$("#filter_list span:last").hide();
			$("#datatable tbody tr").find("select[name='field_if']").attr("disabled",false);
			$("#datatable tbody tr:last").find("select[name='field_if']").attr("disabled","disabled");

		  
 		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
}


function do_edit_filter(){
	 
 
	if($("#lead_filter_name").val() == "")
	{
		alert("请填写规则名称！");
		$("#lead_filter_name").focus();
		return false;
	}else if($("#lead_filter_name").val().length>20||$("#lead_filter_name").val().length<2){
		alert("规则名称位数必须介于2-20位字符之间！");
		$("#lead_filter_name").select();
		return false;
	}
   	get_filter_sql_();
	
	$('#load').show();
	var datas="action=lead_filter_set&do_actions=update&"+$('#form1').serialize()+times;
	//alert(datas);
  	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		    request_tip(json.des,json.counts);
			_DialogInstance.ParentWindow.request_tip(json.des,json.counts);
			if(json.counts=="1"){
				
 				$(_DialogInstance.ParentWindow.document).find("#filter_list_<?php echo $lead_filter_id ?> td").eq(2).html("<div class='hide_tit green'>"+$("#lead_filter_name").val()+"</div>");
 				$(_DialogInstance.ParentWindow.document).find("#filter_list_<?php echo $lead_filter_id ?> td").eq(3).html("<div class='hide_tit green'>"+$("#lead_filter_comments").val()+"</div>");
 				$(_DialogInstance.ParentWindow.document).find("#filter_list_<?php echo $lead_filter_id ?> td").eq(4).html("<span class='green'>"+$("#datatable tbody tr").length+"</span>");
 				setTimeout('Dialog.close();',10);
			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
} 
 
function test_filter(){
	var diag =new Dialog("test_filter_");
    diag.Width = 540;
    diag.Height = 280;
  	diag.Title = "过滤规则测试";
	diag.URL = '/document/lists/list.php?action=test_filter&lead_filter_id='+$("#lead_filter_id").val()+'&lead_filter_name='+encodeURIComponent($("#lead_filter_name").val())+'&tits='+encodeURIComponent("过滤规则测试");
 	diag.OKEvent = set_test_filter;
    diag.show();
	diag.OKButton.value = "测 试";
}
 
function set_test_filter(){
	Zd_DW.do_test_filter();
}  
</script>
  
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">过滤规则管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
</div>

<div class="page_main" >
<table border="0" cellpadding="0" cellspacing="0" class="menu_list">
     <tr>
        <td colspan="2"><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="test_filter();" title="在活动中测试该规则"><img src="/images/icons/icons_38.png" style="margin-top:6px" /><b>过滤规则测试&nbsp;</b></a></td>
    </tr>
</table>            
<fieldset ><legend ><?php echo $tits ?></legend>
<input name="field_index" type="hidden" id="field_index" value="1" />
<form action="" method="post" name="form1" id="form1">
   <input name="lead_filter_field" type="hidden" id="lead_filter_field" />
   <input name="lead_filter_sql" type="hidden" id="lead_filter_sql" />
   <input type="hidden" name="lead_filter_id" id="lead_filter_id" value="<?php echo $lead_filter_id ?>" />
    <table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
            <tr >
              <td width="30%" align="right">规则ID：</td>
              <td align="left"><span class="blue"><strong><?php echo $lead_filter_id ?></strong></span></td>
            </tr>
            <tr >
              <td align="right">规则名称：</td>
              <td align="left"><input name="lead_filter_name" id="lead_filter_name" value="<?php echo $lead_filter_name ?>" size="30" class="s_input" maxlength="30"/><span class="red">※</span></td>
            </tr>
            <tr >
              <td align="right">规则描述：</td>
              <td align="left"><input name="lead_filter_comments" id="lead_filter_comments" value="<?php echo $lead_filter_comments ?>" size="30" class="s_input" maxlength="255"/></td>
            </tr>
            <tr >
              <td align="right">筛选条件：</td>
              <td align="left" id="form_table">
               <a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" title="添加子选项" onclick="show_field_table('show','y');" style="margin-top:4px"><img src="/images/butCollapse.gif" align="absmiddle" style="margin-top:5px"/><b>添加子选项&nbsp;</b></a> 
              </td>
            </tr>
            <tr>
                <td width="16%" align="right" nowrap="nowrap">条件预览：</td>
                <td align="left" valign="middle" style="padding-top:4px; padding-bottom:4px">
                 <div id="filter_list"></div>
                </td>
            </tr>
            </table>
    
 </form>
 
</fieldset>
    
      
</div>

<?php 

break;

//添加黑名单 
case "test_filter":
?>
<script>

/*function get_select_opt('','../campaign/send.php','get_campaigns_list','campaign_id','group_def'){
	if($("#get_campaign").val()=="0"){
		var datas="action=get_campaign_all_list&active=Y"+times;
		 
		$.ajax({
			 
			url: "../campaign/send.php",
			data:datas,
			
			success: function(json){
				
			  if(json.counts=="1"){
					$("#get_campaign").val("1");
					$("#campaign_id option").remove();
					$("<option value=''>请选择测试业务活动</option>").appendTo($("#campaign_id"));
					
					$.each(json.datalist,function(index,con){
						 
						$("<option value='"+con.campaign_id+"' title='"+con.campaign_name+"--"+con.campaign_id+" "+con.campaign_description+"'  name='"+con.campaign_name+"' des='"+con.campaign_description+"'>"+con.campaign_name+" ["+con.campaign_id+"]</option>").appendTo($("#campaign_id"));
						
					})
			  }
			  
			}
		});
	}
} */


function do_test_filter(){
 
   	if($("#campaign_id").val()==""){
		alert("请选择测试业务活动！");
		get_select_opt('','../campaign/send.php','get_campaigns_list','campaign_id','group_def');
 		return false;
	}
   	
	var url="action=test_filter&"+$('#form1').serialize();
 	//return false;
   	$.ajax({
		type: "post", 
		dataType: "html", 
		url: "send.php",
		data:url,
		
  		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
 		success: function(re_html){ 
 		    
			request_tip("测试完成，结果如下...",1,60000);
			 
			$("#result_list_tr").css("display","");
            $("#result_list").html(re_html).css({"width":"320px","height":"130px"});
						
  		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员！\n"+textStatus);
		}
   	});
	
 }
</script>
<style>
.result_list{width:100%}
.result_list li{float:left; width:60%}
</style>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">过滤规则管理</a> &gt; <?php echo $tits ?> </div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main">
    	<input name="get_campaign" type="hidden" id="get_campaign" value="0" />
      <fieldset><legend> <label for="quality_status_all"><?php echo $tits ?> </label></legend>
     		 <form action="" method="post" name="form1" id="form1">
 				  <input name="lead_filter_id" type="hidden" id="lead_filter_id" value="<?php echo $lead_filter_id ?>" />
                  <table width="100%" border="0" align="center" cellpadding=2 cellspacing=0>
                    <tr >
                      <td width="" align="right">过滤规则：</td>
                      <td align="left"><span class="blue"><strong><?php echo $lead_filter_name ?>[<?php echo $lead_filter_id ?>]</strong></span></td>
                    </tr>
                    <tr>
                      <td width="22%" height="24" align="right">业务活动：</td>
                      <td height="24">
                          <select name="campaign_id" id="campaign_id" onclick="get_select_opt('','../campaign/send.php','get_campaigns_list','campaign_id','group_def')" class="s_option" >
                              <option value=''>请选择测试业务活动</option>
                          </select><span class="red">※</span>
                  		</td>
                    </tr>
                     
                    <tr id="result_list_tr" style="display:none">
                      <td  width="22%" align="right">测试结果：</td>
                      <td align="left" valign="middle">
                      	
                          <div id="result_list" class="result_list">
                          	
                          </div>
                      </td>
                    </tr>                    
                   </table>
                </form>
      </fieldset>
</div>
<?php 

break;
 
case "custom_field":
?>
<script src="/js/jquery.uploadify.min.js"></script>
<script>


function add_custom_field(){
	 
	if($("#list_id_fields").val() == ""){
		alert("请选择客户清单！");
		$("#list_id").focus();
		return false;
	}
	//
	var list_id = $("#list_id_fields").val();
	
	var list_name = $("#list_id_fields").find("option:selected").text(); 

	var diag =new Dialog("add_custom_field");
    diag.Width = 620;
    diag.Height = 320;
 	diag.Title = "新建自定义字段";
	diag.URL = '/document/lists/list.php?action=add_modify_custom_fields&do_actions=add&list_id='+list_id+'&list_name='+list_name+'&tits='+encodeURIComponent("新建自定义字段");
 	diag.OKEvent = set_add_custom_field;
	//diag.CancelEvent = parent_focus; 
   diag.show();	
	 
} 
function set_add_custom_field(){
	//Zd_DW.do_add_list();
}  


function modify_custom_field(s_value){
	 
	if($("#list_id_fields").val() == ""){
		alert("请选择客户清单！");
		$("#list_id_fields").focus();
		return false;
	}
	//
	var list_id = $("#list_id_fields").val();
	
	var list_name = $("#list_id_fields").find("option:selected").text(); 

	var diag =new Dialog("add_custom_field");
    diag.Width = 620;
    diag.Height = 320;
 	diag.Title = "修改自定义字段";
	diag.URL = '/document/lists/list.php?action=add_modify_custom_fields&do_actions=modify&list_id='+list_id+'&list_name='+list_name+'&field_id='+s_value+'&tits='+encodeURIComponent("修改自定义字段");
 //	diag.OKEvent = set_add_custom_field;
	//diag.CancelEvent = parent_focus; 
   diag.show();	
	 
} 

function remove_custom_field(f_id,f_name,l_id){
	 
	if(f_id == ""){
		alert("字段ID参数错误！");
		return false;
	}
	if(f_name == ""){
		alert("字段name参数错误！");
		return false;
	}	

 	if (!confirm("确认要删除此字段？")) {
          return;
   }
 	
	$('#load').show();
	
	var datas="action=add_modify_remove_custom_fields&do_actions=remove&field_id="+f_id+"&field_name="+f_name+"&list_id="+l_id+"&"+times;

 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		  request_tip(json.des,json.counts);
			if(json.counts=="1"){
				select_list_opt();
 			
			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
}
  
//添加已经生成的自定义数据
function select_list_opt(){
	
		var datas="action=get_list_fields&list_id="+$("#list_id_fields").val()+times;	
		$("#table_field  tr:not(:first)").empty()
		$.ajax({
			 
			url:"send.php",
			data:datas,
			
			async:false,
			success: function(json){
					
			   if(json.counts == "1"){

				   $.each(json.datalist, function(index,con){
				   	
				   	switch(con.field_type)
						{
							case "TEXT"://TEXT					  
							  var newRow = '<tr><td align="right">'+con.field_label+'</td><td align="left"><input maxlength="30" size="30" class="s_input" name="'+con.field_name+'" id="'+con.field_name+'"/> ';				
							  
							  
							  break;
							case "SELECT"://SELECT
							  var newRow = '<tr><td align="right">'+con.field_label+'</td><td align="left"><select class="s_option" name="'+con.field_name+'" id="'+con.field_name+'">';
							  
							  $.each(con.field_options,function(index2,ccon){
							  	newRow += '<option value="'+ccon+'">'+ccon+'</option>';
								}); 		
							  newRow += '</select> ';
							  
						  
							 
							  break;
							default:
						 
						}	 		
							
							newRow += '<span>#'+con.field_description+'</span></td>';
						  newRow += '<td><a  value ='+con.field_id+' a href="javascript:void(0);" onclick="modify_custom_field('+con.field_id+')">修改</a></td>';
						  newRow += '<td><a>&nbsp;</a></td>';
						  newRow += '<td><a  value ='+con.field_id+' a href="javascript:void(0);" onclick="remove_custom_field('+con.field_id+',\''+con.field_name+'\','+con.list_id+')">删除</a></td></tr>';
						 $("#table_field tr:last").after(newRow);

						 $("#"+con.field_name).val(con.field_default);
					

				   });				
				
					
			   }

			} 
			
		});
}


$(document).ready(function(){
	
	$('.td_underline tr:visible:odd').addClass('alt');
		
		get_select_opt('','send.php','get_cam_lists','list_id_fields','group_a','&active=Y');
	
	//get_campaign_leads_list
		$("#list_id_fields").change(select_list_opt);
		
});
 
</script>
  
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">自定义字段管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
</div>

<div class="page_main" >
	
<input type="hidden" name="list_active" id="list_active" value="<?php echo $list_active ?>" />
<input type="hidden" name="list_id" id="list_id" value="<?php echo $list_id ?>" />
<input type="hidden" name="get_list_id_fields" id="get_list_id_fields" value="0" />
            
<fieldset ><legend ><?php echo $tits ?></legend>
<form action="" method="post" name="form1" id="form1">
   
    <table width="100%" cellpadding="0" cellspacing="0" class="td_underline" id="table_field">
    	
		<tr>
      <td align=right width="35%">对应客户清单：</td>
      <td align=left style="height:40px">
      <select name="list_id_fieldname" id="list_id_fields" class="s_option">
          <option value="">请选择目标客户清单</option>
          <option value="XXXXXNONE" disabled="disabled">------------------------</option>
          
       </select><span class="red">※</span><span class="gray">指定对应的客户清单</span>
      
      </td>
      <td></td>
      <td></td>
    </tr>    	   
    </table>
    

    
 </form>
 <table width="100%" cellpadding="0" cellspacing="0" class="td_underline" >
 	<tr>
 	<td align=right width="35%">&nbsp;</td>
 	<td align=left style="height:20px">
	   <input type="button" name="add_field" id="add_field" onclick="add_custom_field()" value="添加字段" />
 	</td>
 	
	 </tr>
</table>
</fieldset>
    
      
</div>

<?php 

break;
 
case "add_modify_custom_fields":
?>

<script src="/js/jquery.uploadify.min.js"></script>
<script>


function do_add_modify_custom_field(){
	 
	if($("#list_name").val() == ""){
		alert("无法获取客户清单ID号！");
		return false;
	}/*else if($("#list_name").val().length>8||$("#list_name").val().length<2){
		alert("客户清单ID位数必须介于2-8位字符之间！");
		return false;
	}else if($("#list_name").val().substring(0,1)=="0"){
		alert("客户清单ID首位数字不能为 0 ！");
		return false;
	}*/
	
	if($("#field_name").val() == ""){
		alert("请填写客户清单名称！");
		$("#field_name").focus();
		return false;
	}else if($("#field_name").val().length>20||$("#field_name").val().length<2){
		alert("字段名称必须介于2-20位字符之间！");
		$("#field_name").focus();
		return false;
	}
	
		if($("#field_label").val() == ""){
		alert("请填写客户清单名称！");
		$("#field_label").focus();
		return false;
	}else if($("#field_label").val().length>20||$("#field_label").val().length<2){
		alert("字段名称必须介于2-20位字符之间！");
		$("#field_label").focus();
		return false;
	}
	
  	
	if($("#field_type").val() == ""){
		alert("请选择字段类型！");
		$("#field_type").focus();
		return false;
	/*	
		if($("#field_option").val() == ""){
		alert("请填写客户清单名称！");
		$("#field_option").focus();
		return false;
	}else if($("#field_option").val().length>20||$("#field_option").val().length<2){
		alert("字段名称必须介于2-20位字符之间！");
		$("#field_option").focus();
		return false;*/
	}
	
	
	
	if($("#field_default").val().length>20){
		alert("字段名称必须介于2-20位字符之间！");
		$("#field_default").focus();
		return false;
	}
			
	if($("#field_description").val().length>20){
		alert("字段名称必须介于2-20位字符之间！");
		$("#field_description").focus();
		return false;
	}
		
		

	
		

  	
	$('#load').show();
/*
	var datas2="action=add_custom_fields&do_actions=add&list_id=<?php echo $list_id ?>&field_name="+$("#field_name").val()+"&field_label="+$("#field_label").val()+"&field_type="+$("#field_type").val()+"&field_option="+$("#field_option").val()+"&field_descp="+$("#field_descp").val()+"field_default="+$("#field_default").val()+"&"+times;
	alert(datas2);
	*/
	

	var datas="action=add_modify_remove_custom_fields&do_actions=<?php echo $do_actions ?>&list_id=<?php echo $list_id ?>&field_id=<?php echo $field_id ?>&"+$('#form1').serialize()+times;

 	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		  request_tip(json.des,json.counts);
			_DialogInstance.ParentWindow.request_tip(json.des,json.counts);
			if(json.counts=="1"){
				_DialogInstance.ParentWindow.select_list_opt();
 				setTimeout('Dialog.close();',10);
			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
} 

//添加已经生成的自定义数据
function fill_context(field_id){
		
		var datas="action=get_fileld_info&field_id="+field_id+times;	

		$.ajax({
			 
			url:"send.php",
			data:datas,
			
			async:false,
			success: function(json){
					
			   if(json.counts == "1"){
			   	
			   	$("#field_name").val(json.datalist.field_name.substring(7));
			   	
			   	
			   	$("#field_label").val(json.datalist.field_label);
			   	$("#field_type").val(json.datalist.field_type);
			   	if(json.datalist.field_type == "SELECT"){
						$("#select_option").show();
						$("#field_option").val(json.datalist.field_options);
					}else
					{
						$("#select_option").hide();
					}
						   		

			   	
			   	
			   	$("#field_default").val(json.datalist.field_default);
			   	$("#field_description").val(json.datalist.field_descp);

			
			   }

			} 
			
		});
}


$(document).ready(function(){
	
	
	$('.td_underline tr:visible:odd').addClass('alt');		
	
	$("#list_name").html('<?php echo $list_name ?>');
	$("#list_name").val('<?php echo $list_id ?>');
	
	$("#field_type").change(function (){
		if($("#field_type").val() == "SELECT"){
			$("#select_option").show();
		}else
		{
			$("#select_option").hide();
		}
	});	
	
	var do_actions = "<?php echo $do_actions ?>";
	var field_id = "<?php echo $field_id ?>";
	if(do_actions == "modify"){
		fill_context(field_id);
		$("#field_name").attr("disabled", true); 
		
	}
	
	
		
});

 
</script>
  
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">自定义字段管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
</div>

<div class="page_main" >
	
<input type="hidden" name="list_active" id="list_active" value="<?php echo $list_active ?>" />
<input type="hidden" name="list_id" id="list_id" value="<?php echo $list_id ?>" />
<input type="hidden" name="get_list_id_fields" id="get_list_id_fields" value="0" />
            
<fieldset ><legend ><?php echo $tits ?></legend>
<form action="" method="post" name="form1" id="form1">
   
    <table width="100%" cellpadding="0" cellspacing="0" class="td_underline" id="table_field">
    	
		<tr>
      <td align=right width="35%">对应客户清单：</td>
      <td align=left style="height:40px">
      <span id="list_name"></span>
      
      </td>
    </tr>    	   
    
		<tr>
      <td align="right"  >字段名称：</td>
      <td align="left"><input maxlength="30" size="30" class="s_input" name="field_name" id="field_name"/><span class="red">※</span><span class="red">请尽量使用英文</span></td>
    </tr>
    
    <tr>
      <td align="right" >字段标签：</td>
      <td align="left"><input maxlength="30" size="30" class="s_input" name="field_label" id="field_label"/><span class="red">输入框前的提示如("标签：")</span></td>
    </tr>   


    <tr>
      <td align="right" >字段类型：</td>
      <td align="left">
      		<select class="s_option" name="field_type" id="field_type">      	
      	 		<option value="TEXT">文本框</option>
          	<option value="SELECT">选择菜单</option>
          </select><span class="red">※</span>
      </td>
    </tr>
    
    <tr id="select_option" hidden>
      <td align="right" >菜单选项：</td>
      <td align="left">
      <!--	<input maxlength="5000" size="30" class="s_input" name="field_option" id="field_option"/>   -->
      	<textarea maxlength="5000" size="30" rows=3 class="s_input" name="field_option" id="field_option"/></textarea>
      	<span class="red">※</span><span class="red">以逗号(,)分割</span></td>
    </tr>
 
     <tr>
      <td align="right" >默认值：</td>
      <td align="left"><input maxlength="30" size="30" class="s_input" name="field_default" id="field_default"/></td>
    </tr> 
       
    <tr>
      <td align="right" >字段描述：</td>
      <td align="left"><input maxlength="30" size="30" class="s_input" name="field_description" id="field_description"/></td>
    </tr>    
    </table>
    

    
 </form>
 <table width="100%" cellpadding="0" cellspacing="0" class="td_underline" >
 	<tr>

 	<td align=center style="height:20px">
	   <input type="button" name="add_field" id="add_field" onclick="do_add_modify_custom_field()" value="提交" />
 	</td>
 	
	 </tr>
</table>
</fieldset>
    
      
</div>


<?php 

break;
 
default:
 
}
mysqli_close($db_conn);

?>


</body>
</html>