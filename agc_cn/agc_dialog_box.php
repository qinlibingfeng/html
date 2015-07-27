
<div style="width:780px;height:520px;"id="notice_Box"class="dialog"><table cellspacing="0"cellpadding="0"border="0"style="-moz-user-select:none;"width="100%"height="100%"><tbody><tr><td width="13"height="33"class="b_l_t"><div style="width:13px;"></div></td><td class="title"><div class="tit_info"><img align="absmiddle"src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">系统公告</span></div><div class="close"onclick="hideDiv('notice_Box')"></div></td><td width="13"height="33"class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center"valign="top"><table cellspacing="0"cellpadding="0"border="0"bgcolor="#FFFFFF"width="100%"height="100%"><tr><td align="center"valign="top"><div class="page_nav"><div class="nav_ico"><img src="/images/page_nav_ico.jpg"/></div><div class="nav_"style=" margin-left:-120px">当前位置：<a href="javascript:void(0);">首页</a> &gt; 查看公告 <div id="side_loading_n_con" style="display:block;padding-left:160px; position:absolute;top:6px"><img src="../images/loading.gif"/></div></div><div class="nav_other"><a href="javascript:void(0);"onclick="javascript:show_Notice('0');"><img src="/images/page_reload.jpg"alt="刷新本页"/></a></div></div><div class="page_main"><table border="0"width="98%"align="center"cellpadding="2"cellspacing="1"style="table-layout: fixed"><tr><td height="22"align="center"valign="middle"><strong id="c_notice_title"></strong></td></tr><tr align='center'><td height="20"align="center"valign="middle"style="border-bottom:dotted 1px #ccc"><span class="gray">发布人：</span><span id="c_notice_full_name"></span>[<span id="c_notice_user_id"></span>]<span class="gray">&nbsp; 发布时间：</span><span id="c_notice_addtime"></span><span class="gray">&nbsp; 已读：</span><span id="c_notice_read"></span></td></tr><tr align='center'><td align="left"valign="top"><div id="c_notice_content"style="height:346px;width:736px; overflow:auto;"></div></td></tr></table></div></td></tr><tr><td><div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('notice_Box');return false;"title="点击关闭本提示框"><input type="button"value="关 闭"class="inputButton"></a></div></td></tr></table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table></div>

<div style="width:630px;min-height:360px;" id="DispoSelectBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">选择呼叫结果</span></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:220px;*height:168px">
		
        <div class="dialog_sub_tit">
            <strong>请选择呼叫结果选项后提交：</strong><span id="DispoSelectPhonE" class="blue"></span>
   		</div>
        
        <div class="call_status_list" id="DispoSelectContent"></div>
 
        <div style="border-top:1px dotted #ccc; margin-top:4px">
            <input type="hidden" name="DispoSelection" id="DispoSelection">
            <input type="checkbox" name="DispoSelectStop" id="DispoSelectStop" value="0"><label for="DispoSelectStop" style="margin-right:6px" class="green">提交后暂停外呼</label> <span class="gray">仅针对自动外呼业务有效</span>
   		</div>
        
          </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><span id="DispoSelectHAspan"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="DispoHanguPAgaiN()" title="点击再次挂断"><input type="button" value="再次挂断"  class="inputButton"></a></span>  <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="DispoSelectContent_create('','ReSET');return false;" title="点击重新选择呼叫结果"><input type="button" value="重新选择"  class="inputButton"></a>  <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="DispoSelect_submit();return false;" title="点击提交结果"><input type="button" value="提交结果"  class="inputButton"></a> <!--<a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="WeBForMDispoSelect_submit();return false;" title="点击打开网页链接一提交，本方式提交需要关闭浏览器的弹窗阻止功能或将本服务器地址加入阻止许可"><input type="button" value="网页链接提交"  class="inputButton"></a>--></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div id="NeWManuaLDiaLBox" class="dialog" style="width:526px;height:320px;" >
  <table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">手动拨号</span></div><div class="close" onclick="hideDiv('NeWManuaLDiaLBox')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:240px;*height:218px">
          
          <table border="0" cellpadding="2" cellspacing="0"width="100%">
               
              <tr>
                <td ></td>
                <td align=left><span class="green">请注意：</span><span class="gray">手动拨打的号码，将添加到 <strong><?php echo $manual_dial_list_id ?></strong> 清单中 </span><span id="MDPhonENumbeR_text" class="hide"></span></td>
              </tr>
              <tr>
                <td width="26%" align="right" valign="top" style="padding-top:6px"><strong>电话号码： </strong></td>
                <td align=left><div id="phone_layer"><div class="phone_input"><input type="text"  maxlength="16" name="MDPhonENumbeR" id="MDPhonENumbeR"  value="" onKeyUp="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" ><a href="javascript:void(0)" title="号码回退" class="pnumber_del" ></a></div>
      <div class="number_list"> <a href="javascript:void(0)" title="1" >1</a> <a href="javascript:void(0)" title="2" >2</a> <a href="javascript:void(0)" title="3" >3</a> <a href="javascript:void(0)" title="4" >4</a> <a href="javascript:void(0)" title="5" >5</a> <a href="javascript:void(0)" title="6" >6</a> <a href="javascript:void(0)" title="7" >7</a> <a href="javascript:void(0)" title="8" >8</a> <a href="javascript:void(0)" title="9" >9</a> <a href="javascript:void(0)" style="font-size:26px;padding-top:10px; height:28px" title="*" >*</a> <a href="javascript:void(0)" title="0" >0</a> <a href="javascript:void(0)" title="#" >#</a> </div></div><label for="MDPhonENumbeR"><span class="gray" style="float:left;margin-left:6px;margin-top:2px">最大支持16个数字</span></label><input type="hidden" name="MDDiaLCodE" id="MDDiaLCodE" value="0" /><input type="hidden" name="MDDiaLOverridE" id="MDDiaLOverridE"  value="" />
                </td>
            </tr>
              <tr>
                <td align=right><strong>查询号码：</strong></td>
                <td align=left><input name="LeadLookuP" type="checkbox" id="LeadLookuP" value="0" size="1" checked="checked"><label for="LeadLookuP"><span class="gray">尝试在系统中查找其信息</span></label></td>
              </tr>
              
            </table>
        
           </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="NeWManuaLDiaLCalLSubmiT('NOW');return false;" title="点击立即拨打"><input type="button" value="立即拨打"  class="inputButton" ></a> <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="NeWManuaLDiaLCalLSubmiT('PREVIEW');return false;" title="点击预览本次呼叫"><input type="button" value="预 览"  class="inputButton" ></a> <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('NeWManuaLDiaLBox');return false;" title="点击取消本次呼叫"><input type="button" value="取 消"  class="inputButton"></a>
     </div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="height:218px" id="WelcomeBoxA" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">欢迎使用</span></div><div class="close" onclick="hideDiv('WelcomeBoxA')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:130px;*height:118px">

    <table height="130" cellspacing="0" cellpadding="10" border="0" align="center">
        <tbody>
            <tr>
                <td align="right">
                <img width="34" height="34" align="absmiddle" src="/images/icon_alert.gif">
                </td>
                <td id="WelcomeBoxAt" align="left"></td>
            </tr>
        </tbody>
    </table>
    

      </td>
    </tr>
    <tr ><td>
      <div class="btn_line"> <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('WelcomeBoxA');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="height:218px" id="CallbacksButtons" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">回拨按键</span></div><div class="close" onclick="hideDiv('CallbacksButtons')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:130px;*height:118px">

        <table height="130" cellspacing="0" cellpadding="10" border="0" align="center">
            <tbody>
                <tr>
                    <td align="right">
                    <img width="34" height="34" align="absmiddle" src="/images/icon_alert.gif">
                    </td>
                    <td id="CBstatusSpan" align="left"></td>
                </tr>
            </tbody>
        </table>
		
  
      </td>
    </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('CallbacksButtons');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>


<div style="height:218px" id="AgentMuteANDPreseTDiaL" class="dialog">

<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">坐席静音和发送DTMF</span></div><div class="close" onclick="hideDiv('AgentMuteANDPreseTDiaL')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:130px;*height:118px">

  <?php
	if ($PreseT_DiaL_LinKs){
		echo "<a href=\"javascript:void(0);\" onclick=\"DtMf_PreSet_a_DiaL();return false;\">D1 - 拨号</a>\n";
		echo "<br/>\n";
		echo "<a href=\"javascript:void(0);\" onclick=\"DtMf_PreSet_b_DiaL();return false;\">D2 - 拨号</a>\n";
	}else{
		echo '<table height="130" cellspacing="0" cellpadding="10" border="0" align="center"><tbody><tr><td align="right"><img width="34" height="34" align="absmiddle" src="/images/icon_alert.gif"></td><td id="" class="red" align="left">无拨号按键设置！</td></tr></tbody></table>';
	}
	?>
    
    </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('AgentMuteANDPreseTDiaL');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div id="CallBacKsLisTBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">回拨信息</span></div><div class="close" onclick="hideDiv('CallBacKsLisTBox')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:240px;*height:218px">
					
            <span class="green">请注意！</span><span class="gray">点击回拨后，该回拨记录将自动删除。</span> <br/>
            <div class="scroll_callback" id="CallBacKsLisT"></div>
  
          </td>
        </tr>
        <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="CalLBacKsLisTCheck();return false;" title="点击刷新"><input type="button" value="刷 新"  class="inputButton"></a> <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('CallBacKsLisTBox');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="height:342px;width:660px" id="TransferMain" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">会议 - 转接</span></div><div class="close" onclick="hideDiv('TransferMain')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:330px;*height:318px">
     
    <div class="text_input" id="TransferMaindiv"> 
    <div id="XfeRDiaLGrouPSelecteD"></div>
    <div id="XfeRCID"></div>
         
          <TABLE width="100%" border=0 cellpadding=0 cellspacing=1>
            <TR>
              <TD ALIGN=LEFT COLSPAN=3>
              	<div id="XfeRGrouPLisT" style="margin-bottom:6px">
                  <select size=1 name="XfeRGrouP" id="XfeRGrouP"  onChange="XferAgentSelectLink();return false;">
                    <option>-- 选择您要转接的坐席组 --</option>
                  </select>
                </div>
                <div class="div_alt" id="LocalCloser">&nbsp;本地呼入组</div></TD>
              <TD width="181" ALIGN=LEFT style="padding-top:26px"><div class="div_alt" id="HangupXferLine">&nbsp;挂断转接线</div></TD>
            </TR>
            <TR>
              <TD COLSPAN="2" ALIGN="LEFT" nowrap="nowrap">
              <div class="">&nbsp;时长(秒)：<input type="text" size="2" name="xferlength" id="xferlength" maxlength="4" >&nbsp; 通道：<input type="text" size="12" name="xferchannel" id="xferchannel" maxlength="200" ></div></TD>
              <TD width="166" ALIGN=LEFT>
              <div class=""><input type="checkbox" name="consultativexfer" id="consultativexfer" size="1" value="0"><label for="consultativexfer">先沟通</label></div></TD>
              <TD ALIGN=LEFT><div class="" id="HangupBothLines"><a href="javascript:void(0);" onClick="bothcall_send_hangup();return false;">&nbsp;全部挂断</a></div></TD>
            </TR>
            <TR>
              <TD COLSPAN=2 ALIGN=LEFT nowrap="nowrap"><div class="div_alt">&nbsp;转接目标：
                <input type=text size=20 name="xfernumber" id="xfernumber" maxlength=25  value="<?php echo $preset_populate ?>">
                &nbsp;
                <span id="agentdirectlink"><a href="javascript:void(0);" onClick="XferAgentSelectLaunch();return false;">&nbsp;坐席</a></span>
                <input type="hidden" name="xferuniqueid" id="xferuniqueid"></div></TD>
              <TD ALIGN=LEFT><div class="div_alt"><input type="checkbox" name="xferoverride" id="xferoverride" size="1" value="0"><label for="xferoverride">覆盖拨号</label></div></TD>
              <TD ALIGN=LEFT><div class="div_alt" id="Leave3WayCall"><a href="javascript:void(0);" onClick="leave_3way_call('FIRST');return false;">&nbsp;离开三方通话</a></div></TD>
            </TR>
            <TR>
              <TD ALIGN=LEFT COLSPAN=4><div class="div_alt" id="DialBlindTransfer">&nbsp;盲转</div>
                &nbsp;
                <div class="div_alt" id="DialWithCustomer"><a href="javascript:void(0);" onClick="SendManualDial('YES');return false;">&nbsp;直转</a></div>
                &nbsp;
                <div class="div_alt" id="ParkCustomerDial"><a href="javascript:void(0);" onClick="xfer_park_dial();return false;">&nbsp;保持转接</a></div>
                &nbsp;  <a href="javascript:void(0);" onClick="DtMf_PreSet_a();return false;">D1</a> <a href="javascript:void(0);" onClick="DtMf_PreSet_b();return false;">D2</a> <a href="javascript:void(0);" onClick="DtMf_PreSet_c();return false;">D3</a> <a href="javascript:void(0);" onClick="DtMf_PreSet_d();return false;">D4</a> <a href="javascript:void(0);" onClick="DtMf_PreSet_e();return false;">D5</a>  &nbsp;
                <div class="div_alt" id="DialBlindVMail">&nbsp;盲转语音邮箱</div></TD>
            </TR>
          </TABLE>
        </div> 
  
  </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('TransferMain');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="width:630px" id="callsinqueuedisplay" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">队列电话</span></div><div class="close" onclick="hideDiv('callsinqueuedisplay')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:240px;*height:218px">
 
        <div id="callsinqueuelist"></div> 
  </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('callsinqueuedisplay');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="height:230px" id="callsinqueuelink" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">显示队列</span></div><div class="close" onclick="hideDiv('callsinqueuelink')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:130px;*height:118px">

<?php 
	if ($view_calls_in_queue > 0){ 
		if ($view_calls_in_queue_launch > 0){
			echo "<a href=\"javascript:void(0);\" onclick=\"show_calls_in_queue('HIDE');\">隐藏队列中的电话</a>\n";
		}else{
			echo "<a href=\"javascript:void(0);\" onclick=\"show_calls_in_queue('SHOW');\">显示队列中的电话</a>\n";
		}
	}
?>
        </td>
        </tr>
        <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('callsinqueuelink');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="width:620px;" id="AgentViewSpan" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">查看其他坐席状态</span></div><div class="close" onclick="hideDiv('AgentViewSpan')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:240px;*height:218px">
 
            <div id="AgentViewStatus"></div> 
          </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('AgentViewSpan');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div id="AgentXferViewSpan" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">转接可用坐席</span></div><div class="close" onclick="hideDiv('AgentXferViewSpan')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:240px;*height:218px">
  
        <div id="AgentXferViewSelect"></div>  
        
        
      </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('AgentXferViewSpan');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="height:218px" id="AgentViewLinkSpan" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">查看坐席</span></div><div class="close" onclick="hideDiv('AgentViewLinkSpan')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="middle" class="info" style="height:130px;*height:118px">

   <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="AgentsViewOpen('AgentViewSpan','open');return false;" title="点击查看坐席"><input type="button" value="点击查看坐席"  class="inputButton"></a>
          
  
          </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="AgentsViewOpen('AgentViewSpan','open');return false;" title="点击查看坐席"><input type="button" value="查看坐席"  class="inputButton"></a> <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('AgentViewLinkSpan');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="height:218px" id="dialableleadsspan" class="dialog">
 <table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">可拨打号码</span></div><div class="close" onclick="hideDiv('dialableleadsspan')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:130px;*height:118px">

<?php 
if ($agent_display_dialable_leads > 0){ 
	echo "可拨打号码:<BR> &nbsp;\n";
}
?>
     </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('dialableleadsspan');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>
 
<div style="height:218px" id="AgentMuteSpan" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">坐席静音</span></div><div class="close" onclick="hideDiv('AgentMuteSpan')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:130px;*height:118px">

            </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('AgentMuteSpan');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div id="HotKeyActionBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">坐席热键列表</span></div><div class="close" onclick="hideDiv('HotKeyActionBox')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:240px;*height:218px">

  
        <div id="HotKeyDispo" ></div> 
  
          </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('HotKeyActionBox');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div id="HotKeyEntriesBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">呼叫结果热键</span></div><div class="close" onclick="hideDiv('HotKeyEntriesBox')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:240px;*height:218px">

     
            <span class="green">提示：</span><span class="gray">当激活热键时，只需要按键盘就可以快速挂断通话并提交相应的呼叫结果</span><br />
            <div id="HotKeyBoxA" ><?php echo $HKboxA ?></div>
          	<br />
            <div id="HotKeyBoxB" ><?php echo $HKboxB ?></div>
            <br />
            <div id="HotKeyBoxC" ><?php echo $HKboxC ?></div> 
  
  
          </td>
        </tr>
    	<tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('HotKeyEntriesBox');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="height:218px" id="CBcommentsBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">回呼信息</span></div><div class="close" onclick="hideDiv('CBcommentsBox')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="middle" class="info" style="height:130px;*height:118px">

        <div id="CBcommentsBoxA" ></div>
        <div id="CBcommentsBoxB" ></div> 
        <div id="CBcommentsBoxC" ></div>
        <div id="CBcommentsBoxD" ></div> 
           
  
      </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="CBcommentsBoxhide();return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="height:218px" id="EAcommentsBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">扩展备用电话信息</span></div><div class="close" onclick="hideDiv('EAcommentsBox')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="middle" class="info" style="height:130px;*height:118px">

    <div id="EAcommentsBoxC" ></div>
    <div id="EAcommentsBoxB" ></div> 
    <div id="EAcommentsBoxA" ></div>
    <div id="EAcommentsBoxD" ></div>
      
          </td>
        </tr>
        <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="EAcommentsBoxhide('YES');return false;" title="确认返回"><input type="button" value="确认返回"  class="inputButton"></a>  <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('EAcommentsBox')" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>


<div style="height:218px" id="EAcommentsMinBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">系统提示</span></div><div class="close" onclick="hideDiv('EAcommentsMinBox')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:130px;*height:118px">
   
  
          </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="EAcommentsBoxshow();return false;" title="确认返回"><input type="button" value="确认返回"  class="inputButton"></a> <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('EAcommentsMinBox');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>


<div style="height:260px;" id="NoneInSessionBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">未连接坐席分机客户端</span></div><div class="close" onclick="NoneInSessionOK();return false;"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="middle" class="info" style="height:172px;*height:160px">

<table height="130" cellspacing="0" cellpadding="10" border="0" align="center"><tbody><tr><td align="right"><img width="34" height="34" align="absmiddle" src="/images/icon_alert.gif"></td><td id="" align="left"><span class="red">当前坐席未成功连接软电话到会议室：</span><strong id="NoneInSessionID"></strong>  <br />请检查桌面软电话客户端是否已正常打开注册，并和当前工号 <strong class="green"><?php echo $VD_login ?></strong> 一致！ <br /><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="NoneInSessionCalL();return false;" title="点击呼叫坐席分机"><input type="button" value="呼叫坐席分机"  class="inputButton"></a></td></tr></tbody></table>	
    
      </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="NoneInSessionCalL();return false;" title="点击呼叫坐席分机"><input type="button" value="呼叫坐席分机"  class="inputButton"></a> <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="NoneInSessionOK();return false;" title="点击确认返回"><input type="button" value="确认返回"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="height:230px" id="CustomerGoneBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">被叫客户已挂断电话或拒接接听</span></div><div class="close" onclick="hideDiv('CustomerGoneBox')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:130px;*height:118px">

     <table height="130" cellspacing="0" cellpadding="10" border="0" align="center"><tbody><tr><td align="right"><img width="34" height="34" align="absmiddle" src="/images/icon_alert.gif"></td><td id="CustomerGoneChanneL" class="red" align="left"></td></tr></tbody></table>
     
  </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="CustomerGoneHangup();return false;" title="点击挂断提交"><input type="button" value="挂断提交"  class="inputButton"></a> <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="CustomerGoneOK();return false;" title="点击确认返回"><input type="button" value="确认返回"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div id="WrapupBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">剩余时间提醒 <span id="WrapupTimer"></span></span></div><div class="close" onclick="hideDiv('WrapupBox')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:240px;*height:218px">

   		 <table height="130" cellspacing="0" cellpadding="10" border="0" align="center"><tbody><tr><td align="right"><img width="34" height="34" align="absmiddle" src="/images/icon_alert.gif"></td><td id="WrapupMessage" class="red" align="left"></td></tr></tbody></table>
           
          </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="WrapupFinish();return false;" title="点击继续工作"><input type="button" value="继续工作"  class="inputButton"></a> <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('WrapupBox');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="height:218px" id="TimerSpan" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">系统提示</span></div><div class="close" onclick="hideDiv('TimerSpan')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:130px;*height:118px">

 			<table height="130" cellspacing="0" cellpadding="10" border="0" align="center"><tbody><tr><td align="right"><img width="34" height="34" align="absmiddle" src="/images/icon_alert.gif"></td><td id="TimerContentSpan" class="red" align="left"></td></tr></tbody></table>
        	
          </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('TimerSpan');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>


<div style="height:218px;" id="LogouTBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">系统提示</span></div><div class="close" id="close_relogonin"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="middle" class="info" style="height:130px;*height:168px">

  <table height="130" cellspacing="0" cellpadding="10" border="0" align="center"><tbody><tr><td align="right"><img width="34" height="34" align="absmiddle" src="/images/icon_alert.gif"></td><td id="" class="red" align="left">您已经成功签退！<a class="zInputBtn"  href="javascript:void(0);" title="点击重新签入" id="btn_relogonin_1"><input type="button" value="重新签入"  class="inputButton"></a></td></tr></tbody></table>
  
      </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn"  href="javascript:void(0);" title="点击重新签入" id="btn_relogonin_2"><input type="button" value="重新签入"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="height:218px" id="AgenTDisablEBoX" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">系统提示</span></div><div class="close" onclick="hideDiv('AgenTDisablEBoX')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:130px;*height:118px">

  <table height="130" cellspacing="0" cellpadding="10" border="0" align="center"><tbody><tr><td align="right"><img width="34" height="34" align="absmiddle" src="/images/icon_alert.gif"></td><td id="" class="red" align="left">您的会话已被暂停！<a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="LogouT('DISABLED');return false;" title="点击签退重登"><input type="button" value="签退重登"  class="inputButton"></a></td></tr></tbody></table>
  
      </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="LogouT('DISABLED');return false;" title="点击签退重登"><input type="button" value="签退重登"  class="inputButton"></a> <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('AgenTDisablEBoX');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="height:218px"  id="SysteMDisablEBoX" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">系统提示</span></div><div class="close" onclick="hideDiv('SysteMDisablEBoX')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:130px;*height:118px">

   			<table height="130" cellspacing="0" cellpadding="10" border="0" align="center"><tbody><tr><td align="right"><img width="34" height="34" align="absmiddle" src="/images/icon_alert.gif"></td><td id="" class="red" align="left">系统时间同步错误，请检查您的网络状况或联系管理员！<br />如仍未能解决该问题，请重启本服务器！</td></tr></tbody></table>
            
   
          </td>
        </tr>
       <tr><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('SysteMDisablEBoX');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div id="DispoButtonHideA" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">系统提示</span></div><div class="close" onclick="hideDiv('DispoButtonHideA')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:240px;*height:218px">
 		
        </td>
      </tr>
      <tr ><td><div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('DispoButtonHideA');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div id="DispoButtonHideB" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">系统提示</span></div><div class="close" onclick="hideDiv('DispoButtonHideB')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:240px;*height:218px">
 
   
      </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('DispoButtonHideB');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="height:218px" id="DispoButtonHideC" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">更新提示</span></div><div class="close" onclick="hideDiv('DispoButtonHideC')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:130px;*height:118px">

    <table height="130" cellspacing="0" cellpadding="10" border="0" align="center"><tbody><tr><td align="right"><img width="34" height="34" align="absmiddle" src="/images/icon_alert.gif"></td><td id="" class="green" align="left">如果要更新客户信息，您必须在点击挂断按钮之前就录入数据！</td></tr></tbody></table>
    
      </td>
    </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('DispoButtonHideC');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>
 
<div style="height:280px;min-height:280px;width:530px;" id="PauseCodeSelectBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">选择暂停原因</span></div><div class="close" onclick="PauseCodeSelect_submit('');return false"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="min-height:170px;*height:170px">

   		<div class="dialog_sub_tit">
            <strong>请选择暂停原因：</strong>
   		</div>
        
        <div class="call_status_list" style="width:500px;height:160px;max-height:160px;" id="PauseCodeSelectContent"></div>
         <input type="hidden" name="PauseCodeSelection" id="PauseCodeSelection"> 
           </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="PauseCodeSelect_submit('');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div id="GroupAliasSelectBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">选择组别名</span></div><div class="close" onclick="hideDiv('GroupAliasSelectBox')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:240px;*height:218px">

            <div id="GroupAliasSelectContent"></div>
            <input type="hidden" name="GroupAliasSelection" id="GroupAliasSelection"> 
    
           </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('GroupAliasSelectBox');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div id="CallBackSelectBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">选择回拨时间</span></div><div class="close" onclick="hideDiv('CallBackSelectBox')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:240px;*height:218px">

      <table width="100%" border=0 cellpadding="0" cellspacing="1" >
        <TR>
          <TD align=center VALIGN=top>
           回拨日期 :<div id="CallBackDatE"></div>
            <br/>
            <input type="hidden" name="CallBackDatESelectioN" ID="CallBackDatESelectioN">
            <input type="hidden" name="CallBackTimESelectioN" ID="CallBackTimESelectioN">
            <div id="CallBackDatEPrinT">选择以下时间</div>
            &nbsp;
            <div id="CallBackTimEPrinT"></div>
            &nbsp; &nbsp;
            时:
            <SELECT NAME="CBT_hour" ID="CBT_hour">
              <option>01</option>
              <option>02</option>
              <option>03</option>
              <option>04</option>
              <option>05</option>
              <option>06</option>
              <option>07</option>
              <option>08</option>
              <option>09</option>
              <option>10</option>
              <option>11</option>
              <option>12</option>
            </select>
            &nbsp;
            分:
            <SELECT  NAME="CBT_minute" ID="CBT_minute">
              <option>00</option>
              <option>05</option>
              <option>10</option>
              <option>15</option>
              <option>20</option>
              <option>25</option>
              <option>30</option>
              <option>35</option>
              <option>40</option>
              <option>45</option>
              <option>50</option>
              <option>55</option>
            </select>
            &nbsp;
            <SELECT  NAME="CBT_ampm" ID="CBT_ampm">
              <option value="AM">上午</option>
              <option value="PM" selected>下午</option>
            </select>
            &nbsp;<br/>
            <?php
        if ($agentonly_callbacks)
            {echo "<input type=checkbox name=CallBackOnlyMe id=CallBackOnlyMe size=1 value=\"0\">仅限本人跟进 <br/>";}
        ?>
            回拨备注:
            <input type=text name="CallBackCommenTsField" id="CallBackCommenTsField" size=40 maxlength=255>
            <br/>
              
            <div id="CallBackDateContent"><?php //echo "$CCAL_OUT" ?></div>
            <br/>
            <br/>
            &nbsp; </TD>
        </TR>
      </TABLE>
  
      </td>
    </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="CallBackDatE_submit();return false;" title="点击提交回拨时间"><input type="button" value="提交选择"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div id="CloserSelectBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">选择要加入的呼入组</span></div><div class="close" onclick="hideDiv('CloserSelectBox')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:240px;*height:218px">
 
        <div id="CloserSelectContent"></div>
        <input type="hidden" name="CloserSelectList">
        <br/>
        <?php
        if ( ($outbound_autodial_active > 0) and ($disable_blended_checkbox < 1) and ($dial_method != 'INBOUND_MAN') )
        {
        ?>
        <label for="CloserSelectBlended">
          <input type="checkbox" id="CloserSelectBlended" name="CloserSelectBlended" size=1 value="0">
          混合模式(激活呼出)</label>
        <br/>
        <?php
        }
        ?>
         
  
          </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="CloserSelectContent_create();return false;" title="点击重新选择"><input type="button" value="重新选择"  class="inputButton"></a> <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="CloserSelect_submit();return false;" title="点击提交呼入组"><input type="button" value="提交选择"  class="inputButton"></a> </div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div id="TerritorySelectBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">选择地区</span></div><div class="close" onclick="hideDiv('TerritorySelectBox')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:240px;*height:218px">

   <div id="TerritorySelectContent"></div>
    <input type="hidden" name="TerritorySelectList" id="TerritorySelectList">
         
  
          </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="TerritorySelectContent_create();return false;" title="点击重新选择"><input type="button" value="重新选择"  class="inputButton"></a> <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="TerritorySelect_submit();return false;" title="点击提交地区选择"><input type="button" value="提交选择"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="height:218px" id="NothingBox" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">通道信息</span></div><div class="close" onclick="hideDiv('NothingBox')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:130px;*height:118px">

   <br />
        <BUTTON Type=button name="inert_button"><img src="./images/blank.gif"></BUTTON>
        <div id="DiaLLeaDPrevieWHide">通道</div>
        <div id="DiaLDiaLAltPhonEHide">通道</div>
        <?php
        if (!$agentonly_callbacks)
            {echo "<label for=\"CallBackOnlyMe\"><input type=\"checkbox\" name=\"CallBackOnlyMe\" id=\"CallBackOnlyMe\" size=1 value=\"0\">仅限本人跟进</label><br/>";}
        if ( ($outbound_autodial_active < 1) or ($disable_blended_checkbox > 0) or ($dial_method == 'INBOUND_MAN') )
            {echo "<label for=\"CloserSelectBlended\"><input type=\"checkbox\" name=\"CloserSelectBlended\"  id=\"CloserSelectBlended\" size=1 value=\"0\">混合模式(激活呼出)</label><br/>";}
        ?> 
  
  </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('NothingBox');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
</div>

<div style="height:218px"  id="GENDERhideFORieALT" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">系统提示</span></div><div class="close" onclick="hideDiv('GENDERhideFORieALT')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:130px;*height:118px">

        </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('GENDERhideFORieALT');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
  
</div>

<?php if ( ($HK_statuses_camp > 0) && ( ($user_level>=$HKuser_level) or ($VU_hotkeys_active > 0) ) ) { ?>
<div style="height:218px" id="hotkeysdisplay" class="dialog">
<table cellspacing="0" cellpadding="0" border="0" style="-moz-user-select:none;" width="100%" height="100%"><tbody><tr ><td width="13" height="33" class="b_l_t"><div style="width:13px;"></div></td><td class="title" ><div class="tit_info"><img align="absmiddle" src="/images/icon_dialog.gif">&nbsp;<span style="color:#FFFFFF;">坐席热键</span></div><div class="close" onclick="hideDiv('hotkeysdisplay')"></div></td><td width="13" height="33" class="b_r_t"><div style="width:13px;"></div></td></tr><tr ><td class="b_l_m"></td><td align="center" valign="top"><table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="100%" height="100%"><tr><td align="center" valign="top" class="info" style="height:130px;*height:118px">

<table height="130" cellspacing="0" cellpadding="10" border="0" align="center"><tbody><tr><td align="right"><img width="34" height="34" align="absmiddle" src="/images/icon_alert.gif"></td><td id="" class="red" align="left">坐席热键已启用！<a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onMouseOver="HotKeys('ON')" title="点击关闭热键"><input type="button" value="关闭热键"  class="inputButton"></a></td></tr></tbody></table>
				
        </td>
        </tr>
    <tr ><td>
      <div class="btn_line"><a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onMouseOver="HotKeys('ON')" title="点击关闭热键"><input type="button" value="关闭热键"  class="inputButton"></a> <a class="zInputBtn" href="javascript:void(0);" hidefocus="true" onclick="hideDiv('hotkeysdisplay');return false;" title="点击关闭本提示框"><input type="button" value="关 闭"  class="inputButton"></a></div></td>
    </tr>
  </table></td><td class="b_r_m"></td></tr><tr><td class="b_b_l"></td><td class="b_b_m"></td><td class="b_b_r"></td></tr></tbody></table>
  
</div>
<?php } ?>
 