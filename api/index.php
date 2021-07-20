<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require 'db.php';

$app = new \Slim\App;

$app->get('/room', function (Request $request, Response $response, array $args) {
    
    $sql = "SELECT * FROM room";
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
});

$app->get('/room/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $sql = "SELECT * FROM room WHERE roomID = $id";
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
});


$app->post('/room', function (Request $request, Response $response, array $args) {
    $allPostPutVars = $request->getParsedBody();
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);

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
    }
  
});


$app->put('/room/status/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $allPostPutVars = $request->getParsedBody();
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE); 
    
    $roomStatus = $input["roomStatus"];
    
    
    try {
        $sql = "UPDATE room SET roomStatus = :roomStatus  WHERE roomID = $id";
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        
        $stmt->bindParam(':roomStatus', $roomStatus);
        
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
    }
    
});

$app->delete('/room/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $sql = "DELETE FROM room WHERE roomID = $id";
    try {
        $db = new db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);
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
    }
});

$app->run();    