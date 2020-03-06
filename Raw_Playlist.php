<?php
date_default_timezone_set("Europe/Tirane");
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// SITE ROOT DIR
// GET HOST http://localhost/ FOLDER PATH /
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
  $protocol = 'http://';
} else {
  $protocol = 'https://';
}
// Get base URL
$SITE_ROOT = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/";
//echo $SITE_ROOT;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
define("USER_AGENT",  $_SERVER['HTTP_USER_AGENT']); 
define("ROOT_PATH", dirname($_SERVER["SCRIPT_FILENAME"]) . '/');// C:/DESTINATION PATH
define("WEBPATH", 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . '/'); // FULL HTTP PATH
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//$dirpath = dirname($_SERVER["SCRIPT_FILENAME"]) . '/';
//$webpath = 'http://' . $_SERVER['SERVER_NAME'] .  dirname($_SERVER['PHP_SELF']) . '/';
// SITE ROOT DIR
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// DATA - VITI - ORA
$data1 = date("l d/m/Y - H:i:s");
$data2 = date("l, d F Y - H:i:s");
$data3 = date("d F Y");
$viti = date("Y");
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* SETTINGS */
$STREAM_NAME = "Playlist"; // PLAYLIST NAME
define('MP3_PATH', './Mixed_News/'); // MP3 PATH
$MUSIC_PATH = "Mixed_News/";    // MP3 PATH
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ROOT PATH
define("MP3_MUSIC_PATH", $SITE_ROOT. $MUSIC_PATH);
//define('MP3_MUSIC_PATH', 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . '/MP3/');
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// EXAMPLES
// define('MP3_MUSIC_PATH', /YOUR PATH/);
// define('MP3_MUSIC_PATH', '/var/www/html/MP3/');
// define('MP3_MUSIC_PATH', 'http://'.$_SERVER['HTTP_HOST'].'/MP3/'); // LOCALHOST PATH http://localhost/MP3
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
define('PLAYLIST_FILE_FORMATS', '/\.(mp3|ogg|flac|m4a|mp4|asx)$/');
define('IF_IS_URL', preg_match('/:\/\//', MP3_MUSIC_PATH));
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
  $TITLE = array_pop(explode('/', $item));
  $TITLE = preg_replace(PLAYLIST_FILE_FORMATS, '', $TITLE);

  $URL = substr($item, strlen(MP3_PATH) + 1); // TAKE OFF THE TOP PATH
  $URL = IF_IS_URL ? MP3_MUSIC_PATH . str_replace('%2F', '/', rawurlencode($URL)) : MP3_MUSIC_PATH . $URL;
///////////////////////////////////////////////////////////////////////////////
//echo "#EXTINF:$i,$TITLE\n$URL\n";
// $STREAM = "#EXTINF:$i,$TITLE\n$URL\n"; // WITH NUMERIC ON EXTINF 1 2 3 ETC
$STREAM = "#EXTINF:-1,$TITLE\n$URL\n";
echo "$STREAM\n";
//header('Content-Disposition: attachment; filename="'.$STREAM_NAME.'.m3u"');
///////////////////////////////////////////////////////////////////////////////
}