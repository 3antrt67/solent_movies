<?php 
include "includes/database.php";
session_start();

$out = array('error' => false);

$users = array();
$isloggedin = 1;

$sql = "SELECT * FROM login_sessions WHERE current_status='$isloggedin'";
$query = $conn->query($sql);

while($row = $query->fetch()){
    array_push($users, $row);
}

$out['users'] = $users;

header("Content-type: application/json");
echo json_encode($out);
die();

?>