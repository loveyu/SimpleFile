<?php
//复制单文件
include_once ('config.php');
appheader('-复制单文件');
?>
<form method="post" action="copy2.php?0=<?php echo $_GET['path'] ?>">
当前文件：<?php echo $_GET['path']?><br />
复制到的目录:<input type="text" name="todir" value=""><input type="submit" value="开始复制">
<?php
appmenu();
appfooter();
?>