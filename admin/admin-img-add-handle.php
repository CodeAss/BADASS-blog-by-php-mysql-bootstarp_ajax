<?php
 require_once('../connect.php');
  if(empty($_FILES['img']['tmp_name'])){
	  echo "<script>alert('未选择文件！');history.back();</script>";
	  return;
  }
  $file=$_FILES['img'];
  $imgtype=array(
  'image/jpg',
  'image/jpeg',
  'image/png',
  'image/pjpeg',
  'image/gif',
  'image/bmp',
  'image/x-png',
  );
  if($file['size']>10000000){
	  echo "<script>alert('照片超出范围，重新选择!');history.back();<script>";
		  return;
  }
  if(!in_array($file['type'],$imgtype)){
	  echo "<script>alert('类型不符！重新选择');history.back();</script>";
	  return;
  }
  if(empty($_POST['description'])){
	  echo"<script>alert('赐予照片一段文字吧！');history.back();</script>";
	  return;
  }
  $path=$file['name'];//.'.'.$file['type'];
  $folder='C:/wamp64/www/admin/img/';
  echo $path;
  if(move_uploaded_file($file['tmp_name'],$folder.$path)){
		  $description=$_POST['description'];
	      $dateline=time();
		  $filepath='img/'.$path;
		  $imgname=$file['name'];
	      $insertsql="INSERT INTO img(description,dateline,path,img_name) values('$description','$dateline','$filepath','$imgname');";
		  if(mysqli_query($conn,$insertsql)){
			  echo "<script>alert('添加照片成功！');window.location.href('admin-manage.php');</script>";
		  }else{
			  echo "<script>alert('上传失败！');history.back();</script>";
		  }
  }else{
	  echo "<script>alert('移动文件出错！');</script>";
	  exit;//;history.back()
  }
 ?>