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
	$now = date("Y-m-d | H:i:s");
	$creator = $_SESSION['username'];
} else {
	exit("<h1>Please complete all fields</h1>");
}
	$duplicate_check = $conn->prepare("SELECT * FROM movies WHERE name='$title' LIMIT 1");
	$duplicate_check->execute();
	if($duplicate_check->rowCount() > 0) {
		exit("<h1>Film already exists in database</h1>");
	} else {
		$meta = str_replace(" ", "-", $title);
		$ratingString = strtolower($meta);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api-marcalencc-metacritic-v1.p.mashape.com/movie/" . $ratingString);
		curl_setopt($ch, 1, CURLOPT_GET);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$headers = [
    		'X-Mashape-Key: 7gZBID6E0qmshW2KB4oR1PCBKJrWp1crEp9jsn78idKvabQ2A9',
    		'Accept: application/json'
		];
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$output = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($output, true);
		$rating = ($result["0"]["Rating"]["CriticRating"]);
		$query = "INSERT INTO movies (poster, name, director, actor, release_date, synopsis, metacritic, created_by, created_time) VALUES('$poster', '$title', '$directors', '$actors', '$release', '$synopsis', '$rating', '$creator', '$now')";
		$conn->query($query);
		echo("<h1>You have successfully created" . $title . "'s film page!</h1>");
		sleep(2);
		header("Location: ../index_auth.php", true, 303);
		exit;
}
?>
		