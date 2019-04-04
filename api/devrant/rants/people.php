<?php
    header('Content-Type: application/json');
    require_once("../external.php");

    if ($_SERVER["REQUEST_METHOD"] === "GET"){

        if(!isset($_GET["id"])){
            echo json_encode(['success' => FALSE, 'error' => 'No Rant ID Provided']);
            return;
        }

        $rant_id = $_GET["id"];

        $rant = getRant($rant_id);

        if($rant == NULL){
            return;
        }

        $users = [$rant["rant"]["user_username"]];

        foreach($rant["comments"] as $comment){
            array_push($users, $comment["user_username"]);
        }

        echo json_encode(['success' => TRUE, 'users' => array_values($users) ]);
        
    }else{
        echo json_encode(['success' => FALSE, 'error' => 'Invalid Method']);
    }
?>