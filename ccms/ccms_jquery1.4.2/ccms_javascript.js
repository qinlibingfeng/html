//jquery dialog window parameter default

//pausecode content 
$(function(){
$('#PauseCodeSelectBoxDIV').dialog('destory');
$('#PauseCodeSelectBoxDIV').dialog
({
autoOpen: false,
height: auto,
width: auto,
modal: true
//close: function() //jquery 关闭该层触发方法
//{
//if(Pause_Code_Default_Enable=="Y")
//{
 //document.getElementById("last_pause_code").innerHTML=Pause_Code_Default_Desc;
//}									 
//}
});
})