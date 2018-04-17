<?php
include "../includes/database.php";
session_start();

$username = $_SESSION['username'];
$isloggedin = 0;
$logout = "UPDATE login_sessions SET current_status='$isloggedin' WHERE username='$username'";
$conn->query($logout);
unset($_SESSION['username']);
session_destroy();
session_write_close();
header('Location: ../index.php');
die;
?>