<?php  
    require_once('../connect.php');  
    //把传递过来的信息入库，在入库之前对所有的信息进行校验。  
    //print_r($_POST);  
  
    if(!isset($_POST['title']) || empty($_POST['title'])) {  
        echo "<script>alert('标题不能为空'); window.history.go(-1);</script>";  
        mysql_close($conn);  
        exit;  
    }
	else{
		$id = $_POST['id'];  
		$title = $_POST['title'];  
		$author = $_POST['author'];  
		$description = $_POST['description'];  
		$content = $_POST['content'];   
	
		$updatesql = "update article set title = '$title',author = '$author',description = '$description',content = '$content' where id=$id";  
		//echo $updatesql;  
		
		if(mysqli_query($conn,$updatesql)) {  
			echo "<script>alert('修改文章成功'); window.location.href='admin-manage.php'</script>";   
		} else {  
			echo "<script>alert('修改文章失败'); window.location.href='admin-manage.php'</script>";  
		}
	}
    mysql_close($conn);  
?>  