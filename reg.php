<?php
session_start();
header("Content-type:text/html;charset=utf-8");
$link = mysqli_connect('localhost','root','150462','login');
mysqli_set_charset($link,'utf8'); //设定字符集
$name=$_POST['name'];
$pwd=$_POST['pwd'];
$pwdconfirm=$_POST['pwdconfirm'];
$yzm=$_POST['yzm'];
if($name==''){
    echo"<script>alert('你的用户名不能为空，请重新输入');location='".$_SERVER['HTTP_REFERER']. "'</script>";
    exit;
}
if($pwd==''){
    echo"<script>alert('你的密码不能为空，请重新输入');location='".$_SERVER['HTTP_REFERER']. "'</script>";
    exit;
}
if($pwd != $pwdconfirm){
    echo"<script>alert('你输入的两次密码不一致，请重新输入');location='".$_SERVER['HTTP_REFERER']. "'</script>";
    exit;
}
if($yzm!=$_SESSION['VCODE']){
    echo"<script>alert('你的验证码不正确，请重新输入');location='".$_SERVER['HTTP_REFERER']. "'</script>";
    exit;
}
$insert_sql="insert into user(username,password)values(? , ? )";
$stmt=mysqli_prepare($link,$insert_sql);
mysqli_stmt_bind_param($stmt,'ss',$name,$pwd);
$result_insert=mysqli_stmt_execute($stmt);
if($result_insert){
    echo "<script>alert('您已注册成功，返回登录');location='login.html'</script>";
    exit;
}else {
    echo "<script>alert('您输入的用户名已存在,请重新注册！');location='reg.html'</script>";
    exit;
}
?>