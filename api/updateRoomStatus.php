<?php

require 'db.php';
$inputJSON=file_get_contents('php://input');
$input=json_decode($inputJSON,TRUE);

$id = $_GET["id"];
$roomStatus = $_POST["roomStatus"];

$sql = "UPDATE room SET roomStatus = :roomStatus  WHERE roomID = $id";

try {   

    $db = new db();
    $db = $db->connect();

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':roomStatus', $roomStatus);

    $stmt->execute();
    $count = $stmt->rowCount();

    $data = array(
        "rowAffected" => $count,
        "status" => "success"
    );
    echo json_encode($data);
} catch (PDOException $e) {
    $data = array(
        "status" => "fail"
    );
    echo json_encode($data);
}