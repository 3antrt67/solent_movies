<?php
include "includes/database.php";
session_start();

$out = array('error' => false);

$name = $_POST["name"];
$profile = $_POST["profile"];
$age = $_POST["age"];
$bio = $_POST["bio"];

$duplicate_check = $conn->prepare("SELECT * FROM actors WHERE name='$name' LIMIT 1");
$duplicate_check->execute();
if($duplicate_check->rowCount() > 0) {
    $out['error'] = true;
    $out['message'] = "This actor/actress appears to already be in the database";
} else {
    $query = "INSERT INTO actors (name, profile, age, bio) VALUES('$name', '$profile', '$age', '$bio')";
    $final = $conn->query($query);
    if($final) {
        $out['message'] = "The actor/actress has successfully been added";
    } else {
        $out['error'] = true;
        $out['message'] = "Could not commit to database";
    }
}

header("Content-type: application/json");
echo json_encode($out);
die();

?>
