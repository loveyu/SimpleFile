<?php
/**
 * zip压缩
 */
include_once ('config.php');
appheader('-zip压缩');
$path=$_POST['filedir'];
$zippath=$_POST['zippath'];
$sy_path=mb_convert_encoding($path,$system_coding,'UTF-8');
if(!chdir($sy_path)){
    echo "目录切换失败！";
}else{
    $filedata = glob("*");
    if(empty($filedata)){
    echo "该目录为空，或无访问权限！";
    }else{
        $filedata=array_coding_to_utf8($filedata,$system_coding);
        asort($filedata);
        echo "<SCRIPT LANGUAGE=\"JavaScript\">function ck(b)\n{\nvar input = document.getElementsByTagName(\"input\");\nfor (var i=0;i<input.length ;i++ )\n{\nif(input[i].type==\"checkbox\")\ninput[i].checked = b;\n}\n}\n</SCRIPT>\n<form method=\"post\" action=\"zip2.php?path=$path&zip=$zippath\">\n选择要压缩的文件和目录\n<input type=\"button\" onclick=\"ck(true)\" value=\"全选\">\n<input type=\"button\" onclick=\"ck(false)\" value=\"取消全选\">\n<hr>\n";
        foreach ($filedata as $id => $filename){
            $filename_old=mb_convert_encoding($filename,$system_coding,'UTF-8');
            $filetype = filetype($filename_old);
            $id+=1;
            if ($filetype == 'dir') {
                echo "$id&nbsp;<input type=\"checkbox\" name=\"$id\" value=\"$filename\"/>&nbsp;&lt;$filetype&gt;$filename<hr>\n";
                }else{
                    $filesize = newfilesize($filename_old);
                    echo "$id&nbsp;<input type=\"checkbox\" name=\"$id\" value=\"$filename\"/>&nbsp;&lt;$filetype&gt;$filename(<font color=\"blue\">$filesize</font>)<hr>\n";
                    }
        }
        echo "<input type=\"submit\" value=\"开始压缩到$zippath\">&nbsp;\n";
    }
}
appmenu();
appfooter();
?>