<?php
session_start();
define("N", TRUE);

?>
<!doctype html>
<html>
<head>
<title>数据分析</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<link rel="stylesheet" href="css/index.css" />
</head>
<body>
<?php
	require_once "header.php";
?>
<div id = "analyze" style = "text-align:center;">
<h2 style = "text-align:center;" class = "title">男女比例分析(男绿/女红)</h2>
<img src = "pie.php" />
</div>

<?php
	require_once "footer.php";
?>
</body>
</html>

