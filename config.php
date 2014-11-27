<?php
/**
 * @version 1.0
 * @aouther loveyu
 * @email admin@loveyu.info
 * @website http://www.loveyu.org
 * @link http://www.loveyu.org/1415.html
 *
 */
set_time_limit(0);//设置超时时间，0为不限，服从系统设置
//error_reporting(E_ALL ^ E_NOTICE);//不提示NOTICE消息
error_reporting(E_ALL);//提示所有消息
$password=md5('123456');//设置密码的MD5值
$appname = 'PHP文件管理';//程序名
$version = '2.02';//程序版本
$httpdownmax = '20971520';//远程下载文件最大文件限制B，20M=20971520B
$max_up_number='20';//一次最多允许上传的文件个数
date_default_timezone_set('PRC');//设置时区，当前为北京时间
if (PHP_OS=='WIN32' || PHP_OS=='WINNT')$system_coding='GBK';//判断系统类型，并以此判断系统编码
else $system_coding='UTF-8';
include_once('class.runtime.php');//包含程序执行时间类
$runtime= new runtime;//开始计时类
$runtime->start();//计时
include_once ('strip_quotes_gpc.sub.php');//包含将提交信息中的转移符号去掉
include_once ('password.php');//包含密码文档
include_once ('function.php');//包含函数文件
?>