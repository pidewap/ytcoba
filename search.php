<?php
include 'system/ys.php';
$q = $_GET['s'];
if($q){
echo ''.pencarian($q).'';}else{
header("location: /");
}
