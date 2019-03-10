<?php
header('Content-Type: application/json');
require_once('../external.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check is a key has been set
    if(!isset($_GET["key"])){
        echo json_encode(['success' => FALSE, 'error' => 'No API Key']);
        return;
    }

    // Check if team has been set
    if(!isset($_GET["team"])){
        echo json_encode(['success' => FALSE, 'error' => 'No Team Provided']);
        return;
    }

    // Get api key
    $api_key = $_GET["key"];

    // Get year
    $team = $_GET["team"];

    // Get current game year
    $year = currentSeason($api_key);
    $min_rookie = gameInfo($api_key, $year)["rookieStart"];

    if ($min_rookie <= intval($team)){
        $rookie = TRUE;
    }else{
        $rookie = FALSE;
    }


    // Respond with status and api key
    echo json_encode(['success' => TRUE, 'rookie' => $rookie]);
    return;
    
} else {
    echo json_encode(['success' => FALSE, 'error' => 'Invalid Method']);
}
?>