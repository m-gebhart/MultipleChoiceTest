<?php
require_once('functions_register.php');
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['validated_password'])){

	//Creating 'test' database for very first user on localhost
	if(!check_database("test", "localhost", "root", ""))
		create_test_database("localhost", "root", "");


	//Registering in 'test' database
	$sqli = new mysqli("localhost", "root", "", "test");	
	if ($sqli->connect_error) 
		die("Connection to database failed");	
	
	elseif ($sqli)
		register_user($sqli);
}
?>