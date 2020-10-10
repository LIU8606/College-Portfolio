
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
		
		<div class="container announce-wrapper">
			<?php
				//ini_set("display_errors","On");
				include '../database/auth.php';
				// call the class
				$auth = new Auth();
				$ID = trim($_GET['ID']);
				$anncs = $auth->anncs($ID);
			?>

			<h3 class="title"><?php echo $anncs[0];?></h3>
			<div class="row">
				<div class="col-md-12 date"><?php echo $anncs[2];?></div>
				<div class="col-md-12 announce-content">
					<?php echo str_replace(chr(13).chr(10), '<br />',$anncs[1]);?>
				</div>
			</div>
		</div>
	</body>
</html>