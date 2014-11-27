<?php
 function appheader($info ='',$info2 = '',$time ='',$url = '') {
    #输出页头
    global $appname;//将站点文件名定义为全局变量
    echo "<html>\n<title>$appname"."$info"."$info2". "</title>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n<h1>$appname"."$info"."$info2</h1><hr>\n";
    if ($time < 10 && $url !="") {
       echo "<meta http-equiv=\"refresh\" content=\"$time;URL=$url\">\n<html>\n";
       exit;
    }
 }

 function appfooter() {
    #输出页尾
    global $appname;//定义两个全局变量
    global $version;
    echo "<hr>\n<p>&copy; 2011 <a href=\"http://www.loveyu.org/\">loveyu.org</a>&nbsp;$appname($version) All Rights Reserved.</p>\n</html>";
    exit;
 }

 function hostpath() {
    #获取当前目录网址
    $host = $_SERVER['SERVER_NAME'];//获取服务器名
    $path = $_SERVER['SCRIPT_NAME'];//页面脚本相对服务器路径
    $path = dirname($path);//去除文件名
    if ($path == "/")$path = "";//判断为根目录的情况，如果是的就输出空
    $urlpath = "http://"."$host"."$path"."/";//获取网址
    return $urlpath;
 }
 function rootpath() {
    #获取当前页面的绝对目录
    $path = $_SERVER['SCRIPT_FILENAME'];//获取文件绝对目录
    $path = dirname($path);
    if ($path == "/")$path = "";
    $rootpath = "$path"."/";
    return $rootpath;
 }

 function newfilesize($fname) {
    #判断文件大小增强
    $size = filesize($fname);
    if ($size < 1024)
       $newsize = $size."B";
    if ($size >= 1024 &&
       $size < 1048576)
       $newsize = round($size /(1024),2)."KB";
    if ($size >= 1048576 &&
       $size < 1073741824)
       $newsize = round($size / (1024 * 1024),2)."MB";
    if ($size >= 1073741824 &&
       $size < 1099511627776)
       $newsize = round($size /(1024 * 1024 * 1024),2)."GB";
    if ($size >= 1099511627776)
       $newsize = round($size / (1024 * 1024 * 1024 *1024),2)."TB";
    return $newsize;
 }

 function CleanDir($dir)
   #清空目录并返回列表
 {
    global $system_coding;//定义全局变量系统编码
    $handle = opendir($dir);//打开指定文件夹
    while ($file = readdir($handle)) {
       if (($file == ".") || ($file == ".."))
          continue;
       if (is_dir("$dir/$file")) {
          CleanDir("$dir/$file");
          if (rmdir("$dir/$file"))
             echo "<font color=\"blue\">删除目录\"".mb_convert_encoding("$dir/$file",'UTF-8',$system_coding)."\" 成功！</font><br>";
          else
             echo "<font color=\"red\">删除目录\"".mb_convert_encoding("$dir/$file",'UTF-8',$system_coding)."\"失败！</font><br>";
       } else {
          if (unlink("$dir/$file"))
             echo "<font color=\"blue\">删除文件\"".mb_convert_encoding("$dir/$file",'UTF-8',$system_coding)."\"成功！</font><br>";
          else
             echo "<font color=\"red\">删除文件\"".mb_convert_encoding("$dir/$file",'UTF-8',$system_coding)."\"失败！</font><br>";
       }
    }
    closedir($handle);//关闭打开的文件夹
 }

function codinglist($coding='UTF-8') {
    #输出一个编码选择框
    $s = "selected=\"selected\"";
    echo "<select name=\"coding\">\n<option ";
    if ($coding == 'UTF-8')echo $s;
    echo ">UTF-8</option>\n<option ";
    if ($coding == 'Unicode')echo $s;
    echo ">Unicode</option>\n<option ";
    if ($coding == 'GB2312')echo $s;
    echo ">GB2312</option>\n<option ";
    if ($coding == 'GBK')echo $s;
    echo ">GBK</option>\n</select>\n";
 }
 function bmtxt($t) {
    ##引用自hu60，将文本以html源方式输出
    $t = str_replace(array("\r","\n"),array('&#13;','&#10;'),htmlspecialchars($t,ENT_QUOTES,"utf-8"));
    /*
	$tns=array();
    $n=count($tns);
    for($a=$n-1;$a>0;$a=$a-2)
    {
    $b=$a-1;
    $t=preg_replace($tns[$a],$tns[$b],$t);
    }
	*/
    return $t;
 }

/*未使用
function dir2array($dir,
$subdirs = false) {
#获取文件夹目录下文件为数组
$dir_data = array();
if (!@is_dir($dir)) {
die("This directory does not exist ($dir)");
}
if (!$dir_handle = @
opendir($dir)) {
die("Unable to open directory ($dir)");
}
while ($file = @
readdir($dir_handle)) {
if (@filetype($dir.
$file) !== '' && $file
!== '.') {
if (@filetype($dir.
$file) == 'dir' && $file
!== '..') {
$dir_data['folders'][$file] =
$file;
if ($subdirs) {
$dir_files = dir2array($dir.
'/'.$file.'/',true);
$dir_data['folders'][$file] =
$dir_files;
}
} else
if ($file !== '..' &&
$file !== '.htaccess') {
$dir_data['files'][$file] =
$file;
}
}
}
return $dir_data;
}
*/
 function array_coding_to_utf8($array,
    $coding) {
    #将数组编码转换为utf-8
    if(empty($array)) return array();//判断是否为空数组，如果是的直接返回空数组
    $new_array = array();
    foreach ($array as $id => $name) {
       $utf8_id = mb_convert_encoding($id,'UTF-8',$coding);
       $utf8_name = mb_convert_encoding($name,'UTF-8',$coding);
       $new_array[$utf8_id]=$utf8_name;
    }
    return $new_array;
 }
 function appmenu() {
    echo "<input type=\"button\" value=\"后退\" onclick=\"javascript:window.history.back();\">\n</form>\n"."<hr>\n"."<a href=\"".hostpath()."\">首页</a>&nbsp;<a href=\"cmd.php\">执行代码</a>&nbsp;<a href=\"view.php\">查看文件</a>&nbsp;<a href=\"list.php?action=upfile\">上传文件</a>&nbsp;<a href=\"?action=logout\">退出</a>\n";
 }
 function httpdown($fn,$url) {
    #远程下载函数
    global $httpdownmax;//定义全局变量
    $max = $httpdownmax;
    $fp = @fopen($fn,'w');
    if (!$fp)
       return false;
    if (!preg_match('!'.'^http://!i',$url))
       $url = 'http://'.$url;
    $dp = fopen($url,'rb');
    if (!$dp)
       return false;
    for ($size = 0; !feof($dp); $size +=1024) {
       $ok = fwrite($fp,fread($dp,1024));
       if ($size > $max or !$ok) {
          fclose($dp);
          fclose($fp);
          unlink($fn);
          return false;
       }
    }
    fclose($dp);
    fclose($fp);
    return $size;
 }
 function xCopy_dir($source, $destination, $child=1){
    //url http://hi.baidu.com/lyjnd321/blog/item/dbcdb216459f3259f2de3220.html
    //用法：
    // xCopy("feiy","feiy2",1):拷贝feiy下的文件到 feiy2,包括子目录
    // xCopy("feiy","feiy2",0):拷贝feiy下的文件到 feiy2,不包括子目录

    if(!is_dir($source)){
    return 0;
    }
    if(!is_dir($destination)){
    mkdir($destination,0755);
    }
    $handle=dir($source);
    while($entry=$handle->read()) {
        if(($entry!=".")&&($entry!="..")){
            if(is_dir($source.'/'.$entry)){
                if($child)xCopy_dir($source.'/'.$entry,$destination.'/'.$entry,$child);
            }else{
                copy($source.'/'.$entry,$destination.'/'.$entry);
                }
        }
    }
    return true;
}
 function addFileToZip($path,$zip){
    global $system_coding;//定义全局变量的系统编码
    $handler = opendir($path);
    while( ($filename = readdir($handler)) !== false ){
         if($filename != "." && $filename != ".."){
            if(is_dir($path."/".$filename)){//判断读到的数据是否为文件夹，如果是的就重复执行函数
                addFileToZip($path."/".$filename, $zip);
                }else{
                    $zip->addFile($path."/".$filename);
                    $new=mb_convert_encoding("$path/$filename",'UTF-8',$system_coding);//转换
                    echo "$new&nbsp;&gt;&nbsp<font color=\"blue\">成功</font><br />\n";
            }
         }
    }
    @closedir($path);
 }
 function Xchmod($path,$filemod,$dirmod,$show='0'){
 $filemod1=octdec($filemod);
 $dirmod1=octdec($dirmod);
    if(!is_dir($path)){
    if(!chmod($path,$filemod1)){
    echo "<font color=\"red\">文件$path 修改权限为$filemod 失败！</font><br />\n";
    }else{
    if ($show=='1')
    echo "<font color=\"blue\">文件$path 修改权限为$filemod 成功！</font><br />\n";
    }
    }else{
    if(!chmod($path,$dirmod1)){
    echo "<font color=\"red\">目录$path 修改权限为$dirmod 失败！</font><br />\n";
    }else{
    if ($show=='1')
    echo "<font color=\"blue\">目录$path 修改权限为$dirmod 成功！</font><br />\n";
    }
    $handle=dir($path);
    while($entry=$handle->read()) {
        if(($entry!=".")&&($entry!="..")){
                Xchmod($path.'/'.$entry,$filemod,$dirmod,$show);
        }
    }
 }
 }
?>
