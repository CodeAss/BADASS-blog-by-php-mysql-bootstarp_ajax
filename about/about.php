<?php
require_once('../connect.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>关于本站</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>
<script type="text/javascript" src="../jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body style="padding-top:70px;">
<nav class="navbar navbar-inverse navbar-fixed-top" style="margin-bottom:0px;">
<div class="container">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"  data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="../index.php" title="BADASS!">BADASS!</a>
	</div>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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
			<li><a href="#">关于本站</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a href="../admin/admin-login.php" title="管理员登陆">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</a>
			</li>
		</ul>
	</div>
</div>
</nav>

<div class="container" style="margin-bottom:400px;">
	<ul id="mytab" class="nav nav-tabs nav-justified">
		<li role="presentation" class="active"><a href="#关于博客">关于本站</a></li>
		<li role="presentation"><a href="#关于作者">关于作者</a></li>
		<li role="presentation"><a href="#友情链接">友情链接</a></li>
		<!--<li role="presentation"><a href="#"></a></li>-->
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane fade in active" id="关于博客" role="tabpanel">
			<div class="page-header">
				<h4 class="text-center">本站信息</h4>
			</div>
			<div class="text-center">
				<p>本站采用bootsrap前端，php+mysql后端。</p>
			</div>
		</div>
		<div class="tab-pane fade" id="关于作者" role="tabpanel">
			<div class="page-header">
				<h4 class="text-center">作者信息</h4>
			</div>
			<div class="text-center">
				<p>一位不能再平常的大专生。</p>
				<strong><em>Contact BADASS：fon.waterbreathe@gmail.com</em></strong>
			</div>
		</div>
		<div class="tab-pane fade" id="友情链接" role="tabpanel">
			<div class="page-header">
				<h4 class="text-center">友情链接</h4>
			</div>
			<div class="text-center">
				<p>暂无友情链接</p>
			</div>
		</div>
		<div class="tab-pane fade" id="#" role="tabpanel">
			<div class="page-header">
				<h4 class="text-center"></h4>
			</div>
			<div class="text-center">
				<p>留言墙页面建设中！</p>
			</div>
		</div>
	</div>
</div>
<script>
$('#mytab a').click(function (e) {
 e.preventDefault()
 $(this).tab('show')
})
</script>
<footer class="container-fluid" style="">
	<div class="container">
	<p class="text-center">Designed By BADASS!</p>
	<p class="text-center"></p>
	</div>
</footer>
</body>
</html>