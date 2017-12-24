<?php  
    require_once('../connect.php');  
  
    if(!isset($_POST['title']) || empty($_POST['title'])) {  
        echo "<script>alert('标题不能为空'); window.location.href='admin-manage.php'</script>";  
    }
	else{
		$title = $_POST['title'];  
		$author = $_POST['author'];  
		$description = $_POST['description'];  
		$content = $_POST['content'];  
		$dateline = time();  
		$insertsql = "insert into article(title,author,description,content,dateline) values('$title','$author','$description','$content',$dateline);";  
		//echo $insertsql;  
		if(mysqli_query($conn,$insertsql)) {  
			echo "<script>alert('发布文章成功');window.location.href='admin-manage.php';</script>";   
		} 	else {  
			echo "<script>alert('发布文章失败');window.location.href='admin-manage.php';</script>";  
		}  
	}
    mysql_close($conn);  
?>  