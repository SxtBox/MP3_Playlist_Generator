<?php

/*
 Mixed Playlist Generators by Folder
 Filename: Smart_TV_by_ID.php
 Required JSON_API.php
 GET: Smart_TV_by_ID.php?id=1 2 3 etc see ids from JSON_API
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

$get_id = isset($_GET["id"]) && !empty($_GET["id"]) ? $_GET["id"] : "1";

// GET DATA
$json_url = get_data($json_api_path);
$json = json_decode($json_url);
echo("#EXTM3U #{$Stream_Provider} {$Stream_Type}".PHP_EOL.PHP_EOL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

foreach ($json as $item){
if ($item->{"id"}==($get_id)) {
$id = $item->id;
$title = $item->title;
$stream = $item->file;
$thumbnail = $item->image;
$description = $item->description;
$mime_type = $item->type;
$poster = $item->image;
$logo = $item->image;
$label = $item->label;

$title = str_replace(
    array("- #"),
    array(""),
    $title
);

$tvgid = $id;
$tvg_id = ('tvg-id="'. $tvgid .'"');

$tvg_names = "Hosted by Albdroid";
$tvg_name = ('tvg-name="'. $tvg_names .'"');

$my_Own_Logo = "Set your Own Logo Here";
//$tvg_logo = ('tvg-logo="'. $my_Own_Logo .'"'); // Set your Own Logo
$tvg_logo = ('tvg-logo="'. $thumbnail.'"');

$grouptitle = "$Stream_Provider $Stream_Type";
$group_title = ('group-title="'. $grouptitle .$Stream_Types .'"');
echo "\r#EXTINF:-1 {$tvg_id} {$tvg_name} {$tvg_logo} {$group_title},{$title}".PHP_EOL;
echo $stream . PHP_EOL;
}
}
?>