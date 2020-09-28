<?php
session_start();
require_once('functions_login.php');

if(isset($_POST['username']) && isset($_POST['password'])){
	
	//login process
	if (check_database("test", "localhost", "root", "")) {
		$sqli = new mysqli("localhost", "root", "", "test");
		if ($sqli){	
			//if user is found
			if (check_login($sqli, $_POST['username'], $_POST['password'])){
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['user_id'] = get_user_id($sqli, $_POST['username']);
				$_SESSION['result'] = 0;
				Header ('Location: /test.php');
			}
			else
				echo "Username or Password incorrect!";
		}
	}
	else
		echo "Please register below!"; //only for very first user due to database not being created yet
}

//leading back to log-in / index page on succesful registration
elseif(isset($_GET['on_registration'])) {
	if ($_GET['on_registration'] == "true")
		echo "<span style='color: green'>Registration Succesful!</br><span style='font-size: 1rem'>Please Log-In Again!</span></span>";
}

?>