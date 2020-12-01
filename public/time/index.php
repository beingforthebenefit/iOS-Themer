<?php
date_default_timezone_set($_GET['timezone']);
$time = date('g:i a');
$fileName = md5(date('ymdhmsu')) . ".png";
$cmd = "echo '{$time}' | convert label:@- -trim {$fileName}";
exec($cmd);
$fp = fopen($fileName, 'rb');

header('Content-Type: image/png');
header("Content-Length: " . filesize($fileName));

fpassthru($fp);

fclose($fp);
exec("rm {$fileName}");
exit;