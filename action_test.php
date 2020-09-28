<?php
	session_start();
	require_once('functions_test.php');

	if(!isset($_SESSION['username']))
		Header ('Location: /');

	if(isset($_GET['on_retry'])){
		if ($_GET['on_retry'] == "true")
			reset_save();
	}

	if(isset($_POST['log-out']))
		log_out();

	if(isset($_POST['save']))
		save();	
		
	if(isset($_POST['reset']))
		reset_save();

	if(isset($_POST['submit']))
		submit_test();
?>