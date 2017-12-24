<?php 
//链接数据库
$conn = mysqli_connect('localhost','root','root');//数据库帐号密码为安装数据库时设置
header("Content-type:text/html;charset=utf-8");
if(mysqli_errno($conn)){
	echo mysqli_errno($conn);
	exit;
}
mysqli_select_db($conn,"myblog");
mysqli_set_charset($conn,'utf8'); 
?>