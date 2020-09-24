<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password'])){

	$login = new mysqli("localhost", "root", "");
	if ($login){
		$sqli = new mysqli("localhost", "root", "", "test");	
		if ($sqli->connect_error) 
			{die("Connection to database failed"); exit;}
		else{
			$stmt_checklogin = $sqli->prepare("SELECT * FROM users WHERE users.username = ? AND users.password = ?");
			$stmt_checklogin->bind_param("ss", $_POST['username'], $_POST['password']);
			$stmt_checklogin->execute();
			$stmt_checklogin->store_result();

			$row_cnt = $stmt_checklogin->num_rows;
			if ($row_cnt == 1){
				$_SESSION["username"] = $_POST['username'];
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
?>