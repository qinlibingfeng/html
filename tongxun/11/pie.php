<?php
require_once "conn.php";
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');

$sql = "select csex, count(csex) c from contract group by csex order by csex";
$rs = mysql_query($sql);
$f = mysql_fetch_assoc($rs);
$m = mysql_fetch_assoc($rs);
$data = array($f['c'], $m['c']);

// Create the Pie Graph. 
$graph = new PieGraph(350,250);

$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// Set A title for the plot
//$graph->title->Set(iconv("UTF-8", "gb2312", "男女比例分析"));
$graph->SetBox(true);

// Create
$p1 = new PiePlot($data);
$graph->Add($p1);

$p1->ShowBorder();
$p1->SetColor('black');
$p1->SetSliceColors(array('#F00','#0F0'));
$graph->Stroke();

?>
