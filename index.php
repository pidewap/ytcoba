<?php
error_reporting(0);
include 'system/ys.php';
include 'system/config/config.php';
include 'system/config/ads.php';
include 'system/config/admin.php';


if ($admin['site'] == 'ON') {
// =================================


$q = strip_tags($_GET['q']);

if($q){
/*
#+#
*/
$title = ''.ucwords(str_replace('-',' ',$q)).' - '.$config['title'].'';
$keyword = ucwords(str_replace('-','+',$q));

include 'system/include/_header.php';
echo '<div class="material">
<div class="box" style="font-style: italic;">
<span typeof="v:Breadcrumb"><a property="v:title" rel="v:url" href="/">Audio & Video</a></span> / '.$title.'</div>
<div class="box" style="background:#cfc; color:#060; padding:10px;">WAPINI !! is an Audio & Video Search Engine. Our system now displays the results of '.$title.', use keywords that are easy to understand.
</div>';
include 'ads/baner.php';
echo '<div class="title">Show Result :</div><ul class="video-list">';

/*
Audio
*/
$audio = json_decode(grab('http://api.soundcloud.com/tracks.json?q='.urlencode($keyword).'&limit='.$config['total'].'&offset=1&client_id='.random($config['audio']).''), true);

if($audio[0][title]){
foreach($audio as $soundcloud){
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
include 'system/ads/baner.php';
} else {
echo '
<li class="media">Audio File Not Found</li>
';
}



/*
Video
*/
$video = json_decode(grab('https://www.googleapis.com/youtube/v3/search?key='.random($config['video']).'&part=snippet&order=relevance&maxResults='.$config['total'].'&q='.urlencode($keyword).'&type=video'), true);
if($video[items]) {
foreach ($video[items] as $youtube) {
$videoid = $youtube[id][videoId];
$videotitle = $youtube[snippet][title];
$getduration = json_decode(grab('https://www.googleapis.com/youtube/v3/videos?key='.random($config['video']).'&part=contentDetails,statistics&id='.$videoid.''), true);
foreach ($getduration[items] as $youtube){
$videoduration = format_time($youtube[contentDetails][duration]); 
}
echo '
<li class="media">
<div class="media__img" style="display: block; width: 120px; height: 66px; overflow:hidden"><img src="http://ytimg.googleusercontent.com/vi/'.$videoid.'/default.jpg" alt="Thumb" class="img-mid" style="margin-top:-12px; " height="auto" width="120"></div>
<div class="media__body">
<a target="_BLANK" href="/video/'.$videoid.'.html">'.$videotitle.'</a>
<p>Source: YouTube | Time: '.$videoduration.' | Type: Video</p>
</div>
</li>
';
}
} else {
echo '
<li class="media">Video File Not Found</li>
';
}

echo '</ul></div>';
/*
#-#
*/
} else {
$title = ''.$config['title'].' - '.$config['tagline'].'';
$deskripsi = '<meta name="description" content="'.$config['description'].'" />';
include 'system/include/_header.php';
echo '<div class="material"><div class="title">Popular Videos</div>';
include 'system/ads/baner.php';
echo '<ul class="video-list">';
$video = json_decode(grab('https://www.googleapis.com/youtube/v3/search?key='.random($config['video']).'&part=snippet&order=relevance&maxResults='.$config['random'].'&q='.urlencode(random($config['randomsearch'])).'&type=video'), true);
if($video[items]) {
foreach ($video[items] as $youtube) {
$videoid = $youtube[id][videoId];
$videotitle = $youtube[snippet][title];
$getduration = json_decode(grab('https://www.googleapis.com/youtube/v3/videos?key='.random($config['video']).'&part=contentDetails,statistics&id='.$videoid.''), true);
foreach ($getduration[items] as $youtube){
$videoduration = format_time($youtube[contentDetails][duration]); 
}
echo '
<li class="media">
<div class="media__img" style="display: block; width: 120px; height: 66px; overflow:hidden"><img src="http://ytimg.googleusercontent.com/vi/'.$videoid.'/default.jpg" alt="Thumb" class="img-mid" style="margin-top:-12px; " height="auto" width="120"></div>
<div class="media__body">
<a target="_BLANK" href="/video/'.$videoid.'.html">'.$videotitle.'</a>
<p>Source: YouTube | Time: '.$videoduration.' | Type: Video</p>
</div>
</li>
';
}
}
echo '</ul></div>';
}
/*
#+#
*/

include 'system/include/_footer.php';

// =================================
} else { 
header('Location: /system');
exit;
}
