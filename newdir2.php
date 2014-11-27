<?php
include_once ('config.php');
appheader('-建立新文件夹',"-状态");
$newdirlist = $_POST;
$path=$_GET['path'];
$sy_path=mb_convert_encoding($path,$system_coding,'UTF-8');
asort($newdirlist);
foreach ($newdirlist as $id => $dirname) {
    $sy_dirname=mb_convert_encoding($dirname,$system_coding,'UTF-8');
    $sy_dirpath=$sy_path.$sy_dirname;
    echo "$id.&nbsp;在\"$path\"下建立\"$dirname\"目录&nbsp;&lt;&lt;";
    if(!@mkdir($sy_dirpath,'0755')) echo"<font color=\"red\">失败</font><hr>";
    else echo"<font color=\"blue\">成功</font><hr>";
}
appmenu();
appfooter();
?>