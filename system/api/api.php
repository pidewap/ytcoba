<?php
error_reporting(0);
header('Content-Type: application/json');
if($_GET['2']){
$homepage = file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/system/api/base2.php?id='.$_GET["id"].'');
$x = Array (
",}" => "}",
"url" => "permalink",
"; codecs=mp4v.20.3, mp4a.40.2" => "",
"; codecs=avc1.42001E, mp4a.40.2" => "",
"; codecs=vp8.0, vorbis" => "",
"; codecs=avc1.64001F, mp4a.40.2" => "",
"; codecs=avc1.4D001F, mp4a.40.2" => "",

);
$xx = "".$homepage."";
$xxx = str_replace(array_keys($x), $x, $xx);
echo $xxx;}
?>
