<?php
include_once ('config.php');
$path = @$_GET['path'];
if($path==null)$path=dirname(rootpath())."/";
if (!@file_exists($path)) {//�ж�·�����
echo "��·��\"$path\"�����ڻ��޷���Ȩ�ޣ�";
appfooter();
}
$utf8path=mb_convert_encoding($path,'UTF-8',$system_coding);















?>