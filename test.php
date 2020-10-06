<?php include 'action_test.php'?>
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
		<div class="top">
			<button type="submit" name="save">SAVE</button>
			<button type="submit" name="log-out">Log-Out</button>
			<button type="submit" name="reset">Reset</button>
		</div>
		<div class="multiple-choice">
			<h3>1. How many movies does the <i>Home Alone</i> series currently (as of 2020) consist of?</h3>
			<label>Two
				<input type="radio" class="choice-radio" id="1-1" name="one" value="1" <?php if(get_save_int('one') == 1) echo "checked"; ?>>
			</label>
			<label>Three
				<input type="radio" class="choice-radio" id="1-2" name="one" value="2" <?php if(get_save_int('one') == 2) echo "checked"; ?>>
			</label>
			<label>Five
				<input type="radio" class="choice-radio" id="1-3" name="one" value="3" <?php if(get_save_int('one') == 3) echo "checked"; ?>>
			</label>
		</div>
		<div class="multiple-choice">
			<h3>2. Initially, the four ghosts from the classic arcade game <i>Pac-Man</i> (1980) were named Blinky, Pinky, Inky and...?</h3>
			<label>Dinky
				<input type="radio" class="choice-radio" id="2-1" name="two" value="1" <?php if(get_save_int('two') == 1) echo "checked"; ?>>
			</label>
			<label>Clyde
				<input type="radio" class="choice-radio" id="2-2" name="two" value="2" <?php if(get_save_int('two') == 2) echo "checked"; ?>>
			</label>
			<label>Clinky
				<input type="radio" class="choice-radio" id="2-3" name="two" value="3" <?php if(get_save_int('two') == 3) echo "checked"; ?>>
			</label>
		</div>	
		<div class="multiple-choice">
			<h3>3. Which medium is the popular movie series <i>Pirates of the Caribean</i> (since 2003) based on?</h3>
			<label>An English Folklore
				<input type="radio" class="choice-radio" id="3-1" name="three" value="1" <?php if(get_save_int('three') == 1) echo "checked"; ?>>
			</label>
			<label>A Comic Series
				<input type="radio" class="choice-radio" id="3-2" name="three" value="2" <?php if(get_save_int('three') == 2) echo "checked"; ?>>
			</label>
			<label>An Amusement Park Ride
				<input type="radio" class="choice-radio" id="3-3" name="three" value="3" <?php if(get_save_int('three') == 3) echo "checked"; ?>>
			</label>
		</div>
		<div class="multiple-choice">
			<h3>4. Which of the following was the final release date for <i>The Elder Scrolls V: Skyrim</i> (2011)?</h3>
			<label>31.10.11
				<input type="radio" class="choice-radio" id="4-1" name="four" value="1" <?php if(get_save_int('four') == 1) echo "checked"; ?>>
			</label>
			<label>11.11.11
				<input type="radio" class="choice-radio" id="4-2" name="four" value="2" <?php if(get_save_int('four') == 2) echo "checked"; ?>>
			</label>
			<label>31.03.11
				<input type="radio" class="choice-radio" id="4-3" name="four" value="3" <?php if(get_save_int('four') == 3) echo "checked"; ?>>
			</label>
		</div>
		<div class="multiple-choice">
			<h3>5. How was Nintendo's iconic character Super Mario initially named in his debut game <i>Donkey Kong</i> (1981)?</h3>
			<label>Jumpman
				<input type="radio" class="choice-radio" id="5-1" name="five" value="1" <?php if(get_save_int('five') == 1) echo "checked"; ?>>
			</label>
			<label>Jumper
				<input type="radio" class="choice-radio" id="5-2" name="five" value="2" <?php if(get_save_int('five') == 2) echo "checked"; ?>>
			</label>
			<label>Plumber
				<input type="radio" class="choice-radio" id="5-3" name="five" value="3" <?php if(get_save_int('five') == 3) echo "checked"; ?>>
			</label>
		</div>
		<button type="submit" name="submit">SUBMIT</button>
	</form>
</body>
</html>