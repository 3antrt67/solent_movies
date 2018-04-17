<?php
include "includes/database.php";

$sql = "SELECT * FROM movies WHERE created_time >= (CURDATE() + INTERVAL -14 DAY) LIMIT 19";
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