<?php

require_once('functions_general.php');

function get_result(){
	$result_sqli = new mysqli("localhost", "root", "", "test");
	if($result_sqli){
		$stmt_getresult = $result_sqli->prepare("SELECT result FROM save WHERE id = ?");
		if ($stmt_getresult){
			$stmt_getresult->bind_param("i", $_SESSION['user_id']);
			$stmt_getresult->execute();
			$row_result = $stmt_getresult->get_result();
			$value = $row_result->fetch_object();
			return $value->result;
		}
	}
	return 0;
}

?>