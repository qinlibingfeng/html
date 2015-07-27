<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>CCMS</title>
<link type='text/css' rel='stylesheet' href='/ccms/new_style/css/welcome.css' />
<script type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function openWin(){
	var i = screen.width*0.999;
	var left = 400;
	var width = i;
	var top = 200;
	var height= screen.height*0.99;
	window.open("/ccms/agc_cn/vicidial.php?relogin=YES","","height=" + height + ", width=" + width + ", top=" + top + ", left=" + left + ", toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, status=no");
}
function openAdmin(){
	var left = 0;
	var width= screen.width;
	var height= screen.height;
	var top = 0;
	window.open("/ccms/admin.php","","height=" + height + ", width=" + width + ", top=" + top + ", left=" + left + ", toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, status=no");
}
//-->
</script>
</head>

<body onload="MM_preloadImages('ccms/images/welcome_r3_c2-1.jpg','ccms/images/welcome_r3_c6-1.jpg','ccms/images/welcome_r3_c21-1.jpg')">

<div id="main_background">

<div  id="main" >
	<div id="center">
		<div id="pic"><a href="#" target="_blank" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','ccms/images/lgq_welcome_r3_c2-1.png',1)" onclick="openWin();return false;"><img src="ccms/images/lgq_welcome_r3_c2.png" name="Image2" width="281" height="162" border="0" id="Image2" /></a></div>
		<!--<div id="pic"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','ccms/images/welcome_r3_c21-1.jpg',1)"><img src="ccms/images/welcome_r3_c21.jpg" name="Image5" width="281" height="204" border="0" id="Image5" /></a></div>-->
		<div id="pic3"><a href="#" target="_blank" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','ccms/images/lgq_welcome_r3_c6-1.png',1)" onclick="openAdmin();return false;"><img src="ccms/images/lgq_welcome_r3_c6.png" name="Image4" width="281" height="162" border="0" id="Image4" /></a></div>
	</div>
</div>

</div>
<div style="display:none" id="main">
<p><b>Supported Browsers:</b></p>
<p>To take advantage of the newest CCMS features, you'll need to use the following fully supported browser:</p>
<p><img src="images/IE8_sm.png" width="20px"/>&nbsp;&nbsp;Microsoft Internet Explorer 8.0 (<a href="http://www.microsoft.com/en-us/download/internet-explorer-8-details.aspx" target="_blank" style="color:#000000;font-weight:bold;">Download</a>)</p>
</div>
</body>
</html>
