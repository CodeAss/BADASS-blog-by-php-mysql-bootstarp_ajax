<?php
session_start();
unset($_SESSION['username']);
$result_dest = session_destroy();
if($result_dest){
	echo "<script>alert('注销成功！');window.location.href='../index.php'</script>";
}
else{
	echo"<script>alert('注销失败！');history.go(-1);</script>";
}
?>