<?php
/**
 * 复制文件
 */
	include_once ('config.php');
	$path = @$_GET['path'];
    $todir=@$_GET['todir'];
    if($path==null){$path=$todir;}
	appheader('-复制文件');
    echo "<SCRIPT LANGUAGE=\"JavaScript\">function ck(b)\n{\nvar input = document.getElementsByTagName(\"input\");\nfor (var i=0;i<input.length ;i++ )\n{\nif(input[i].type==\"checkbox\")\ninput[i].checked = b;\n}\n}\n</SCRIPT>";
     if (!@file_exists($path)) {
        echo "该路径\"$path\"不存在或无访问权限！";
        appmenu();
        appfooter();
        exit;
        }
    $lastpath=rawurlencode(dirname($path));
	echo "&gt;&gt;&gt;<a href=\"".hostpath()."copy.php?path=$lastpath/&todir=$todir\">上级目录</a><hr>\n";
    $filedata = glob("$path"."*");
    if(empty($filedata)){
    echo "该目录为空，或无访问权限！\n";
    }else{
        echo "选择的文件和文件夹及子目录将会全部复制到$todir(<a href=\"list.php?action=copy&path=$todir\">重选</a>)";
    $path=mb_convert_encoding($path,'UTF-8',$system_coding);
    $filedata=array_coding_to_utf8($filedata,$system_coding);
    asort($filedata);
	   echo "<form method=\"post\" action=\"copy2.php?todir=$todir\">\n";
	   echo "<input type=\"button\" onclick=\"ck(true)\" value=\"全选\">\n<input type=\"button\" onclick=\"ck(false)\" value=\"取消全选\">\n
       当前目录:$path<hr>\n";   
	   foreach ($filedata as $id => $filename) {
          $filename_old=mb_convert_encoding($filename,$system_coding,'UTF-8');
          $urlfilename=rawurlencode($filename_old);
	      $filetype = filetype($filename_old);
	      $id = $id + 1;
          if ($filetype == 'dir') {
	       echo "$id&nbsp;<input type=\"checkbox\" name=\"copy$id\" value=\"$filename\"/>&nbsp;&lt;$filetype&gt;<a href=\""
           .hostpath()."copy.php?todir=$todir&path=$urlfilename/\" title=\"进入目录\">$filename</a><hr>\n";
	      }else{
	       $filesize = newfilesize($filename_old);
	       echo "$id&nbsp;<input type=\"checkbox\" name=\"copy$id\" value=\"$filename\"/>&nbsp;&lt;$filetype&gt;$filename(<font color=\"blue\">$filesize</font>)<hr>\n";
	      }
          
	   }
       echo "注意:此操作会覆盖掉原有文件!<br />\n<input type=\"submit\" value=\"开始复制！\">\n";
    }
    appmenu();
    appfooter();
?>