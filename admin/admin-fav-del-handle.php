<?php
require_once('../connect.php');
$id=intval($_GET['id']);
$deletefavsql="DELETE FROM fav WHERE id=$id;";
if(mysqli_query($conn,$deletefavsql)){
	echo("<script>alert('删除收藏站点成功！');window.location.href='admin-manage.php';</script>");
}else{
	echo("<script>alert('未知错误！');history.back();</script>");
}
?>
