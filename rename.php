<?php
	include_once ('config.php');
	appheader('-重命名');
	echo "\n<hr>\n<p>输入重命名的文件名</p>\n";
	$filelist = $_POST;
	asort($filelist);
	echo "<form method=\"post\" action=\"rename2.php?";
    foreach ($filelist as
	   $id => $filepath) {
	    echo "$id=$filepath&";           
	}
    echo "\">\n";
	foreach ($filelist as
	   $id => $filepath) {
	   $filename = basename($filepath);
	   echo "$id.$filepath<input type=\"text\" name=\"$id\" value=\"$filename\"><hr>\n";
	}
	echo "<input type=\"submit\" value=\"提交命名请求\">\n</form>";
    appmenu();
	appfooter();
?>