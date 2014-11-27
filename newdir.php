<?php
include_once ('config.php');
appheader('-建立新文件夹',"-引导");
$path=$_POST['filedir'];
$number=$_POST['number'];
echo "<form method=\"post\" action=\"newdir2.php?path=$path\">\n<p>新文件夹列表:</p>";
for ($n=1;$n<=$number;$n++){
    echo "$n&nbsp;<input name=\"newdir$n\"><br>";
}
echo "<input type=\"submit\" value=\"建立新文件\">\n</form>\n";
appmenu();
appfooter();
?>