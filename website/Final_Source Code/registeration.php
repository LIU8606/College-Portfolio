<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>註冊</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/login.css">
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
						<li><a href="index.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="events.php">活動列表 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li ><a href="login.php">登入 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li class="active"><a href="registeration.php">註冊<span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container register-wrapper">
			<form action="auth/register.php" method="POST">
				<div class="col-md-5 col-md-offset-1">
					<label>學號*</label><br>
					<input type="text" minlength="7" maxlength="7" name="ID" required="required">
				</div>
				<div class="col-md-12">
					<br>
				</div>
				<div class="col-md-5 col-md-offset-1">
					<label>姓氏*</label><br>
					<input type="text" name="lastname" placeholder="彭" required="required">
				</div>
				<div class="col-md-5 col-md-offset-1">
					<label>名字*</label><br>
					<input type="text" name="firstname" placeholder="文志" required="required">
				</div>
				<div class="col-md-12">
					<br>
				</div>
				<div class="col-md-5 col-md-offset-1">
					<label>信箱*</label><br>
					<input type="email" name="email" placeholder="abc@example.com" required="required">
				</div>
				<div class="col-md-12">
					<br>
				</div>
				<div class="col-md-5 col-md-offset-1">
					<label>密碼*</label><br>
					<input type="password" name="password" required="required">
				</div>
				<div class="col-md-12">
					<br>
				</div>
				<div class="col-md-5 col-md-offset-1">
					<label>確認密碼*</label><br>
					<input type="password" name="password" required="required">
				</div>
				<div class="col-md-12">
					<br>
				</div>
				<div class="col-md-5 col-md-offset-1">
					<input type="submit" value="送出" class="btn-submit">	
				</div>
				<div class="col-md-5 col-md-offset-1">
					<input type="button" value="取消" class="btn-cancel" onclick="javascript:location.href='index.php'">	
				</div>

			</form>
		</div>
	</body>
</html>