<?php
session_start();
require "connect_function.php";
error_reporting(0);

if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['submit_login'])){
		//client login process, check if user exist and password is correct.
		//Escape contact number to protect against SQL injection.

		$email = $mysqli->escape_string($_POST['adminName']);
		//$password = $mysqli->escape_string(md5($_POST['password']));
		$password = $mysqli->escape_string($_POST['password']);

		$sql = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$_SESSION['fname'] = $row['name'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['App_Log_Access'] = true;
			header("Location: ../page/dashboard.php");
		} else {
			header("Location: ../index.php?logFailed=1");
			
		}
	}

}

?>