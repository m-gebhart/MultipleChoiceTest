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
			mysqli_query($login, "CREATE DATABASE test");
			mysqli_query($login, "USE test");
			mysqli_query($login, "CREATE TABLE users(id INT AUTO_INCREMENT, username VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, PRIMARY KEY (id))");
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

	function log_out(){
		session_unset();
		session_destroy(); 
		Header('Location: /');
	}
?>