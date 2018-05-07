<?php
include "../includes/database.php";
session_start();

$out = array('error' => false);
$now = date("Y-m-d | H:i:s");

$user = $_SESSION['username'];
$content = $_POST['comment'];
$movid = $_POST['id'];

$commit = "INSERT INTO comments (username, content, timestamp, movie_id) VALUES('$user', '$content', '$now', '$movid')";
$query = $conn->query($commit);

if($query) {
    $out['message'] = "Comment added successfully";
}
else {
    $out['error'] = true;
    $out['message'] = "Could not add comment";
}

header("Content-type: application/json");
echo json_encode($out);
die();

?>
