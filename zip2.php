<?php
include_once ('config.php');
appheader('-zip压缩状态');
if(@$path==null && @$zippath==null){
$path=@$_GET['path'];
$zippath=@$_GET['zip'];
}
if($zippath==null){
$filename=basename(@$_POST['path']);
$filedata=array();
$filedata['1']=$filename;
$path=dirname(@$_POST['path']);
$zippath=@$_POST['zip'];
}else{
$filedata=@$_POST;
}
asort($filedata);
$sy_path=mb_convert_encoding($path,$system_coding,'UTF-8');
$sy_zippath=mb_convert_encoding($zippath,$system_coding,'UTF-8');
if(!chdir($sy_path)){
    echo "目录切换失败！\n";
}else{
    echo "下列文件所属目录:\"$path\"<br />添加以下文件到\"$zippath\":<hr>\n";
    $zip = new ZipArchive;
    if ($zip->open($sy_zippath, ZipArchive::OVERWRITE) === TRUE){
    foreach($filedata as $id => $filename){
    $filename_old=mb_convert_encoding($filename,$system_coding,'UTF-8');
    if (is_dir($filename_old)){
        addFileToZip($filename_old,$zip,$zippath);
    }else{
        $zip->addFile($filename_old);
        echo "$filename&nbsp;&gt&nbsp;<font color=\"blue\">成功</font><br />\n";
        }
   }
   $zip->close();
   echo "<hr>";
   }else{
    echo "建立zip文件\"$zippath\"失败！\n";
   }
}
appmenu();
$runtime->stop();
echo "<hr>页面执行时间: ".$runtime->spent()."秒.\n<script language='javascript'>alert('$zippath 压缩完成.耗时".$runtime->spent()."秒');</script>";
appfooter();
?>