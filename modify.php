<?php
//提交编码为UTF-8
include_once ('config.php');
appheader('-修改文件');
$path=@$_POST['filename'];
if($path==null)$path=@$_GET['path'];
$coding=@$_POST['coding'];
if($coding==null)$coding=@$_GET['coding'];
$sy_path=mb_convert_encoding($path,$system_coding,'UTF-8');
if(@!is_file($sy_path) || $coding==null){
echo "路径或编码有误！";
appfooter();
}
$last_path=rawurlencode(dirname($sy_path));
if ($coding=='UTF-8'){
    $utf8_file_contents=file_get_contents($sy_path);
}else{
    $file_contents=file_get_contents($sy_path);
    $utf8_file_contents=mb_convert_encoding($file_contents,'UTF-8',$coding);
}
?>
<form method="get" action="modify.php">
<p>该文件为:"<?php echo $path ?>"&nbsp;编码为:<?php codinglist($coding) ?><input type="submit" value="切换编码">
<input type="hidden" name="path" value="<?php echo $path ?>">
</form>
</p>
<form method="post" action="writefile.php?do=modify">
<textarea rows="20" cols="150" name="content" type="text"><?php echo bmtxt($utf8_file_contents)?></textarea><br />
<input type="hidden" name="old_path" value="<?php echo $path ?>">
另存为:<input type="text" name="path" value="<?php echo $path ?>">
<?php codinglist($coding) ?>
<input type="submit" value="修改文件">
<?php
appmenu();
appfooter();
?>