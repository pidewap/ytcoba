<?php
header("Content-Type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$file = 'data/sitemap';
$file = file_get_contents($file);
$file = explode(urldecode('%0A'), $file);
foreach($file as $f){
$clean = '<url><loc>'.preg_replace("/\r\n|\r|\n/",'',$f).'</loc><changefreq>daily</changefreq><priority>0.5</priority></url>';
$sitemap = str_replace('<url><loc></loc><changefreq>daily</changefreq><priority>0.5</priority></url>','',$clean);
echo $sitemap;
}
echo '</urlset>';



