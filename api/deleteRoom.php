<?php
// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE");

require 'db.php';

$id = $_GET["id"];
// $id = $request->getAttribute('id');
$sql = "DELETE FROM room WHERE roomID = $id";

try {
    // Get DB Object
    $db = new db();
    // Connect
    $db = $db->connect();

    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    $db = null;
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
