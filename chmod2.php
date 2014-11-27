<?php
/**
 * 权限修改状态
 */
	include_once ('config.php');
	appheader('-权限修改状态');
    asort($_POST);
    foreach ($_POST as $id => $new) {
        $filepath = $_GET["$id"];//通过get方法获得要修改权限的文件名
        $sy_filepath=mb_convert_encoding($filepath,$system_coding,'UTF-8');//转换为系统编码
        if (!chmod($sy_filepath,$new)){
            echo "<font color=\"red\">\"$filepath\"修改权限为\"$new\"失败！</font><hr>\n";
        }else{
            echo "<font color=\"blue\">\"$filepath\"修改权限为\"$new\"成功！</font><hr>\n";
        }
        }
        appmenu();
        appfooter()
?>