<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title><?php echo $title;?></title><?php echo $deskripsi;?><?php echo $config['headtag'];?>
<link rel="shortcut icon" href="https://assets-cdn.github.com/favicon.ico">
<link href="/mobile.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="material">
<?php if($q){ echo '<h1>'.$title.'</h1>'; } else {echo '<h1>'.$title.'</h1>';} ?>
<div style="margin-left: 20px;margin-right: 20px;margin-top: 3px;border-bottom: 1px solid #EEE;"></div>
<div style="padding: 10px;margin:10px;">
<div id='search-box'>
<form action="/search.php" id="autoform">
<input class="dap_text_box" type="text" name="s" placeholder="Search Music, Video, Movie" value="" id="autoinput">
<input class="dap_button" type="submit" value="Search">
</form>
</div>
</div>
</div>
