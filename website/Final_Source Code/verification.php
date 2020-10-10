<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>認證</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/login.css">
		<link rel="stylesheet" href="css/registeration.css">
		<script src="https://www.google.com/reCAPTCHA/api.js" async defer></script>
	</head>
	<body>
		<form action="Verify.php" method="POST">
			<input name="Code" placeholder="Enter code" type="text">;
			<input type="submit" value="送出" class="btn-submit">
		</form>
		
	</body>
</html>