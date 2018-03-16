<?php
include "database.php";

$name = $_POST["name"];
$message = $_POST["message"];
$now = date("Y-m-d h:i:sa");

$conn->query("INSERT INTO contact (name, message, contact_date) VALUES('$name', '$message', '$now')");

echo "<h1>Confirmation</h1>
		<p>Your name is $name and your message is $message.</p>
";
?>