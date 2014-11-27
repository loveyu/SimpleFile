<?php
include_once ('config.php');
appheader('-写邮件');
?>
<form method="post" action="mail.php">
主题：<input name="subject" type="text" value="<?php echo @$_GET['sub'];?>">(留空为收件人邮箱名)<br />
收件人邮箱：<input name="mail" type="text" value="<?php echo @$_GET['mail'];?>">(<font color="red">必须</font>)
姓名：<input name="name" type="text">(选填)<br />
发件人邮箱：<input name="email_from" type="text">(<font color="red">必须</font>)
姓名：<input name="email_from_name" type="text"><br />
回复地址：<input name="email_reply" type="text">(<font color="red">必须</font>)
姓名：<input name="email_reply_name" type="text"><br />
附件：<input name="Attachment" type="text" value="<?php echo @$_GET['file'];?>">(选填，请输入服务器单个文件路径)<br />
内容：(<font color="red">必须</font>)<br />
<textarea rows="10" cols="60" name="body" type="text" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('Submit').click();return false};"><?php echo @$_GET['body'];?>
</textarea><br />
<select name="type">
<option value="mail">直接发送</option>
<option value="sendmail">Sendmail方式</option>
<option value="smtp">SMTP方式</option>
</select>
<input id="Submit" type="submit" value="发送"><br /><hr>
当前SMTP服务器设置:<br />
主机：<?php echo $stmp_host?><br />
端口：<?php echo $smtp_port?><br />
方式：<?php echo $smtp_ssl?><br />
用户：<?php echo $smtp_username?>
<?php
if($smtp_password==null)echo "<br />\n密码：当前密码为空！";
?>
<hr>
<?php
appmenu();
appfooter();
?>