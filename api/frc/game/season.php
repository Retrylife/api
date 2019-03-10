<?php
header('Content-Type: application/json');
require_once("../external.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check is a key has been set
    if(!isset($_GET["key"])){
        echo json_encode(['success' => FALSE, 'error' => 'No API Key']);
        return;
    }
    // Get api key
    $api_key = $_GET["key"];

    // Get data from frc api
    $season = currentSeason($api_key);
    if ($season == null){
        return;
    }

    echo json_encode(['success' => TRUE, 'season' => $season]);
    return;
    
} else {
    echo json_encode(['success' => FALSE, 'error' => 'Invalid Method']);
}
?>