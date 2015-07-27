<?php 
require("inc/config.ini.php"); 
check_login();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xHTML1/DTD/xHTML1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xHTML" style="overflow-x:hidden">
<head>
<meta http-equiv="Content-Type" content="text/HTML;charset=utf-8"/>
<title><?php echo $system_name ?></title>
<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/js/main.js?v=<?php echo $today ?>"></script>
<script type="text/javascript" src="/js/pub_func.js?v=<?php echo $today ?>"></script>
<link href="/css/main.css?v=<?php echo $today ?>" rel="stylesheet" type="text/css">
<style type="text/css">
body{height:100%;margin:0;_margin:0;_height:100%;font:12px/1.8;}
html, body{height:100%;overflow:hidden;}
i, em{font-style:normal;}
.frame-header{position:fixed;_position:absolute;top:0;right:0;left:0px;z-index:2;width:100%;min-width:900px;height:38px;background: url(images/main_head_bg.jpg) 0 0;line-height: 38px;border-top: none;border-right: none;border-bottom: none;border-left: none;}
.frame-logo{position:absolute;top:4px;left:4px;}
.frame-logo a{float:left;width:230px;height:32px;line-height:32;font-size:12px;overflow:hidden;background:url(/images/logo_call_out.png) no-repeat 0 0!important;_background-image:none;
_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/images/logo_call_out.png',sizingMethod='crop')}
*html{padding-top:40px;}
*html .frame-side{height:100%;}
.frame-side{position:absolute;top:38px;bottom:27px;left:0;z-index:0;width:155px;border-right:1px solid #AED0E9;background:#F6F9FD;box-shadow:inset -1px 0 5px rgba(0, 0, 0, 0.07);overflow-y:auto;overflow-x:hidden;}
.page-main{position:absolute;top:38px;left:157px;bottom:27px;right:0;height:90%;overflow:hidden;}
.page-noside .page-main{right:0;}
.side-switcher{width:13px;height:30px;line-height:10;overflow:hidden;border-radius:3px 0 0 3px;background-image:url(/images/side_switcher.png);background-repeat:no-repeat;background-position:0 0;box-shadow:0 1px 3px rgba(0, 0, 0, 0.2);position:absolute;left:155px;top:42%;z-index:20;}
.side-switcher:hover{background-position:0 -30px;}
.side-close{background-position:-13px 0;}
.side-close:hover{background-position:-13px -30px;}
/**左侧菜单**/
.gLe a{text-decoration:none;color:#333;font-size:12px}
.gLe a:hover{text-decoration:none;font-size:12px}
.bgF1, .spl, .gFdBdy li.on{background:url(/images/f1.gif) no-repeat}
.gMbtn a, .gfTit, .icoIfo{background:url(/images/f1png.png) no-repeat left bottom;}
.gMbtn{width:154px;height:30px;background: url(/images/left_top_bg.jpg) no-repeat left top;cursor:pointer;position: relative;}
.gMbtn a{display:block;height:36px}
.gFd{width:150px;margin:0px 0 0 2px;position: relative;}
.gfTit{height:29px;position:relative;background-position:-198px -1px;margin-bottom:2px;font-weight: bold;}
a.gfName{position:absolute;top:10px;
*top:12px;left:21px;font-weight:bold;font-size: 12px;}
a.gfName:hover{text-decoration:none}
a.clsFd{position:absolute;top:12px;left:3px;display:block;width:14px;height:14px;background-position:-532px -26px}
a.clsFd:hover{background-position:-549px -26px}
a.opnFd{position:absolute;top:12px;left:3px;display:block;width:14px;height:14px;background-position:-532px -40px}
a.opnFd:hover{background-position:-549px -40px}
.addFd{position:absolute;top:12px;right:10px;display:block;width:14px;height:14px;background-position:-568px -25px}
a.addFd:hover{background-position:-588px -25px}
a.gfNm, span.gfNm{display: block;position: absolute;left:30px;top:4px;
*top:6px;}
*:lang(zh) a.gfNm, *:lang(zh) span.gfNm{top:4px;left:33px}
span.gfNm{left:24px}
a.gfNm:hover{text-decoration:none}
.hide{display:none}
.clear{clear:both;font-size:0;height:0;background-color:transparent}
.spline{height:1px;font-size:1px}
.gLe{width:150px;padding-bottom:15px;float:left;margin-right:-3px;}
.gFdBdy li{height:24px;position:relative;line-height:16px}
.gFdBdy li a.gfNm{width:130px;height:17px;white-space:nowrap;display:block;overflow:hidden}
.gFdBdy li.on{background-position:-356px -3px}
.icon{background: url(images/menu_icon.png) no-repeat;position:relative;left:8px;top:4px;display:block;width:16px;height:16px;font-size:1px;float:left;}
.icon_1{background-position:0px -9px}
.icon_2{background-position:0px -38px}
.icon_3{background-position:0px -68px}
.icon_4{background-position:-1px -94px}
.icon_5{background-position:-1px -123px}
.icon_6{background-position:-1px -150px}
.icon_7{background-position:-1px -178px}
.icon_8{background-position:-1px -206px}
.icon_9{background-position:-1px -235px}
.icon_10{background-position:-1px -265px}
.icon_11{background-position:-1px -294px}
.icon_12{background-position:-1px -323px}
.icon_13{background-position:-1px -353px}
.icon_14{background-position:-1px -382px}
.icon_15{background-position:-1px -412px}
.icon_16{background-position:-1px -441px}
.icon_17{background-position:-1px -468px}
.icon_19{background-position:-1px -498px}
.icon_18{background-position:-1px -527px}
.icon_20{background-position:-1px -555px}
.icon_21{background-position:-1px -583px}
.icon_22{background-position:-1px -613px}
.icon_23{background-position:0px -640px}
.icon_24{background-position:-1px -667px}
.icon_25{background-position:-1px -694px}
.icon_26{background-position:-1px -715px}
.icon_27{background-position:-1px -763px}
.icon_28{background-position:-1px -790px}
.icon_29{background-position:-1px -815px}
.icon_30{background-position:-1px -840px}
.icon_31{background-position:-1px -864px}
.icon_32{background-position:-1px -892px}
.icon_33{background-position:-1px -915px}
.icon_34{background-position:-1px -944px}
.icon_35{background-position:-1px -971px}
.icon_36{background-position:-1px -996px}
 
/*左侧菜单-end*/
#con{margin:0 auto;width:100%;background:url(/images/page_nav_bg.jpg) repeat-x left -4px;position:relative;border-top:1px solid #C0DCF1;padding-top:2px;height:25px;border-bottom:1px solid #C0DCF1;}
#tabs{position:relative;}
.tabs-sc-left, .tabs-sc-right{position:absolute;top:2px;width:18px;height:23px;font-size:1px;display:none;cursor:pointer;z-index:10;}
.tabs-sc-left{left:0;background:url(/images/scroll-left.gif) no-repeat top left;}
.tabs-sc-right{right:0;background:url(/images/scroll-right.gif) no-repeat top left;z-index:28;position:absolute;}
.tabs-sc-over{background-position: top -18px}
.tabs-wrap{position:relative;left:0;overflow:hidden;width:100%;margin:0;padding:0;float:left}
.tabs{height:23px;margin:0 0 0 2px;padding:0 0 0 2px;width:5000px;z-index:6;border-bottom:1px solid #C0DCF1;}
.tabs li{background:url(/images/tagleft.gif) no-repeat left bottom;float:left;margin-right:2px;height:23px;line-height:25px;position:relative;white-space:nowrap;}
.tabs li a.tab{padding-right:16px;padding-left:10px;background:url(/images/tagright.gif) no-repeat right bottom;float:left;padding-bottom:0;color:#777;padding-top:0;height:23px;line-height:23px;line-height:25px\9\0;*line-height:25px;text-decoration:none;}
.tabs li.tab_on{background-position:left top;margin-bottom:-4px;position:relative;height:25px;}
.tabs li.tab_on a.tab{background-position:right top;color:#000;height:25px;}
.tabs a.close{width:8px;height:8px;line-height:8px;background:url(/images/tips/tip_bg.gif) no-repeat 0 -26px;display:inline;position:absolute;right:4px;top:9px;top:8px;\9\0*top:8px;cursor:pointer;font-size:1px;}
.tabs a.close:hover{background-position:0 -34px;}
.tab_l_r{width:14px;height:13px;position:absolute;top:6px;background:url(/images/tab_to.png) no-repeat left center;}
.tab_r{right:2px;background-position:right center;}
.tab_l{left:2px;background-position:left center;}
.tab_ico{width:13px;height:13px;position:absolute;top:8px;background:url(/images/tab_ico.png) no-repeat left top;}
.tab_ico_r{right:2px;background-position:right -14px;}
.tab_ico_r:hover{background-position:right top;}
.tab_ico_l{left:0;background-position:left -14px;}
.tab_ico_l:hover{background-position:left top;}
.tab_ico_v{width:16px;height:15px;left:12px;top:6px;background-position:-4px -28px;}
.tab_ico_v:hover{background-position:-4px -45px;}
.menu{position:absolute;width:150px;background:#f0f0f0 url(/images/menu.gif) repeat-y;margin:0;padding:2px;display:none;border:1px solid #ccc;overflow:hidden;z-index:12;-moz-border-radius:4px;-webkit-border-radius:4px;}
.menu_item{height:20px;line-height:20px;overflow:hidden;font-size:12px;border:1px solid transparent;_border:1px solid #f0f0f0;}
.menu_item a{margin-left:26px;color: #08d;}
.menu_item a:hover{color: #f80;text-decoration: underline;}
.menu_sep{margin:3px 0 3px 24px;line-height:2px;font-size:2px;background:url(../images/menu_sep.png) repeat-x left center;width:128px!important;width:100%;}
.menu_active{border:1px solid #7eabcd;background:#fafafa;-moz-border-radius:2px;-webkit-border-radius:2px;}
.menu_shadow{display:none;position:absolute;background:#ddd;width:155px;height:180px!important;height:185px;-moz-border-radius:4px;-webkit-border-radius:4px;-moz-box-shadow:2px 2px 3px rgba(0,0,0,0.2);-webkit-box-shadow:2px 2px 3px rgba(0,0,0,0.2);
filter:progid:DXImageTransform.Microsoft.Blur(pixelRadius=2, MakeShadow=false, ShadowOpacity=0.2);z-index:11;}
#tab_frames{height:95%;}
/*tab -end*/
#time_clock{background: url(images/icons/icons_76.gif) no-repeat 0px 3px;line-height: 22px;float:left;width:1px;padding-left:1px;z-index:12;color:#888}
.person b{position:absolute;right:6px;top:9px;height:14px;padding:0 5px;line-height:14px;font-weight:normal;font-size:10px;color:#FFF;border-radius:7px;background:#D12820;background:-webkit-linear-gradient(top, #E32827, #BE2919 100%);background:-moz-linear-gradient(top, #E32827, #BE2919 100%);background:-o-linear-gradient(top, #E32827, #BE2919 100%);box-shadow:0 1px 2px rgba(0, 0, 0, 0.5);cursor:default;z-index:70;display:none;}
.green_layer{border:0px;background:#16960E;z-index:300;color:#fff}
.round_{background:url(images/head_menu_bg.png) no-repeat right bottom;float:right;height:32px;margin-top:2px;margin-right:6px;display:inline;position:relative;overflow:hidden;}
.round_ .round_main{background:url(images/head_menu_bg.png) no-repeat left top;height:32px;padding-right:4px;float:left;padding-left:4px;}
.head_notice_img{float:left;height:22px;width:24px;margin-top:2px;padding-top:4px;}
.head_notice{float:left;width:140px;}
.head_notice ul{height:28px;overflow:hidden;margin-top:3px;}
.head_notice li{line-height:14px;text-align:left;display:inline;float:left;height:14px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;width:140px;}
.head_notice li:after{content:"...";}
.footer{line-height: 27px;background: url(../images/foot_bg.jpg) repeat-x left top;height: 27px;width: 100%;position: absolute;right: 0;bottom: 0;left: 0;}
.footer .welcome{float: left;height: 27px;width: 104px;margin-left: 16px;}
.footer .copyright{height: 26px;width: 70%;text-align: center;padding-left: 30px;color: #666;margin-right: auto;margin-left: auto;}
.footer .version{float: right;width: 91px;margin-right: 16px;line-height: 26px;background: url(../images/version.jpg) no-repeat left top;height: 27px;padding-right: 12px;padding-left: 16px;color: #5480A3;}
</style>

<script language="javascript">   
function showDivMenu(id){if($("#"+id).is(":visible")){$("#"+id).hide()}else{$("#"+id).show()}};

function showFoldClass(id){if($("#"+id).attr("title")=="开启"){$("#"+id).removeClass("clsFd").addClass("opnFd").attr("title","折叠")}else{$("#"+id).removeClass("opnFd").addClass("clsFd").attr("title","开启")}};
    
function addClassName(id,cl){$("#"+id).addClass("on")};
 
function removeClassName(id,cl){$("#"+id).removeClass("on")};

function get_datalist() {$("#Menu_List .gFd").remove();$('#load').show();var datas="action=get_menu_list&do_actions=list"+times;$.ajax({type:"post",dataType:"json",url:"/document/agent/send.php",data:datas,cache:false,async:false,beforeSend:function(){$('#load').css("top",$(document).scrollTop());$('#load').show('100')},complete:function(){$('#load').hide('100')},success:function(json){if(parseInt(json.counts)>0){$.each(json.datalist,function(index,con){tr_str="",lists="";tr_str="<div class=\"gFd\">";tr_str+="<h3 class=\"gfTit\" onClick=\"javascript:showDivMenu('study_"+con.PopeID+"');showFoldClass('fold"+con.PopeID+"');\">";tr_str+="		<a href=\"javascript:void(0);\" id=\"fold"+con.PopeID+"\" rel=\"fold\" class=\"opnFd bgF1\" title=\"开启\" hidefocus=\"true\"></a>";tr_str+="<a href=\"javascript:void(0);\" class=\"gfName\" hidefocus=\"true\">"+con.PopeName+"</a></h3>";tr_str+="<ul class=\"gFdBdy\" id=\"study_"+con.PopeID+"\"  style=\"display:none\">";$.each(con.pope_list,function(det,cons){lists+="<li onMouseOver=\"addClassName('li_"+cons.PopeID_List+"','on');\" id=\"li_"+cons.PopeID_List+"\" onMouseOut=\"removeClassName('li_"+cons.PopeID_List+"','on');\" title=\""+cons.IcoInfo_List+"\" rel=\"o_list\"><b class=\"icon "+cons.IcoClass_List+"\"></b><a href=\"javascript:void(0)\" hidefocus=\"true\" onclick=\"addTab('"+cons.PopeName_List+"','"+cons.PopeLink_List+"','"+cons.PopeID_List+"','"+cons.is_re+"')\" class=\"gfNm\">"+cons.PopeName_List+"</a></li>"});tr_str+=lists;tr_str+="	</ul>";tr_str+="</div>";$("#Menu_List").append(tr_str)})}else{}},error:function(XMLHttpRequest,textStatus){alert("页面请求错误，请联系系统管理员！\n"+textStatus)}})};
   
(function($){$.parser={auto:true,onComplete:function(_153){},plugins:["panel","tabs"],parse:function(_154){var aa=[];for(var i=0;i<$.parser.plugins.length;i++){var name=$.parser.plugins[i];var r=$("#"+name,_154);if(r.length){if(r[name]){r[name]()}else{aa.push({name:name,jq:r})}}}}};$(function(){if(!window.easyloader&&$.parser.auto){$.parser.parse()}})})(jQuery);(function($){function _161(_162){};function _164(_165){var opts=$.data(_165,"panel").options;var _166=$.data(_165,"panel").panel;if(opts.title&&!opts.noheader){var _167=$("<div >"+opts.title+"</div>").prependTo(_166)}else{}};function _173(_174,_175){var opts=$.data(_174,"panel").options;var _176=$.data(_174,"panel").panel;if(_175!=true){if(opts.onBeforeOpen.call(_174)==false){return}}opts.closed=false};function _16c(_179,_17a){var opts=$.data(_179,"panel").options;var _17b=$.data(_179,"panel").panel;if(_17a!=true){if(opts.onBeforeClose.call(_179)==false){return}}opts.closed=true;opts.onClose.call(_179)};function _17c(_17d,_17e){var opts=$.data(_17d,"panel").options;var _17f=$.data(_17d,"panel").panel;if(_17e!=true){if(opts.onBeforeDestroy.call(_17d)==false){return}}opts.onDestroy.call(_17d)};var TO=false;var _196=true;$.fn.panel=function(_198,_199){if(typeof _198=="string"){return $.fn.panel.methods[_198](this,_199)}_198=_198||{};return this.each(function(){var _19a=$.data(this,"panel");var opts;if(_19a){opts=$.extend(_19a.options,_198)}else{opts=$.extend({},$.fn.panel.defaults,$.fn.panel.parseOptions(this),_198);_19a=$.data(this,"panel",{options:opts,panel:_161(this),isLoaded:false})}if(opts.content){$(this).html(opts.content);if($.parser){$.parser.parse(this)}}_164(this);if(opts.closed==true||opts.minimized==true){}else{_173(this)}})};$.fn.panel.methods={options:function(jq){return $.data(jq[0],"panel").options},panel:function(jq){return $.data(jq[0],"panel").panel},header:function(jq){},body:function(jq){},setTitle:function(jq,_19b){return jq.each(function(){_193(this,_19b)})},open:function(jq,_19c){return jq.each(function(){_173(this,_19c)})},close:function(jq,_19d){return jq.each(function(){_16c(this,_19d)})},destroy:function(jq,_19e){return jq.each(function(){_17c(this,_19e)})},refresh:function(jq,href){},resize:function(jq,_19f){}};$.fn.panel.parseOptions=function(_1a3){var t=$(_1a3);return{width:(parseInt(_1a3.style.width)||undefined),height:(parseInt(_1a3.style.height)||undefined),left:(parseInt(_1a3.style.left)||undefined),top:(parseInt(_1a3.style.top)||undefined),title:(t.attr("title")||undefined),tab_id:(t.attr("tab_id")||undefined),fit:(t.attr("fit")?t.attr("fit")=="true":undefined),closable:(t.attr("closable")?t.attr("closable")=="true":undefined),closed:(t.attr("closed")?t.attr("closed")=="true":undefined)}};$.fn.panel.defaults={title:null,tab_id:null,width:"auto",height:"auto",left:null,top:null,style:{},fit:false,closable:false,collapsed:false,closed:false,href:null,onLoad:function(){},onBeforeOpen:function(){},onOpen:function(){},onBeforeClose:function(){},onClose:function(){},onBeforeDestroy:function(){},onDestroy:function(){}}})(jQuery);(function($){function _220(_221){var _222=$(">div.tabs-header",_221);var _223=0;$("ul.tabs li",_222).each(function(){_223+=$(this).outerWidth(true)});var _224=$("div.tabs-wrap",_222).width();var _225=parseInt($("ul.tabs",_222).css("padding-left"));return _223-_224+_225};function _226(_227){var opts=$.data(_227,"tabs").options;var _228=$(_227).children("div.tabs-header");var _229=_228.children("div.tabs-sc-left");var _22a=_228.children("div.tabs-sc-right");var wrap=_228.children("div.tabs-wrap");var _22c=0;$("ul.tabs li").each(function(){_22c+=$(this).outerWidth(true)});var _22d=$("#page-main").width()-$("#time_clock").outerWidth();if(_22c>_22d){_229.show();_22a.show();wrap.css({marginLeft:_229.outerWidth(),marginRight:_22a.outerWidth()-10,left:0,width:_22d-_229.outerWidth()-_22a.outerWidth()})}else{_229.hide();_22a.hide();wrap.css({marginLeft:0,marginRight:0,left:0,width:_22d});wrap.scrollLeft(0)}};function _22e(_22f){var opts=$.data(_22f,"tabs").options};function _232(_233){var opts=$.data(_233,"tabs").options;var cc=$(_233);if(opts.fit==true){var p=cc.parent();opts.width=p.width();opts.height=p.height()}cc.width(opts.width);var _234=$(">div.tabs-header",_233);if($.boxModel==true){_234.width(opts.width-(_234.outerWidth()-_234.width()))}else{_234.width(opts.width)}_226(_233);var _235=$(">div.tabs-panels",_233);var _236=opts.height;if(!isNaN(_236)){if($.boxModel==true){var _237=_235.outerHeight()-_235.height();_235.css("height",(_236-_234.outerHeight()-_237)||"auto")}else{_235.css("height",_236-_234.outerHeight())}}else{_235.height("auto")}var _238=$(window).outerWidth();if(!isNaN(_238)){if($.boxModel==true){_235.width(_238-(_235.outerWidth()-_235.width()))}else{_235.width(_238)}}else{_235.width("auto")}};function _239(_23a){var opts=$.data(_23a,"tabs").options;var tab=_23b(_23a);if(tab){var _23c=$(_23a).find(">div.tabs-panels");var _23d=opts.width=="auto"?"auto":_23c.width();var _23e=opts.height=="auto"?"auto":_23c.height();tab.panel("resize",{height:_23e})}};function _23f(_240){var cc=$(_240);$("<div class=\"tabs-header\" id=\"con\"><div class=\"tabs-sc-left\"></div><div class=\"tabs-sc-right\"></div><div class=\"tabs-wrap\" id=\"tabs-wrap\"><ul class=\"tabs\"></ul></div><div id='time_clock'></div></div>").prependTo(_240);var tabs=[];var _241=$(">div.tabs-header",_240);$(">div.tabs-panels>div",_240).each(function(){var pp=$(this);tabs.push(pp);_24a(_240,pp)});$(".tabs-sc-left, .tabs-sc-right",_241).hover(function(){$(this).addClass("tabs-sc-over")},function(){$(this).removeClass("tabs-sc-over")});cc.bind("_resize",function(e,_242){var opts=$.data(_240,"tabs").options;if(opts.fit==true||_242){_232(_240);_239(_240)}return false});return tabs};function _243(_244){var opts=$.data(_244,"tabs").options;var _245=$(">div.tabs-header",_244);var _246=$(">div.tabs-panels",_244);if(opts.plain==true){_245.addClass("tabs-h-pl")}else{_245.removeClass("tabs-h-pl")}if(opts.border==true){_245.removeClass("tabs-h-nob");_246.removeClass("tabs-p-nob")}else{_245.addClass("tabs-h-nob");_246.addClass("tabs-p-nob")}$(".tabs-sc-left",_245).unbind(".tabs").bind("click.tabs",function(){var wrap=$(".tabs-wrap",_245);var pos=wrap.scrollLeft()-opts.scrollIncrement;wrap.animate({scrollLeft:pos},opts.scrollDuration)});$(".tabs-sc-right",_245).unbind(".tabs").bind("click.tabs",function(){var wrap=$(".tabs-wrap",_245);var pos=Math.min(wrap.scrollLeft()+opts.scrollIncrement,_220(_244));wrap.animate({scrollLeft:pos},opts.scrollDuration)});var tabs=$.data(_244,"tabs").tabs;for(var i=0,len=tabs.length;i<len;i++){var _247=tabs[i];var tab=_247.panel("options").tab;var _248=_247.panel("options").title;tab.unbind(".tabs").bind("click.tabs",{title:_248},function(e){_254(_244,e.data.title)})}};function _24a(_24b,pp,_24c){_24c=_24c||{};pp.panel($.extend({},{selected:pp.attr("selected")=="true"},_24c,{border:false,noheader:true,closed:true,doSize:false,tab_id:(_24c.tab_id?_24c.tab_id:undefined),onLoad:function(){$.data(_24b,"tabs").options.onLoad.call(_24b,pp)}}));var opts=pp.panel("options");var _24d=$(">div.tabs-header",_24b);var tabs=$("ul.tabs",_24d);var tab=$("<li id='tab_li_"+opts.tab_id+"' title='右击菜单，双击关闭："+opts.title+"'></li>").appendTo(tabs);var style="";if(opts.width!="auto"){style=' style="padding-right:'+opts.width+'"'}var _24e=$("<a href=\"javascript:void(0)\" hidefocus='true' class=\"tab\" "+style+" onclick=\"tab_frame('"+opts.tab_id+"');\">"+opts.title+"</a>").appendTo(tab);if(opts.closable){$("<a href='javascript:void(0)' class=\"close\" hidefocus='true' title=\"关闭\" onclick=\"tab_close('"+opts.tab_id+"')\"></a>").appendTo(tab)}opts.tab=tab};function _251(_252,_253){var opts=$.data(_252,"tabs").options;var tabs=$.data(_252,"tabs").tabs;var pp=$("<em></em>").appendTo($(_252));tabs.push(pp);_24a(_252,pp,_253);opts.onAdd.call(_252,_253.title);_226(_252);_243(_252);_254(_252,_253.title)};function _255(_256,_257){var _258=$.data(_256,"tabs").selectHis;var pp=_257.tab;var _259=pp.panel("options").title;pp.panel($.extend({},_257.options,{tab_id:(_257.options.tab_id?_257.options.tab_id:undefined)}));var opts=pp.panel("options");var tab=opts.tab;if(_259!=opts.title){for(var i=0;i<_258.length;i++){if(_258[i]==_259){_258[i]=opts.title}}}_243(_256);$.data(_256,"tabs").options.onUpdate.call(_256,opts.title)};function _249(_25a,_25b){var opts=$.data(_25a,"tabs").options;var tabs=$.data(_25a,"tabs").tabs;var _25c=$.data(_25a,"tabs").selectHis;if(!_25d(_25a,_25b)){return}if(opts.onBeforeClose.call(_25a,_25b)==false){return}var tab=_25e(_25a,_25b,true);tab.panel("options").tab.remove();tab.panel("destroy");opts.onClose.call(_25a,_25b);_226(_25a);for(var i=0;i<_25c.length;i++){if(_25c[i]==_25b){_25c.splice(i,1);i--}}var _25f=_25c.pop();if(_25f){_254(_25a,_25f)}else{if(tabs.length){_254(_25a,tabs[0].panel("options").title)}}};function _25e(_260,_261,_262){var tabs=$.data(_260,"tabs").tabs;for(var i=0;i<tabs.length;i++){var tab=tabs[i];if(tab.panel("options").title==_261){if(_262){tabs.splice(i,1)}return tab}}return null};function _23b(_263){var tabs=$.data(_263,"tabs").tabs;for(var i=0;i<tabs.length;i++){var tab=tabs[i];if(tab.panel("options").closed==false){return tab}}return null};function _264(_265){var tabs=$.data(_265,"tabs").tabs;for(var i=0;i<tabs.length;i++){var tab=tabs[i];if(tab.panel("options").selected){_254(_265,tab.panel("options").title);return}}if(tabs.length){_254(_265,tabs[0].panel("options").title)}};function _254(_266,_267){var opts=$.data(_266,"tabs").options;var tabs=$.data(_266,"tabs").tabs;var _268=$.data(_266,"tabs").selectHis;if(tabs.length==0){return}var _269=_25e(_266,_267);if(!_269){return}var _26a=_23b(_266);if(_26a){_26a.panel("close");_26a.panel("options").tab.removeClass("tab_on")}var tab=_269.panel("options").tab;tab.addClass("tab_on");if(tab.position()==undefined||tab.position()==null){tab=$("#tabs li[class='tab_on']")}var wrap=$(_266).find(">div.tabs-header div.tabs-wrap");var _26b=tab.position().left+wrap.scrollLeft();var left=_26b-wrap.scrollLeft();var _26c=left+tab.outerWidth();if(left<0||_26c>wrap.innerWidth()){var pos=Math.min(_26b-(wrap.width()-tab.width())/2,_220(_266));wrap.animate({scrollLeft:pos},opts.scrollDuration)}else{var pos=Math.min(wrap.scrollLeft(),_220(_266));wrap.animate({scrollLeft:pos},opts.scrollDuration)}_239(_266);_268.push(_267)};function _25d(_26d,_26e){return _25e(_26d,_26e)!=null};$.fn.tabs=function(_26f,_270){if(typeof _26f=="string"){return $.fn.tabs.methods[_26f](this,_270)}_26f=_26f||{};return this.each(function(){var _271=$.data(this,"tabs");var opts;if(_271){opts=$.extend(_271.options,_26f);_271.options=opts}else{$.data(this,"tabs",{options:$.extend({},$.fn.tabs.defaults,$.fn.tabs.parseOptions(this),_26f),tabs:_23f(this),selectHis:[]})}_22e(this);_243(this);_232(this);var _272=this;setTimeout(function(){_264(_272)},0)})};$.fn.tabs.methods={options:function(jq){return $.data(jq[0],"tabs").options},tabs:function(jq){return $.data(jq[0],"tabs").tabs},add:function(jq,_273){return jq.each(function(){_251(this,_273)})},close:function(jq,_274){return jq.each(function(){_249(this,_274)})},getTab:function(jq,_275){return _25e(jq[0],_275)},getSelected:function(jq){return _23b(jq[0])},select:function(jq,_276){return jq.each(function(){_254(this,_276)})},exists:function(jq,_277){return _25d(jq[0],_277)}};$.fn.tabs.parseOptions=function(_279){var t=$(_279);return{height:(parseInt(_279.style.height)||undefined),fit:(t.attr("fit")?t.attr("fit")=="true":undefined),border:(t.attr("border")?t.attr("border")=="true":undefined),plain:(t.attr("plain")?t.attr("plain")=="true":undefined)}};$.fn.tabs.defaults={width:"auto",height:"auto",plain:false,fit:false,border:true,scrollIncrement:100,scrollDuration:400,onClose:function(_27d){},onAdd:function(_27e){},onBeforeClose:function(_27c){}}})(jQuery);

function addTab(tab_tit,url,tab_id,is_tel,unid){if(!$('#tabs').tabs('exists',tab_tit)){$('#tabs').tabs('add',{title:tab_tit,tab_id:tab_id,closable:true});$("#tab_frames").append("<iframe id='frame_"+tab_id+"' width='100%' frameborder='0' ></iframe>");if($("#tab_li_"+tab_id).length<1){$("<li id='tab_li_"+tab_id+"' title='右击菜单，双击关闭："+tab_tit+"'><a href=\"javascript:void(0)\" hidefocus='true' class=\"tab\" onclick=\"tab_frame('"+tab_id+"');\">"+tab_tit+"</a><a href='javascript:void(0)' hidefocus='true' class=\"close\" title=\"关闭\" onclick=\"tab_close('"+tab_id+"')\"></a></li>").appendTo($("ul.tabs"))}$("#frame_"+tab_id).attr("src",url)}else{$("#tabs").tabs('select',tab_tit);if(is_tel=="re"){$("#frame_"+tab_id).attr("src",url)}else if(is_tel=="up"){window.frames["frame_"+tab_id].up_uniqueid(unid)}};tab_frame(tab_id);$("#tab_li_"+tab_id).addClass("tab_on").dblclick(function(){tab_close(tab_id)});$("#tab_li_"+tab_id).unbind("contextmenu").bind("contextmenu",function(e){$('#mm').show().css({left:e.pageX,top:e.pageY});var currtab=$(this).children("a.tab").text();$('#mm').data("currtab",currtab);$('#mm').data("tab_id",tab_id);return false})};
  
//绑定右键菜单事件
function tabCloseEven(){$('#mm-tabupdate').click(function(){var tab_id=$('#mm').data("tab_id");$("#frame_"+tab_id).attr("src",$("#frame_"+tab_id).attr("src"));$("#mm").hide()});$("#mm-exit").click(function(){$("#mm").hide()});$('#mm-tabclose').click(function(){tab_close($('#mm').data("tab_id"));$("#mm").hide()});

$('#mm-tabcloseall').click(function(){$('.tab').each(function(i,n){var t=$(n).text();var id=$(n).parent().attr("id");if($("#"+id).length>0&&t!="首页"){tab_close(id.replace("tab_li_",""))}});$("#mm").hide()});

$('#mm-tabcloseother').click(function(){var currtab_title=$('#mm').data("currtab");$('a.tab').each(function(i,n){var t=$(n).text();var id=$(n).parent().attr("id");if(t!=currtab_title&&t!="首页"){$('#tabs').tabs('close',t)}if(t!=currtab_title&&t!="首页"){tab_close(id.replace("tab_li_",""))}});$("#mm").hide()});$('#mm-tabcloseright').click(function(){var nextall=$("#tabs li[id='tab_li_"+$("#mm").data("tab_id")+"']").nextAll();if(nextall.length==0){$("#mm").hide();return false}nextall.each(function(i,n){var t=$('a:eq(0)',$(n)).text();var id=$(this).attr("id");$('#tabs').tabs('close',t);tab_close(id.replace("tab_li_",""))});$("#mm").hide()});$('#mm-tabcloseleft').click(function(){var prevall=$("#tabs li[id='tab_li_"+$("#mm").data("tab_id")+"']").prevAll();if(prevall.length==0){$("#mm").hide();return false}prevall.each(function(i,n){var t=$('a:eq(0)',$(n)).text();var id=$(this).attr("id");if(t!="首页"&&id!="tab_li_index"){$('#tabs').tabs('close',t);tab_close(id.replace("tab_li_",""))}});$("#mm").hide()})};

function tab_close(tab_id){next_id=$("#tab_li_"+tab_id).next().attr("id");prev_id=$("#tab_li_"+tab_id).prev().attr("id");$('#tabs').tabs("close",$("#tab_li_"+tab_id+" a.tab").text());$("#tab_li_"+tab_id).remove();$("#frame_"+tab_id).remove();if($("#tabs li[class='tab_on']").attr("id")==undefined||$("#tabs li[class='tab_on']").attr("id")==null){if(next_id==undefined||next_id==null){tab_id=prev_id}else{tab_id=next_id}}else{tab_id=$("#tabs li[class='tab_on']").attr("id")}tab_id=tab_id.replace("tab_li_","");tab_frame(tab_id)};

function tab_frame(tab_id){
	$("#tabs li[id!='tab_li_"+tab_id+"']").removeClass("tab_on").mouseover(function(){$(this).addClass("tab_on")}).mouseout(function(){$(this).removeClass("tab_on")});
	$("#tab_li_"+tab_id).removeClass("tab_on").addClass("tab_on").mouseout(function(){$(this).addClass("tab_on")});$("iframe[id!='frame_"+tab_id+"']").attr("height","0");$("#frame_"+tab_id).attr("height",$("#tab_frames").outerHeight());     
	close_dialog();
};

function close_dialog(){$("#_DialogBGDiv").remove();$(".dialogdiv").remove();};

function CurentTime(){ 
	var now = new Date(),year = now.getFullYear(),month = now.getMonth() + 1,day = now.getDate(),hh = now.getHours(),mm = now.getMinutes(),ss = now.getSeconds(),week=now.getDay(),weeks = ["日","一","二","三","四","五","六"],getWeek = "星期" + weeks[week],greet;
	var clock = year + "-";
 	if(month < 10){month="0"+month;}
	if(day < 10){day="0"+day;}
	if(hh < 10){hh="0"+hh;}
	if(mm < 10){mm="0"+mm;}
	if(ss < 10){ss="0"+ss;}
 	
	clock += month + "-";
  	clock += day + " ";
	clock += hh + ":";
	clock += mm; 
	clock +=":"+ ss +" "+"星期"+weeks[week];
	  
	 if(hh >= 0 && hh < 5){
	   greet = '夜深了，注意休息！';
	}else if(hh > 5 && hh <= 7){
	   greet = '早上好！';
	}else if(hh > 7 && hh <= 11){
	   greet = '上午好！';
	}else if(hh > 11 && hh <= 13){
	   greet = '中午好！';
	}else if(hh> 13 && hh <= 18){
	   greet = '下午好！';
	}else if(hh > 18 && hh <= 23){
	   greet = '晚上好！';
	} 
  	 
	$('#time_clock').html(clock);
	//$('#time_greet').html(greet);
	setTimeout('CurentTime()',1000);
};

function get_notice(){
	/*var datas="action=get_notice_alter"+times;$.ajax({type:"post",dataType:"json",url:"/document/notice/send.php",data:datas,cache:false,success:function(json){if(json.counts!="0"){$("#notice_alter").show().html(json.counts).attr("title","您有 "+json.counts+" 个未查看公告通知！")}else{$("#notice_alter").hide()}}});*/
	
	$('#notice_lists li').remove();$.getJSON('/document/notice/send.php?action=get_notice_alter',function(data){var str="";if(data.counts=="0"){str="<li>...</li>";$("#notice_lists").append(str)}else{var list=data.datalist;$.each(list,(function(index,content){str="";str="<li><a href='javascript:void(0)' onclick='veiw_notice("+content.notice_id+");' title='"+content.notice_title+"'>"+content.notice_title+"</a></li>";$(str).appendTo("#notice_lists")}))}});
	setTimeout('get_notice()',600000);
};

function logout(){if(confirm("您确定要注销\"<?php echo $_SESSION['username'] ?>\"的登录吗？")){setTimeout('location.href="/default.php?action=loginout"',10)}};
    
$(document).ready(function(){
	get_datalist();
	
	$("#frame-side a[rel=fold]").removeClass("clsFd").addClass("opnFd").attr("title", "折叠");
	
	$("#set_a_line_area").toggle(function() {
			$(".gFdBdy").css("display","block");
			$("#frame-side a[rel=fold]").removeClass("opnFd").addClass("clsFd").attr("title", "开启")
		},
		function() {
			$(".gFdBdy").css("display", "none");
			$("#frame-side a[rel=fold]").removeClass("clsFd").addClass("opnFd").attr("title", "折叠")
		}
	);
  	
	$('#tabs').tabs('add',{title:'首页',tab_id:"index",width:"10px"});$("#tab_frames").append("<iframe name='frame_index' id='frame_index' src='desktop.php' width='100%' frameborder='0' ></iframe>");$("#frame_index").attr("height",$("#tab_frames").outerHeight());
  	
	tabCloseEven();
	
	//CurentTime();
	
	get_notice();
   	
	var b_width=$('body').outerWidth(),s_width,t_width=$("#time_clock").outerWidth();
	
	$('.side-switcher').toggle(function(){
		$('#frame-side').animate({width: "2px"}, 300);
		$('#page-main').animate({left:"4px"}, 300);
		 
		$('#tabs,#con').css("width",b_width);
		
		if($('.tabs-sc-left').css("display")=="block"){
			var b_w=b_width-t_width-26;
			$('#tabs-wrap').css("width",b_w);
			$('.tabs-sc-right').css("left",b_w+4+t_width);
		}else{
			$('#tabs-wrap').css("width",b_width-t_width-6);
		}
		$(this).animate({left: "2px"}, 300).addClass("side-close").attr("title","展开侧边栏");
 		 
 	},function(){
		
		$('#frame-side').animate({width: "155px"}, 300);
		$('#page-main').animate({left: "157px"}, 300);
		$('#tabs,#con').css("width",b_width);
		
		if($('.tabs-sc-left').css("display")=="block"){
			var b_w=b_width-(t_width*2);
			$('#tabs-wrap').css("width",b_w);
			$('.tabs-sc-right').css("left",b_w+6+t_width);
 		}else{
 			$('#tabs-wrap').css("width",b_width-(t_width*2)+22);
		}
   		
		$(this).animate({left:"155px"},300).removeClass("side-close").attr("title","收缩侧边栏");
	 });
	 
  	$(document).unbind("click").bind("click",function(){
		$('#mm').hide()});$("#mm div.menu_item").hover(function(){$(this).addClass("menu_active")},function(){$(this).removeClass("menu_active");
  		
	});
});
 
</script>
</head>

<body>
<div id="auto_save_res" class="load_layer"></div>
<div class="frame-header" id="frame-header">
  <h1 class="frame-logo"><a href="javascript:void(0);" title="<?php echo $system_name ?>" ></a></h1>
 <div class="round_" title="其他信息">
    <div class="round_main">
      <div class="head_notice_img"><img src="images/home.png" alt="返回系统主页" /></div>
      <div style="height:32px;line-height:32px;width:28px;float:left"><a href="javascript:void(0);" onClick="tab_frame('index');">主页</a></div>
        
      <div class="head_notice_img"><img src="images/login_out.png" alt="退出登录" /></div>
      <div style="height:32px;line-height:32px;width:28px;float:left"><a href="javascript:void(0);" onClick="logout();">退出</a></div>
        
    </div>
 </div>
 
 <div class="round_" title="用户信息">
    <div class="round_main">
        <div class="head_notice_img"><img src="images/user_info.png" alt="用户信息" /></div>
        <div class="head_notice">
          <ul>
            <li>用户名：<a href="javascript:void(0);" title=""><span id="names"><?php echo $_SESSION["fullname"] ?></span> [<?php echo $_SESSION['username'] ?>]</a></li>
            <li>用户组：<a href="javascript:void(0);"><?php echo $_SESSION['user_group'] ?> </a></li>

        </ul>
      </div>
        
    </div>
 </div>

 <div class="round_" title="系统公告" >
    <div class="round_main">
        <div class="head_notice_img"><img src="images/notice.png" alt="系统公告" /></div>
        <div class="head_notice" id="nli_con">
      	<ul id="notice_lists" style="">
                <li><a href="javascript:void(0)">...</a></li>
             </ul>
         </div>
         
    </div>
 </div>
</div>

<div id="frame-side" class="frame-side">
  <div class="gLe" id="Menu_List">
    <div class="gMbtn" id="set_a_line_area" title="点击打开/关闭菜单"></div>
  </div>
</div>

<a class="side-switcher" href="javascript:void(0);" title="点击收缩侧边栏" hidefocus="true">侧边栏</a>
<div class="page-main" id="page-main">

  <div region="center">
    <div id="tabs" fit="true" border="false" > </div>
  </div>
  <div id="tab_frames"></div>
</div>

<div class="footer">
  <div class="welcome"><img src="/images/welcome.jpg" width="101" height="27" /></div>
    <div class="copyright"> <?php echo $system_company ?></div>
    <div class="version"><?php echo $system_version ?></div>
</div>
 
<div id="mm" class="menu">
  <div class="menu_item" id="mm-tabupdate"><a href="javascript:void(0)">刷新</a></div>
  <div class="menu_sep">&nbsp;</div>
  <div class="menu_item" id="mm-tabclose"><a href="javascript:void(0)">关闭当前</a></div>
  <div class="menu_item" id="mm-tabcloseall"><a href="javascript:void(0)">全部关闭</a></div>
  <div class="menu_item" id="mm-tabcloseother"><a href="javascript:void(0)">除此之外全部关闭</a></div>
  <div class="menu_sep">&nbsp;</div>
  <div class="menu_item" id="mm-tabcloseright"><a href="javascript:void(0)">当前页右侧全部关闭</a></div>
  <div class="menu_item" id="mm-tabcloseleft"><a href="javascript:void(0)">当前页左侧全部关闭</a></div>
  <div class="menu_sep">&nbsp;</div>
  <div class="menu_item" id="mm-exit"><a href="javascript:void(0)">退出</a></div>
</div>
<!--<div class="menu_shadow"></div>-->


</div>

</body>
</html>
