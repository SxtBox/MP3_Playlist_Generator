<?php
/*
 Mixed Playlist Generators by Folder
 Filename: Clappr_Player_By_ID.php
 Required JSON_API.php
 GET: Clappr_Player_By_ID.php?id=1 2 3 etc see ids from JSON_API
 Description: Clappr Player Structure
 Author: TRC4@USA.COM
 Created Date: 09 April 2025
*/

error_reporting(0);
set_time_limit(0);
date_default_timezone_set("Europe/Tirane");

function get_data ($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
  $protocol = 'http://';
} else {
  $protocol = 'https://';
}

$ROOT_URL = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/";
$PHP_PATH = $protocol . ($_SERVER['SERVER_NAME']) . ($_SERVER['PHP_SELF']) . "";

$json_api_path = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/JSON_API.php";

$get_id = isset($_GET["id"]) && !empty($_GET["id"]) ? $_GET["id"] : "1";

$json = json_decode(get_data($json_api_path));

foreach($json as $item) {
	if ($item->{"id"}==($get_id)) {
		$title = $item->title;
		$url = $item->file;
		$description = $item->description;
		$thumbnail = $item->image;
		$type = $item->type;
		$label = $item->label;
		$date = $item->date;
		$time = $item->time;
	}
}

{
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo trim($title); ?></title>
<link rel="shortcut icon" href="https://kodi.al/favicon.ico"/>
<link rel="icon" href="https://kodi.al/favicon.ico"/>
<meta name="description" content="<?php echo trim($title); ?>">
<meta property="og:site_name" content="Clappr Player <?php echo trim($title); ?>">
<meta name="keywords" content="Albdroid TV">
<meta name="author" content="Olsion Bakiaj - Endrit Pano">
<meta http-equiv="cache-control" content="no-store">
<meta name="robots" content="noindex">
<meta name="googlebot" content="noindex" />
<meta name="referrer" content="no-referrer" />
<meta name="theme-color" content="#0F0">
<meta name="color-scheme" content="dark">
<meta name="msapplication-TileColor" content="#0F0">
<meta name="msapplication-navbutton-color" content="#0F0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<style type="text/css">
body,td,th {
	color: #0F0;
}
body {
	background-color: #000;
}
a:link {
	color: #0FC;
}
a:visited {
	color: #3F6;
}
a:hover {
	color: #09F;
}
a:active {
	color: #009;
}
</style>

<style>
.media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar] {
    height: 3px
}

.media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-hd-indicator] svg {
    opacity: 0
}

.media-control[data-media-control] {
    display: block !important
}

.media-control[data-media-control] .media-control-background[data-background]::before {
    font-size: 2vw;
    color: #0F0;
    text-align: center;
    font-family: Segoe UI;
    font-weight: bold;
    /* content: "<?php echo trim($title); ?>"; */
    text-shadow: 1px 1px 1px #0F0;

background-color: transparent;
margin-left:0px;
margin-top:0px;
opacity: 1.00;
position:absolute;
z-index:10000;
}

.media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-hd-indicator] {
    background: url(https://png.kodi.al/tv/albdroid/logo_bar.png) center center/100% no-repeat;
    width: 100px;
    display: block !important;
}

.image-container {
    opacity: .8;
    transition: all .3s;
    display: block;
    overflow: hidden;
    background-color: rgba(255, 255, 255, .11)
}
</style>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@clappr/player@latest/dist/clappr.min.js"></script>
</head>
<?php
$clappr_player = '
<body>
<div onClick="nextItem();" id="divOver" style="background-color: transparent; margin-left:0px; margin-top:0px; opacity: 1.00; position:absolute; z-index:10000;">
<!---->
<span style="font-size: 15px; color:lime;"><b>'. $title .'</b></span>
</div>
<!---->
<div id="player" title="'. $title .'"></div>
<script>
var player = new Clappr.Player({
source: "'. $url .'",
poster: "'. $thumbnail .'",
watermark: "'. $thumbnail .'",
position: "top-right",
//scale: "exactfit",
parentId: "#player",
playInline: true,
autoPlay: false,
hlsLogEnabled: false,
disableErrorScreen: true,
mimeType: "'.$type.'",
mediacontrol: {
	seekbar: "#0F0",
	buttons: "#0F0"
	},
width: \'100%\',
height: \'100%\'
});
</script>
</body>
</html>';
echo $clappr_player;
}
?>