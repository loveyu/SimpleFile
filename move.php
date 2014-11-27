<?php
include_once ('config.php');
appheader('-移动文件');
$path = $_GET['path'];
echo "<p>首先，如果空间不支持调用系统命令，还是请你先<a href=\"list.php?action=copy&path=$path\">复制</a>，然后<a href=\"list.php?action=delete&path=$path\">删除</a>。<br />毕竟php没有直接对文件移动的方法！<br />所以，下面来判断你空间是否支持系统函数。<br />\n";
$disable_fun=get_cfg_var("disable_functions");
echo "被禁用的函数列表:<font color=\"red\">$disable_fun</font><br />需要使用的函数:proc_open, popen, exec, system, shell_exec, passthru<br />当前绝对目录:".rootpath()."</p>\n<form method=\"post\" action=\"cmd.php?action=move\">\n<textarea rows=\"10\" cols=\"60\" name=\"code\" type=\"text\"></textarea><br />\n<input type=\"submit\" value=\"执行命令\">";
appmenu();
appfooter();
?>