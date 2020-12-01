<?php
$city = $_GET['city'];
$weather = shell_exec('curl "http://wttr.in/'. $city .'?u&format=%25C+%25f"');
$fileName = md5(date('ymdhmsu')) . ".png";
$cmd = "echo '{$weather}' | convert label:@- -trim {$fileName}";
exec($cmd);
$fp = fopen($fileName, 'rb');

header('Content-Type: image/png');
header("Content-Length: " . filesize($fileName));

fpassthru($fp);

fclose($fp);
exec("rm {$fileName}");
exit;