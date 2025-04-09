<?php

/*
 Mixed Playlist Generators by Folder
 Filename: Kodi_Playlisted.php
 Required JSON_API.php
 GET: Kodi_Playlisted.php
 Description: Kodi XML Playlist Structure
 Author: TRC4@USA.COM
 Created Date: 09 April 2025
*/

error_reporting(0);
set_time_limit(0);
date_default_timezone_set("Europe/Tirane");

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
  $protocol = 'http://';
} else {
  $protocol = 'https://';
}

$ROOT_URL = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/";
$PHP_PATH = $protocol . ($_SERVER['SERVER_NAME']) . ($_SERVER['PHP_SELF']) . "";

$json_api_path = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/JSON_API.php";

function get_data ($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

$json_url = get_data($json_api_path);

$Stream_Provider = "Albdroid";
$Stream_Type = "PHP Code";
$Stream_Types = " Albania";

// DATA - VITI - ORA
$zone = "Europe/Tirane";
$data1 = date("l d/m/Y - H:i:s");
$data2 = date("l, d F Y - H:i:s");
$data3 = date("d F Y");
$viti = date("Y");
// DATA - VITI - ORA

header("Content-Type: application/rss+xml; charset=utf-8");
$json = json_decode($json_url);
echo <<<HEA
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<channel>
<name>[COLOR lime][B]{$Stream_Provider} {$Stream_Type}[/B][/COLOR]</name>
<thumbnail>https://png.kodi.al/tv/albdroid/black.png</thumbnail>
<fanart>https://png.kodi.al/tv/albdroid/black.png</fanart>
<items_info> <!-- this is opitonal -->
<title>[COLOR lime][B][I]Albdroid[/I][/B][/COLOR][COLOR lime] [B][I][COLOR red]([/COLOR]{$Stream_Provider} {$Stream_Type}[COLOR red])[/I][/B][/COLOR]</title>
<genre>[COLOR lime][B][I]Albdroid[/I][/B][/COLOR][COLOR lime] [B][I][COLOR red]([/COLOR]{$Stream_Provider} {$Stream_Type}[COLOR red])[/I][/B][/COLOR]</genre>
<description>[COLOR blue][B]Author:[/COLOR] [COLOR lime][B]Olsion Bakiaj[/B][/COLOR][COLOR red] &amp;[/COLOR][COLOR lime][B] Endrit Pano[/B][/COLOR]</description>
<thumbnail>https://png.kodi.al/tv/albdroid/black.png</thumbnail>
<fanart>https://png.kodi.al/tv/albdroid/black.png</fanart>
<date>[COLOR lime][B]{$data3}[/B][/COLOR]</date>
<credits>[COLOR lime]BuBA[/B][/COLOR]</credits>
<year>[COLOR lime][B]{$viti}[/B][/COLOR]</year>
</items_info>\n\n
HEA;
foreach ($json as $item) {

$id = $item->id;
$title = $item->title;
$stream = $item->file;
$thumbnail = $item->image;
$description = $item->description;
$type = $item->type;
$label = $item->label;
$date = $item->date;
$time = $item->time;

$title = str_replace(
    array("- #", "&"),
    array("", "&amp;"),
    $title
);

$stream = str_replace(
    array("&"),
    array("&amp;"),
    $stream
);

echo "<item>\n";
echo "<title>[COLOR lime][B]".$title."[/COLOR][/B]</title>\n";
echo "<link>".$stream."</link>\n";
echo "<thumbnail>".$thumbnail."</thumbnail>\n";
echo "<fanart>".$thumbnail."</fanart>\n";
echo "<date>[COLOR lime][B]" . $date . "[/B][/COLOR]</date>\n";
echo "<genre>[COLOR lime][B][I]Albdroid[/I][/B][/COLOR][COLOR lime][B][I] [COLOR red]([/COLOR]".$title."[COLOR red])[/I][/B][/COLOR]</genre>\n";
echo "<info>[COLOR lime][B]Website:[/B][/COLOR] [COLOR red][B]([/B][/COLOR][COLOR lime][B]Albdroid.AL[/B][/COLOR] [COLOR red][B]&amp;[/B][/COLOR] [COLOR lime][B]Kodi.AL[/B][/COLOR][COLOR red][B])[/B][/COLOR]</info>\n";
echo "</item>\n\n";
}
echo "<SetViewMode>504</SetViewMode>\n\n";
echo "</channel>\n";
ob_end_flush();
?>