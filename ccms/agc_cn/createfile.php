<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>aaaaaaaaaa</title>

<script language="Javascript">


function createText(agent)
{      var objMyFSO = new ActiveXObject("Scripting.FileSystemObject"); 
   var d, s = agent+": "; d = new Date(); s += (d.getMonth() + 1) + "/"; s += d.getDate() + "/"; s += d.getYear()+" "; s += d.getHours()+":"; s += d.getMinutes()+":"; s += d.getSeconds();
   var fileName = objMyFSO.FileExists("d:\\testfile.txt"); 
    if (!fileName)
     {
        var text = objMyFSO.CreateTextFile("d:\\testfile.txt", true); 
		var textValue = s;
		if(!textValue){text.Close(); return;}
		 text.WriteLine(textValue); 
		 text.Close(); 
			return;
     }
     
   var forAppending = 8;
   var text = objMyFSO.OpenTextFile("d:\\testfile.txt",forAppending,false);   
   var textValue = s;
   if(!textValue){text.Close(); return;}
   text.WriteLine(textValue); 
   text.Close();   
} 

</script> 

</head>

<body>
<input type="button" value="aaaa" onclick="createText('agent')">
</body>

</html>