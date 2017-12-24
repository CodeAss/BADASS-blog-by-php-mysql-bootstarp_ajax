<?php
require_once('../connect.php');
$id=$_GET['id'];
$sql="DELETE FROM msgbd WHERE id='$id';";
if(mysqli_query($conn,$sql)){
	echo "<script>alert('删除留言成功！');window.location.href='admin-manage.php'</script>";
}else{
	echo "<script>alert('未知错误！');history.back();</script>";
}
?>