<?php
require_once('../connect.php');
$id=$_POST['id'];
$description=$_POST['description'];
$imgupdate="UPDATE img SET description='$description' WHERE id=$id;";
if(!empty($_POST['description'])){
	if(mysqli_query($conn,$imgupdate)){
		echo "<script>alert('修改成功！');history.back();</script>";
	}else{
		echo "<script>alert('修改失败！');</script>";
	}
}
else{
	echo"<script>alert('赐予照片一段文字吧！');history.back();</script>";
}