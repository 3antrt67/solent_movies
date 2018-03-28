<?php
include "../includes/database.php";
session_start();

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
		$_SESSION['success'] = "You have successfully logged in";
		header('location: ../index_auth.php');
	} else {
		exit("<h1>Wrong username/password has been entered");
	}
}
