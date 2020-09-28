<?php
session_start();
require_once('functions_general.php');

if(!isset($_SESSION['username']))
	Header ('Location: /');

if (isset($_POST['log-out']))
	log_out();
?>