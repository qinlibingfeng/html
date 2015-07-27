<?php require("../../inc/pub_func.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<title><?php echo $system_name ?>-录音质检</title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css">
<link href="/css/day.css" rel="stylesheet" type="text/css">
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script type="text/javascript" src="/js/calendar.js"></script>
<style>
.td_underline td {border-bottom: 1px dotted #ccc;height:24px;line-height:24px}
.td_underline select { *margin-top:1px}
 
span.gray { margin-left:4px }
span.red { margin-left:4px }
.ask_qua_input {height:30px;width:96%}
#qua_result_fieldset {width:320px;}
fieldset { margin:2px 2px 2px 2px }
.hide_tit{width:90px}
</style>
</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
<?php
 
$index=trim($_REQUEST["index"]);
 
$sql="select a.phone_number,a.call_date,a.user,a.campaign_id,a.call_des,a.comments,b.full_name,b.phone_login,c.title,c.first_name,c.middle_initial,c.last_name,c.address1,c.address2,c.address3,c.city,c.state,c.province,c.postal_code,c.gender,c.alt_phone,c.date_of_birth,c.security_phrase,c.vendor_lead_code,c.email,c.comments as comments_des,".$record_location." as locations,a.status,f.addtime,f.qualitydes,f.userid as quserid,a.quality_status,g.full_name as qfull_name,a.list_id,d.recording_id,f.id as qua_id from vicidial_log a left join vicidial_users b on a.user=b.user left join vicidial_list c on a.lead_id=c.lead_id left join recording_log d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_quality_log f on a.uniqueid=f.vicidial_id left join vicidial_users g on f.userid=g.user where a.uniqueid='".$uniqueid."' limit 0,1 ";

$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows);
  
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){
		
		$phone_number=$rs["phone_number"];
		$call_date=$rs["call_date"];
		$comments=$rs["comments"];
		($comments=='auto')?$comments='自动':$comments='手动';
		$user=$rs["user"];
		$full_name=$rs["full_name"];
		$comments_des=$rs["comments_des"];
		$status=$rs["status"];
		$qualitydes=$rs["qualitydes"];
		$phone_login=$rs["phone_login"];
		$quserid=$rs["quserid"];
		$addtime=$rs["addtime"];
		$quality_status=$rs["quality_status"];
		$qfull_name=$rs["qfull_name"];
 		$locations=$rs["locations"];
		$title=$rs["title"];
		$first_name=$rs["first_name"];
		$middle_initial=$rs["middle_initial"];
		$last_name=$rs["last_name"];
		$address1=$rs["address1"];
		$address2=$rs["address2"];
		$address3=$rs["address3"];
		$city=$rs["city"];
		$state=$rs["state"];
		$postal_code=$rs["postal_code"];
		$province=$rs["province"];
		$gender_list=$rs["gender"];
		$alt_phone=$rs["alt_phone"];
		$email=$rs["email"];
		$date_of_birth=$rs["date_of_birth"];
		$vendor_lead_code=$rs["vendor_lead_code"];
		$security_phrase=$rs["security_phrase"];
		$list_id=$rs["list_id"];
		$campaign_id=$rs["campaign_id"];
		$recording_id=$rs["recording_id"];
		$qua_id=$rs["qua_id"];
		$call_des=$rs["call_des"];
 	}
 	
 echo '<script>$(document).ready(function(){
	 
	 get_select_opt("'.$status.'","/document/data_detail/send.php","get_status_type","status","def_n","&status_type=call_status");
	 get_select_opt("'.$quality_status.'","/document/data_detail/send.php","get_status_type","quality_status","def_n","&status_type=qua_status");
 	 
 	 });</script>';
 	
}else {
 	echo '<script>$(document).ready(function(){Dialog.alert("呼叫记录不存在！请检查后重试！");});</script>';
}
mysqli_free_result($rows);
$campaign_name=trim($_REQUEST["campaign_name"]);
?>
<script>

function do_setquality(){
	 
	if($("#quality_status").val() == ""){
		alert("请选择质检结果！");
		$("#quality_status").focus();
		return false;
	}
	
	if($("#status").val() == ""){
		alert("请选择呼叫结果！");
		$("#status").focus();
		return false;
	}
	
 	var form_value="";
 	$('.ask_qua_input').each(function(i){
 		 
		d_id=$(this).attr("res_id");
		d_v=$(this).val();
		q_id=$(this).attr("que_id");
		call_date=$("#old_call_date").val();
		form_value+=d_v+"#_#"+d_id+"#_#"+q_id+"#_#"+call_date+"|";
  	}); 
	
	if(form_value!=""&&form_value.substr(form_value.length-1)=="|"){
		form_value=form_value.substr(0,form_value.length-1);
	}
	$("#form_list").val(form_value);
  	  
	$('#load').show();
	var datas="action=ask_result_up_qua&"+$('#form1').serialize()+times;
	//alert(datas);
	//return false;
	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		
		 request_tip(json.des,json.counts);
 		 if(json.counts=="1"){
 			
			$(_DialogInstance.ParentWindow.document).find("#ask_result_"+$("#index").val()+" td:eq(4)").attr("title","<?php echo $_SESSION["username"]?>质检于："+json.now_time+" 结果为："+$("#quality_status option:selected").text()+" 描述为："+$("#qualitydes").val()).html("<span class=\"red\">"+$("#quality_status option:selected").text()+"</span>");
			 
			$(_DialogInstance.ParentWindow.document).find("#ask_result_"+$("#index").val()+" td:eq(3)").html("<span class=\"red\">"+$("#status option:selected").text()+"</span>");
			 
 			_DialogInstance.ParentWindow.request_tip("<strong>"+$("#phone_number").val()+"</strong> 质检完成！检为："+$("#quality_status option:selected").text(),1);
 			do_stop_wav();
 		  }else{
			alert(json.des);
		  }
			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员!\n"+textStatus);
		}
	});
   
}
 
function do_change(){
	$("#isedit").val("yes");
}

function get_ask_result_one(){
	$('#load').show();
 	
	var url="action=get_ask_result_one&vicidial_id="+$('#uniqueid').val()+"&lead_id="+$('#lead_id').val()+"&ask_id="+$('#ask_id').val()+times;
 	 
	$.ajax({
		 
		url: "send.php",
		data:url,
		
		//async:false,
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
			
			$("#datatable tbody tr").remove(); 
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
					tr_str+="<td align=\"center\" rowspan='"+rowspan+"'><a href='javascript:void(0)'>"+que_order+"</a></td>";
					tr_str+="<td>"+con.que_title+" "+no_val+"</td>";
 					tr_str+="<td><span class='green'>"+que_type+"</span></td>";
 					tr_str+="</tr>";
					
					if(rowspan==2){
						tr_str+="<tr>";
						tr_str+="  <td colspan='2'><textarea name='ask_form_value' id='ask_form_value"+res_id+"' cols='24' class='ask_qua_input' res_id=\""+res_id+"\" que_id=\""+con.que_id+"\" rows='3'>"+con.form_value+"</textarea></td>";
						tr_str+="</tr>";
					}
 					$("#datatable tbody").append(tr_str);
				}); 
 				
			}else{
				 
				$("#datatable tbody tr").remove();
 				
				tr_str="<tr><td colspan=\"6\" align=\"center\">"+json.des+"</td></tr>"
				$("#datatable").append(tr_str);
 			}  
			d_table_i();
  			var td_width=$("#qua_result_fieldset_p").width();
			
			$("#qua_result_fieldset").css({"width":td_width+"px"}).scrollFollow({
				marginTop:0,
				marginRight:4,
				zindex:150
			}); 
			 
			$("#player_").html('<object classid="clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95" name="wav_player" width="100%" height="64" align="absmiddle" id="wav_player"><param name="FileName" value="<?php echo $locations ?>" /><param name="showstatusbar" value="1"><param name="Volume" value="0"><param name="showcontrols" value="1"><embed pluginspage="http://www.microsoft.com/Windows/Downloads/Contents/Products/MediaPlayer/" type="video/x-ms-wmv" id="wav_player_wmp" src="<?php echo $locations ?>" autostart="1" showControls="1" volume="0" width="100%" height="64" showstatusbar="1" ></embed></object>');
			$("#wav_player_wmp").css({"zoom":2,"display":"block"});
 			
		},error:function(XMLHttpRequest,textStatus ){
			alert("页面请求错误，请检查重试或联系管理员！\n"+textStatus);
		}
	});	
}
 
$(document).ready(function() {
	$("#page_focus").focus();
  	$(".td_underline tr:odd").addClass("alt");  	 
	$('#phone_custom').hide();
 	
	$("#show_custom_btn,#show_custom_btn2").click(function(){
		var con = $("#phone_custom");
		 
		if (con.is(":visible")){
			con.hide();
			$("#show_text").html("显示资料&nbsp;");
 		}else{
 			con.show();	
			goto_anchor("info_list");
 			$("#show_text").html("隐藏资料&nbsp;");
 		}
	});
 	var evt=window.event;Calendar.setup({inputField:"call_date",showsTime:true,ifFormat:"%Y-%m-%d %H:%M:%S",timeFormat:"24"});
	get_ask_result_one();
	 
});
function do_stop_wav(){document.getElementById("wav_player").Filename="";$("#wav_player_wmp").attr("src","");Dialog.close();};

</script>
<div class="page_nav">
 
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);" id="page_focus">首页</a> &gt; 数据报表 &gt; 录音质检 ：<span class="red"><?php echo  $phone_number ?></span></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main">
  <input type="hidden" name="index" id="index" value="<?php echo $index ?>">
  <input type="text" class="dis_none"  name="get_status" id="get_status" value="0">
    <input type="text" class="dis_none"  name="get_quality_status" id="get_quality_status" value="0">
  <form name="form1" id="form1" method="post" action="">
  	<a name="info_list" id="info_list"></a>
  	<input type="hidden" name="form_list" id="form_list" value="">
    <input type="hidden" name="phone_number" id="phone_number" value="<?php echo $phone_number ?>">
    <input type="hidden" name="uniqueid" id="uniqueid" value="<?php echo $uniqueid ?>">
    <input type="hidden" name="lead_id" id="lead_id" value="<?php echo $lead_id ?>">
    <input type="hidden" name="list_id" id="list_id" value="<?php echo $list_id ?>">
    <input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $campaign_id ?>">
    <input type="hidden" name="quserid" id="quserid" value="<?php echo $_SESSION['username'] ?>">
    <input type="hidden" name="ask_id" id="ask_id" value="<?php echo $ask_id ?>">
    <input type="hidden" name="isedit" id="isedit" value="">
    <input type="hidden" name="user" id="user" value="<?php echo $user ?>" />
    <input type="hidden" name="qua_id" id="qua_id" value="<?php echo $qua_id ?>" />
    <input type="hidden" name="recording_id" id="recording_id" value="<?php echo $recording_id ?>">
    <table width="100%" align="center" cellspacing="0">
      <tr>
        <td width="60%" valign="top" ><fieldset >
            <legend id="show_custom_btn2" title="点击显示/隐藏客户资料">
            <label>客户资料</label>
            </legend>
           
            <table width="99%" align="center" border="0" cellpadding="1" cellspacing="0" bordercolor="#eeeeee" class="td_underline" id="phone_custom">
              <tr>
                <td width="16%"  align="right" nowrap="nowrap" >标题：</td>
                <td ><input name="title" type="text" id="title" value="<?php echo  $title ?>" size="30" class="s_input" onchange="do_change();" /></td>
                <td width="16%" align="right" nowrap="nowrap"  >名字：</td>
                <td ><input name="first_name" type="text" id="first_name" size="30" class="s_input" value="<?php echo  $first_name ?>" onchange="do_change();"/></td>
              </tr>
              <tr>
                <td  align="right" >中间名：</td>
                <td ><input name="middle_initial" type="text" id="middle_initial" size="30" class="s_input" value="<?php echo  $middle_initial ?>" onchange="do_change();"/></td>
                <td align="right"  >姓氏：</td>
                <td ><input name="last_name" type="text" id="last_name" size="30" class="s_input" value="<?php echo  $last_name ?>" onchange="do_change();"/></td>
              </tr>
              <tr>
                <td  align="right" >地址1：</td>
                <td ><input name="address1" type="text" id="address1" size="30" class="s_input" value="<?php echo  $address1 ?>" onchange="do_change();"/></td>
                <td align="right"  >地址2：</td>
                <td ><input name="address2" type="text" id="address2" size="30" class="s_input" value="<?php echo  $address2 ?>" onchange="do_change();"/></td>
              </tr>
              <tr>
                <td  align="right" >地址3：</td>
                <td ><input name="address3" type="text" id="address3" size="30" class="s_input" value="<?php echo  $address3 ?>" onchange="do_change();"/></td>
                <td align="right"  >城市：</td>
                <td ><input name="city" type="text" id="city" size="30" class="s_input" value="<?php echo  $city ?>" onchange="do_change();"/></td>
              </tr>
              <tr>
                <td  align="right" >地区：</td>
                <td ><input name="state" type="text" id="state" size="30" class="s_input" value="<?php echo  $state ?>" onchange="do_change();"/></td>
                <td align="right"  >邮编：</td>
                <td ><input name="postal_code" type="text" id="postal_code" size="30" class="s_input" value="<?php echo  $postal_code ?>" onchange="do_change();"/></td>
              </tr>
              <tr>
                <td  align="right" >省份：</td>
                <td ><input name="province" type="text" id="province" size="30" class="s_input" value="<?php echo  $province ?>" onchange="do_change();"/></td>
                <td align="right"  >性别：</td>
                <td ><input name="gender_list" type="text" id="gender_list" size="30" class="s_input" value="<?php echo $gender_list ?>" onchange="do_change();"/></td>
              </tr>
              <tr>
                <td   align="right" >备用电话：</td>
                <td ><input name="alt_phone" type="text" id="alt_phone" size="30" class="s_input" value="<?php echo  $alt_phone ?>" onchange="do_change();"/></td>
                <td align="right"  >邮箱：</td>
                <td ><input name="email" type="text" id="email" size="30" class="s_input" value="<?php echo  $email ?>" onchange="do_change();"/></td>
              </tr>
              <tr>
                <td  align="right" >生日：</td>
                <td ><input name="date_of_birth" type="text" id="date_of_birth" size="30" class="s_input" value="<?php echo $date_of_birth ?>" onchange="do_change();"/></td>
                <td align="right"  >代理商ID：</td>
                <td ><input name="vendor_lead_code" type="text" id="vendor_lead_code" size="30" class="s_input" value="<?php echo  $vendor_lead_code ?>" onchange="do_change();"/></td>
              </tr>
              <tr>
                <td  align="right" >安全密码：</td>
                <td ><input name="security_phrase" type="text" id="security_phrase" size="30" class="s_input" value="<?php echo $security_phrase ?>" onchange="do_change();"/></td>
                <td align="right" >呼叫时间：</td>
	     		<td ><input name="old_call_date" type="hidden" id="old_call_date" value="<?php echo $call_date ?>" /><input name="call_date" type="text" id="call_date" size="30" class="s_input" value="<?php echo $call_date ?>" /></td>
              </tr>
              <tr>
                <td  align="right" >客户备注：</td>
                <td ><input name="comments" type="text" id="comments" size="30" class="s_input" value="<?php echo $comments_des ?>" onchange="do_change();"/></td>
                <td align="right" >&nbsp;</td>
                <td >&nbsp;</td>
              </tr>
            </table>
            
          </fieldset>
          <fieldset >
            <legend onclick="$('#datatable').toggle()" >
            <label>问卷结果</label>
            </legend>
            <table cellspacing="0" border="0" align="center" style="margin-top:2px;width:99%" id="datatable" class="dataTable">
              <thead>
                <tr align="left" class="dataHead">
                  <td width="8%">序号</td>
                  <td width="76%" >问题步骤</td>
                  <td >问题类型</td>
                </tr>
              </thead>
              <tbody>
                 
              </tbody>
            </table>
          </fieldset></td>
        <td valign="top" id="qua_result_fieldset_p"><div id="qua_result_fieldset" >
            <fieldset >
              <legend >
              <label>质检结果</label>
              </legend>
              <table width="98%" align="center" style="margin:4PX;"  border="1" cellpadding="1" cellspacing="0"bordercolor="#eeeeee">
                <tr>
                  <td colspan="2" align="center" valign="middle"><div id="player_"></div></td>
                </tr>
              </table>
              <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="td_underline">
                <tr >
                  <td  align="right" >呼叫号码：</td>
                  <td colspan="3"><span style="margin-right:10px;float:left" class="blue"><?php echo  $phone_number ?></span> <a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' id="show_custom_btn" onselectstart='return false' title="点击显示/隐藏客户资料"><img src="/images/icons/icon021a4.gif" /><b id="show_text">显示资料&nbsp;</b></a>
                  
                  </td>
                </tr>
                <tr >
                  <td  align="right" >业务活动：</td>
                  <td ><div class="blue hide_tit" title="<?php echo $campaign_name ?>"><?php echo $campaign_name ?></div></td>
                  <td align="right"  >坐席工号：</td>
                  <td ><div class="blue hide_tit" title="<?php echo $full_name ?>"><?php echo  $full_name ?> [<?php echo  $user ?>]</div></td>
                </tr>
                <tr >
                  <td  align="right" >呼叫时间：</td>
                  <td ><div class="blue hide_tit" title="<?php echo $call_date ?>"><?php echo $call_date ?></div></td>
                  <td align="right" >呼叫模式：</td>
                  <td ><span class="blue"><?php echo  $comments ?></span></td>
                </tr>
                <tr>
                  <td  align="right" >上次质检人：</td>
                  <td  colspan="3"><span class="blue"><?php if ($quserid!=""){echo  "$qfull_name [ $quserid ]";	}else{echo "未质检";}?></span></td>
                </tr>
                <tr>
                  <td  align="right" >上次质检时间：</td>
                  <td  colspan="3"><span class="blue"><?php echo  $addtime ?><em id="pos_test"></em></span></td>
                </tr>
                <tr>
                  <td align="right"  >质检结果：</td>
                  <td  colspan="3" ><select name="quality_status"  class="s_option" id="quality_status" >
							
                    </select></td>
                </tr>
                <tr>
                  <td align="right"  >质检描述：</td>
                  <td  colspan="3" ><textarea name="qualitydes" id="qualitydes" cols="24" style="height:50px; width:96%" rows="5"><?php echo $qualitydes ?></textarea></td>
                </tr>
                <tr>
                  <td align="right"  >呼叫结果：</td>
                  <td  colspan="3" ><select name="status"  class="s_option" id="status" >
                     
                    </select></td>
                </tr>
                <tr>
                  <td align="right"  >呼叫描述：</td>
                  <td  colspan="3" ><textarea name="call_des" id="call_des" cols="24" style="height:50px; width:96%" rows="5"><?php echo $call_des ?></textarea></td>
                </tr>
              </table>
            </fieldset>
        </div></td>
      </tr>
    </table>
    
    
  </form>
</div>
<?php
mysqli_close($db_conn);
?>
</body>
</html>
