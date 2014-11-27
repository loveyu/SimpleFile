<?php
#引用自hu60
/*过程：把GET,POST,COOKIE中引号被加上的反斜线去掉，并关闭在执行中的引号转义*/
ini_set('magic_quotes_runtime',0);
if(ini_get('magic_quotes_gpc'))
 define('STRIP_QUOTES_FUNC','stripslashes');
elseif(ini_get('magic_quotes_sybase'))
 define('STRIP_QUOTES_FUNC','strip2quote');
else
 return;
$_GET=array_map(STRIP_QUOTES_FUNC,$_GET);
$_POST=array_map(STRIP_QUOTES_FUNC,$_POST);
$_COOKIE=array_map(STRIP_QUOTES_FUNC,$_COOKIE);
$_REQUEST=array_map(STRIP_QUOTES_FUNC,$_REQUEST);
/*$_FILES=array_map(STRIP_QUOTES_FUNC,$_FILES); //手册说$_FILES不会被转义，所以注释掉了*/
function strip2quote($str)
{
return str_replace("''","'",$str);
}
?>