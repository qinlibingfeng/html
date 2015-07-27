<?php
# vdc_script_display.php

//生成日期查询选择框
function select_date($def=""){
	if($def!=""){
		$nowdate="";
	}else{
		$nowdate=date("Y-m-d");
	}
	
 	$str="<input name='begintime' id='begintime' size='13' title='选择开始时间' readonly='readonly' value='$nowdate' onblur='set_Calendar()'/><img src='/images/Calendar.gif' align='absmiddle' vspace='1' style='position:relative; left:-20px; margin-right:-20px; cursor:pointer;' onblur=\"set_Calendar()\"/>\n";
	
	$str.="<select name='s_hour' class='select' id='s_hour'>\n";
 
  	for ($i=0;$i<=23;$i++){
	  $k=substr(100+$i,-2);
	  $str.="<option value='$k'>$k</option>\n";
	}
 
$str.="</select>\n";
$str.="<select  name='s_min' class='select' id='s_min'>\n";
  	for ($i=0;$i<=59;$i++){
  		$k=substr(100+$i,-2);
   $str.="<option value='$k'>$k</option>\n";
	}
$str.="</select>\n";
$str.="至\n";
$str.="<input name='endtime' id='endtime' size='13' readonly='readonly' title='选择结束时间' value='$nowdate'   onblur='set_Calendar()'/><img src='/images/Calendar.gif' align='absmiddle' vspace='1' style='position:relative; left:-20px; margin-right:-20px; cursor:pointer;' onblur=\"set_Calendar()\" />\n";
$str.="<select name='e_hour' class='select' id='e_hour'>\n";
  	for ($i=23;$i>=0;$i--){
  		$k=substr(100+$i,-2);
  		$str.="<option value='$k'>$k</option>\n";
  	}
$str.="</select>\n";
$str.="<select  name='e_min' class='select' id='e_min'>\n";
  
  	for ($i=59;$i>=0;$i--){
  		$k=substr(100+$i,-2);
		$str.="<option value='$k'>$k</option>\n";
  	}
	$str.="</select>\n";
 	echo $str;
}
    
if (isset($_GET["lead_id"]))	{$lead_id=$_GET["lead_id"];}
	elseif (isset($_POST["lead_id"]))	{$lead_id=$_POST["lead_id"];}
if (isset($_GET["vendor_id"]))	{$vendor_id=$_GET["vendor_id"];}
	elseif (isset($_POST["vendor_id"]))	{$vendor_id=$_POST["vendor_id"];}
	$vendor_lead_code = $vendor_id;
if (isset($_GET["list_id"]))	{$list_id=$_GET["list_id"];}
	elseif (isset($_POST["list_id"]))	{$list_id=$_POST["list_id"];}
if (isset($_GET["gmt_offset_now"]))	{$gmt_offset_now=$_GET["gmt_offset_now"];}
	elseif (isset($_POST["gmt_offset_now"]))	{$gmt_offset_now=$_POST["gmt_offset_now"];}
if (isset($_GET["phone_code"]))	{$phone_code=$_GET["phone_code"];}
	elseif (isset($_POST["phone_code"]))	{$phone_code=$_POST["phone_code"];}
if (isset($_GET["phone_number"]))	{$phone_number=$_GET["phone_number"];}
	elseif (isset($_POST["phone_number"]))	{$phone_number=$_POST["phone_number"];}
if (isset($_GET["title"]))	{$title=$_GET["title"];}
	elseif (isset($_POST["title"]))	{$title=$_POST["title"];}
if (isset($_GET["first_name"]))	{$first_name=$_GET["first_name"];}
	elseif (isset($_POST["first_name"]))	{$first_name=$_POST["first_name"];}
if (isset($_GET["middle_initial"]))	{$middle_initial=$_GET["middle_initial"];}
	elseif (isset($_POST["middle_initial"]))	{$middle_initial=$_POST["middle_initial"];}
if (isset($_GET["last_name"]))	{$last_name=$_GET["last_name"];}
	elseif (isset($_POST["last_name"]))	{$last_name=$_POST["last_name"];}
if (isset($_GET["address1"]))	{$address1=$_GET["address1"];}
	elseif (isset($_POST["address1"]))	{$address1=$_POST["address1"];}
if (isset($_GET["address2"]))	{$address2=$_GET["address2"];}
	elseif (isset($_POST["address2"]))	{$address2=$_POST["address2"];}
if (isset($_GET["address3"]))	{$address3=$_GET["address3"];}
	elseif (isset($_POST["address3"]))	{$address3=$_POST["address3"];}
if (isset($_GET["city"]))	{$city=$_GET["city"];}
	elseif (isset($_POST["city"]))	{$city=$_POST["city"];}
if (isset($_GET["state"]))	{$state=$_GET["state"];}
	elseif (isset($_POST["state"]))	{$state=$_POST["state"];}
if (isset($_GET["province"]))	{$province=$_GET["province"];}
	elseif (isset($_POST["province"]))	{$province=$_POST["province"];}
if (isset($_GET["postal_code"]))	{$postal_code=$_GET["postal_code"];}
	elseif (isset($_POST["postal_code"]))	{$postal_code=$_POST["postal_code"];}
if (isset($_GET["country_code"]))	{$country_code=$_GET["country_code"];}
	elseif (isset($_POST["country_code"]))	{$country_code=$_POST["country_code"];}
if (isset($_GET["gender"]))	{$gender=$_GET["gender"];}
	elseif (isset($_POST["gender"]))	{$gender=$_POST["gender"];}
if (isset($_GET["date_of_birth"]))	{$date_of_birth=$_GET["date_of_birth"];}
	elseif (isset($_POST["date_of_birth"]))	{$date_of_birth=$_POST["date_of_birth"];}
if (isset($_GET["alt_phone"]))	{$alt_phone=$_GET["alt_phone"];}
	elseif (isset($_POST["alt_phone"]))	{$alt_phone=$_POST["alt_phone"];}
if (isset($_GET["email"]))	{$email=$_GET["email"];}
	elseif (isset($_POST["email"]))	{$email=$_POST["email"];}
if (isset($_GET["security_phrase"]))	{$security_phrase=$_GET["security_phrase"];}
	elseif (isset($_POST["security_phrase"]))	{$security_phrase=$_POST["security_phrase"];}
if (isset($_GET["comments"]))	{$comments=$_GET["comments"];}
	elseif (isset($_POST["comments"]))	{$comments=$_POST["comments"];}
if (isset($_GET["user"]))	{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))	{$user=$_POST["user"];}
if (isset($_GET["pass"]))	{$pass=$_GET["pass"];}
	elseif (isset($_POST["pass"]))	{$pass=$_POST["pass"];}
if (isset($_GET["campaign_id"]))	{$campaign_id=$_GET["campaign_id"];}
	elseif (isset($_POST["campaign_id"]))	{$campaign_id=$_POST["campaign_id"];}
if (isset($_GET["phone_login"]))	{$phone_login=$_GET["phone_login"];}
	elseif (isset($_POST["phone_login"]))	{$phone_login=$_POST["phone_login"];}
 
if (isset($_GET["phone_pass"]))	{$phone_pass=$_GET["phone_pass"];}
	elseif (isset($_POST["phone_pass"]))	{$phone_pass=$_POST["phone_pass"];}
 
if (isset($_GET["group"]))	{$group=$_GET["group"];}
	elseif (isset($_POST["group"]))	{$group=$_POST["group"];}
if (isset($_GET["channel_group"]))	{$channel_group=$_GET["channel_group"];}
	elseif (isset($_POST["channel_group"]))	{$channel_group=$_POST["channel_group"];}
if (isset($_GET["SQLdate"]))	{$SQLdate=$_GET["SQLdate"];}
	elseif (isset($_POST["SQLdate"]))	{$SQLdate=$_POST["SQLdate"];}
if (isset($_GET["epoch"]))	{$epoch=$_GET["epoch"];}
	elseif (isset($_POST["epoch"]))	{$epoch=$_POST["epoch"];}
if (isset($_GET["uniqueid"]))	{$uniqueid=$_GET["uniqueid"];}
	elseif (isset($_POST["uniqueid"]))	{$uniqueid=$_POST["uniqueid"];}
 
if (isset($_GET["server_ip"]))	{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))	{$server_ip=$_POST["server_ip"];}
if (isset($_GET["SIPexten"]))	{$SIPexten=$_GET["SIPexten"];}
	elseif (isset($_POST["SIPexten"]))	{$SIPexten=$_POST["SIPexten"];}
if (isset($_GET["session_id"]))	{$session_id=$_GET["session_id"];}
	elseif (isset($_POST["session_id"]))	{$session_id=$_POST["session_id"];}
if (isset($_GET["phone"]))	{$phone=$_GET["phone"];}
	elseif (isset($_POST["phone"]))	{$phone=$_POST["phone"];}
if (isset($_GET["parked_by"]))	{$parked_by=$_GET["parked_by"];}
	elseif (isset($_POST["parked_by"]))	{$parked_by=$_POST["parked_by"];}
if (isset($_GET["dispo"]))	{$dispo=$_GET["dispo"];}
	elseif (isset($_POST["dispo"]))	{$dispo=$_POST["dispo"];}
if (isset($_GET["dialed_number"]))	{$dialed_number=$_GET["dialed_number"];}
	elseif (isset($_POST["dialed_number"]))	{$dialed_number=$_POST["dialed_number"];}
if (isset($_GET["dialed_label"]))	{$dialed_label=$_GET["dialed_label"];}
	elseif (isset($_POST["dialed_label"]))	{$dialed_label=$_POST["dialed_label"];}
if (isset($_GET["source_id"]))	{$source_id=$_GET["source_id"];}
	elseif (isset($_POST["source_id"]))	{$source_id=$_POST["source_id"];}
if (isset($_GET["rank"]))	{$rank=$_GET["rank"];}
	elseif (isset($_POST["rank"]))	{$rank=$_POST["rank"];}
if (isset($_GET["owner"]))	{$owner=$_GET["owner"];}
	elseif (isset($_POST["owner"]))	{$owner=$_POST["owner"];}
 
if (isset($_GET["fullname"]))	{$fullname=$_GET["fullname"];}
	elseif (isset($_POST["fullname"]))	{$fullname=$_POST["fullname"];}
if (isset($_GET["recording_filename"]))	{$recording_filename=$_GET["recording_filename"];}
	elseif (isset($_POST["recording_filename"]))	{$recording_filename=$_POST["recording_filename"];}
if (isset($_GET["recording_id"]))	{$recording_id=$_GET["recording_id"];}
	elseif (isset($_POST["recording_id"]))	{$recording_id=$_POST["recording_id"];}

$today = date("Y-m-d");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查询</title>
<link href="/css/main.css?v=<?php echo $today?>" rel="stylesheet" type="text/css">
<link href="/css/day.css?v=<?php echo $today?>" rel="stylesheet" type="text/css">
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/main.js?v=<?php echo $today?>"></script>
<script src="/js/pub_func.js?v=<?php echo $today?>"></script>
<script src="/js/calendar.js?v=<?php echo $today?>"></script>
<script>
jQuery.ajaxSetup({type: "post",dataType: "json",cache:false,complete:function(xhr,ts){xhr=null}});
function GetPageCount(a_ctions,doa_ctions){
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
  	
	var url="action=get_vicidial_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+times+"&"+$('#form1').serialize();
 	
	$.ajax({
		type: "post",
		dataType: "json",
		url: "work_send.php",
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
	max_pages(pagesize);
	var pages=$("#pagecounts").val();
	if(parseInt(page_nums) < 1)page_nums = 1; 
	if(parseInt(page_nums) > parseInt(pages)){
		page_nums = pages;
	}; 
	if(!(parseInt(page_nums) <= parseInt(pages))) page_nums = pages;	 
	
	var url="action=get_vicidial_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&"+$('#form1').serialize();
	
	
	$.ajax({
		 
		url: "work_send.php",
		data:url,
		//type: "post",dataType: "json",cache:false,
		beforeSend:function(){$('#load').css("top",$(document).scrollTop());$('#load').show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
			 
			$("#datatable tfoot tr").show();
			if(parseInt(json.counts)>0){
				 
				$("#datatable tbody tr").remove();
				 
				$.each(json.datalist, function(index,con){
					
 					uniqueid=con.uniqueid;
					locations=con.locations;
					phone_number=con.phone_number;
					lead_id=con.lead_id;
					list_id=con.list_id;
					uniqueid=con.uniqueid;
					td_str="";
					
					fun_str=" title=\"双击发起回拨呼叫\" ondblclick=\"new_callback_call('"+lead_id+"');\" ";
					 
					call_str="<a href=\"javascript:void(0);\" onClick=\"new_callback_call('"+lead_id+"','"+list_id+"');\" title=\"点击发起本呼叫记录的回拨呼叫，产生新呼叫记录\">呼叫</a>&nbsp;<a href=\"javascript:void(0);\" class='show_ask_res' p_vid='"+uniqueid+"'  p_lid='"+lead_id+"' p_tel='"+phone_number+"' onClick=\"get_ask_res('"+uniqueid+"','"+lead_id+"','"+phone_number+"');\" title=\"点击查看本呼叫记录的问卷调查结果\">查看问卷</a>&nbsp;";	
					
					if(locations !== undefined && locations!="" && locations!=null){
						
						if (locations!="同步中"){ 							 
							td_str="<td algin=\"center\">"+call_str+"<a href=\"javascript:void(0);\" onClick=\"play_wav(event,'play_layer','"+locations+"');\" title=\"点击收听本次营销录音\">收听</a>&nbsp;<a href=\""+locations+"\" target=\"_blank\" title=\"点击下载本次营销录音\">下载</a></td>";
						}else{
							td_str="<td >"+call_str+locations+"</td>";
						}
						
					}else{
						 
 						td_str="<td >"+call_str+"收听&nbsp;下载</td>";
					}		
 			 	
					tr_str="<tr "+fun_str+" id=\"tr_"+index+"\">";
					tr_str+="<td >"+phone_number+"</td>"; 					
					tr_str+="<td >"+con.call_date+"</td>";
					tr_str+="<td >"+con.comments_des+"</td>";
					tr_str+="<td >"+con.length_in_sec+"</td>";
					tr_str+="<td >"+con.talk_length_sec+"</td>";
					
					tr_str+="<td >"+con.status_name+"</td>";
					tr_str+="<td >"+con.call_des+"</td>";	
					tr_str+="<td >"+con.qualityname+"</td>"; 
					(con.qualitydes==null)?qualitydes="":qualitydes=con.qualitydes;
 					tr_str+="<td >"+qualitydes+"</td>"; 
					tr_str+=td_str+"</tr>";
					$("#datatable tbody").append(tr_str);
				}); 
				
				OutputHtml(page_nums,pagesize);
  			
			}else{
				 
				$("#datatable tbody tr").remove();
 				$("#datatable tfoot tr").hide();
				tr_str="<tr><td colspan=\"12\" align=\"center\">"+json.des+"</td></tr>"
				$("#datatable").append(tr_str);
 			}  
			
			$("#datatable tbody tr").removeClass().hover(function(){$(this).addClass("over")},function(){$(this).removeClass("over")});$("#datatable tbody tr:odd").addClass("alt");
  		
		},error:function(XMLHttpRequest,textStatus ){
			request_tip("查询请求发生异常错误，请检查重试或联系管理员！",0);
			 
		}
	});
	 
}
 
function get_p_data(types,lay_id){var action,get_id;get_id=$("#get_lay_"+lay_id).val();if(lay_id==1){action="get_status_list"}else if(lay_id==2){action="get_qua_status_list"}else{action="get_lists_list&campaign_id="+$("#campaign_id").val()}$('.opt_f_list').fadeOut();if(get_id==0){var url="action="+action+times;$.ajax({type:"get",dataType:"json",url:"work_send.php",data:url,cache:false,success:function(json){$("#opt_layer_"+lay_id+"_list li").remove();if(parseInt(json.counts)>0){var li_str="";$.each(json.datalist,function(index,con){li_str="<li title='"+con.status_name+" ["+con.status+"]'><input name='opt_field_"+lay_id+"' id='opt_field_"+lay_id+"_"+con.status+"' type='checkbox' value='"+con.status+"|"+con.status_name+"'/><label for='opt_field_"+lay_id+"_"+con.status+"'>"+con.status_name+" ["+con.status+"]</label></li>";$("#opt_layer_"+lay_id+"_list").append(li_str)});$('input[name="opt_field_'+lay_id+'"]').click(function(){if(this.checked==true){$(this).parent().children(1).addClass("blue")}else{$(this).parent().children(1).removeClass("blue")}});$("#get_lay_"+lay_id).val(1)}else{$("#get_lay_"+lay_id).val(0);li_str="<li>"+json.des+"</li>";$("#opt_layer_"+lay_id+"_list").append(li_str)}var x_top=$("#"+types).offset().top;var x_left=$("#"+types).offset().left;$("#opt_layer_"+lay_id).css({"top":x_top,"left":x_left}).show()},error:function(XMLHttpRequest,textStatus){request_tip("查询请求发生异常错误，请检查重试或联系管理员！",0);$("#get_lay_"+lay_id).val(0)}})}else{$("#opt_layer_"+lay_id).show()}}

function set_p_data(input,p_id){var p_name="",p_names="",p_val="",p_vals="";$('#opt_form_'+p_id+' input[name="opt_field_'+p_id+'"]:enabled:checked').each(function(i){var vals_ary=$(this).val().split("|");var p_val=vals_ary[0];p_vals+=p_val+",";var p_name=vals_ary[1];p_names+=p_name+","});if(p_names!=""){p_names=p_names.substr(0,p_names.length-1)}$("#"+input+"_list").val(p_names).attr("title",p_names);if(p_vals!=""){p_vals=p_vals.substr(0,p_vals.length-1)}$("#"+input).val(p_vals);$("#opt_layer_"+p_id).hide()}
 
function check_form(actions){	
	if (actions == "search") {
 		$("#datatable").show();
		GetPageCount('search', "count");
		get_datalist(1,"search", "list",$('#pagesize').val());
	}
}

function select_time_zone(zone){
	if (zone==""){
		$("#time_zone").css("width","");
		$("#time_len").css("display","none").val("");
 	}else{
		$("#time_len").focus().css("display","block");
		$("#time_zone").css("width","78px");
	}
}

function new_callback_call(lead_id,list_id,phone_number){
	var AutoDialWaiting=parent.AutoDialWaiting;
	var VD_live_customer_call=parent.VD_live_customer_call;
	var alt_dial_active=parent.alt_dial_active;
	var MD_channel_look=parent.MD_channel_look;
	
	if ((AutoDialWaiting == 1) || (VD_live_customer_call == 1) || (alt_dial_active == 1) || (MD_channel_look == 1)) {
       
		request_tip("当前模式下必须暂停或挂断提交进行的呼叫，才可发起新的呼叫!",0);
    }else{
		parent.new_callback_call('0',lead_id,'N');
	}	
}
  
function get_ask_res(vicidial_id,lead_id,phone){
  	 
	var url="action=get_ask_res&vicidial_id="+vicidial_id+"&lead_id="+lead_id+times;
 	//alert(url);
	$.ajax({
		   
 		url: "work_send.php",
		data:url,		 
		beforeSend :function(){$('#opt_layer_4').css("top",$(document).scrollTop()+6).fadeIn();$('#opt_load_img_4').show();$("#ask_res_phone").html(phone)},
		complete :function(){$('#opt_load_img_4').hide();},
		success: function(json){ 
			 
			$("#ask_datatable tbody tr").remove(); 
			if(parseInt(json.counts)>0){
 				var tits="";td_str="";fun_str="";qua_str="",is_call_des=0;
				$.each(json.datalist, function(index,con){
					
    				que_order=con.que_order;
					que_type=con.que_type;
					is_f_val=con.is_f_val;
					rowspan=2;
					no_val="";
					res_id=con.id;
					
					if(que_order==null){que_order=""}
					if(que_type==null){que_type=""}else if(que_type=="呼叫描述"){is_call_des=1}
					if(res_id==null){res_id="N"}
					if(que_type==""||que_type=="描述题"){rowspan=1}
					if(is_f_val=="N"&&que_type!="描述题"){no_val="<span class='red'>未填写</span>"}
					
					tr_str="<tr align=\"left\"  title=\""+con.que_title+"\">";
					tr_str+="<td align=\"center\" ><a href='javascript:void(0)'>"+que_order+"</a></td>";
					tr_str+="<td>"+con.que_title+" "+no_val+"</td>";
 					tr_str+="<td><span class='green'>"+que_type+"</span></td>";
 					tr_str+="</tr>";
					
					if(rowspan==2){
						tr_str+="<tr><td></td>";
						tr_str+="  <td colspan='2'><span class='blue_tip'>"+con.form_value+"</span></td>";
						tr_str+="</tr>";
					}
 					$("#ask_datatable tbody").append(tr_str);
				}); 
 				
			}else{
				 
				$("#ask_datatable tbody tr").remove();
 				
				tr_str="<tr><td colspan=\"6\" align=\"center\">"+json.des+"</td></tr>"
				$("#ask_datatable").append(tr_str);
 			}  
			$("#ask_datatable tbody tr").removeClass().hover(function(){$(this).addClass("over")},function(){$(this).removeClass("over")});$("#ask_datatable tbody tr:odd").addClass("alt");
 			
		},error:function(XMLHttpRequest,textStatus ){
			request_tip("页面请求错误，请检查重试或联系管理员！",0);
 		}
	});	
}


$(document).ready(function(){
	
	var Sorts_Order=0;
	$("#datatable .dataHead th[sort]").map(function(){
		Sorts_Order=Sorts_Order+1;
		
		html=$(this).html();
		
		$(this).attr("id","DadaSorts_"+Sorts_Order).off().on("click",function(){
			Sorts_new("datatable",$(this).attr("id"),$("#pagesize").val());	
		}).html("<div>"+html+"<span class='sorting'></span></div>");
		
 	});	
	 
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="15"/> <input name="sorts" type="hidden" id="sorts" value="a.call_date"/> <input name="order" type="hidden" id="order"/>').appendTo("body");

  	days_ready();
	$("#time_len,#auto_save_res,#datatable,#excels").hide();
	
	$("a.sel_").click(function(event){
		
		var e=window.event || event;
		if(e.stopPropagation){
			e.stopPropagation();
		}else{
			e.cancelBubble = true;
		}
		var p_type=$(this).attr("p_type");
		var p_id=$(this).attr("p_id");
		get_p_data(p_type,p_id);
 	});
	
	$("a.show_ask_res").live("click",function(event){
		
		var e=window.event || event;
		if(e.stopPropagation){
			e.stopPropagation();
		}else{
			e.cancelBubble = true;
		}
		var p_vid=$(this).attr("p_vid");
		var p_lid=$(this).attr("p_lid");
		var p_tel=$(this).attr("p_tel");
		get_ask_res(p_vid,p_lid,p_tel);
 	});
	
	$(".opt_f_list").click(function(event){  
	  var e=window.event || event;  
	  if(e.stopPropagation){  
	  	e.stopPropagation();  
	  }else{  
	   	e.cancelBubble = true;  
	  }  
	});
	
	$(document).click(function(){
		$(".opt_f_list").hide();
	});
	check_form("search") 
});
   
 
</script>
<style>
.hide_tit { width:120px; }
 
.opt_f_list{width:400px;border:2px solid #709CBE;position:absolute;left:10px;background:#FFF;z-index:12;margin-top:22px;display:none;box-shadow: 0 2px 7px rgba(0, 0, 0, 0.7);}
.opt_f_list ul{width:390px;position:relative;padding:4px;float:left;min-height:90px;max-height:180px;overflow:auto}
.opt_f_list li{display:inline-block;float:left;margin-right:8px;white-space: nowrap;width:31%;line-height:20px;height:20px; overflow:hidden}
.opt_f_list .head{background:#F1F7FC;width:100%;border-bottom:1px solid #C5C5C5;position:relative;line-height:25px;height:26px;float:left}
.opt_f_list .bottom{background:#F1F7FC;width:100%;border-top:1px solid #C5C5C5;position:relative;line-height:24px;height:26px;text-align:right;float:left}
.opt_f_list a.close{width:20px;height:20px;line-height:20px;background:url(/images/agent_c/ico_side.png) no-repeat -23px 0px;display:inline;position:absolute;right:6px;top:3px;cursor:pointer;font-size:1px}
.opt_f_list a.close:hover{background-position:-23px -23px}
.opt_f_list .chart_c_line{line-height:20px;height:20px;border-bottom:1px dotted #CCC;float:left;width:100%}

#opt_layer_4{width:660px;left:30px;}
#opt_layer_4_list{width:99%;position:relative;padding:4px;float:left;min-height:180px;max-height:280px;overflow:auto}
 
</style>
</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>

<div id="opt_layer_1" class="opt_f_list">
    <form name="opt_form_1" id="opt_form_1">
      <div class="head"><strong class="">&nbsp;选择呼叫结果</strong><a href='javascript:void(0)' hidefocus='true' class="close" title="关闭" onclick="javascript:$('#opt_layer_1').fadeOut()"></a></div>
      <ul id="opt_layer_1_list">
         
      </ul>
      <div class="bottom">
        <input type="button" name="" value="选 择" onclick="set_p_data('status','1')" />
        <span style="margin-right:4px">
        <input type="button" name="" value="关 闭" onclick="javascript:$('#opt_layer_1').fadeOut()" />
        </span></div>
    </form>
  </div>
  <div id="opt_layer_2" class="opt_f_list">
    <form name="opt_form_2" id="opt_form_2">
      <div class="head"><strong class="">&nbsp;选择质检结果</strong><a href='javascript:void(0)' hidefocus='true' class="close" title="关闭" onclick="javascript:$('#opt_layer_2').fadeOut()"></a></div>
      <ul id="opt_layer_2_list">
         
      </ul>
      <div class="bottom">
        <input type="button" name="" value="选 择" onclick="set_p_data('quality_status','2')" />
        <span style="margin-right:4px">
        <input type="button" name="" value="关 闭" onclick="javascript:$('#opt_layer_2').fadeOut()" />
        </span></div>
    </form>
  </div>
  <div id="opt_layer_3" class="opt_f_list">
    <form name="opt_form_3" id="opt_form_3">
      <div class="head"><strong class="">&nbsp;选择客户清单</strong><a href='javascript:void(0)' hidefocus='true' class="close" title="关闭" onclick="javascript:$('#opt_layer_3').fadeOut()"></a></div>
      <ul id="opt_layer_3_list">
         
      </ul>
      <div class="bottom">
        <input type="button" name="" value="选 择" onclick="set_p_data('list_id','3')" />
        <span style="margin-right:4px">
        <input type="button" name="" value="关 闭" onclick="javascript:$('#opt_layer_3').fadeOut()" />
        </span></div>
    </form>
  </div>
  
  <div id="opt_layer_4" class="opt_f_list">
     
      <div class="head"><strong class="">&nbsp;查看问卷结果</strong><span class=" red" style="margin:0 6px 0 6px" id="ask_res_phone">0</span> <img src="/images/loading.gif" id="opt_load_img_4" /><a href='javascript:void(0)' hidefocus='true' class="close" title="关闭" onclick="javascript:$('#opt_layer_4').fadeOut()"></a></div>
      <div id="opt_layer_4_list">
     <table cellspacing="0" border="0" align="center" style="margin-top:2px;width:99.4%" id="ask_datatable" class="dataTable">
          <thead>
            <tr align="left" class="dataHead">
              <td width="8%" style="font-weight:normal">序号</td>
              <td width="72%" style="font-weight:normal">问题步骤</td>
              <td style="font-weight:normal">问题类型</td>
            </tr>
          </thead>
          <tbody>
             
          </tbody>
        </table>
      </div>
      <div class="bottom">
         
    <span style="margin-right:4px">
    <input type="button" name="" value="关 闭" onclick="javascript:$('#opt_layer_4').fadeOut()" />
    </span></div>
    
</div>
<input type="hidden" name="get_lay_1" id="get_lay_1" value="0" />
<input type="hidden" name="get_lay_2" id="get_lay_2" value="0" />
<input type="hidden" name="get_lay_3" id="get_lay_3" value="0" />
   
<div class="page_main">
     
  <table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
    <tr>
      <td style=""><fieldset>
          <legend>
          <label onClick="show_div('search_list');" title="点击收缩/展开">查询选项</label>
          </legend>
          <form action="" onSubmit=""  method="post" name="form1" id="form1">
            <table width="100%" border="0" align="center"  cellspacing="0" id="search_list" class="search_table" >
              <tr>
                <td width="8%"  align="right">被叫号码：</td>
                <td ><input name="phone_number" type="text" class="input_text" id="phone_number" title="输入要查询的被叫号码，多个以英文“,”分隔"  size="21" onkeyup="this.value=value.replace(/[^\d|,]/g,'')" onafterpaste="this.value=value.replace(/[^\d|,]/g,'')" /></td>
                <td width="10%" align="right">号码精度：</td>
                <td><select name="search_accuracy" class="s_option" id="search_accuracy">
                    <option value="=">等于</option>
                    <option value="in">包含</option>
                    <option value="not in">不包含</option>
                    <option value="like_top">匹配开头</option>
                    <option value="like_end">匹配结尾</option>
                    <option value="like">模糊</option>
                  </select></td>
                <td align="right">呼叫描述：</td>
                <td><input name="call_des" type="text" class="input_text" id="call_des" title="输入要查询的呼叫备注描述"  size="27" maxlength="30" /></td>
                <td align="right">通话时长：</td>
                <td><select name="time_zone" id="time_zone" class="s_option" title="选定时长范围" onChange="select_time_zone(this.value);" style="float:left; margin-right:2px;">
                    <option value="" selected="selected">请选择时长范围</option>
                    <option value="<">小于</option>
                    <option value=">">大于</option>
                    <option value="=">等于</option>
                    <option value="!=">不等于</option>
                    <option value=">=">大于等于</option>
                    <option value="<=">小于等于</option>
                  </select>
                  <input name="time_len" id="time_len" style="float:left"  title="填写开始时长范围,单位：秒" value="" size="2" maxlength="4" onKeyUp="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" /></td>
              </tr>
              <tr>
                <td  align="right">呼叫结果：</td>
                <td ><input name="status_list" type="text" id="status_list"  title="双击选择呼叫结果" value="成功" size="14" readonly="readonly" onDblClick="get_p_data('status_list','1');" class="input_text2"/>
                  <a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择呼叫结果" p_type="status_list" p_id="1"></a></td>


                <td width="10%" align="right">质检结果：</td>
                <td><input name="quality_status_list" type="text" class="input_text2" id="quality_status_list"  title="双击选择质检结果"  size="14"  readonly="readonly"  onDblClick="get_p_data('quality_status_list','2');" />
                  <a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择质检结果" p_type="quality_status_list" p_id="2"></a></td>


                <td align="right">客户清单：</td>
                <td><input type="hidden" name="list_id" id="list_id" value="" /><input name="list_id_list" type="text" class="input_text2" id="list_id_list"  title="双击选择客户清单"  size="16"  readonly="readonly"  onDblClick="get_p_data('list_id_list','3');" />
                  <a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择客户清单" p_type="list_id_list" p_id="3"></a></td>
                <td width="8%"  align="right" id="td">呼叫类型：</td>
                <td ><select name="comments" id="comments" class="s_option">
                    <option value="">全部类型</option>
                    <option value="auto">自动</option>
                    <option value="MANUAL">手动</option>
                  </select></td>
              </tr>
              <tr>
                <td  align="right" nowrap="nowrap">呼叫时间：</td>
                <td  colspan="7"><?php select_date("");?></td>
              </tr>
              <tr>
                <td  align="right"><input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $campaign_id ?>" />
                  <input type="hidden" name="status" id="status" value="CG" />
                  <input type="hidden" name="quality_status" id="quality_status" value="" />
                  
                  <input type="hidden" name="user" id="user" value="<?php echo $user ?>" /></td>
                <td  colspan="7"><input type="button" name="form_submit" value="提交查询" onClick="check_form('search');" style="cursor:pointer" />
                  <input type="reset" name="button" id="button" value="重置" /></td>
              </tr>
            </table>
          </form>
        </fieldset>
        <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
          <thead>
            <tr align="left" class="dataHead">
              <th sort="a.phone_number" >呼叫号码</th>
              <th sort="a.call_date" >呼叫时间</th>
              <th sort="c.comments" >客户备注</th>
              <th sort="d.length_in_sec" >呼叫时长</th>
              <th sort="a.talk_length_sec" >通话时长</th>
              <th sort="a.status" >呼叫结果</th>
              <th sort="a.call_des" >呼叫描述</th>
              <th sort="a.quality_status" >质检结果</th>
              <th sort="f.qualitydes" >质检描述</th>
              <th >操作</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr class='dataTableFoot'>
              <td colspan='19' align='left'><div id='dataTableFoot'>
                  <div style='float:right;' id='pagelist'></div>
                  <div style='float:left;' id='total'></div>
                </div></td>
            </tr>
          </tfoot>
      </table></td>
    </tr>
  </table>
</div>
</body>
</html>
 
