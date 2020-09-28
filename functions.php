<?php
	//Checks whether Database exists
	function check_database($database, $host, $user, $password){
		$login = new mysqli($host, $user, $password);
		if ($login){
			$select = mysqli_select_db($login, $database);
			if($select)
				return true;
		}
		return false;
	}

	//Checks whether user exists
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

	//Get user's ID by username
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

	//return full row
	function get_row_array($sqli, $str_database){
		$stmt_row = $sqli->prepare("SELECT * FROM ".$str_database." WHERE id = ?");
		if ($stmt_row){
			$stmt_row->bind_param("i", $_SESSION['user_id']);
			$stmt_row->execute();
			$row_temp = $stmt_row->get_result();
			$array_temp = $row_temp->fetch_array();
			$stmt_row->close();
			return $array_temp;
		}
		return null;
	}

	//Checks whether session is active (via Ternary Operation (from php.net on session_status()))
	function check_status(){
		return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
	}

	function log_out(){
		session_unset();
		session_destroy(); 
		Header('Location: /');
	}
?>