<?php
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
    if(!isset($_GET["team"])){
        echo json_encode(['success' => FALSE, 'error' => 'No Team Provided']);
        return;
    }

    // Check if type has been set
    if(isset($_GET["type"])){
        $type = $_GET["type"];
    } else {
        $type = "json";
    }

    // Get data
    $api_key = $_GET["key"];
    $year    = $_GET["year"];
    $team    = $_GET["team"];

    // Get data form frc api
    $data = getAvatar($api_key, $team, $year);

    if ($data == null){
        return;
    }

    // Respond with status and api key
    if($type === "html"){
        echo '<img src="data:image/png;base64, '.$data.'" alt="Red dot" />';
        return;
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => TRUE, 'image' => $data]);
        return;
    }
    
} else {
    echo json_encode(['success' => FALSE, 'error' => 'Invalid Method']);
}
?>
        echo json_encode(['success' => FALSE, 'error' => 'No Year Provided']);
        return;
    }

    // Check if team has been set
    if(!isset($_GET["team"])){
        echo json_encode(['success' => FALSE, 'error' => 'No Team Provided']);
        return;
    }

    // Check if type has been set
    if(isset($_GET["type"])){
        $type = $_GET["type"];
    } else {
        $type = "json";
    }

    // Get data
    $api_key = $_GET["key"];
    $year    = $_GET["year"];
    $team    = $_GET["team"];

    // Get data form frc api
    $data = getAvatar($api_key, $team, $year);

    if ($data == null){
        return;
    }

    // Respond with status and api key
    if($type === "html"){
        echo '<img src="data:image/png;base64, '.$data.'" alt="Red dot" />';
        return;
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => TRUE, 'image' => $data]);
        return;
    }
    
} else {
    echo json_encode(['success' => FALSE, 'error' => 'Invalid Method']);
}
?>