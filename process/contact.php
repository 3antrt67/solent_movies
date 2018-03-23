<?php

include "../includes/database.php";

$name = $_POST["name"];
$message = $_POST["message"];
$now = date("Y-m-d | h:i:s");

$result = $conn->query("INSERT INTO contact (name, message, contact_date) VALUES('$name', '$message', '$now')");

?>