<?php
include_once ('config.php');
appheader('-上传文件','-引导');
$path=@$_POST['filedir'];
$number=@$_POST['number'];
if($path==null){
$path=$_GET['path'];
$number="1";
}
if ($number>$max_up_number){
    echo "一次最多允许上传\"$max_up_number\"个文件<hr>\n";
    $number=$max_up_number;
}
echo "文件将上传到\"$path\"<hr>\n<form method=\"post\" action=\"upfile.php\">\n<input type=\"hidden\" name=\"filedir\" value=\"$path\">\n上传文件列表:<input type=\"text\" name=\"number\" value=\"$number\" size=\"2\">\n<input type=\"submit\" value=\"修改数量\">\n</form>
<hr>\n<form enctype=\"multipart/form-data\" method=\"post\" action=\"upfile2.php?path=$path\">\n";
for ($n=1;$n<=$number;$n++){
    $n0=$n-1;
    echo "$n&nbsp;<input name=\"upfile[]\" type=\"file\"><br />\n文件名:<input name=filename$n0 type=text><hr>\n";
}
echo "<input type=\"submit\" value=\"上传文件\">\n</form>\n文件名选填，留空为原始文件名！";
appmenu();
appfooter();
?>