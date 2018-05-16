<?php
include "includes/database.php";
session_start();

$out = array('error' => false);
$now = date("Y-m-d | H:i:s");
$creator = $_SESSION['username'];

$movid = $_POST['id'];
$title = $_POST['name'];

$delete = "DELETE FROM `movies` WHERE id='$movid'";
$query = $conn->query($delete);

if($query) {
	$out['message'] = "Film deleted successfully";
}
else {
	$out['error'] = true;
	$out['message'] = "Could not delete Film";
}

header("Content-type: application/json");
echo json_encode($out);
die();

?>