<?php
require_once('../connect.php');
//检测是否登录,如果有登录并未注销，则直接进入管理页面
	session_start();
	if(isset($_SESSION['username'])){
		echo "<script>window.location.href='admin-manage.php'</script>";
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>登陆到管理员操作页面</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>
<script type="text/javascript" src="../jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body style="padding-top:50px;">
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"  data-target="#bs-example-navbar-collapse-1" aria-expanded="false">  
			<span class="sr-only"></span>  
			<span class="icon-bar"></span>  
			<span class="icon-bar"></span>  
			<span class="icon-bar"></span>  
		</button>
		<a class="navbar-brand" href="../index.php">BADASS!</a>
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li class="dropdown"><a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">个人收藏 <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<?php
					$favsql="SELECT * FROM fav;";
					$favquery=mysqli_query($conn,$favsql);
					if($favquery==true){
						while($favdata=mysqli_fetch_array($favquery)){
					?>
					<li><a href="https://<?php echo $favdata['href'];?>" target="_blank"><?php echo $favdata['name'];?></a></li>
					<?php
						}
					}
					?>
					<li role="separator" class="divider"></li>
					<li class="disabled"><a href="">BADASS</a></li>
				</ul>
			</li>
			<li><a href="../about/about.php">关于本站</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a href="../index.php" title="返回到首页">
					<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
				</a>
			</li>
		</ul>

	</div>
</div>
</nav>

<div class="container" style="width:400px;margin-bottom:300px;">
	<div class="page-header ex-page-header">  
		<h1 class="title text-center">登录到管理系统</h1>  
	</div>
	<form class="form-horizontal">
		<div class="form-group">
			<label for="exampleInput" class="col-sm-3 control-label">管理员账号</label>
			<div class="col-sm-9">
				<input type="text" class="form-control input-small" id="username" placeholder="在此输入账号" />
				<p id="warning1" class="text-danger">请输入用户名！</p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">管理员密码</label>
			<div class="col-sm-9">
				<input type="password" id="password" class="form-control input-small" placeholder="password" />
				<p id="warning2" class="text-danger">请输入密码！</p>
			</div>
		</div>
		<button class="btn btn-default pull-right" id="zxcv">确认无误点此登陆</button>
	</form>
</div>
<!--ajax-->
<script>
$(document).ready(function(){
	$('#warning1').hide();
	$('#warning2').hide();
	$('#zxcv').click(function(){
		var usn=$('#username').val();
		var pwd=$('#password').val();
		
		if(usn==""){
			$('#warning2').hide();
			$('#warning1').show();
			$('#username').focus();
			return false;
		}
		if(pwd==""){
			$('#warning1').hide();
			$('#warning2').show();
			$('#password').focus();
			return false;
		}
		$.ajax({
			url:'admin-login-handle.php',
			type:'POST',
			data:{'username':usn,'password':pwd,},
			success:function(msg){
				if(msg==1){
					alert('登录成功！');
					window.location.href='admin-manage.php';
				}else{
					alert('用户名或密码错误！');
					window.location.href='admin-login.php';
				}
			},
		});
	});
});
</script>
<!--ajax结束-->

<footer class="container-fluid">
	<div class="container">
	<p class="text-center">Designed By BADASS!</p>
	<p class="text-center"></p>
	</div>
</footer>
</body>
</html>