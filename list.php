<?php
/**
 * 文件列表
 */
	include_once ('config.php');
	$path = @$_GET['path'];
    if($path==null)$path=dirname(rootpath())."/";
	$action = @$_GET['action'];
    if($action=='view'){//如果请求为查看文件则进行跳转到查看文件
        appheader('-直接跳到查看页','','0',hostpath()."view.php?path=$path");
    }
    if($action=='move'){//如果请求为移动文件则跳转到移动文件页
        appheader('-直接跳到文件移动页','','0',hostpath()."move.php?path=$path");
    }
	appheader('-文件列表',"-$action"."操作");
	if ($action=='delete' || $action=='rename' || $action=='chmod'){//判断以上几种情况输出js
    echo "<SCRIPT LANGUAGE=\"JavaScript\">function ck(b)\n{\nvar input = document.getElementsByTagName(\"input\");\nfor (var i=0;i<input.length ;i++ )\n{\nif(input[i].type==\"checkbox\")\ninput[i].checked = b;\n}\n}\n</SCRIPT>";
}
     if (!@file_exists($path)) {//判断路径情况
        echo "该路径\"$path\"不存在或无访问权限！";
        appmenu();
        appfooter();
        exit;
        }
    $lastpath=rawurlencode(dirname($path));//转换上级目录为url编码
	echo "当前目录:".mb_convert_encoding($path,'UTF-8',$system_coding)."<hr>\n&gt;&gt;&gt;<a href=\"list.php?action=$action&path=$lastpath/\">上级目录</a><hr>\n";
    $filedata = glob("$path"."*");
    if(empty($filedata)){
    echo "该目录为空，或无访问权限！";
    }else{
    $path=mb_convert_encoding($path,'UTF-8',$system_coding);//转换为UTF-8编码路径
    $filedata=array_coding_to_utf8($filedata,$system_coding);//转换为UTF-8数组
    asort($filedata);
	if ($action == 'delete' || $action == 'rename' || $action=='chmod') {
	   echo "<form name=\"$action\" method=\"post\" action=\"$action.php\">\n<input type=\"button\" onclick=\"ck(true)\" value=\"全选\">\n<input type=\"button\" onclick=\"ck(false)\" value=\"取消全选\">\n<hr>\n";//输出表单部分
	   foreach ($filedata as $id => $filename) {
          $filename_old=mb_convert_encoding($filename,$system_coding,'UTF-8');//转换为原始文件名
          $urlfilename=rawurlencode($filename_old);//原始文件名的url编码
	      $filetype = filetype($filename_old);//文件类型
          if ($action=='chmod')$perms = '('.substr(sprintf('%o', fileperms($filename_old)), -4).')';//如果动作为修改权限则赋值给变量，否则为空
          else $perms=null;
	      $id = $id + 1;
          if ($filetype == 'dir') {//判断类型
	       echo "$id&nbsp;<input type=\"checkbox\" name=\"$action$id\" value=\"$filename\"/>&nbsp;&lt;目录&gt;<a href=\"list.php?path=$urlfilename/&action=$action\" title=\"进入目录\">$filename</a>$perms<hr>\n";
	      }else{
	       $filesize = newfilesize($filename_old);
	       echo "$id&nbsp;<input type=\"checkbox\" name=\"$action$id\" value=\"$filename\"/>&nbsp;&lt;$filetype"."文件&gt;$filename(<font color=\"blue\">$filesize</font>)$perms<hr>\n";
	      }   
	   }
       echo '<input type="submit" value="提交">'."\n";
	}
	if ($action == 'unzip') {
	   echo "选择ZIP文件:<br />\n<form method=\"post\" action=\"unzip.php\">\n";
	   foreach ($filedata as $id => $filename) {
	      $filename_old=mb_convert_encoding($filename,$system_coding,'UTF-8');
          $urlfilename=rawurlencode($filename_old);
	      $filetype = filetype($filename_old);
	      $id = $id + 1;
	      if ($filetype == 'dir') {
	       $filename=$filename."/";
	       echo "$id&nbsp;&lt;目录&gt;&nbsp;<a href=\"".hostpath()."list.php?path=$urlfilename/&action=unzip\" title=\"进入该目录\">$filename</a><hr>\n";
	      }
          if ($filetype == 'file'){
            $pathinfo=pathinfo($filename_old);
            if (@$pathinfo['extension']=='zip'){
                $filesize = newfilesize($filename_old);
                echo "$id&nbsp;&lt;ZIP&gt;<input type=\"radio\" name=\"zipfile\" value=\"$filename\" />$filename(<font color=\"blue\">$filesize</font>)<hr>\n";                
            }
          }
	   }
       echo "输入要解压到的目录:<input name=\"dir\" type=\"text\" value=\"$path\">\n<input type=\"submit\" value=\"提交\">&nbsp;\n";
	}
    if ($action == 'newfile' || $action == 'newdir' || $action == 'urldl' || $action == 'upfile' || $action=='zip') {
       if($action=='zip')echo "选择你要压缩文件所在目录:<br />\n";
       echo "<form method=\"post\" action=\"$action.php\">\n";
	   foreach ($filedata as $id => $filename) {
	     $filename_old=mb_convert_encoding($filename,$system_coding,'UTF-8');
         $urlfilename=rawurlencode($filename_old);
         $id = $id + 1;
	      if (filetype($filename_old) == 'dir') {
	       echo "$id<input type=\"radio\" name=\"filedir\" value=\"$filename/\" /><a href=\"".hostpath()
           ."list.php?path=$urlfilename/&action=$action\" title=\"进入该目录\">$filename</a><hr>\n";
           }
    }
    echo "0&nbsp;<input type=\"radio\" name=\"filedir\" value=\"$path\" checked/>$path(当前目录)<hr>\n";
    if ($action == 'newfile')echo "新文件名:<input name=\"newfilename\" type=\"text\"><hr>\n<input type=\"submit\" value=\"建立新文件\">\n";
    if ($action == 'zip')echo "ZIP路径及文件:<input name=\"zippath\" type=\"text\" value=\"$path"."newzipfile.zip\"><hr>\n<input type=\"submit\" value=\"提交目录\">\n";
    if ($action == 'newdir')echo "文件夹数量(MAX=$max_up_number):<input name=\"number\" type=\"text\" value=\"1\"><hr>\n<input type=\"submit\" value=\"建立新文件夹\">\n";
    if ($action == 'urldl')echo "大小限制:".round($httpdownmax/1024/1024,2)."M<br />\n网址:<input name=\"url\" type=\"text\"><br />\n文件名(选填):<input name=\"filename\" type=\"text\"><hr>\n<input type=\"submit\" value=\"开始下载文件到服务器\">\n";
    if ($action == 'upfile')echo "文件数量:<input name=\"number\" type=\"text\" value=\"1\"><hr>\n<input type=\"submit\" name=\"up\" value=\"上传文件\">\n";
    }
    if($action=='copy'){
        echo "<form method=\"get\" action=\"copy.php\">\n";
	   foreach ($filedata as $id => $filename) {
	     $filename_old=mb_convert_encoding($filename,$system_coding,'UTF-8');
         $urlfilename=rawurlencode($filename_old);
        $id = $id + 1;
	      if (filetype($filename_old) == 'dir') {
	       echo "$id<input type=\"radio\" name=\"todir\" value=\"$filename/\" /><a href=\"".hostpath()
           ."list.php?path=$urlfilename/&action=copy\" title=\"进入该目录\">$filename</a><hr>\n";
           }
    }
    echo "0&nbsp;<input type=\"radio\" name=\"todir\" value=\"$path\" checked/>$path(当前目录)<hr>\n";
    echo "选择你要复制到的文件目录&nbsp;<input type=\"submit\" value=\"去选择要复制的文件\">\n";
    }
    
   	if ($action == 'modify') {
	   echo "<form method=\"post\" action=\"modify.php\">\n";
	   foreach ($filedata as $id => $filename) {
 	     $filename_old=mb_convert_encoding($filename,$system_coding,'UTF-8');
         $urlfilename=rawurlencode($filename_old);
	      $id+=1;
	      if (is_dir($filename_old))echo "$id&nbsp;&lt;目录&gt;&nbsp;<a href=\"list.php?path=$urlfilename/&action=modify\" title=\"进入该目录\">$filename/</a><hr>\n";
          else echo "$id<input type=\"radio\" name=\"filename\" value=\"$filename\" />&nbsp;$filename(<font color=\"blue\">".newfilesize($filename_old)."</font>)<hr>\n";                
          }
       echo "选择文件编码类型:";
       codinglist();//输出一个编码列表
       echo "<input type=\"submit\" value=\"提交\">&nbsp;\n";
	}
    } 
	appmenu();
    $runtime->stop();
    echo "<hr>页面执行时间: ".$runtime->spent()."秒.\n";
	appfooter();
?>