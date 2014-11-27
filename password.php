<?php
$page_now="http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
$postpwd=@$_POST['pwd'];
if ($postpwd != null) {
if (md5($postpwd) == $password) {
    setcookie('fm:pwd',md5($postpwd),time()+60*60*24*7);
    die("<html>\n<title>password ok!</title>\n<meta http-equiv=\"refresh\" content=\"2;URL=$page_now\">\n<font color=\"blue\">Password has been saved, two seconds after the jump.</font>\n</html>");
}else{
    die("<html>\n<title>error</title>\n<font color=\"red\">password error!</font>&nbsp;<a href=\"$page_now\">return</a>\n</html>");
}
}
if (@$_COOKIE['fm:pwd'] != $password) {
echo "<html>\n<title>Please enter your password!</title>\n<h1><font color=\"blue\">Please enter you password!</font></h1>
<form method=\"post\">\n<input type=\"password\" name=\"pwd\"/>
<input type=\"submit\" value=\"Enter\"/>
</form>\n</html>";
exit;
}
if (@$_GET['action'] == "logout") {
setcookie('fm:pwd', null);
setcookie('fm:da',null);
echo "<html>\n<title>jumping...</title>\n<meta http-equiv=\"refresh\" content=\"2;URL=$page_now\">
<font>Cookie has been deleted, the page refreshes automatically after two seconds.</font>\n</html>";
exit;
}
?>