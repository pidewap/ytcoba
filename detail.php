<?php
error_reporting(0);
include 'system/ys.php';
include 'system/config/config.php';
include 'system/config/ads.php';
include 'system/config/admin.php';


if ($admin['site'] == 'ON') {
// =================================

/* 
Audio
*/
if($_GET['sc']){
$audio = json_decode(grab('http://api.soundcloud.com/tracks/'.$_GET['sc'].'.json?client_id='.random($config['audio']).''), true);
$audiotitle = strip_tags($audio[title]);
$title = '[Audio] '.$audiotitle.' - '.$config['title'].'';
$audiosize = size(bytes(scloud($_GET['sc'], random($config['audio']))));
$audioduration = waktu($audio[duration]/1000);
$audiocreated_at = $audio[created_at];
$audiousername = $audio[user][username];
if($audio[artwork_url]){
$thumb = $audio[artwork_url];
} else {
$thumb = 'http://'.$_SERVER['HTTP_HOST'].'/no-image.png';
}
if($audiotitle) {
include 'system/include/_header.php';
echo '
<div class="material">
<div class="box" style="font-style: italic;"><span typeof="v:Breadcrumb"><a property="v:title" rel="v:url" href="/">Audio</a></span> / '.$audiotitle.'</div>
<div class="title">Audio Info.</div>
';
include 'system/ads/baner.php';
echo '
<div class="box">
<img src="'.$thumb.'"/></div>
';
include 'system/ads/baner2.php';
echo '
<div class="box"><table style="background: none repeat scroll 0px 0px #FFF;
display: block;padding: 3px 3px;" width="100%">
<tbody><tr><td class="pst">Title</td> 
<td class="pst" style="width: 5%; text-align: center">:</td>
<td class="pst"> '.$audiotitle.'</td> </tr>
<tr><td class="pst">Duration</td> 
<td class="pst" style="width: 5%; text-align: center">:</td>
<td class="pst"> '.$audioduration.'</td> </tr>
<tr><td class="pst">Author</td> 
<td class="pst" style="width: 5%; text-align: center">:</td>
<td class="pst"> '.$audiousername.'</td> </tr>
<tr><td class="pst">Date</td> 
<td class="pst" style="width: 5%; text-align: center">:</td>
<td class="pst"> '.$audiocreated_at.'</td> </tr>
</tbody></table></div>';  	
include 'system/ads/text.php';
include 'system/ads/baner.php';
echo '
<div class="title">↓ Download </div>
';
include 'system/ads/baner2.php';
echo '
<div class="box"> 
<div style="margin-bottom:5px; padding-bottom:2px ; border-bottom:1px solid #EEE;">
<a target="_BLANK" href="'.scloud($_GET['sc'], random($config['audio'])).'" rel="nofollow">audio/mp3</a> ('.$audiosize.')</div></div></div>
';
} else {
$title = 'File Not Found';
include 'system/include/_header.php';
echo '
<div class="material">
<div class="box"><font color="red">File Not Found !</font></div>
</div>
';
}
/*
related
*/
if ($config['related'] == 'true') {
//
$related = json_decode(grab('http://api.soundcloud.com/tracks.json?q='.urlencode($audiotitle).'&limit=5&offset=1&client_id='.random($config['audio']).''), true);
if($related[0][title]){
echo '<div class="material"><div class="title">Related</div>';
include 'system/ads/baner.php';
echo '<ul class="video-list">';
foreach($related as $soundcloud){
$audioid = $soundcloud[id];
$audiotitle = strip_tags($soundcloud[title]);
$audioduration = waktu($soundcloud[duration]/1000);
if($soundcloud[artwork_url]){
$thumb = $soundcloud[artwork_url];
} else {
$thumb = 'http://'.$_SERVER['HTTP_HOST'].'/no-image.png';
}
echo '
<li class="media">
<div class="media__img" style="display: block; width: 120px; height: 66px; overflow:hidden"><img src="'.$thumb.'" alt="Thumb" class="img-mid" style="margin-top:-12px; " height="auto" width="120"></div>
<div class="media__body">
<a target="_BLANK" href="/audio/'.$audioid.'.html">'.$audiotitle.'</a>
<p>Source: Soundcloud | Time: '.$audioduration.' | Type: Audio</p>
</div>
</li>
';
}
echo '</ul></div>';
} 
//
}
/*
#
*/
}

/* 
Video
*/
if ($_GET['yt']){
$api2 = json_decode(grab('http://'.$_SERVER['HTTP_HOST'].'/system/api/api.php?2=2&id='.$_GET['yt'].''), true);
$video = json_decode(grab('https://www.googleapis.com/youtube/v3/videos?key='.random($config['video']).'&part=snippet,contentDetails,statistics,topicDetails&id='.$_GET['yt']), true);


if($video[items]) {
foreach ($video[items] as $youtube) {
$videotitle = $youtube[snippet][title];
$title = '[Video] '.$videotitle.' - '.$config['title'].'';
$videodate = $youtube[snippet][publishedAt];
$videochanel = $youtube[snippet][channelTitle];
$videoduration = format_time($youtube[contentDetails][duration]);
include 'system/include/_header.php';
echo '
<div class="material">   
<div class="box" style="font-style: italic;"><span typeof="v:Breadcrumb"><a property="v:title" rel="v:url" href="/">Video</a></span> / '.$videotitle.'</div>
<div class="title">Video Info.</div>
';
include 'system/ads/baner.php';
echo '
<div class="box">
<img src="https://i.ytimg.com/vi/'.$_GET['yt'].'/mqdefault.jpg"/></div>
';
include 'system/ads/baner2.php';
echo '
<div class="box">
<table style="background: none repeat scroll 0px 0px #FFF;
display: block;padding: 3px 3px;" width="100%">
<tbody><tr><td class="pst">Title</td> 
<td class="pst" style="width: 5%; text-align: center">:</td>
<td class="pst"> '.$videotitle.'</td> </tr>
<tr><td class="pst">Duration</td> 
<td class="pst" style="width: 5%; text-align: center">:</td>
<td class="pst"> '.$videoduration.'</td> </tr>
<tr><td class="pst">Author</td> 
<td class="pst" style="width: 5%; text-align: center">:</td>
<td class="pst"> '.$videochanel.'</td> </tr>
<tr><td class="pst">Publised</td> 
<td class="pst" style="width: 5%; text-align: center">:</td>
<td class="pst"> '.$videodate.'</td> </tr>
</tbody></table></div>';
include 'system/ads/text.php';
include 'system/ads/baner.php';
echo '
<div class="title">↓ Download </div>
';
include 'system/ads/baner2.php';
echo '
<div class="box">
';
}
/*
Cek Link
Lo Bisa ganti atau menambahkan scrip
Biar bisa diseting lewat admin panel
*/
if($api2[0][s]){
if ($config['signature'] == 'true') {
$as = json_decode(grab('http://'.$_SERVER['HTTP_HOST'].'/system/api/signature.php?id='.$_GET['yt'].'&s='.$api2[0][s]), true);
$dsig = $as[decodedSignature];
if($as[decodedSignature]){
foreach($api2 as $query){
$permalink = $query[permalink];
$type = $query[type];
$signatur = $query[s];
$as = json_decode(grab('http://'.$_SERVER['HTTP_HOST'].'/system/api/signature.php?id='.$_GET['yt'].'&s='.$signatur), true);
$dsig = $as[decodedSignature];
$perlink = ''.$permalink.'&signature='.$dsig.'&title='.$title.'';
$pe = ''.$permalink.'&signature='.$dsig.'';
$directlink = explode('.googlevideo.com/',$perlink);
$directlink = 'https://redirector.googlevideo.com/' . $directlink[1] . '';
$clean = '<div style="margin-bottom:5px; padding-bottom:2px ; border-bottom:1px solid #EEE;"><a target="_BLANK" href="'.$directlink.'" rel="nofollow">'.$type.'</a> ('.size(bytes($pe)).')</div> ';
$download = str_replace('<div style="margin-bottom:5px; padding-bottom:2px ; border-bottom:1px solid #EEE;"><a target="_BLANK" href="'.$directlink.'" rel="nofollow"></a> ('.size(bytes($pe)).')</div>','',$clean);
echo $download;
}
} else { 
echo '
<br /><font color="red">Video File Not Found. #1</font>
';
}
/*
#
*/
} else { 
echo '
<br /><font color="red">Disable</font>
';
}
//
} else if ($api2[0][permalink]){
foreach($api2 as $query){
$permalink = $query[permalink];
$type = $query[type];
$directlink = explode('.googlevideo.com/',$permalink);
$directlink = 'https://redirector.googlevideo.com/' . $directlink[1] . '';
$clean = '<div style="margin-bottom:5px; padding-bottom:2px ; border-bottom:1px solid #EEE;"><a target="_BLANK" href="'.$directlink.'&title='.$title.'" rel="nofollow">'.$type.'</a> ('.size(bytes($permalink)).')</div> ';
$download = str_replace('<div style="margin-bottom:5px; padding-bottom:2px ; border-bottom:1px solid #EEE;"><a target="_BLANK" href="'.$directlink.'&title='.$title.'" rel="nofollow"></a> ('.size(bytes($permalink)).')</div>','',$clean);
echo $download;
}

} else {
echo '
<br /><font color="red">Video File Not Found. #2</font>
';
} 
echo '</div></div>';
} 
/*
else video
*/
else {
$title = 'File Not Found !';
include 'system/include/_header.php';
echo '<div class="material"><div class="box"><font color="red">File Not Found !</font></div></div>';
}

/*
related
*/
if ($config['related'] == 'true') {
//
$related = json_decode(grab('https://www.googleapis.com/youtube/v3/search?key='.random($config['video']).'&part=snippet&maxResults=5&relatedToVideoId='.$_GET['yt'].'&type=video'), true);
if($related) {
echo '<div class="material"><div class="title">Related Videos</div>';
include 'system/ads/baner.php';
echo '<ul class="video-list">';
foreach($related[items] as $video) 
{
$videotitle = $video[snippet][title];
$videoid = $video[id][videoId];
$getdur = json_decode(grab('https://www.googleapis.com/youtube/v3/videos?key='.random($config['video']).'&part=contentDetails,statistics&id='.$videoid.''), true);
foreach ($getdur[items] as $videodetail){
$videoduration = format_time($videodetail[contentDetails][duration]);
}
echo '
<li class="media">
<div class="media__img" style="display: block; width: 120px; height: 66px; overflow:hidden"><img src="http://ytimg.googleusercontent.com/vi/'.$videoid.'/default.jpg" alt="Thumb" class="img-mid" style="margin-top:-12px; " height="auto" width="120"></div>
<div class="media__body">
<a target="_BLANK" href="/video/'.$videoid.'.html">'.$videotitle.'</a>
<p>Source: YouTube | Time: '.$videoduration.' | Type: Video</p>
</div>
</li>';
}
echo '</ul></div>';
}
//
}
/*
#
*/
}

include 'system/include/_footer.php';

// =================================
} else { 
header('Location: /system');
exit;
}
?>
