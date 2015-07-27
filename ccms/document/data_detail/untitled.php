<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<title>亚铭科技电话营销管理系统-选择被叫号段</title>
<link href="/css/main.css?v=2014-06-03" rel="stylesheet" type="text/css">
<link href="/css/list.css?v=2014-06-03" rel="stylesheet" type="text/css" />
<script src="/js/jquery-1.8.3.min.js"></script>
<script src="/js/pub_func.js?v=2014-06-03"></script>
<script src="/js/main.js?v=2014-06-03"></script> 
<script>

var json={"counts":"1","des":"suc","datalist":[{"f_id":"last_name","f_n":"\u59d3\u6c0f","f_v":""},{"f_id":"first_name","f_n":"\u540d\u5b57","f_v":"\u4f59\u79cb\u6885"},{"f_id":"middle_initial","f_n":"\u4e2d\u95f4\u540d","f_v":""},{"f_id":"title","f_n":"\u6807\u9898","f_v":""},{"f_id":"city","f_n":"\u57ce\u5e02","f_v":""},{"f_id":"address3","f_n":"\u5730\u57403","f_v":""},{"f_id":"state","f_n":"\u5730\u533a","f_v":""},{"f_id":"province","f_n":"\u7701\u4efd","f_v":""},{"f_id":"address2","f_n":"\u5730\u57402","f_v":""},{"f_id":"alt_phone","f_n":"\u5907\u7528\u7535\u8bdd","f_v":""},{"f_id":"postal_code","f_n":"\u90ae\u7f16","f_v":""},{"f_id":"address1","f_n":"\u5730\u57401","f_v":""},{"f_id":"date_of_birth","f_n":"\u751f\u65e5","f_v":""},{"f_id":"comments","f_n":"\u5ba2\u6237\u5907\u6ce8","f_v":""},{"f_id":"email","f_n":"\u90ae\u7bb1","f_v":""},{"f_id":"gender","f_n":"\u6027\u522b","f_v":""},{"f_id":"security_phrase","f_n":"\u5b89\u5168\u5bc6\u7801","f_v":""},{"f_id":"vendor_lead_code","f_n":"\u4ee3\u7406\u5546ID","f_v":""},{"f_id":"phone_code","f_n":"\u533a\u53f7","f_v":"086"},{"f_id":"custom_field1","f_n":"swqqwqw","f_v":""}]};

$(document).ready(function() {
	    $("#custom_list_field tfoot tr").show();
		if(parseInt(json.counts)>0){
			 
			$("#custom_list_field tbody tr").remove();
			var tr_str="";
			$.each(json.datalist, function(index,con){ 
			 
				if(index%2==0){
					tr_str+="<tr class=\"data_detail\">\n";
				}
				 
				tr_str+='<td height="22" align="right" nowrap="nowrap">'+con.f_n+'：</td>\n';
				tr_str+='<td><input name="'+con.f_id+'" type="text" id="'+con.f_id+'" value="'+con.f_v+'" size="30" class="s_input" onchange="do_change();" /></td>\n';
				
				if(index%2==1){
					tr_str+="</tr>\n"; 
				}
				
				//console.log(index%2+" - "+tr_str);
			});  
			$("#custom_list_field tbody").append(tr_str);
			d_table_i();
			
		}

});

 
    
</script>
</head>

<body>
 
<div class="page_nav">
  <div class="nav_ico"><img src="/images/page_nav_ico.jpg" /></div>
  <div class="nav_">当前位置：<a href="javascript:void(0);">数据报表</a> &gt; 选择所属客户清单 </div>
  <div class="nav_other"><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><img src="/images/page_reload.jpg" alt="刷新本页"/></a></div>
</div>
<div class="page_main">
  <form action="" method="post" name="form1" id="form1">
     <table  width="99%" align="center" style="margin:4px;border:solid 1px #CCCCCC"  border="0" cellpadding="2" cellspacing="0" bordercolor="#eeeeee" class="td_underline" id="custom_list_field" >
    <thead>
      <tr>
        <td width="100" height="22" align="right" nowrap="nowrap">呼叫号码：</td>
        <td height="22" class="blue"><span style="margin-right:10px;float:left"><?php?></span> <a href='javascript:void(0);' class='zPushBtn' hidefocus='true' tabindex='-1' onselectstart='return false' id="show_details" priv="true" ><img src="/images/icons/icon021a4.gif" /><b id="show_text">显示客户资料&nbsp;</b></a></td>
        <td width="100" align="right" nowrap="nowrap" >业务活动：</td>
        <td class="deepgreen"><?php?></td>
      </tr>
      </thead>
      <tbody>
      <tr class="data_detail">
        <td height="22" align="right" nowrap="nowrap">标题：</td>
        <td height="22"><input name="title" type="text" id="title" value="<?php echo  $title ?>" size="30" class="s_input" onchange="do_change();" /></td>
        <td align="right" nowrap="nowrap" >名字：</td>
        <td ><input name="first_name" type="text" id="first_name" size="30" class="s_input" value="<?php echo  $first_name ?>" onchange="do_change();"/></td>
      </tr>
      </tbody>
    </table>
  </form>
  </fieldset>
  
  <?php
  echo date("Y-m-d",strtotime("-730 day"))." 00:00:01";
 
  ?>
</div>
</body>
</html>
