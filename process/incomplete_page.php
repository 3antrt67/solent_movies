<?php
include "../includes/database.php";
session_start();

$out = array();

$sql = "SELECT * FROM `movies` WHERE `director` is NULL OR `director` = '' OR `name` is NULL OR `name` = '' OR `poster` is NULL OR `poster` = '' OR `actor` is NULL OR `actor` = '' OR `release_date` is NULL OR `release_date` = '' OR `synopsis` is NULL OR `synopsis` = ''";
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