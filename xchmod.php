<?php
/**
 * 极限权限修改页
 */
include_once ('config.php');
$path=@$_GET['path'];
$filemod=@$_GET['filemod'];
$dirmod=@$_GET['dirmod'];
$show=@$_GET['show'];
$path2=mb_convert_encoding($path,$system_coding,'UTF-8');
appheader('-递归权限修改状态');
Xchmod($path2,$filemod,$dirmod,$show);
 echo "修改路径$path 下的所有文件权限为$filemod ，所有目录权限为$dirmod 执行完成！\n";
appmenu();
$runtime->stop();
echo "<hr>页面执行时间: ".$runtime->spent()."秒.\n<script language='javascript'>alert('"."递归修改路径$path 权限修改耗时".$runtime->spent()."秒');</script>\n";
appfooter();
?>
