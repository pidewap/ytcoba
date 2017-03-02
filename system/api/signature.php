<?php
error_reporting(0);
include '../ys.php';
include '../config/config.php';
header('Content-Type: application/json');
$yid = $_GET['id'];
$sig = $_GET['s'];
$target = file_get_contents('https://www.youtube.com/watch?v='.$yid.'');
$potong = explode('\/\/s.ytimg.com\/yts\/jsbin\/player',$target);
$potong = explode('\/base.js',$potong[1]);
$js = $potong[0];
$decodesignature = file_get_contents('https://api.botch.io/api?signature='.$sig.'&token='.random($config['botch']).'&jsfile=http://s.ytimg.com/yts/jsbin/player'.$js.'/base.js');
echo $decodesignature;

