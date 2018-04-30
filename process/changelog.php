<?php
include "../includes/database.php";
session_start();

$out = array();

$sql = "SELECT * FROM `modifications`";
$query = $conn->query($sql);
$changes = array();

while($row = $query->fetch()){
    array_push($changes, $row);
}

$out['changes'] = $changes;

header("Content-type: application/json");
echo json_encode($out);
die();

?>