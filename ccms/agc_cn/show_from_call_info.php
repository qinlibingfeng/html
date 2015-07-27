<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link type="text/css" href="../ccms_jquery1.4.2/themes/base/jquery.ui.all.css" rel="stylesheet" />
<link type="text/css" href="../ccms_jquery1.4.2/demos.css" rel="stylesheet" />


<script language="JavaScript" type="text/javascript">

 var   VarObject1   =   window.dialogArguments;  
//alert(VarObject1);
function close_win() 
{
	window.close();

}



</script>
<title>Show From Call Info</title>
</head>
<body>
<form id="form1" action="#" method="get">
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td width="31%" height="21" align="center">&nbsp;</td>
    <td width="35%" height="21" align="center">&nbsp;</td>
    <td width="34%" align="center">&nbsp;</td>
  </tr>
  <?php
	$call_from			=	trim($_GET['call_from']);
	$phone_location	=	$_GET['phone_location'];
	$from_user			=	trim($_GET['from_user']);
	if(empty($phone_location) && empty($from_user)){
		$info_str				= $call_from;
	}else{
		$info_str				= $call_from." ( ".$phone_location." ) ".$from_user;
	}
	
//	$info_str				=	urlencode($info_str);
?>
  <tr>
    <td height="50" colspan="3" align="center" ><?php echo $info_str; ?></td>
    </tr>
  <tr align="center" valign="baseline">
    <td height="30" colspan="3" align="center" valign="bottom"></td>
  </tr>
</table>
</form>
</body>
</html>