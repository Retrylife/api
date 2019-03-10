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

    // Check if team has been set
    if(!isset($_GET["event"])){
        echo json_encode(['success' => FALSE, 'error' => 'No Event Key Provided']);
        return;
    }

    // Get data
    $api_key = $_GET["key"];
    $event   = $_GET["event"];
    $year    = $_GET["year"];

    // Get data form frc api
    $data = getEvent($api_key, $year, $event)["Events"][0]["webcasts"];

    // Respond with status and api key
    echo json_encode(['success' => TRUE, 'urls' => $data]);
    return;
    
} else {
    echo json_encode(['success' => FALSE, 'error' => 'Invalid Method']);
}
?>