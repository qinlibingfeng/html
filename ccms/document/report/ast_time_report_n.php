<?php require("../../inc/config.ini.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xHTML">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<title><?php echo $system_name ?></title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css">
<link href="/css/day.css" rel="stylesheet" type="text/css">
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script src="/document/plugin/highcharts/js/highcharts.js" ></script>
<script src="/document/plugin/highcharts/js/themes/grid.js" ></script> 

<script>
var set_id_1,set_id_2,drpctTODAY=0,answersPCT=0,charts;
var set_t=0;
var agent_ready=0;
var agent_s_ready=0;
var agent_all_c=0;
var sortOrder = 1;
var agent_api = "<?php echo $_SESSION["vdc_agent_api_access"] ?>";
var user_level = "<?php echo $_SESSION["user_level"] ?>";
var monitor_phone="<?php echo $_SESSION['phone_login'] ?>";

var agent_c_n=0,agent_login_n=0,agent_free_n=0,agent_busy_n=0,agent_incall_n=0,callin_n=0,callout_n=0,queue_n=0,incall_n=0,callin_n=0,callout_n=0,queue_n=0,hangup_n=0,agent_u_l=0,user_do_level;

(agent_api =="1"&&parseInt(user_level)>6)?user_do_level=1:user_do_level=0;
  
 
function c_user_group_list(actions){var diag=new Dialog("diag_user_group_list");diag.Width=640;diag.Height=360;diag.Title="选择坐席组";diag.URL="/document/report/list.php?action="+actions+"&tits="+encodeURIComponent("选择坐席组");diag.OKEvent=set_user_group_list;diag.show()};function set_user_group_list(){Zd_DW.do_set_user_group()}

function veiw_calls_wait(actions){var diag=new Dialog("diag_calls_wait_");diag.Width=740;diag.Height=380;diag.Title="查看等待号码";diag.isModal=false;diag.URL="/document/report/list.php?action="+actions+"&tits="+encodeURIComponent("查看等待号码");diag.show();diag.OKButton.hide();diag.CancelButton.value="关 闭";};

jQuery.fn.alterRowColors = function(){
	$('#datatable tbody tr').removeClass('alt');
	$('#datatable tbody tr:visible:odd').addClass('alt');
 	return this;
}
 
function get_sec_dif(times){

	if(!times){return "00:00:00"}
 	
	var hh,mm,ss;
	 
	hh=times/3600|0;
	times=parseInt(times)-hh*3600;
	if(parseInt(hh)<10){hh="0"+hh}
	mm=times/60|0;
	ss=parseInt(times)-mm*60;
	if(parseInt(mm)<10){mm="0"+mm}
	if(ss<10){ss="0"+ss}
	return hh+":"+mm+":"+ss	 
}
  
function get_datalist(){
   	var url="action=agent_realtime_report&sorts="+times+"&"+$('#form1').serialize();
 	
	$.ajax({
		 
		url: "realtime_send_n.php",
		data:url,
		 
		success: function(json){ 
 			 
			var tr_str="",agent_incall=0,agent_ready=0,agent_dead=0,agent_paused=0,agent_ivr=0,out_total=0,in_ivr=0,out_ring=0,out_live=0,group_login=0;
			
			var placed_ing=parseInt($("#placed_ing").html()),
 				incall_ing=parseInt($("#incall_ing").html()),
 				ring_ing=parseInt($("#ring_ing").html()),
 				calls_wait_ing=parseInt($("#calls_wait_ing").html()),
 				ivr_ing=parseInt($("#ivr_ing").html()),
 				agent_wait_ing=parseInt($("#agent_wait_ing").html()),
 				paus_ing=parseInt($("#paus_ing").html()),
 				dead_ing=parseInt($("#dead_ing").html()),
 				login_ing=parseInt($("#agent_login_ing").html()),
 				agent_login,cam_id_list="";
				 
 			if(json.counts=="1"){
				$("#datatable tbody td[reset='y']").html("--").removeClass();
 				$("#datatable tbody .agent_do span").each(function(){$(this).html($(this).attr("tit"));});
 				
				$("#agent_nothing").remove();
 				$("#datatable tbody tr").removeClass("alt");
				user_group_list=$("#user_group").val();
				
 				 
 				$.each(json.datalist, function(index,con){
					
					var tr_class="",status_name="",call_time_s=parseInt(con.call_time_s),user=con.user,incalled=0,hanguped=0,conf_exten=con.conf_exten;
					agent_list=$("#agent_list_"+user);
					
					if($("#agent_list_"+user).length<1){
 					
						tr_str="<tr align=\"left\" id=\"agent_list_"+user+"\" user_group=\""+user+"\">";
						tr_str+="<td><a href='javascript:void(0)'>"+user+" ["+user+"]</a></td>";
						tr_str+="<td>-- [--]</td>";
						tr_str+="<td id=\"agent_l_phone_number_"+user+"\" reset=\"y\">--</td>";
						tr_str+="<td id=\"agent_l_campaign_id_"+user+"\" reset=\"y\">--</td>";
						tr_str+="<td id=\"agent_l_calls_today_"+user+"\" reset=\"y\">--</td>";
						tr_str+="<td id=\"agent_l_call_status_"+user+"\" reset=\"y\">--</td>";
						tr_str+="<td id=\"agent_l_call_time_"+user+"\" reset=\"y\">--</td>";
						tr_str+="<td id=\"agent_l_comments_"+user+"\" reset=\"y\">--</td>";
						tr_str+="<td class=\"agent_do\"><span id=\"monitor_u_"+user+"\" tit=\"监听\">监听</span> <span id=\"barge_u_"+user+"\" tit=\"强插\">强插</span> <span id=\"logout_u_"+user+"\" tit=\"签退\">签退</span></td>";
						tr_str+="</tr>";
						$("#datatable tbody").append(tr_str);
						
						d_table_h();
					}
					
					user_group=agent_list.attr("user_group");
					
					if(user_group_list){
						
						if(user_group_list.indexOf(user_group)>-1){
							agent_list.show();
							group_login++;	
						}else{
							agent_list.hide();	
						}
						
					}else{
						agent_list.show();	
					}
					
  					
					switch(con.call_status){
						case "INCALL":
							status_name="通话中";
							agent_incall++;
							if(call_time_s>10&&call_time_s<61){
								tr_class="tr_sta4";
							}else if(call_time_s>60&&call_time_s<301){
								tr_class="tr_sta5";
							}else if(call_time_s>301){
								tr_class="tr_sta6";
							} 
							
							incalled=1;
							hanguped=1;
							
						break;
						case "QUEUE":
							status_name="队列中";
							agent_incall++;
						break;
						case "3-WAY":
							status_name="三方通话";
							agent_incall++;
							if(call_time_s>10){
								tr_class="tr_sta9";
							}
							incalled=1;
							hanguped=1;
						break;
						case "PARK":
							status_name="通话保持";
							agent_incall++;
							incalled=1;
							hanguped=1;
						break;
						case "READY":
							status_name="坐席等待";
							agent_ready++;
							
							if(call_time_s>61&&call_time_s<301){
								tr_class="tr_sta2";
							}else if(call_time_s>300){
								tr_class="tr_sta3";
							}else{
 								tr_class="tr_sta1";
							}
						break;
						case "CLOSER":
							status_name="坐席等待";
							agent_ready++;
						break;
						case "PAUSED":
							status_name="坐席暂停";
							agent_paused++;
							
							if(call_time_s>10&&call_time_s<61){
								tr_class="tr_sta7";
							}else if(call_time_s>60&&call_time_s<301){
								tr_class="tr_sta8";
							}else if(call_time_s>301){
								tr_class="tr_sta10";
							} 
						break;
						case "DISPO":
							status_name="坐席正在提交";
							agent_paused++;
							if(call_time_s>10&&call_time_s<61){
								tr_class="tr_sta7";
							}else if(call_time_s>60&&call_time_s<301){
								tr_class="tr_sta8";
							}else if(call_time_s>301){
								tr_class="tr_sta10";
							} 
						break;
						case "DEAD":
							status_name="被叫已挂机";
							agent_dead++;
							tr_class="tr_sta11";
							
						break;
 					}
					campaign_name=con.campaign_name?con.campaign_name:"未知业务";
					
 					phone_number=con.phone_number?con.phone_number:"--";
					campaign_id=con.campaign_id?con.campaign_id+" ["+campaign_name+"]":"--";
					calls_today=con.calls_today?con.calls_today:"--";
					call_status=con.call_status?"<span class='black'>"+status_name+" ["+con.call_status+"]<span>":"--";
 					call_time_t=con.call_time_s?get_sec_dif(con.call_time_s):"--";
					comments=con.comments;
 				 
					if(comments=='AUTO'||comments==""){
						comments="自动";	
					}else if(comments=='INBOUND'){
						comments="呼入";		
					}else{
						comments="手动";		
					}
					 
 					$("#agent_l_phone_number_"+user).html(phone_number);
					$("#agent_l_campaign_id_"+user).html(campaign_id);
   					$("#agent_l_calls_today_"+user).html(con.calls_today);
					$("#agent_l_call_status_"+user).html(call_status).removeClass().addClass(tr_class);
					$("#agent_l_call_time_"+user).html(call_time_t);
 					$("#agent_l_comments_"+user).html(comments);
 					
 					if(user_do_level==1){
						
						$("#logout_u_"+user).html("<a href='javascript:void(0)' onclick='send_monitor(\""+conf_exten+"\",\"logout\",\""+user+"\");' title='点击签退 “"+user+"”\n执行后请通知该坐席重新签入！ '>签退</a>");
						
						//if(incalled==1){
							$("#monitor_u_"+user).html("<a href='javascript:void(0)' onclick='send_monitor(\""+conf_exten+"\",\"MONITOR\",\""+user+"\");' title='点击监听 “"+user+"”正在进行的通话！\n须登陆软电话客户端！ '>监听</a>");
							$("#barge_u_"+user).html("<a href='javascript:void(0)' onclick='send_monitor(\""+conf_exten+"\",\"BARGE\",\""+user+"\");' title='点击强插 “"+user+"”正在进行的通话！\n须登陆软电话客户端！ '>强插</a>");
						//}
					}
					
					var cm_l=""; 
					cm_l=","+con.campaign_id+",";
					//alert(cm_l+"--"+cam_id_list+"--"+cam_id_list.indexOf(cm_l));
					if(cam_id_list.indexOf(cm_l)<0){
						cam_id_list+=con.campaign_id+",";
					}
  				}); 
				 
				if($("#campaign_id_list").val()==""){
					
					if(cam_id_list!=""){
						cam_id_list=cam_id_list.substr(0,cam_id_list.length-1);	
					}
					$("#campaign_id").val(cam_id_list);
				}
				
				$('#datatable tbody tr:visible:odd').addClass("alt");
				
 				$.each(json.data_status_list, function(index,con){
					 s_counts=parseInt(con.counts);
  					 if(con.status=="IVR"){
 						in_ivr=s_counts;
					 }else if(con.status=="LIVE"){
						out_live=s_counts;
					 }else{
						out_ring+=s_counts;
					 }
					 out_total+=s_counts; 
				});
  				
 				$("#paus_ing").html(agent_paused);
				$("#dead_ing").html(agent_dead);
				$("#incall_ing").html(agent_incall);
				$("#agent_wait_ing").html(agent_ready);
				$("#ivr_ing").html(in_ivr);
				$("#placed_ing").html(out_total);
				$("#ring_ing").html(out_ring);
				$("#calls_wait_ing").html(out_live);
				
			}else{
				
				$("#paus_ing").html("0");
				$("#dead_ing").html("0");
 				$("#incall_ing").html("0");
				$("#agent_wait_ing").html("0");
				$("#ivr_ing").html("0");
				$("#placed_ing").html("0");
				$("#ring_ing").html("0");
  				$("#calls_wait_ing").html("0");
				$("#agent_login_counts").html("0");
				$("#agent_login_ing").html("0");
				 
 				$("#veiw_calls_wait").fadeOut("fast");
				
				if($("#campaign_id_list").val()==""){
					
					if(cam_id_list!=""){
						cam_id_list=cam_id_list.substr(0,cam_id_list.length-1);	
					}
					$("#campaign_id").val(cam_id_list);
				}
				
  			}
				
			if(json.counts=="1"){
				if(user_group_list){
					agent_login=group_login;
 				}else{
					agent_login=json.datalist.length;	
				}
			}else{
				agent_login=0;
			}
			
			if(agent_login==0){
				$("#agent_nothing").remove();
				$("#datatable tbody td[reset='y']").html("--").removeClass();
				$("#datatable tbody .agent_do span").each(function(){$(this).html($(this).attr("tit"));});
				$("#datatable tbody").append("<tr id='agent_nothing'><td colspan=\"12\" align=\"center\">未找到符合条件的数据!</td></tr>");
				$("#campaign_id").val("");
			}
			
			$("#agent_login_counts,#agent_login_ing").html(agent_login);
 			
			if(agent_login>=login_ing){
				s_class="";
			}else{
				s_class="down";
			}
			$("#agent_login_ed").html(login_ing).removeClass().addClass(s_class);
			
			if(out_total>=placed_ing){
				s_class="";
			}else{
				s_class="down";
			}
			$("#placed_ed").html(placed_ing).removeClass().addClass(s_class);
  			
			if(out_ring>=ring_ing){
				s_class="";
			}else{
				s_class="down";
			}
			$("#ring_ed").html(ring_ing).removeClass().addClass(s_class);
 			 
			if(out_live>=calls_wait_ing){
				s_class="";
			}else{
				s_class="down";
			}
			$("#calls_wait_ed").html(calls_wait_ing).removeClass().addClass(s_class);
 			
			if(out_live>0){
				$("#veiw_calls_wait").fadeIn("fast");
			}else{
 				$("#veiw_calls_wait").fadeOut("fast");
			}
			
			if(agent_incall>=incall_ing){
				s_class="";
			}else{
				s_class="down";
			}
			$("#incall_ed").html(incall_ing).removeClass().addClass(s_class);
			
			if(agent_ready>=agent_wait_ing){
				s_class="";
			}else{
				s_class="down";
			}
			$("#agent_wait_ed").html(agent_wait_ing).removeClass().addClass(s_class);
 			  			 
			if(agent_paused>=paus_ing){
				s_class="";
			}else{
				s_class="down";
			}
			$("#paus_ed").html(paus_ing).removeClass().addClass(s_class);
 			
			if(in_ivr>=ivr_ing){
				s_class="";
			}else{
				s_class="down";
			}
			$("#ivr_ed").html(ivr_ing).removeClass().addClass(s_class);
 			
			if(agent_dead>=dead_ing){
				s_class="";
			}else{
				s_class="down";
			}
			$("#dead_ed").html(dead_ing).removeClass().addClass(s_class);
			 
			set_id_1=setTimeout("get_datalist()",5000);
			$("#set_id_1").val(set_id_1);
 		} 
	});
}


function get_system_report(){

	var url="action=system_realtime_report&"+$('#form1').serialize()+times;
	//alert(url);
	//return false;
	
	$.ajax({
		 
		url: "realtime_send_n.php",
		data:url,
		
		success: function(json){ 
			
			if(json.counts=="1"){
				var dropsTODAY=parseFloat(json.dropsTODAY),answersTODAY=parseFloat(json.answersTODAY),DROPmax=parseFloat(json.DROPmax),d_class="blue",agentsONEMIN=json.agentsONEMIN,DIALtimeout=json.DIALtimeout,callsTODAY=parseFloat(json.callsTODAY);
				
				$("#s_DIALlev").html(num_format(json.DIALlev,4));
				$("#s_maxDIALlev").html(num_format(json.maxDIALlev,2));
				$("#s_DIALmethod").html(json.DIALmethod);
				$("#s_DIALfilter").html(json.DIALfilter);
				$("#s_DIALorder").html(json.DIALorder);
				$("#s_DAleads").html(json.DAleads);
				$("#s_callsTODAY").html(json.callsTODAY);
				
				$("#s_balanceSHORT").html(json.balanceSHORT);
				$("#s_balanceFILL").html(json.balanceFILL);
				$("#s_HOPlev").html(json.HOPlev);
				$("#s_VDhop").html(json.VDhop);
				
				$("#s_answersTODAY,#s_answersTODAY_1").html(answersTODAY);
				$("#s_dropsTODAY").html(dropsTODAY);
				
				if ( dropsTODAY > 0 && answersTODAY > 0 ){
					drpctTODAY=num_format(((dropsTODAY /answersTODAY) * 100),2);
					
					if(drpctTODAY>DROPmax){
						d_class="red font_w";
					}
					
					if(drpctTODAY>12){
						request_tip("系统当前的丢弃数据过多，<span class='font_w'>请调低呼叫级别</span>! 否则将造成不必要的话费和数据损失!",0,6000);
					}
					
				}else{
					drpctTODAY=0;
				}
				
				$("#s_drpctTODAY").html(drpctTODAY+"%").removeClass().addClass(d_class);
				
				if ( callsTODAY > 0 && answersTODAY > 0 ){
					answersPCT=num_format(((answersTODAY /callsTODAY) * 100),2);
					
				}else{
					answersPCT=0;
				}
				$("#s_answersPCT").html(answersPCT+"%");
				$("#s_DROPmax").html(num_format(DROPmax,1)+"%");
				$("#s_DIALstatuses").html(json.DIALstatuses);
				$("#s_DIALtimeout").html(num_format(DIALtimeout,2));
				
			}else{
				
				drpctTODAY=0,answersPCT=0;
				$("#s_answersPCT").html("0%");
				$("#s_DIALlev").html("0");
				$("#s_maxDIALlev").html("0");
				$("#s_DIALmethod").html("0");
				$("#s_DIALfilter").html("0");
				$("#s_DIALorder").html("0");
				$("#s_DAleads").html("0");
				$("#s_callsTODAY").html("0");
				$("#s_agentsONEMIN").html("0");
				$("#s_balanceSHORT").html("0");
				$("#s_balanceFILL").html("0");
				$("#s_HOPlev").html("0");
				$("#s_VDhop").html("0");
				$("#s_dropsTODAY").html("0");
				$("#s_answersTODAY,#s_answersTODAY_1").html("0");
				$("#s_drpctTODAY").html("0%").removeClass().addClass("blue");
				$("#s_DROPmax").html("0%");
				$("#s_DIALstatuses").html("0");
				$("#s_DIALtimeout").html("0");
 			}
			$("#s_NOW_TIME").html(json.NOW_TIME);
			
			set_id_2=setTimeout("get_system_report()",15000);
			$("#set_id_2").val(set_id_2);
			
			$("#input_answersPCT").val(answersPCT);
			$("#input_drpctTODAY").val(drpctTODAY);
			
			/*if(charts){
				var series_1 = charts.series[0],series_2 = charts.series[1]
				,x = (new Date()).getTime(),
					v1 = drpctTODAY,
					v2 = answersPCT;
				series_1.addPoint([x, v1], false, true);
				series_2.addPoint([x, v2], false, true);
				charts.redraw();
			}*/
		} 
	});
}

function claer_t(set_id){
	if(set_id=="1"){
		id=$("#set_id_1").val()
		clearTimeout(id);
	}if(set_id=="2"){
		id=$("#set_id_2").val()
		clearTimeout(id);
	}else{
		return false;
	}
} 
 
function system_load(){	
	var url="http://<?php echo $db_server_ip ?>/document/system/server_load.php?sys=yes"+times+"&callback=?";
	
	$.getJSON(url,function(json){
		if(json.counts=="1"){
			var load_1=parseFloat(json.load_1),load_5=parseFloat(json.load_5),load_15=parseFloat(json.load_15),calss_1="green",calss_5="green",calss_15="green";
			if(load_1>0.7){
				calss_1="red";
			}
			if(load_5>0.7){
				calss_5="red";
			}
			if(load_15>0.7){
				calss_15="red";
			}
			
			$("#load_1").removeClass().addClass(calss_1).html(load_1);
			$("#load_5").removeClass().addClass(calss_5).html(load_5);
			$("#load_15").removeClass().addClass(calss_15).html(load_15);
		}else{
			$("#load_1").removeClass().addClass("red").html("0");
			$("#load_5").removeClass().addClass("red").html("0");
			$("#load_15").removeClass().addClass("red").html("0");
		}
	});
	setTimeout("system_load()",60000);
}

function num_format(v,e){
	return parseFloat(v).toFixed(e);
}
 
var chart_Int_id=null;
function set_charts(){
	charts = null;
	charts = new Highcharts.Chart({
		chart: {
			renderTo: 'chart_con',
			type: 'spline',
			marginRight: 10,
			events: {
				 load: function() {
					
					var series_1 = this.series[0],series_2 = this.series[1];
					chart_Int_id=setInterval(function() {
						var x = (new Date()).getTime(),
							v1 = parseFloat($("#input_drpctTODAY").val()),
							v2 = parseFloat($("#input_answersPCT").val());
 							//,y = Math.random();
							
						series_1.addPoint([x, v1], true, true);
						series_2.addPoint([x, v2], true, true);
						//charts.redraw();
					},15000);
					 
				 } 
			}
		},
		title: {
			text: '应答与丢弃比率走势<em class="gray"> (15秒)</em>'
		},
		xAxis: {
			type: 'datetime',
			tickPixelInterval: 150
		},
		yAxis: {
			labels: {
                formatter: function() {
                    return this.value + '%'
                } 
            }
 			,title: {
				text: '比率'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
				return '<span style="color:' + this.series.color + '">'+ this.series.name +'</span><br/>'+
				Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
				'<strong>'+Highcharts.numberFormat(this.y, 2)+"</strong> %";
			}
		}, plotOptions: {
            column: {
                dataLabels: {
                    enabled: false
                },
                enableMouseTracking: true
            },
            spline: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: true
            } 
         },
		legend: {
			 
			align: 'right',
			verticalAlign: 'top',
			x: 2,
			y: 2,
			floating: true,
			backgroundColor: '#FFFFFF',
			borderWidth: 1
		},
		series: [{
			name: '丢弃率',
			data: (function() {
			   
				var data = [],
					time = (new Date()).getTime(),
					i;

				for (i = -19; i <= 0; i++) {
					data.push({
						x: time + i * 15000,
						y: parseFloat($("#input_drpctTODAY").val())
					});
				}
				return data;
			})()
		},{
			name: '应答率',
			data: (function() {
			   
				var data = [],
					time = (new Date()).getTime(),
					i;

				 for (i = -19; i <= 0; i++) {
					data.push({
						x: time + i * 15000,
						y: parseFloat($("#input_answersPCT").val())
					});
				} 
				return data;
			})()
		}
 		]
	});	
};
 
function send_monitor(session_id,stage,user){
	
	if(user_do_level==0){
		request_tip("您的账号级别小于7,操作无法完成!请更换管理员用户重试!",0);
		return false;
	}
	
 	server_ip="<?php echo $db_server_ip?>";
	 
 	var datas = "action=blind_monitor&source=realtime&user="+user+"&pass="+user+"&phone_login="+monitor_phone+"&session_id="+ session_id+'&server_ip='+server_ip+'&stage='+stage+times;
  	
	if(stage=="logout"){
		if(confirm("签退操作将会使“ "+user+" ”，退出当前正在登录的业务活动，且通话记录无法正常保存！\n\n您确认要执行签退吗？\n点击 确定 继续，点击 取消 返回！")){
			 
		}else{
			return false;	
		}	
	}else{
		
		if(confirm("本操作需要登录软电话客户端，请签入坐席级别 >7 的工号！\n如已进行过多次本操作请先点击客户端挂机按钮重试\n\n您确认已签入客户端并挂断上次操作了吗？\n点击 确定 继续，点击 取消 返回！")){
			 
		}else{
			return false;	
		}		
	}
 	
	$.ajax({
		 
		url: "realtime_send_n.php",
		data:datas,		
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){ 
			request_tip(json.des,json.counts);
 			
		},error:function(XMLHttpRequest,textStatus ){
			 
		}
	});
	 
};

function sort_table(td){
	var findSortKey;
 	var $table = $('#datatable');
	td=$(td);
	
	findSortKey = function($cell) {
		 return $cell.find('.sort-title').text().toUpperCase() + '' + $cell.text().toUpperCase();
	}
	 
	if (findSortKey) {
 		sortOrder = 0;
 		
		td.addClass("thOver").find('span').removeClass().addClass("sorting_desc");
		var rows = $table.find('tbody > tr').get();
		$.each(rows,function(index, row) {
			row.sortKey = findSortKey($(row).children('td').eq(5));
 		});
		rows.sort(function(a, b) {
			if (sortOrder == 1) {
 				if (a.sortKey < b.sortKey) return - 1;
				if (a.sortKey > b.sortKey) return 1;
				return 0;
 			} else {
 				if (a.sortKey < b.sortKey) return 1;
				if (a.sortKey > b.sortKey) return - 1;
				return 0;
			}
 		});
		$.each(rows,function(index, row) {
			$table.children('tbody').append(row);
			row.sortKey = null;
 		});
		$table.alterRowColors();
 	}
}
   
function get_agent_list(){
	
	var url="action=get_agent_list&do_actions=list&sorts="+$('#sorts').val()+"&order="+$('#order').val()+times;
	agent_ready=0;
	
	$.ajax({
	
		url: "realtime_send_n.php",
		data:url,
		 
		beforeSend:function(){$('#load').css("top",$(document).scrollTop()).show('100');},
		complete :function(){$('#load').hide('100');},
		success: function(json){
			json_list=json;
  			var th="",td="",tr="",clk_event="",span="";
 			$("#datatable tbody tr").remove();
    			
			if(parseInt(json.counts)>0){
 				var tits="",tr_str="";
				agent_all_c=json.datalist.length;
				$("#agent_counts").html(agent_all_c);
				$.each(json.datalist, function(index,con){
					var user=con.user;
  					
					do_edit="<span id=\"monitor_u_"+user+"\" tit=\"监听\">监听</span> <span id=\"barge_u_"+user+"\" tit=\"强插\">强插</span> <span id=\"logout_u_"+user+"\" tit=\"签退\">签退</span>";
					
					tr_str="<tr align=\"left\" id=\"agent_list_"+user+"\" user_group=\""+con.user_group+"\">";
 					tr_str+="<td><a href='javascript:void(0)'>"+user+" ["+con.full_name+"]</a></td>";
					tr_str+="<td>"+con.user_group +" ["+con.group_name+"]</td>";
					tr_str+="<td id=\"agent_l_phone_number_"+user+"\" reset=\"y\">--</td>";
					tr_str+="<td id=\"agent_l_campaign_id_"+user+"\" reset=\"y\">--</td>";
   					tr_str+="<td id=\"agent_l_calls_today_"+user+"\" reset=\"y\">--</td>";
					tr_str+="<td id=\"agent_l_call_status_"+user+"\" reset=\"y\">--</td>";
					tr_str+="<td id=\"agent_l_call_time_"+user+"\" reset=\"y\">--</td>";
 					tr_str+="<td id=\"agent_l_comments_"+user+"\" reset=\"y\">--</td>";
					tr_str+="<td class=\"agent_do\">"+do_edit+"</td>";
					tr_str+="</tr>";
 					$("#datatable tbody").append(tr_str);
				});
				
				get_datalist();
				
				agent_ready=1;
			}else{
				agent_ready=0;
				
				tr_str="<tr><td colspan=\"12\" align=\"center\">"+json.des+"</td></tr>"
				$("#datatable").append(tr_str);
			}
			 
			d_table_h();
 			
			$("#datatable thead span.sorting").remove();
			var $table = $('#datatable');
		
			$('th',$table).each(function(column){
				
				var findSortKey;
				if ($(this).is('.sort-title')){
					var h_text=$(this).attr("h_text");
					$(this).html("<div>"+h_text+"<span class='sorting'></span></div>");
					 
					findSortKey = function($cell) {
						 return $cell.find('.sort-title').text().toUpperCase()+ $cell.text().toUpperCase();
					}
 				}
  				if (findSortKey) {
					$(this).click(function() {
						
						$th=$table.find('th');
						$th.removeClass('thOver');
						$th.find('span').removeClass().addClass("sorting");
						
						$(this).addClass('thOver');
						sortOrder = sortOrder == 0 ? 1 : 0;
						sort_cls = sortOrder == 0 ? "sorting_desc" : "sorting_asc";
						
						$(this).find('span').removeClass().addClass(sort_cls);
 						var rows = $table.find('tbody > tr').get();
						 
 						$.each(rows,function(index, row) {
							
							row.sortKey = findSortKey($(row).children('td').eq(column));
		
						});
 						rows.sort(function(a, b) {
							if (sortOrder == 1) {
								//升序
								if (a.sortKey < b.sortKey) return - 1;
								if (a.sortKey > b.sortKey) return 1;
								return 0;
		
							} else {
								//降序
								if (a.sortKey < b.sortKey) return 1;
								if (a.sortKey > b.sortKey) return - 1;
								return 0;
 							}
		
						});
 						$.each(rows,function(index, row) {
							$table.children('tbody').append(row);
							row.sortKey = null;
		
						});
 						$table.alterRowColors();
		
					});
 				}
 			});
			
		},error:function(XMLHttpRequest,textStatus ){
		    
		}
	});	
 	
}

$(document).ready(function(){
 	$("#auto_save_res").css("display","none");
  	
	get_agent_list();
	
	get_system_report();
	
	system_load();
	
	Highcharts.setOptions({
		global: {
			useUTC: false
		}
	});
  	
	$("#charts_btn").click(function(){
		var con = $("#chart_con");
		 
		if (con.is(":visible")){
			con.hide();
			$(this).attr("title","显示应答与丢弃率图表").contents("b").html("显示应答与丢弃率图表");
			charts=null;
			if(chart_Int_id){
				clearInterval(chart_Int_id);
			}
		}else{
 			con.show();
 			$(this).attr("title","隐藏应答与丢弃率图表").contents("b").html("隐藏应答与丢弃率图表");
			set_charts();
		}
	}); 
  
});
  
</script>
<style>
.generalInfo ul{background: url("/images/agent_c/g_bg.jpg") repeat-x scroll 0 0 transparent;border: 1px solid #CACCCC;height: 60px;position: relative;}
.generalInfo li{background: url("/images/agent_c/g_bg.jpg") repeat-x scroll 0 0 transparent;border-left: 1px solid #EEEFEF;cursor: pointer;float: left;padding: 6px 0 12px 0;text-align: center;width: 10.8%;height: 40px;}
.generalInfo li:hover{background: #FFFFFF repeat scroll 0 0;}
.generalInfo span{color: #838484;}
.generalInfo b{background: url("/images/agent_c/generalArr.gif") no-repeat scroll 0 0 transparent;bottom: -7px;display: none;height: 7px;left: 48%;overflow: hidden;position: absolute;width: 12px;}
.generalInfo p{margin: 4px 0 0;}
.generalInfo strong{font-family: Arial;font-size: 16px;font-weight: bolder;margin: 0 6px 0 0;}
.generalInfo em{background: url("/images/agent_c/upAndDow_up.gif") no-repeat scroll 0 2px transparent;color: #91B958;font-family: SimSun;font-size: 12px;line-height: 14px;padding: 0 0 0 10px;}
.generalInfo em.down{background: url("/images/agent_c/upAndDow_down.gif") no-repeat scroll 0 2px transparent;color: #EF3248;}
.generalInfo em, .generalInfo strong{vertical-align: bottom;}
.age_sta_ico em{background: url(/images/agent_c/agent_status_ico.png) no-repeat 0px 0px;display: block;height: 14px;width: 11px;float: left;margin-top: 3px;cursor: pointer;margin-right: 4px}

/*.age_sta_ico .sta1 { background-position: 0px 0px; }
.age_sta_ico .sta2 { background-position: 0px -27px; }
.age_sta_ico .sta3 { background-position: 0px -53px; }
.age_sta_ico .sta4 { background-position: 0px -80px; }
.age_sta_ico .sta5 { background-position: 0px -106px; }
.age_sta_ico .sta6 { background-position: 0px -133px; }
.age_sta_ico .sta7 { background-position: 0px -160px; }
.age_sta_ico .sta8 { background-position: 0px -186px; }
.age_sta_ico .sta9 { background-position: 0px -212px; }
.age_sta_ico .sta10 { background-position: 0px -239px; }
.age_sta_ico .sta11 { background-position: 0px -265px; }

 dataTable .tr_sta1 { background: #E0F6FE }
.dataTable .tr_sta2 { background: #B9EDFF }
.dataTable .tr_sta3 { background: #92C9FF }
.dataTable .tr_sta4 { background: #FDE7E1 }
.dataTable .tr_sta5 { background: #FFCFFB }
.dataTable .tr_sta6 { background: #FFA6FF }
.dataTable .tr_sta7 { background: #FFFFCC }
.dataTable .tr_sta8 { background: #FFE8A6 }
.dataTable .tr_sta9 { background: #7FD87F }
.dataTable .tr_sta10 { background: #ECD17F }
.dataTable .tr_sta11 { background: #999999 } 

.dataTable .tr_sta1 { background: #E9F9FE }
.dataTable .tr_sta2 { background: #CEF3FF }
.dataTable .tr_sta3 { background: #B2D9FF }
.dataTable .tr_sta4 { background: #FEEEEA }
.dataTable .tr_sta5 { background: #FFDDFC }
.dataTable .tr_sta6 { background: #FFC0FF }
.dataTable .tr_sta7 { background: #FFFFDB }
.dataTable .tr_sta8 { background: #FFEFC0 }
.dataTable .tr_sta9 { background: #A5E4A5 }
.dataTable .tr_sta10 { background: #F2DFA5 }
.dataTable .tr_sta11 { background: #B7B7B7 }*/
 
.dataTable .tr_sta1 { background: #E3F7FE }
.dataTable .tr_sta2 { background: #C0EFFF }
.dataTable .tr_sta3 { background: #9DCEFF }
.dataTable .tr_sta4 { background: #FEEAE4 }
.dataTable .tr_sta5 { background: #FFD4FB }
.dataTable .tr_sta6 { background: #FFAFFF }
.dataTable .tr_sta7 { background: #FFFFD1 }
.dataTable .tr_sta8 { background: #FFEBAF }
.dataTable .tr_sta9 { background: #8CDC8C }
.dataTable .tr_sta10 { background: #EED68C }
.dataTable .tr_sta11 { background: #A3A3A3 } 
.hide_tit{width:140px;}
#chart_con{margin-top:6px;height:200px;display:none}
 </style>
</head>
<body>
<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>
<div class="page_main">
<input type="hidden" name="set_id_2" id="set_id_2" value="" />
<input type="hidden" name="set_id_1" id="set_id_1" value="" />

<input type="hidden" name="input_drpctTODAY" id="input_drpctTODAY" value="0" />
<input type="hidden" name="input_answersPCT" id="input_answersPCT" value="0" />

<form action="" onsubmit=""  method="post" name="form1" id="form1">
  <input type="text" name="campaign_id" id="campaign_id" value="" />
  <input type="hidden" name="user_group" id="user_group" value="" />
  <table border="0" cellpadding="0" cellspacing="0" class="menu_list">
    <tr>
      <td width="160"><a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' priv="true" title="显示应答与丢弃率图表" id="charts_btn"><img src="/images/icons/icons_46.gif" style="margin-top:4px"/><b>显示应答与丢弃率图表&nbsp;</b></a></td>
      <td width="70" align="right">业务活动：</td>
      <td width="140"><input name="campaign_id_list" type="text" class="input_text2" id="campaign_id_list"  title="双击选择业务活动" size="16"  readonly="readonly" style="float:left;margin-right:4px" ondblclick="c_campaign_id_list('get_campaign_id_list');" /><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择业务活动" onclick="c_campaign_id_list('get_campaign_id_list');"></a></td>
      <td width="60" align="right" >坐席组：</td>
      <td width="140" ><input name="user_group_list" type="text" class="input_text2" id="user_group_list"  title="双击选择坐席组" size="16" readonly="readonly" style="float:left;margin-right:4px" ondblclick="c_user_group_list('get_user_group_list');"/><a class="sel_" hidefocus="true" href="javascript:void(0);" title="点击选择坐席组" onclick="c_user_group_list('get_user_group_list');"></a></td>
      <td align="left"><input type="button" value="提交查询" onclick="claer_t('1');claer_t('2');get_agent_list();get_system_report();"/></td>
      <td align="left">&nbsp;</td>
      
    </tr>
  </table>
</form>
  <table width="99%" border="0" align="center" cellpadding="0" class="blocktable" >
    <tr>
      <td valign="top" style="">
        <fieldset>
          <legend>
          <label><strong onclick="show_div('search_list');">系统整体状态</strong></label>
          </legend>
          <table width="100%" border="0" align="center"  cellspacing="0" id="search_list" class="search_table" >
              <tr>
                <td width="10%" height="26" align="right">拨号级别：</td>
                <td><span id="s_DIALlev" class="blue" style="margin-right:10px">0</span><span id="s_maxDIALlev" class="gray"  title="最大拨号级别">0</span></td>
                <td width="10%" align="right">拨号模式：</td>
                <td><span id="s_DIALmethod" class="blue">0</span></td>
                <td width="10%" align="right">过滤规则：</td>
                <td><span id="s_DIALfilter" class="blue">0</span></td>
                <td width="10%" align="right">取号顺序：</td>
                <td><span id="s_DIALorder" class="blue">0</span></td>
                <td width="10%" align="right">可拨号码：</td>
                <td><span id="s_DAleads" class="blue">0</span></td>
              </tr>
              <tr>
                <td align="right">呼叫/应答：</td>
                <td><span id="s_callsTODAY" class="blue">0</span> / <span id="s_answersTODAY_1" class="blue">0</span></td>
                <td width="10%" align="right">应答率：</td>
                <td><span id="s_answersPCT" class="blue" title="应答率=应答数/今日呼叫">0</span></td>
                <td width="10%" align="right">中继线路：</td>
                <td title="短缺/充足"><span id="s_balanceSHORT" class="blue">0</span> / <span id="s_balanceFILL" class="blue">0</span></td>
                <td align="right">漏斗级别：</td>
                <td><span id="s_HOPlev" class="blue" title="所有激活使用业务漏斗级别和">0</span></td>
                <td align="right">漏斗缓存：</td>
                <td><span id="s_VDhop" class="blue" title="所有激活使用业务漏斗缓存和">0</span></td>
              </tr>
              <tr>
                <td align="right">丢弃/应答：</td>
                <td><span id="s_dropsTODAY" class="blue">0</span> / <span id="s_answersTODAY" class="blue">0</span></td>
                <td align="right">丢弃率：</td>
                <td><span id="s_drpctTODAY" class="blue" style="margin-right:10px">0%</span><span id="s_DROPmax" class="gray" title="最大丢弃率">0%</span></td>
                <td align="right">拨号状态：</td>
                <td><div id="s_DIALstatuses" class="blue hide_tit" style="overflow:hidden">NEW</div></td>
                <td align="right">呼叫超时：</td>
                <td><span id="s_DIALtimeout" class="blue" title="平均呼叫超时时间">0</span></td>
                <td align="right">系统时间：</td>
                <td><span id="s_NOW_TIME" class="blue"><?php echo date("Y-m-d H:i:s") ?></span></td>
              </tr>
            </table>
          
        </fieldset>
        <div class="generalInfo">
          <ul>
            <li title="登陆坐席：登陆本平台坐席数"> <span>登陆坐席</span>
              <p> <strong id="agent_login_ing">0</strong> <em id="agent_login_ed">0</em> </p>
            </li>
            
            <li title="通话坐席：正在通话的坐席数"> <span>通话坐席</span>
              <p> <strong id="incall_ing">0</strong> <em id="incall_ed">0</em> </p>
            </li>     
            <li title="等待坐席：正在等待进话坐席"> <span>等待坐席</span>
              <p> <strong id="agent_wait_ing">0</strong> <em id="agent_wait_ed">0</em> </p>
            </li>
            <li title="暂停坐席：点击暂停按钮、电话已挂断但未提交的坐席"> <span>暂停坐席</span>
              <p> <strong id="paus_ing">0</strong> <em id="paus_ed">0</em> </p>
            </li>
            
            <li title="休止坐席：被叫客户已挂机，坐席还未提交"> <span>休止坐席</span>
              <p> <strong id="dead_ing">0</strong> <em id="dead_ed">0</em> </p>
            </li>
            
            <li title="正在呼叫：正在呼叫的电话数"> <span>正在呼叫</span>
              <p> <strong id="placed_ing">0</strong> <em id="placed_ed">0</em> </p>
            </li>
            <li title="正在振铃：正在振铃呼叫的号码"> <span>正在振铃</span>
              <p> <strong id="ring_ing">0</strong> <em id="ring_ed">0</em> </p>
            </li>
            <li title="队列电话：已呼通被叫，等待空闲坐席接听" > <span>队列电话 <i id="veiw_calls_wait" style="display:none">[<a href="javascript:void(0)" title="点击查看等待电话详单" onclick="veiw_calls_wait('get_calls_wait_list')">查看</a>]</i></span>
              <p> <strong id="calls_wait_ing">0</strong> <em id="calls_wait_ed">0</em> </p>
            </li>
            <li title="IVR：正在IVR中的电话数"> <span>IVR</span>
              <p> <strong id="ivr_ing">0</strong> <em id="ivr_ed">0</em> </p>
            </li>
          </ul>
        </div>
        
        <div id="chart_con"></div>
        
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="dataTable" id="datatable" style="margin-top:4px;" >
          <thead>
            <tr align="left" class="dataHead">
              <th class="sort-title" h_text="坐席工号" id="td_l_1">坐席工号</th>
              <th class="sort-title" h_text="坐席组" id="td_l_2">坐席组</th>
              <th class="sort-title" h_text="通话号码" id="td_l_3">通话号码</th>
              <th class="sort-title" h_text="业务活动" id="td_l_4">业务活动</th>
              <th class="sort-title" h_text="今日呼叫" id="td_l_5">今日呼叫</th>
              <th class="sort-title" h_text="坐席状态" id="td_l_6">坐席状态</th>
              <th class="sort-title" h_text="持续时长" id="td_l_7">持续时长</th>
              <th class="sort-title" h_text="呼叫模式" id="td_l_8">呼叫模式</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="9">坐席数：<span id="agent_counts" class="blue" style="margin-right:10px">0</span> 登陆数：<span id="agent_login_counts" class="blue" style="margin-right:10px">0</span> 系统负载：<span id="system_load_average" class="blue" title="系统单位时间内平均负载"><span class="gray">1分钟:<em class="green" id="load_1">0</em></span> , <span class="gray">5分钟:<em class="green" id="load_5">0</em></span> , <span class="gray">15分钟:<em class="green" id="load_15">0</em></span></span></td>
            </tr>
          </tfoot>
      </table></td>
    </tr>
  </table>
</div>
</body>
</html>
