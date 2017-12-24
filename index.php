<?php
//分页功能
require_once("connect.php");
$page = isset($_GET['page'])?intval($_GET['page']):1;
$num=3;
$sql="select * from article";
$result=mysqli_query($conn,$sql);
$total=mysqli_num_rows($result);
$pagenum=ceil($total/$num);

if($page>=$pagenum+1 || $page <= 0){
       echo "<script>alert('没有内容了！');history.go(-1);</script>";
       exit;
}
$offset=($page-1)*$num;        
$sql="select * from article limit $offset,$num ";
$info=mysqli_query($conn,$sql);   
if($info&&mysqli_num_rows($info)){
	while($row=mysqli_fetch_assoc($info)){
		$data[]=$row;
	}
}else{
	$data=array();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>BADASS!</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"/>
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<style>
</style>
<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body style="padding-top:50px;">
<nav class="navbar navbar-inverse navbar-fixed-top" style="margin-bottom:0px;">
<div class="container">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"  data-target="#bs-example-navbar-collapse-1" aria-expanded="false">  
			<span class="sr-only"></span>  
			<span class="icon-bar"></span>  
			<span class="icon-bar"></span>  
			<span class="icon-bar"></span>  
		</button>
		<a class="navbar-brand" href="index.php" title="BADASS!">BADASS!</a>
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
			<li><a href="about/about.php">关于本站</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a href="admin/admin-login.php" title="管理员登陆">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</a>
			</li>
		</ul>
	</div>
</div>
</nav>

	<!--canvas特效开始-->
    <canvas id="canvas-banner" style="background: #393D49" width="1910" height="206"></canvas>
    <script type="text/javascript">
        var canvas = document.getElementById('canvas-banner');
        canvas.width = window.document.body.clientWidth;
        canvas.height = window.innerHeight * 2 / 7;
        window.onload = function () {
            var script = document.createElement('script');
            script.src = 'js/canvas.js';
            document.getElementsByTagName('body')[0].appendChild(script);
        }
    </script>
	<!--canvas特效结束-->
<div class="container">
<div style="padding:40px;margin-bottom:10px;" class="jumbotron">
	<h1>BADASS的博客</h1>
	<p>——一个php程序员，记录闲暇时光、随笔</p>
</div>
</div>
<div class="container" style="background-color:#fff">
<ul class="nav nav-tabs" id="mytab">
	<li role="presentation" class="active"><a href="#日志">日志</a></li>
	<li role="presentation" class=""><a href="#相册">相册</a></li>
	<li role="presentation"><a href="#留言">留言</a></li>
	<li role="presentation"><a href=""></a></li>
	</ul>
	<script>
	$('#mytab a').click(function (e) {
	e.preventDefault()
	$(this).tab('show')
	})
	</script>
</div>
<div class="container" style="background-color:#fff">
	<div class="tab-content">
		<div class="tab-pane in active" id="日志">
			<div class="container" style="width:800px;">
				<?php 
					//将$data中的数据通过foreach循环出来，显示在相应div里面
					if(!empty($data)){
						foreach($data as $value){
				?>
				<div class="page-header" style="margin-bottom:0;">
					<h3 style="margin-bottom:0;"><?php echo $value['title'];?></h3>
				</div>
				<small style="color:#777;">作者：<?php echo $value['description'];?>        发布时间：<?php echo date("Y-m-d H:i:s",$value['dateline']);?></small></p>
				<p><?php echo $value['content'];?></p>
				<?php
						}
					}
					//初始化首页、上一页、下一页、末页的值，通过<a>标签进行跳转到当前页面，传入$page的值
					$first=1;
					$prev=$page-1;
					$next=$page+1;
					$last=$pagenum;
				?>
				<nav style="text-align:center" aria-label="Page navigation">
					<ul class="pagination">
						<li id="首页" class=""><a href="index.php?page=<?php echo $first ?>" class="disabled" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
						<li id="上一页"><a href="index.php?page=<?php echo $prev ?>">上一页</a></li>
						<li id="下一页"><a href="index.php?page=<?php echo $next ?>">下一页</a></li>
						<li id="尾页"><a href="index.php?page=<?php echo $last ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<div class="tab-pane" id="相册" role="tabpanel">
		<div class="row">
			<?php 
			$imgsql="SELECT * FROM img ORDER BY dateline DESC";
			$imgresult=mysqli_query($conn,$imgsql);
			if($imgresult==true){
			while($imgdata=mysqli_fetch_array($imgresult)){
			?>
			<div class="col-sx-6 col-md-3">
					<a class="thumbnail" type="button" data-toggle="modal" data-target="#照片详细<?php echo$imgdata['id'];$num1=$imgdata['id'];?>"><img class="" src="admin/<?php echo $imgdata['path'];?>"/></a>
			</div>
			<!--照片详细模态框-->
			<div class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" tabindex="-1" id="照片详细<?php echo$imgdata['id'];?>">
			<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aaria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">照片详细</h4>
				</div>
				<div  class="modal-body">
					<a href="admin/<?php echo $imgdata['path'];?>" target="_blank"><img src="admin/<?php echo $imgdata['path'];?>" width='578' height='690'/></a>
					<p><?php echo $imgdata['description'];?></p>
					<p class="text-right"><em><?php echo date("Y/m/d H:i:s",$imgdata['dateline']);?></em></p>
				</div>
			</div>
			</div>
			</div>
			<!--结束-->
			<?php
				}
			}
			?>
		</div>
		</div>
		<div class="tab-pane" id="留言" role="tabpanel">
		<div class="container">
			<div class="row">
			<?php
			$messageboardsql="SELECT * FROM msgbd ORDER BY dateline DESC";
			$msgbdresult=mysqli_query($conn,$messageboardsql);
			if($msgbdresult==true){
				while($msgbddata=mysqli_fetch_array($msgbdresult)){
					?>
				<div class="col-sm-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<p class="text-left"><label>IP地址：</label><?php echo $msgbddata['ipname'];?></p><br>
						<div class="container"><p><?php echo $msgbddata['content'];?></p></div>
						<p class="text-right" style="margin:0;"><?php echo date("Y/m/d H:i:s",$msgbddata['dateline']);?></p>
					</div>
				</div>
				</div>
			<?php
				}
			}
			?>
			</div>
			<hr>
			<div class="container">
				<form>
					<div class="form-group">
					<p class="text-center"><b>在BADASS留言！</b></p>
					<input type="hidden" id="ipname" value="<?php echo $_SERVER['REMOTE_ADDR'];?>" />
					<textarea cols="5" rows="2" class="form-control center-block" id="content" style="width:300px;"></textarea>
					<button class="btn btn-default center-block" id="zxcv">留言</button>
					</div>
				</form>
							<!--ajax-->
							<script>
							$(document).ready(function(){
								$('#zxcv').click(function(){
									var ipn=$('#ipname').val();
									var cnt=$('#content').val();
									if(cnt==""){
										alert('你还没有留下文字！');
										$('#content').focus();
										return false;
									};
									$.ajax({
										url:'admin/msg-add-handle.php',
										type:'POST',
										data:{'ipname':ipn,'content':cnt,},
										success:function(msg){
											if(msg==22){
												alert('感谢留言！');
											}else{
												alert('错误！');
											}
										},
									});
								});
							});
							</script>
			</div>
		</div>
		</div>
		<div class="tab-pane" id="" role="tabpanel">
		</div>
	</div>
	
</div>


<footer class="container-fluid">
	<div class="container">
	<p class="text-center">Designed By BADASS!</p>
	<p class="text-center"></p>
	</div>
</footer>
</body>
</html>