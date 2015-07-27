<?php 
require("inc/config.ini.php"); 
$today = date("Y-m-d");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="overflow-x:hidden">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<title> <?php echo $system_name ?></title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css" />
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<script src="/js/main.js?v=<?php echo $today ?>"></script>
<style>
.page_main .index_wel{height:30px;display: inline-block;margin-right: auto;margin-left: auto;background: url(../images/main_top_bg.jpg) repeat-x left top;width:100%;padding:4px 0 2px 10px;}
body{background:url(images/index_welcome_bgjpg.jpg) no-repeat right bottom;}
</style>


<script>
 
//获取昨日、上周六个人工作量统计
function get_work_person(table){$('#load_1').show();var url="action=get_work_person&drop_opt="+$("#drop_opt").val()+times;$.ajax({type:"post",dataType:"json",url:"/document/report/send.php",data:url,cache:false,beforeSend:function(){$('#load_1').show('100')},complete:function(){$('#load_1').hide('100')},success:function(json){$("#"+table+" tbody tr").remove();if(parseInt(json.counts)>0){$.each(json.datalist,function(index,con){tr_str="<tr>";tr_str+="<td >"+con.xh+"</td>";tr_str+="<td >"+con.gh+"</td>";tr_str+="<td >"+con.cg+"</td>";tr_str+="<td >"+con.zl+"</td>";tr_str+="<td >"+con.jtl+"</td>";tr_str+="<td >"+con.ztcgl+"</td>";tr_str+="<td >"+con.bhg+"</td>";tr_str+="<td >"+con.sc+"</td>";tr_str+="</tr>";$("#"+table+" tbody").append(tr_str)})}else{$("#"+table+" tfoot tr").hide();tr_str="<tr><td colspan=\"12\" align=\"center\">"+json.des+"</td></tr>";$("#"+table+"").append(tr_str)}setTimeout("data_table_li('"+table+"');",500)}})};
 
//获取昨日、上周六业务统计
function get_work_cam(table){$('#load_2').show();var url="action=get_work_cam&drop_opt="+$("#drop_opt").val()+times;$.ajax({type:"post",dataType:"json",url:"/document/report/send.php",data:url,cache:false,beforeSend:function(){$('#load_2').show('100')},complete:function(){$('#load_2').hide('100')},success:function(json){$("#"+table+" tbody tr").remove();if(parseInt(json.counts)>0){$.each(json.datalist,function(index,con){tr_str="<tr>";tr_str+="<td >"+con.yw+"</td>";tr_str+="<td >"+con.zxs+"</td>";tr_str+="<td >"+con.cg+"</td>";tr_str+="<td >"+con.zl+"</td>";tr_str+="<td >"+con.jtl+"</td>";tr_str+="<td >"+con.ztcgl+"</td>";tr_str+="<td >"+con.wzj+"</td>";tr_str+="<td >"+con.bhgl+"</td>";tr_str+="</tr>";$("#"+table+" tbody").append(tr_str)})}else{$("#"+table+" tfoot tr").hide();tr_str="<tr><td colspan=\"12\" align=\"center\">"+json.des+"</td></tr>";$("#"+table+"").append(tr_str)}setTimeout("data_table_li('"+table+"');",500)}})};

//获取昨日、上周六质检统计
function get_work_qua(table){$('#load_3').show();var url="action=get_work_qua"+times;$.ajax({type:"post",dataType:"json",url:"/document/report/send.php",data:url,cache:false,beforeSend:function(){$('#load_3').show('100')},complete:function(){$('#load_3').hide('100')},success:function(json){$("#"+table+" tbody tr").remove();if(parseInt(json.counts)>0){$.each(json.datalist,function(index,con){tr_str="<tr>";tr_str+="<td >"+con.zjr+"</td>";tr_str+="<td >"+con.bhg+"</td>";tr_str+="<td >"+con.zlc+"</td>";tr_str+="<td >"+con.pt+"</td>";tr_str+="<td >"+con.yx+"</td>";tr_str+="<td >"+con.zjzl+"</td>";tr_str+="</tr>";$("#"+table+" tbody").append(tr_str)})}else{$("#"+table+" tfoot tr").hide();tr_str="<tr><td colspan=\"12\" align=\"center\">"+json.des+"</td></tr>";$("#"+table+"").append(tr_str)}setTimeout("data_table_li('"+table+"');",500)}})};

function set_drop_opt(opt,do_act){
	var url="action=set_drop_opt&drop_opt="+opt+"&do_actions="+do_act+times;
	$.ajax({
		type: "post", 
		dataType: "json", async: false,
		url: "/document/report/send.php",
		data:url,
		cache:false,
		success: function(json){ 
 		 	$("#drop_opt").val(json.drop_opt);
  		} 
	});	
}

function get_user_pope(){
	var url="action=get_user_pope_list&do_actions="+times;
	$.ajax({
		 
		url: "/document/agent/send.php",
		data:url,
		 
		success: function(json){} 
	});	
}

function data_table_li(table){
	$("#"+table+" tbody tr").removeClass("over,alt");$("#"+table+" tbody tr").mouseover(function(){$(this).addClass("over")}).mouseout(function(){$(this).removeClass("over")});$("#"+table+" tbody tr:odd").addClass("alt");
};

$(document).ready(function(){
	set_drop_opt('','');
	get_work_person("data_table1");
	get_work_cam("data_table2");
	get_work_qua("data_table3");
	get_user_pope();
});
  
</script>
  
<?php check_login();?>
</head>

<body>
<input name="drop_opt" id="drop_opt" type="hidden" value="" />

     <div class="page_main page_tops">
         <div class="index_wel"><img src="images/index_wel.gif" /></div>
          
<table width="100%" border="0" align="center" style="border-collapse: separate;border-spacing: 4px;">
          <tr>
            <td valign="top" style="width:50%">
          <fieldset><legend onClick="show_div('data_table1');">昨日坐席工作量统计</legend>
  			<div id="load_1" style="position:absolute;background:#FFFF99;border:1px solid #999;line-height:20px;height: 20px;padding:2px 4px 0 4px;z-index:10"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
            <table width="100%" cellpadding="0" cellspacing="0" class="dataTable" id="data_table1">
            <thead>
              <tr align="left" class="dataHead">
                <td >序</td>
                <td >工号</td>
                <td >成功</td>
                <td >总量</td>
                <td >接通率</td>
                <td >成功率<strong class='font_12'>(整体)</strong></td>
                <td >不合格</td>
                <td >通话时长</td>
              </tr>
              </thead>
              <tbody>
              
              </tbody>    
             
             </table>
            
           </fieldset>
          
            </td>
            <td valign="top" style="width:50%">
          
            <fieldset><legend onClick="show_div('data_table2');">昨日业务统计</legend>
            
            	<div id="load_2" style="position:absolute;background:#FFFF99;border:1px solid #999;line-height:20px;height: 20px;padding:2px 4px 0 4px; z-index:10"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
                <table width="100%" cellpadding="0" cellspacing="0" class="dataTable" id="data_table2">
                <thead>
                  <tr align="left" class="dataHead">
                    <td>业务</td>
                    <td >坐席数</td>
                    <td >成功</td>
                    <td >总量</td>
                    <td >接通率</td>
                    <td >成功率<strong class='font_12'>(整体)</strong></td>
                    <td >未质检</td>
                    <td >不合格率</td>
                  </tr>
                </thead>
                <tbody>
                      
                 </tbody>   
                </table>
            </fieldset> 
            
          
            <fieldset style="margin-top:6px"><legend onClick="show_div('data_table3');">昨日质检工作量统计</legend>
            	<div id="load_3" style="position:absolute;background:#FFFF99;border:1px solid #999;line-height:20px;height: 20px;padding:2px 4px 0 4px; z-index:10"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
              <table width="100%" cellpadding="0" cellspacing="0" class="dataTable" id="data_table3">
              	<thead>
                    <tr align="left" class="dataHead">
                      <td>质检人</td>
                      <td >不合格</td>
                      <td >质量差</td>
                      <td >普通</td>
                      <td >优秀</td>
                      <td >总量</td>
                      
                    </tr>
                </thead>
                <tbody>
                     
                </tbody>
              </table>
              
              </fieldset>  
              
              </td>
          </tr>
          
        </table>         
         
         
</div>

    
</body>
</html>
