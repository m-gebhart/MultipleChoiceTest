<?php
	function check_database($database, $host, $user, $password){
		$login = new mysqli($host, $user, $password);
		if ($login){
			$select = mysqli_select_db($login, $database);
			if($select)
				return true;
		}
		return false;
	}

	function create_test_database($host, $user, $password){
		$login = new mysqli($host, $user, $password);
		if($login){
			//table for each user with username and password
			$DB_Name = "test";
			mysqli_query($login, "CREATE DATABASE ".$DB_Name);
			mysqli_query($login, "USE ".$DB_Name);
			mysqli_query($login, "CREATE TABLE users(id INT AUTO_INCREMENT, username VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, PRIMARY KEY (id))");
			
			//table for later answers to each user (by id)
			mysqli_query($login, "CREATE TABLE save(id INT AUTO_INCREMENT, one INT NOT NULL, two INT NOT NULL, three INT NOT NULL, four INT NOT NULL, five INT NOT NULL, PRIMARY KEY (id))");
			

			//fixed table for solutions
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

	function check_user($mysqli, $table, $username){
		$stmt_checkuser = $mysqli->prepare("SELECT * FROM $table WHERE username = ?");
		if ($stmt_checkuser){
			$stmt_checkuser->bind_param("s", $username);
			$stmt_checkuser->execute();
			$stmt_checkuser->store_result();

			$row_cnt = $stmt_checkuser->num_rows;
			$stmt_checkuser->close();
			if ($row_cnt > 0)
				return true;
		}
		return false;
	}

	function get_user_id($sqli, $username){
		$stmt_id = $sqli->prepare("SELECT id FROM users WHERE username = ?");
		if ($stmt_id){
			$stmt_id->bind_param("s", $username);
			$stmt_id->execute();
			$stmt_id->bind_result($id);
			$stmt_id->fetch();
			return $id;
		}
		
		return 0;
	}

	function check_status(){
		//Ternary Operation
		return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
	}

	function log_out(){
				session_unset();
				session_destroy(); 
				Header('Location: /');
	}

	function save(){
		$save_sqli = new mysqli("localhost", "root", "", "test");
		if ($save_sqli){
			$stmt_save = $save_sqli->prepare("UPDATE save SET one = ?, two = ?, three = ?, four = ?, five = ? WHERE id = ?");
			$stmt_save->bind_param("iiiiii", $save_one, $save_two, $save_three, $save_four, $save_five, $_SESSION['user_id']);
			if(isset($_POST['one']))
				$save_one = (int)$_POST['one'];
			else
				$save_one = 0;

			if(isset($_POST['two']))
				$save_two = (int)$_POST['two'];
			else
				$save_two = 0;

			if(isset($_POST['three']))
				$save_three = (int)$_POST['three'];
			else
				$save_three = 0;

			if(isset($_POST['four']))
				$save_four = (int)$_POST['four'];
			else
				$save_four = 0;

			if(isset($_POST['five']))
				$save_five = (int)$_POST['five'];
			else
				$save_five = 0;

			$stmt_save->execute();
			$stmt_save->close();
		}
	}

	function get_save_int($question){
		$save_sqli = new mysqli("localhost", "root", "", "test");
		$stmt_checksave = $save_sqli->prepare("SELECT ".$question." FROM save WHERE id = ?");
		$stmt_checksave->bind_param("i", $_SESSION['user_id']);
		$stmt_checksave->execute();
		$row_result = $stmt_checksave->get_result();
		$value = $row_result->fetch_object();
		$save_result = 0;
		switch ($question){
			case "one":
				$save_result = $value->one; break;
			case "two":
				$save_result = $value->two; break;			
			case "three":
				$save_result = $value->three; break;
			case "four":
				$save_result = $value->four; break;
			case "five":
				$save_result = $value->five; break;
		}

		$stmt_checksave->close();
		return (int)$save_result;
		}
?>