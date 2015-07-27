<?php require("../../inc/pub_func.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<title><?php echo $system_name ?>-录音质检</title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css">
<link href="/css/day.css" rel="stylesheet" type="text/css">
<style>
.data_detail {
	display: 
}
.td_underline td {
	border-bottom: 1px dotted #ccc;
	height: 24px;
	line-height: 24px
}
.td_underline select {
*margin-top:1px
}
#custom_list_field select{margin-top:1px;float: left;clear: none; margin-right:2px}
#custom_list_field textarea{height: 18px;margin-top:1px}
#custom_list_field label{float: left;position: relative;line-height: 16px;height: 16px}
#custom_list_field .c_img{position:relative;left:-20px;margin-right:-20px; top:1px; cursor:pointer; }
</style>
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script type="text/javascript" src="/js/jquery.cxselect.js"></script>
<script type="text/javascript" src="/js/city_data.js"></script>
<script type="text/javascript" src="/js/My97DatePicker/WdatePicker.js"></script>
<script>
var custom_form_json=[],old_form_val="";
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
  	var is_change="N";
	var new_form_val=get_form_val();
	new_form_val=encodeURIComponent(get_form_val().join("|+|"));
	if(old_form_val!=""&&old_form_val!=null&&old_form_val.length>0){
		
		old_form_val=encodeURIComponent(old_form_val.join("|+|"));
		
		if(new_form_val!=old_form_val){
			is_change="Y";	
		}else{
			new_form_val="";	
		}
	}
	$('#load').show();
	var datas="action=callqulity_set&"+$('#form1').serialize()+"&is_change="+is_change+"&custom_field="+new_form_val+times;
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
 
function do_change(){
	$("#isedit").val("yes");
}

$(document).ready(function(){ 
	
  	$(".td_underline tr:odd").addClass("alt");
	$('#show_details').toggle(function(){
		$('#show_text').html("隐藏客户资料");
		get_list_field_val();
	},function(){
		$('#show_text').html("显示客户资料");
		get_list_field_val();
		$(".data_detail").hide();
   	});
   		
<?php
$phone_number=trim($_REQUEST["phone_number"]);
$index=trim($_REQUEST["index"]);
  
$sql="select a.call_date,a.user,a.comments,a.call_des,b.full_name,".$record_location." as locations,a.status,f.qualitydes,a.quality_status,d.recording_id,h.display_dtmf_alter,i.dtmf_key from vicidial_log".$archive." a left join vicidial_users b on a.user=b.user left join recording_log".$archive." d on a.uniqueid=d.vicidial_id and a.lead_id=d.lead_id left join data_quality_log f on a.uniqueid=f.vicidial_id and a.lead_id=f.lead_id left join vicidial_campaigns h on a.campaign_id=h.campaign_id left join (select dtmf_key,uniqueid from (select GROUP_CONCAT(dtmf_key) as dtmf_key,uniqueid from data_dtmf_log where uniqueid='".$uniqueid."' group by uniqueid) tmp_dtmf ) i on a.uniqueid=i.uniqueid where a.uniqueid='".$uniqueid."' limit 1 ";
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
		$addtime=$rs["addtime"];
		$quality_status=$rs["quality_status"]; 
 		$locations=$rs["locations"];  
		$recording_id=$rs["recording_id"];
	 
		$dtmf_key=$rs["dtmf_key"];
		($rs["display_dtmf_alter"]=="Y")?$display_dtmf_alter_c='':$display_dtmf_alter_c='dis_none';
 	}
	
	$counts="1";
	$des="succ！";
	
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
	 
	//var evt=window.event;Calendar.setup({inputField:"call_date",showsTime:true,ifFormat:"%Y-%m-%d %H:%M:%S",timeFormat:"24"});

	var Sorts_Order=0;
	$("#datatable .dataHead th[sort]").map(function(){
		Sorts_Order=Sorts_Order+1;
		
		html=$(this).html();
		
		$(this).attr("id","DadaSorts_"+Sorts_Order).off().on("click",function(){
			Sorts_new("datatable",$(this).attr("id"),$("#pagesize").val());	
		}).html("<div>"+html+"<span class='sorting'></span></div>");
		
 	}) ;
	$('<input name="a_ctions" type="hidden" id="a_ctions"/> <input name="doa_ctions" type="hidden" id="doa_ctions"/> <input name="recounts" type="hidden" id="recounts"/> <input name="pages" type="hidden" id="pages" value="1"/> <input name="pagecounts" type="hidden" id="pagecounts"/><input name="pagesize" type="hidden" id="pagesize" value="6"/> <input name="sorts" type="hidden" id="sorts" value="a.addtime"/> <input name="order" type="hidden" id="order"/>').appendTo("body"); 
	$("#datatable").hide();
	$("#qua_his_list").attr("title","点击查看本号码质检记录").click(function(){
		$("#datatable").show();
		GetPageCount('search',"count");get_datalist(1,"search","list",$('#pagesize').val());	
	});
	
	$(document).on("click","#custom_list_field :checkbox",function(){
		if($(this).is(":checked")){
			$(this).parent().addClass("blue") 
		 }else{
			$(this).parent().removeClass("blue") 	 
		 }
	});
	 
	$(document).on("click","#custom_list_field :radio",function(){
		 $(this).parent().siblings().removeClass("blue");
		 if($(this).is(":checked")){
			$(this).parent().addClass("blue") 
		 }else{
			$(this).parent().removeClass("blue") 	 
		 }
	});
 
});
function do_stop_wav(){document.getElementById("wav_player").Filename="";$("#wav_player_wmp").attr("src","");Dialog.close();};

function GetPageCount(a_ctions,doa_ctions){
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
  
	var url="action=get_qua_his_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&uniqueid="+$("#uniqueid").val()+times+"&archive="+$('#archive').val();
 	
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
	
	var url="action=get_qua_his_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&uniqueid="+$("#uniqueid").val()+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&archive="+$('#archive').val();
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
 					
					tr_str+="<td>"+con.user+"</div></td>";
					tr_str+="<td>"+con.old_status+"</td>";
					tr_str+="<td>"+con.status_name+"</td>";
					
					tr_str+="<td>"+con.call_date+"</td>";
					tr_str+="<td>"+con.addtime+"</td>";
					tr_str+="<td>"+con.userid+"</td>";
					tr_str+="<td>"+con.qualityname+"</td>";
 					tr_str+="<td class='td_break'>"+con.qualitydes+"</td>";
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
 
function get_form_val(){
	var custom_field_u=[];
	if(custom_form_json.length>0){
		$.each(custom_form_json,function(index,con){
			if(con.id!="phone_number"&&con.id!="call_des"){
				var vv;
				
				if(con.t=="DX"){ 
					vv=$('input[name="'+con.id+'"]:checked').val(); 
				}else if(con.t=="DXX"){
 					
					var vv =[];  
					$("input[name='"+con.id+"[]']:checked").each(function(){ 
						vv.push($(this).val()); 
					});
					vv.join(",");
						
				}else if(con.t=="SSQ"){
					var v1=$("#c_f_"+con.id+"1").val();
					var v2=$("#c_f_"+con.id+"2").val();
					var v3=$("#c_f_"+con.id+"3").val();
					if(v1==null){v1=""}
					if(v2==null){v2=""}
					if(v3==null){v3=""}
					vv=v1+"-"+v2+"-"+v3
						
				}else if(con.t=="SS"){
					var v1=$("#c_f_"+con.id+"1").val();
					var v2=$("#c_f_"+con.id+"2").val();
					 
					if(v1==null){v1=""}
					if(v2==null){v2=""}
					 
					vv=v1+"-"+v2
 				 
				}else if(con.t=="JL"){
					var v1=$("#c_f_"+con.id+"1").val();
					var v2=$("#c_f_"+con.id+"2").val();
					 
					if(v1==null){v1=""}
					if(v2==null){v2=""}
					 
					vv=v1+"-"+v2
				}else{
					vv=$("#c_f_"+con.id+"").val()	
				}
			
			
				custom_field_u.push(con.id+"|!|"+vv)
			}
		});
	}  	
	
	return custom_field_u;
}

function set_form_val(form_val){
	 
	if(typeof(form_val)!= "undefined"&&form_val){
		$.each(form_val,function(index,con){
			var ft=$("#f_gridster_li_"+con.n).attr("ft");
			if(con.v!=""&&con.v!=null){
				
				switch(ft){
					case "DX":
						var dx=$("input[name='"+con.n+"'][value='"+con.v+"']");
						if(dx.length>0){
							dx.attr("checked",true).parent().addClass("blue");
						}else{
							var c_input_id=con.n+$("input[name='"+con.n+"']").length;
							$("#f_gridster_li_"+con.n+" .em_r").append("<label for='c_f_"+c_input_id+"' class='blue'><input type='radio' id='c_f_"+c_input_id+"' name='"+con.n+"' value='"+con.v+"' checked>"+con.v+"</label>");
						}
					break;
					
					case "DXX": 
						var dv_arr=con.v.replaceAll("，",",").split(",");
						for(i=0;i<dv_arr.length;i++){
							
							var dx=$("input[name='"+con.n+"[]'][value='"+dv_arr[i]+"']");
							if(dx.length>0){
								dx.attr("checked",true).parent().addClass("blue");
							}else{
								var c_input_id=con.n+$("input[name='"+con.n+"[]']").length;
								$("#f_gridster_li_"+con.n+" .em_r").append("<label for='c_f_"+c_input_id+"' class='blue'><input type='checkbox' id='c_f_"+c_input_id+"' name='"+con.n+"[]' value='"+dv_arr[i]+"' checked>"+dv_arr[i]+"</label>");
							}
						}
						
					break;
					
					case "XL":
						 
						if($("#c_f_"+con.n+" option[value='"+con.v+"']").length>0){
							$("#c_f_"+con.n).val(con.v);
						}else{
							$("#c_f_"+con.n).append("<option value='"+con.v+"' selected>"+con.v+"</option>");
						}
						
					break;
					
					case "WB":
						$("#c_f_"+con.n).val(con.v);
					break;
					
					case "WBQ":
						$("#c_f_"+con.n).val(con.v);
					break;
					
					case "WZ": 
						$("#c_f_"+con.n).val(con.v);
					break;
					
					case "SSQ":
				 
						var dv_arr=con.v.replaceAll("，","-").replaceAll(",","-").split("-");
						 
						var dv_0=dv_arr[0],dv_1=dv_arr[1],dv_2=dv_arr[2];
						 
						if(typeof(dv_0)=="undefined"||dv_0==null){
							dv_0="";
						}　
						if(typeof(dv_1)=="undefined"||dv_1==null){
							dv_1="";
						}　
						if(typeof(dv_2)=="undefined"||dv_2==null){
							dv_2="";
						}　 
						
						$("#c_f_"+con.n+"1").val(dv_0).trigger('change'); 
						$("#c_f_"+con.n+"2").val(dv_1).trigger('change') ;
						$("#c_f_"+con.n+"3").val(dv_2);  
						
					break;
					
					case "SS":
						 
						var dv_arr=con.v.replaceAll("，","-").replaceAll(",","-").split("-");
						var dv_0=dv_arr[0],dv_1=dv_arr[1];
						 
						if(typeof(dv_0)=="undefined"||dv_0==null){
							dv_0="";
						}　
						if(typeof(dv_1)=="undefined"||dv_1==null){
							dv_1="";
						}　 
						$("#c_f_"+con.n+"1").val(dv_0).trigger('change'); 
						$("#c_f_"+con.n+"2").val(dv_1);
						
					break;
					
					case "RQ":
						$("#c_f_"+con.n).val(con.v);
					break;
					
					case "RQSJ":
						$("#c_f_"+con.n).val(con.v);
					break;
					
					case "JL":
						var dv_arr=con.v.replaceAll("，","-").replaceAll(",","-").split("-");
						var dv_0=dv_arr[0],dv_1=dv_arr[1];
						 
						if(typeof(dv_0)=="undefined"||dv_0==null){
							dv_0="";
						}　
						if(typeof(dv_1)=="undefined"||dv_1==null){
							dv_1="";
						}　 
						$("#c_f_"+con.n+"1").val(dv_0).trigger('change'); 
						$("#c_f_"+con.n+"2").val(dv_1);
					break; 
				}
			}
		});
	}
}; 

function get_list_field_val(){
	if($("#get_list_field_val").val()=="0"){
		var url="action=get_custom_field_val&lead_id="+$("#lead_id").val()+"&campaign_id="+$('#campaign_id').val()+"&archive="+$('#archive').val();
	 
	 	var c_tr_select=[],list_sub="",lists_sub="";
		//return false;
		$.ajax({
			 
			url: "send.php",
			data:url, 
			beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show();},
			complete :function(){$('#load').hide();},
			success: function(json){ 
				 	 
				var tr_str="";
				$("#custom_list_field tbody tr").remove(); 
				custom_form_json=json.f_list;
				if(parseInt(json.f_list.length)>0){ 
				 
					var tits="",td_str="",fun_str="";  
					$.each(json.f_list, function(index,con){ 
						f_id_tips=con.n+" - "+con.id;
						  
						var input_t="",list_str="",is_jl=0,jl_select,jl_url;
						switch(con.t){
							
							case "DX": 
							
								$.each(con.s, function(f_i,f_c){
									var c_input_id='c_f_'+con.id+f_i;
									
									input_t+="<label for='"+c_input_id+"'><input type='radio' id='"+c_input_id+"' name='"+con.id+"' value='"+f_c.n+"'>"+f_c.n+"</label>";
									
								});
								
							break;
							
							case "DXX":
								$.each(con.s, function(f_i,f_c){
									var c_input_id='c_f_'+con.id+f_i;
									
									input_t+="<label for='"+c_input_id+"'><input type='checkbox' id='"+c_input_id+"' name='"+con.id+"[]' value='"+f_c.n+"'>"+f_c.n+"</label>";
									
								});
							break;
							
							case "XL":
								input_t="<select id='c_f_"+con.id+"' name='"+con.id+"' style='' ><option value=''></option>";
								$.each(con.s,function(f_i,f_c){
									input_t+="<option value='"+f_c.n+"'>"+f_c.n+"</option>";
									//console.log(input_t);
								});
								input_t+="</select>";
							break;
							
							case "WB":
								input_t="<input id='c_f_"+con.id+"' name='"+con.id+"' style='' size='32' class='input_text_info' />";
							break;
							
							case "WBQ":
								input_t="<textarea id='c_f_"+con.id+"' name='"+con.id+"' style=''></textarea>";
							break;
							
							case "WZ": 
								input_t="<input id='c_f_"+con.id+"' name='"+con.id+"' style=''  size='32' class='input_text_info' />";
							break;
							
							case "SSQ":
						 
								//is_jl=1;
								//jl_url=city_data;
								//jl_select=["c_f_"+con.id+"1","c_f_"+con.id+"2","c_f_"+con.id+"3"];
								input_t="<div><select id='c_f_"+con.id+"1' class='c_f_"+con.id+"1' name='"+con.id+"[]'><option value=''>省份</option></select></div><div><select id='c_f_"+con.id+"2' class='c_f_"+con.id+"2' name='"+con.id+"[]' ><option value=''>城市</option></select></div><div><select id='c_f_"+con.id+"3' class='c_f_"+con.id+"3' name='"+con.id+"[]' ><option value=''>区县</option></select></div>";
							break;
							
							case "SS":
								//is_jl=1;
								//jl_url=city_data;
								//jl_select=["c_f_"+con.id+"1","c_f_"+con.id+"2"];
								input_t="<div><select id='c_f_"+con.id+"1' class='c_f_"+con.id+"1' name='"+con.id+"[]' ><option>省份</option></select></div><div><select id='c_f_"+con.id+"2' class='c_f_"+con.id+"2' name='"+con.id+"[]' ><option>城市</option></select></div>";
							break;
							
							case "RQ":
								input_t="<input id='c_f_"+con.id+"' name='"+con.id+"' class='inputText' size='32' style='' onClick='WdatePicker({dateFmt:\"yyyy-MM-dd\"})' /><img class='c_img' src='/images/Calendar.gif' align='absmiddle' vspace='1' />";
							break;
							case "RQSJ":
								
								input_t="<input id='c_f_"+con.id+"' name='"+con.id+"' class='inputText' size='32' style='' onClick='WdatePicker({dateFmt:\"yyyy-MM-dd HH:mm:ss\"})' /><img class='c_img' src='/images/Calendar.gif' align='absmiddle' vspace='1' />";
								 
							break;
							
							case "JL":
								//is_jl=1;
								//jl_url=con.s;
								//jl_select=["c_f_"+con.id+"1","c_f_"+con.id+"2"];
								input_t="<select id='c_f_"+con.id+"1' class='c_f_"+con.id+"1' name='"+con.id+"[]' ><option value=''></option></select><select id='c_f_"+con.id+"2' class='c_f_"+con.id+"2' name='"+con.id+"[]'><option value=''></option></select>";
							break; 
						}  
						 
						if(index%2==0){
							tr_str+="<tr class=\"td_underline data_detail\">\n";
						}
						 
						tr_str+='<td height="22" align="right" nowrap="nowrap">'+con.n+'：</td>\n';
						tr_str+='<td id="f_gridster_li_'+con.id+'" ft="'+con.t+'">'+input_t+'</td>\n';
						
						if(index%2==1){
							tr_str+="</tr>\n"; 
						}  
						 
					});
					 
				}
 				
				$("#custom_list_field tbody").append(tr_str); 
				$("#get_list_field_val").val("1"); 
			  	
				$.each(json.f_list, function(index,con){
					if(con.t=="SSQ"||con.t=="SS"||con.t=="jl"){
						if(con.t=="SSQ"){
							jl_url=city_data;
							jl_select=["c_f_"+con.id+"1","c_f_"+con.id+"2","c_f_"+con.id+"3"];
						}else if(con.t=="SS"){
							jl_url=city_data;
							jl_select=["c_f_"+con.id+"1","c_f_"+con.id+"2"];	
						}else{
							jl_url=con.s;
							jl_select=["c_f_"+con.id+"1","c_f_"+con.id+"2"];	
						}
						
						$('#custom_list_field').cxSelect({
							selects: jl_select,
							required: false, 
							firstValue:"",
							url:jl_url
						});
					}
				}); 
				set_form_val(json.v_list);
				$('.td_underline tr[class!=dataHead]:visible').removeClass("alt");
				$('.td_underline tr[class!=dataHead]:visible:odd').addClass("alt");
				d_table_i();
				
				old_form_val=get_form_val();
				
				//console.log(old_form_val);
			} 
		});
	}
	
	$(".data_detail").show();
} 


</script>

</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);" id="page_focus">首页</a> &gt; 数据报表 &gt; 录音质检 ：<span class="red"><?php echo  $phone_number ?></span></div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main">
  <table  width="99%" align="center" style="margin:4PX;"  border="1" cellpadding="1" cellspacing="0" bordercolor="#eeeeee">
    <tr>
      <td  align="center" valign="middle"><div id="player_"></div></td>
    </tr>
  </table>
  <input type="text" class="dis_none"  name="index" id="index" value="<?php echo $index ?>">
  <input type="text" class="dis_none"  name="get_status" id="get_status" value="0">
  <input type="text" class="dis_none"  name="get_quality_status" id="get_quality_status" value="0">
  <input type="text" class="dis_none"  name="get_list_field_val" id="get_list_field_val" value="0">
  
    <table  width="99%" align="center" style="margin:4px;border:solid 1px #CCCCCC"  border="0" cellpadding="2" cellspacing="0" bordercolor="#eeeeee" class="td_underline" id="custom_list_field" >
    <thead>
      <tr>
        <td width="100" height="22" align="right" nowrap="nowrap">呼叫号码：</td>
        <td height="22" class="blue"><span style="margin-right:10px;float:left"><?php echo  $phone_number ?></span> <a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' id="show_details" priv="true" ><img src="/images/icons/icon021a4.gif" /><b id="show_text">显示客户资料&nbsp;</b></a></td>
        <td width="100" align="right" nowrap="nowrap" >业务活动：</td>
        <td class="deepgreen"><?php echo $campaign_name ?></td>
      </tr>
      </thead>
      <tbody>
       
      </tbody>
    </table>
   
<form name="form1" id="form1" method="post" action="">
    <input type="text" class="dis_none"  name="phone_number" id="phone_number" value="<?php echo $phone_number ?>">
    <input type="text" class="dis_none"  name="uniqueid" id="uniqueid" value="<?php echo $uniqueid ?>">
    <input type="text" class="dis_none"  name="lead_id"  id="lead_id" value="<?php echo $lead_id ?>">
    <input type="text" class="dis_none"  name="list_id" value="<?php echo $list_id ?>">
    <input type="text" class="dis_none"  name="campaign_id" id="campaign_id" value="<?php echo $campaign_id ?>">
    <input type="text" class="dis_none"  name="quserid" value="<?php echo $_SESSION['username'] ?>">
    <input type="text" class="dis_none"  name="old_status" value="<?php echo $status ?>">
    <input type="text" class="dis_none"  name="user" value="<?php echo $user ?>">
    <input type="text" class="dis_none"  name="isedit" id="isedit" value="">
    <input type="text" class="dis_none"  name="qua_id" id="qua_id" value="<?php echo $qua_id ?>">
    <input type="text" class="dis_none"  name="recording_id" id="recording_id" value="<?php echo $recording_id ?>">
    <input type="text" class="dis_none"  name="old_call_date" id="old_call_date" value="<?php echo $call_date ?>">
    <input type="text" class="dis_none"  name="archive" id="archive" value="<?php echo $archive ?>">
    <table  width="99%" align="center" style="margin:4px;border:solid 1px #CCCCCC"  border="0" cellpadding="2" cellspacing="0" bordercolor="#eeeeee" class="td_underline" >
      <tr class="<?php echo $display_dtmf_alter_c?>" id="display_dtmf_alter">
        <td height="22" align="right" nowrap="nowrap">DTMF记录：</td>
        <td height="22" colspan="3" class="red font_w"><?php echo $dtmf_key ?></td>
      </tr>
      <tr >
        <td width="100" height="22" align="right" nowrap="nowrap">呼叫时间：</td>
        <td height="22" class="blue"><?php echo  $call_date ?><span class="gray" style=" margin-left:10px"><?php echo $comments ?></span></td>
        <td width="100" height="22" align="right" nowrap="nowrap">坐席工号：</td>
        <td height="22" class="blue"><?php echo  $user ." [". $full_name."]" ?></td>
      </tr>
      <tr>
        <td width="100" align="right" nowrap="nowrap" >质检结果：</td>
        <td ><select name="quality_status"  class="s_option" id="quality_status" >
          </select></td>
        <td width="100" height="22" align="right" nowrap="nowrap">呼叫结果：</td>
        <td height="22"><select name="status"  class="s_option" id="status" >
          </select></td>
      </tr>
      <tr>
        <td width="100" align="right" nowrap="nowrap" >质检描述：</td>
        <td ><textarea name="qualitydes" id="qualitydes" cols="34" style="height:40px" rows="5"><?php echo $qualitydes ?></textarea></td>
        <td width="100" height="22" align="right" nowrap="nowrap">呼叫描述：</td>
        <td height="22"><textarea name="call_des" id="call_des" cols="34" style="height:40px" rows="5"><?php echo $call_des ?></textarea></td>
      </tr>
    </table>
  </form>
  <fieldset>
    <legend style="font-weight:normal" id="qua_his_list">质检日志</legend>
    <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
      <thead>
        <tr align="left" class="dataHead">
          <th sort="c.user" style="font-weight:normal">工号</th>
          <th sort="old_status" style="font-weight:normal">原结果</th>
          <th sort="status_name" style="font-weight:normal">呼叫结果</th>
          <th sort="c.call_date" style="font-weight:normal">呼叫时间</th>
          <th sort="a.addtime" style="font-weight:normal">质检时间</th>
          <th sort="a.userid" style="font-weight:normal">质检人</th>
          <th sort="qualityname" style="font-weight:normal">质检结果</th>
          <th sort="a.qualitydes" style="font-weight:normal">质检描述</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr class='dataTableFoot'>
          <td colspan='14' align='left'><div id='dataTableFoot'>
              <div style='float:right;' id='pagelist'></div>
              <div style='float:left;' id='total'></div>
            </div></td>
        </tr>
      </tfoot>
    </table>
  </fieldset>
</div>
<?php
mysqli_close($db_conn);
?>
</body>
</html>
