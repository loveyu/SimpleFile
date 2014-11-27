<?php
include_once ('config.php');
$path = @$_GET['path'];
if($path==null)$path=dirname(rootpath())."/";
if (!@file_exists($path)) {//判断路径情况
echo "该路径\"$path\"不存在或无访问权限！";
appfooter();
}
$utf8path=mb_convert_encoding($path,'UTF-8',$system_coding);















?>