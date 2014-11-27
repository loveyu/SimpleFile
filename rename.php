<?php
//utf-8文件名编码
	include_once ('config.php');
	appheader('-重命名');
	echo "<p>输入重命名的文件名</p>\n";
	if(@$_GET['one']==null){
	$filelist = $_POST;
	asort($filelist);
	echo "<form method=\"post\" action=\"rename2.php?";
    foreach ($filelist as
	   $id => $filepath) {
	    echo "$id=$filepath&";           
	}
    echo "\">\n";
	foreach ($filelist as $id => $filepath) {
	   $filename = basename($filepath);
	   echo "$id.$filepath<input type=\"text\" name=\"$id\" value=\"$filename\"><hr>\n";
	}
	}else{?>
<form method="post" action="rename2.php?rename1=<?php echo $_GET['path'] ?>">
命名："<?php echo $_GET['path'] ?>"<input type="text" name="rename1" value="<?php echo basename($_GET['path']) ?>">
<?}
	echo "<input type=\"submit\" value=\"提交命名请求\">\n";
    appmenu();
	appfooter();
?>