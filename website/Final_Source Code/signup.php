<?php
	if(!isset($_SESSION)){
		session_start();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Sign up</title>
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
					<a class="navbar-brand"	 href="#">N C T U &nbsp;&nbsp; S p o r t s</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-link">
						<li><a href="../index.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
					<?php if($_SESSION['identity'] == 1){ ?>
						<ul class="nav navbar-nav navbar-link">
							<li><a href="eventadmin.php">活動列表 <span class="sr-only">(current)</span></a></li>
						</ul>
					<?php } else{ ?>	
						<ul class="nav navbar-nav navbar-link">
							<li><a href="events.php">活動列表 <span class="sr-only">(current)</span></a></li>
						</ul>
					<?php } ?>
					</ul>
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
		<div class="container event-wrapper">
			<div class="signup-form">
				<?php
					//ini_set("display_errors", "On");
					include $_SERVER['DOCUMENT_ROOT'] . '/database/auth.php';
					$auth = new Auth();
					$event = $auth->findevent($_GET['n']);
					$row1 = $event->fetch_row();	?>
				<h3 class="text-center">活動報名：<?php echo $row1[1] ?></h3>
				<div class="description">
					<p>每隊上限：<?php echo $row1[4]; ?></p>
					<p>隊伍上限：<?php echo $row1[3]; ?></p>
					<p>已報名隊伍：<?php echo $row1[5]; ?> 隊</p>
					<p class="warning">尚可報名：<?php echo $row1[3] - $row1[5]; ?> 隊</p>
				</div>

				<?php 
					$teamate = $auth->is_signed($_GET['n'], $_SESSION['username']);
					$num_teamate = mysqli_num_rows($teamate);
					if ($num_teamate != 0) { 
				?>
						<a href="/auth/delete_signup.php?n=<?php echo $_GET['n'] ?>&r=<?php echo $_SESSION["username"] ?>"><button class="btn btn-remove" onclick="if(confirm('確定要刪除該活動嗎?'))return true;else return false">取消報名</button></td></a>
						<label class="text-center" for="team_name">隊伍人員</label>
						<table class="table">
						<tr>
							<th class="student-id">隊員學號</th>
							<th>姓名</th>
							<th></th>
						</tr>
				<?php
						while($row = mysqli_fetch_array($teamate)) { ?>
						<tr>
							<td class="student-id"> <?php echo $row[0] ?> </td>
							<td> <?php echo $auth->getname($row[0])[1]; echo $auth->getname($row[0])[0]; ?> </td>
							<td class="text-right"><button class="btn btn-new" style="margin-right:30px">修改</button>
							<a href="/auth/delete_teamate.php?ID=<?php echo $row[0] ?>&r=<?php echo $r ?>&n=<?php echo $_GET['n'] ?>"><button class="btn btn-remove">取消</button></td></a>
						</tr>
				<?php } } else if($row1[3] == $row1[5]) { ?>
					<label class="text-center" for="team_name">報名滿惹</label>
				<?php } else { ?>
					<label class="text-center" for="team_name">隊伍人員</label>
					<table class="table">
						<tr>
							<th class="student-id">隊員學號</th>
							<th>姓名</th>
							<th></th>
						</tr>
						
						<?php
							$r = $_GET['r'];
							if($r == 0) $r = rand(); ;
							$result = $auth->tempteamate($r);
							$num_row = mysqli_num_rows($result);
							while($row = mysqli_fetch_array($result)) { 
						?>
						<tr>
							<td class="student-id"> <?php echo $row[0] ?> </td>
							<td> <?php echo $auth->getname($row[0])[1]; echo $auth->getname($row[0])[0]; ?> </td>
							<td class="text-right"><button class="btn btn-new" style="margin-right:30px">修改</button>
							<a href="/auth/delete_teamate.php?ID=<?php echo $row[0] ?>&r=<?php echo $r ?>&n=<?php echo $_GET['n'] ?>"><button class="btn btn-remove">取消</button></td></a>
						</tr>
							<?php } ?>
						<?php if($row1[4] > $num_row) { ?>
							<form action="/auth/add_teamate.php" method="POST">
							<tr>
								<input type="hidden" name="team_ID" value=<?php echo $r ?> >
								<input type="hidden" name="n" value=<?php echo $_GET['n'] ?> >
								<td class="student-id"><input type="text" name="student_id" class="form-control" ></td>
								<td></td>
								<td class="text-right"><button class="btn btn-new" style="margin-right:30px">新增隊員</button></td>
							</tr>
							</form>
						<?php } ?>
					</table>
				<form action="/auth/submit.php" method="POST">
				<br>
					<label class="text-center" for="team_name">隊伍名稱</label>
				<br>
					<input type="text" id="team_name" name="team_name" class="form-control" value="MHW Pro">
					<input type="hidden" name="team_ID" value=<?php echo $r ?> >
					<input type="hidden" name="event_ID" value=<?php echo $_GET['n'] ?> >
					<div class="text-left form-bottom">
						<button class="btn btn-default">提交報名表</button>
					</div>
				</form>
				<?php } ?>
			</div>
		</div>
	</body>
</html>