<?php
	session_start();
	require_once('functions.php');

	if(!isset($_SESSION['username']))
		Header ('Location: /');

	if(isset($_POST['log-out']))
		log_out();
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
	<div class="top">
		<form action="" method="post">
			<button type="submit" name="log-out">LOG-OUT</button>
			<button type="submit" name="save">Save</button>
		</form>
	</div>

</body>
</html>