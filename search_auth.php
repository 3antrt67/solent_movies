<?php
include "includes/database.php";
session_start();

$out = array('error' => false);
$now = date("Y-m-d | H:i:s");
$creator = $_SESSION['username'];

$movie = 'modify';

if($movie == 'modify'){

    $movid = $_POST['id'];
    $title = $_POST['name'];
    $poster = $_POST['poster'];
    $director = $_POST['director'];
    $actor = $_POST['actor'];
    $release = $_POST['release_date'];
    $synopsis = $_POST['synopsis'];

    $sql = "UPDATE movies SET name='$title', poster='$poster', director='$director', actor='$actor', release_date ='$release', synopsis='$synopsis' WHERE id ='$movid'";
    $change = "INSERT INTO `modifications` (page, author, time) VALUES('$title', '$creator', '$now')";
    $conn->query($change);
    $query = $conn->query($sql);

    if($query) {
        $out['message'] = "Film modified successfully";
    }
    else {
        $out['error'] = true;
        $out['message'] = "Could not modify movie";
    }
}

header("Content-type: application/json");
echo json_encode($out);
die();

?>