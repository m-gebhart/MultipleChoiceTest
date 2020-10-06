<?php


require_once('functions_general.php');

function check_login($sqli, $username, $password){
	$stmt_checklogin = $sqli->prepare("SELECT * FROM users WHERE users.username = ? AND users.password = ?");
	$stmt_checklogin->bind_param("ss", $username, $password);
	$stmt_checklogin->execute();
	$stmt_checklogin->store_result();

	$row_cnt = $stmt_checklogin->num_rows;
	$stmt_checklogin->close();
	if($row_cnt == 1)
		return true;
	return false;
}

?>