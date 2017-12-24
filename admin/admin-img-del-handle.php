<?php
require_once('../connect.php');
$id=$_GET['id'];
$deleteimg="DELETE FROM img WHERE id='$id'";
if(mysqli_query($conn,$deleteimg)){
	echo "<script>alert('删除成功！');history.back();</script>";
}else{
	echo "<script>alert('删除失败！');</script>";
}
?>