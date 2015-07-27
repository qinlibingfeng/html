<?php
$web_form=trim($_REQUEST["web_form"]);
if($web_form=="web_form"){
	$form_name="网页表单一";	
}else if($web_form=="web_form_two"){
	$form_name="网页表单二";	
}else if($web_form=="script"){
	$form_name="话术脚本";	
}else{
	$form_name="该项";	
}
 
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title></title>
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=EmulateIE7\" />
<link href=\"/css/main.css\" rel=\"stylesheet\" type=\"text/css\" />";

echo "</head>\n";
echo "<body>\n";
echo "<a name=\"main_top\" id=\"main_top\"></a>\n";
echo "<div id=\"auto_save_res\" class=\"load_layer\"></div>\n";
echo "<div class=\"page_main\">";
echo "  <table width=\"99%\" border=\"0\" align=\"center\" cellpadding=\"0\" class=\"blocktable\" >\n";
echo "    <tr>\n";
echo "      <td align=\"left\" valign=\"top\">\n";
echo "<br><span class='red font-14'>本业务活动未指定".$form_name."地址！</span>";

echo "		</td>\n";
echo "    </tr>\n";
echo "  </table>\n";
echo "</div> \n";
echo "</body>\n";
echo "</html>\n";

exit;

?>
