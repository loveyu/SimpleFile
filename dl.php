<?php
include_once ('config.php');
$path=@$_GET['path'];
if($path==null || !is_file($path)){
appheader('-下载服务器文件');
echo "禁止的动作！";
appmenu();
appfooter();
}
$filename=basename($path);
$sy_path=mb_convert_encoding($path,$system_coding,'UTF-8');
header('Content-Type: application/octet-stream'); 
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Transfer-Encoding: binary");
readfile("$sy_path"); 
?>