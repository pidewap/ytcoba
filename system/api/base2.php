[<?php
error_reporting(0);
header('Content-Type: application/json');
if (!empty($_GET["id"])){
if (isset($_GET["id"]))
$id = $_GET["id"];
parse_str(file_get_contents('https://www.youtube.com/get_video_info?html5=1&video_id='.$id.'&asv=3&el=detailpage&hl=en_US'), $video_data);
$streams = $video_data['url_encoded_fmt_stream_map'];
$streams = explode(',',$streams);
$counter = 1;
foreach ($streams as $streamdata) {
printf("{", $counter);
parse_str($streamdata,$streamdata);
foreach ($streamdata as $key => $value) {
if ($key == "url") {
$value = urldecode($value);
printf('"url": "%s",',$value);
} else {
$value = str_replace('"','', $value);
printf('"%s": "%s",',$key, $value);
}
}
$counter = $counter+1;
printf("},");
}

//
}
else { echo 'error'; 
}
?>
{"source":"youtube"}]
