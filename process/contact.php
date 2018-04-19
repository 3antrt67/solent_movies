<?php

include "../includes/database.php";

$out = array('error' => false);

$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];
$now = date("Y-m-d | H:i:s");

$result = $conn->query("INSERT INTO contact (name, email, message, contact_date) VALUES('$name', '$email', '$message', '$now')");

if($result) {
    $out['message'] = "Your request has been received successfully";
}
else {
    $out['error'] = true;
    $out['message'] = "Could not send request";
}

header("Content-type: application/json");
echo json_encode($out);
die();

?>