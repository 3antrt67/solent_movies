<?php
include "../includes/database.php";

$search_term = $_GET['search_term'];

// query the database for results
$result = $conn->query("SELECT * FROM movies WHERE name LIKE '%$search_term%'");

if ($result->rowCount() == 0) {
	echo "<h1>No results found for: " . $search_term . "</h1>";
}
else
{
	//keep looping until another record to get
	echo "<h1>Your search results - </h1>";
	while($record = $result->fetch()) {
	  echo "<h2>" . $record["name"] . "</h2>";
	  echo "<td>";
	  echo "<img src=" . $record["poster"] . " />";
	  echo "<p>Director: " . $record["director"] . "</p>";
	  echo "<p>Actors: " . $record["actor"] . "</p>";
	  echo "<p>" . $record["release_date"] . "</p>";
	}
}
?>