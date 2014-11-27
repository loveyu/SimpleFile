<?php
/**
 * 权限修改页
 */
include_once ('config.php');
appheader('-权限修改');
$filelist = $_POST;
asort($filelist);
echo "<form method=\"post\" action=\"chmod2.php?";
foreach ($filelist as $id => $filepath) {//历遍数组输出get请求的文件名
    echo "$id=$filepath&";
    }
    echo "\">\n";
	foreach ($filelist as $id => $filepath) {
	   $sy_filepath=mb_convert_encoding($filepath,$system_coding,'UTF-8');//转换文件名为系统编码
       $perms = substr(sprintf('%o', fileperms($sy_filepath)), -4);//取得文件（夹）权限
       echo "$id.$filepath<input type=\"text\" name=\"$id\" value=\"$perms\"><hr>\n";//输出表单
	   }
       echo "<input type=\"submit\" value=\"提交权限修改请求\">\n";
appmenu();
appfooter();
?>