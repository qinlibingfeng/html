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
.dataTable img{cursor:pointer;}
.field_list a{cursor:pointer;display:inline-block;float:left;height:16px;line-height:17px;margin:2px;padding:2px 2px 2px 20px;position:relative;text-align:center;color:#333;white-space:nowrap;background:url(/images/icons/icon022a1.gif) no-repeat left center;}
.field_list a:hover{text-decoration:none;border:1px solid #F90;}
a.close{width:4px;height:4px;line-height:4px;background:url(/images/tips/tip_bg.gif) no-repeat 0 -26px;position:absolute;right:-10px;top:4px;font-size:1px;border:0;}
a.close:hover{background-position:0 -34px;border:0;}
a.field_list_1{background-color:#FFF;border:1px solid #999;}
a.field_list_2{background-color:#FC6;border:1px solid #F90;}
.field_list_div{background:#FFF;border:2px solid #0C0;display:none;margin:3px auto auto 3px;padding:2px 4px 4px;position:absolute;top:0;width:97%;z-index:100;}
.input_86{width:90%;}
.turn_img{cursor:pointer;float:left;margin-left:6px;margin-top:4px;background: url(/images/icons/up_down.gif) no-repeat -94px top;height: 14px;width: 16px;}
.turn_img img{vertical-align:middle;}
.page_main{_margin-top:-1px;}
.page_main fieldset{margin:2px 8px 8px 8px;}
.td_underline td{border-bottom: 1px dotted #ccc; height:24px;line-height:24px}
.td_underline select{*margin-top:1px}
.o_icos span{background:url(/images/icons/up_down.gif) no-repeat 2px top;display:block;height:14px;width:13px;float:left;margin:-2px 1px 0 1px;cursor:pointer;}
.o_icos .add{background-position:-78px top;}
.o_icos .drag{background-position:-113px top;width:14px;}
.o_icos .up_e{background-position:-30px top;}
.o_icos .up_d{background-position:-63px top;}
.o_icos .dw_e{background-position:-14px top;}
.o_icos .dw_d{background-position:-47px top;}

.s_input{width:196px}
.s_option{width:202px}

.opt_f_list{width:500px;border:2px solid #709CBE;position:absolute;background:#FFF;z-index:12;display:none;box-shadow: 0 2px 7px rgba(0, 0, 0, 0.7);}
#opt_layer_1_list,#opt_layer_2_list{width:99%;position:relative;padding:4px;float:left;min-height:120px;max-height:246px;overflow:auto}
.opt_f_list .head{background:#F1F7FC;width:100%;border-bottom:1px solid #C5C5C5;position:relative;line-height:25px;height:26px;float:left}
.opt_f_list .bottom{background:#F1F7FC;width:100%;border-top:1px solid #C5C5C5;position:relative;line-height:24px;height:26px;text-align:right;float:left}
.opt_f_list a.close{width:20px;height:20px;line-height:20px;background:url(/images/agent_c/ico_side.png) no-repeat -23px 0px;display:inline;position:absolute;right:6px;top:3px;cursor:pointer;font-size:1px}
.opt_f_list a.close:hover{background-position:-23px -23px}
.opt_f_list .chart_c_line{line-height:20px;height:20px;border-bottom:1px dotted #CCC;float:left;width:100%}
 
</style>
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script>
 
function order_datatable_(){
	 
	$("#datatable tbody tr").removeClass("alt").find(".up_d").addClass("up_e").removeClass("up_d");
	$("#datatable tbody tr").find(".dw_d").addClass("dw_e").removeClass("dw_d");
	$("#datatable tbody tr:first").find(".up_e").addClass("up_d").removeClass("up_e").unbind("click");
	$("#datatable tbody tr:last").find(".dw_e").addClass("dw_d").removeClass("dw_e").unbind("click");
	$("#datatable tbody tr:odd").addClass("alt");
	$("#datatable tbody tr").mouseover(function(){$(this).addClass("over")}).mouseout(function(){$(this).removeClass("over")});
 
}

function check_dic_id(){
	var dic_id=$("#dic_id").val();
	
	if(dic_id!=""){
		 
		if(dic_id.length>10||dic_id.length<2){
 			request_tip("字典ID位数必须介于2-10位字符之间！",0);
			$("#dic_id").select();
			return false;
		}
		
		var datas="action=check_dic_id&dic_id="+dic_id+times;
		$.ajax({
			 
			url:"send.php",
			data:datas,
			
			async:false,
			success: function(json){
			    
			   if(json.counts!="1"){
					request_tip(json.des,json.counts);
					$("#dic_id").select();
			   }
			} 
		});
	}
}
   

function set_dic_list_form(do_,c_id,id){
 	var tr_str="",tr_this = $("#dic_list_"+id);

	if(do_=="add"){
		
		var form_index=$("#form_index").val();
 		indexs=parseInt(form_index)+1;
		
		if(c_id=="-1"||$("#dic_list_"+c_id).length<1){c_id=$("#datatable tbody tr:last").find("input[name='dic_list_name']").attr("fid");}
       		
   		tr_str="<tr align=\"left\" id=\"dic_list_"+indexs+"\" nowrap><td>1</td><td><input type=\"text\" name=\"dic_list_name\" id=\"dic_list_name_"+indexs+"\" maxlength=\"28\" size=\"32\" class=\"form_val_\" fid=\""+indexs+"\"/></td><td><input type=\"text\" name=\"dic_list_val\" id=\"dic_list_val_"+indexs+"\" maxlength=\"28\" size=\"32\" class=\"form_val_\" /></td><td><input type=\"checkbox\" name=\"dic_list_def\" id=\"dic_list_def_"+indexs+"\" value=\"Y\"/></td><td class='o_icos'><span class='add' onclick=\"set_dic_list_form('add','"+indexs+"','0');\"></span><span class='up_e' onclick=\"set_dic_list_form('up','0','"+indexs+"')\"></span><span class='dw_e' onclick=\"set_dic_list_form('dw','0','"+indexs+"')\"></span><span onclick=\"set_dic_list_form('del','0','"+indexs+"');\"></span></td></tr>";
		
   		if((c_id=="-1"||c_id==undefined)&&id=="0"){
			
  			$("#datatable tbody").append(tr_str);
		}else{
 			$("#dic_list_"+c_id).after(tr_str);
		}
		
    	$("#datatable tbody tr").map(function(){
 			$(this).find("td:eq(0)").html($(this).index()+1);
		});
			
  		$("#form_index").val(indexs);
  	 
 		$("#dic_list_"+indexs+" input[type='text']").addClass("inputText").hover(function(){if($(this).hasClass("input_focus")==false){$(this).addClass("inputTextHover")}},function(){$(this).removeClass("inputTextHover")}).focus(function(){$(this).removeClass("inputText inputTextHover input_focus").addClass("input_focus")}).blur(function(){$(this).addClass("inputText").removeClass("input_focus inputTextHover")});
 		
		$("#dic_index_c").html($("#datatable tbody tr").length);
		$("#datatable").tableDnD({
			onDrop: function(table, row) {
				order_datatable_();
			} 
		});
		
		$("#dic_list_"+indexs+"").addClass('over');
		setTimeout("$('#dic_list_"+indexs+"').removeClass('over');",1200);
		 
		goto_anchor("dic_list_"+indexs);
		
  	}else if(do_=="bat_add"){
		 
		var bat_val_list=$("#bat_val_list").val(),bat_val_ary=bat_val_list.split("\n"),bat_val_ary_l=bat_val_ary.length;
 		var form_index=parseInt($("#form_index").val())+1,indexs,repeat_c=0,acc_c=0;
 		
		if(bat_val_list&&bat_val_ary_l>-1){
    		
			var bat_val_n_ary="";
			
			$("#form1 input[name='dic_list_name']").map(function(){
				bat_val_n_ary+="##"+$(this).val()+"##";
			});
 			
			for(i=0;i<bat_val_ary.length;i++){
				
				var dic_list_ary=bat_val_ary[i].split("|"),is_checked="",dic_list_n=dic_list_ary[0],dic_list_v=dic_list_ary[1],dic_list_def=dic_list_ary[2];
				
 				bat_val_n_ary+="##"+dic_list_n+"##";
 				 
				var n_repeat=bat_val_n_ary.split("##"+dic_list_n+"##").length-1;
				
				if(dic_list_n&&n_repeat<2){
  					
					indexs=parseInt(form_index)+i;
					
 					if(dic_list_def&&(dic_list_def=="是"||dic_list_def=="Y"||dic_list_def=="y")){
						is_checked=" checked ";
					}
					
					if(!dic_list_v){
						dic_list_v=dic_list_n;					
					}
					
					tr_str="<tr align=\"left\" id=\"dic_list_"+indexs+"\" class=\"v_b_l\"; nowrap><td>1</td><td><input type=\"text\" name=\"dic_list_name\" id=\"dic_list_name_"+indexs+"\" maxlength=\"28\" size=\"32\" class=\"form_val_\" fid=\""+indexs+"\" value=\""+dic_list_n+"\"/></td><td><input type=\"text\" name=\"dic_list_val\" id=\"dic_list_val_"+indexs+"\" maxlength=\"28\" size=\"32\" class=\"form_val_\" value=\""+dic_list_v+"\"/></td><td><input type=\"checkbox\" name=\"dic_list_def\" id=\"dic_list_def_"+indexs+"\" value=\"Y\" "+is_checked+"/></td><td class='o_icos'><span class='add' onclick=\"set_dic_list_form('add','"+indexs+"','0');\"></span><span class='up_e' onclick=\"set_dic_list_form('up','0','"+indexs+"')\"></span><span class='dw_e' onclick=\"set_dic_list_form('dw','0','"+indexs+"')\"></span><span onclick=\"set_dic_list_form('del','0','"+indexs+"');\"></span></td></tr>";
					$("#datatable tbody").append(tr_str);
					acc_c++;
				}else{
					repeat_c++;	
				}
 			}
    		 
			$("#datatable tr.v_b_l input[type='text']").addClass("inputText").hover(function(){if($(this).hasClass("input_focus")==false){$(this).addClass("inputTextHover")}},function(){$(this).removeClass("inputTextHover")}).focus(function(){$(this).removeClass("inputText inputTextHover input_focus").addClass("input_focus")}).blur(function(){$(this).addClass("inputText").removeClass("input_focus inputTextHover")});
			
			if(!indexs){indexs=form_index}
			
 			$("#form_index").val(indexs);
 			$("#dic_index_c").html($("#datatable tbody tr").length);
			
			$("#opt_layer_1").hide();
			$("#bat_val_list").val("");
			
			$("#datatable tbody tr").map(function(){
				if($(this).find("input[type='text']").val()==""){
					$(this).remove();
				}
				$(this).find("td:eq(0)").html($(this).index()+1);
			});
			
			$("#datatable").tableDnD({
				onDrop: function(table, row) {
					order_datatable_();
				} 
			});
			request_tip("数值选项添加完成!全部："+bat_val_ary_l+" 项,无效："+repeat_c+" 项，成功："+acc_c+" 项!",1);
		}else{
 			request_tip("您还未填写选项数值，请填写选项值后重试!",0);
			$("#bat_val_list").focus();
		}
  		
  	}else if(do_=="up"){
		var tr_up = tr_this.prev();
 		$(tr_up).before(tr_this);
		$("#dic_list_"+id+"").addClass('over');
 		setTimeout("$('#dic_list_"+id+"').removeClass('over');",1200);
 	}else if(do_=="dw"){
		var tr_down = tr_this.next();
 		$(tr_down).after(tr_this);
		$("#dic_list_"+id+"").addClass('over');
		setTimeout("$('#dic_list_"+id+"').removeClass('over');",1200);
  	}else{
  		$("#dic_list_"+id).remove();
 		if($("#datatable tbody tr").length==0){
 			set_dic_list_form('add','-1','0')
 		}
		$("#dic_index_c").html($("#datatable tbody tr").length);
		
		$("#datatable tbody tr").map(function(){
 			$(this).find("td:eq(0)").html($(this).index()+1);
		});
 	}
	order_datatable_();
}   

 
function bat_add_list(){
	var show=$("#opt_layer_1").is(":visible");
	if(show==true){
		$("#opt_layer_1").center();
		
 	}else{
		$("#opt_layer_1").show().center();
		$("#bat_add_c").html("0");
	}
	 
}

jQuery.fn.center=function(){
	var t = $(this);
	var thistop = $(document).height(); 
 	var maskWidth = $(window).width(); 
	var dialogTop =  (thistop/2) - (t.outerHeight()/2);
	var dialogLeft = (maskWidth/2) - (t.width()/2);
	
	t.css({top:dialogTop,left:dialogLeft})  	
	
};

//----------===================
 
function check_campaign(){
	cam_val=$("#campaign_id").val();
	
	if(cam_val!=""){
		
		if(cam_val.length>9||cam_val.length<2){
			 
			request_tip("业务活动ID位数必须介于2-8位字符之间！",0);
			$("#campaign_id").select();
			return false;
		}
		
		var datas="action=check_campaign&campaign_id="+cam_val+times;
		$.ajax({
			 
			url:"send.php",
			data:datas,			
			async:false,
			success: function(json){
			   if(json.counts!="1"){
					request_tip(json.des,json.counts);
					$("#campaign_id").select();
					return false;
			   }
			} 
		});
	}
}

function check_campaign_cid(){
	cam_cid_val=$("#campaign_cid").val();
	if(cam_cid_val!=""){
		
		if(cam_cid_val.length>16||cam_cid_val.length<4){
			 
			request_tip("透传号码位数必须介于4-16位字符之间！",0);
			$("#campaign_cid").select();
			return false;
		}
		
		var tel_list="110,112,114,118114,117,119,120,121,122,160,10000,10010,10011,10050,10060,10070,10086,11185,12312,12315,12319,12333,12348,12358,12365,123456,12366,12369,12580,95500,95501,95502,95505,95508,95511,95512,95515,95516,95518,95519,95522,95528,95533,95555,95558,95559,95561,95566,95567,95568,95569,95577,95585,95588,95590,95595,95596,95598,95599,96100,96118,96178,96198,96310,1013088,1013089";
		var tel_ary= tel_list.split(",");
  
		for(var i=0;i<tel_ary.length;i++){
 		   var re = new RegExp(tel_ary[i]+"$","g");
 		   if(re.test(cam_cid_val)) {
			   request_tip("请注意！您设置的透传号码中含有特殊号码！<strong>"+tel_ary[i]+"</strong>","0");
 		   }
		}
 	}
}

 
function do_set_dial_status(do_actions,status_id,is_alert){
 	
	if(do_actions=="add"){
		
		if(status_id){$("#dial_status").val(status_id)}
		
		var status=$("#dial_status").val();
		var status_name=$("#dial_status option:selected").text();
		 
		status_name=status_name.split("[")[1].replace("]","");
  		
		if($("#status_list_"+status).length>0){
			if(is_alert==""||is_alert==null){
				request_tip("该呼叫状态已存在！","0");
				$("#dial_status").focus();
			}
			return false;
		}
		
		tr="<tr id='status_list_"+status+"'><td><span class='green'>"+status+"</span></td><td><span style='color:#08d;'>"+status_name+"</span></td><td class='o_icos'><span onclick=\"do_set_dial_status('del','"+status+"');\" title='删除该拨打状态'></span></td></tr>";
		$("#dial_status_list tbody").append(tr);
		//goto_anchor("status_list_"+status);
		
	}else{
		$("#status_list_"+status_id).remove();
		
		if($("#dial_status_list tbody tr").length==0){
			tr="<tr id='status_list_NEW'><td><span class='green'>NEW</span></td><td><span style='color:#08d;'>未呼叫</span></td><td class='o_icos'><span onclick=\"do_set_dial_status('del','NEW');\" title='删除该拨打状态'></span></td></tr>";
			$("#dial_status_list tbody ").append(tr);
		} 
	}
	
	$("#dial_status_list tbody tr").removeClass().hover(function(){$(this).addClass("over")},function(){$(this).removeClass("over")});
	$("#dial_status_list tbody tr:odd").addClass("alt");
}

function edit_list(list_id){
	var diag =new Dialog("edit_list_"+list_id);
    diag.Width = $(window).width() - 26;
    diag.Height = $(window).height() -60;
 	diag.Title = "客户清单设置";
	diag.URL = '/document/lists/list.php?action=edit_list&list_id='+list_id+'&tits='+encodeURIComponent("客户清单设置");
 	diag.OKEvent = set_edit_list;
	//diag.CancelEvent = parent_focus;
    diag.show();
}
 
function set_edit_list(){
	Zd_DW.do_edit_list("campaign");
}

function do_set_sale_alt_num(type){
	if(type=="NONE"){
		$("#sale_alt_type").css("width","202px");
		$("#sale_alt_num").addClass("dis_none");
	}else{
		$("#sale_alt_type").css("width","142px");
		$("#sale_alt_num").css("width","48px").removeClass("dis_none");
	}
}

</script>
       
</head>
<body>
  
<input type="hidden" name="get_dial_status" id="get_dial_status" value="0" />
<input type="hidden" name="get_dial_method" id="get_dial_method" value="0" />
<input type="hidden" name="get_auto_dial_level" id="get_auto_dial_level" value="0" />
<input type="hidden" name="get_dial_status" id="get_dial_status" value="0" />
<input type="hidden" name="get_campaign_script" id="get_campaign_script" value="0" />
<input type="hidden" name="get_lead_filter_id" id="get_lead_filter_id" value="0" />
<input type="hidden" name="get_local_call_time" id="get_local_call_time" value="0" />
<input type="hidden" name="get_web_form_address" id="get_web_form_address" value="0" />
 
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>

<div class="field_list_div field_list" id="field_list_div"></div>

<?php
switch($action){
  
case "add_campaign":
?>

<script>

function do_add_campaign(){
	var status="";
	$("#dial_status_list tbody tr").map(function(){
		status+=" "+$(this).find("td:eq(0) span").text();
	});

	$("#dial_statuses").val(status+" -");
	
	if($("#campaign_id").val() == ""){
		alert("请填写活动ID号！");
		$("#campaign_id").focus();
		return false;
	}else if($("#campaign_id").val().length>8||$("#campaign_id").val().length<2){
		alert("活动ID位数必须介于2-8位字符之间！");
		$("#campaign_id").select();
		return false;
	}
	
	if($("#campaign_name").val() == ""){
		alert("请填写活动名称！");
		$("#campaign_name").focus();
		return false;
	}else if($("#campaign_name").val().length>20||$("#campaign_name").val().length<2){
		alert("活动名称位数必须介于2-20位字符之间！");
		$("#campaign_name").select();
		return false;
	}
 	
	if($("#dial_method").val() == ""){
		alert("请选择呼叫模式！");
		$("#dial_method").focus();
		return false;
	}
	
	if($("#auto_dial_level").val() == ""){
		alert("请选择呼叫级别！");
		$("#auto_dial_level").focus();
		return false;
	}
 	 
	if($("#dial_timeout").val() == ""){
		alert("请填写呼叫超时时间！建议为：50 秒！");
		$("#dial_timeout").focus();
		return false;
	}
 	
	if($("#dial_prefix").val() == ""){
		alert("请填写拨号前缀！");
		$("#dial_prefix").focus();
		return false;
	}
		
	if($("#campaign_cid").val() == ""){
		alert("请填写透传号码！");
		$("#campaign_cid").focus();
		return false;
	}else{
		check_campaign_cid();	
	}
 	
	$('#load').show();
	var datas="action=campaign_set&do_actions=add&"+$('#form1').serialize()+times;
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
	$('#dial_status_list thead tr').removeClass('alt');
 
	get_select_opt('RATIO','send.php','get_dial_method','dial_method','group_n');
	get_select_opt('1.8','send.php','get_auto_dial_level','auto_dial_level','none'); 
	get_select_opt('','send.php','get_dial_status','dial_status','def');
	get_select_opt('','../script/send.php','get_scripts_all_list','campaign_script','group_def');
	get_select_opt('','../lists/send.php','get_lead_filter_list','lead_filter_id','def');
	get_select_opt('24hours','send.php','get_local_call_time','local_call_time','def');
	get_select_opt('','/document/ask_flow/send.php','get_ask_all_list','web_form_address','def_n');
	
	do_set_sale_alt_num("NONE");
 
});
 
</script>

 
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">业务活动管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
</div>

<div class="page_main" >
            
 
<form action="" method="post" name="form1" id="form1">
    <input type="hidden" name="campaign_recording" id="campaign_recording" value="ALLFORCE" /> 
    <input type="hidden" name="use_internal_dnc" id="use_internal_dnc" value="Y" /> 
    <input type="hidden" name="adaptive_latest_server_time" id="adaptive_latest_server_time" value="1800" />
    <input type="hidden" name="dial_statuses" id="dial_statuses" value="NEW -" />
    <input type="hidden" name="no_hopper_leads_logins" id="no_hopper_leads_logins" value="Y" />
    <input type="hidden" name="use_campaign_dnc" id="use_campaign_dnc" value="Y" />
    <input type="hidden" name="agent_select_territories" id="agent_select_territories" value="" />
    <input type="hidden" name="crm_popup_login" id="crm_popup_login" value="N" />
    <input type="hidden" name="crm_login_address" id="crm_login_address" value="" />
    <input type="hidden" name="timer_action_seconds" id="timer_action_seconds" value="1" />
    <input type="hidden" name="allow_closers" id="allow_closers" value="Y" />
    
<fieldset> <legend style="font-weight:normal">基本信息</legend>
  
    <table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
    <tr >
      <td width="30%" align="right">活动ID：</td>
      <td align="left"><input maxlength="8" size="30" class="s_input" name="campaign_id" id="campaign_id" onkeyup="this.value=value.replace(/[^\w\/]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/]/ig,'')" onblur="this.value=value.replace(/[^\w\/]/ig,'');check_campaign()"/><span class="red">※</span><span class="gray">数字、英文组合,最长8位</span></td>
    </tr>
    <tr >
      <td align="right">活动名称：</td>
      <td align="left"><input maxlength="30" size="30" class="s_input" name="campaign_name" id="campaign_name"/><span class="red">※</span></td>
    </tr>
    <tr >
      <td align="right">活动描述：</td>
      <td align="left"><input maxlength="255" size="30" class="s_input" name="campaign_description" id="campaign_description"/></td>
    </tr>
    <tr >
      <td align="right">激活使用：</td>
      <td align="left"><select name="active" class="s_option" id="active">
          <option value="Y" selected="selected">启用</option>
          <option value="N">禁用</option>
        </select></td>
    </tr>    
  </table>
</fieldset>
  
  <fieldset><legend style="font-weight:normal">呼叫设置</legend>
  
<table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
    <tr >
      <td width="30%" align="right">呼叫模式：</td>
      <td align="left">
      	
         <select name="dial_method" class="s_option" id="dial_method" >
         </select><span class="red">※</span><span class="gray">手动外呼请选：<strong>INBOUND_MAN</strong>，自动外呼请选：<strong>RATIO</strong></span>
        </td>
    </tr>
    <tr >
      <td align="right">自动拨号级别：</td>
      <td align="left">
        <select name="auto_dial_level" class="s_option" id="auto_dial_level">
        </select><span class="red">※</span><span class="gray">0为不使用自动呼叫,建议级别:<strong>1.8</strong>,请根据呼叫情况即时调节</span></td>
    </tr>
    <tr >
      <td align="right">最大丢弃率：</td>
      <td align="left">
      
      	<select name="adaptive_dropped_percentage" class="s_option" id="adaptive_dropped_percentage">
        <?php 
			$n=101;
			while ($n>0.1){
				if ($n <4 and $n>0.2 ){
					$n = ($n - 0.1);
				}elseif($n <0.2){
					$n=0.1;
				}else{
					$n--;
				}
				if($n==3){
					$select="selected";
				}else{
					$select="";				
				}
				
				echo "<option value='$n' ".$select.">$n %</option>\n";
			 }
		 ?>
		</select><span class="gray">丢弃率=接通电话但未接通坐席数/接通总数</span>
      
      </td>
    </tr>
    <tr >
      <td align="right">呼叫超时时间： </td>
      <td align="left"><input value="50" maxlength="3" size="6" name="dial_timeout" id="dial_timeout" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"/><span class="red">※</span><span class="gray">单位：秒,数字越小呼叫速度越快,请根据呼叫接通率即时调节</span></td>
    </tr>
    <tr>
      <td align="right">拨号前缀：</td>
      <td align="left" style="line-height:16px">
      <span style="float:left;margin-top:14px"><input name="dial_prefix" id="dial_prefix" value="40" size="6" maxlength="6" onkeyup="value=value.replace(/[^\d|xX]/g,'')" onafterpaste="value=value.replace(/[^\d|xX]/g,'')"/>
      </span>
      <span class="red" style="float:left;margin-top:14px">※</span><span class="gray fl" >1.本系统呼叫规则为前缀+被叫,如:4013589104688、413589104688、4053182371135.<br/>
    2.请根据被叫号是否带前导0设置,不可有两个0的情形,如：40013589104688、40053182371135.<br/>
    3.不加前缀请填大写X.</span> 
        </td>
    </tr>
    <tr >
      <td align="right">透传号码：</td>
      <td align="left"><input name="campaign_cid" id="campaign_cid" size="30" class="s_input" maxlength="20" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" onblur="this.value=this.value.replace(/\D/g,'');check_campaign_cid()"/><span class="red">※</span><span class="gray">请填写正常的手机、固话号码</span></td>
    </tr>
    <tr style="display:none">
      <td align="right">电话前缀：</td>
      <td align="left">
        <select name="omit_phone_code" class="s_option" id="omit_phone_code">
        	<option value="Y" selected="selected">省略</option>
            <option value="N">使用</option>
        </select><span class="red">※</span><span class="gray">是否使用086代码前缀，建议省略</span></td>
    </tr>
    <tr>
      <td align="right">可拨打状态：</td>
      <td align="left">
       
          <table border="0" cellpadding="2" cellspacing="0" class="dataTable" style="margin-top:4px; margin-bottom:4px;width:520px;" id="dial_status_list">
          <thead>
            <tr align="left" class="dataHead">
              <th style="font-weight:normal;width:70px" >状态码</th>
              <th style="font-weight:normal;width:360px">拨打状态</th>
              <th style="font-weight:normal;width:60px" >操作</th>
            </tr>
          </thead>
         
           <tbody>
             <tr id='status_list_NEW'><td><span class='green'>NEW</span></td><td><span style='color:#08d;'>未呼叫</span></td><td class='o_icos'><span onclick="do_set_dial_status('del','NEW');" title="删除该拨打状态"></span></td></tr>
           </tbody>
           
           <tfoot>
            <tr class='dataTableFoot'><td colspan='14' align='left'>
                <select name="dial_status" class="s_option" id="dial_status">                   
                </select>
                <input value="添加" type="button" name="do_dial_status" id="do_dial_status" onclick="do_set_dial_status('add')" /><span class="red">※</span><span class="gray">如做2次呼叫，建议<a href="javascript:void(0)" title="点击添加" onclick="do_set_dial_status('add','NA','N');do_set_dial_status('add','DROP','N');do_set_dial_status('add','B','N');">添加NA、DROP、B</a>状态</span>
              </td>
             </tr>
           </tfoot>
           
        </table>
      
      
      </td>
    </tr>
     
    <tr >
      <td width="30%" align="right">每次提取号码数量：</td>
      <td align="left">
        <select name="hopper_level" class="s_option" id="hopper_level">
          <option value="1">1</option>
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
          <option value="200" selected="selected">200</option>
          <option value="500">500</option>
          <option value="1000">1000</option>
          <option value="2000">2000</option>
          </select>
        </td>
    </tr>
    <tr >
      <td align="right">提取号码顺序：</td>
      <td align="left">
      	<select name="lead_order" class="s_option" id="lead_order">
 			<option value="DOWN" title="按号码编号正序 [DOWN]">按号码编号正序</option>
			<option value="UP" title="按号码编号倒序 [UP]">按号码编号倒序</option>
			<option value="DOWN PHONE" title="按号码正序 [DOWN PHONE]">按号码正序</option>
			<option value="UP PHONE" title="按号码倒序 [UP PHONE]">按号码倒序</option>
			<option value="DOWN LAST NAME" title="按客户姓名正序 [DOWN LAST NAME]">按客户姓名正序</option>
			<option value="UP LAST NAME" title="按客户姓名倒序 [UP LAST NAME]">按客户姓名倒序</option>
			<option value="DOWN COUNT" title="按呼叫次数正序 [DOWN COUNT]">按呼叫次数正序</option>
			<option value="UP COUNT" title="按呼叫次数倒序 [UP COUNT]">按呼叫次数倒序</option>
			<option value="RANDOM" title="按随机顺序 [RANDOM]">按随机顺序</option>
			<option value="DOWN LAST CALL TIME" title="按最后呼叫时间正序 [DOWN LAST CALL TIME]">按最后呼叫时间正序</option>
			<option value="UP LAST CALL TIME" title="按最后呼叫时间倒序 [UP LAST CALL TIME]">按最后呼叫时间倒序</option>
			<option value="DOWN RANK" title="按号码级别正序 [DOWN RANK]">按号码级别正序</option>
			<option value="UP RANK" title="按号码级别倒序 [UP RANK]">按号码级别倒序</option>
			<option value="DOWN OWNER" title="按号码所有者正序 [DOWN OWNER]">按号码所有者正序</option>
			<option value="UP OWNER" title="按号码所有者倒序 [UP OWNER]">按号码所有者倒序</option>
			<option value="DOWN TIMEZONE" title="按时区正序 [DOWN TIMEZONE]">按时区正序</option>
			<option value="UP TIMEZONE" title="按时区倒序 [UP TIMEZONE]">按时区倒序</option>
			 
		</select>
       </td>
    </tr>
    <tr>
      <td align="right">每天最大成功数：</td>
      <td align="left" style="line-height:16px">
      	<span class="fl" style="margin-top:6px">
      	 <select name="sale_alt_type" class="s_option" id="sale_alt_type" onchange="do_set_sale_alt_num(this.value)">
         	<option value="NONE">不限制</option>
            <option value="cam" title="按照整个业务活动限制每天最大可成功数">按整个业务限定</option>
            <option value="list" title="每个客户清单每天最大成功数，超过该值系统禁用该清单呼叫下一个清单内号码">按每客户清单限定</option>
         </select>
      	 <input name="sale_alt_num" id="sale_alt_num" value="0" maxlength="5" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" onblur="this.value=this.value.replace(/\D/g,'');" title="设置每天最多成功数量,超过该值系统停止外呼"/>
         </span>
      	 <span class="gray fl">设置每天最多成功数量,超过该值系统停止外呼,<strong>0</strong>为不限制.<br />请注意:因呼叫并发的存在,实际成功数可能会有超出.</span>
        </td>
    </tr>
      
  </table>
  </fieldset>
  
  
  <fieldset><legend style="font-weight:normal">话术脚本设置</legend>
  
    <table width="100%" cellpadding="0" cellspacing="0" class="td_underline">    
     <tr >
      <td width="30%" align="right">话术脚本：</td>
      <td align="left">
        <select name="campaign_script" class="s_option" id="campaign_script">
          <option value="NONE">未设置</option>
          <option value="XXXXXNONE" disabled="disabled">------------------------</option>
        </select><span class="gray">显示指定脚本内容</span>
        </td>
    </tr>
    <tr >
      <td align="right">进线动作：</td>
      <td align="left">
      	<select name="get_call_launch" class="s_option" id="get_call_launch">
          <option value="NONE">未设置</option>
          <option value="XXXXXNONE" disabled="disabled">------------------------</option>
          <option value="SCRIPT">显示脚本</option>
          <option value="WEBFORM">打开指定问卷调查</option>
          <option value="WEBFORMTWO">打开指定网页表单二</option>
        </select><span class="gray">外拨、来电后显示脚本、指定问卷</span>
        </td>
    </tr>
    <tr >
      <td align="right">问卷调查：</td>
      <td align="left">
      <select id="web_form_address" name="web_form_address" class="s_option">
          <option value="">未设置</option>
          <option value="NONE" disabled="disabled">------------------------</option>
      </select>
      </td>
    </tr>
    <tr>
      <td align="right">网页表单二：</td>
      <td align="left"><input maxlength="1055" size="50" name="web_form_address_two" id="web_form_address_two" /><span class="gray">复制网页表单二地址到本处</span></td>
    </tr>     
  </table>
     
  </fieldset>

  <fieldset><legend style="font-weight:normal">其他设置</legend>
  
    <table width="100%" cellpadding="0" cellspacing="0" class="td_underline">    
	<tr >
      <td align="right">派话规则：</td>
      <td align="left">
      
      	<select name="next_agent_call" class="s_option" id="next_agent_call">
            <option value="random">随机</option>
            <option value="oldest_call_start">呼叫开始时长最大</option>
            <option value="oldest_call_finish" selected="selected">呼叫完成时长最大</option>
            <option value="overall_user_level">坐席总体级别</option>
            <option value="campaign_rank">业务活动权重</option>
            <option value="fewest_calls">最少呼叫量</option>
            <option value="longest_wait_time">最长等待时间</option>
         </select>
      </td>
    </tr>
    <tr class="" >
    
      <td align="right">业务活动话务时间：</td>
      <td align="left">
      	 <select name="local_call_time" class="s_option" id="local_call_time">
           <option value="NONE">未设置</option>
           <option value="XXXXXNONE" disabled="disabled">------------------------</option>
         </select><span class="gray">在选定话务时间段内可使用</span>
        </td>
    </tr>
    
    <tr>
      <td width="30%" align="right">客户挂断继续录音：</td>
      <td align="left">
        <select name="hangup_stop_rec" class="s_option" id="hangup_stop_rec">
            <option value="conf">继续录音</option>
            <option value="stop">停止录音</option> 
            
         </select><span class="gray">是否在客户挂断后继续录音</span>
        </td>
    </tr>
    <tr>
      <td width="30%" align="right">客户清单过滤规则：</td>
      <td align="left">
        <select name="lead_filter_id" class="s_option" id="lead_filter_id">
            <option value="NONE">未设置</option>
            <option value="XXXXXNONE" disabled="disabled">------------------------</option>
         </select><span class="gray">设定客户清单号码选取条件</span>
        </td>
    </tr>
    <tr >
      <td align="right">手动拨号过滤规则：</td>
      <td align="left">
          <select name="manual_dial_filter" class="s_option" id="manual_dial_filter">
              <option value="NONE">未指定</option>
              <option value="XXXXXNONE" disabled="disabled">------------------------</option>
              <option value="DNC_ONLY">系统黑名单</option>
              <option value="CAMPLISTS_ONLY">本业务黑名单</option>
              <option value="DNC_AND_CAMPLISTS">系统和业务黑名单</option>
          </select><span class="gray">设定手动外呼黑名单校验规则</span>
      </td>
    </tr>
    
    
    <tr >
      <td align="right">号码拥有者才能拨打：</td>
      <td align="left">
        <select name="agent_dial_owner_only" class="s_option" id="agent_dial_owner_only">
          <option value="NONE" selected="selected">未设置</option>
          <option value="XXXXXNONE" disabled="disabled">------------------------</option>
          <option value="USER">原拨打工号或导入时指定工号</option>
          <option value="TERRITORY">原拨打工号指定</option>
          <option value="USER_GROUP">原拨打工号所属坐席组</option>
         
        </select>
        </td>
    </tr>
    
    <tr class="dis_none">
        <td align="right">显示可拨打号码数量：</td>
        <td align="left">
        <select name="agent_display_dialable_leads" class="s_option" id="agent_display_dialable_leads">
        	
            <option value="Y">启用</option>
            <option value="N" selected="selected">禁用</option>
         </select>
         </td>
      </tr>
      
      <tr class="dis_none">
        <td align="right">显示电话队列数量：</td>
        <td align="left">
        <select name="display_queue_count" class="s_option" id="display_queue_count">
          <option value="Y">启用</option>
          <option selected="selected" value="N">禁用</option>
          
        </select></td>
      </tr>
      <tr class="dis_none">
        <td align="right">显示队列电话数量：</td>
        <td align="left"><select name="view_calls_in_queue" class="s_option" id="view_calls_in_queue">
          <option value="NONE" selected="selected">未设置</option>
          <option value="XXXXXNONE" disabled="disabled">------------------------</option>
          <option value="ALL">显示全部</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
           
        </select></td>
      </tr>
      <tr class="dis_none">
        <td align="right">显示队列电话方式：</td>
        <td align="left">
        <select name="view_calls_in_queue_launch" class="s_option" id="view_calls_in_queue_launch">
          <option selected="selected" value="MANUAL">手动</option>
          <option value="AUTO">自动</option>
         </select>
        </td>
      </tr>
      
      
    <tr >
      <td align="right">提交结束后自动暂停：</td>
      <td align="left">
      	 <select name="pause_after_each_call" class="s_option" id="pause_after_each_call">
        	<option value="N" selected="selected">禁用</option>
          	<option value="Y">启用</option>
         </select>
        </td>
    </tr>
   <tr >
      <td align="right">强制坐席选择暂停原因：</td>
      <td align="left">
      	 <select name="agent_pause_codes_active" class="s_option" id="agent_pause_codes_active">
        	<option value="N" selected="selected">禁用</option>
          	<option value="FORCE">启用</option>
         </select><span class="gray">是否在坐席暂停时显示暂停原因选项</span>
        </td>
    </tr> 
    <tr >
      <td align="right">显示被叫电话DTMF按键：</td>
      <td align="left">
      	 <select name="display_dtmf_alter" class="s_option" id="display_dtmf_alter">
        	<option value="N" selected="selected">禁用</option>
          	<option value="Y">启用</option>
         </select><span class="gray"></span>
        </td>
    </tr>  
     
  </table>
 </fieldset>  
               
</form>
       
</div>

<?php 

break;

case "edit_campaign":
?>
<?php

$sql="select campaign_name,a.campaign_id,active,campaign_description,web_form_address,web_form_address_two,hopper_level,auto_dial_level,next_agent_call,local_call_time,dial_timeout,dial_prefix,campaign_cid,campaign_script,get_call_launch,lead_filter_id,dial_method,dial_statuses,view_calls_in_queue,view_calls_in_queue_launch,pause_after_each_call,agent_dial_owner_only,agent_display_dialable_leads,campaign_logindate,campaign_changedate,campaign_calldate,drop_lockout_time,campaign_allow_inbound,auto_alt_dial,list_order_mix,omit_phone_code,adaptive_dropped_percentage,lead_order,manual_dial_filter,agent_pause_codes_active,hangup_stop_rec,display_queue_count,display_dtmf_alter,b.sale_alt_type,b.sale_alt_num,c.today_sale from vicidial_campaigns a left join data_cam_sale_alt b on a.campaign_id=b.campaign_id left join (select sum(counts) as today_sale,campaign_id from data_report_call_log_list where call_date BETWEEN '".$today." 01' and '".$today." 23' and status='CG' and campaign_id='".$campaign_id."') c on a.campaign_id=c.campaign_id where a.campaign_id='".$campaign_id."' limit 1 ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
  		$campaign_name=$rs["campaign_name"];
 		$campaign_id=$rs["campaign_id"];
 		$active=$rs["active"];
		$campaign_description=$rs["campaign_description"];
  		$web_form_address=$rs["web_form_address"];
		$web_form_address_two=$rs["web_form_address_two"];
		$hopper_level=$rs["hopper_level"];
		$auto_dial_level=$rs["auto_dial_level"];
  		$next_agent_call=$rs["next_agent_call"];
 		$local_call_time=$rs["local_call_time"];
  		$dial_timeout=$rs["dial_timeout"];
 		$dial_prefix=$rs["dial_prefix"];
   		$campaign_cid=$rs["campaign_cid"];
   		$campaign_script=$rs["campaign_script"];
 		$get_call_launch=$rs["get_call_launch"];
		$lead_filter_id=$rs["lead_filter_id"];
		$dial_method=$rs["dial_method"];
		$dial_statuses=$rs["dial_statuses"];
 		$view_calls_in_queue=$rs["view_calls_in_queue"];
		$view_calls_in_queue_launch=$rs["view_calls_in_queue_launch"];
		$pause_after_each_call=$rs["pause_after_each_call"];
		$agent_dial_owner_only=$rs["agent_dial_owner_only"];
		$agent_display_dialable_leads=$rs["agent_display_dialable_leads"];
  		$campaign_logindate=$rs["campaign_logindate"];
		$campaign_changedate=$rs["campaign_changedate"];
		$campaign_calldate=$rs["campaign_calldate"];
		$drop_lockout_time=$rs["drop_lockout_time"];
	 
		$campaign_allow_inbound=$rs["campaign_allow_inbound"];
		$auto_alt_dial=$rs["auto_alt_dial"];
		$list_order_mix=$rs["list_order_mix"];
		$omit_phone_code=$rs["omit_phone_code"];
		$adaptive_dropped_percentage=$rs["adaptive_dropped_percentage"];
		$lead_order=$rs["lead_order"];
		$manual_dial_filter=$rs["manual_dial_filter"];
		$agent_pause_codes_active=$rs["agent_pause_codes_active"];
		$hangup_stop_rec=$rs["hangup_stop_rec"];
		$display_queue_count=$rs["display_queue_count"];
		
		$sale_alt_num=($rs["sale_alt_num"]?$rs["sale_alt_num"]:0);
		$sale_alt_type=($rs["sale_alt_type"]?$rs["sale_alt_type"]:"NONE");
		$today_sale=($rs["today_sale"]?$rs["today_sale"]:0);
		$display_dtmf_alter=$rs["display_dtmf_alter"];
    }
 	echo "<script>$(document).ready(
	function(){
  	
		var Sorts_Order=0;
		$('#datatable .dataHead th[sort]').map(function(){
			Sorts_Order=Sorts_Order+1;
			
			html=$(this).html();
			
			$(this).attr('id','DadaSorts_'+Sorts_Order).off().on('click',function(){
				Sorts_new('datatable',$(this).attr('id'),$('#pagesize').val());	
			}).html('<div>'+html+'<span class=\'sorting\'></span></div>');
		
		});
		
		$('<input name=\"a_ctions\" type=\"hidden\" id=\"a_ctions\"/> <input name=\"doa_ctions\" type=\"hidden\" id=\"doa_ctions\"/> <input name=\"recounts\" type=\"hidden\" id=\"recounts\"/> <input name=\"pages\" type=\"hidden\" id=\"pages\" value=\"1\"/> <input name=\"pagecounts\" type=\"hidden\" id=\"pagecounts\"/><input name=\"pagesize\" type=\"hidden\" id=\"pagesize\" value=\"15\"/> <input name=\"sorts\" type=\"hidden\" id=\"sorts\" value=\"a.active\"/> <input name=\"order\" type=\"hidden\" value=\"asc\" id=\"order\"/>').appendTo(\"body\");
		
		GetPageCount('search','count');
		get_datalist(1,'search','list',$('#pagesize').val());
 		
		$('.td_underline tr:visible:odd').addClass('alt');
  		
		get_select_opt('".$dial_method."','send.php','get_dial_method','dial_method','group_n');
		get_select_opt('".$auto_dial_level."','send.php','get_auto_dial_level','auto_dial_level','none'); 
		get_select_opt('','send.php','get_dial_status','dial_status','def');
		
		get_select_opt('".$campaign_script."','../script/send.php','get_scripts_all_list','campaign_script','group_def');
		get_select_opt('".$lead_filter_id."','../lists/send.php','get_lead_filter_list','lead_filter_id','def');
		get_select_opt('".$local_call_time."','send.php','get_local_call_time','local_call_time','def');
		get_select_opt('".$web_form_address."','/document/ask_flow/send.php','get_ask_all_list','web_form_address','def_n');
		
		$('#active').val('".$active."');
    		 
  		$('#hopper_level').val('".$hopper_level."');
   		$('#get_call_launch').val('".$get_call_launch."');
 
  		$('#next_agent_call').val('".$next_agent_call."');
   		$('#agent_dial_owner_only').val('".$agent_dial_owner_only."');		
  		$('#agent_display_dialable_leads').val('".$agent_display_dialable_leads."');		
		$('#display_queue_count').val('".$display_queue_count."');
		$('#view_calls_in_queue').val('".$view_calls_in_queue."');
		$('#view_calls_in_queue_launch').val('".$view_calls_in_queue_launch."');
		$('#pause_after_each_call').val('".$pause_after_each_call."');
		 
		$('#omit_phone_code').val('".$omit_phone_code."');
		$('#lead_order').val('".$lead_order."');
		$('#adaptive_dropped_percentage').val('".$adaptive_dropped_percentage."');
 		$('#manual_dial_filter').val('".$manual_dial_filter."');
		$('#agent_pause_codes_active').val('".$agent_pause_codes_active."');
		$('#hangup_stop_rec').val('".$hangup_stop_rec."');
		$('#display_dtmf_alter').val('".$display_dtmf_alter."');
		//set_dial_status();
		setTimeout('set_dial_status();',1000);
		do_set_sale_alt_num('".$sale_alt_type."');
		$('#sale_alt_type').val('".$sale_alt_type."');
		$('#sale_alt_num').val('".$sale_alt_num."');
	});
</script>";
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("该业务活动不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>

<script>

function set_dial_status(){
	//alert($("#dial_status option[value='A']").text());
	var status_list="<?php echo $dial_statuses ?>".replace(" -","");
	var status_ary=status_list.split(" ");	
	$("#dial_status_list tbody tr").remove();

	for(i=0;i<status_ary.length;i++){
		if(status_ary[i]!=""&&status_ary[i]!=undefined){
    	
			status_name=$("#dial_status option[value='"+status_ary[i]+"']").text();
			if(status_name!=""&&status_name!=undefined){
				status_name=status_name.split("[")[1].replace("]","");
			}else{
				status_name=status_ary[i];
			}
 			if($("#status_list_"+status_ary[i]).length<1){
				tr="<tr id='status_list_"+status_ary[i]+"'><td><span class='green'>"+status_ary[i]+"</span></td><td><span style='color:#08d;'>"+status_name+"</span></td><td class='o_icos'><span onclick=\"do_set_dial_status('del','"+status_ary[i]+"');\" title='删除该拨打状态'></span></td></tr>";
				$("#dial_status_list tbody").append(tr);
			}
 		}
	} 
	$("#dial_status_list tbody tr").removeClass().mouseover(function(){$(this).addClass("over")}).mouseout(function(){$(this).removeClass("over")});
	$("#dial_status_list tbody tr:odd").addClass("alt");
 
} 

function do_edit_campaign(){
	
	var status="";
	$("#dial_status_list tbody tr").map(function(){
		status+=" "+$(this).find("td:eq(0) span").text();
	});

	$("#dial_statuses").val(status+" -");
 	
	if($("#campaign_name").val() == "")
	{
		alert("请填写活动名称！");
		$("#campaign_name").focus();
		return false;
	}else if($("#campaign_name").val().length>20||$("#campaign_name").val().length<2){
		alert("活动名称位数必须介于2-20位字符之间！");
		$("#campaign_name").select();
		return false;
	}
 	
	if($("#dial_method").val() == ""){
		alert("请选择呼叫模式！");
		$("#dial_method").focus();
		return false;
	}
	
	if($("#auto_dial_level").val() == ""){
		alert("请选择呼叫级别！");
		$("#auto_dial_level").focus();
		return false;
	}
 	 
	if($("#dial_timeout").val() == "")
	{
		alert("请填写呼叫超时时间！建议为：50 秒！");
		$("#dial_timeout").focus();
		return false;
	}
 	
	if($("#dial_prefix").val() == "")
	{
		alert("请填写拨号前缀！");
		$("#dial_prefix").focus();
		return false;
	}
		
	if($("#campaign_cid").val() == "")
	{
		alert("请填写透传号码！");
		$("#campaign_cid").focus();
		return false;
	}else{
		check_campaign_cid();	
	}
 	
	$('#load').show();
	var datas="action=campaign_set&do_actions=update&"+$('#form1').serialize()+times;
   	  
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
			 
			$(_DialogInstance.ParentWindow.document).find("#campaign_list_<?php echo $campaign_id ?> td").eq(2).attr("title",$("#campaign_name").val()+"  "+$("#campaign_description").val()).html("<div class='hide_tit'><span class='green'>"+$("#campaign_name").val()+"</span></div>");
			$(_DialogInstance.ParentWindow.document).find("#campaign_list_<?php echo $campaign_id ?> td").eq(3).html("<span class='green'>"+$("#dial_method option:selected").text()+"</span>");
			$(_DialogInstance.ParentWindow.document).find("#campaign_list_<?php echo $campaign_id ?> td").eq(4).html("<span class='green'>"+json.auto_dial_level+"</span>");
			$(_DialogInstance.ParentWindow.document).find("#campaign_list_<?php echo $campaign_id ?> td").eq(5).html("<span class='green'>"+$("#campaign_cid").val()+"</span>");
			$(_DialogInstance.ParentWindow.document).find("#campaign_list_<?php echo $campaign_id ?> td").eq(6).html("<span class='green'>"+$("#hopper_level").val()+"</span>");
			$(_DialogInstance.ParentWindow.document).find("#campaign_list_<?php echo $campaign_id ?> td").eq(7).attr("title",$("#dial_statuses").val()).html("<div class='hide_tit'><span class='green'>"+$("#dial_statuses").val()+"</div></span>");
			$(_DialogInstance.ParentWindow.document).find("#campaign_list_<?php echo $campaign_id ?> td").eq(8).html("<span class='green'>"+$("#active option:selected").text()+"</span>");
  
			setTimeout('Dialog.close();',10);
		  }else{
			  alert(json.des);
		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
 }
 
function del_campaign(){

	datas="action=del_campaign&do_actions=campaign&c_id="+$("#campaign_id").val()+times;
 	//alert(datas);
    if(confirm("删除后不可恢复，您确定要删除本业务活动吗？")){
 
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
 
function set_campaign_agent_out(){

	datas="action=set_campaign_agent_out&campaign_id="+$("#campaign_id").val()+times;
 	//alert(datas);
    if(confirm("您确定要强制签退登录本业务活动的所有坐席吗？")){
 
		$('#load').show();
		$.ajax({
			 
			url: "send.php",
			data:datas,
			
			beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
			complete :function(){$('#load').hide('100');},
			success: function(json){ 

				request_tip(json.des,json.counts);
				 
				if(json.counts!="1"){
					alert(json.des);  
				}
 									
			},error:function(XMLHttpRequest,textStatus ){
				alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
			}
		});
   	}	

} 

function view_campaign_hopper_list(action,campaign_id){
	var diag =new Dialog("view_campaign_hopper_list");
 	diag.Width = 780;
	diag.Height = 450;
	diag.Title = "查看漏斗表提取号码";
 	diag.URL = "/document/campaign/list.php?campaign_id="+campaign_id+"&tits="+encodeURIComponent("查看漏斗表提取号码")+"&action="+action;
  	diag.show();
	diag.OKButton.hide();
	diag.CancelButton.value="关 闭";
}
   
function view_campaign_lead_list(action,campaign_id,list_active){
	var diag =new Dialog("view_campaign_lead_list");
    diag.Width = $(window).width() - 26;
    diag.Height = $(window).height() -60;
	diag.Title = "查看业务所属客户清单";
 	diag.URL = "/document/campaign/list.php?campaign_id="+campaign_id+"&list_active="+list_active+"&tits="+encodeURIComponent("查看业务所属客户清单")+"&action="+action;
  	diag.show();
	diag.OKButton.hide();
	diag.CancelButton.value="关 闭";
}
 
function GetPageCount(a_ctions,doa_ctions){
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
  
	var url="action=get_campaign_leads_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&campaign_id="+$("#campaign_id").val()+"&list_active="+$("#list_active").val()+times;
 	
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
	
	var url="action=get_campaign_leads_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&campaign_id="+$("#campaign_id").val()+"&list_active="+$("#list_active").val()+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times;
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
					 
					dblclick=" ondblclick='edit_list(\""+con.list_id+"\")' ";
					do_edit="<a href='javascript:void(0)' onclick='edit_list(\""+con.list_id+"\")'>修改</a>";
  					list_lastcalldate=con.list_lastcalldate;
					if(!list_lastcalldate){
						list_lastcalldate="";	
					}
					tr_str="<tr align=\"left\" id=\"leads_list_"+con.list_id+"\" "+dblclick+">";
 					tr_str+="<td>"+con.list_id+"</td>";
					tr_str+="<td><div class='hide_tit' title='"+con.list_name+"'>"+con.list_name+"</div></td>";
					tr_str+="<td><div class='hide_tit' title='"+con.list_description+"'>"+con.list_description+"</div></td>";
					tr_str+="<td>"+con.counts+"</td>";
					tr_str+="<td><span class='red'>"+con.sale_num+"</span></td>";
					tr_str+="<td>"+con.active+"</td>";
					tr_str+="<td>"+list_lastcalldate+"</td>";
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
</script>
 

    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">业务活动管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
    
<table border="0" cellpadding="0" cellspacing="0" class="menu_list">
     <tr>
        <td colspan="2"><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="view_campaign_hopper_list('campaign_lead_hopper_list','<?php echo $campaign_id ?>');" title="查看漏斗表号码！"><img src="/images/icons/telephone4.png" style="margin-top:6px" /><b>查看漏斗表提取号码&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="view_campaign_lead_list('campaign_lead_list','<?php echo $campaign_id ?>','');" title="查看本业务客户清单"><img src="/images/icons/telephone1.png" style="margin-top:6px" /><b>查看本业务客户清单&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="set_campaign_agent_out();" title="强制签退登录本业务活动的所有坐席！"><img src="/images/icons/icon025a7.gif" /><b>签退本活动的所有坐席&nbsp;</b></a><a href='javascript:void(0);'  class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="del_campaign();" title="删除本业务活动"><img src="/images/icon_cancel.gif" style="margin-top:4px"/><b>删除本业务活动&nbsp;</b></a></td>
    </tr>
    </table>            
 
<input type="hidden" name="list_active" id="list_active" value="" />
<form action="" method="post" name="form1" id="form1">
<input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $campaign_id ?>" /> 
<input type="hidden" name="dial_statuses" id="dial_statuses" value="<?php echo $dial_statuses ?>" />
<input type="hidden" name="campaign_allow_inbound" id="campaign_allow_inbound" value="<?php echo $campaign_allow_inbound ?>" />
<input type="hidden" name="auto_alt_dial" id="auto_alt_dial" value="<?php echo $auto_alt_dial ?>" />
<input type="hidden" name="list_order_mix" id="list_order_mix" value="<?php echo $list_order_mix ?>" />

 <fieldset> <legend style="font-weight:normal">基本信息</legend>
  
    <table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
     
    <tr >
      <td align="right">活动ID：</td>
      <td align="left"><span class="blue"><strong><?php echo $campaign_id ?></strong></span></td>
    </tr>
    <tr >
      <td width="30%" align="right">活动名称：</td>
      <td align="left"><input name="campaign_name" id="campaign_name" value="<?php echo $campaign_name ?>" size="30" class="s_input" maxlength="30"/><span class="red">※</span></td>
    </tr>
    <tr >
      <td align="right">活动描述：</td>
      <td align="left"><input name="campaign_description" id="campaign_description" value="<?php echo $campaign_description ?>" size="30" class="s_input" maxlength="255"/></td>
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
      <td align="right">更改时间：</td>
      <td align="left"><span class="gray"><?php echo $campaign_changedate ?></span>&nbsp; 话务时间：<span class="gray"><?php echo $campaign_calldate ?></span></td>
    </tr>
     
    <tr>
      <td align="right">客户清单数：</td>
      <td align="left">
          
		<?php 
 	  
			$sql="select ifnull(count(*),0) as counts from vicidial_hopper where campaign_id='".$campaign_id."' and status='READY'";
			 
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
 					$hopper_leads=$rs["counts"];
  				}
			 
			} 
			mysqli_free_result($rows);
			
     		
			if($lead_filter_id!="NONE"&&$lead_filter_id!=""){
				
				$sql="select lead_filter_sql from vicidial_lead_filters where lead_filter_id='".$lead_filter_id."'";
				$filterSQL="";
				$rows=mysqli_query($db_conn,$sql);
				$row_counts_list=mysqli_num_rows($rows);			
				
				if ($row_counts_list!=0) {
					while($rs= mysqli_fetch_array($rows)){ 
						$filterSQL=$rs["lead_filter_sql"];
					}
				 
				} 
				mysqli_free_result($rows);
				
				$filterSQL = preg_replace("/\\\\/","",$filterSQL);
				$filterSQL = eregi_replace("^and|and$|^or|or$","",$filterSQL);
				if (strlen($filterSQL)>4){
					
					$fSQL = "and $filterSQL";
				}else{
					$fSQL = "";
				}
 			}
 			
			$sql="select list_id,active from vicidial_lists where campaign_id='".$campaign_id."'";
			$camp_lists="";
			$rows=mysqli_query($db_conn,$sql);
			$row_counts_list=mysqli_num_rows($rows);			
			$active_lists=0;
			$inactive_lists=0;
			if ($row_counts_list!=0) {
				while($rs= mysqli_fetch_array($rows)){ 
					if($rs["active"]=="Y"){
						$active_lists+=1;
						$camp_lists.="'".$rs["list_id"]."',";
					}else{
 						$inactive_lists+=1;
 					}
 				}
			 
			} 
			
			mysqli_free_result($rows);
			$camp_lists=rtrim($camp_lists,",");
   			
			 //获取业务活动可呼叫号码 	  
			function dialable_leads($local_call_time,$dial_statuses,$camp_lists,$drop_lockout_time,$fSQL){
				 
				global $db_conn;
				 
				if (isset($camp_lists))
					{
					if (strlen($camp_lists)>1)
						{
						if (strlen($dial_statuses)>2)
							{
							$g=0;
							$p='13';
							$GMT_gmt[0] = '';
							$GMT_hour[0] = '';
							$GMT_day[0] = '';
							while ($p > -13)
								{
								$pzone=3600 * $p;
								$pmin=(gmdate("i", time() + $pzone));
								$phour=( (gmdate("G", time() + $pzone)) * 100);
								$pday=gmdate("w", time() + $pzone);
								//echo $pday."<br>";
								$tz = sprintf("%.2f", $p);	
								$GMT_gmt[$g] = "$tz";
								$GMT_day[$g] = "$pday";
								$GMT_hour[$g] = ($phour + $pmin);
								$p = ($p - 0.25);
								$g++;
								}
				
							$sql="SELECT call_time_id,call_time_name,call_time_comments,ct_default_start,ct_default_stop,ct_sunday_start,ct_sunday_stop,ct_monday_start,ct_monday_stop,ct_tuesday_start,ct_tuesday_stop,ct_wednesday_start,ct_wednesday_stop,ct_thursday_start,ct_thursday_stop,ct_friday_start,ct_friday_stop,ct_saturday_start,ct_saturday_stop,ct_state_call_times FROM vicidial_call_times where call_time_id='$local_call_time';";
							
							$rslt=mysqli_query($db_conn,$sql);
							$rowx=mysqli_fetch_row($rslt);
							$Gct_default_start =	"$rowx[3]";
							$Gct_default_stop =		"$rowx[4]";
							$Gct_sunday_start =		"$rowx[5]";
							$Gct_sunday_stop =		"$rowx[6]";
							$Gct_monday_start =		"$rowx[7]";
							$Gct_monday_stop =		"$rowx[8]";
							$Gct_tuesday_start =	"$rowx[9]";
							$Gct_tuesday_stop =		"$rowx[10]";
							$Gct_wednesday_start =	"$rowx[11]";
							$Gct_wednesday_stop =	"$rowx[12]";
							$Gct_thursday_start =	"$rowx[13]";
							$Gct_thursday_stop =	"$rowx[14]";
							$Gct_friday_start =		"$rowx[15]";
							$Gct_friday_stop =		"$rowx[16]";
							$Gct_saturday_start =	"$rowx[17]";
							$Gct_saturday_stop =	"$rowx[18]";
							$Gct_state_call_times = "$rowx[19]";
				
							$ct_states = '';
							$ct_state_gmt_SQL = '';
							$ct_srs=0;
							$b=0;
							if (strlen($Gct_state_call_times)>2)
								{
								$state_rules = explode('|',$Gct_state_call_times);
								$ct_srs = ((count($state_rules)) - 2);
								}
							while($ct_srs >= $b)
								{
								if (strlen($state_rules[$b])>1)
									{
									$sql="SELECT state_call_time_id,state_call_time_state,state_call_time_name,state_call_time_comments,sct_default_start,sct_default_stop,sct_sunday_start,sct_sunday_stop,sct_monday_start,sct_monday_stop,sct_tuesday_start,sct_tuesday_stop,sct_wednesday_start,sct_wednesday_stop,sct_thursday_start,sct_thursday_stop,sct_friday_start,sct_friday_stop,sct_saturday_start,sct_saturday_stop from vicidial_state_call_times where state_call_time_id='$state_rules[$b]';";
									$rslt=mysqli_query($db_conn,$sql);
									$row=mysqli_fetch_row($rslt);
									$Gstate_call_time_id =		"$row[0]";
									$Gstate_call_time_state =	"$row[1]";
									$Gsct_default_start =		"$row[4]";
									$Gsct_default_stop =		"$row[5]";
									$Gsct_sunday_start =		"$row[6]";
									$Gsct_sunday_stop =			"$row[7]";
									$Gsct_monday_start =		"$row[8]";
									$Gsct_monday_stop =			"$row[9]";
									$Gsct_tuesday_start =		"$row[10]";
									$Gsct_tuesday_stop =		"$row[11]";
									$Gsct_wednesday_start =		"$row[12]";
									$Gsct_wednesday_stop =		"$row[13]";
									$Gsct_thursday_start =		"$row[14]";
									$Gsct_thursday_stop =		"$row[15]";
									$Gsct_friday_start =		"$row[16]";
									$Gsct_friday_stop =			"$row[17]";
									$Gsct_saturday_start =		"$row[18]";
									$Gsct_saturday_stop =		"$row[19]";
				
									$ct_states .="'$Gstate_call_time_state',";
				
									$r=0;
									$state_gmt='';
									while($r < $g)
										{
										if ($GMT_day[$r]==0)	#### Sunday local time
											{
											if (($Gsct_sunday_start==0) and ($Gsct_sunday_stop==0))
												{
												if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
													{$state_gmt.="'$GMT_gmt[$r]',";}
												}
											else
												{
												if ( ($GMT_hour[$r]>=$Gsct_sunday_start) and ($GMT_hour[$r]<$Gsct_sunday_stop) )
													{$state_gmt.="'$GMT_gmt[$r]',";}
												}
											}
										if ($GMT_day[$r]==1)	#### Monday local time
											{
											if (($Gsct_monday_start==0) and ($Gsct_monday_stop==0))
												{
												if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
													{$state_gmt.="'$GMT_gmt[$r]',";}
												}
											else
												{
												if ( ($GMT_hour[$r]>=$Gsct_monday_start) and ($GMT_hour[$r]<$Gsct_monday_stop) )
													{$state_gmt.="'$GMT_gmt[$r]',";}
												}
											}
										if ($GMT_day[$r]==2)	#### Tuesday local time
											{
											if (($Gsct_tuesday_start==0) and ($Gsct_tuesday_stop==0))
												{
												if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
													{$state_gmt.="'$GMT_gmt[$r]',";}
												}
											else
												{
												if ( ($GMT_hour[$r]>=$Gsct_tuesday_start) and ($GMT_hour[$r]<$Gsct_tuesday_stop) )
													{$state_gmt.="'$GMT_gmt[$r]',";}
												}
											}
										if ($GMT_day[$r]==3)	#### Wednesday local time
											{
											if (($Gsct_wednesday_start==0) and ($Gsct_wednesday_stop==0))
												{
												if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
													{$state_gmt.="'$GMT_gmt[$r]',";}
												}
											else
												{
												if ( ($GMT_hour[$r]>=$Gsct_wednesday_start) and ($GMT_hour[$r]<$Gsct_wednesday_stop) )
													{$state_gmt.="'$GMT_gmt[$r]',";}
												}
											}
										if ($GMT_day[$r]==4)	#### Thursday local time
											{
											if (($Gsct_thursday_start==0) and ($Gsct_thursday_stop==0))
												{
												if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
													{$state_gmt.="'$GMT_gmt[$r]',";}
												}
											else
												{
												if ( ($GMT_hour[$r]>=$Gsct_thursday_start) and ($GMT_hour[$r]<$Gsct_thursday_stop) )
													{$state_gmt.="'$GMT_gmt[$r]',";}
												}
											}
										if ($GMT_day[$r]==5)	#### Friday local time
											{
											if (($Gsct_friday_start==0) and ($Gsct_friday_stop==0))
												{
												if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
													{$state_gmt.="'$GMT_gmt[$r]',";}
												}
											else
												{
												if ( ($GMT_hour[$r]>=$Gsct_friday_start) and ($GMT_hour[$r]<$Gsct_friday_stop) )
													{$state_gmt.="'$GMT_gmt[$r]',";}
												}
											}
										if ($GMT_day[$r]==6)	#### Saturday local time
											{
											if (($Gsct_saturday_start==0) and ($Gsct_saturday_stop==0))
												{
												if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
													{$state_gmt.="'$GMT_gmt[$r]',";}
												}
											else
												{
												if ( ($GMT_hour[$r]>=$Gsct_saturday_start) and ($GMT_hour[$r]<$Gsct_saturday_stop) )
													{$state_gmt.="'$GMT_gmt[$r]',";}
												}
											}
										$r++;
										}
									$state_gmt = "$state_gmt'99'";
									$ct_state_gmt_SQL .= "or (state='$Gstate_call_time_state' and gmt_offset_now IN($state_gmt)) ";
									}
				
								$b++;
								}
							if (strlen($ct_states)>2)
								{
								$ct_states = eregi_replace(",$",'',$ct_states);
								$ct_statesSQL = "and state NOT IN($ct_states)";
								}
							else
								{
								$ct_statesSQL = "";
								}
				
							$r=0;
							$default_gmt='';
							while($r < $g)
								{
								if ($GMT_day[$r]==0)	#### Sunday local time
									{
									if (($Gct_sunday_start==0) and ($Gct_sunday_stop==0))
										{
										if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
											{$default_gmt.="'$GMT_gmt[$r]',";}
										}
									else
										{
										if ( ($GMT_hour[$r]>=$Gct_sunday_start) and ($GMT_hour[$r]<$Gct_sunday_stop) )
											{$default_gmt.="'$GMT_gmt[$r]',";}
										}
									}
								if ($GMT_day[$r]==1)	#### Monday local time
									{
									if (($Gct_monday_start==0) and ($Gct_monday_stop==0))
										{
										if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
											{$default_gmt.="'$GMT_gmt[$r]',";}
										}
									else
										{
										if ( ($GMT_hour[$r]>=$Gct_monday_start) and ($GMT_hour[$r]<$Gct_monday_stop) )
											{$default_gmt.="'$GMT_gmt[$r]',";}
										}
									}
								if ($GMT_day[$r]==2)	#### Tuesday local time
									{
									if (($Gct_tuesday_start==0) and ($Gct_tuesday_stop==0))
										{
										if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
											{$default_gmt.="'$GMT_gmt[$r]',";}
										}
									else
										{
										if ( ($GMT_hour[$r]>=$Gct_tuesday_start) and ($GMT_hour[$r]<$Gct_tuesday_stop) )
											{$default_gmt.="'$GMT_gmt[$r]',";}
										}
									}
								if ($GMT_day[$r]==3)	#### Wednesday local time
									{
									if (($Gct_wednesday_start==0) and ($Gct_wednesday_stop==0))
										{
										if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
											{$default_gmt.="'$GMT_gmt[$r]',";}
										}
									else
										{
										if ( ($GMT_hour[$r]>=$Gct_wednesday_start) and ($GMT_hour[$r]<$Gct_wednesday_stop) )
											{$default_gmt.="'$GMT_gmt[$r]',";}
										}
									}
								if ($GMT_day[$r]==4)	#### Thursday local time
									{
									if (($Gct_thursday_start==0) and ($Gct_thursday_stop==0))
										{
										if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
											{$default_gmt.="'$GMT_gmt[$r]',";}
										}
									else
										{
										if ( ($GMT_hour[$r]>=$Gct_thursday_start) and ($GMT_hour[$r]<$Gct_thursday_stop) )
											{$default_gmt.="'$GMT_gmt[$r]',";}
										}
									}
								if ($GMT_day[$r]==5)	#### Friday local time
									{
									if (($Gct_friday_start==0) and ($Gct_friday_stop==0))
										{
										if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
											{$default_gmt.="'$GMT_gmt[$r]',";}
										}
									else
										{
										if ( ($GMT_hour[$r]>=$Gct_friday_start) and ($GMT_hour[$r]<$Gct_friday_stop) )
											{$default_gmt.="'$GMT_gmt[$r]',";}
										}
									}
								if ($GMT_day[$r]==6)	#### Saturday local time
									{
									if (($Gct_saturday_start==0) and ($Gct_saturday_stop==0))
										{
										if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
											{$default_gmt.="'$GMT_gmt[$r]',";}
										}
									else
										{
										if ( ($GMT_hour[$r]>=$Gct_saturday_start) and ($GMT_hour[$r]<$Gct_saturday_stop) )
											{$default_gmt.="'$GMT_gmt[$r]',";}
										}
									}
								$r++;
								}
				
							$default_gmt = "$default_gmt'99'";
							$all_gmtSQL = "(gmt_offset_now IN($default_gmt) $ct_statesSQL) $ct_state_gmt_SQL";
				
							$dial_statuses = preg_replace("/ -$/","",$dial_statuses);
							$Dstatuses = explode(" ", $dial_statuses);
							$Ds_to_print = (count($Dstatuses) - 0);
							$Dsql = '';
							$o=0;
							while ($Ds_to_print > $o) 
								{
								$o++;
								$Dsql .= "'$Dstatuses[$o]',";
								}
							$Dsql = preg_replace("/,$/","",$Dsql);
							if (strlen($Dsql) < 2) {$Dsql = "''";}
				
							$DLTsql='';
							if ($drop_lockout_time > 0)
								{
								$DLseconds = ($drop_lockout_time * 3600);
								$DLseconds = floor($DLseconds);
								$DLseconds = intval("$DLseconds");
								$DLTsql = "and ( ( (status IN('DROP','XDROP')) and (last_local_call_time < CONCAT(DATE_ADD(NOW(), INTERVAL -$DLseconds SECOND),' ',CURTIME()) ) ) or (status NOT IN('DROP','XDROP')) )";
								}
				
							$sql="SELECT count(*) FROM vicidial_list where called_since_last_reset='N' and status IN($Dsql) and list_id IN($camp_lists) and ($all_gmtSQL) $DLTsql $fSQL";
							//echo $sql."--".$all_gmtSQL;
							$rslt=mysqli_query($db_conn,$sql);
							$rslt_rows = mysqli_num_rows($rslt);
							if ($rslt_rows)
								{
									$rowx=mysqli_fetch_row($rslt);
									$active_leads = "$rowx[0]";
								}
							else {$active_leads = '0';}
							 
							echo "<span style='color:#08d;' title='该活动中有$active_leads 个号码可以拨打！'>$active_leads</span>\n";
							}
						else{
							echo "<span style='color:#f80;'>该活动没有可用的拨号状态</span>\n";
						}
					}else{
						echo "<span style='color:#f80;'>该活动没有可用的客户清单</span>\n";
					}
				}else{
					echo "<span style='color:#f80;'>该活动没有可用的客户清单</span>\n";
				}
			}	  			
						
   	  ?>
       <span class="gray">激活：</span><?php
	  	if($active_lists>0){
	  		echo "<a href='javascript:void(0)' onclick=\"view_campaign_lead_list('campaign_lead_list','".$campaign_id."','Y');\" title='查看该业务所属激活的客户清单'>".$active_lists."</a>";
		}else{
			echo "<span style='color:#08d;'>".$active_lists."</span>";	
		}
	   ?>
      <span class="gray">，禁用：</span><?php
	  	if($inactive_lists>0){
 			echo "<a href='javascript:void(0)' onclick=\"view_campaign_lead_list('campaign_lead_list','".$campaign_id."','N');\" title='查看该业务所属未激活的客户清单'>".$inactive_lists."</a>";
		}else{
			echo "<span style='color:#08d;'>".$inactive_lists."</span>";	
		}
	   ?>
      </td>
    </tr>
    <tr>
      <td align="right">可呼叫号码：</td>
      <td align="left"><span class="gray">总数：</span><?php dialable_leads($local_call_time,$dial_statuses,$camp_lists,$drop_lockout_time,$fSQL) ?></span><span class="gray">，提取数：</span><?php
	  	if($hopper_leads>0){
 			echo "<a href='javascript:void(0)' onclick=\"view_campaign_hopper_list('campaign_lead_hopper_list','".$campaign_id."','N');\" title='查看该业务查看漏斗表中的号码'>".$hopper_leads."</a>";
		}else{
			echo "<span style='color:#08d;'>".$hopper_leads."</span>";	
		}
		echo "<span class='gray'>，今日成功：</span><span style='color:#08d;'>".$today_sale."</span>";
	   ?>
      </td>
      
    </tr>
  </table>
</fieldset>
    
  <fieldset><legend style="font-weight:normal">呼叫设置</legend>
  
<table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
    <tr >
      <td width="30%" align="right">呼叫模式：</td>
      <td align="left">
      	 <input type="hidden" name="old_dial_method" id="old_dial_method" value="<?php echo $dial_method ?>"/>
         <select name="dial_method" class="s_option" id="dial_method" >
         </select><span class="red">※</span><span class="gray">手动外呼请选：<strong>INBOUND_MAN</strong>，自动外呼请选：<strong>RATIO</strong></span>
        </td>
    </tr>
    <tr >
      <td align="right">自动拨号级别：</td>
      <td align="left">
        <select name="auto_dial_level" class="s_option" id="auto_dial_level">
        </select><span class="red">※</span><span class="gray">0为不使用自动呼叫,建议级别：<strong>1.8</strong>,请根据呼叫情况即时调节</span></td>
    </tr>
    <tr >
      <td align="right">最大丢弃率：</td>
      <td align="left">
      
      	<select name="adaptive_dropped_percentage" class="s_option" id="adaptive_dropped_percentage">
        <?php 
			$n=101;
			while ($n>0.1){
				if ($n <4 and $n>0.2 ){
					$n = ($n - 0.1);
				}elseif($n <0.2){
					$n=0.1;
				}else{
					$n--;
				}
 				
				echo "<option value='$n' >$n %</option>\n";
			 }
		 ?>
		</select><span class="gray">丢弃率=接通电话但未接通坐席数/接通总数</span>
      
      </td>
    </tr>
    <tr >
      <td align="right">呼叫超时时间： </td>
      <td align="left"><input maxlength="3" size="6" name="dial_timeout" id="dial_timeout" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" value="<?php echo $dial_timeout ?>"/><span class="red">※</span><span class="gray">单位：秒,数字越小呼叫速度越快,请根据呼叫接通率即时调节</span></td>
    </tr>
    <tr>
      <td align="right">拨号前缀：</td>
      <td align="left" style="line-height:16px">
      <span style="float:left;margin-top:14px"><input name="dial_prefix" id="dial_prefix" size="6" maxlength="6" onkeyup="value=value.replace(/[^\d|xX]/g,'')" onafterpaste="value=value.replace(/[^\d|xX]/g,'')" value="<?php echo $dial_prefix ?>"/></span>
      <span class="red fl" style="margin-top:14px">※</span><span class="gray fl" >1.本系统呼叫规则为前缀+被叫,如:4013589104688、413589104688、4053182371135.<br/>
    2.请根据被叫号是否带前导0设置,不可有两个0的情形,如：40013589104688、40053182371135.<br/>
    3.不加前缀请填大写X.</span> 
        </td>
    </tr>
    <tr >
      <td align="right">透传号码：</td>
      <td align="left"><input name="campaign_cid" id="campaign_cid" size="30" class="s_input" maxlength="20" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" onblur="this.value=this.value.replace(/\D/g,'');check_campaign_cid()" value="<?php echo $campaign_cid ?>"/><span class="red">※</span><span class="gray">请填写正常的手机、固话号码</span></td>
    </tr>
    <tr style="display:none">
      <td align="right">电话前缀：</td>
      <td align="left">
        <select name="omit_phone_code" class="s_option" id="omit_phone_code">
        	<option value="Y" selected="selected">省略</option>
            <option value="N">使用</option>
        </select><span class="red">※</span><span class="gray">是否使用086代码前缀，建议省略</span></td>
    </tr>
    <tr>
      <td align="right">可拨打状态：</td>
      <td align="left">
       
          <table border="0" cellpadding="2" cellspacing="0" class="dataTable" style="margin-top:4px; margin-bottom:4px;width:520px;" id="dial_status_list">
          <thead>
            <tr align="left" class="dataHead">
              <th style="font-weight:normal;width:70px" >状态码</th>
              <th style="font-weight:normal;width:360px">拨打状态</th>
              <th style="font-weight:normal;width:60px" >操作</th>
            </tr>
          </thead>
         
           <tbody>
             <tr id='status_list_NEW'><td><span class='green'>NEW</span></td><td><span style='color:#08d;'>未呼叫</span></td><td class='o_icos'><span onclick="do_set_dial_status('del','NEW');" title="删除该拨打状态"></span></td></tr>
           </tbody>
           
           <tfoot>
            <tr class='dataTableFoot'><td colspan='14' align='left'>
                <select name="dial_status" class="s_option" id="dial_status">                   
                </select>
                <input value="添加" type="button" name="do_dial_status" id="do_dial_status" onclick="do_set_dial_status('add')" /><span class="red">※</span><span class="gray">如做2次呼叫，建议<a href="javascript:void(0)" title="点击添加" onclick="do_set_dial_status('add','NA','N');do_set_dial_status('add','DROP','N');do_set_dial_status('add','B','N');">添加NA、DROP、B</a>状态</span>
              </td>
             </tr>
           </tfoot>
         </table>
       
      </td>
    </tr>
     
    <tr >
      <td width="30%" align="right">每次提取号码数量：</td>
      <td align="left">
        <select name="hopper_level" class="s_option" id="hopper_level">
          <option value="1">1</option>
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
          <option value="200" selected="selected">200</option>
          <option value="500">500</option>
          <option value="1000">1000</option>
          <option value="2000">2000</option>
          </select>
        </td>
    </tr>
    <tr >
      <td align="right">提取号码顺序：</td>
      <td align="left">
      	<select name="lead_order" class="s_option" id="lead_order">
 			<option value="DOWN" title="按号码编号正序 [DOWN]">按号码编号正序</option>
			<option value="UP" title="按号码编号倒序 [UP]">按号码编号倒序</option>
			<option value="DOWN PHONE" title="按号码正序 [DOWN PHONE]">按号码正序</option>
			<option value="UP PHONE" title="按号码倒序 [UP PHONE]">按号码倒序</option>
			<option value="DOWN LAST NAME" title="按客户姓名正序 [DOWN LAST NAME]">按客户姓名正序</option>
			<option value="UP LAST NAME" title="按客户姓名倒序 [UP LAST NAME]">按客户姓名倒序</option>
			<option value="DOWN COUNT" title="按呼叫次数正序 [DOWN COUNT]">按呼叫次数正序</option>
			<option value="UP COUNT" title="按呼叫次数倒序 [UP COUNT]">按呼叫次数倒序</option>
			<option value="RANDOM" title="按随机顺序 [RANDOM]">按随机顺序</option>
			<option value="DOWN LAST CALL TIME" title="按最后呼叫时间正序 [DOWN LAST CALL TIME]">按最后呼叫时间正序</option>
			<option value="UP LAST CALL TIME" title="按最后呼叫时间倒序 [UP LAST CALL TIME]">按最后呼叫时间倒序</option>
			<option value="DOWN RANK" title="按号码级别正序 [DOWN RANK]">按号码级别正序</option>
			<option value="UP RANK" title="按号码级别倒序 [UP RANK]">按号码级别倒序</option>
			<option value="DOWN OWNER" title="按号码所有者正序 [DOWN OWNER]">按号码所有者正序</option>
			<option value="UP OWNER" title="按号码所有者倒序 [UP OWNER]">按号码所有者倒序</option>
			<option value="DOWN TIMEZONE" title="按时区正序 [DOWN TIMEZONE]">按时区正序</option>
			<option value="UP TIMEZONE" title="按时区倒序 [UP TIMEZONE]">按时区倒序</option>
			 
		</select><span class="gray"></span>
       </td>
    </tr>
    
    <tr>
      <td align="right">每天最大成功数：</td>
      <td align="left" style="line-height:16px">
      	<span class="fl" style="margin-top:6px">
      	 <select name="sale_alt_type" class="s_option" id="sale_alt_type" onchange="do_set_sale_alt_num(this.value)">
         	<option value="NONE">不限制</option>
            <option value="cam" title="按照整个业务活动限制每天最大可成功数">按整个业务限定</option>
            <option value="list" title="每个客户清单每天最大成功数，超过该值系统禁用该清单呼叫下一个清单内号码">按每客户清单限定</option>
         </select>
      	 <input name="sale_alt_num" id="sale_alt_num" value="0" maxlength="5" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" onblur="this.value=this.value.replace(/\D/g,'');" title="设置每天最多成功数量,超过该值系统停止外呼"/>
         </span>
      	 <span class="gray fl">设置每天最多成功数量,超过该值系统停止外呼,<strong>0</strong>为不限制.<br />请注意:因呼叫并发的存在,实际成功数可能会有超出.</span>
        </td>
    </tr>
      
  </table>
  </fieldset>
  
  
  <fieldset><legend style="font-weight:normal">话术脚本设置</legend>
  
    <table width="100%" cellpadding="0" cellspacing="0" class="td_underline">    
     <tr >
      <td width="30%" align="right">话术脚本：</td>
      <td align="left">
        <select name="campaign_script" class="s_option" id="campaign_script">
          <option value="NONE">未设置</option>
          <option value="XXXXXNONE" disabled="disabled">------------------------</option> 
        </select><span class="gray">显示指定脚本内容</span>
        </td>
    </tr>
    <tr >
      <td align="right">进线动作：</td>
      <td align="left">
      	<select name="get_call_launch" class="s_option" id="get_call_launch">
          <option value="NONE">未设置</option>
          <option value="XXXXXNONE" disabled="disabled">------------------------</option>
          <option value="SCRIPT">显示脚本</option>
          <option value="WEBFORM">打开指定问卷调查</option>
          <option value="WEBFORMTWO">打开指定网页表单二</option>
        </select><span class="gray">外拨、来电后显示脚本、指定问卷</span>
        </td>
    </tr>
    <tr >
      <td align="right">问卷调查：</td>
      <td align="left">
      <select id="web_form_address" name="web_form_address" class="s_option">
          <option value="">未设置</option>
          <option value="XXXXXNONE" disabled="disabled">------------------------</option>
      </select></td>
    </tr>
    <tr>
      <td align="right">网页表单二：</td>
      <td align="left"><input maxlength="1055" size="50" name="web_form_address_two" id="web_form_address_two"  value="<?php echo $web_form_address_two ?>"/><span class="gray">复制网页表单二地址到本处</span></td>
    </tr>     
  </table>
     
  </fieldset>

  <fieldset><legend style="font-weight:normal">其他设置</legend>
  
    <table width="100%" cellpadding="0" cellspacing="0" class="td_underline">    
	<tr >
      <td align="right">派话规则：</td>
      <td align="left">
      
      	<select name="next_agent_call" class="s_option" id="next_agent_call">
            <option value="random">随机</option>
            <option value="oldest_call_start">呼叫开始时长最大</option>
            <option value="oldest_call_finish" selected="selected">呼叫完成时长最大</option>
            <option value="overall_user_level">坐席总体级别</option>
            <option value="campaign_rank">业务活动权重</option>
            <option value="fewest_calls">最少呼叫量</option>
            <option value="longest_wait_time">最长等待时间</option>
         </select>
      </td>
    </tr>
    <tr class="" >
      <td align="right">业务活动话务时间：</td>
      <td align="left">
      	 <select name="local_call_time" class="s_option" id="local_call_time">
           <option value="NONE">未设置</option>
           <option value="XXXXXNONE" disabled="disabled">------------------------</option>
         </select><span class="gray">在选定话务时间段内可使用</span>
        </td>
    </tr>
    
    <tr>
      <td width="30%" align="right">客户挂断继续录音：</td>
      <td align="left">
        <select name="hangup_stop_rec" class="s_option" id="hangup_stop_rec">
            <option value="conf">继续录音</option>
            <option value="stop">停止录音</option> 
            
         </select><span class="gray">是否在客户挂断后继续录音</span>
        </td>
    </tr>
    <tr>
      <td width="30%" align="right">客户清单过滤规则：</td>
      <td align="left">
        <select name="lead_filter_id" class="s_option" id="lead_filter_id">
            <option value="NONE">未设置</option>
            <option value="XXXXXNONE" disabled="disabled">------------------------</option>
         </select><span class="gray">设定客户清单号码选取条件</span>
        </td>
    </tr>
    <tr >
      <td align="right">手动拨号过滤规则：</td>
      <td align="left">
          <select name="manual_dial_filter" class="s_option" id="manual_dial_filter">
              <option value="NONE">未指定</option>
              <option value="XXXXXNONE" disabled="disabled">------------------------</option>
              <option value="DNC_ONLY">系统黑名单</option>
              <option value="CAMPLISTS_ONLY">本业务黑名单</option>
              <option value="DNC_AND_CAMPLISTS">系统和业务黑名单</option>
          </select><span class="gray">设定手动外呼黑名单校验规则</span>
      </td>
    </tr>
    
    
    <tr >
      <td align="right">号码拥有者才能拨打：</td>
      <td align="left">
        <select name="agent_dial_owner_only" class="s_option" id="agent_dial_owner_only">
          <option value="NONE" selected="selected">未设置</option>
          <option value="XXXXXNONE" disabled="disabled">------------------------</option>
          <option value="USER">原拨打工号或导入时指定工号</option>
          <option value="TERRITORY">原拨打工号指定</option>
          <option value="USER_GROUP">原拨打工号所属坐席组</option>
         
        </select>
        </td>
    </tr>
    
    <tr class="dis_none">
        <td align="right">显示可拨打号码数量：</td>
        <td align="left">
        <select name="agent_display_dialable_leads" class="s_option" id="agent_display_dialable_leads">
        	
            <option value="Y">启用</option>
            <option value="N" selected="selected">禁用</option>
         </select>
         </td>
      </tr>
      
      <tr class="dis_none">
        <td align="right">显示电话队列数量：</td>
        <td align="left">
        <select name="display_queue_count" class="s_option" id="display_queue_count">
          <option selected="selected" value="Y">启用</option>
          <option value="N">禁用</option>
          
        </select></td>
      </tr>
      <tr style="display:none">
        <td align="right">显示队列电话数量：</td>
        <td align="left"><select name="view_calls_in_queue" class="s_option" id="view_calls_in_queue">
          <option value="NONE" selected="selected">未设置</option>
          <option value="XXXXXNONE" disabled="disabled">------------------------</option>
          <option value="ALL">显示全部</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
           
        </select></td>
      </tr>
      <tr style="display:none">
        <td align="right">显示队列电话方式：</td>
        <td align="left">
        <select name="view_calls_in_queue_launch" class="s_option" id="view_calls_in_queue_launch">
          <option selected="selected" value="MANUAL">手动</option>

          <option value="AUTO">自动</option>
         </select>
        </td>
      </tr>
      
      
    <tr >
      <td align="right">提交结束后自动暂停：</td>
      <td align="left">
      	 <select name="pause_after_each_call" class="s_option" id="pause_after_each_call">
        	<option value="N" selected="selected">禁用</option>
          	<option value="Y">启用</option>
         </select>
        </td>
    </tr>
   <tr >
      <td align="right">强制坐席选择暂停原因：</td>
      <td align="left">
      	 <select name="agent_pause_codes_active" class="s_option" id="agent_pause_codes_active">
        	<option value="N" selected="selected">禁用</option>
          	<option value="FORCE">启用</option>
         </select><span class="gray">是否在坐席暂停时显示暂停原因选项</span>
        </td>
    </tr> 
    <tr >
      <td align="right">显示被叫电话DTMF按键：</td>
      <td align="left">
      	 <select name="display_dtmf_alter" class="s_option" id="display_dtmf_alter">
        	<option value="N">禁用</option>
          	<option value="Y">启用</option>
         </select><span class="gray"></span>
        </td>
    </tr>  
  </table>
 </fieldset>
  
    <fieldset><legend style="font-weight:normal">客户清单列表</legend>
            <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
                  <thead>
                    <tr align="left" class="dataHead">
                                  
                      <th sort="a.list_id" >清单ID</th>
                      <th sort="list_name" >清单名称</th>
                      <th sort="list_description">清单描述</th>
                      <th sort="counts">号码数量</th>
                      <th sort="sale_num">今日成功数</th>
                      <th sort="active" >激活</th>
                      <th sort="list_lastcalldate">最后话务时间</th>  
                      <th >操作</th>  
                     </tr>
                  </thead>   
                    <tbody>
                    </tbody>
                    <tfoot><tr class='dataTableFoot'><td colspan='15' align='left'><div id='dataTableFoot'><div style='float:right;' id='pagelist'></div><div style='float:left;' id='total'></div></div></td></tr></tfoot>
              </table>
           
       </fieldset>    
              
      </form>
 
    
      
</div>
  
<?php 

break;

//复制活动
case "copy_campaign":
?>
<script>

function do_copy_campaign(){
	
	if($("#source_campaign_id").val() == ""){
		alert("请选择来源活动！");
		$("#source_campaign_id").focus();
		return false;
	}	
	
	if($("#campaign_id").val() == ""){
		alert("请填写活动ID号！");
		$("#campaign_id").focus();
		return false;
	}else if($("#campaign_id").val().length>8||$("#campaign_id").val().length<2){
		alert("活动ID位数必须介于2-8位字符之间！");
		$("#campaign_id").select();
		return false;
	}
	
	if($("#campaign_name").val() == ""){
		alert("请填写活动名称！");
		$("#campaign_name").focus();
		return false;
	}else if($("#campaign_name").val().length>20||$("#campaign_name").val().length<2){
		alert("活动名称位数必须介于2-20位字符之间！");
		$("#campaign_name").select();
		return false;
	}
	
  	$('#load').show();
	var datas="action=campaign_set&do_actions=copy&"+$('#form1').serialize()+times;
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

 
//获取活动列表
function get_campaign_list(){
	if($("#get_source_campaign_id").val()=="0"){
		var datas="action=get_campaigns_list"+times;
		//alert(datas);
		$.ajax({
 			url: "send.php",
			data:datas,
 			success: function(json){ 
 				
				$.each(json.datalist,function(index,con){
					opt_list="";
					group_val="";
					o_val=con.o_val;
					o_name=con.o_name;
					 
					$.each(con.o_c_list, function(f_i,con_f){
						c_o_val=con_f.o_val;
						c_o_name=con_f.o_name;
						 
						opt_list+="<option value='"+c_o_val+"' title='"+c_o_name+" "+c_o_val+"' name='"+c_o_name+"' des='"+c_o_name+"'>"+c_o_val+" ["+c_o_name+"]</option>";
						 
					});
					if(opt_list!=""){
						 
						$("#source_campaign_id").append("<optgroup label='"+o_name+"' title='"+o_name+"'>"+opt_list+"</optgroup>");
					}
				});
			}
		});
	}
} 

function copy_set(select_val){
	 
	$("#campaign_description").val($("#source_campaign_id option[value='"+select_val+"']").attr("des"));
	$("#campaign_name").val($("#source_campaign_id option[value='"+select_val+"']").attr("name"));
}
 
$(document).ready(function(){
	get_campaign_list();
});
</script>
<div class="page_nav">
     <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
     <div class="nav_">当前位置：<a href="javascript:void(0);">业务活动管理</a> &gt; <?php echo $tits ?></div>
     <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
 
</div>

<div class="page_main" >
<input type="hidden" value="0" id="get_source_campaign_id" name="get_source_campaign_id" />
<fieldset ><legend> <?php echo $tits ?> </legend>
<form action="" method="post" name="form1" id="form1">

  <table width="100%" border="0" cellpadding=2 cellspacing=0 class="td_underline" >
    <tr>
       <td  align="right" nowrap="nowrap">来源活动：</td>
       <td align="left">
       
       <select name="source_campaign_id" id="source_campaign_id" onchange="copy_set(this.value)" class="s_option" >
        <option value=''>请选择来源业务活动</option>
        </select>
       <span class="red">※</span><span class="gray">来源活动的所有配置将被复制</span>
       </td>
     </tr>
     <tr>
       <td width="20%"  align="right" nowrap="nowrap">活动ID：</td>
       <td align="left"><input maxlength="8" size="30" class="s_input" name="campaign_id" id="campaign_id" onkeyup="this.value=value.replace(/[^\w\/]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/]/ig,'')" onblur="this.value=value.replace(/[^\w\/]/ig,'');check_campaign()"/><span class="red">※</span><span class="gray">数字、英文组合,最长8位</span></td>
     </tr>
     <tr>
       <td  align="right" nowrap="nowrap">活动名称：</td>
       <td align="left"><input maxlength="30" size="30" class="s_input" name="campaign_name" id="campaign_name"/><span class="red">※</span></td>
     </tr>
     <tr>
       <td  align="right" nowrap="nowrap">活动描述：</td>
       <td align="left"><input maxlength="255" size="30" class="s_input" name="campaign_description" id="campaign_description"/></td>
     </tr>
        
</table>
</form>
</fieldset>      
      
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
  
	var url="action=get_campaign_leads_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&campaign_id="+$("#campaign_id").val()+"&list_active="+$("#list_active").val()+times;
 	
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
	
	var url="action=get_campaign_leads_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&campaign_id="+$("#campaign_id").val()+"&list_active="+$("#list_active").val()+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times;
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
					 
					dblclick=" ondblclick='edit_list(\""+con.list_id+"\")' ";
					do_edit="<a href='javascript:void(0)' onclick='edit_list(\""+con.list_id+"\")'>修改</a>";
  					list_lastcalldate=con.list_lastcalldate;
					if(!list_lastcalldate){
						list_lastcalldate="";	
					}
					
					tr_str="<tr align=\"left\" id=\"leads_list_"+con.list_id+"\" "+dblclick+">";
 					tr_str+="<td>"+con.list_id+"</td>";
					tr_str+="<td title='"+con.list_name+"'><div class='hide_tit'>"+con.list_name+"</div></td>";
					tr_str+="<td>"+con.list_description+"</td>";
					tr_str+="<td>"+con.counts+"</td>";
					tr_str+="<td><span class='red'>"+con.sale_num+"</span></td>";
					tr_str+="<td>"+con.active+"</td>";
					tr_str+="<td>"+list_lastcalldate+"</td>";
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
if($campaign_id!=""){
?>	
 	var Sorts_Order=0;
	$("#datatable .dataHead th[sort]").map(function(){
		Sorts_Order=Sorts_Order+1;
		
		html=$(this).html();
		
		$(this).attr("id","DadaSorts_"+Sorts_Order).off().on("click",function(){
			Sorts_new("datatable",$(this).attr("id"),$("#pagesize").val());	
		}).html("<div>"+html+"<span class='sorting'></span></div>");
		
 	}) ;
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="12"/> <input name="sorts" type="hidden" id="sorts" value="campaign_id"/> <input name="order" type="hidden" id="order"/>').appendTo("body");
	
	GetPageCount('search',"count");
	get_datalist(1,"search","list",$('#pagesize').val());
<?php 
}else {
	echo '$("#form1").html("");Dialog.alert("该业务活动不存在，请检查后重试！");';
}
 ?>	 
});
</script>
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">业务活动管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
<input type="hidden" name="list_active" id="list_active" value="<?php echo $list_active ?>" />
<input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $campaign_id ?>" />
<fieldset ><legend> <?php echo $tits ?> </legend>
     <form action="" method="post" name="form1" id="form1">
                
    <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
          <thead>
            <tr align="left" class="dataHead">
                          
              <th sort="a.list_id" >清单ID</th>
              <th sort="list_name" >清单名称</th>
              <th sort="list_description">清单描述</th>
              <th sort="counts">号码数量</th>
              <th sort="sale_num">今日成功数</th>
              <th sort="active">激活</th>
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

//活动漏斗表提取号码列表
case "campaign_lead_hopper_list":
?>
<script>

function GetPageCount(a_ctions,doa_ctions){
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
  
	var url="action=get_campaign_lead_hopper_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&campaign_id="+$("#campaign_id").val()+times;
 	
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
	
	var url="action=get_campaign_lead_hopper_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&campaign_id="+$("#campaign_id").val()+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times;
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
if($campaign_id!=""){
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
	echo '$("#form1").html("");Dialog.alert("该业务活动不存在，请检查后重试！");';
}
 ?>	 
});
</script>
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">业务活动管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
      	<input type="hidden" name="list_active" id="list_active" value="<?php echo $list_active ?>" />
        <input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $campaign_id ?>" />
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
 
//复制活动
case "add_pause_code":
?>
<script>
function check_pause_code(){
	pause_code=$("#pause_code").val()
	if(pause_code!=""){
		
		if(pause_code.length>9||pause_code.length<2){
			 
			request_tip("暂停原因ID位数必须介于2-8位字符之间！",0);
			$("#pause_code").select();
			return false;
		}
		
		if(/[\d]/.test(parseFloat(pause_code))){
			 
			request_tip("暂停原因ID不能为纯数字！",0);
			$("#pause_code").select();
			return false;
		}
  		
		var datas="action=check_pause_code&pause_code="+$("#pause_code").val()+times;
		$.ajax({
			 
			url:"send.php",
			data:datas,
			
			async:false,
			success: function(json){
			   if(json.counts!="1"){
					request_tip(json.des,json.counts);
					$("#pause_code").select();
					return false;
			   }
			} 
		});
	}
}

function do_add_pause_code(){
 	pause_code=$("#pause_code").val();
	pause_code_name=$("#pause_code_name").val();
	if(pause_code == ""){
		alert("请填写暂停原因ID号！");
		$("#pause_code").focus();
		return false;
	}else if(pause_code.length>8||pause_code.length<2){
		alert("暂停原因ID位数必须介于2-8位字符之间！");
		$("#pause_code").select();
		return false;
	}else if(/[\d]/.test(parseFloat(pause_code))){
		alert("暂停原因ID不能为纯数字！");
		$("#pause_code").select();
		return false;
	}
	
	if(pause_code_name == ""){
		alert("请填写暂停原因名称！");
		$("#pause_code_name").focus();
		return false;
	}else if(pause_code_name.length>14||pause_code_name.length<2){
		alert("暂停原因名称位数必须介于2-14位字符之间！");
		$("#pause_code_name").select();
		return false;
	}else if(/[\d]/.test(parseFloat(pause_code_name))){
		alert("暂停原因名称不能为纯数字！");
		$("#pause_code_name").select();
		return false;
	}
	
  	$('#load').show();
	var datas="action=pause_code_set&do_actions=add&"+$('#form1').serialize()+times;
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
  
</script>
    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">业务活动管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
      
        <fieldset ><legend> <?php echo $tits ?> </legend>
     		 <form action="" method="post" name="form1" id="form1">
 			
                  <table width="100%" border="0" cellpadding=2 cellspacing=0 class="td_underline" >
                     <tr>
                       <td width="20%"  align="right" nowrap="nowrap">暂停原因ID：</td>
                       <td align="left"><input maxlength="8" size="30" class="s_input" name="pause_code" id="pause_code" onkeyup="this.value=value.replace(/[^\w\/]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/]/ig,'')" onblur="this.value=value.replace(/[^\w\/]/ig,'');check_pause_code()"/>
                         <span class="red">※</span><span class="gray">英文、数字组合,不能为纯数字,最长8位</span></td>
                     </tr>
                     <tr>
                       <td  align="right" nowrap="nowrap">暂停原因名称：</td>
                       <td align="left"><input maxlength="14" size="30" class="s_input" name="pause_code_name" id="pause_code_name"/>
                         <span class="red">※</span><span class="gray">汉字、英文组合,不能为纯数字,最长14位</span></td>
                     </tr>
                        
                </table>
          </form>
      </fieldset>      
      
</div>
 
<?php
break;


case "edit_pause_code":
?>
<?php

$sql="select pause_code,pause_code_name  from vicidial_pause_codes where pause_code='".$pause_code."' ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);

$script_arr=array();
 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
  		$pause_code_name=$rs["pause_code_name"];
 		$pause_code=$rs["pause_code"];
 		 
     }
 	echo "<script>
$(document).ready(
	function(){
 	$('.td_underline tr:visible:odd').addClass('alt');
 
});
</script>";
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("该暂停原因不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>

<script>
  
function do_edit_pause_code(){
	 
	var pause_code_name=$("#pause_code_name").val();
	if(pause_code_name == ""){
		alert("请填写暂停原因名称！");
		$("#pause_code_name").focus();
		return false;
	}else if(pause_code_name.length>14||pause_code_name.length<2){
		alert("暂停原因名称位数必须介于2-14位字符之间！");
		$("#pause_code_name").select();
		return false;
	}else if(/[\d]/.test(parseFloat(pause_code_name))){
		alert("暂停原因名称不能为数字！");
		$("#pause_code_name").select();
		return false;
	}
   
	$('#load').show();
	var datas="action=pause_code_set&do_actions=update&"+$('#form1').serialize()+times;
   	 
 	//alert(datas);
   	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){
			$('#load').css("top",$(document).scrollTop()).show('100');
  		},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		
		 request_tip(json.des,json.counts);
 		 _DialogInstance.ParentWindow.request_tip(json.des,json.counts);
		 if(json.counts=="1"){
			
			$(_DialogInstance.ParentWindow.document).find("#pause_code_list_<?php echo $pause_code ?> td").eq(2).attr("title",pause_code_name).html("<span class='green'>"+pause_code_name+"</span>");
  
 			setTimeout('Dialog.close();',10);
			
		  }else{
			  alert(json.des);
		  }
			 
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
	 
}
 </script>
 

    <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">业务活动管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main" >
      <fieldset >
      <legend ><?php echo $tits ?></legend>
 <form action="" method="post" name="form1" id="form1">
<input type="hidden" name="pause_code" id="pause_code" value="<?php echo $pause_code ?>" />
  
   <table width="100%" border="0" cellpadding=2 cellspacing=0 class="td_underline" >
         <tr>
           <td width="20%"  align="right" nowrap="nowrap">暂停原因ID：</td>
           <td align="left"><strong class="blue"><?php echo $pause_code ?></strong></td>
         </tr>
         <tr>
           <td  align="right" nowrap="nowrap">暂停原因名称：</td>
           <td align="left"><input maxlength="14" size="30" class="s_input" name="pause_code_name" id="pause_code_name" value="<?php echo $pause_code_name ?>"/><span class="red">※</span><span class="gray">汉字、英文组合,不能为纯数字,最长14位</span></td>
         </tr>
            
    </table>
  
</form>
    
 </fieldset>
    
      
</div>
  
<?php 
break;
  
case "add_data_dic":
?>
<script src="/js/jquery.tablednd.0.7.min.js"></script>
<script>
  
function do_add_data_dic(){
	
	var dic_id=$("#dic_id").val();
	var dic_name=$("#dic_name").val();
	
	if(dic_id == ""){
		alert("请填写字典ID号！");
		$("#dic_id").focus();
		return false;
	}else if(dic_id.length>10||dic_id.length<2){
		alert("字典ID位数必须介于2-10位字符之间！");
		$("#dic_id").select();
		return false;
	}
	
	if(dic_name == ""){
		alert("请填写字典名称！");
		$("#dic_name").focus();
		return false;
	}else if(dic_name.length>20||dic_name.length<2){
		alert("字典名称位数必须介于2-20位字符之间！");
		$("#dic_name").select();
		return false;
	}
	
	var form_value="";
 	$('#form1 input[name="dic_list_name"]').each(function(i){
		var v_n=$(this).val();
		if(v_n!=""&&v_n!=undefined){
			var fid=$(this).attr("fid");
			v_id="dic_list_val_"+fid;
			d_id="dic_list_def_"+fid;
			
			if($("#"+d_id).is(":checked")==true){
				d_v=$("#"+d_id).val();
			}else{
				d_v="N"
			}
			
			form_value+=v_n+"#_#"+$("#"+v_id).val()+"#_#"+d_v+"|";
		 
 		}
 	}); 
	
	if(form_value!=""&&form_value.substr(form_value.length-1)=="|"){
		form_value=form_value.substr(0,form_value.length-1);
	}
  	
 	$("#form_list").val(form_value);
 	
	$('#load').show();
	var datas="action=data_dic_set&do_actions=add&"+$('#form1').serialize()+times;
 	
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
	order_datatable_();
	
	$("#datatable").tableDnD({
 	    onDrop: function(table, row) {
 			order_datatable_();
	    } 
	});
 	 
});
 
</script>
<div id="auto_save_res" class="load_layer"></div>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">数据字典管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
</div>

<div class="page_main" >
<input name="form_index" type="hidden" id="form_index"  value="1" /> 
<input type="hidden" name="get_lay_2" id="get_lay_2" value="0"/>

<div id="opt_layer_1" class="opt_f_list">

  <div class="head"><strong class="">&nbsp;批量添加选项</strong><span class="font_14 font_w red" style="margin:0 6px 0 6px" id="bat_add_c">0</span>个 <a href='javascript:void(0)' hidefocus='true' class="close" title="关闭" onclick="javascript:$('#opt_layer_1').fadeOut()"></a></div>
  <div id="opt_layer_1_list">
     <div style="line-height:20px;margin-bottom:4px">按选项名称->选项值->默认(可选) 排列，例如：<a href='javascript:void(0)'>汽车名|汽车值|是</a><br />不加默认值请写：<a href='javascript:void(0)'>汽车名</a> 或 <a href='javascript:void(0)'>汽车名|汽车值</a> 各项之间用 <span class="red">|</span> 号分隔</div>
     <textarea name="bat_val_list" id="bat_val_list" cols="45" rows="5" style="width:97%;height:110px;" onchange='$("#bat_add_c").html($(this).val().split("\n").length);'></textarea>
  </div>
  <div class="bottom">
    <input type="button" name="" value="确定添加" onclick="set_dic_list_form('bat_add','-1','0');" title="点击确定批量添加选项" />
    <span style="margin-right:4px">
    <input type="button" name="" value="关 闭" onclick="javascript:$('#opt_layer_1').fadeOut()" />
    </span></div>

</div>
            
<fieldset ><legend ><?php echo $tits ?></legend>
 <form action="" method="post" name="form1" id="form1">
    <input name="form_list" id="form_list" type="hidden" value="" />
  
    <table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
        <tr >
          <td width="20%" align="right">字典ID：</td>
          <td align="left"><input maxlength="10" size="30" class="s_input" name="dic_id" id="dic_id" onkeyup="this.value=value.replace(/[^\w\/_]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/_]/ig,'')" onblur="this.value=value.replace(/[^\w\/_]/ig,'');check_dic_id()"/><span class="red">※</span><span class="gray">数字、英文、下划线组合,最长10位</span></td>
        </tr>
        <tr >
          <td align="right">字典名称：</td>
          <td align="left"><input maxlength="20" size="30" class="s_input" name="dic_name" id="dic_name"/><span class="red">※</span><span class="gray">最长20位</span></td>
        </tr>
        <tr >
          <td align="right">字典描述：</td>
          <td align="left"><input maxlength="36" size="30" class="s_input" name="dic_des" id="dic_des"/></td>
        </tr>
        <tr >
          <td align="right">字典数值：</td>
          <td align="left" id="form_table">
            
           <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
              <thead>
                <tr align="left" class="dataHead">
                    <th >编号 <strong style="font-weight:normal;color:#F00" id="dic_index_c">0</strong></th>
                    <th >选项名称</th>
                    <th >选项数值</th>
                    <th >默认选中</th>
                    <th width="14%" >操作</th>
                 </tr>
              </thead>   
                <tbody>
                	<tr id="dic_list_1">
                	  <td>1</td>
                    	<td><input type="text" name="dic_list_name" id="dic_list_name_1" maxlength="360" size="32" class="form_val_" fid="1"/></td>
                        <td><input type="text" name="dic_list_val" id="dic_list_val_1" maxlength="360" size="32" class="form_val_" fid="1"/></td>
                        <td><input type="checkbox" name="checkbox" id="checkbox" /></td>
                        <td class='o_icos'><span class='add' onclick="set_dic_list_form('add','1','0');" title='点击添加一项'> </span> <span class='up_e' onclick="set_dic_list_form('up','0','1')" title='点击向上排序'> </span> <span class='dw_e' onclick="set_dic_list_form('dw','0','1')" title='点击向下排序'> </span> <span onclick="set_dic_list_form('del','0','1');" title='点击删除'> </span></td>
                    </tr>
                	 
                </tbody>
                <tfoot>
               	   
                    <tr class='dataTableFoot'><td colspan='10' align='left'><a href="javascript:void(0)" onclick="set_dic_list_form('add','-1','0');" title="点击添加一列选项值">添加一项</a>  <a href="javascript:void(0)" title="点击批量添加选项值" onclick="bat_add_list()">批量添加</a></td></tr>
                </tfoot>
          </table>
           
          </td>
        </tr>
        
    </table>
 
 </form>
</fieldset>
       
</div>

<?php 

break;

//复制数据字典
case "copy_data_dic":
?>
<script>

function do_copy_data_dic(){
	
	var dic_id=$("#dic_id").val();
	var dic_name=$("#dic_name").val();
	
	if(dic_id == ""){
		alert("请填写字典ID号！");
		$("#dic_id").focus();
		return false;
	}else if(dic_id.length>10||dic_id.length<2){
		alert("字典ID位数必须介于2-10位字符之间！");
		$("#dic_id").select();
		return false;
	}
	
	if(dic_name == ""){
		alert("请填写字典名称！");
		$("#dic_name").focus();
		return false;
	}else if(dic_name.length>20||dic_name.length<2){
		alert("字典名称位数必须介于2-20位字符之间！");
		$("#dic_name").select();
		return false;
	}
	
  	$('#load').show();
	var datas="action=data_dic_set&do_actions=copy&"+$('#form1').serialize()+times;
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
  
//获取活动列表
function get_dic_id_list(){
	if($("#get_source_dic_id").val()=="0"){
		var datas="action=get_dic_id_list"+times;
		 
		$.ajax({
 			url: "send.php",
			data:datas,
 			success: function(json){ 
 				opt_list="";
				$.each(json.datalist, function(f_i,con_f){
					c_o_val=con_f.o_val;
					c_o_name=con_f.o_name;
					 
					opt_list+="<option value='"+c_o_val+"' title='"+c_o_name+"' name='"+c_o_name+"' des='"+c_o_name+"'>"+c_o_name+" ["+c_o_val+"]</option>";
					 
				});
					 
				$("#source_dic_id").append(opt_list);
 			 
			}
		});
	}
} 

function copy_set(select_val){
	 
	$("#dic_des").val($("#source_dic_id option[value='"+select_val+"']").attr("des"));
	$("#dic_name").val($("#source_dic_id option[value='"+select_val+"']").attr("name")+"-2");
}
 
$(document).ready(function(){
	get_dic_id_list();
});
</script>
<div class="page_nav">
     <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
     <div class="nav_">当前位置：<a href="javascript:void(0);">业务活动管理</a> &gt; <?php echo $tits ?></div>
     <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
 
</div>

<div class="page_main" >
<input type="hidden" value="0" id="get_source_dic_id" name="get_source_dic_id" />
<fieldset ><legend> <?php echo $tits ?> </legend>
<form action="" method="post" name="form1" id="form1">

  <table width="100%" border="0" cellpadding=2 cellspacing=0 class="td_underline" >
    <tr>
       <td  align="right" nowrap="nowrap">数据字典：</td>
       <td align="left">
       
       <select name="source_dic_id" id="source_dic_id" onchange="copy_set(this.value)" >
        <option value=''>请选择来源数据字典</option>
        </select>
       <span class="red">※</span><span class="gray">数据字典的所有子项将被复制</span>
       </td>
     </tr>
     <tr>
       <td width="20%"  align="right" nowrap="nowrap">字典ID：</td>
       <td align="left"><input maxlength="8" size="30" class="s_input" name="dic_id" id="dic_id" onkeyup="this.value=value.replace(/[^\w\/]/ig,'')" onafterpaste="this.value=value.replace(/[^\w\/]/ig,'')" onblur="this.value=value.replace(/[^\w\/]/ig,'');check_dic_id()"/><span class="red">※</span><span class="gray">数字、英文组合,最长8位</span></td>
     </tr>
     <tr>
       <td  align="right" nowrap="nowrap">字典名称：</td>
       <td align="left"><input maxlength="20" size="30" class="s_input" name="dic_name" id="dic_name"/><span class="red">※</span><span class="gray">最长20位</span></td>
     </tr>
     <tr>
       <td  align="right" nowrap="nowrap">字典描述：</td>
       <td align="left"><input maxlength="36" size="30" class="s_input" name="dic_des" id="dic_des"/></td>
     </tr>
        
</table>
</form>
</fieldset>      
      
</div>
 
<?php
break; 
   
   
case "edit_data_dic":
  
$sql="select dic_id,dic_name,dic_des from data_dic where dic_id='".$dic_id."'  ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);
  
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
  		$dic_id=$rs["dic_id"];
 		$dic_name=$rs["dic_name"];
 		$dic_des=$rs["dic_des"];
    }
 	echo "<script>$(document).ready(
	function(){
    		 
  		$('.td_underline tr:visible:odd').addClass('alt');		 
		get_dic_list();
   	});
</script>";
 	
}else {
  	echo '<script>$(document).ready(function(){$("#form1").html("");Dialog.alert("该数据字典不存在，请检查后重试！");});</script>';
}
mysqli_free_result($rows);
   
?>

<script src="/js/jquery.tablednd.0.7.min.js"></script>
<script>

function get_dic_list(){
	
	$('#load').show();
	var datas="action=get_dic_list&dic_id="+$('#dic_id').val()+times;
   	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
 		   if(json.counts=="1"){
			   
				$("#datatable tbody tr").remove();
				var tr_str="",form_select="",insert_="";
				$.each(json.datalist,function(index,con){
					index++;
					is_checked="";
 					
					if(con.dic_list_def&&(con.dic_list_def=="是"||con.dic_list_def=="Y"||con.dic_list_def=="y")){
						is_checked=" checked ";
					}
					
					tr_str="<tr align=\"left\" id=\"dic_list_"+index+"\" class=\"v_b_l\"; nowrap><td>"+index+"</td><td><input type=\"text\" name=\"dic_list_name\" id=\"dic_list_name_"+index+"\" maxlength=\"28\" size=\"32\" class=\"form_val_\" fid=\""+index+"\" value=\""+con.dic_list_name+"\" /></td><td><input type=\"text\" name=\"dic_list_val\" id=\"dic_list_val_"+index+"\" maxlength=\"28\" size=\"32\" class=\"form_val_\" value=\""+con.dic_list_val+"\"/></td><td><input type=\"checkbox\" name=\"dic_list_def\" id=\"dic_list_def_"+index+"\" value=\"Y\" "+is_checked+"/></td><td class='o_icos'><span class='add' onclick=\"set_dic_list_form('add','"+index+"','0');\"></span><span class='up_e' onclick=\"set_dic_list_form('up','0','"+index+"')\"></span><span class='dw_e' onclick=\"set_dic_list_form('dw','0','"+index+"')\"></span><span onclick=\"set_dic_list_form('del','0','"+index+"');\"></span></td></tr>";
					$("#datatable tbody").append(tr_str);
					
				});
 			   
				$("#datatable tbody input[type='text']").addClass("inputText").hover(function(){if($(this).hasClass("input_focus")==false){$(this).addClass("inputTextHover")}},function(){$(this).removeClass("inputTextHover")}).focus(function(){$(this).removeClass("inputText inputTextHover input_focus").addClass("input_focus")}).blur(function(){$(this).addClass("inputText").removeClass("input_focus inputTextHover")});
 			 	tr_length=json.datalist.length;
				$("#form_index").val(tr_length);
  				$("#dic_index_c").html(tr_length);
 				
				$("#datatable").tableDnD({
					onDrop: function(table, row) {
						order_datatable_();
					} 
				});
	
		   }else{
			   set_dic_list_form('add','-1','0');
		   }
		   order_datatable_();
 		  
 		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
}  

function do_edit_data_dic(){
	
	var dic_id=$("#dic_id").val();
	var dic_name=$("#dic_name").val();
 	 
	if(dic_name == ""){
		alert("请填写字典名称！");
		$("#dic_name").focus();
		return false;
	}else if(dic_name.length>20||dic_name.length<2){
		alert("字典名称位数必须介于2-20位字符之间！");
		$("#dic_name").select();
		return false;
	}
	
	var form_value="";
 	$('#form1 input[name="dic_list_name"]').each(function(i){
		var v_n=$(this).val();
		if(v_n!=""&&v_n!=undefined){
			var fid=$(this).attr("fid");
			v_id="dic_list_val_"+fid;
			d_id="dic_list_def_"+fid;
			
			if($("#"+d_id).is(":checked")==true){
				d_v=$("#"+d_id).val();
			}else{
				d_v="N"
			}
			
			form_value+=v_n+"#_#"+$("#"+v_id).val()+"#_#"+d_v+"|";
		 
 		}
 	}); 
	
	if(form_value!=""&&form_value.substr(form_value.length-1)=="|"){
		form_value=form_value.substr(0,form_value.length-1);
	}
  	
 	$("#form_list").val(form_value);
 	
	$('#load').show();
	var datas="action=data_dic_set&do_actions=update&"+$('#form1').serialize()+times;
 	
  	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		    request_tip(json.des,json.counts);
			_DialogInstance.ParentWindow.request_tip(json.des,json.counts);
			if(json.counts=="1"){
 				 
				$(_DialogInstance.ParentWindow.document).find("#data_dic_list_<?php echo $dic_id ?> td").eq(2).attr("title",$("#dic_name").val()).html("<span class='green'>"+$("#dic_name").val()+"</span>");
				$(_DialogInstance.ParentWindow.document).find("#data_dic_list_<?php echo $dic_id ?> td").eq(3).attr("title",$("#dic_des").val()).html("<span class='green'>"+$("#dic_des").val()+"</span>");
				$(_DialogInstance.ParentWindow.document).find("#data_dic_list_<?php echo $dic_id ?> td").eq(4).html("<span class='green'>"+$("#form_index").val()+"</span>");
				
 				setTimeout('Dialog.close();',10);
				
			}else{
				alert(json.des);  
			}
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
} 
</script>
<div id="auto_save_res" class="load_layer"></div>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);">数据字典管理</a> &gt; <?php echo $tits ?></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
</div>

<div class="page_main" >
<input name="form_index" type="hidden" id="form_index"  value="1" /> 
<input type="hidden" name="get_lay_2" id="get_lay_2" value="0"/>

<div id="opt_layer_1" class="opt_f_list">

  <div class="head"><strong class="">&nbsp;批量添加选项</strong><span class="font_14 font_w red" style="margin:0 6px 0 6px" id="bat_add_c">0</span>个 <a href='javascript:void(0)' hidefocus='true' class="close" title="关闭" onclick="javascript:$('#opt_layer_1').fadeOut()"></a></div>
  <div id="opt_layer_1_list">
     <div style="line-height:20px;margin-bottom:4px">按选项名称->选项值->默认(可选) 排列，例如：<a href='javascript:void(0)'>汽车名|汽车值|是</a><br />不加默认值请写：<a href='javascript:void(0)'>汽车名</a> 或 <a href='javascript:void(0)'>汽车名|汽车值</a> 各项之间用 <span class="red">|</span> 号分隔</div>
     <textarea name="bat_val_list" id="bat_val_list" cols="45" rows="5" style="width:97%;height:110px;" onchange='$("#bat_add_c").html($(this).val().split("\n").length);'></textarea>
  </div>
  <div class="bottom">
    <input type="button" name="" value="确定添加" onclick="set_dic_list_form('bat_add','-1','0');" title="点击确定批量添加选项" />
    <span style="margin-right:4px">
    <input type="button" name="" value="关 闭" onclick="javascript:$('#opt_layer_1').fadeOut()" />
    </span></div>

</div>
            
<fieldset ><legend ><?php echo $tits ?></legend>
 <form action="" method="post" name="form1" id="form1">
    <input name="form_list" id="form_list" type="hidden" value="" />
  <input type="hidden" name="dic_id" id="dic_id" value="<?php echo $dic_id?>"/>
    <table width="100%" cellpadding="0" cellspacing="0" class="td_underline">
        <tr >
          <td width="20%" align="right">字典ID：</td>
          <td align="left"><span class="blue font_w"><?php echo $dic_id ?></span></td>
        </tr>
        <tr >
          <td align="right">字典名称：</td>
          <td align="left"><input maxlength="20" size="30" class="s_input" name="dic_name" id="dic_name" value="<?php echo $dic_name ?>"/><span class="red">※</span><span class="gray">最长20位</span></td>
        </tr>
        <tr >
          <td align="right">字典描述：</td>
          <td align="left"><input maxlength="36" size="30" class="s_input" name="dic_des" id="dic_des" value="<?php echo $dic_des ?>"/></td>
        </tr>
        <tr >
          <td align="right">字典数值：</td>
          <td align="left" id="form_table">
            
           <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
              <thead>
                <tr align="left" class="dataHead">
                    <th >编号 <strong style="font-weight:normal;color:#F00" id="dic_index_c">0</strong></th>
                    <th >选项名称</th>
                    <th >选项数值</th>
                    <th >默认选中</th>
                    <th width="14%" nowrap="nowrap" >操作</th>
                 </tr>
              </thead>   
                <tbody>
                	 
                	 
                </tbody>
                <tfoot>
               	   
                    <tr class='dataTableFoot'><td colspan='10' align='left'><a href="javascript:void(0)" onclick="set_dic_list_form('add','-1','0');" title="点击添加一列选项值">添加一项</a>  <a href="javascript:void(0)" title="点击批量添加选项值" onclick="bat_add_list()">批量添加</a></td></tr>
                </tfoot>
          </table>
           
          </td>
        </tr>
        
    </table>
 
 </form>
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