<?php
session_start();
require_once('functions.php');
if(isset($_POST['username']) && isset($_POST['password'])){
	//login process
	if (check_database("test", "localhost", "root", "")) {
		$sqli = new mysqli("localhost", "root", "", "test");

		if ($sqli){	
			//check whether user exists in database
			$stmt_checklogin = $sqli->prepare("SELECT * FROM users WHERE users.username = ? AND users.password = ?");
			$stmt_checklogin->bind_param("ss", $_POST['username'], $_POST['password']);
			$stmt_checklogin->execute();
			$stmt_checklogin->store_result();

			$row_cnt = $stmt_checklogin->num_rows;
			if ($row_cnt == 1){
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['user_id'] = get_user_id($sqli, $_POST['username']);
				Header ('Location: /test.php');
			}
			else {
				echo "Username or Password incorrect!";
			}
		}
	}
	else
		echo "User not found!";
}
elseif(isset($_GET['on_registration'])) {
	if ($_GET['on_registration'] == "true")
		echo "<span style='color: green'>Registration Succesful!</br><span style='font-size: 1rem'>Please Log-In Again!</span></span>";
}

?>