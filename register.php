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
		<h2 style="text-decoration: underline">REGISTER</h2>
		<form method="post" action="">
			<input type="text" name="username" placeholder="Create Username" required/>
			<input type="password" name="password" placeholder="Create Password" required/>
			<input type="password" name="validated_password" placeholder="Confirm Password" required/>
			<button type="submit">REGISTER</button>
		</form>
		<div style="color: red; text-align: center; margin-bottom: 5vh">
			<?php include 'action_register.php'?>
		</div>
	</div>
	<p><a href="/">Back to Log-In<a></p>
</body>
</html>