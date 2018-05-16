<?php
include "includes/database.php";
session_start();

$out = array('error' => false);
$now = date("Y-m-d | H:i:s");
$creator = $_SESSION['username'];

$actor == 'modify';

if($actor == 'modify'){

    $actid = $_POST['id'];
    $name = $_POST['name'];
    $profile = $_POST['profile'];
    $age = $_POST['age'];
    $bio = $_POST['bio'];

    $sql = "UPDATE actors SET name='$name', profile='$profile', age='$age', bio='$bio' WHERE id ='$actid'";
    $change = "INSERT INTO `modifications` (page, author, time) VALUES('$name', '$creator', '$now')";
    $conn->query($change);
    $query = $conn->query($sql);

    if($query) {
        $out['message'] = "Actor modified successfully";
    }
    else {
        $out['error'] = true;
        $out['message'] = "Could not modify actor";
    }
}

header("Content-type: application/json");
echo json_encode($out);
die();

?>