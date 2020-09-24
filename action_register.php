<?php
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['validated_password'])){
	
	//Creating 'test' database for very first user on localhost
	$login = new mysqli("localhost", "root", "");
	if (!$login)
		die("Connection to Server failed");
	
	$database = mysqli_select_db($login, "test");

	if(!$database)
	{
		mysqli_query($login, "CREATE DATABASE test");
		mysqli_query($login, "USE test");
		mysqli_query($login, "CREATE TABLE users(id INT AUTO_INCREMENT, username VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, PRIMARY KEY (id))");
	}

	//Registering in 'test' database
	$sqli = new mysqli("localhost", "root", "", "test");	
	if ($sqli->connect_error) 
		die("Connection to database failed");	

	$stmt_insert = $sqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
	
	if($stmt_insert){
		$stmt_checkuser = $sqli->prepare("SELECT * FROM users WHERE users.username = ?");
		$stmt_checkuser->bind_param("s", $_POST['username']);
		$stmt_checkuser->execute();
		$stmt_checkuser->store_result();

		$row_cnt = $stmt_checkuser->num_rows;
		$stmt_checkuser->close();
		if($row_cnt > 0)
			echo "username already exists!";

		else{
			if ($_POST['validated_password'] == $_POST['password']){
				$stmt_insert->bind_param("ss", $_POST['username'], $_POST['password']);
				$stmt_insert->execute();
				Header ('Location: /');
			}
			else
				echo "passwords do not match!";
		}
	}
	$stmt_insert->close();
	$sqli->close();
}
?>