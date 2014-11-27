<?php
include_once ('config.php');
appheader('-修改文件');
$path=$_POST['filename'];
$coding=$_POST['coding'];
$sy_path=mb_convert_encoding($path,$system_coding,'UTF-8');
$last_path=rawurlencode(dirname($sy_path));
if ($_POST['coding']=='UTF-8'){
    $utf8_file_contents=file_get_contents($sy_path);
}else{
    $file_contents=file_get_contents($sy_path);
    $utf8_file_contents=mb_convert_encoding($file_contents,'UTF-8',$coding);
}
echo "<p>该文件为:\"$path\"&nbsp;编码为:\"$coding\"</p>\n<form method=\"post\" action=\"writefile.php?do=modify\">
<textarea rows=\"20\" cols=\"150\" name=\"content\" type=\"text\">".bmtxt($utf8_file_contents)."</textarea><br />
<input type=\"hidden\" name=\"old_path\" value=\"$path\">
另存为:<input type=\"text\" name=\"path\" value=\"$path\">";
codinglist($coding);
echo "<input type=\"submit\" value=\"修改文件\">\n";
appmenu();
appfooter();
?>