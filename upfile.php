<?php
include_once ('config.php');
appheader('-上传文件','-引导');
$path=@$_POST['filedir'];
$number=@$_POST['number'];
if ($number>$max_up_number){
    echo "一次最多允许上传\"$max_up_number\"个文件<hr>\n";
    $number=$max_up_number;
}
echo "<form enctype=\"multipart/form-data\" method=\"post\" action=\"upfile2.php?path=$path\">\n文件将上传到\"$path\"<hr>\n上传文件列表:$number<hr>\n";
for ($n=1;$n<=$number;$n++){
    $n0=$n-1;
    echo "$n&nbsp;<input name=\"upfile[]\" type=\"file\"><br />\n文件名:<input name=filename$n0 type=text><hr>\n";
}
echo "<input type=\"submit\" value=\"上传文件\">\n</form>\n文件名选填，留空为原始文件名！";
appmenu();
appfooter();
?>