<?php
    header('Content-Type: application/json');
    require_once("../external.php");

    if ($_SERVER["REQUEST_METHOD"] === "GET"){

        $new_ids = newestIds();

        $id_diff = $new_ids[0][0] - $new_ids[1][0];
        $time_diff = $new_ids[0][1] - $new_ids[1][1];

        echo json_encode(['success' => TRUE, 'newest_id' => $new_ids[0][0], 'newest_time' => $new_ids[0][1], 'id_gap' => $id_diff, 'time_gap' => $time_diff ]);
        
    }else{
        echo json_encode(['success' => FALSE, 'error' => 'Invalid Method']);
    }

?>