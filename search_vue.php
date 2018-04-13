<?php
include "includes/database.php";
 
$out = array('error' => false);
 
$action = 'search';
 
if($action == 'search'){
	$keyword = $_POST['keyword'];
	$sql = "SELECT * FROM movies WHERE name LIKE '%$keyword%'";
	$query = $conn->query($sql);
	$movies = array();
 
	while($row = $query->fetch()){
		array_push($movies, $row);
	}
 
	$out['movies'] = $movies;
}
 
header("Content-type: application/json");
echo json_encode($out);
die();
 
?>