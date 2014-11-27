<?php
if(@$_POST['rename1']!=basename(@$_POST['path']) && @$_POST['button']=='rename'){
@$_GET=array('rename1' => @$_POST['path']);
@$_POST=array('rename1' => @$_POST['rename1']);
include_once('rename2.php');
}
if(@$_POST['mod']!=@$_POST['ysmod'] && @$_POST['button']=='mod'){
$_GET=array('0' => @$_POST['path']);
$_POST=array('0' => @$_POST['mod']);
include_once('chmod2.php');
}
$page_from=@$_SERVER['HTTP_REFERER'];
if($page_from!=null)echo "<meta http-equiv=\"refresh\" content=\"0;URL=$page_from\">";
else echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
?>