<?php
include "../includes/database.php";
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST") {
	
	$recaptcha_secret = "6LfsN08UAAAAAGY50bwOZOUpoaaCvJ4ysbfOx9Ka";
	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
	$response = json_decode($response, true);
	
	if($response["success"] === true) {
		if(isset($_POST['submit'])) {
			$username = $_POST['username'];
			$email = $_POST['email_reg'];
			$password_1 = $_POST['password_1'];
			$password_2 = $_POST['password_2'];
			
			if($password_1 != $password_2) {
				echo "<h1>Please enter the same password in both fields</h1>";
			}
			
			$username_check = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
			$result = mysqli_query($conn, $username_check);
			$user = mysqli_fetch_assoc($result);
			
			if($user) {
				if($user['username'] === $username) {
					echo "<h1>Username already exists</h1>";
				}
				
				if($user['email'] === $email) {
					echo "<h1>Email already exists</h1>";
				}
			}
			
			$password = md5($password_1);
			
			$query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
			mysqli_query($conn, $query);
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "<h1>You are now logged in. Welcome $username!</h1>";
		}
	}
}