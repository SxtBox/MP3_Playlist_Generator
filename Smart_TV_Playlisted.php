<?php

/*
 Mixed Playlist Generators by Folder
 Filename: Smart_TV_Playlisted.php
 Required JSON_API.php
 GET: Smart_TV_Playlisted.php
 Description: Smart TV Playlist Structure
 Author: TRC4@USA.COM
 Created Date: 09 April 2025
*/

error_reporting(0);
set_time_limit(0);
date_default_timezone_set("Europe/Tirane");

if (empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] === "off") {
  $protocol = "http://";
} else {
  $protocol = "https://";
}

$ROOT_URL = $protocol . $_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]) . "/";
$PHP_PATH = $protocol . ($_SERVER["SERVER_NAME"]) . ($_SERVER["PHP_SELF"]) . "";

$json_api_path = $protocol . $_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]) . "/JSON_API.php";

function get_data ($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

$Stream_Provider = "Albdroid";
$Stream_Type = "PHP Code";
$Stream_Types = " Albania";

// GET DATA
$json_url = get_data($json_api_path);
$json = json_decode($json_url);

echo("#EXTM3U #{$Stream_Provider} {$Stream_Type}".PHP_EOL.PHP_EOL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

foreach ($json as $item){
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
    array("- #"),
    array(""),
    $title
);

$tvgid = "Hosted by Albdroid";
$tvg_id = ('tvg-id="'. $id .'"');

$tvg_names = "Hosted by Albdroid";
$tvg_name = ('tvg-name="'. $tvg_names .'"');

$my_Own_Logo = "Set your Own Logo Here";
//$tvg_logo = ('tvg-logo="'. $my_Own_Logo .'"'); // Set your Own Logo
$tvg_logo = ('tvg-logo="'. $thumbnail.'"');

$grouptitle = "$Stream_Provider $Stream_Type";
$group_title = ('group-title="'. $grouptitle .$Stream_Types .'"');

echo "#EXTINF:-1 {$tvg_id} {$tvg_name} {$tvg_logo} {$group_title},{$title}".PHP_EOL;
echo $stream .PHP_EOL;
}
?>