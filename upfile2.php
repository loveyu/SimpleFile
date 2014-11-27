<?php
include_once ('config.php');
appheader('-上传文件',"-状态");
$namelist = $_POST;
$path=@$_GET['path'];
if(isset($_FILES['upfile'])){
    $file_number='0';
    foreach($_FILES['upfile']['name'] as $id => $name){
        $file_number+=1;
}
   for($i=0;$i<$file_number;$i++){
    if($_FILES['upfile']['error'][$i]==0){
        $postfname=$_POST["filename"."$i"];
        $local_name=$_FILES['upfile']['name'][$i];
        if ($postfname!=null)$name=mb_convert_encoding($path.$postfname,$system_coding,'UTF-8');
        else $name=mb_convert_encoding($path.$local_name,$system_coding,'UTF-8');
        if(!file_exists($name)){
            if(move_uploaded_file($_FILES['upfile']['tmp_name'][$i],$name)){
                echo "文件\"$local_name\"上传成功！保存为\"".mb_convert_encoding($name,'UTF-8',$system_coding)
                ."(<font color=blue>".newfilesize($name)."</font>)\"。<hr>\n";
               }else{
                   echo "<font color=red>上传文件\"$local_name\"保存失败，未知错误！</font><hr>\n";
                   }    
        }else{
            if(is_file($name))echo "<font color=red>上传文件\"$local_name\"保存失败，\"$name\"文件已存在！</font><hr>\n"; 
        }
             
             
              }
            }
}else{
    echo "没有上传文件！\n";
}
appmenu();
$runtime->stop();
echo "<hr>页面执行时间: ".$runtime->spent()."秒.\n";
appfooter();
?>