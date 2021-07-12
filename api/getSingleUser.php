<?php
// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE");

require 'db.php';

$id= $_GET["id"];
$sql = "SELECT * FROM user WHERE userID = $id";

try{
    $db = new db();
    $db = $db->connect();

    $stmt = $db->query($sql);
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    $db = null;
    echo json_encode($user);
} catch(PDOException $e){
    $data = array(
        "status" => "fail"
    );
    echo json_encode($data);
}