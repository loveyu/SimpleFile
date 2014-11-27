<?php
include_once ('config.php');
appheader('-阅读文件内容');
$path = @$_GET['path'];
$coding = @$_GET['coding'];
if ($coding==null)$coding='UTF-8';
$sy_path=mb_convert_encoding($path,$system_coding,'UTF-8');
echo "当前文件&gt;&gt;$path\n";
if(@$_GET['type']=='image'){
    echo "<br /><a href=\"image.php?path=$path\"><img src=\"image.php?path=$path\" title=\"$path\"></a>";
}else{
echo "<form method=get action=readfile.php>
<input type=hidden name=path value=$path>\n编码&gt;&gt;\n";
codinglist($coding);
echo "<input type=submit value=切换编码></form><hr>\n";
if ($coding=='UTF-8'){
    highlight_file($sy_path);
}else{
    //if(!is_dir('temp'))mkdir('temp','0777');
    //file_put_contents('temp/readfile.temp.php',mb_convert_encoding(file_get_contents($sy_path),'UTF-8',$coding));
    $contents=mb_convert_encoding(file_get_contents($sy_path),'UTF-8',$coding);
    highlight_string($contents);
    //unlink('temp/readfile.temp.php');
}
}
echo "\n<hr>\n";
appmenu();
$runtime->stop();
echo "<hr>页面执行时间: ".$runtime->spent()."秒.\n";
appfooter();
?>