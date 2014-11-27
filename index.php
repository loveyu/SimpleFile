<?php
include_once ('config.php');
appheader('-导引');
echo '<form method="get" action="list.php">
选择目录及操作类型:
';
$path=dirname(rootpath());//获取上级目录名
$filedata = glob("$path/*");//获取文件数组
if(empty($filedata) || !@file_exists($path) || @$_GET['s']=='0'){//当文件数组为空，路径错误，或者请求手动输入，输出内容
echo "<input name=\"path\" value=\"".rootpath()."\">\n(<a href=\"".hostpath()."\">智能匹配</a>)<br />\n";
}else{
$filedata=array_coding_to_utf8($filedata,$system_coding);
asort($filedata);//对数组排列，并保持引索关系
echo "<select name=\"path\">\n<option>$path/</option>\n";

foreach ($filedata as $id => $filename){ //历遍文件数据
    if (is_dir(mb_convert_encoding($filename,$system_coding,'UTF-8'))){//转换为原始文件名并判断是否为文件夹
        echo "<option>$filename/</option>\n";
    }
}

echo "</select>\n(<a href=\"?s=0\">手动输入</a>)<br />\n";
}
echo '<input type="radio" name="action" value="view" />查看文件
<input type="radio" name="action" value="newdir" />新文件夹
<input type="radio" name="action" value="newfile" />创建文件
<input type="radio" name="action" value="modify" />修改文件
<input type="radio" name="action" value="rename" />重命名
<br />
<input type="radio" name="action" value="chmod" />权限修改
<input type="radio" name="action" value="upfile" />上传文件
<input type="radio" name="action" value="copy" />复制文件
<input type="radio" name="action" value="delete" />删除文件
<input type="radio" name="action" value="urldl" />远程下载
<br />
<input type="radio" name="action" value="unzip" />unzip操作
<input type="radio" name="action" value="zip" />zip操作
<input type="radio" name="action" value="move" />移动文件
<input type="radio" name="action" value="xchmod" />递归权限修改
<hr>
<input type="submit" value="提交">&nbsp;';
appmenu();//底部菜单
appfooter();
?>
