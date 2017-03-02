<?php
require_once 'detec.php';
include '../config/ads.php';
$detect = new Mobile_Detect;
$check = $detect->isAndroidOS();
if($check){
header('Location: '.$ads['la'].'');
exit;
} else {
header('Location: '.$ads['lo'].'');
exit;
}

