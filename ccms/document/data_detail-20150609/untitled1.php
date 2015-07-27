<?php
$Date_1=date("Y-m-d");
$Date_2="2014-02-12";
$d1=strtotime($Date_1);
$d2=strtotime($Date_2);
$Days=round(($d1-$d2)/86400);
Echo   "".$Days."";
Echo "<br>";
?>