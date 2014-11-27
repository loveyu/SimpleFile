<?php
include_once ('config.php');
appheader('-写入文件状态');
$coding=$_POST['coding'];
$content=$_POST['content'];
$long=strlen($content);
$do=$_GET['do'];
$filepath=@$_POST['path'];
$old_path=@$_POST['old_path'];
$sy_filepath=mb_convert_encoding($filepath,$system_coding,'UTF-8');
$last_path=rawurlencode(dirname($sy_filepath));
if ($do=='new'){
    if (file_exists($sy_filepath)) {
        echo "<p>\"$filepath\"该文件已经存在，禁止创建新文件！\n<a href=\"".hostpath()."list.php?action=newfile&path="
        .rootpath()."\">返回</a></p><hr>\n<a href=\"".hostpath()."\">首页</a>\n";
        appfooter();
    } 
    if ($coding!='UTF-8'){
        $content=mb_convert_encoding($content,$coding,'UTF-8');
    }
    $writelong=file_put_contents($sy_filepath,$content);
    echo "提交字符串长度为\"$long\"字节，写入到\"$filepath\"的长度为\"$writelong\"字节。文件编码为\"$coding\"，大小为\""
    .newfilesize($sy_filepath)."\"。<hr>\n<a href=\"".hostpath()."list.php?action=newfile&path=$last_path/\">返回选择文件目录</a>&nbsp;";
}
if ($do=='modify'){
    if ($coding!='UTF-8'){
        $content=mb_convert_encoding($content,$coding,'UTF-8');
    }
    $writelong=file_put_contents($sy_filepath,$content);
    echo "修改的文件为\"$filepath\"，提交长度为\"$long\"字节，成功写入\"$writelong\"字节，文件编码为\"$coding\"，大小为\""
    .newfilesize($sy_filepath)."\"。<br />";
    if ($filepath!=$old_path){
        echo "<font color=\"red\">原文件文件\"$old_path\"没有被删除，而是新建的\"$filepath\"</font>";
    }
    echo "<hr>\n<a href=\"".hostpath()."list.php?action=modify&path=$last_path/\">返回选择文件</a>&nbsp;";
}
appmenu();
appfooter();
?>