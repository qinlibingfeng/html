//去除字符串首尾的空格
String.prototype.trim = function()
{
	return this.replace(/(^\s*)|(\s*$)/g, '');
}

//取得字符串的长度
String.prototype.len = function()
{
	return this.replace(/[^\x00-\xff]/g, 'aa').length;
}

function check_num(this_item)
{
	if(this_item.value !="")
	{
		var Reg = /^\d+(\.\d+)?$/;
		var Reg2 = /^(0+[0-9])/;
		if(!Reg.test(this_item.value) || Reg2.test(this_item.value))
		{
			alert("输入错误，请重新输入数值！");
			this_item.focus();
			return false;
		}
		else return true;
	}
	else
	{
		return true;
	}
}

//function check_num(this_item)
//{
//	var re = /^[0-9]+.?[0-9]*$/; //判断字符串是否为数字 //判断正整数 /^[1-9]+[0-9]*]*$/ 
//	if (!re.test(this_item.value))
//	{
//		alert("请输入数字");
//		this_item.focus();
//		return false;
//	}
//	else return true;
//}


function check_number(this_item)
{

	var character="0123456789.";
	var Reg2 = /^(0+[0-9])/;
	if( Reg2.test(this_item.value))
	{
		alert("输入错误，请重新输入数值！");
		this_item.value="";
		this_item.focus();
		return;
	}
	for (i=0;i<this_item.value.length;i++)
	{
		var check_char=this_item.value.charAt(i);
		if (character.indexOf(check_char)==-1)
		{
			alert("输入错误，请重新输入数值！");
			this_item.value="";
			this_item.focus();
			return;
		}
	}
}

function check_int(this_item)
{

	var character="0123456789";
	var Reg2 = /^(0+[0-9])/;
	if( Reg2.test(this_item.value))
	{
		alert("输入错误，请重新输入合法的整数！");
		this_item.value="";
		this_item.focus();
		return false;
	}
	for (i=0;i<this_item.value.length;i++)
	{
		var check_char=this_item.value.charAt(i);
		if (character.indexOf(check_char)==-1)
		{
			alert("xx");
			this_item.value="";
			this_item.focus();
			return false;
		}
	}
	return true;
}

//取得当前的环境变量
Env = {
	ie : /msie/i.test(navigator.userAgent),		//	Internet Explorer
	gk : /gecko/i.test(navigator.userAgent),	//	Gecko based browsers
	ff : /firefox/i.test(navigator.userAgent),	//	Firefox browsers
	sf : /safari/i.test(navigator.userAgent)	//	Safari
}

ECHOSOFT = {
	//判断字符串是否为空
	checkEmpty : function(sValue)
	{
		var
			regExp = /^\s*$/;

		if (regExp.test(sValue)) return true;
		return false;
	},

	//判断电邮是否格式正确
	checkEmail : function(sEmail)
	{
		var
			regExp = /^\S+@\S+\.\w{2,4}$/gi;

		sEmail = sEmail.trim();
		if (regExp.test(sEmail)) return true;
		return false;
	},

	//判断字符串是否为数字
	checkNumber : function(sValue)
	{
		var
			regExp = /^\d+$/;

		sValue = sValue.trim();
		if (regExp.test(sValue)) return true;
		return false;
	},

	//Http 类
	Http : {
		//以post方式提交内容
		post : function(sUrl, sData, fnCallBack, sReturn)
		{
			var sTmpReturn = 'XML';
			if (arguments.length > 2)
			{
				if (arguments.length > 3) sTmpReturn = sReturn.toUpperCase();
				if (sTmpReturn != 'XML') sTmpReturn = 'TXT';
			}else
			{
				alert("参数不正确");
				return;
			}

			ECHOSOFT.Http.submit(sUrl, sData, fnCallBack, sTmpReturn, true, 'utf-8', 'POST');
		},

		//以Get方式提交内容
		get : function(sUrl, fnCallBack, sReturn)
		{
			var sTmpReturn = 'XML';
			if (arguments.length > 1)
			{
				if (arguments.length > 2) sTmpReturn = sReturn.toUpperCase();
				if (sTmpReturn != 'XML') sTmpReturn = 'TXT';
			}else
			{
				alert("参数不正确");
				return;
			}

			ECHOSOFT.Http.submit(sUrl, null, fnCallBack, sTmpReturn, true, 'utf-8', 'GET');
		},

		//sURL提交路径,sData提交数据,fnCallBack回调函数,bSync是否异步,sCharset字符集utf-8,sMethod提交方式POST
		submit : function(sUrl, sData, fnCallBack, sReturn, bSync, sCharset, sMethod)
		{
			var pHttp = null;//HTTP句柄

			if (Env.ie)
			{
				var msxmls = ['Msxml2.XMLHTTP.5.0','Msxml2.XMLHTTP.4.0','Msxml2.XMLHTTP.3.0','Msxml2.XMLHTTP','Microsoft.XMLHTTP'];
				for (var i = 0; i < msxmls.length; i++)
				{
					try 
					{
						pHttp = new ActiveXObject(msxmls[i]);
					}catch (e){}
				}
			}else
			{
				try 
				{
					pHttp = new XMLHttpRequest();
				}catch (e){}
			}

			if (pHttp)
			{
				try
				{
					pHttp.open(sMethod, sUrl, bSync);
					if(pHttp.overrideMimeType) pHttp.overrideMimeType('text/html;charset=' + sCharset + ';');
					if (sMethod.trim().toUpperCase() == 'POST') pHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					pHttp.send(sData);
					
					if (bSync)
					{ 
						 pHttp.onreadystatechange = function()
						 {
							if (pHttp.readyState != 4) return;
							if (pHttp.status == 200)
							{
								if (fnCallBack) 
								{
									if (sReturn.trim().toUpperCase() == "XML") fnCallBack(pHttp.responseXML.documentElement); else fnCallBack(pHttp.responseText);
								}else alert("缺省回调函数");
							}else alert('所请求的页面有异常');
						}
					}
					else
					{
						if (pHttp.readyState != 4) return;
						if (pHttp.status == 200)
						{
							if (fnCallBack) 
							{
								if (sReturn.trim().toUpperCase() == "XML") fnCallBack(pHttp.responseXML.documentElement); else fnCallBack(pHttp.responseText);
							}else alert("缺省回调函数");
						}
					}
				}catch(e){alert(e.description);}
			}else alert('浏览器不支持XMLHttpRequest对象');
		},

		//初始化上传表单
		upload : function(sFormId, fnCallBack)
		{
			if (arguments.length < 2)
			{
				alert("参数不正确");
				return false;
			}

			var sIFrameName = 'UploadIFrame';
			var pIFrame = document.getElementById(sIFrameName);
			if(pIFrame) document.body.removeChild(pIFrame);
			if(Env.ie)
			{
				pIFrame = document.createElement('<iframe id="' + sIFrameName + '" name="' + sIFrameName + '">');
			}
			else
			{
				pIFrame = document.createElement('iframe');
				pIFrame.id = sIFrameName;
				pIFrame.name = sIFrameName;
			}
			with(pIFrame)
			{
				width = '0';
				height = '0';
				style.display = 'none';
				scrolling = 'no';
				src = 'about:blank';
			}
			document.body.appendChild(pIFrame);

			var pForm = document.getElementById(sFormId);
			if (!pForm) return false;
			if(pForm.encoding.toLowerCase() != 'multipart/form-data') pForm.encoding = 'multipart/form-data';
			if(pForm.method.toLowerCase() != 'post') pForm.method = 'post';
			pForm.target = pIFrame.name;
			if(typeof pIFrame.onreadystatechange == 'object') // for IE
			{
				pIFrame.onreadystatechange = function()
				{
					if(pIFrame.readyState == 'complete' && !pIFrame.loaded)
					{
						pIFrame.loaded = true;
						var xmlDoc = document.frames(pIFrame.id);
						if(xmlDoc.window.document.location != pIFrame.src)
						{
							try
							{
								if (fnCallBack)fnCallBack(xmlDoc.window.document.XMLDocument.documentElement); else alert("缺省回调函数");
							}catch(e){alert(e.description);}
						}
					}
				}
			}else
			{
				pIFrame.onload = function()
				{
					var xmlDoc = pIFrame.contentWindow;
					if(xmlDoc.window.document.location != pIFrame.src)
					{
						try
						{
							if (fnCallBack) fnCallBack(xmlDoc.document.documentElement); else alert("缺省回调函数");
						}catch(e){alert(e.description);}
					}
				}
			}
		},

		//特殊字符处理
		getValue : function(sValue)
		{
			sValue = sValue.replace(/&/g,'%26');
			sValue = sValue.replace(/=/g,'%3D');
			return sValue;
		}
	}, //End Http 类
	
	//Dom 类
	Dom : {
		//取得结点数据
		getNodeText : function(pNode, sDefaultValue)
		{
			var sValue = null;
			try
			{
				switch(pNode.childNodes[0].nodeType)
				{
					case 3 :
						sValue = pNode.childNodes[0].text;
					break;
					case 4 :
						sValue = pNode.childNodes[0].nodeValue;
					break;
				}
			}catch(e){alert(e.description);}

			if (sValue == null || ECHOSOFT.checkEmpty(sValue)) sValue = sDefaultValue;
			return sValue.trim();
		},

		//提交页面返回处理函数
		actionReturnXml : function(pNode)
		{
			var pActionRet = {iFlag : 0, sContent : '返回数据失败'}
			try
			{
				pActionRet.iFlag = parseInt(ECHOSOFT.Dom.getNodeText(pNode.childNodes[0], "0"), 10);
				pActionRet.sContent = ECHOSOFT.Dom.getNodeText(pNode.childNodes[1], "");
			}catch(e){alert(e.description);}
			return pActionRet;
		}
	}, //End Dom 类

	//Window 类
	Window : {
		pCurrentWin : null,//当前窗口句柄
		arypWinStruct : new Array(),//所有窗口句柄
		iWinNo : 1000,
		zIndex : 1000,
		iStop : 12,
		x : 0,
		y : 0,

		//下载窗口模板
		getTpl : function(sTitle, sUrl, sTplImgPath, iWidth, iHeight)
		{
			if (!ECHOSOFT.Window.pCurrentWin) return '';

			var iNo = ECHOSOFT.Window.pCurrentWin.iNo;
			var sTpl = "";
			sTpl = sTpl.concat("<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">");
			sTpl = sTpl.concat("  <tr>");
			sTpl = sTpl.concat("    <td background=\"" + sTplImgPath + "/win_g1.gif\">");
			sTpl = sTpl.concat("      <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">");
			sTpl = sTpl.concat("        <tr>");
			sTpl = sTpl.concat("          <td width=\"25\"><img src=\"" + sTplImgPath + "/win_f1.gif\" width=\"25\" height=\"26\" onmouseup=\"ECHOSOFT.Window.close()\"></td>");
			sTpl = sTpl.concat("          <td>&nbsp;</td>");
			sTpl = sTpl.concat("          <td width=\"17\"><img src=\"" + sTplImgPath + "/win_f2.gif\" width=\"17\" height=\"26\"></td>");
			sTpl = sTpl.concat("          <td background=\"" + sTplImgPath + "/win_g2.gif\" align=\"center\" valign=\"bottom\"><div onmousedown=\"ECHOSOFT.Window.drag(" + iNo + ")\" style=\"padding-bottom:2px;cursor:default;width:100%;textOverflow:ellipsis\"><font color=\"#FFFFFF\"><b>" + sTitle + "</b></font></div></td>");
			sTpl = sTpl.concat("          <td width=\"18\"><img src=\"" + sTplImgPath + "/win_f3.gif\" width=\"18\" height=\"26\"></td>");
			sTpl = sTpl.concat("          <td>&nbsp;</td>");
			//sTpl = sTpl.concat("          <td width=\"22\"><img src=\"" + sTplImgPath + "/win_f4.gif\" width=\"22\" height=\"26\" onmouseup=\"ECHOSOFT.Window.close()\"></td>");
			//sTpl = sTpl.concat("          <td width=\"21\"><img src=\"" + sTplImgPath + "/win_f5.gif\" width=\"21\" height=\"26\" onmouseup=\"ECHOSOFT.Window.max()\"></td>");
			sTpl = sTpl.concat("          <td width=\"27\"><img src=\"" + sTplImgPath + "/win_f6.gif\" width=\"27\" height=\"26\" onmouseup=\"ECHOSOFT.Window.close()\"></td>");
			sTpl = sTpl.concat("        </tr>");
			sTpl = sTpl.concat("      </table>");
			sTpl = sTpl.concat("   </td>");
			sTpl = sTpl.concat("  </tr>");
			sTpl = sTpl.concat("  <tr>");
			sTpl = sTpl.concat("    <td>");
			sTpl = sTpl.concat("      <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">");
			sTpl = sTpl.concat("        <tr>");
			sTpl = sTpl.concat("          <td background=\"" + sTplImgPath + "/win_g3.gif\" width=\"8\"><img src=\"" + sTplImgPath + "/win_g3.gif\" width=\"8\" height=\"26\"></td>");
			sTpl = sTpl.concat("          <td bgcolor=\"#DCEFFF\"><iframe width=\"" + (iWidth - 20) + "\" height=\"" + (iHeight - 40) + "\" frameborder=\"0\" scrolling=\"auto\" src=\"" + sUrl + "\" id=\"Window_" + iNo + "\" name=\"Window_" + iNo + "\" onfocus=\"ECHOSOFT.Window.bringToFront(" + iNo + ")\"></iframe></td>");
			sTpl = sTpl.concat("          <td background=\"" + sTplImgPath + "/win_g4.gif\" width=\"9\"><img src=\"" + sTplImgPath + "/win_g4.gif\" width=\"9\" height=\"26\"></td>");
			sTpl = sTpl.concat("        </tr>");
			sTpl = sTpl.concat("      </table>");
			sTpl = sTpl.concat("    </td>");
			sTpl = sTpl.concat("  </tr>");
			sTpl = sTpl.concat("  <tr>");
			sTpl = sTpl.concat("    <td background=\"" + sTplImgPath + "/win_g5.gif\">");
			sTpl = sTpl.concat("      <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">");
			sTpl = sTpl.concat("        <tr>");
			sTpl = sTpl.concat("          <td width=\"8\"><img src=\"" + sTplImgPath + "/win_f7.gif\" width=\"8\" height=\"28\"></td>");
			sTpl = sTpl.concat("          <td>&nbsp;</td>");
			sTpl = sTpl.concat("          <td valign=\"top\" width=\"18\"><img src=\"" + sTplImgPath + "/win_f8.gif\" width=\"18\" height=\"20\"></td>");
			sTpl = sTpl.concat("          <td width=\"9\"><img src=\"" + sTplImgPath + "/win_f9.gif\" width=\"9\" height=\"28\"></td>");
			sTpl = sTpl.concat("        </tr>");
			sTpl = sTpl.concat("      </table>");
			sTpl = sTpl.concat("    </td>");
			sTpl = sTpl.concat("  </tr>");
			sTpl = sTpl.concat("</table>");
			return sTpl;
		},

		//打开窗口
		open : function(sUrl, sTitle, sTplImgPath, iWidth, iHeight)
		{
			if(arguments.length != 5)
			{
				alert("参数错误");
				return;
			}

			var pWinStruct = {
				pFrom : {
							iTop : 0,
							iLeft : 0,
							iWidth : 0,
							iHeight : 0
						},
				pTo :   {
							iTop : 10,
							iLeft : 10,
							iWidth : iWidth,
							iHeight : iHeight
					    },
				iNo : ECHOSOFT.Window.iWinNo,
				iStep : 0,
				pHandle : null,
				sUrl : sUrl, 
				sTitle : sTitle,
				sTplImgPath : sTplImgPath					
			}
			var pHandle = null;

			with(pWinStruct.pFrom)
			{
				try
				{
					iTop = event.clientY;
					iLeft = event.clientX;
				}catch(e)
				{
					iTop = 0;
					iLeft=0;
				}
			}
		
			try
			{
				with(pWinStruct)
				{
					with(document.body)
					{
						if (clientWidth > iWidth) pTo.iLeft = parseInt((clientWidth - iWidth)/2, 10);
						if (clientHeight > iHeight) pTo.iTop = parseInt((clientHeight - iHeight)/2, 10);
					}

					pHandle = document.createElement("DIV");
					with(pHandle.style)
					{
						zIndex = ECHOSOFT.Window.zIndex;
						position = "absolute";
						border = "1px solid #000000";
						top = pFrom.iTop;
						left = pFrom.iLeft;
						height = 0;
						width = 0;
						display = 'block';
					}

					pHandle.attachEvent('onmousedown', function()
						{
							if(pHandle == ECHOSOFT.Window.pCurrentWin.pHandle) return;
							ECHOSOFT.Window.bringToFront(iNo);
						}
					);
					document.body.appendChild(pHandle);
				}

				with(ECHOSOFT.Window)
				{
					pCurrentWin = pWinStruct;
					arypWinStruct[ECHOSOFT.Window.arypWinStruct.length] = pWinStruct;
					iWinNo ++;
					zIndex ++;
					expand();
				}
				return pWinStruct.iNo;
			}catch(e){alert(e.description);}
			return null;
		},

		//关闭窗口
		close : function()
		{
			with(ECHOSOFT.Window)
			{
				if (!pCurrentWin) return;
				pCurrentWin.pHandle.innerHTML = '';
				collapse();
			}
		},

		//展开动作
		expand : function()
		{
			if (!ECHOSOFT.Window.pCurrentWin) return;
			with(ECHOSOFT.Window.pCurrentWin)
			{
				var iTop = pFrom.iTop + parseInt((pTo.iTop - pFrom.iTop) * (iStep / ECHOSOFT.Window.iStop));
				var iLeft = pFrom.iLeft + parseInt((pTo.iLeft - pFrom.iLeft) * (iStep / ECHOSOFT.Window.iStop));
				var iHeight = pFrom.iHeight + parseInt((pTo.iHeight - pFrom.iHeight) * (iStep / ECHOSOFT.Window.iStop));
				var iWidth = pFrom.iWidth + parseInt((pTo.iWidth - pFrom.iWidth) * (iStep / ECHOSOFT.Window.iStop));

				ECHOSOFT.Window.draw(pHandle, iTop, iLeft, iHeight, iWidth);
				iStep ++;
				if (iStep <= ECHOSOFT.Window.iStop) setTimeout('ECHOSOFT.Window.expand()', 10);
				else 
				{
					pHandle.innerHTML = ECHOSOFT.Window.getTpl(sTitle, sUrl, sTplImgPath, pTo.iWidth, pTo.iHeight);
				}
			}
		},

		//收起动作
		collapse : function()
		{
			if (!ECHOSOFT.Window.pCurrentWin) return;

			with(ECHOSOFT.Window.pCurrentWin)
			{
				var iTop = pFrom.iTop + parseInt((pTo.iTop - pFrom.iTop) * (iStep / ECHOSOFT.Window.iStop));
				var iLeft = pFrom.iLeft + parseInt((pTo.iLeft - pFrom.iLeft) * (iStep / ECHOSOFT.Window.iStop));
				var iHeight = pFrom.iHeight + parseInt((pTo.iHeight - pFrom.iHeight) * (iStep / ECHOSOFT.Window.iStop));
				var iWidth = pFrom.iWidth + parseInt((pTo.iWidth - pFrom.iWidth) * (iStep / ECHOSOFT.Window.iStop));

				try
				{
					ECHOSOFT.Window.draw(pHandle, iTop, iLeft, iHeight, iWidth);
					iStep --;
					if (iStep > -1) setTimeout('ECHOSOFT.Window.collapse()', 10);
					else 
					{
						pHandle.style.display = 'none';
						document.body.removeChild(pHandle);
						var arypTmpWinStruct = new Array();
						var pTmpCurrentWin = null;
						for(var i = 0; i < ECHOSOFT.Window.arypWinStruct.length; i++)
						{
							if(iNo != ECHOSOFT.Window.arypWinStruct[i].iNo) 
							{
								arypTmpWinStruct[arypTmpWinStruct.length] = ECHOSOFT.Window.arypWinStruct[i];
								pTmpCurrentWin = ECHOSOFT.Window.arypWinStruct[i];
							}
						}

						ECHOSOFT.Window.arypWinStruct = arypTmpWinStruct;
						ECHOSOFT.Window.pCurrentWin = pTmpCurrentWin;
					}
				}catch(e){}
			}
		},

		//拖动窗口
		drag : function(iNo)
		{
			with(ECHOSOFT.Window)
			{
				if (!pCurrentWin) return;
				event.cancelBubble = true;

				if(pCurrentWin.iNo != iNo) bringToFront(iNo);

				x = event.clientX;
				y = event.clientY;
				pCurrentWin.pHandle.setCapture();

				try
				{
					document.body.style.cursor = "move";
					document.attachEvent("onselectstart", cancelEvent);
					document.attachEvent('onmousemove', moveTo);
					document.attachEvent('onmouseup', release);
				}catch(e){alert(e.description);}
			}
		},

		//移动窗口
		moveTo : function()
		{
			if (!ECHOSOFT.Window.pCurrentWin) return;

			with(ECHOSOFT.Window.pCurrentWin)
			{
				try
				{
					var iTop = parseInt(pHandle.style.top, 10) + event.clientY - ECHOSOFT.Window.y;
					if(iTop < 0 || iTop > document.body.clientHeight - 30) return;
					var iLeft = parseInt(pHandle.style.left, 10) + event.clientX - ECHOSOFT.Window.x;
					var iHeight = parseInt(pHandle.style.height, 10);
					var iWidth = parseInt(pHandle.style.width, 10);
					if(iLeft + iWidth < 120 || iLeft > document.body.clientWidth - 80) return;
					ECHOSOFT.Window.draw(pHandle, iTop, iLeft, iHeight, iWidth);
					ECHOSOFT.Window.x = event.clientX;
					ECHOSOFT.Window.y = event.clientY;
				}catch(e){}
			}
		},

		//释放资源
		release : function()
		{
			with(ECHOSOFT.Window)
			{
				if (!pCurrentWin) return;

				try
				{
					pCurrentWin.pHandle.releaseCapture();

					document.body.style.cursor = "default";
					document.detachEvent("onselectstart", cancelEvent);
					document.detachEvent('onmousemove', moveTo);
					document.detachEvent('onmouseup', release);
				}catch(e){alert(e.description);}
			}
		},

		//绘画动态弹出
		draw : function(pDiv, iTop, iLeft, iHeight, iWidth)
		{
			if(!pDiv) return;
			with(pDiv.style)
			{
				top = iTop;
				left = iLeft;
				height = iHeight;
				width = iWidth;
			}
		},

		//置顶部
		bringToFront : function(iNo)
		{
			if(ECHOSOFT.Window.arypWinStruct && ECHOSOFT.Window.arypWinStruct.length < 2) return null;
			event.cancelBubble = true;

			with(ECHOSOFT.Window)
			{
				for(var i = 0; i < arypWinStruct.length; i++)
				{
					if(arypWinStruct[i].iNo == iNo)
					{
						pCurrentWin = arypWinStruct[i];
						zIndex ++;
						pCurrentWin.pHandle.style.zIndex = zIndex;
						return pCurrentWin;
					}
				}
			}
		},

		//取消事件
		cancelEvent : function()
		{
			return false;
		}
	}//End Window 类
}

/*
** 函数: SystemReFreshOwner
** 输入: void
** 输出: void
** 描述: 刷新frameset所有窗口
*/
function SystemReFreshOwner()
{
	location.reload();
}

