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
	<h1>Welcome To The BA4 Test!</h1>
	<div class="form-box">
		<h2 style="text-decoration: underline">LOG-IN<h2>
		<form method="post" action="">
			<input type="text" name="username" placeholder="Your Username" required/>
			<input type="password" name="password" placeholder="Your Password" required/>
			<button type="submit">LOG-IN</button>
		</form>
		<div style="color: red; text-align: center; margin-bottom:5vh">
			<?php include 'action_login.php'?>
		</div>
	</div>
	<p>No Account?</br><a href="/register.php">Register Here!<a></p>
</body>
</html>