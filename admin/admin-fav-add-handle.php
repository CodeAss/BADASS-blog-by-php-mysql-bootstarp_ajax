<?php
require_once('../connect.php');
$name=$_POST['name'];
$href=$_POST['href'];
if(empty($name) || empty($href)){
	echo("<script>alert('名称或URL地址为空！');</script>");
}else{
	$addfavsql="INSERT INTO fav(name,href) values('$name','$href')";
	if(mysqli_query($conn,$addfavsql)){
		echo("<script>alert('添加收藏站成功！');window.location.href='admin-manage.php';</script>");
	}else{
		echo("<script>alert('未知错误');window.location.href='admin-manage.php';</script>");
	}
}
?>
