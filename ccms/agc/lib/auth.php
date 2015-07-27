<?php

define('GLOBAL_UN_LOCK', '');
require_once('../conf/conf.inc.php');

//生成验证码图片
@Header('Content-type: image/PNG');
$width = 52;
$height = 20;
$authNum = rand(1000, 9999);

$session = New Session();
$session -> SetSession('GLOBAL_SESSION_AUTH_NUMBER', $authNum);

$img = imagecreate($width, $height);
$black = ImageColorAllocate($img, 0, 0, 0);
$white = ImageColorAllocate($img, 255, 255, 255);
$gray = ImageColorAllocate($img, 240, 240, 240);
imagefill($img, 1, 1, $gray);

//将四位整数验证码绘入图片
imagestring($img, 5, 9, 2, $authNum, $black);

for($i=0; $i<($width - 8); $i++)   //加入干扰象素
{
	imagesetpixel($img, rand()%70 , rand()%70 , $black);
}

ImagePNG($img);
ImageDestroy($img);

?>
