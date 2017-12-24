<?php
require_once('../connect.php');
$ipname=$_POST['ipname'];
$content=$_POST['content'];
$dateline=time();
$sql = "INSERT INTO msgbd(ipname,content,dateline) values('$ipname','$content',$dateline)";
if(mysqli_query($conn,$sql)){
	echo '22';
}else{
	echo '23';
}

?>