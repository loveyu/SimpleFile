<?php
/**
 * 极限权限修改页
 * 提交utf-8
 */
include_once ('config.php');
$path=@$_GET['path'];
if($path==null){
$filelist=$_POST;
$filemod=$postfilemod;
$dirmod=$postdirmod;
$show=$postshow;
$re=$postre;
}else{
$filelist=array();
$filelist['0']=$path;
$filemod=@$_GET['filemod'];
$dirmod=@$_GET['dirmod'];
$show=@$_GET['show'];
$re=@$_GET['re'];
}
appheader('-递归权限修改状态');
asort($filelist);
foreach ($filelist as $id => $filepath) {
$path2=mb_convert_encoding($filepath,$system_coding,'UTF-8');
Xchmod($path2,$filemod,$dirmod,$show,$re);
echo "修改路径$filepath 下的所有文件权限为$filemod ，所有目录权限为$dirmod 执行完成！<br />\n";
}
appmenu();
$runtime->stop();
echo "<hr>页面执行时间: ".$runtime->spent()."秒.\n<script language='javascript'>alert('"."递归修改路径$path 权限修改耗时".$runtime->spent()."秒');</script>\n";
appfooter();
?>
