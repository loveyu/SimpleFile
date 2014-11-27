<?php
include_once ('config.php');
$path=@$_GET['path'];
$sy_path=mb_convert_encoding($path,$system_coding,'UTF-8');
if (!is_file($sy_path))die("<font color=\"red\">error path!</font>");
header("Content-type: image/JPEG",true);
readfile($sy_path);
?>