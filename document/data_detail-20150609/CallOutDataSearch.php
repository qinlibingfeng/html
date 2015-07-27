<?php require("../../inc/config.ini.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xHTML">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<title> <?php echo $system_name ?></title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css">
<link href="/css/day.css" rel="stylesheet" type="text/css">
<link href="/css/bootstrap.css" rel="stylesheet" type="text/css">
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script src="/js/calendar.js"></script>
<script>
var agent_api = "<?php echo $_SESSION["vdc_agent_api_access"] ?>";
var user_level = "<?php echo $_SESSION["user_level"] ?>";

function GetPageCount(a_ctions,doa_ctions){
	$("#a_ctions").val(a_ctions);
	$("#doa_ctions").val(doa_ctions);
  	
	var url="action=get_vicidial_list&pages=1&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+times+"&"+$('#form1').serialize();
 	
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
	//$("#xls_addr").html('');
 	max_pages(pagesize);
 	var pages=$("#pagecounts").val();
 	if(parseInt(page_nums) < 1)page_nums = 1; 
 	if(parseInt(page_nums) > parseInt(pages)){
		page_nums = pages;
  	}; 
 	if(!(parseInt(page_nums) <= parseInt(pages))) page_nums = pages;	 
	 
  	var url="action=get_vicidial_list&pages="+page_nums+"&actions="+a_ctions+"&do_actions="+doa_ctions+"&sorts="+$('#sorts').val()+"&order="+$('#order').val()+"&pagesize="+pagesize+times+"&"+$('#form1').serialize();
	
 	//alert(url);
	//return false;
	
 	$.ajax({
		 
		url: "send.php",
		data:url,
		
 		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
		   if (doa_ctions!="excel"){
			   
 			  $("#datatable tbody tr").remove();
			   
			   if(parseInt(json.counts)>0){
				 $("#datatable tfoot tr").show();
				 $("#excels").css("display","block");
				 //alert(json.sql);
				
				$.each(json.datalist, function(index,con){
					var tits="",td_str="",fun_str="",qua_str="",quq_str2="";
					
 					locations=con.locations;
					user=con.user;
					campaign_id=con.campaign_id;
					list_id=con.list_id;
					lead_id=con.lead_id;
					phone_number=con.phone_number;
					campaign_name=con.campaign_name;
					uniqueid=con.uniqueid;
					
					if(locations){
						
						if (locations!="同步中"){
							 
							if(con.user!="VDAD"&&agent_api=="1"){
								
								fun_str=" title=\"双击质检本次通话\"  ondblclick=\"veiw_Quality('"+uniqueid+"','"+lead_id+"','"+list_id+"','"+campaign_id+"','"+phone_number+"','"+campaign_name+"','"+index+"');\" ";
								
								qua_str="<a href=\"javascript:void(0);\" onClick=\"veiw_Quality('"+uniqueid+"','"+lead_id+"','"+list_id+"','"+campaign_id+"','"+phone_number+"','"+campaign_name+"','"+index+"');\" title=\"点击质检本次营销\">质检</a>&nbsp;";
								 
						    }
							td_str="<td algin=\"center\">"+qua_str+"<a href=\"javascript:void(0);\" onClick=\"play_wav(event,'play_layer','"+locations+"');\" title=\"点击收听本次营销录音\">收听</a>&nbsp;<a href=\""+locations+"\" target=\"_blank\" title=\"点击下载本次营销录音\">下载</a></td>";
						}else{
							td_str="<td >"+locations+"</td>";
						}
						
					}else{
						if(con.user=="VDAD"){
							quq_str2="";
						}else if (agent_api=="1"){
							quq_str2="<a href=\"javascript:void(0);\" onClick=\"veiw_Quality('"+uniqueid+"','"+lead_id+"','"+list_id+"','"+campaign_id+"','"+phone_number+"','"+campaign_name+"','"+index+"');\" title=\"点击质检本次营销\">质检</a>&nbsp;";	
							 
						}
						td_str="<td >"+quq_str2+"无</td>";
					}		
 			 		
					tr_str="<tr "+fun_str+" id=\"tr_"+index+"\">";
					tr_str+="<td >"+phone_number+"</td>";
					tr_str+="<td >"+con.citys+"</td>";
					tr_str+="<td >"+con.user+" ["+con.full_name+"]</td>";
					tr_str+="<td >"+con.call_date+"</td>";
					tr_str+="<td >"+con.length_in_sec+"</td>";
					tr_str+="<td >"+con.talk_length_sec+"</td>";
					tr_str+="<td >"+campaign_name+"</td>";
					tr_str+="<td >"+con.comments+"</td>";
					tr_str+="<td >"+con.status_name+"</td>";
					tr_str+="<td >"+con.call_des+"</td>";
					if(con.qualityname!="未质检"&&con.qualityname != undefined && con.qualityname!=""){
						tits=con.qualityuser+"质检于："+con.addtime+" 结果为："+con.qualityname+" 描述为："+con.qualitydes;
					}
					tr_str+="<td title=\""+tits+"\" >"+con.qualityname+"</td>";
					
					tr_str+=td_str+"</tr>";
					$("#datatable tbody").append(tr_str);
				}); 
			 
				OutputHtml(page_nums,pagesize);
				
			   }else{
					$("#excels").hide();
					$("#xls_addr,#csv_addr").html('');
					$("#datatable tfoot tr").hide();
					tr_str="<tr><td colspan=\"14\" align=\"center\">"+json.des+"</td></tr>"
					$("#datatable").append(tr_str);
			   }  
			   d_table_i();
			
			} else{
			   request_tip(json.des,json.counts);
			   if(json.counts=="1"){
				   $("#"+$("#file_type").val()+"_addr").html("下载：<a href='"+json.file_path+json.file_name+"' target='_blank'>"+json.file_name+"</a>");
			   }else{
				   $("#"+$("#file_type").val()+"_addr").html(json.des);   
			   }
			   
			}
		    
  		},error:function(XMLHttpRequest,textStatus ){
			
			alert("页面请求错误，请检查重试或联系管理员！\n"+textStatus);
		}
   	});
	
}
 

function veiw_Quality(uniqueid,lead_id,list_id,campaign_id,phone_number,campaign_name,index){
	var diag =new Dialog(uniqueid);
	diag.Width = 760;
	diag.Height = 400;	
 	diag.Title = "录音质检："+phone_number;
	
	//var pos=$(document).scrollTop();
 	//diag.Top=""+pos+"";
  	diag.URL = '/document/data_detail/CallOutDataQuality.php?uniqueid='+uniqueid+'&lead_id='+lead_id+'&list_id='+list_id+'&campaign_id='+campaign_id+'&phone_number='+phone_number+'&campaign_name='+encodeURIComponent(campaign_name)+'&index='+index;
	/*var pos=$(document).scrollTop()+20;
	diag.Top=""+pos+"";*/
	diag.OKEvent = setquality;
	diag.CancelEvent = stop_wavs;
    diag.show();
 }
 
function stop_wavs(){
	Zd_DW.do_stop_wav();
	 
} 
function setquality(){
	Zd_DW.do_setquality();
}
  
function check_form(actions)
 {	
   	var agents=$("#agent_list").val();
	
 	if($("#phone_number").val()!=""&&($("#phone_number").val().substr(0,1)==","||$("#phone_number").val().substring($("#phone_number").val().length,$("#phone_number").val().length-1)==",")){
		
 		alert("被叫号码不能以英文逗号开头或结尾！");
		$("#phone_number").select();
 		return false;
 	}
	
	/*if(agents==""){
			
		alert("请选择"+$("#caller_types").html().replace("：","")+"查询！");
		$("#agent_name_list").focus();
		return false;
	}*/
 	
	if($("#time_zone").val()!=""&&$("#time_len").val()==""){
		alert("请选择时长范围数值！");
 		$("#time_len").focus();
		return false;
	}
	
    if (actions == "search") {
  		 
  		$("#datatable").show();
        GetPageCount('search', "count");
        get_datalist(1,"search", "list",$('#pagesize').val());
    }
	 
	if (actions == "excel") {
		//Zd_D.close();
		$("#field_list").val("");
 		$("#datatable").show();
		$("#file_type").val("xls");
		request_tip("系统正在为您导出，此过程较慢，请耐心等候...",1,30000);
 		get_datalist(1,"search", "excel",$('#pagesize').val());
	}
	
	if (actions == "txt_n") {
		//Zd_D.close();
		$("#field_list").val("");
 		$("#datatable").show();
		$("#file_type").val("txt_n");
		request_tip("系统正在为您导出，此过程较慢，请耐心等候...",1,30000);
 		get_datalist(1,"search", "excel",$('#pagesize').val());
	}
 	  
	if (actions == "excel_field") {
		
		request_tip("系统正在为您导出，此过程较慢，请耐心等候...",1,30000);
 		
 		$("#datatable").show();
		get_datalist(1,"search", "excel",$('#pagesize').val());
	}
	  
 }

function c_field_list(actions,file_type){
	$("#file_type").val(file_type);
	var list_id = $("#phone_lists").val();
 	var diag =new Dialog("diag_get_fields_list");
 	diag.Width = 500;
	diag.Height = 240;
 	diag.Title = "选择详单导出字段";
 	diag.URL = "/document/report/list.php?action="+actions+"&list_id="+list_id+"&tits="+encodeURIComponent("选择详单导出字段");
  	diag.OKEvent = setfields_list;
    diag.show();
}
 
function setfields_list(){
	Zd_DW.do_setfields_list();
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

function set_data_type_(type){
	$(".data_type a").removeClass("select");$("#data_type_"+type).addClass("select");		
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
	
	$('<input name="a_ctions" type="text" class="dis_none"  id="a_ctions"/> <input name="doa_ctions" type="text" class="dis_none"  id="doa_ctions"/> <input name="recounts" type="text" class="dis_none"  id="recounts"/> <input name="pages" type="text" class="dis_none"  id="pages" value="1"/> <input name="pagecounts" type="text" class="dis_none"  id="pagecounts"/><input name="pagesize" type="text" class="dis_none"  id="pagesize" value="15"/> <input name="sorts" type="text" class="dis_none"  id="sorts" value="a.call_date"/> <input name="order" type="text" class="dis_none"  id="order"/>').appendTo("body");

	$("#time_len,#auto_save_res,#datatable,#excels").hide();
 	days_ready();
	
	$('#ch_sec_type').dropdown();
	
	$("#sec_type_list a").on("click",function(){
		$("#ch_sec_type span").html($(this).text());
		$("#time_len_type").val($(this).attr("len_type"));
	});
	 
});
  


</script>

<style type="text/css">
.data_type a{line-height: 21px;text-align: center;display: inline;float: left;height: 21px;width: 75px; margin-right:6px}
.data_type a:hover{background: url(/images/timeabg.gif) no-repeat 0px 0px;}
.data_type a.select{background: url(/images/timeabg.gif) no-repeat 0px 0px;font-weight:bold;}

 </style>
  
</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
<div class="page_main">
<table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
        <tr>
            <td style="">
            
<fieldset><legend> <label onClick="show_div('search_list');" title="点击收缩/展开">查询选项</label></legend>
                     
        <form action="" onSubmit=""  method="post" name="form1" id="form1">       
             <table width="100%" border="0" align="center"  cellspacing="0" id="search_list" class="search_table" >
            
               <tr>
                 <td width="8%"  align="right">被叫号码：</td>
                 <td ><input name="phone_number" type="text" class="input_text" id="phone_number" title="输入要查询的被叫号码，多个以英文“,”分隔"  size="21" onkeyup="this.value=value.replace(/[^\d|,]/g,'')" onafterpaste="this.value=value.replace(/[^\d|,]/g,'')" /></td>
                 
                 <td width="8%" align="right">包含被叫：</td>
                 <td><label for="exists_1" title="包含输入的被叫号码"><input name="exists" type="radio" id="exists_1" value="in" checked="checked" />是</label><label for="exists_2" title="不包含输入的被叫号码"><input type="radio" name="exists"  id="exists_2" value="not in" />否</label></td>
                 
                 <td width="8%"  align="right" id="">号码精度：</td>
                 <td  nowrap="nowrap">
                 	<select name="search_accuracy" class="s_option" id="search_accuracy">
                      	<option value="=">等于</option>
                      	<option value="in">包含</option>
                      	<option value="not in">不包含</option>
                      	<option value="like_top">匹配开头</option>
                       	<option value="like_end">匹配结尾</option>
                      	<option value="like">模糊</option>
                       </select>
                 </td>
                 <td align="right">所属地市：</td>
                 <td><input name="city" type="text" class="input_text" id="city" title="输入要查询的所属地市"  /></td>
                 
               </tr>
               <tr>
                 <td width="8%"  align="right" id="td">质检结果：</td>
                 <td ><input name="quality_status_list" type="text" class="input_text2" id="quality_status_list"  title="双击选择质检结果"  size="14"  readonly="readonly"  onDblClick="c_quality_status_list('get_quality_status_list');" /><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择质检结果" onClick="c_quality_status_list('get_quality_status_list');"></a></td>
                 <td width="10%" align="right">业务活动：</td>
                 <td><input name="campaign_id_list" type="text" class="input_text2" id="campaign_id_list"  title="双击选择业务活动"  size="16"  readonly="readonly"  onDblClick="c_campaign_id_list('get_campaign_id_list');" /><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择业务活动" onClick="c_campaign_id_list('get_campaign_id_list');"></a></td>
                  
                 <td  align="right">呼叫描述：</td>
                 <td ><input name="call_des" type="text" class="input_text" id="call_des" title="输入要查询的呼叫备注描述"  maxlength="30" /></td>
                <td align="right">
                <ul class="nav nav-pills">
                  <li class="dropdown"> <a class="dropdown-toggle" id="ch_sec_type" href="javascript:void(0)" title="点击设定时长查询类型"> <span>呼叫时长</span> <b class="caret"></b> </a>
                    <ul class="dropdown-menu" id="sec_type_list">
                      <li><a href="javascript:void(0);" title="指自动模式下电话接入坐席或坐席手动拨号到点击挂断提交后时长" len_type="length_in_sec">呼叫时长</a></li>
                      <li><a href="javascript:void(0);" title="指与被叫电话实际接通时长，近似计费时长" len_type="talk_length_sec">通话时长</a></li>
                    </ul>
                  </li>
                </ul>
                
                </td>
                 <td><select name="time_zone" id="time_zone" class="s_option" title="选定时长范围" onChange="select_time_zone(this.value);" style="float:left; margin-right:2px;">
                    <option value="" selected="selected">请选择时长范围</option>
                    <option value="<">小于</option>
                    <option value=">">大于</option>
                    <option value="=">等于</option>
                    <option value="!=">不等于</option>
                    <option value=">=">大于等于</option>
                    <option value="<=">小于等于</option>
                </select>
                 <input name="time_len" id="time_len" style="float:left"  title="填写开始时长范围,单位：秒" value="" size="2" maxlength="4" onKeyUp="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" /> </td>
               </tr>
               <tr>
               	 <td  align="right">呼叫结果：</td>
                 <td ><input name="status_list" type="text" id="status_list"  title="双击选择呼叫结果" value="成功" size="14" readonly="readonly" onDblClick="c_status_list('get_status_list2');" class="input_text2"/><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择呼叫结果" onClick="c_status_list('get_status_list2');"></a></td>
                 <td width="8%" align="right">坐席工号：</td>
                 <td><input name="agent_name_list" type="text" class="input_text2" id="agent_name_list"  title="双击选择坐席工号" size="16" readonly="readonly"  onDblClick="c_agent_list('get_agent_list');"/><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择坐席工号" onClick="c_agent_list('get_agent_list');"></a></td>
                 <td align="right">客户清单：</td>
                 <td><input name="phone_lists_list" type="text" class="input_text2" id="phone_lists_list"  title="双击选择客户清单"  size="16"  readonly="readonly"  onDblClick="c_phone_lists('get_phone_lists');" /><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择客户清单" onClick="c_phone_lists('get_phone_lists');"></a></td>
                 
                 <td width="8%"  align="right" id="td">呼叫方式：</td>
                 <td >
                 	<select name="comments" id="comments" class="s_option">
                        <option value="">全部方式</option>
                        <option value="AUTO">自动</option>
                        <option value="MANUAL">手动</option>
                    </select>
                 </td>
                 
                 
               </tr>
               <tr>
                 <td  align="right" nowrap="nowrap">呼叫时间：</td>
                 <td  colspan="7"><?php select_date("");?></td>
               </tr>
               <tr>
                 <td  align="right">
                 <input type="text" class="dis_none"  name="time_len_type" id="time_len_type" value="length_in_sec" />
                 <input type="text" class="dis_none"  name="status" id="status" value="CG" />
                 <input type="text" class="dis_none"  name="quality_status" id="quality_status" value="" />
                 <input type="text" class="dis_none"  name="agent_list" id="agent_list" value="" />
                 <input type="text" class="dis_none"  name="campaign_id" id="campaign_id" value="" />
                 <input type="text" class="dis_none"  name="phone_lists" id="phone_lists" value="" />
                 <input type="text" class="dis_none"  name="field_list" id="field_list" value="" />
                 <input type="text" class="dis_none"  name="file_type" id="file_type" value="" />
                 </td>
                 <td  colspan="7"><input type="button" name="form_submit" value="提交查询" onClick="check_form('search');" style="cursor:pointer" />
                   <input type="reset" name="button" id="button" value="重置" /></td>
               </tr>
              </table> 
      
            </form>                    
                    
                  
         </fieldset>
            
            
            <div id="excels"  style="height:22px; line-height:22px;"><span><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onClick="check_form('excel');" title="导出详单到Excel"><img src="/images/icons/excel.png" style="margin-top:4px" /><b>导出Xls(默认)&nbsp;</b></a><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="c_field_list('get_fields_list','xls');" title="导出详单到Excel"><img src="/images/icons/excel.png"  style="margin-top:4px"/><b>导出Xls(自定义)&nbsp;</b></a><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="c_field_list('get_fields_list','csv');" title="导出详单到Csv"><img src="/images/icons/notebook.png" style="margin-top:4px"/><b>导出Csv(自定义)&nbsp;</b></a><!--<a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" onclick="check_form('txt_n');" title="导出详单到Txt"><img src="/images/icons/notebook.png" style="margin-top:4px"/><b>导出Txt(保险)&nbsp;</b></a>--></span><span id="xls_addr" style="height:22px; line-height:22px;margin-left:10px"></span><span id="csv_addr" style="height:22px; line-height:22px;margin-left:10px"></span><span id="txt_n_addr" style="height:22px; line-height:22px;margin-left:10px"></span></div>
            <!--<table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" style="display:block"> -->
            <table width="100%" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" >
                  <thead>
                    <tr align="left" class="dataHead">             
                      <th sort="a.phone_number">号码</th>
                      <th sort="c.city" >省份城市</th>
                      <th sort="a.user" >工号</th>
                      <th sort="a.call_date" style="" >呼叫时间</th>
                      <th sort="d.length_in_sec"  title="从发起呼叫到电话挂断的时间，单位：秒">呼叫时长</th>
                      <th sort="h.campaign_name" title="从电话接通到电话挂断的时间，单位：秒">通话时长</th>
                      <th sort="h.campaign_name">业务活动</th>
                      <th sort="a.comments">呼叫方式</th>
                      <th sort="e.status_name">呼叫结果</th>
                      <th sort="c.comments">呼叫描述</th>
                      <th sort="g.status_name">质检结果</th>                      
                      <th style="" align="center">操作</th>
                    </tr>
                  </thead>   
                    <tbody>
                    </tbody>
                    <tfoot><tr class='dataTableFoot'><td colspan='12' align='left'><div id='dataTableFoot'><div style='float:right;' id='pagelist'></div><div style='float:left;' id='total'></div></div></td></tr></tfoot>
              </table>
               
         </td>
  </tr>
 </table>  
</div>
 
</body>
</html>
   
