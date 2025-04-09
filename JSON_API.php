<?php

/*
 Mixed Playlist Generators by Folder
 Filename: JSON_API.php
 GET: JSON_API.php
 Description: JSON API Structure For Playlisted Players/Data
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
// Get base URL
$base_URL = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/";
//echo $base_URL;

// DATA - VITI - ORA
$data1 = date("l d/m/Y - H:i:s");
$data2 = date("l, d F Y - H:i:s");
$data3 = date("d F Y");
$viti = date("Y");
$time = date("H:i:s");

/* SETTINGS */
$Playlist_Name = "Playlist"; // PLAYLIST NAME
define("MP3_PATH", "./Streaming_Data/"); // MP3 PATH
$streams_path = "Streaming_Data/";    // MP3 PATH
define("STREAMING_DIR", $base_URL. $streams_path);
// add your format here with |extension1|extension2 etc
define("PLAYLIST_FILE_FORMATS", "/\.(mp3|ogg|flac|m4a|mp4|asx|m3u|m3u8|pls)$/");
define("IF_IS_URL", preg_match("/:\/\//", STREAMING_DIR));
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* FUNCTIONS */
function mime_type($url) {

    if (strpos($url, ".mp4") > 0) {
        return "video/mp4";

    } elseif (strpos($url, ".m3u8") > 0) {
        return "application/x-mpegurl"; // OSE application/vnd.apple.mpegurl

} elseif (strpos($url, "mpegts") > 0) {
        return "video/mp4";


    } elseif (strpos($url, ".ts") > 0) {
        return "video/MP2T";

    } elseif (strpos($url, ".mpd") > 0) {
        return "application/dash+xml";

    } elseif (strpos($url, ".wav") > 0) {
        return "audio/wav";

    } elseif (strpos($url, ".aac") > 0) {
        return "audio/aac";

    } elseif (strpos($url, ".avi") > 0) {
        return "video/x-msvideo";

    } elseif (strpos($url, ".m4v") > 0) {
        return "video/x-m4v";

    } elseif (strpos($url, ".m4u") > 0) {
        return "video/vnd.mpegurl";

    } elseif (strpos($url, ".mkv") > 0) {
        return "video/x-matroska";

    } elseif (strpos($url, ".asf") > 0) {
        return "video/x-ms-asf";

    } elseif (strpos($url, ".asx") > 0) {
        return "video/x-ms-asf";

    } elseif (strpos($url, ".mpeg") > 0) {
        return "video/mpeg";

    } elseif (strpos($url, ".mpg") > 0) {
        return "video/mpeg";

    } elseif (strpos($url, ".mpe") > 0) {
        return "video/mpeg";

    } elseif (strpos($url, ".mpga") > 0) {
        return "audio/mpeg";

    } elseif (strpos($url, ".mpga") > 0) {
        return "mp2/mpeg";

    } elseif (strpos($url, ".qt") > 0) {
        return "video/quicktime";

    } elseif (strpos($url, ".mov") > 0) {
        return "video/quicktime";

    } elseif (strpos($url, ".movie") > 0) {
        return "video/x-sgi-movie";

    } elseif (strpos($url, ".mp3") > 0) {
        return "audio/mpeg";

    } elseif (strpos($url, ".mid") > 0) {
        return "audio/midi";

    } elseif (strpos($url, ".midi") > 0) {
        return "audio/midi";

    } elseif (strpos($url, ".aif") > 0) {
        return "audio/x-aiff";

    } elseif (strpos($url, ".aiff") > 0) {
        return "audio/x-aiff";

    } elseif (strpos($url, ".aifc") > 0) {
        return "audio/x-aiff";

    } elseif (strpos($url, ".ram") > 0) {
        return "audio/x-pn-realaudio";

    } elseif (strpos($url, ".rm") > 0) {
        return "audio/x-pn-realaudio";

    } elseif (strpos($url, ".rpm") > 0) {
        return "audio/x-pn-realaudio-plugin";

    } elseif (strpos($url, ".ra") > 0) {
        return "audio/x-realaudio";

    } elseif (strpos($url, ".rv") > 0) {
        return "video/vnd.rn-realvideo";

    } elseif (strpos($url, ".weba") > 0) {
        return "audio/webm";

    } elseif (strpos($url, ".swf") > 0) {
        return "application/x-shockwave-flash";

    } elseif (strpos($url, ".3gp") > 0) {
        return "video/3gpp";

    } elseif (strpos($url, ".3g2") > 0) {
        return "video/3gpp2";

    } elseif (strpos($url, ".oga") > 0) {
        return "video/ogg";

    } elseif (strpos($url, ".ogx") > 0) {
        return "application/ogg";

    } elseif (strpos($url, ".stream") > 0) {
        return "audio/mpeg";

    } elseif (strpos($url, "stream") > 0) {
        return "audio/mpeg";

    } elseif (strpos($url, ".json") > 0) {
        return "application/json";

    } elseif (strpos($url, ".rsd") > 0) {
        return "application/rsd+xml";

    } elseif (strpos($url, ".rss") > 0) {
        return "application/rss+xml";

    } elseif (strpos($url, ".m2a") > 0) {
        return "audio/mpeg";

    } elseif (strpos($url, ".m3a") > 0) {
        return "audio/mpeg";

    } elseif (strpos($url, ".mp2") > 0) {
        return "audio/mpeg";

    } elseif (strpos($url, ".mp2a") > 0) {
        return "audio/mpeg";

    } elseif (strpos($url, ".mpga") > 0) {
        return "audio/mpeg";

    } elseif (strpos($url, ".flac") > 0) {
        return "audio/flac";

    } elseif (strpos($url, ".mp4a") > 0) {
        return "audio/mp4";

    } elseif (strpos($url, ".webm") > 0) {
        return "video/webm";

    } else {
        return "application/octet-stream";
		// return "unknown";
    }
    }

function get_files($dir, &$get_files = array()) {
  $handle = opendir($dir);
  while ($item = readdir($handle)) {
    if ($item == '.' or $item == '..')
      continue;
    $MP3_PATH = $dir.'/'.$item;
    if (is_dir($MP3_PATH))
      get_files($MP3_PATH, $get_files);
    else
      $get_files[] = $MP3_PATH;
  }
  closedir($handle);
  return $get_files;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$i = 0;
$get_files = get_files(MP3_PATH);
natcasesort($get_files);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
$ids = 1;
foreach ($get_files as $item) {
  if (!preg_match(PLAYLIST_FILE_FORMATS, $item))
    continue;
  ++$i;

//$title = array_pop(explode('/', $item)); // old

$explode = explode('/', $item);
$title = end($explode);

$title = preg_replace(PLAYLIST_FILE_FORMATS, '', $title);

$stream_url = substr($item, strlen(MP3_PATH) + 1); // TAKE OFF THE TOP PATH
$stream_url = IF_IS_URL ? STREAMING_DIR . str_replace('%2F', '/', rawurlencode($stream_url)) : STREAMING_DIR . $stream_url;
// Print Data

// $i,$title //WITH NUMERIC example: 1,Axel Rudi Pell - Come Back to Me 1 2 3 ETC

$json_data [] = array(
	"id" => $ids++,
	"title" => (trim(($title))),
	"file" => $stream_url,
	"description" => (trim(($title))),
	"image" => "https://png.kodi.al/tv/albdroid/logo_bar.png",
    "type" => mime_type($stream_url),
	"label" => "HD",
	"date" => $data3,
	"time" => $time,

);
}

//echo str_replace('\\/', '/', json_encode($json_data,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

$json_datas = str_replace('\\/', '/', json_encode($json_data,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
echo $json_datas;