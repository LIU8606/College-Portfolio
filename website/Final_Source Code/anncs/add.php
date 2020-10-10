<?php
	//identity = 0 -->user ,1 --> admin
	if(!isset($_SESSION)){
		session_start();
		//if(empty($_SESSION["username"])) $_SESSION['username']="";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Home</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/home.css">
		<link rel="stylesheet" href="../css/announce.css">
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">N C T U &nbsp;&nbsp; S p o r t s</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-link">
						<li class="active"><a href="../index.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<?php if($_SESSION['identity'] == 1){ ?>
						<ul class="nav navbar-nav navbar-link">
							<li><a href="../eventadmin.php">活動列表 <span class="sr-only">(current)</span></a></li>
						</ul>
					<?php } else{ ?>	
						<ul class="nav navbar-nav navbar-link">
							<li><a href="../events.php">活動列表 <span class="sr-only">(current)</span></a></li>
						</ul>
					<?php } ?>
					
					<?php if($_SESSION['username'] == ""){ ?>
							<ul class="nav navbar-nav navbar-link">
								<li><a href="../login.php">登入 <span class="sr-only">(current)</span></a></li>
							</ul>
							<ul class="nav navbar-nav navbar-link">
								<li><a href="registeration.php">註冊<span class="sr-only">(current)</span></a></li>
							</ul>
						
						<?php } else{ ?>
							<ul class="nav navbar-nav navbar-link">
								
								<li><a href="../database/logout.php" onclick="alert('登出成功！')" >Logout</a><span class="sr-only">(current)</span></a></li>
							</ul>
							<ul style="">
								<li>歡迎 <?php echo $_SESSION["username"] ?>！<span class="sr-only">(current)</span></li>
							</ul>
							<?php if($_SESSION['identity'] == "1"){ ?>
								<ul style="">
									<li >管理員才看得到<span class="sr-only">(current)</span></li>
								</ul>
							<?php } ?>	
						<?php } ?>
					
					
				</div>
			</div>
		</nav>
		<div class="container login-wrapper">
			<form action="../auth/add_anncs.php" method="POST">
				<div class="row">
					<div class="col-md-8 col-md-offset-1">
						<label>標題</label>
						<input type="text" name="title" class="form-control">
					</div>
					<div class="col-md-12">
						<br>
					</div>
					<div class="col-md-8 col-md-offset-1">
						<label>內容</label>
						<br>
						<textarea name="content" style="width:450px;height:500px;"></textarea>
					</div>
					<div class="col-md-12">
						<br><br><br>
					</div>
					<div class="col-md-6 col-md-offset-6">
						<button class="btn btn-default btn-login" type="submit">發布</button>

					</div>		
				</div>
			</form>
			<div>
				<a href="../index.php"><button class="btn btn-default btn-login">取消</button></a>
			</div>
		</div>
	</body>
</html>