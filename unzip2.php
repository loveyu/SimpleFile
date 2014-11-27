<?php
include_once ('config.php');
appheader('-zip解压信息');
$path=$_GET['path'];
$dir=dirname($path);
?>
<form action="unzip.php" method="post">
当前zip文件：<?php echo $path?><br />
<input type="hidden" name="zipfile" value="<?php echo $path?>">
解压到目录：
<input type="text" name="dir" value="<?php echo $dir?>/"><br />
<input type="submit" value="开始解压">
<?
appmenu();
appfooter();
?>