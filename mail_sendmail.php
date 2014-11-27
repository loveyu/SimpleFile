<?php
include_once ('config.php');
appheader('-SMTP邮件发送状态');
require_once('class.phpmailer.php');
include("class.smtp.php");
$mail = new PHPMailer(true);
$mail->IsSendmail();
try {
$mail->AddReplyTo($email_reply,$email_reply_name);
$mail->AddAddress($email_to,$email_to_name);
$mail->SetFrom($email_from,$email_from_name);
$mail->Subject = $Subject;
$mail->MsgHTML($email_body);
if($email_Attachment!=null){
$email_Attachment=mb_convert_encoding($email_Attachment,$system_coding,'UTF-8');
if(!is_file($email_Attachment)){
echo "\"$email_Attachment\"不是一个正确的文件！没有发送附件！";
}else{
if(filesize($email_Attachment)>50000000)echo "文件过大，附件未发送！";
else $mail->AddAttachment($email_Attachment);
}
}
$mail->Send();
echo $successfully_info;
} catch (phpmailerException $e) {
echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
echo $e->getMessage(); //Boring error messages from anything else!
}
appmenu();
$runtime->stop();
echo "<hr>页面执行时间: ".$runtime->spent()."秒.\n";
appfooter();
?>

