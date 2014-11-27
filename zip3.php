<?php
//单个文件夹压缩
include_once ('config.php');
appheader('-单个文件目录压缩');
?>
<form action="zip2.php" method="post">
压缩文件(目录):"<?php echo $_GET['path'] ?>"为<input type="text" name="zip" value="<?php echo dirname($_GET['path']) ?>/new.zip">
<input type="hidden" name="path" value="<?php echo $_GET['path'] ?>">
<input type="submit" value="开始压缩">
<?php
appmenu();
appfooter();
?>