<?php
require_once 'detec.php';
$detect = new Mobile_Detect;
$check = $detect->isMobile();
if($check){
echo $ads['ads2'];
} else { 
echo $ads['ads1']; 
}
