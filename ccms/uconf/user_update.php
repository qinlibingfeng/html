<?php 
require("config.ini.php"); 
check_login();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统更新</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>
<script language="JavaScript" src="js/ajaxfileupload.js"></script>


<script type="text/javascript">
	var $user = <?php echo $_SESSION["user_name"];?>;
	var $pass = <?php echo $_SESSION["user_pass"];?>;
	
	
	$(function(){	
		//$("[pseudo='-webkit-file-upload-button']").val('btn');	
		$("#upload_file").click(ajaxFileUpload);	
		$("#check_ini").click(user_check_ini);	
		$("#update_ini").click(user_update_ini);	
		$("#update_sh").click(user_update_sh);	
		
	})	


	
	function ajaxFileUpload()
	{		
		var file_select = $("#select_file").val();

		file_select_ext = file_select.substr(file_select.length-4);
		if(file_select_ext != 'des3'  && file_select_ext != "des1")
		{
			alert("选择文件不合法");
			return;
		}
		$('#update_loading').show();
		$.ajaxFileUpload({
			url:'send.php?action=user_update_upload', 
			secureuri:false,
			fileElementId:'select_file',
			dataType: 'json',
			success: function (data){				
				$('#update_loading').hide();		
				if(data.ok == 0){
					$("#filename").val(data.filename);	
				}else{
					$("#filename").val("");	
				}
				
				alert(data.result);
				
			},
			error: function (data, status, e){
				$('#update_loading').hide();
				$("#filename").val("");	
				alert("上传发生异常");
			}
		});
	}
	
	
	function user_check_ini(){
		var  filename = $("#filename").val();
		if(filename == "")
		{
			alert("请先上传文件");
			return;
		}
		var datas="action=user_check_ini&file_name="+filename;
		$.ajax({
			url:"send.php",
			data: datas,
			type:"post",
			dataType:"json",
     	success: function (data) {	
     		if(data.ok == 0)
     		{
      		$("#result").val(data.result);	        		
      	}
      
      }
    });
	}
	function user_update_ini(){
		var  filename = $("#filename").val();
		if(filename == "")
		{
			alert("请先上传文件");
			return;
		}
		var datas="action=user_update_ini&file_name="+filename;
		$.ajax({
			url:"send.php",
			data: datas,
			type:"post",
			dataType:"json",
     	success: function (data) {	
     		if(data.ok == 0)
     		{
      		$("#result").val(data.result);	        		
      	}
      
      }
    });
	}
	function user_update_sh(){
		var  filename = $("#filename").val();
		if(filename == "")
		{
			alert("请先上传文件");
			return;
		}
		$("#result").val("");	       
		var datas="action=user_update_sh&file_name="+filename;
		$.ajax({
			url:"send.php",
			data: datas,
			type:"post",
			dataType:"json",
     	success: function (data) {	
     		if(data.ok == 0)
     		{
      		$("#result").val(data.result);	        		
      	}
      }
    });
	}	
</script>

</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">系统更新</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>系统更新</span></div>
    
    <ul class="forminfo">
    	<li><label>选择文件:</label><input id="select_file" name="tar" type="file"  value="选择文件"/>
    		<img id="update_loading" src="images/loading.gif" style="display:none;"><i></i></li> 
    			<li><label>&nbsp;</label><input id="upload_file" type="button" class="btn" value="上传"/>
    		<input id="check_ini" type="hidden" class="btn" value="检测脚本"/>	
   			<input id="update_ini" type="hidden" class="btn" value="执行脚本"/>
   			<input id="update_sh" type="button" class="btn" value="执行脚本"/></li>  
   		
   		<li><label>结果：</label><textarea id="result"  cols="" rows="10" class="textresult" ></textarea></li>
   		
   		
   		
   		
   		<input id="filename" type="hidden" value=""/>
    	<!--
	    <li><label>文章标题</label><input name="" type="text" class="dfinput" /><i>标题不能超过30个字符</i></li> 
	    <li><label>关键字</label><input name="" type="text" class="dfinput" /><i>多个关键字用,隔开</i></li>
	    <li><label>是否审核</label><cite><input name="" type="radio" value="" checked="checked" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="radio" value="" />否</cite></li>
	    <li><label>引用地址</label><input name="" type="text" class="dfinput" value="http://www.uimaker.com/uimakerhtml/uidesign/" /></li>
	    <li><label>文章内容</label><textarea name="" cols="" rows="" class="textinput"></textarea></li>
	    <li><label>&nbsp;</label><input name="" type="button" class="btn" value="确认保存"/></li>
	    -->
    </ul>
    
    
    </div>


</body>

</html>
