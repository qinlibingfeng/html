<?
	#http://152.104.157.50/voicemail/zip.php?datedir=?&filename=?

	$GlobePath	= "/var/spool/asterisk/monitor/EF/";
	$DateFir = $datedir;
	$FileName = $filename;
	$FinalFile = $GlobePath.$DateFir.'/'.$FileName;
	
	if( is_file($FinalFile) ) {
		$FileSize = filesize($FinalFile);
		if( $FileSize > 1048576 ) {
			$FileSize = Ceil($FileSize/1048576)/2;
			echo "Compress would be completed after $FileSize Sec.<br>";
		} else {
			echo "Compress would be completed <1 Sec.<br>";
		}
		$Mp3File = $FinalFile.".mp3";
		$cmdline = "/usr/local/bin/lame -b 32 -h $FinalFile $Mp3File";
		system(EscapeShellCmd($cmdline));
		echo "<br>Download:<a href=\"http://".$SERVER_ADDR."/monitor/".$DateFir."/".$FileName.".mp3\">".$FileName.".mp3</a>";
	} else {
		echo "<font size=2>Error:录音文件不存在</font>";
	}
?>
