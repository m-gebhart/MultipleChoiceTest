<?php include 'action_result.php'?>
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
	<h1>Thanks for Participating, <?php echo $_SESSION["username"]?>!</h1>
	<div class="form-box">
		<h2 style="text-decoration: underline">LOG-IN</h2>
		<p 
		<?php 
			$color = ""; 
			if(get_result() == 5) $color="green"; 
			elseif(get_result() == 0) $color="red"; 
			else $color="orange";
			echo "style='color: ".$color."'" ?>
		>
		You have <?php echo get_result() ?> out of 5 Right Answers!</p>
	</div>
	<p>Would You Like to Improve Your Result?<br><a href="/test.php?on_retry=true"><i>Try it again!</i></a></p>
	<form method="post" action="">
			<button type="submit" name="log-out">LOG-OUT and SAVE</button>
	</form>
</body>
</html>