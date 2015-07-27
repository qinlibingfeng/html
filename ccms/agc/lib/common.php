<?php

/*
** 函数: FormatValue
** 输入: $sValue, sDefault
** 输出: string
** 描述: 格式化数据值
*/
function FormatValue($sValue, $sDefault = '')
{
	$value = trim($value);
	if (ereg("^[0-9]+$",$value)) return $value;
	return empty($value) ? $default : $value;
}

/*
** 函数: GBsubstr
** 输入: $sValue,$iStart,$iLen
** 输出: string
** 描述: 返回截取汉字的字符串
*/
function GBsubstr($sValue, $iStart, $iLen)
{
	if (strlen($sValue) > $iLen)
	{
		$sTmpStr = '';
		$iStrLen = $iStart + $iLen - 4;
		for($i = 0; $i < $iStrLen; $i++)
		{
			if (ord(substr($sValue, $i, 1)) > 0xa0)
			{
				$sTmpStr .= substr($sValue, $i, 2);
				$i ++;
			}else
			{
				$sTmpStr .= substr($sValue, $i, 1);
			}
		}
		$sTmpStr .= '...';
		return $sTmpStr;
	}
	return $sValue;
}

/*
** 函数: SysPost
** 输入: $sArg,$sDefault
** 输出: object
** 描述: 返回POST变量
*/
function SysPost($sArg, $sDefault = '')
{
	if (is_array($_POST["$sArg"]))
	{
		if (count($_POST["$sArg"]) > 0)
		{
			foreach($_POST["$sArg"] as $key => $value)
			{
				if (empty($_POST["$sArg"][$key])) $_POST["$sArg"][$key] = $sDefault;
			}
		}
	}else
	if (empty($_POST["$sArg"]))
	{
		$_POST["$sArg"] = $sDefault;
	}
	return $_POST["$sArg"];
}

/*
** 函数: SysGet
** 输入: $sArg,$sDefault
** 输出: object
** 描述: 返回Get变量
*/
function SysGet($sArg, $sDefault = '')
{
	if (is_array($_GET["$sArg"]))
	{
		if (count($_GET["$sArg"]) > 0)
		{
			foreach($_GET["$sArg"] as $key => $value)
			{
				if (empty($_GET["$sArg"][$key])) $_GET["$sArg"][$key] = $sDefault;
			}
		}
	}else
	if (empty($_GET["$sArg"]))
	{
		$_GET["$sArg"] = $sDefault;
	}
	return $_GET["$sArg"];
}

/*
** 函数: ActionReturnXml
** 输入: $iFlag, $sContent
** 输出: string
** 描述: 返回网页参数
*/
function ActionReturnXml($iFlag, $sContent)
{
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
	header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT"); 
	header("Cache-Control: no-cache, must-revalidate" ); 
	header("Pragma: no-cache" );
	header("Content-Type: text/xml");

	echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
	echo "<View>\n";
	echo "<Flag><![CDATA[". $iFlag . "]]></Flag>\n";
	echo "<Content><![CDATA[". $sContent ."]]></Content>\n";
	echo "</View>\n";
}
?>