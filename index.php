<?php 
require("inc/config.ini.php"); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xHTML">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<title><?php echo $system_name ?></title>
<script src="/js/jquery-1.8.3.min.js"></script>
<style type="text/css">
html,body{height:100%;overflow:auto;}
html{border:0;}
body{background: url(images/top_bg.jpg) no-repeat center -10px;margin:0;}
a{color: #08d; text-decoration: none; border: 0; background-color: transparent;}
a:hover{color: #f80; text-decoration: underline;}
a:active,a:focus{color: #f60; text-decoration: none;}
a.selected{background: #2266BB; color: #CCFFFF; text-decoration: none;}
a[href^="#"]:focus,a[href^="javascript"]:focus{outline:0;-moz-outline-style: none;}
div,blockquote,q,iframe,form,ul,li,dl,dt,dd,h1,h2,h3,h4,h5,h6,p{margin: 0; padding: 0;}
ul,dl,li{list-style: none;}
a img{border: none 0; vertical-align: middle;}
body,td,textarea{line-height: 1.4;}
textareap,p{word-break: break-all; word-wrap: break-word;}
body,input,textarea,select,button{margin: 0; font-size: 12px; font-family: Tahoma, SimSun, sans-serif;}
div,p,table,th,td,font{font-size: 1em; font-family: inherit; line-height: inherit;}
em,i,u,q,s,dl,caption,dfn,var,address,cite,s,strike,ins{font-style: normal; font-weight: normal; text-decoration: none;}
iframe{border: 0 solid #778899;}
form{display:inline;}
label{cursor:pointer;}
.frame{display:inline;float:left;width:216px;height:112px;padding:16px 2px 2px 10px;background:url(img/l_types.gif) no-repeat center center;margin-left:10px;margin-bottom:10px;}
.frame:hover{background:url(img/l_types_over.gif) no-repeat center center;}
.login_form{height: 270px;width: 736px;margin-right: auto;margin-left: auto;position:relative;margin-top: 60px}
.login_form .login_sub{margin-right: auto;margin-left: auto;height: 180px;width: 480px;position:relative;}
.login_form .login_foot{background: url(img/login_foot.jpg) no-repeat center top;height: 60px;width: 618px;position:relative;text-align: center;padding-top: 12px;color: #666;margin-right: auto;margin-left: auto;}
.systeminfo{height: 38px;width: 456px;padding-top:80px;margin-right: auto;margin-left:auto;position:relative;background: url(/img/systeminfo.png) no-repeat center bottom !important;
_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true,src='/img/systeminfo.png',sizingMethod='scale');_background-image: none;}
.clear{clear:both;}
.tipes{right:6px;position:absolute;top:6px;float:left;display:inline;height:20px;padding:2px 0 0 2px;background: none;z-index:200}
.ie6-warning{display:none;width:100%;position:absolute;top:0;left:0;background:#ffffe1;padding:5px 0;font-size:12px; text-align:center;z-index:400}
.ie6-warning p{width:960px;margin:0 auto;}

</style>
 <script>

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



<div class="systeminfo" title="<?php echo $system_company ?>"></div>
<div class="login_form">
  <div class="login_sub">
        <a class="frame" href="<?php echo $agc_server_home ?>" title="登陆入口：坐席外呼人员登陆"><img src="/img/agent_login.gif" width="204" height="96"></a>
        <a class="frame" href="<?php echo $admin_server_home ?>" title="登陆入口：业务管理、号码管理、坐席管理"><img src="/img/admin_login.gif" width="204" height="96"></a>
        
</div>
	<div class="login_foot"><?php echo $system_company?></div>
</div>
 
</body>
</html>
