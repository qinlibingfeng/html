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
<script src="/js/calendar.js"></script>
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
	
 	//if(confirm("确定提交质检吗？"))	{}else{return false;}
  	  
	$('#load').show();
	var datas="action=callqulity_set&"+$('#form1').serialize()+times;
	//alert(datas);
	$.ajax({
		 
		url: "send.php",
		data:datas,
		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		
 		 if(json.counts=="1"){
 			 
			$(_DialogInstance.ParentWindow.document).find("#tr_"+$("#index").val()+" td:eq(8)").html("<span class=\"red\">"+$("#status option:selected").text()+"</span>");
			$(_DialogInstance.ParentWindow.document).find("#tr_"+$("#index").val()+" td:eq(9)").html("<span class=\"red\">"+$("#call_des").val()+"</span>");
			$(_DialogInstance.ParentWindow.document).find("#tr_"+$("#index").val()+" td:eq(10)").attr("title","<?php echo $_SESSION["username"]?>质检于："+json.now_time+" 结果为："+$("#quality_status option:selected").text()+" 描述为："+$("#qualitydes").val()).html("<span class=\"red\">"+$("#quality_status option:selected").text()+"</span>");
 			_DialogInstance.ParentWindow.request_tip("<strong>"+$("#phone_number").val()+"</strong> 质检完成！检为："+$("#quality_status option:selected").text(),1);
 			do_stop_wav();
			
		  }else{
			alert(json.des);
		  }
			
		} 
	});
   
}

function show_detail(elm){
 	
	$("."+elm).each(
		function(){
			$(this).toggle();
		}
 	);
	
};

function do_change(){
	$("#isedit").val("yes");
}

</script>
<style>
.data_detail{display:none}
.td_underline td{border-bottom: 1px dotted #ccc; height:24px;line-height:24px}
.td_underline select{*margin-top:1px}
</style>
</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>

<script>
$(document).ready(function() { 
	
  	$(".td_underline tr:odd").addClass("alt");
	$('#show_details').toggle(function(){
			$('#show_text').html("隐藏客户详情");
 		},function(){
			$('#show_text').html("显示客户详情");
   	});
	
		
	<?php
$phone_number=trim($_REQUEST["phone_number"]);
$index=trim($_REQUEST["index"]);
 
$sql="select a.call_date,a.user,a.comments,a.call_des,b.full_name,c.title,c.first_name,c.middle_initial,c.last_name,c.address1,c.address2,c.address3,c.city,c.state,c.province,c.postal_code,c.gender,c.alt_phone,c.date_of_birth,c.email,c.comments as comments_des,".$record_location." as locations,a.status,f.addtime,f.qualitydes,f.userid as quserid,f.id as qua_id,a.quality_status,g.full_name as qfull_name,d.recording_id,h.display_dtmf_alter,i.dtmf_key from vicidial_log a left join vicidial_users b on a.user=b.user left join vicidial_list c on a.lead_id=c.lead_id left join recording_log d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_quality_log f on a.uniqueid=f.vicidial_id left join vicidial_users g on f.userid=g.user left join vicidial_campaigns h on a.campaign_id=h.campaign_id left join (select dtmf_key,uniqueid from (select GROUP_CONCAT(dtmf_key) as dtmf_key,uniqueid from data_dtmf_log where uniqueid='".$uniqueid."' group by uniqueid) tmp_dtmf ) i on a.uniqueid=i.uniqueid where a.uniqueid='".$uniqueid."' limit 1 ";
//echo $sql;
$rows=mysqli_query($db_conn,$sql);
$row_counts_list=mysqli_num_rows($rows); 
 
if ($row_counts_list!=0) {
	while($rs= mysqli_fetch_array($rows)){ 
		$call_date=$rs["call_date"];
		($comments=='auto')?$comments='自动':$comments='手动';
		$user=$rs["user"];
		$full_name=$rs["full_name"];
		$call_des=$rs["call_des"];
		$comments_des=$rs["comments_des"];
		$status=$rs["status"];
		$qualitydes=$rs["qualitydes"];
		 
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
		
		$qua_id=$rs["qua_id"];
		
		$recording_id=$rs["recording_id"];
	 
		$dtmf_key=$rs["dtmf_key"];
		($rs["display_dtmf_alter"]=="Y")?$display_dtmf_alter_c='':$display_dtmf_alter_c='dis_none';
 	}
	
	$counts="1";
	$des="获取成功！";
	
	 echo 'get_select_opt("'.$status.'","send.php","get_status_type","status","def_n","&status_type=call_status");
		get_select_opt("'.$quality_status.'","send.php","get_status_type","quality_status","def_n","&status_type=qua_status"); ';
 	
}else {
	$counts="0";
	$des="未找到符合条件的数据！";
	echo 'Dialog.alert("呼叫记录不存在！请检查后重试！");';
}
mysqli_free_result($rows);
$campaign_name=trim($_REQUEST["campaign_name"]);
?> 
  	 
	$(":input[type='text']").addClass("inputText").hover(function(){$(this).addClass("inputTextHover")},function(){$(this).removeClass("inputTextHover")}).focus(function(){$(this).removeClass("inputText inputTextHover").addClass("input_focus")}).blur(function(){$(this).addClass("inputText").removeClass("input_focus inputTextHover")});
	
	 
	$("#player_").html('<object classid="clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95" name="wav_player" width="100%" height="64" align="absmiddle" id="wav_player"><param name="FileName" value="<?php echo $locations ?>" /><param name="showstatusbar" value="1"><param name="Volume" value="0"><param name="showcontrols" value="1"><embed pluginspage="http://www.microsoft.com/Windows/Downloads/Contents/Products/MediaPlayer/" type="video/x-ms-wmv" id="wav_player_wmp" src="<?php echo $locations ?>" autostart="1" showControls="1" volume="0" width="100%" height="64" showstatusbar="1" ></embed></object>');
	 $("#wav_player_wmp").css({"zoom":2,"display":"block"});
	 
	var evt=window.event;Calendar.setup({inputField:"call_date",showsTime:true,ifFormat:"%Y-%m-%d %H:%M:%S",timeFormat:"24"});
	get_custom_fields();
	
});
function do_stop_wav(){document.getElementById("wav_player").Filename="";$("#wav_player_wmp").attr("src","");Dialog.close();};

function get_custom_fields(){
	
	
	var datas="action=get_custom_field_value&list_id="+$('#list_id').val()+"&lead_id="+$('#lead_id').val()+times;

	$.ajax({
		 
		url: "send.php",
		data:datas,
		dataType:"json",
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){
 			
 			if(json.counts=="1"){
	 			datalist=json.fields;
			  var count=datalist.length;
			  var i= 0;
			
				$("tr[name='custom_fields']").remove();
			  $.each(datalist, function(index,con){
				
				var newRow ="";
				if(i % 2 == 0){
						
						newRow +='<tr class="data_detail" id="tmp_tr" name = "custom_fields">';
					}
			 	switch(con.field_type)
				{
					
					case "TEXT"://TEXT					  			
					   newRow += ' <td height="22" align="right" nowrap="nowrap">'+con.field_label+'</td><td  ><input name="'+con.field_name+'" id="'+con.field_name+'" size="30"  value="'+con.field_value+'"  maxlength="110" class="s_input" onchange="do_change();" />';				  
					  break;
					case "SELECT"://SELECT
					   newRow += ' <td height="22" align="right" nowrap="nowrap">'+con.field_label+'</td><td><select class="s_option" name="'+con.field_name+'"  maxlength="110"  id="'+con.field_name+'">';
					   		  
						  $.each(con.field_options, function(index2,ccon){
						  	newRow += '<option value="'+ccon+'">'+ccon+'</option>';
							}); 		
					  newRow += '</select> ';
					  
				  	break;
					default:
				}	 		
					
				newRow += '</td>';
			
				if(i % 2 == 0){
					newRow +="</tr>";
					$('#tmp_tr').attr('id','');
				 	$("#div_custom_fields").append(newRow);					 	
				}else{
				
					$("#tmp_tr").append(newRow);
				}
				$("#"+con.field_name).val(con.field_value);
				
			
					i++;
			  });							 	
		
			}
			 
		}
	});

}



</script>
 <div class="page_nav">
         <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
         <div class="nav_">当前位置：<a href="javascript:void(0);" id="page_focus">首页</a> &gt; 数据报表 &gt; 录音质检 ：<span class="red"><?php echo  $phone_number ?></span></div>
         <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
     
    </div>
    
    <div class="page_main">
    <table width="98%" align="center" style="margin:4PX;"  border="1" cellpadding="1" cellspacing="0"bordercolor="#eeeeee">
    
        <tr>
          <td  align="center" valign="middle">
           <div id="player_"></div>
        </td>
        </tr>
    </table>
    <input type="text" class="dis_none"  name="index" id="index" value="<?php echo $index ?>">
    <input type="text" class="dis_none"  name="get_status" id="get_status" value="0">
    <input type="text" class="dis_none"  name="get_quality_status" id="get_quality_status" value="0">
	<form name="form1" id="form1" method="post" action="">
    
      <input type="text" class="dis_none"  name="phone_number" id="phone_number" value="<?php echo $phone_number ?>">
      <input type="text" class="dis_none"  name="uniqueid" value="<?php echo $uniqueid ?>">
      <input type="text" class="dis_none"  name="lead_id"   id="lead_id" value="<?php echo $lead_id ?>">
      <input type="text" class="dis_none"  name="list_id"  id="list_id" value="<?php echo $list_id ?>">
      <input type="text" class="dis_none"  name="campaign_id" value="<?php echo $campaign_id ?>">
      <input type="text" class="dis_none"  name="quserid" value="<?php echo $_SESSION['username'] ?>">
      <input type="text" class="dis_none"  name="old_status" value="<?php echo $status ?>">
      <input type="text" class="dis_none"  name="user" value="<?php echo $user ?>">
      <input type="text" class="dis_none"  name="isedit" id="isedit" value="">
      <input type="text" class="dis_none"  name="qua_id" id="qua_id" value="<?php echo $qua_id ?>">
      <input type="text" class="dis_none"  name="recording_id" id="recording_id" value="<?php echo $recording_id ?>">
  <table width="98%" align="center" style="margin:4px;border:solid 1px #CCCCCC"  border="0" cellpadding="2" cellspacing="0" bordercolor="#eeeeee" class="td_underline" >
 		
		<tr>
		  <td width="100" height="22" align="right" nowrap="nowrap">呼叫号码：</td>
		  <td height="22" class="blue"><span style="margin-right:10px;float:left"><?php echo  $phone_number ?></span> <a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' id="show_details" onclick="show_detail('data_detail')" priv="true" ><img src="/images/icons/icon021a4.gif" /><b id="show_text">显示详细信息&nbsp;</b></a></td>
		  <td width="100" align="right" nowrap="nowrap" >业务活动：</td>
		  <td class="deepgreen"><?php echo $campaign_name ?></td>
      </tr>		
		 		
      <tr class="data_detail">
        <td height="22" align="right" nowrap="nowrap">标题：</td>
          <td height="22"><input name="title" type="text" id="title" value="<?php echo  $title ?>" size="30" class="s_input" onchange="do_change();" /></td>
        <td align="right" nowrap="nowrap" >名字：</td>
          <td ><input name="first_name" type="text" id="first_name" size="30" class="s_input" value="<?php echo  $first_name ?>" onchange="do_change();"/></td>
      </tr>
      <tr class="data_detail">
          <td height="22" align="right" nowrap="nowrap">中间名：</td>
          <td height="22"><input name="middle_initial" type="text" id="middle_initial" size="30" class="s_input" value="<?php echo  $middle_initial ?>" onchange="do_change();"/></td>
          <td align="right" nowrap="nowrap" >姓氏：</td>
          <td ><input name="last_name" type="text" id="last_name" size="30" class="s_input" value="<?php echo  $last_name ?>" onchange="do_change();"/></td>
      </tr>
      <tr class="data_detail">
          <td height="22" align="right" nowrap="nowrap">地址1：</td>
          <td height="22"><input name="address1" type="text" id="address1" size="30" class="s_input" value="<?php echo  $address1 ?>" onchange="do_change();"/></td>
          <td align="right" nowrap="nowrap" >地址2：</td>
          <td ><input name="address2" type="text" id="address2" size="30" class="s_input" value="<?php echo  $address2 ?>" onchange="do_change();"/></td>
      </tr>
      <tr class="data_detail">
          <td height="22" align="right" nowrap="nowrap">地址3：</td>
          <td height="22"><input name="address3" type="text" id="address3" size="30" class="s_input" value="<?php echo  $address3 ?>" onchange="do_change();"/></td>
          <td align="right" nowrap="nowrap" >城市：</td>
          <td ><input name="city" type="text" id="city" size="30" class="s_input" value="<?php echo  $city ?>" onchange="do_change();"/></td>
      </tr>
      <tr class="data_detail">
          <td height="22" align="right" nowrap="nowrap">地区：</td>
          <td height="22"><input name="state" type="text" id="state" size="30" class="s_input" value="<?php echo  $state ?>" onchange="do_change();"/></td>
          <td align="right" nowrap="nowrap" >邮编：</td>
          <td ><input name="postal_code" type="text" id="postal_code" size="30" class="s_input" value="<?php echo  $postal_code ?>" onchange="do_change();"/></td>
      </tr>
      <tr class="data_detail">
	      <td height="22" align="right" nowrap="nowrap">省份：</td>
	      <td height="22"><input name="province" type="text" id="province" size="30" class="s_input" value="<?php echo  $province ?>" onchange="do_change();"/></td>
	      <td align="right" nowrap="nowrap" >性别：</td>
	      <td ><input name="gender_list" type="text" id="gender_list" size="30" class="s_input" value="<?php echo $gender_list ?>" onchange="do_change();"/> </td>
      </tr>
      <tr class="data_detail">
	      <td height="22" align="right" nowrap="nowrap">备用电话：</td>
	      <td height="22"><input name="alt_phone" type="text" id="alt_phone" size="30" class="s_input" value="<?php echo  $alt_phone ?>" onchange="do_change();"/></td>
	      <td align="right" nowrap="nowrap" >邮箱：</td>
	      <td ><input name="email" type="text" id="email" size="30" class="s_input" value="<?php echo  $email ?>" onchange="do_change();"/></td>
      </tr>
     
      <tr class="data_detail">
	      <td height="22" align="right" nowrap="nowrap">生日：</td>
	      <td height="22" ><input name="date_of_birth" type="text" id="date_of_birth" size="30" class="s_input" value="<?php echo $date_of_birth ?>" onchange="do_change();"/></td>
          <td align="right" >呼叫时间：</td>
	      <td ><input name="old_call_date" type="text" class="dis_none"  id="old_call_date" value="<?php echo $call_date ?>" /><input name="call_date" type="text" id="call_date" size="30" class="s_input" value="<?php echo $call_date ?>" /></td>
      </tr>
      
       <tr class="data_detail">
	      <td height="22" align="right" nowrap="nowrap">客户备注：</td>
	      <td height="22" colspan="3" ><input name="comments" type="text" id="comments" size="30" class="s_input" value="<?php echo $comments_des ?>" onchange="do_change();"/></td>
      </tr>

    
      <tbody  id = "div_custom_fields">      
      </tbody >

      
      
       <tr class="<?php echo $display_dtmf_alter_c?>" id="display_dtmf_alter">
	      <td height="22" align="right" nowrap="nowrap">DTMF记录：</td>
	      <td height="22" colspan="3" class="red font_w"><?php echo $dtmf_key ?></td>
      </tr>
      <tr >
        <td width="100" height="22" align="right" nowrap="nowrap">呼叫时间：</td>
        <td height="22" class="blue"> <?php echo  $call_date ?><span class="gray" style=" margin-left:10px"><?php echo $comments ?></span></td>
        <td align="right">上次质检人：</td>
        <td class="blue">
        <?php 
        if ($quserid!=""){ 
            echo  "$quserid [$qfull_name]";
        } 
        ?></td>
	   </tr>	   
		<tr>
		  <td width="100" height="22" align="right" nowrap="nowrap">坐席工号：</td>
		  <td height="22" class="blue"><?php echo  $user ." [". $full_name."]" ?> </td>
		  <td width="100" align="right" nowrap="nowrap" >上次质检时间：</td>
		  <td  class="blue"><?php echo  $addtime ?></td>
      </tr>
                
		<tr>
        	<td width="100" align="right" nowrap="nowrap" >质检结果：</td>
		  <td >
          <select name="quality_status"  class="s_option" id="quality_status" >
          
	      </select>
          </td>
			<td width="100" height="22" align="right" nowrap="nowrap">呼叫结果：</td>
		  <td height="22">
          
          <select name="status"  class="s_option" id="status" >
	         
           </select>
          
          </td>
		  
      </tr>
		<tr>
		  <td width="100" align="right" nowrap="nowrap" >质检描述：</td>
		  <td ><textarea name="qualitydes" id="qualitydes" cols="34" style="height:60px" rows="5"><?php echo $qualitydes ?></textarea></td>
		  <td width="100" height="22" align="right" nowrap="nowrap">呼叫描述：</td>
		  <td height="22"><textarea name="call_des" id="call_des" cols="34" style="height:60px" rows="5"><?php echo $call_des ?></textarea></td>
	  </tr>		
		
  	  
    </table>
	</form>

 </div>

<?php
mysqli_close($db_conn);
?>
</body>
</html>
 