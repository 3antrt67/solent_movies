<?php
include "../includes/database.php";
session_start();

$out = array('error' => false);

$movid = $_POST['id'];

$comments = "SELECT * FROM comments WHERE movie_id='$movid'";
$query = $conn->query($comments);
$coms = array();

while($row = $query->fetch()){
    array_push($coms, $row);
}

$out['comments'] = $coms;

header("Content-type: application/json");
echo json_encode($out);
die();

?>