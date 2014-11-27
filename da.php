<?php include_once('config.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $appname; ?></title>
<link rel="stylesheet" type="text/css" href="./js/style.css">
<script type="text/javascript" src="./js/img.js"></script>
<script type="text/javascript" src="./js/IMG_TOOLTIP.js"></script>
<script type="text/javascript" src="./js/IMG_MAINJS.js"></script>
<script type="text/javascript" src="./js/IMG_JS_CHARTS.js"></script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="/CSS_STYLES_IE">
<![endif]-->
</head>
<body bgcolor="#FFFFFF" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0" onload="javascript:TB_unload();" onbeforeunload="javascript:TB_load();">
<center>
<div id="mail_frame" align="center">
  <div id="pageloading" style="display: none; ">载入中...</div>
  <div id="main_top" style="height: 65px !important;">
    <div style="height:40px;">
      <div id="top_user">
        <a href="index.php">主页</a> | <a href="?action=logout">登出</a>
        <br />
        欢迎访问 <a href="http://www.loveyu.org/"><b>恋羽日记</b></a>
      </div>
      <div id="top_logo" style="color:#fff;font-size;14px;font-weight:bold;padding-top:10px;padding-left:4px;height: 35px !important;">文件管理器</div>
    </div>
    <div style="height:25px;" align="left">
      <div id="top_menu">
        <a href="index.php" class="lhome">主页</a>
        <a href="modify.php?path=config.php&coding=UTF-8" class="lpass" style="opacity: 0.8; height: 25px; margin-top: 0px; line-height: 25px; display: block; ">密码</a>
        <a href="cmd.php" target="_blank" class="lhelp">执行代码</a>
		<a href="simple.php" class="lhome">原始面板</a>
		<a href="index.php?da=1" class="lhome">首页切换</a>
      </div>
    </div>
  </div>
  <div id="main_contents">
<div id="centerPanel" class="table100">
<?php
$path = @$_GET['path'];//获取请求文件夹的系统编码目录名
if ($path==null)$path=dirname(rootpath()).'/';//当目录请求为空时指定一个目录为上级目录
if (!@file_exists($path)) {//判断路径是否可用，否则直接退出
$nopross="&nbsp;&nbsp;<font color=red>该路径\"$path\"不存在或无访问权限！</font>";
}else{
$nopross=null;
}
$lastpath=rawurlencode(dirname($path));//获取上级目录名，并转换为url编码
$filedata = glob("$path"."*");//获取原始目录数组
$path=mb_convert_encoding($path,'UTF-8',$system_coding);//将目录由系统编码转换为UTF-8编码
$filedata=@array_coding_to_utf8($filedata,$system_coding);//转换文件数组
$imagearray=array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG','bmp','BMP','RGB','rgb');//建立一个图片后缀数组
$textarray=array('php','js','css','asp','txt','php5','sh','bat','c','html','htm','conf','config',,,'wml','xhtml','xhtm','log','ini','inc','con','cfg','jsp','phtml','java','xml','bsh','py','pm','pl','sql','vb','vbs','tex','nfo');//建立一个图片后缀数组
?>
  <div class="pageTit"><span>文件管理</span>» <a class="tree" href="index.php">文件管理</a> » <a class="tree" href=""><?php echo $path?></a><?php echo $nopross?></div>

  <div id="tfiles" style="margin-bottom: 15px;">
    <table class="list" cellpadding="3" cellspacing="0">
<script type="text/javascript"> 
<!--
function selectAll(select)
{
	with (document.tableform)
	{
		var checkval = false;
		var i=0;
 
		for (i=0; i< elements.length; i++)
			if (elements[i].type == 'checkbox' && !elements[i].disabled)
				if (elements[i].name.substring(0, select.length) == select)
				{
					checkval = !(elements[i].checked);	break;
				}
 
		for (i=0; i < elements.length; i++)
			if (elements[i].type == 'checkbox' && !elements[i].disabled)
				if (elements[i].name.substring(0, select.length) == select)
					elements[i].checked = checkval;
	}
}
// -->
</script> 
 
<form name="tableform" action='da.action.php' method='post'>
	
<tr><td align="right" colspan="9"><a class="toptext" href="#search">高级搜索</a></td></tr>

<tr><td class="footer" width="1%"><b><a class="listtitle" href="#">类型</a></b></td>
<td class="footer"><a class="listtitle" href="?sort1=2">名称</a></td>
<td class="footer"><a class="listtitle" href="?sort1=3">大小</a></td>
<td class="footer"><a class="listtitle" href="?sort1=4">权限</a></td>
<td class="footer"><a class="listtitle" href="?sort1=5">动作</a></td>
<td class="footer"><a class="listtitle" href="?sort1=6">日期</a></td>
<td class="footer"><a class="listtitle" href="?sort1=7">UID</a></td>
<td class="footer"><a class="listtitle" href="?sort1=8">GID</a></td>
<td class="footer" align="center" width="1%"><a class="listtitle" href="javascript:selectAll('select');">选择</a></td>
</tr>

<tr class="trList">
 <td class="list"><a href="?path=<?php echo $lastpath ?>/"><img alt="Directory" src="./js/folder.jpg" border="0"></a></td>
 <td class="list"><a href="?path=<?php echo $lastpath ?>/">../ 返回上级</a></td>
 <td class="list"><a href="未知连接"></a>大小暂不计算</td>
 <td class="list"><?php echo substr(sprintf('%o', @fileperms(dirname($path))), -4)?></td>
 <td class="list"></td>
 <td class="list"><a href="?path=<?php echo $lastpath ?>"></a><span style="font-size:8pt;"><?php echo @date("Y年m月d日.H:i.s",@filemtime(dirname($path)))?></span></td>
 <td class="list"><?php echo @fileowner(dirname($path))?></td>
 <td class="list"><?php echo @filegroup(dirname($path))?></td>
 <td class="list" align="center"></td>
</tr>
<?php
foreach ($filedata as $id => $filename) {//历遍数组
    $filename_old=mb_convert_encoding($filename,$system_coding,'UTF-8');//将文件名转换为系统编码
    $urlfilename=rawurlencode($filename_old);//由系统编码转换为url编码
    $filetype = filetype($filename_old);//获取文件类型呢
    $perms = substr(sprintf('%o', fileperms($filename_old)), -4);//获取文件权限
	if (PHP_OS!='WIN32' && PHP_OS!='WINNT'){
	$fileowner=@posix_getpwuid(@fileowner($filename_old));
	$filegroup=@posix_getpwuid(@filegroup($filename_old));
	}
if($filetype=='dir'){?>
<tr class="trList hover">
  <td class="list2"><a href="?path=<?php echo $urlfilename?>/"><img alt="Directory" src="./js/folder.jpg" border="0"></a></td>
  <td class="list2"><a href="?path=<?php echo $urlfilename?>/"><?php echo basename($filename)?></a></td>
  <td class="list2"><a href="未知连接"></a>大小暂不计算</td>
  <td class="list2"><?php echo $perms?></td>
  <td class="list2"><a href="zip3.php?path=<?php echo $filename?>">压缩</a><br><a href="rename.php?one=0&path=<?php echo $filename?>">重命名</a> | <a href="copy3.php?path=<?php echo $filename?>">复制</a> | <a href="delete.php?path=<?php echo $filename?>">删除</a></td>
  <td class="list2"><a href=""></a><span style="font-size:8pt;"><?php echo @date("Y年m月d日.H:i.s",@filemtime($filename_old))?></span></td>
  <td class="list2"><?php echo @$fileowner['name']?></td>
  <td class="list2"><?php echo @$filegroup['name']?></td>
  <td class="list2" align="center"><input type="checkbox" name="select<?php echo $id?>" value="<?php echo $filename ?>"></td>
</tr>
<?php
}}//历遍数组结束?>

<?php
foreach ($filedata as $id => $filename) {//历遍数组
    $filename_old=mb_convert_encoding($filename,$system_coding,'UTF-8');//将文件名转换为系统编码
    $urlfilename=rawurlencode($filename_old);//由系统编码转换为url编码
    $filetype = filetype($filename_old);//获取文件类型呢
    $perms = substr(sprintf('%o', fileperms($filename_old)), -4);//获取文件权限
	$newfilesize=newfilesize($filename_old);
	$pathinfo=pathinfo($filename_old);//获取文件信息
    $fileext=@$pathinfo['extension'];//获取文件后缀
	if (PHP_OS!='WIN32' && PHP_OS!='WINNT'){
	$fileowner=@posix_getpwuid(@fileowner($filename_old));
	$filegroup=@posix_getpwuid(@filegroup($filename_old));
	}
if($filetype!='dir'){?>
<tr title="大小: <?php echo filesize($filename_old)?>

磁盘空间使用情况: <?php ?>

上次访问: <?php echo @date("Y年m月d日.H:i.s",@fileatime($filename_old))?>

上次修改: <?php echo @date("Y年m月d日.H:i.s",@filemtime($filename_old))?>

上次创建: <?php echo @date("Y年m月d日.H:i.s",@filectime($filename_old))?>
" class="trList">
 <td class="list2"><a href="dl.php?path=<?php echo $filename?>"><img border="0" alt="File" src="js/file.jpg"></a></td>
 <td class="list2"><a href="dl.php?path=<?php echo $filename?>"><?php echo basename($filename)?></a></td>
 <td class="list2"><a href="未知连接"></a><?php echo $newfilesize?></td>
 <td class="list2"><?php echo $perms?></td>
 <td class="list2"><?php
if($fileext=='zip'){?><a href="unzip2.php?path=<?php echo rawurlencode($filename)?>&form=da">解压</a> | <?php }
if(in_array($fileext,$textarray)){?><a href="modify.php?path=<?php echo $filename?>&coding=UTF-8" title="编辑文档">编辑</a> | <a href="readfile.php?path=<?php echo $filename?>&coding=UTF-8" title="查看文档">查看</a> | <?php }
if(in_array($fileext,$imagearray)){?><a href="readfile.php?path=<?php echo $filename?>&type=image&coding=UTF-8" title="查看图片">查看图片</a> | <?php }?>
<a href="zip3.php?path=<?php echo $filename?>&onefsf0">压缩</a><br>
<a href="rename.php?path=<?php echo $filename?>&one=0">重命名</a> | <a href="copy3.php?path=<?php echo $filename?>&ccfgb">复制</a> | 
<a href="delete.php?path=<?php echo $filename?>&ofhgg">删除</a>
 </td>
 <td class="list2"><a href=""></a><span style="font-size:8pt;"><?php echo @date("Y年m月d日.H:i.s",@filemtime($filename_old))?></span></td>
  <td class="list2"><?php echo @$fileowner['name']?></td>
  <td class="list2"><?php echo @$filegroup['name']?></td>
 <td class="list2" align="center"><input type="checkbox" name="select<?php echo $id?>" value="<?php echo $filename?>"></td>
</tr>
<?php }}?>


<tr>
<td class="footer" align="right" colspan="9">
<input name="path" type="hidden" value="<?php echo $path ?>">
选中 &nbsp;|&nbsp;
<input type="text" size="15" name="zippath" value="<?php echo $path ?>new.zip">
<input type="button" value="压缩" onclick="if (confirm(&#39;你确定要压缩这些文件么?&#39;)){document.tableform.button.value = &#39;zip&#39;;document.tableform.submit();	}" class="boton">&nbsp;|&nbsp;

<input type="button" value="逐一改名" onclick="if (confirm(&#39;你确定要逐一改名文件么?&#39;)){document.tableform.button.value = &#39;oneonerename&#39;;document.tableform.submit();	}" class="boton">&nbsp;|&nbsp;

文件:<input type="text" name="filechmod" size="3" value="0644" maxlength="3" onfocus="document.tableform.button.value = &#39;permission&#39;; this.select();" class="combo">
目录:<input type="text" name="dirchmod" size="3" value="0755" maxlength="3" onfocus="document.tableform.button.value = &#39;permission&#39;; this.select();" class="combo">
<input type='checkbox' name='recursive' value='yes' />递归&nbsp;
<input type='checkbox' name='postshow' value='1' />过程&nbsp;
<input type="submit" value="修改权限" class="boton" onclick="if (confirm(&#39;你确定要修改这些文件的权限么?&#39;)){document.tableform.button.value = &#39;mod&#39;;document.tableform.submit();	}">&nbsp;<b>|</b>&nbsp;

<input type="button" value="删除" onclick="if (confirm(&#39;你确定要删除这些文件么?&#39;)){document.tableform.button.value = &#39;delete&#39;;document.tableform.submit();	}" class="boton">

<input type="hidden" name="button" value="">
<br>
</form>
</td>
</tr>
</table>

  </div>
  
<table class="list" cellpadding="3" cellspacing="0">
  <tr><td class=listtitle colspan=4 id="nowdir">文件系统工具</td></tr>
  <tr class="trList">
  <form name="folderform" action="newdir2.php" method="post"><input type="hidden" name="path" value="folder"><input type="hidden" name="path" value="<?php echo $path?>">
    <td class="list">创建文件夹</td><td class="list">
	<input type="text" name="name" size="15" class="combo">
	<input type="submit" value="创建" class="boton">
  </form>
    </td>
  
  <form name="fileform" action="newfile.php" method="post">
  <input type="hidden" name="action" value="file">
  <input type="hidden" name="filedir" value="<?php echo $path?>">
  <td class="list">创建文件</td>
  <td class="list">
  <input type="text" name="newfilename" size="15" class="combo">
  <input type="submit" name="file" value="创建" class="boton">
  </form>
  </td>

  </tr>
<tr class="trList">
<td class=list colspan=4 align=center>
 <form name="nowdiraction" action='da.action2.php' method='post'>
 <input type="hidden" name="path" value="<?php echo $path ?>">
 <a class="listtitle" href="#nowdir" title="<?php echo $path ?>" >当前目录操作：</a> | 
 <input name="rename1" type="text" size="10" value="<?php echo basename($path) ?>">
 <input type="submit" value="重命名" class="boton" onclick="if (confirm(&#39;你确定要重命名<?php echo $path?>?&#39;)){document.nowdiraction.button.value = &#39;rename&#39;;document.nowdiraction.submit();	}"> | 
 <input type="button" value="删除" onclick="location.href=&#39;delete.php?path=<?php echo $path ?>&#39;" class="boton"> | 
 <input size="4" type="text" name="mod" value="<?php echo substr(sprintf('%o', @fileperms(mb_convert_encoding($path,$system_coding,'UTF-8'))), -4)?>"><input type="hidden" name="ysmod" value="<?php echo substr(sprintf('%o', @fileperms(mb_convert_encoding($path,$system_coding,'UTF-8'))), -4)?>">
 <input type="submit" name="mod" value="权限(不循环)" class="boton" onclick="if (confirm(&#39;你确定要修改<?php echo $path?>的权限?&#39;)){document.nowdiraction.button.value = &#39;mod&#39;;document.nowdiraction.submit();	}"> | 
 <input type="button" value="压缩" onclick="location.href=&#39;zip3.php?path=<?php echo $path ?>&#39;" class="boton"> | 
 <input type="button" value="上传文件" onclick="location.href=&#39;upfile.php?path=<?php echo $path ?>&#39;" class="boton">
 <input type="hidden" name="button" value="">
 </form>
 </td>
</tr>
<tr class="trList">
<td class=list colspan=4 align=center>
 <form name="urldl" action='urldl.php' method='post'>
  <input type="hidden" name="filedir" value="<?php echo $path ?>">
  网址:<input name="url" type="text"> | 
  文件名(选填):<input name="filename" type="text"> | 
  <input type="submit" value="远程下载文件到此" class="boton">
 </form>
 </td>
</tr>
  </table>

  <div class="tip" style="margin-top:10px;">使用说明: 爱怎么用就怎么用，具体的我也写糊涂了！</div>
</div>
<script language="JavaScript" type="text/javascript">
<!--
$(function(){
  $("#tfiles table tr:eq(1) td:first, #tfiles table tr:eq(1) td:last").attr("width", "1%");
});
//-->
</script>


    <div class="cleft"></div><div class="cright"></div><div class="cf"></div>
  </div>
  <div id="main_bottom">
    <a class="white" href="http://www.loveyu.org/">恋羽日记</a> <?php echo $appname."($version)"?>
  </div>
</div>
</center>

<div id="tooltipHelper" style="position: absolute; z-index: 3000; display: none; ">
<div id="tooltipTitle">
</div>
<div id="tooltipURL">
</div>
</div>
</body>
</html>