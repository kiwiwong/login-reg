<?php
session_start();
Header("Content-type:image/PNG");
$im = imagecreate(60, 25);
$back = imagecolorallocate($im, 245, 245, 245);
imagefill($im, 0, 0, $back);
$vcodes = "";

for($i = 0; $i < 4; $i++){
    $font = imagecolorallocate($im, rand(100, 255), rand(0, 100), rand(100, 255));
    $authnum = rand(0, 9);
    $vcodes .= $authnum;
    imagestring($im, 5, 9 + $i * 10, 5, $authnum, $font);
}
$_SESSION['VCODE'] = $vcodes;
for($i=0;$i<200;$i++) {
    $randcolor = imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255));
    imagesetpixel($im, rand()%60, rand()%25, $randcolor); 
}
imagepng($im);
imagedestroy($im);
?>