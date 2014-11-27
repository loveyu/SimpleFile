<?php
function clean_post_more(){
unset($_POST['filechmod']);
unset($_POST['dirchmod']);
unset($_POST['recursive']);
unset($_POST['button']);
unset($_POST['postshow']);
unset($_POST['path']);
unset($_POST['zippath']);
}
if($_POST['button']=='zip'){
$path=$_POST['path'];
$zippath=$_POST['zippath'];
clean_post_more();
foreach($_POST as $id => $name){
$_POST["$id"]=basename($name);
}
include_once('zip2.php');
}
if($_POST['button']=='delete'){
clean_post_more();
include_once('delete.php');
}
if($_POST['button']=='mod'){
$postfilemod=$_POST['filechmod'];
$postdirmod=$_POST['dirchmod'];
$postre=@$_POST['recursive'];
$postshow=@$_POST['postshow'];
clean_post_more();
include_once('xchmod.php');
}
if(@$_POST['button']=='oneonerename'){
clean_post_more();
include_once('rename.php');
}
$page_from=@$_SERVER['HTTP_REFERER'];
if($page_from!=null)echo "<meta http-equiv=\"refresh\" content=\"0;URL=$page_from\">";
else echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
?>
