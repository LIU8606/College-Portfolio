<?php
	//identity = 0 -->user ,1 --> admin
	if(!isset($_SESSION)){
		session_start();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Events</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/event.css">
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
						<li><a href="../index.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<?php if($_SESSION['identity'] == 1){ ?>
						<ul class="nav navbar-nav navbar-link">
							<li><a href="eventadmin.php">活動列表 <span class="sr-only">(current)</span></a></li>
						</ul>
					<?php } else{ ?>	
						<ul class="nav navbar-nav navbar-link">
							<li><a href="events.php">活動列表 <span class="sr-only">(current)</span></a></li>
						</ul>
					<?php } ?>
					<?php if($_SESSION['username'] == ""){ ?>
							<ul class="nav navbar-nav navbar-link">
								<li><a href="login.php">登入 <span class="sr-only">(current)</span></a></li>
							</ul>
							<ul class="nav navbar-nav navbar-link">
								<li><a href="registeration.php">註冊<span class="sr-only">(current)</span></a></li>
							</ul>
						
						<?php } else{ ?>
							<ul class="nav navbar-nav navbar-link">
								
								<li><a href="database/logout.php" onclick="alert('登出成功！')" >Logout</a><span class="sr-only">(current)</span></a></li>
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
		<div class="container event-wrapper event-list">
			<br>
			<table class="table text-center">
				<tr>
					<th class="text-center">項目</th>
					<th class="text-center">日期</th>
					<th class="text-center">報名</th>
				</tr>
				<?php
					//ini_set("display_errors", "On");
					include $_SERVER['DOCUMENT_ROOT'] . '/database/auth.php';
					$date = date("Y/m/d");
					$auth = new Auth();
					$event = $auth->viewevent();
					while($row = mysqli_fetch_array($event)) { 
						if( $row['is_delete'] == 1) continue; ?>
					<tr>
					<td><?php echo $row['eventname'] ?> </td>
					<td><?php echo $row['eventdate'] ?> </td>

					<?php if(strtotime($date) < strtotime($row['eventdate'])) { ?>
						<td><a href="signup.php?n=<?php echo $row['ID'] ?>&r=0"><button class="btn btn-default btn-event">報名</button></a></td>
					<?php } else { ?> <td>時間過了ＱＱ</td> <?php } ?> 
					</tr>
				<?php } ?>
			</table>
		</div>
	</body>
</html>