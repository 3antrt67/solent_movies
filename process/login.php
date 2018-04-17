<?php
include "../includes/database.php";
session_start();

$now = date("Y-m-d | H:i:s");

if(isset($_POST['signIn'])) {
	$username = $_POST['usernameLogin'];
	$password = $_POST['password'];
	
	if(empty($username)) {
		exit("<h1>A Username is required to login</h1>");
	}
	if(empty($password)) {
		exit("<h1>Please enter a password</h1>");
	}
	
	$password = md5($password);
	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$results = $conn->query($query);
	if($results->rowCount() == 1) {
		$_SESSION['username'] = $username;
		$isloggedin = 1;
		$IP = $_SERVER['REMOTE_ADDR'];
		$check = "SELECT * FROM login_sessions WHERE username='$username'";
		$exist = $conn->query($check);
		if($exist->rowCount() == 1) {
			$update = "UPDATE login_sessions SET IP_address='$IP', last_login='$now', current_status='$isloggedin' WHERE username='$username'";
			$conn->query($update);
			header('location: ../index_auth.php');
		} else {
			$status = "INSERT INTO login_sessions (username, IP_address, last_login, current_status) VALUES('$username', '$IP', '$now', '$isloggedin')";
			$conn->query($status);
			header('location: ../index_auth.php');
		}
	} else {
		exit("<h1>Wrong username/password has been entered");
	}
}
