<?php
	include_once ('config.php');
	appheader('-重命名状态');
	$renamefile = $_POST;
	asort($renamefile);
	foreach ($renamefile as $id => $newname) {
	   $filepath = $_GET["$id"];
       $sy_filepath=mb_convert_encoding($filepath,$system_coding,'UTF-8');
	   $dirpath = dirname($filepath);
	   $newfath = $dirpath."/".$newname;
       $sy_newfath=mb_convert_encoding($newfath,$system_coding,'UTF-8');
	   echo "$filepath&nbsp;&gt;&nbsp;$newfath";
	   if (!rename($sy_filepath,$sy_newfath)) {
	      echo '&nbsp;&lt;&nbsp;<font color="red">失败！</font><br />';
	   } else {
	      echo '&nbsp;&lt;&nbsp;<font color="blue">成功！</font><br />';
	   }
	}
    appmenu();
	appfooter();
?>