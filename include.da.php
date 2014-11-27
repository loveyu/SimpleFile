<?
$page_now2="http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];
if(@$_GET['da']=="1"){
if($_COOKIE['fm:da']==null)setcookie('fm:da',"1",time()+60*60*24*7);
else setcookie('fm:da',null);
die("<meta http-equiv=\"refresh\" content=\"0;URL=$page_now2\">");
}
if(@$_COOKIE['fm:da']==null){
include_once('da.php');
exit;
}
?>