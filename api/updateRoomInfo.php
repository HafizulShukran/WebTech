<?php
 header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE");

require 'db.php';
$inputJSON=file_get_contents('php://input');
$input=json_decode($inputJSON,TRUE);

$id= $_GET["id"];
$roomNo = $_POST["roomNo"];
$roomType = $_POST["roomType"];
$roomPrice = $_POST["roomPrice"];

$sql = "UPDATE room SET roomNo = :roomNo,roomType=:roomType,roomPrice=:roomPrice  WHERE roomID = $id";

try{
    $db = new db();
    $db = $db->connect();
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':roomNo', $roomNo);
    $stmt->bindParam(':roomType', $roomType);
    $stmt->bindParam(':roomPrice', $roomPrice);

    
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