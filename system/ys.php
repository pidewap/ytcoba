<?php

function grab($url){
ini_set("user_agent","Opera/9.80 (BlackBerry; Opera Mini/4.5.33868/37.7708; U; id) Presto/2.12.423 HMD Version/12.16");
$grab = @fopen($url, 'r');
$contents = "";
if ($grab) {
while (!feof($grab)) {
$contents.= fread($grab, 8192);
}
fclose($grab);
}
return $contents;
}


function format_time($time) {
$duration = new DateInterval($time); 
$videoDuration = (60 * 60 * $duration->h) + (60 * $duration->i) + $duration->s; return gmdate("H:i:s", $videoDuration);
}

function waktu($t,$f=':'){
return sprintf("%02d%s%02d%s%02d", floor($t/3600), $f, ($t/60)%60, $f, $t%60);
}


function max_deskrip($str) {
if (strlen($str) > 155)
$str = substr($str, 0, 155);
return $str;
}

function size($size){
$filesizename=array(" B"," KB"," MB"," GB");
return $size ? round($size/pow(1024,($i=floor(log($size,1024)))),2).$filesizename[$i] : 'MB';
}
function bytes($url){
$data=get_headers($url, true);
if (isset($data['Content-Length']))
return (int)$data['Content-Length'];
}

function scloud($id, $cid){
$grab=json_decode(grab('http://api.soundcloud.com/tracks/'.$id.'/streams?client_id='.$cid));
$linkhls=$grab->preview_mp3_128_url;
$linkhttp=$grab->http_mp3_128_url;
if (!empty($linkhttp)){
$link=$linkhttp;
} 
else {
$link=$linkhls;
}
return $link;
}

function pencarian($keyword){
$error = Array (
'%7E' => '','%60' => '','%21' => '','%40' => '','%23' => '','%24' => '','%25' => '','%5E' => '','%26' => '','%2A' => '','%28' => '','%29' => '','_' => '','-' => '','%2B' => '','%3D' => '','%7B' => '','%5B' => '','%7D' => '','%5D' => '','%7C' => '','%22' => '','%3A' => '','%3B' => '','%3F' => '','%2F' => '','%3E' => '','.' => '','%3C' => '','%2C' => '','%5C' => '','%27' => '','+' => '-',
);
if($keyword){
$urlq = urlencode($keyword);
$data = ''.$urlq.'';
$string = str_replace(array_keys($error), $error, $data);
$del = strtolower(str_replace('--', '', $string));
if($del){
header("location: /$del.html");
} else {
header("location: /error.html");
}
}

}


function to_array($s,$d =','){
$vals = explode($d,$s);
foreach($vals as $key => $val){
$vals[$key] = trim($val);
}
return array_diff($vals, array(''));
}

function random($array){
$api_array = to_array($array);
return $api_array[rand(0, (count($api_array)-1))];
}

function clean_a($keyword){
$error = Array (
'?' => '',"'" => '"',
);
$data = ''.$keyword.'';
return str_replace(array_keys($error), $error, $data);
}


function logout($id_type) {
unset($_SESSION[$id_type]);
$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
header("Location: $url");
}


function authorize($id_type) {
if (!isset($_SESSION[$id_type])) {
if (!isset($_POST['username'])) {
include('include/login.php');
exit();
} else {
include('config/admin.php');
if (($admin['password'] !== $_POST['password']) or ($admin['user'] !== $_POST['username'])) {
$loginerror = "Wrong username or password!";
include('include/login.php');
exit();
} else {
$_SESSION['login-ys-2016'] = $admin['user'];
}
}
}
}


function update_config($post, $cg) {
$config_str = "<?php\r\n\$".$cg['type']." = array();\r\n";
foreach($cg as $key=>$val) {
$new_val = false;
(isset($post[$key]))
? $new_val = $post[$key]
: $new_val = $cg[$key];
$config_str .= "\$".$cg['type']."['".$key."'] = '".clean_a($new_val)."'; \r\n";
}
$config_str .= "?>";
$fp = @fopen('config/'.$cg['type'].'.php', 'w');
if ($fp) {
fwrite($fp, $config_str, strlen($config_str));
return true;
} else {
return false;
}
}





?>
