<?php
header('Content-Type: application/json');
require_once("../external.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check is a key has been set
    if(!isset($_GET["key"])){
        echo json_encode(['success' => FALSE, 'error' => 'No API Key']);
        return;
    }

    // Check if year has been set
    if(!isset($_GET["year"])){
        echo json_encode(['success' => FALSE, 'error' => 'No Year Provided']);
        return;
    }

    // Get api key
    $api_key = $_GET["key"];

    // Get year
    $year = $_GET["year"];

    // Get data form frc api
    $data = gameInfo($api_key, $year);

    if ($data == null){
        return;
    }

    // Respond with status and api key
    echo json_encode(['success' => TRUE, 'season' => $data]);
    return;
    
} else {
    echo json_encode(['success' => FALSE, 'error' => 'Invalid Method']);
}
?>