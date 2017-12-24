<?php
require_once('../connect.php');
$id=$_POST['id'];
$name=$_POST['name'];
$href=$_POST['href'];
if(empty($name) || empty($href)){
	echo("<script>alert('名称或URL链接为空！');window.location.href='admin-manage.php';</script>");
	return;
}else{
	$modifyfovsql="UPDATE fav set name='$name',href='$href' WHERE id=$id;";
	if(mysqli_query($conn,$modifyfovsql)){
		echo("<script>alert('修改收藏站成功！');window.location.href='admin-manage.php';</script>");
	}else{
		echo("<script>alert('未知错误！');history.back();</script>");
	}
}
?>