<?php
require_once 'detec.php';
$detect = new Mobile_Detect;
$check = $detect->isMobile();
if($check){
echo $ads['ads3'];
} else { 
echo $ads['ads1']; 
}
