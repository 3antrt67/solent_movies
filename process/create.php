<?php
include "../includes/database.php";
session_start();

if(isset($_POST['createPage'])) {
	$title = $_POST['filmTitle'];
	$poster = $_POST['poster'];
	$directors = $_POST['directors'];
	$actors = $_POST['actors'];
	$release = $_POST['releaseDate'];
	$synopsis = $_POST['synopsis'];
	$now = date("Y-m-d | h:i:s");
	$creator = $_SESSION['username'];
} else {
	exit("<h1>Please complete all fields</h1>");
}
	$duplicate_check = $conn->prepare("SELECT * FROM movies WHERE name='$title' LIMIT 1");
	$duplicate_check->execute();
	if($duplicate_check->rowCount() > 0) {
		exit("<h1>Film already exists in database</h1>");
	} else {
		$query = "INSERT INTO movies (poster, name, director, actor, release_date, synopsis, created_by, created_time) VALUES('$poster', '$title', '$directors', '$actors', '$release', '$synopsis', '$creator', '$now')";
		$conn->query($query);
		echo("<h1>You have successfully created" . $title . "'s film page!</h1>");
		sleep(5);
		header("Location: ../index_auth.php", true, 303);
		exit;
}
?>
		