<?php
require_once('functions_general.php');

	//Creates Database 'test' with tables: users, save and solution
	function create_test_database($host, $user, $password){
		$login = new mysqli($host, $user, $password);
		if($login){
			$DB_Name = "test";
			mysqli_query($login, "CREATE DATABASE ".$DB_Name);
			mysqli_query($login, "USE ".$DB_Name);

			//table 'user' for each user with id, username and password
			mysqli_query($login, "CREATE TABLE users(id INT AUTO_INCREMENT, username VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, PRIMARY KEY (id))");
			
			//table 'save' to later save progress for each user (by id)
			mysqli_query($login, "CREATE TABLE save(id INT AUTO_INCREMENT, one INT NOT NULL, two INT NOT NULL, three INT NOT NULL, four INT NOT NULL, five INT NOT NULL, result INT NOT NULL, PRIMARY KEY (id))");
			
			//table 'solution' with right answer to each question
			mysqli_query($login, "CREATE TABLE solution(id INT AUTO_INCREMENT, one INT NOT NULL, two INT NOT NULL, three INT NOT NULL, four INT NOT NULL, five INT NOT NULL, PRIMARY KEY (id))");
		
			$sqli_test = new mysqli($host, $user, $password, $DB_Name);
			if ($sqli_test){
				$stmt_solution = $sqli_test->prepare("INSERT INTO solution (one, two, three, four, five) VALUES (?, ?, ?, ?, ?)");
				$stmt_solution->bind_param("iiiii", $answer_one, $answer_two, $answer_three, $answer_four, $answer_five);
				//right answer to each question
				$answer_one = 3;
				$answer_two = 2;
				$answer_three = 3;
				$answer_four = 2;
				$answer_five = 1;
				$stmt_solution->execute();
				$stmt_solution->close();
			}
		}
	}

	function register_user($sqli){

		//create default save for save data
		$stmt_save = $sqli->prepare("INSERT INTO save (one, two, three, four, five, result) VALUES (?, ?, ?, ?, ?, ?)");
		if($stmt_save){
			$stmt_save->bind_param("iiiiii", $default_value, $default_value, $default_value, $default_value, $default_value, $default_value);
			$default_value = 0;
			$stmt_save->execute();
			$stmt_save->close();
		}

		//insert user in table 'users'
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