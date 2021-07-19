<?php

require 'db.php';

$inputJSON=file_get_contents('php://input');
$input=json_decode($inputJSON,TRUE);

$roomNo = $_POST["roomNo"];
$roomType = $_POST["roomType"];
$roomImage = "defaultRoom.jpg";
$roomPrice = $_POST["roomPrice"];
$roomStatus = "available";

try {
    $sql = "INSERT INTO room (roomNo,roomType,roomImage,roomPrice,roomStatus) VALUES (:roomNo,:roomType,:roomImage,:roomPrice,:roomStatus)";
    $db = new db();
    // Connect
    $db = $db->connect();
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':roomNo', $roomNo);
    $stmt->bindValue(':roomType', $roomType);
    $stmt->bindValue(':roomImage', $roomImage);
    $stmt->bindValue(':roomPrice', $roomPrice);
    $stmt->bindValue(':roomStatus', $roomStatus);

    $stmt->execute();
    $count = $stmt->rowCount();
    $db = null;

    $data = array(
        "status" => "success",
        "rowcount" => $count
    );
    echo json_encode($data);
} catch (PDOException $e) {
    $data = array(
        "status" => "fail"
    );
    echo json_encode($data);
    echo $e;
}