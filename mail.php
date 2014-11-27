<?php
include_once ('config.php');
$email_to=@$_POST['mail'];
$email_to_name=@$_POST['name'];
$Subject=@$_POST['subject'];
$email_body=@$_POST['body'];
$email_Attachment=@$_POST['Attachment'];
if($email_to_name==null)
$to_mail_and_name=$email_to;
else $to_mail_and_name="$email_to_name($email_to)";
if($Subject==null)$Subject_info="\"空\"";
else $Subject_info=$Subject;
$successfully_info="此邮件已经发送给$to_mail_and_name ，主题为$Subject_info 。";
$email_reply=@$_POST['email_reply'];
$email_reply_name=@$_POST['email_reply_name'];
$email_from=@$_POST['email_from'];
$email_from_name=@$_POST['email_from_name'];
if($_POST['type']=='smtp')
include_once ('mail_smtp.php');
if($_POST['type']=='mail')
include_once ('mail_simply.php');
if($_POST['type']=='sendmail')
include_once ('mail_sendmail.php');
?>