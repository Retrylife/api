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
    if(isset($_GET["year"])){
        $year = $_GET["year"];
    } else {
        $year = currentSeason($api_key);
    }

    if(!isset($_GET["sort"])){
        echo json_encode(['success' => FALSE, 'error' => 'No Sort Type Provided']);
        return;
    }

    if(!isset($_GET["k"])){
        echo json_encode(['success' => FALSE, 'error' => 'No Sort Key Provided']);
        return;
    }

    if(!isset($_GET["event"])){
        echo json_encode(['success' => FALSE, 'error' => 'No Event Provided']);
        return;
    }

    // Get api key
    $api_key = $_GET["key"];
    $sort = $_GET["sort"];
    $k = $_GET["k"];
    $event = $_GET["event"];

    // Get data form frc api
    $data = getRanking($api_key, $year, $event, $sort, $k);

    if ($data == null){
        return;
    }

    // Respond with status and api key
    echo json_encode(['success' => TRUE, 'rankings' => $data]);
    return;
    
} else {
    echo json_encode(['success' => FALSE, 'error' => 'Invalid Method']);
}
?>