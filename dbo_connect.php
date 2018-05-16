<?php
include "includes/database.php";

$search_term = $_GET['search_term'];

$sql = "SELECT * FROM movies WHERE name LIKE '%$search_term%'";
$query = $conn->query($sql);
$movies = array();
while($row = $query->fetch()){
	array_push($movies, $row);
}
 
$out['movies'] = $movies;
 
header("Content-type: application/json");
echo json_encode($out);
die();
 
 
?>