<?php
include_once ('config.php');
$path=$_POST['filedir'];
$filename=$_POST['filename'];
$url=$_POST['url'];
appheader('-URL下载文件');
if($filename==null){
   $urlarray=parse_url($url);
   $basename=basename($urlarray['path']);
   $pathinfo=pathinfo($basename);
   $fileext=$pathinfo['extension'];
   if($fileext==null || $fileext=='php' || $fileext=='php5'|| $fileext=='asp'){
    $filename=$basename.".dl";
   }else{
    $filename=$basename;
   }
}
$fn=mb_convert_encoding($path.$filename,$system_coding,'UTF-8');
if (!@file_exists($fn)){
  $dl=httpdown($fn,$url);
  if ($dl!=false){
    echo "<p>下载\"$filename\"文件成功，大小为".newfilesize("$fn")."。<br>\n网址为:$url</p>";
    }else{
        echo "下载\"$url\"失败，请检查路径、文件名、及网址！文件大小限制为".round($httpdownmax/1024/1024,2)."M。";
        }  
        }else{
            echo "该文件\"$fn\"已经存在，该操作无法覆盖文件！";
        }
appmenu();
$runtime->stop();
echo "<hr>页面执行时间: ".$runtime->spent()."秒.\n";
appfooter();
?>