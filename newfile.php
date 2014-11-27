<?php
include_once ('config.php');
appheader('-写新文件');
$filepath=@$_POST['filedir'].@$_POST['newfilename'];
$sy_filepath=mb_convert_encoding($filepath,$system_coding,'UTF-8');
    if (file_exists($sy_filepath)) {
        echo "<p>\"$filepath\"该文件已经存在，禁止创建新文件！\n<a href=\"".hostpath()."list.php?action=newfile&path="
        .rootpath()."\">返回</a></p><hr>\n<a href=\"".hostpath()."\">首页</a>\n";
        appfooter();
    }
echo "<p>该文件将写入到:\"$filepath\"</p>\n<form method=\"post\" action=\"writefile.php?do=new\">
<textarea rows=\"20\" cols=\"150\" name=\"content\" type=\"text\"></textarea><br />
保存为:<input type=\"text\" name=\"path\" value=\"$filepath\">";
codinglist();
echo "<input type=\"submit\" value=\"写入文件\">\n";
appmenu();
appfooter();
?>