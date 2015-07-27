<?php
	function CountVoiceMailNum($path) {
		$i = 0;
		if( is_dir($path) ) {
			$handle=opendir($path);
			while ($file = readdir($handle)) {
				if($file == '.') continue;
				if($file == '..') continue;
				if( eregi(".+txt$",$file) ) { 
					$pieces = explode('.',$file);
					$TA[$i] = $pieces[0];
					$i++;
				}
			}
			closedir($handle); 
			$tNum = sizeof($TA);
		} else $tNum = 0;
		return $tNum;
	}

	function VoiceMail($path,$begin,$end) {
		$i = 0;
		if( is_dir($path) ) {
			$handle=opendir($path);
			while ($file = readdir($handle)) {
				if($file == '.') continue;
				if($file == '..') continue;
				if( eregi(".+txt$",$file) ) {
					list($dev,$inode,$mode,$link,$uid,$gid,$blk,$size,$laststo,$lastmod,$lastc,$stsize,$block) = stat($path.$file);
					if( $lastmod>$begin && $lastmod<$end ){
						if($size>0) {
							$pieces = explode('.',$file);
							$TA[$i] = $pieces[0];
							$i++;
						}
					}
				}
			}
			closedir($handle); 
			$tNum = sizeof($TA);
			if( $tNum > 0 ) {
				sort($TA);
				$i = 0;
				while ( list( $key, $val ) = each( $TA ) ) {
					$txtfile = $path.$val.".txt";
					$myrow[$i]['wav'] = $val.".wav";
					$fd = fopen($txtfile, "r");
					while ($buffer = fgets($fd, 64)) {
						if( strstr($buffer,'callerid') ) {
							$exp = explode('=',$buffer);
							if( strstr($exp[1],'<') ) {
								eregi("[<][0-9]+[>]",$exp[1],$cmpfh);
								$myrow[$i]['caller'] = $cmpfh[0];
							} else {
								$myrow[$i]['caller'] = $exp[1];
							}
						}
						if( strstr($buffer,'origtime') ) {
							$exp = explode('=',$buffer);
							$myrow[$i]['ortime'] = $exp[1];
						}
					}
					fclose($fd);
					$i++;
				}
			}
		}
		return $myrow;
	}

	function Date2Str($TimeStamp){
		$date = getdate($TimeStamp);
		$ret[0] = $date['mon']."/".$date['mday']." ".$date['hours'].":".$date['minutes'];
		$d_mon = $date['mon'];
		if($d_mon<10) $d_mon = "0".$d_mon;
		$d_day = $date['mday'];
		if($d_day<10) $d_day = "0".$d_day;
		$d_hou = $date['hours'];
		if($d_hou<10) $d_hou = "0".$d_hou;
		$d_min = $date['minutes'];
		if($d_min<10) $d_min = "0".$d_min;
		$d_sec = $date['seconds'];
		if($d_sec<10) $d_sec = "0".$d_sec;

		$ret[1] = $date['year']."-".$d_mon."-".$d_day." ".$d_hou.":".$d_min.":".$d_sec;
		return $ret[1];
	}
	function getunixtime($d) {
		if(is_numeric($d))
			return $d;
		else {
			if(! is_string($d)) return 0;
			if(ereg(":",$d)) {
				$buf = split(" +",$d);
				$year = split("[-/]",$buf[0]);
				$hour = split(":",$buf[1]);
				if(eregi("pm",$buf[2]))
					$hour[0] += 12;
				return mktime($hour[0],$hour[1],$hour[2],$year[1],$year[2],$year[0]);
			}else {
				$year = split("[-/]",$d);
				return mktime(0,0,0,$year[1],$year[2],$year[0]);
			}
		}
	}
?>
