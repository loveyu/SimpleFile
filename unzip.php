<?php
include_once ('config.php');
appheader('-zip解压');
$zipfile=$_POST['zipfile'];
$sy_zipfile=mb_convert_encoding($zipfile,$system_coding,'UTF-8');
$dir=$_POST['dir'];
$sy_dir=mb_convert_encoding($dir,$system_coding,'UTF-8');
$zip = new ZipArchive();
if ($zip->open($sy_zipfile) !== TRUE) {
echo "<font color=\"red\">无法打开\"$zipfile\"，可能文档错误！</font>\n";
echo '<input type="button" value="后退" onclick="javascript:window.history.back();"><hr><a href="'.hostpath()."\">返回</a>\n";
appfooter();
}
$zip->extractTo($sy_dir);
$zip->close();
echo "<font color=\"blue\">$zipfile 解压到 $dir 成功！</font><br />\n";
appmenu();
$runtime->stop();
echo "<hr>页面执行时间: ".$runtime->spent()."秒.<script language='javascript'>alert('$zipfile 解压完成.耗时".$runtime->spent()."秒');</script>\n";
appfooter();
?>