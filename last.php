<?php


$div = "|#|";
$dat='lastsearch.txt';

$fp=fopen($dat, 'r');
$count=fgets($fp);
fclose($fp);
if (!empty($_GET['page'])){
}
else if (!empty($_GET['q'])){
$cari = $_GET['q'];
}
else {
$cari = 'mulus';
}
$cari = str_replace('+', ' ', $cari);
$data = explode($div, $count);

if (in_array($cari, $data)) {
$tulis = implode($div, $data);
$hit=$tulis;
}
else {
$data = explode($div, $count);
$tulis = $data[1].''.$div.''.$data[2].''.$div.''.$data[3].''.$div.''.$data[4].''.$div.''.$data[5].''.$div.''.$data[6].''.$div.''.$data[7].''.$div.''.$data[8].''.$div.''.$data[9].''.$div.''.$data[10].''.$div.''.$data[11].''.$div.''.$data[12].''.$div.''.$data[13].''.$div.''.$data[14].''.$div.''.$data[15].''.$div.''.$data[16].''.$div.''.$data[17].''.$div.''.$data[18].''.$div.''.$data[19].''.$div.''.$data[20].''.$div.''.$data[21].''.$div;
$tulis .= $cari;
$hit=$tulis;
}


$masuk=fopen($dat, 'w');
fwrite($masuk,$tulis);
fclose($masuk);

$fa=fopen($dat, 'r');
$b=fgets($fa);
fclose($fa);

$c = explode($div, $b);
$e = str_replace(' ','-',$c);

foreach(array_reverse($e) as $d)
{
$data = '<a href="/'.$d.'.html" title="Download '.ucwords(str_replace('-',' ',$d)).'">'.ucwords(str_replace('-',' ',$d)).'</a>, '; 
$error = Array (
'<a href="/.html" title="Download "></a>,' => '',
'<a href="/-.html" title="Download  "> </a>,' => '',
);
$sama = ''.$data.'';
$hasil = str_replace(array_keys($error), $error, $sama);
$error2 = Array (
'-.html' => '.html',
);
$sama2 = ''.$hasil.'';
$fix = str_replace(array_keys($error2), $error2, $sama2);
echo $fix;
}

?>
