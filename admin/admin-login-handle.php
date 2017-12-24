<?php
require_once('../connect.php');
//获取输入的信息
$username = $_POST['username'];
$password = md5($_POST['password']);
//获取session的值
include('../connect.php');
$sql="select * from admin where username='$username' and password='$password'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)){
	//登录成功
	session_start();
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $password;
	echo '1';
}else{
	//登录失败
	echo '0';
}
 mysqli_close($conn);
?>