<?php 
 
require("inc/config.ini.php"); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xHTML">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<title><?php echo $system_name ?></title>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css">
<script src="/js/jquery-1.8.3.min.js"></script>
<style type="text/css">
html,body{height:100%;overflow:auto;}
html{border:0;}
body{background: url(images/top_bg.jpg) no-repeat center -10px;margin:0;}
.login_form{height: 270px;width: 618px;margin-right: auto;margin-left: auto;padding-top: 160px;position: relative;}
.login_form .login_2{background: url(images/login_bg_2.jpg) no-repeat left top;height: 100px;width: 618px;}
.login_form .login_user{float: left;height: 28px;width: 300px;position: relative;background: url(images/login_input_user.jpg) no-repeat left 1px;margin-top: 20px;margin-left:104px;display: inline;text-align: left;padding-left: 2px;padding-top: 2px;}
.login_form .login_pass{float: left;height: 28px;width: 300px;position: relative;background: url(images/login_input_pass.jpg) no-repeat left 1px;margin-top: 6px;margin-left: 104px;display: inline;text-align: left;padding-left: 2px;padding-top: 2px;}
.login_form #username,.login_form #password{font-size: 14px;line-height: 20px;background: #003B65;height: 19px;width: 110px;border-style: none;padding-left: 4px;color: #FFF;}
.login_form .login_3{background: url(images/login_bg_3.jpg) no-repeat left top;height: 56px;width: 558px;padding-left: 60px;padding-top: 4px;}
.login_form .login_sub{float: left;height: 26px;width: 80px;display: inline;margin-right: 14px;}
.login_form .login_foot{background: url(images/login_foot.jpg) no-repeat center top;height: 60px;width: 618px;text-align: center;padding-top: 12px;color: #666;}
.borders{padding:10px;border: 1px solid #aecbd4; height:220px; width:240px;background:#FCFDFE;}
/*.load_layer{right:6px;position: absolute;top:6px;background:#FFFF99;border:1px solid #999;line-height:20px;height: 20px;padding:2px 4px 0 4px; z-index:200;float:left;display:inline;}
.load_layer img{margin-right:4px;margin-top:-2px !important;_margin-top:-1px;}*/
.ie6-warning{display:none;width:100%;position:absolute;top:0;left:0;background:#ffffe1;padding:5px 0;font-size:12px; text-align:center;z-index:400}
.ie6-warning p{width:960px;margin:0 auto;}

</style>


<script language="javascript"> 
function request_tip(tip,is_yes,times){if(times==""||times==null){times=4300}$('#auto_save_res').html(tip).css({top:$(document).scrollTop(),right:($(document).width()-$('#auto_save_res').outerWidth())/2}).fadeIn("slow");if(is_yes=="1"){$('#auto_save_res').removeClass("red_layer").addClass("green_layer")}else{$('#auto_save_res').removeClass("green_layer").addClass("red_layer")}setTimeout("$('#auto_save_res').fadeOut('fast');",times)};
 
function fTrim(str){return str.replace(/(^\s*)|(\s*$)/g,"")};function fLoginFormSubmit(){$("#load").show();if($("#username").val()==""){alert("\请输入您的用户名！");$("#username").focus();return false}if($("#password").val()==""){alert("\请输入您的密码！");$("#password").focus();return false}var url="action=user_login&username="+encodeURIComponent($('#username').val())+"&userpass="+encodeURIComponent($('#password').val())+"&r="+Math.random();$.ajax({type:"post",dataType:"json",url:"/document/agent/send.php",data:url,async:false,cache:false,beforeSend:function(){$('#load').css("top",$(document).scrollTop());$('#load').show('100')},complete:function(){$('#load').hide('100')},success:function(json){request_tip(json.des,json.counts);if(json.counts=="1"){document.location.href='/main.php'}else{$("#username").focus()}},error:function(XMLHttpRequest,textStatus){alert("页面请求错误，请联系系统管理员！\n"+textStatus)}});return false};function getEvent(evt){if(document.all)return window.event;if(evt){if((evt.constructor==Event||evt.constructor==MouseEvent)||(typeof(evt)=="object"&&evt.preventDefault&&evt.stopPropagation)){return evt}}func=getEvent.caller;while(func!=null){var arg0=func.arguments[0];if(arg0){if((arg0.constructor==Event||arg0.constructor==MouseEvent)||(typeof(arg0)=="object"&&arg0.preventDefault&&arg0.stopPropagation)){return arg0}}func=func.caller}return null};document.onkeydown=function(event){event=getEvent(event);if(event.keyCode==13){fLoginFormSubmit();return false}};
$(document).ready(function(e){$("#load,#auto_save_res").hide();var iFlash=null;var version=null;var player;var plugin;var isIE=navigator.userAgent.toLowerCase().indexOf("msie")!=-1
if(isIE){if(window.ActiveXObject){var control=null;try{control=new ActiveXObject('ShockwaveFlash.ShockwaveFlash');}catch(e){iFlash=false;}
if(control){iFlash=true;}}}else{if(navigator.plugins){for(var i=0;i<navigator.plugins.length;i++){if(navigator.plugins[i].name.toLowerCase().indexOf("shockwave flash")>=0){iFlash=true;version=navigator.plugins[i].description.substring(navigator.plugins[i].description.toLowerCase().lastIndexOf("Flash ")+6,navigator.plugins[i].description.length);}}}}
try{if(window.ActiveXObject){player=new ActiveXObject("WMPlayer.OCX.7");}else if(window.GeckoActiveXObject){player=new GeckoActiveXObject("WMPlayer.OCX.7");}}catch(oError){}
try{if(navigator.mimeTypes){plugin=navigator.mimeTypes['application/x-mplayer2'].enabledPlugin;}}catch(oError){}
if($.browser.msie&&$.browser.version=="6.0"){$("#ie6-warning").show();}
if(!player&&!plugin){$("#warning_wmp").show();}
if(!iFlash){$("#warning_flash").show();if($.browser.msie){$("#install_flash_link").attr("href","http://get.adobe.com/cn/flashplayer/download/?installer=Flash_Player_11_for_Internet_Explorer&os=Windows 7&browser_type=MSIE&browser_dist=OEM&d=McAfee_Security_Scan_Plus_IE_Browser&p=gtb,chr&dualoffer=false")}else{$("#install_flash_link").attr("href","http://get.adobe.com/cn/flashplayer/download/?installer=Flash_Player_11_for_Other_Browsers&os=Windows%207&browser_type=Gecko&browser_dist=Firefox&d=McAfee_Security_Scan_Plus_FireFox_Browser&dualoffer=false")}}
var top=0;$("div.ie6-warning:visible").map(function(){index=$(this).index();if(index!=0){top+=29;$("div.ie6-warning:visible:eq("+index+")").css({"top":top+"px"});}});});
</script>
</head>
<body>
 
<div class="ie6-warning" id="ie6-warning"><p>尊敬的用户您好，您正在使用 <strong>IE6</strong>，可能会导致本系统的使用出现异常。请升级到 <a href="http://download.microsoft.com/download/1/6/1/16174D37-73C1-4F76-A305-902E9D32BAC9/IE8-WindowsXP-x86-CHS.exe" target="_blank"><strong>IE8</strong></a>、<a href="http://www.microsoft.com/china/windows/internet-explorer/" target="_blank"><strong>9</strong></a> 或以下浏览器：
<a href="http://www.mozillaonline.com/" target="_blank"><strong>Firefox</strong></a> / <a href="http://www.google.com/chrome/?hl=zh-CN" target="_blank"><strong>Chrome</strong></a> </p></div>

<div class="ie6-warning" id="warning_flash"><p>尊敬的用户您好，您正在使用的浏览器不支持<strong>Flash</strong>插件，请<a id="install_flash_link" href="" target="_blank"><strong> 安装Flash </strong></a>插件后，关闭浏览器重新打开本系统！</p></div>

<div class="ie6-warning" id="warning_wmp"><p>尊敬的用户您好，您正在使用的浏览器不支持<strong>Windows Media Player</strong>组件，或该组件已损坏，请<a id="install_wmp_link" href="http://windows.microsoft.com/zh-cn/windows/download-windows-media-player" target="_blank"><strong> 安装WMP </strong></a>插件后，关闭浏览器重新打开本系统！</p></div>

<div id="load" class="load_layer"><img src="/images/loading.gif"align="absmiddle"/>数据加载中...</div>
<div id="auto_save_res" class="load_layer"></div>

<div class="login_form">
   <form id="form1" name="form1" method="post" style="" action="" onSubmit="return false;" >

        <div class="login_1"><img src="images/login_bg_1.jpg" width="618" height="64" /></div>
        <div class="login_2">
        <div class="login_user"><input name="username" id="username" title="请输入您的用户名" maxlength="16" /></div>
          <div class="login_pass"><input name="password" type="password" id="password" title="请输入您的密码" maxlength="12"/></div>
     </div>
        <div class="login_3">
       	  <div class="login_sub">
       	    <input name="imageField" type="image" id="imageField" src="images/login_sumit.jpg" alt="点击登陆" onclick="fLoginFormSubmit();return false;" />
        	</div>
            <div class="login_sub">
              <input name="reset" type="image" id="reset" src="images/login_reset.jpg" alt="重置取消" onClick="javascript:document.getElementById('form1').reset();return false"/>
            </div>
        
        </div>
        
        <div class="login_foot"><?php echo $system_company?></div>
  </form>

</div>
<span style="display:none"><object classid="clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95" name="wav_player" width="100%" height="44" align="absmiddle" id="wav_player"><param name="FileName" id="wav_src" value="" /><param name="Volume" value="0"><param name="showcontrols" value="1"><embed id="wav_player_wmp" style="FILTER:xray" src="" showstatusbar="1" showcontrols="1" volume="0" pluginspage="http://www.microsoft.com/Windows/Downloads/Contents/Products/MediaPlayer/" width="100%" height="44" type="application/x-mplayer2"></embed></object></span>
<?php
if (strtolower(trim($_REQUEST["action"]))=="loginout"){
	exitUser();
}
?>  
</body>
</html>
