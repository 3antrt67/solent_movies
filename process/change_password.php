<html>
<head>
    <div class="container">
	    <nav class="navbar">
		    <a class="navbar-brand" href="../index_auth.php">
			    <img src="../images/ssu-logo.svg">
		    </a>
        </nav>
    </div>
</head>
    <h2>Change Password form</h2>
    <br/>
    <form method="POST">
		<div class="form-group">
			<label class="sr-only" for="old_pass">Old Password:</label>
			<input type="password" class="form-control input" placeholder="Old Password" id="old_pass" name="old_pass">
		</div>
        <br/>
		<div class="form-group">
			<label class="sr-only" for="new_pass0">New Password:</label>
			<input type="password" class="form-control input" placeholder="New Password" id="new_pass0" name="new_pass0">
		</div>
        <br/>
		<div class="form-group">
			<label class="sr-only" for="new_pass1">Confirm New Password:</label>
			<input type="password" class="form-control input" placeholder="Confirm Password" id="new_pass1" name="new_pass1">
		</div>
        <br/>
        <button type="submit" name="confirm" id="confirm" class="btn btn-success">Change Password</button>
    </form>
</html>

<?php
session_start();
include "../includes/database.php";
$password = $_POST["old_pass"];
$newpass0 = $_POST["new_pass0"];
$newpass1 = $_POST["new_pass1"];
$username = $_SESSION["username"];

if(isset($_POST["confirm"])) {
    if(empty($password)) {
        echo("<h1>Please enter your current password</h1>");
    }
    if(empty($newpass0)) {
        echo("<h1>Please enter new password</h1>");
    }
    if(empty($newpass1)) {
        echo("<h1>Please confirm new password</h1>");
    }
    if($newpass0 != $newpass1) {
        echo("<h1>Make sure both new passwords match</h1>");
    }

    echo("<h1>" . $username . "</h1>");
    $hash = md5($password);
    $query = "SELECT * FROM users WHERE `username`='$username' AND `password`='$hash'";
    $check = $conn->query($query);
    if($check->rowCount() == 1) {
        $new = md5($newpass0);
        $update = "UPDATE users SET `password`='$new' WHERE `username`='$username'";
        $commit = $conn->query($update);
        if($commit) {
            echo("<h1>Password changed successfully</h1>");
            echo('<a href="../index_auth.php">Return to Home</a>');
        }
        else {
            echo("<h1>Something went wrong during password change</h1>");
        }
    }
}

?>