<?php
include_once ('config.php');
appheader('-复制文件状态');
$todir=$_GET['todir'];
$filelist=$_POST;
foreach ($filelist as $id => $filepath){
    $filepath_old=mb_convert_encoding($filepath,$system_coding,'UTF-8');
    $todir_old=mb_convert_encoding($todir,$system_coding,'UTF-8');
    $filename=basename($filepath_old);
    $filetype=filetype($filepath_old);
    if($filetype=='file'){
        if(copy($filepath_old,$todir.$filename))echo "<font color=\"blue\">文件\"$filepath\"复制成功！</font><br />\n";
        else echo "<font color=\"red\">文件\"$filepath\"复制失败！</font><br />\n";
    }
    if ($filetype=='dir'){
      if (xCopy_dir($filepath_old,$todir.$filename))echo "<font color=\"cadetblue\">文件夹\"$filepath\"复制成功！</font><br />\n";
        else echo "<font color=\"orange\">文件夹\"$filepath\"复制失败！</font><br />\n"; 
    }   
}
appmenu();
$runtime->stop();
echo "<hr>页面执行时间: ".$runtime->spent()."秒.\n";
appfooter();
?>