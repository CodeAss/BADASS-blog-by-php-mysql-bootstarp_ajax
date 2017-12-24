<?php
	//检测是否登录
	session_start();
	if(!isset($_SESSION['username'])){
		echo "<script>alert('还没有登录！');window.location.href='admin-login.php'</script>";
		exit();
	}
	//连接数据库
	require_once("../connect.php");
	$sql="SELECT * FROM article ORDER BY dateline DESC";
	//执行查询语句
	$query=mysqli_query($conn,$sql);
	//判断查询语句是否查询到结果，查到则使用mysqli_fetch_assoc()将其逐行取出，放入数组$data中，没查到则直接赋值空数组给$data
	if($query&&mysqli_num_rows($query)){
		while($row=mysqli_fetch_assoc($query)){
			$data[]=$row;
		}
	}else{
		$data=array();
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css"/>
<script type="text/javascript" src="../jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
<title>文章管理</title>
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
				<a href="admin-logout-handle.php" title="管理员注销">
					<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
				</a>
			</li>
		</ul>
	</div>
</div>
</nav>
<div class="container">
	<div class="page-header ex-page-header">  
		<h1 class="title">后台管理系统</h1>  
	</div>

	<div class="body-container">
		<div class="row">
			<div class="col-md-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
					</div>
					
					<ul class="nav nav-pills nav-stacked" id="mytab">
						<li role="presentation" class="active"><a href="#管理文章">管理文章</a></li>
						<li role="presentation"><a href="#相册管理">相册管理</a></li>
						<li role="presentation"><a href="#收藏夹管理">收藏夹管理</a></li>
						<li role="presentation"><a href="#留言板管理">留言板管理</a></li>
						
						
					</ul>
						<script>
							$('#mytab a').click(function (e) {
							e.preventDefault()
							$(this).tab('show')
							})
						</script>
				</div>
			</div>
			
			<div class="tab-content">
				<div class="tab-pane in active" id="管理文章">
					<div class="col-md-10">  
						<div class="panel panel-primary">  
							<div class="panel-heading">  
								<h3>文章管理列表<button class="btn btn-default btn-sm  pull-right" type="button" data-toggle="modal" data-target="#发布博客">发布博客</button></h3>
							</div>  
								<!--发布文章模态框-->
								<div class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" tabindex="-1" id="发布博客">
									<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aaria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="">发布博客</h4>
										</div>
										<div class="modal-body">
										<form method="post" action="admin-add-handle.php" class="form-horizontal">
											<div class="form-group">  
												<label for="article-title" class="col-sm-2 control-label">标题</label>  
												<div class="col-sm-10">  
													<input type="text" class="form-control" id="article-title" placeholder="Title" name="title"/>  
												</div>  
											</div>
											<div class="form-group">  
												<label for="article-author" class="col-sm-2 control-label">作者</label>  
												<div class="col-sm-10">  
													<input type="text" class="form-control" id="article-author" placeholder="Author" name="author"/>  
												</div>  
											</div>
											<div class="form-group">
												<label for="article-des" class="col-sm-2 control-label">简介</label>  
												<div class="col-sm-10">  
													<textarea name="description" id="article-des" cols="30" rows="5" class="form-control"></textarea>  
												</div>  
											</div>
											<div class="form-group">  
												<label for="article-content" class="col-sm-2 control-label">内容</label>  
												<div class="col-sm-10">  
													<textarea name="content" id="article-content" cols="30" rows="15" class="form-control"></textarea>  
												</div>  
											</div>  
											<div class="form-group">  
												<div class="col-sm-offset-2 col-sm-10">  
													<button type="submit" class="btn btn-default pull-right">提交</button>  
												</div>  
											</div>
										</form>
										</div>
									</div>
									</div>
								</div>
								<!--结束-->
							<div class="panel-body">  
								<table class="table table-hover">  
								<tr>  
								<th>编号</th>  
								<th>标题</th>
								<th>发布时间</th>
								<th>操作</th>  
								</tr>  
								<tbody>  
									<?php  
										if(!empty($data)) {
											foreach ($data as $value) {
									?>
									<tr>  
									<td><?php echo $value['id'];?></td>  
									<td><?php echo $value['title'];?></td>
									<td><?php echo date("Y/m/d H:i:s",$value['dateline']);?></td>
									<td>
										<a  class="btn btn-sm btn-primary" href="admin-del-handle.php?id=<?php echo $value['id'];?>">删除</a>
										<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#修改<?php echo $value['id'];?>">修改</button>
											<!--修改文章模态框-->
											<div class="modal fade"  role="dialog" aria-labelledby="exampleModalLabel" tabindex="-1" id="修改<?php echo $value['id'];$num=$value['id'];?>"  data-id="<?php echo $value['id'];?>">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aaria-label="Close"><span aria-hidden="true">&times;</span></button>
															<h4 class="modal-title" id="">修改页面</h4>
														</div>
														<div class="modal-body">
															<form method="post" action="admin-modify-handle.php" class="form-horizontal">
																<?php
																	//读取旧信息
																	$id = $num;
																	$query = mysqli_query($conn,"select * from article where id=$id");
																	$data1 = mysqli_fetch_assoc($query);
																?>
																<input type="hidden" name="id" value="<?php echo $data1['id'];?>"/>  
																<div class="form-group">  
																	<label for="article-title" class="col-sm-2 control-label">标题</label>  
																	<div class="col-sm-10">  
																		<input type="text" class="form-control" id="article-title" placeholder="Title" name="title" value="<?php echo $data1['title'];?>">  
																	</div>  
																</div>  
																<div class="form-group">  
																	<label for="article-author" class="col-sm-2 control-label">作者</label>  
																	<div class="col-sm-10">  
																		<input type="text" class="form-control" id="article-author" placeholder="Author" name="author" value="<?php echo $data1['author'];?>">  
																	</div>  
																</div>  
																<div class="form-group">  
																	<label for="article-des" class="col-sm-2 control-label">简介</label>  
																	<div class="col-sm-10">  
																		<textarea name="description" id="article-des" cols="30" rows="5" class="form-control"><?php echo $data1['description'];?></textarea>  
																	</div>  
																</div>  
																<div class="form-group">  
																	<label for="article-content" class="col-sm-2 control-label">内容</label>  
																	<div class="col-sm-10">  
																		<textarea name="content" id="article-content" cols="30" rows="15" class="form-control"><?php echo $data1['content'];?></textarea>  
																	</div>
																</div>  
																<div class="form-group">  
																	<div class="col-sm-offset-2 col-sm-10">  
																		<button type="submit" class="btn btn-default pull-right">提交</button>  
																	</div>  
																</div>  
															</form> 
														</div>
													</div>
												</div>
											</div>
									</td>
									</tr>
									<?php
											}
										}
									?>
								</tbody>
								</table>
								
							</div>
						</div>  
					</div>
				</div> 
				<div class="tab-pane" id="相册管理">
					<div class="col-md-10">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3>照片管理<button class="btn btn-default btn-sm  pull-right" type="button" data-toggle="modal" data-target="#添加照片">添加照片</button></h3>
							</div>
								<!--添加照片模态框-->
								<div class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" tabindex="-1" id="添加照片">
									<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aaria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="">添加照片</h4>
										</div>
										<div class="modal-body">
											<form action="admin-img-add-handle.php" method="post" enctype="multipart/form-data">
												<div class="form-group">
													<label for="exampleInputFile">请从你的磁盘路径选择文件并上传</label>
													<input type="file" id="" name="img"/><span>不支持文件名含有中文的文件</span>
												</div>
												<div class="form-group">
													<label for="exampleInputText">为此照片添加一点描述</label>
													<input type="text" class="form-control" id="" name="description" placeholder="留下点什么吧！" />
												</div>
												<button type="submit" class="btn btn-default">提交</button>
											</form>
										</div>
									</div>
									</div>
								</div>
								<!--结束-->
							<div class="panel-body">
								<div class="row">
								<?php 
								$imgquery="SELECT * FROM img ORDER BY dateline DESC";
								$imgresult=mysqli_query($conn,$imgquery);
								if($imgresult==true){
									while($imgdata=mysqli_fetch_array($imgresult)){
								?>
									<div class="col-sm-5 col-md-3">
										<div class="thumbnail">
											<img src="<?php echo $imgdata['path'];?>" />
											<div class="caption">
												<p class="text-center"><?php echo $imgdata['description'];?></p>
												<p class="text-right"><em><?php echo date("Y/m/d H:i:s",$imgdata['dateline']);?></em></p>
												<p  class="text-right"><a class="btn btn-default btn-sm" href="admin-img-del-handle.php?id=<?php echo $imgdata['id'];?>">删除</a><button class="btn btn-default btn-sm" type="button" data-toggle="modal" data-target="#修改照片页面<?php echo $imgdata['id'];$num1=$imgdata['id'];?>">编辑</button></p>
											</div>
										</div>
									</div>
									<!--修改照片模态框-->
									<div class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" tabindex="-1" id="修改照片页面<?php echo $imgdata['id'];$num1=$value['id'];?>">
									<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aaria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="">编辑描述信息</h4>
										</div>
										<div class="modal-body">
											<form action="admin-img-modify-handle.php" method="post" enctype="multipart/form-data">
												<div class="form-group">
													<input type="hidden" name="id" value="<?php echo $imgdata['id'];?>"/> 
													<label for="exampleInputText">描述</label>
													<input type="text" class="form-control" id="" name="description" value="<?php echo $imgdata['description'];?>" placeholder="留下点什么吧！"/>
												</div>
												<div class="modal-footer">
												<button type="submit" class="btn btn-default text-right">提交</button>
												</div>
											</form>
										</div>
									</div>
									</div>
									</div>
								<!--结束-->
									
								<?php
									}
								}else{
									echo "暂无照片！请上传！";
									}
								?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="收藏夹管理">
					<div class="col-md-10">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3>管理收藏夹<button class="btn btn-default btn-sm  pull-right" type="button" data-toggle="modal" data-target="#添加收藏站点">添加收藏站点</button></h3>
							
							</div>
							<!--添加收藏站点模态框-->
								<div class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" tabindex="-1" id="添加收藏站点">
									<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aaria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="">添加收藏站点</h4>
										</div>
										<div class="modal-body">
										<form method="post" action="admin-fav-add-handle.php" class="form-horizontal">
											<div class="form-group">  
												<label for="article-title" class="col-sm-2 control-label">名称</label>  
												<div class="col-sm-10">  
													<input type="text" class="form-control" id="article-title" placeholder="Name" name="name"/>  
												</div>  
											</div>
											<div class="form-group">  
												<label for="article-author" class="col-sm-2 control-label">URL链接</label>  
												<div class="col-sm-10">  
													<input type="text" class="form-control" id="article-author" placeholder="URL" name="href"/>  
												</div>  
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-default text-right">提交</button>
											</div>
										</form>
										</div>
									</div>
									</div>
								</div>
								<!--结束-->
							<div class="panel-body">
							<table class="table table-hover">
							<tr>
							<th>编号</th>
							<th>名称</th>
							<th>URL</th>
							<th>操作</th>
							</tr>
							<tbody>
							<?php
							$favsql="SELECT * FROM fav;";
							$favquery=mysqli_query($conn,$favsql);
							if($favquery==true){
								while($favdata=mysqli_fetch_array($favquery)){
									
							?>
							<tr>
							<td><?php echo $favdata['id'];?></td>
							<td><?php echo $favdata['name'];?></td>
							<td><?php echo $favdata['href'];?></td>
							<td>
							<a  class="btn btn-sm btn-primary" href="admin-fav-del-handle.php?id=<?php echo $favdata['id'];?>">删除</a>
							<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#修改fav<?php echo $favdata['id'];?>">修改</button>
								<!--修改收藏站点模态框-->
								<div class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" tabindex="-1" id="修改fav<?php echo $favdata['id'];?>">
									<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aaria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="">修改收藏站点</h4>
										</div>
										<div class="modal-body">
										<form method="post" action="admin-fav-modify-handle.php" class="form-horizontal">
										<input type="hidden" name="id" value="<?php echo $favdata['id'];?>"/>
											<div class="form-group">  
												<label for="article-title" class="col-sm-2 control-label">名称</label>  
												<div class="col-sm-10">  
													<input type="text" class="form-control" id="article-title" placeholder="Title" name="name" value="<?php echo $favdata['name'];?>"/>  
												</div>  
											</div>
											<div class="form-group">  
												<label for="article-author" class="col-sm-2 control-label">URL链接</label>  
												<div class="col-sm-10">  
													<input type="text" class="form-control" id="article-author" placeholder="Author" name="href" value="<?php echo $favdata['href'];?> "/>  
												</div>  
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-default text-right">提交</button>
											</div>
										</form>
										</div>
									</div>
									</div>
								</div>
								<!--结束-->
							</td>
							</tr>
							<?php
								}
							}
							?>
							</tbody>
							</table>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="留言板管理">
					<div class="col-md-10">
						<div class="panel panel-primary">
							<div class="panel-heading">
							<h3>管理留言</h3>
							</div>
							<div class="panel-body">
							<table class="table table-hover">
							<tr>
							<th>编号</th>
							<th>ip地址</th>
							<th>发布时间</th>
							<th>内容</th>
							<th>操作</th>
							</tr>
							<tbody>
							<?php
							$msgsql="SELECT * FROM msgbd";
							$msgresult=mysqli_query($conn,$msgsql);
							if($msgresult==true){
								while($msgdata=mysqli_fetch_array($msgresult)){
									?>
							<tr>
							<td><?php echo $msgdata['id'];?></td>
							<td><?php echo $msgdata['ipname'];?></td>
							<td><?php echo date("Y/m/d H:i:s",$msgdata['dateline']);?></td>
							<td><?php echo $msgdata['content'];?></td>
							<td><a class="btn btn-sm btn-primary" id="zxcv" href="msg-del-handle.php?id=<?php echo $msgdata['id'];?>">删除</a>
							<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#修改msg<?php echo $msgdata['id'];?>">修改</button>
							<!--修改msg模态框-->
								<div class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" tabindex="-1" id="修改msg<?php echo $msgdata['id'];?>">
									<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aaria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="">修改信息</h4>
										</div>
										<div class="modal-body">
											<form method="post" action="msg-modify-handle.php" class="form-horizontal">
												<input type="hidden" name="id" value="<?php echo $msgdata['id'];?>" />
												<div class="form-group">
													<label class="control-label col-sm-2">修改内容</label>
													<div class="col-sm-10">
														<textarea rows="2" class="form-control" name="content"><?php echo $msgdata['content'];?></textarea>
													</div>
												</div>
											<div class="modal-footer">
												<button class="btn btn-default pull-right" type="submit">提交修改</button>
											</div>
											</form>
										</div>
									</div>
									</div>
								</div>
								<!--结束-->
							</td>
							</tr>
							<?php
								}
							}
							?>
							</tbody>
							</table>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="">
					<div class="col-md-10">
						<div class="panel panel-primary">
							<div class="panel-heading">
							<h3></h3>
							</div>
							<div class="panel-body">
							</div>
						</div>
					</div>
				</div>
				
				
			</div>
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