<?php
/**
 * 查看文件
 */
include_once ('config.php');
appheader('-查看文件目录');
$path = @$_GET['path'];//获取请求文件夹的系统编码目录名
if ($path==null)$path=dirname(rootpath()).'/';//当目录请求为空时指定一个目录为上级目录
if (!@file_exists($path)) {//判断路径是否可用，否则直接退出
echo "该路径\"$path\"不存在或无访问权限！";
appmenu();
appfooter();
exit;
}
$imagearray=array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG','bmp','BMP','RGB','rgb');//建立一个图片后缀数组
$lastpath=rawurlencode(dirname($path));//获取上级目录名，并转换为url编码
echo "当前目录:".mb_convert_encoding($path,'UTF-8',$system_coding)."<hr>\n&gt;&gt;&gt;<a href=\"view.php?path=$lastpath/\">上级目录</a><hr>\n";//输出当前目录信息
$filedata = glob("$path"."*");//获取原始目录数组
if(empty($filedata)){//判断目录是否为空
    echo "该目录为空，或无访问权限！";
}else{
$path=mb_convert_encoding($path,'UTF-8',$system_coding);//将目录由系统编码转换为UTF-8编码
$filedata=array_coding_to_utf8($filedata,$system_coding);//转换文件数组
foreach ($filedata as $id => $filename) {//历遍数组
    $filename_old=mb_convert_encoding($filename,$system_coding,'UTF-8');//将文件名转换为系统编码
    $urlfilename=rawurlencode($filename_old);//由系统编码转换为url编码
    $filetype = filetype($filename_old);//获取文件类型呢
    $filesize=newfilesize($filename_old);//以自定义的函数获取文件大小
    $id = $id + 1;//文件id由1开始排列
    $perms = substr(sprintf('%o', fileperms($filename_old)), -4);//获取文件权限
    if ($filetype == 'dir')echo "$id&nbsp;&lt;目录&gt;&nbsp;<a href=\"view.php?path=$urlfilename/\" title=\"进入目录\">$filename</a>&nbsp;权限:$perms<hr>\n";//判断为目录时输出的内容
    if ($filetype == 'file'){
        $pathinfo=pathinfo($filename_old);//获取文件信息
        $fileext=@$pathinfo['extension'];//获取文件后缀
        $modify_time=date("Ymd.H:i.s",filemtime($filename_old));//获取文件最后修改时间
        $creat_time=date("Ymd.H:i.s",filectime($filename_old));//获取文件创建时间
        if(in_array($fileext,$imagearray)){//判断是否为图片
            echo "$id&nbsp;&lt;$fileext"."图像&gt;&nbsp;$filename(<font color=\"blue\">$filesize</font>)&nbsp;<a href=\"dl.php?path=$filename\" target=\"_blank\" title=\"下载该图片\">下载</a>&nbsp;<a href=\"readfile.php?path=$filename&type=image\" target=\"_blank\" title=\"查看该图片\">查看</a>&nbsp;权限:$perms<br />\n&nbsp;&nbsp;&nbsp;修改:$modify_time&nbsp;创建:$creat_time<hr>\n";
        }else{
            echo "$id&nbsp;&lt;$fileext"."文件&gt;&nbsp;$filename(<font color=\"blue\">$filesize</font>)&nbsp;<a href=\"dl.php?path=$filename\" target=\"_blank\" title=\"下载该文件\">下载</a>&nbsp;<a href=\"readfile.php?path=$filename\" target=\"_blank\" title=\"阅读该文件\">阅读</a>&nbsp;权限:$perms<br />\n&nbsp;&nbsp;&nbsp;修改:$modify_time&nbsp;创建:$creat_time<hr>\n";
        }  
        } 
     if ($filetype != 'dir' && $filetype != 'file') {//加入一个啥都不是的文件判断
        echo "$id&nbsp;&lt;未知文</font>件&gt;&nbsp;$filename(<font color=\"blue\">$filesize</font>)&nbsp;权限:$perms<hr>\n";
     }
}
}
appmenu();
$runtime->stop();//页面执行时间停止
echo "<hr>页面执行时间: ".$runtime->spent()."秒.\n";
appfooter();
?>