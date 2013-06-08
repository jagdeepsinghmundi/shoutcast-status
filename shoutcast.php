<html>
<head>
	<title>Shoutcast server status using PHP</title>
</head>
<body>
<?php
// You'll most likely want to change the $server variable and *maybe* the port.
// Don't touch the $get variable.
$server  = 'gill.sukhpal.net'; # Server url
$port =  8000;         # Port number
$get  = '/7.html';     # Page on webserver that contains basic information

$ch = curl_init("http://{$server}:{$port}{$get}");
if (!$ch) exit('Init failed. Bad URI?');
// You must set the user agent to "Mozilla", or the server will try to stream
// audio instead of returning the 7.html page.
// Think about a dumb server - it's Shoutcast.
curl_setopt_array($ch,array(CURLOPT_RETURNTRANSFER=>TRUE,CURLOPT_USERAGENT=>'Mozilla'));
$response = curl_exec($ch);
curl_close($ch);

if (empty($response)) exit('Empty response');

if (preg_match('#^.*<BODY>(.*)</BODY>.*$#i',$response,$matches) < 1)
	exit("Invalid server response\r\n".$response);

// Get the song name, artist and some more useful information that this script
// won't use but I put there anyway.
list($current,$status,$peak,$max,$reported,$bit,$song) = explode(',',$matches[1], 7); 

echo "<p>Song: $song</p>";
echo "<p>Status: $status</p>";
echo "<p>Peak: $peak</p>";
echo "<p>Max: $max</p>";
echo "<p>Reported: $reported</p>";
echo "<p>Bitrate: $bit</p>";
echo "<p>Current Listeners: $current</p>";
?>
</body>
</html>