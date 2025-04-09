<?php

/*
 Mixed Playlist Generators by Folder
 Filename: VLC_Playlist.php
 GET: VLC_Playlist.php
 Description: VLC Playlist Structure
 Author: TRC4@USA.COM
 Created Date: 06 Mar 2020
 Modified Date: 09 April 2025
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
//header('Content-type: audio/x-mpegurl');
echo("#EXTM3U (Playlist Generated on $data2)\n\n");
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
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
//echo "#EXTINF:$i,$title\n$stream_url\n";
// $stream = "#EXTINF:$i,$title\n$stream_url\n"; // WITH NUMERIC ON EXTINF 1 2 3 ETC
$stream = "#EXTINF:-1,$title\n$stream_url\n";
echo "$stream\n";
}
?>
