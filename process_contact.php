<?php
include "database.php";

$name = $_POST["name"];
$message = $_POST["message"];

$conn->query("INSERT INTO contact (name, message, contact_date) VALUES('$name', '$message', 'NOW()')");

echo "<h1>Confirmation</h1>
		<p>Your name is $name and your message is $message.</p>
";
?>