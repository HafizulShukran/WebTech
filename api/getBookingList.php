<?php

header('Content-Type: application/json');

require 'db.php';

$sql = "SELECT * from booking";

try {
    $db = new db();
    $db = $db->connect();

    $stmt = $db->query($sql);
    $user = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    echo json_encode($user);
} catch (PDOException $e) {
    $data = array(
        "status" => "fail"
    );
    echo json_encode($data);
}