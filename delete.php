<?php
include_once ('config.php');
$postlist=$_POST;
$str = implode(',',$_POST);
if (empty($str)) {
$postlist=array();
$postlist['0']=$_GET['path'];
}
appheader('-文件删除');
asort($postlist);
foreach ($postlist as $id => $filename) {
    $sy_path=mb_convert_encoding($filename,$system_coding,'UTF-8');
				if (is_file($sy_path)) {
								if (unlink($sy_path)) echo "<font color=\"blue\">删除</font><font color=\"red\">文件</font><font color=\"blue\"> \"$filename\" 成功！</font><br>";
								else  echo "<font color=\"red\">删除文件 \"$filename\"失败！</font><br>";
				} else {
								CleanDir($sy_path);
								if (rmdir($sy_path)) {
								    echo "<font color=\"blue\">删除目录 \"$filename\" 成功！</font><br>";
								}else{
								    echo "<font color=\"red\">删除目录 \"$filename\"失败！</font><br>";
								}
				}
}
echo "<hr>\n";
appmenu();
$runtime->stop();
echo "<hr>页面执行时间: ".$runtime->spent()."秒.\n";
appfooter();
?>