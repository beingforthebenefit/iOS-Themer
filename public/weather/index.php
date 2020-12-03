<?php

if (array_key_exists('city', $_GET)) {
    $city = escapeshellarg($_GET['city']);
} else {
    header('Content-Type: text/plain');
    echo "Please set a city";
}

$handle = curl_init();
curl_setopt_array($handle, [
    CURLOPT_URL => "http://wttr.in/{$city}?u&format=%25C+%25f",
    CURLOPT_RETURNTRANSFER => true
]);

$weather = curl_exec($handle);

$fileName = md5(date('ymdhmsu')) . ".png";
$cmd = "echo '{$weather}' | convert label:@- -trim {$fileName}";
exec($cmd);
$fp = fopen($fileName, 'rb');

header('Content-Type: image/png');
header("Content-Length: " . filesize($fileName));

fpassthru($fp);

curl_close($handle);
fclose($fp);
exec("rm {$fileName}");
exit;