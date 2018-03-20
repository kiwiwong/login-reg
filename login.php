<?php
session_start();
header("Content-type:text/html;charset=utf-8");
$link = mysqli_connect('localhost','root','150462','login');  //链接数据库
 mysqli_set_charset($link ,'utf8'); //设定字符集 

$name=$_POST['name'];

$pwd=$_POST['pwd'];

$yzm=$_POST['yzm'];

    if($name==''){
        echo "<script>alert('请输入用户名');location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        exit;
    }
    if($pwd==''){

        echo "<script>alert('请输入密码');location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        exit;

    }

    if($yzm!=$_SESSION['VCODE']){

        echo"<script>alert('你的验证码不正确，请重新输入');location='".$_SERVER['HTTP_REFERER']. "'</script>";
        exit;

    }


    $sql_select="select id,username,password from user where username= ?";      //从数据库查询信息
    $stmt=mysqli_prepare($link,$sql_select);
    mysqli_stmt_bind_param($stmt,'s',$name);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $row=mysqli_fetch_assoc($result);

    if($row){

        if($pwd !=$row['password'] || $name !=$row['username']){

            echo "<script>alert('密码错误，请重新输入');location.href='login.html'</script>";
            exit;
        }
        else{
            $_SESSION['username']=$row['username'];
            $_SESSION['id']=$row['id'];
            if($_POST['remember']=="yes"){
            	setcookie("name",$name,time()+7*24*60*60);
				setcookie("code",md5($name . md5($pwd)),time()+7*24*60*60);
            }else{
            	setcookie("name","",time() - 1);
				setcookie("code","",time() - 1);
            }
            echo "<script>location.href='index.php'</script>";
        }

    }else{
        echo "<script>alert('您输入的用户名不存在');location.href='login.html'</script>";
        exit;
    };
?>