<?php

/*
 Mixed Playlist Generators by Folder
 Filename: JW_Player_Playlisted.php
 Required JSON_API.php
 GET: JW_Player_Playlisted.php
 Description: JW Playlisted Player
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
?>
<!doctype html>
<html>
<head>
<meta http-equiv="refresh" content="6200">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Albdroid Player</title>
<link rel="shortcut icon" href="https://kodi.al/panel.ico"/>
<link rel="icon" href="https://kodi.al/panel.ico"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="JW Player Code Builder" />
<meta name="author" content="Olsion Bakiaj - Endrit Pano" />
<meta property="og:site_name" content="JW Player Code Builder">
<meta property="og:locale" content="en_US">
<meta name="msapplication-TileColor" content="#0F0">
<meta name="theme-color" content="#0F0">
<meta name="msapplication-navbutton-color" content="#0F0">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="#0F0">
<body oncontextmenu="return false;">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://content.jwplatform.com/libraries/CoaM1Zse.js"></script>
<script>
    jwplayer.key = 'AxtUTRaRN2XoKSqfng16IByVxBY6mENRZp0DVw==';
</script>


<style type="text/css">
html {
    height: 100%;
    overflow: hidden;
}

#player {
    position: absolute;
    width: 100% !important;
    height: 100% !important;
}

body {
    height: 100%;
    margin: 0;
    padding: 0;
    background-color: #000;
}
</style>

<style type="text/css">
::-webkit-scrollbar {
width: auto; /* remove scrollbar space */
background: transparent; /* optional: just make scrollbar invisible */
}
/*  optional: show position indicator in red */
::-webkit-scrollbar-thumb {
background: #000;
}

.jw-rightclick {
    display: none !important;
}
</style>
</head>
<body>
<div id="player"></div>
<script>
    jwplayer("player").setup({
    playlist: <?php echo $json_url; ?>,
	// https://docs.jwplayer.com/players/reference/setup-options
    stretching: "uniform",
    controls: true,
    displaytitle: false,
    fullscreen: "true",
    height: "100%",
    width: "100%",
    fallback: false,
    repeat: true,
    autostart: false, 
	androidhls: true,
	// primary: "hls",
    primary: "html5",
    aspectratio: "16:9",
    renderCaptionsNatively: false,
	image: "https://png.kodi.al/tv/albdroid/logo_bar_black.png",
    abouttext: "Albdroid",
    aboutlink: "http://albdroid.al/",
    mute: false,

skin: {
	name: "glow",
    active: "#fc0303",
    inactive: "#0F0",
    background: "transparent",
	text: "#0F0",
    icons: "#0F0",
    iconsActive: "#0F0",
    timeslider: {
    progress: "none"
    }
},

    logo: {
        file: 'https://png.kodi.al/tv/albdroid/logo_bar.png',
        position: 'control-bar',
        margin: '270',
        hide: 'false'
    },
});
</script>
</body>
</html>