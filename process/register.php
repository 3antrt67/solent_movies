<?php
include "../includes/database.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {
	
	$recaptcha_secret = "6LfsN08UAAAAAGY50bwOZOUpoaaCvJ4ysbfOx9Ka";
	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
	$response = json_decode($response, true);
	
	if($response["success"] === true) {
		if(isset($_POST['submit_reg'])) {
			$username = $_POST['username'];
			$email = $_POST['email_reg'];
			$password_1 = $_POST['password_1'];
			$password_2 = $_POST['password_2'];
		} else {
			exit("<h1>Please complete the captcha</h1>");
		}
			
			if($password_1 != $password_2) {
				exit("<h1>Please enter the same password in both fields</h1>");
				
			}
			
			$username_check = $conn->prepare("SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1");
			$username_check->execute();
			if($username_check->rowCount() > 0) {
					exit("<h1>Username already exists</h1>");
				} else {
					$password = md5($password_1);
					$query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
					$conn->query($query);
				}
			//$result = $conn->query($username_check);
			//$user = mysqli_fetch_assoc($result);
	}
}