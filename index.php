<?php
header("Content-type:text/html;charset=utf-8");
session_start();
//判断cookie是否记住用户信息
if (isset($_COOKIE['name'])) {
	$_SESSION['username'] = $_COOKIE['name'];
	$_SESSION['islogin'] = 1;
}
if (isset($_SESSION['islogin'])) {
	//已经登录
	echo $_SESSION['username'] . "，你好，欢迎来到个人中心！<br/>";
	echo "<a href='logout.php'>注销</a>";
} else {
	//未登录
	echo "您还未登录，请<a href='login.html'>登录</a>";
}
?>