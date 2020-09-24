<?php
	session_start();
	if(!isset($_SESSION['username']))
	{
		Header ('Location: /');
	}

	if(isset($_POST['logout']))
	{
		session_unset();
		session_destroy(); 
		Header('Location: /');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>BA4 Test</title>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
	<link id="stylecall" rel="stylesheet" href="assets/styles.css" />
</head>
<body>
	<h1>Welcome, <?php echo $_SESSION["username"]?>!</h1>
	<h2>Topic: Geek Knowledge</h2>
	<form action="" method="post">
	<button type="submit" name="logout">LOG-OUT"</button>
</form>
</body>
</html>