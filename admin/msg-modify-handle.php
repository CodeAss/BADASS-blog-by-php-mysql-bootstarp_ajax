<?php
require_once('../connect.php');
$id=$_POST['id'];
$content=$_POST['content'];
if(empty($content)){
	echo "<script>alert('留言内容不能为空！');history.back();</script>";
	return false;
}
$sql="UPDATE msgbd set content='$content' WHERE id=$id;";
if(mysqli_query($conn,$sql)){
	echo "<script>alert('修改留言成功！');window.location.href='admin-manage.php';</script>";
}else{
	echo "<script>alert('数据库错误！');history.back();</script>";
}
mysqli_close($conn);
?>
