<?php
header("Content-type:text/html;charset=utf-8");
session_start();
//清除session
$name = $_SESSION['username'];
$_SESSION = array();
session_destroy();
//清除cookie
setcookie("name",'',time() - 1);
setcookie("code",'',time() - 1);
echo $name . "，欢迎下次光临！";
echo "重新<a href='login.html'>登录</a>";

?>