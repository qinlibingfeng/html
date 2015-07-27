<? header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>

<a href="#" onclick="startCall2( '13631493222', 123)">hello</a>
<script>
function startCall( callnum, tid){
	if ( (parent.AutoDialWaiting == 1) || (parent.VD_live_customer_call==1) || (parent.alt_dial_active==1) || (parent.MD_channel_look==1) )
	{
			alert("YOU MUST BE PAUSED TO MANUAL DIAL A NEW LEAD IN AUTO-DIAL MODE");
			return false;
	}
	parent.document.vicidial_form.MDPhonENumbeR.value = callnum;
	parent.NeWManuaLDiaLCalLSubmiT("NEW");
	var xmlHttp = false;
		  var result;
		  if(window.ActiveXObject){ xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); }
		  else if(window.XMLHttpRequest){ xmlHttp = new XMLHttpRequest(); }
		  if(xmlHttp){
			var queryString =  "&action=save_ticket_id&tid="+tid+"&phonenum="+callnum;
			xmlHttp.open("POST", "/ccms/project/csc.php", true);
			xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlHttp.send(queryString);
			xmlHttp.onreadystatechange = function() {
			  if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
			  }
			};
			delete xmlHttp;
		 
	}
}
</script>
</body>
</html>
