<?php
require_once('functions.php');
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['validated_password'])){

	//Creating 'test' database for very first user on localhost
	if(!check_database("test", "localhost", "root", ""))
		create_test_database("localhost", "root", "");


	//Registering in 'test' database
	$sqli = new mysqli("localhost", "root", "", "test");	
	if ($sqli->connect_error) 
		die("Connection to database failed");	

	$stmt_insert = $sqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
	
	if($stmt_insert){
		if (check_user($sqli, "users", $_POST['username']))	
			echo "username already exists!";

		else{
			if ($_POST['validated_password'] == $_POST['password']){
				$stmt_insert->bind_param("ss", $_POST['username'], $_POST['password']);
				$stmt_insert->execute();
				Header ('Location: /index.php?on_registration=true');
			}
			else
				echo "passwords do not match!";
		}
	}
	$stmt_insert->close();
	$sqli->close();
}
?>