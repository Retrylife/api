<?php
function currentSeason($api_key){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://frc-api.firstinspires.org/v2.0/season");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Accept: application/xml",
    "Authorization: Basic ".$api_key
    ));

    $data = curl_exec($ch);
    $response = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
    curl_close($ch);
    
    if ($response === "401"){
        echo json_encode(['success' => FALSE, 'error' => 'Invalid API Key']);
        return null;
    } else if ($response != "200"){
        echo json_encode(['success' => FALSE, 'error' => 'API Error']);
        return null;
    }

    // Respond with status and api key
    // echo $data;
    $xml = simplexml_load_string($data);
    return json_decode($xml->currentSeason);
}

function gameInfo($api_key, $year){
    // Get data from frc api
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://frc-api.firstinspires.org/v2.0/season".$year);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Accept: application/xml",
    "Authorization: Basic ".$api_key
    ));

    $data = curl_exec($ch);
    $response = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
    curl_close($ch);
    
    if ($response === "401"){
        echo json_encode(['success' => FALSE, 'error' => 'Invalid API Key']);
        return null;
    } else if ($response != "200"){
        echo json_encode(['success' => FALSE, 'error' => 'API Error']);
        return null;
    }

    // Respond with status and api key
    $json_data = json_decode(json_encode(simplexml_load_string($data)), true);
    return $json_data;
}

function getAvatar($api_key, $team, $year){
    // Get data from frc api
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://frc-api.firstinspires.org/v2.0/".$year."/avatars/?teamNumber=".$team);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Accept: application/xml",
    "Authorization: Basic ".$api_key
    ));

    $data = curl_exec($ch);
    $response = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
    curl_close($ch);
    
    if ($response === "401"){
        echo json_encode(['success' => FALSE, 'error' => 'Invalid API Key']);
        return null;
    } else if ($response != "200"){
        echo json_encode(['success' => FALSE, 'error' => 'API Error']);
        return null;
    }

    // Respond with status and api key
    $json_data = json_decode(json_encode(simplexml_load_string($data)), true)["teams"]["TeamAvatar"]["encodedAvatar"];
    return $json_data;
}

function getEvent($api_key, $year, $event){
    // Get data from frc api
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://frc-api.firstinspires.org/v2.0/".$year."/events?eventCode=".$event);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Accept: application/json",
    "Authorization: Basic ".$api_key
    ));

    $data = curl_exec($ch);
    $response = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
    curl_close($ch);
    
    if ($response === "401"){
        echo json_encode(['success' => FALSE, 'error' => 'Invalid API Key']);
        return null;
    } else if ($response != "200"){
        echo json_encode(['success' => FALSE, 'error' => 'API Error']);
        return null;
    }

    // Respond with status and api key
    $json_data = json_decode($data, true);
    return $json_data;
}

function getRanking($api_key, $year, $event, $sort, $k){

    if($sort === "top"){
        $type = "top=".$k;
    } else {
        $type = "teamNumber=".$k;
    }
    // Get data from frc api
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "https://frc-api.firstinspires.org/v2.0/".$year."/rankings/".$event."?".$type);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Accept: application/json",
    "Authorization: Basic ".$api_key
    ));

    $data = curl_exec($ch);
    $response = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
    curl_close($ch);
    
    if ($response === "401"){
        echo json_encode(['success' => FALSE, 'error' => 'Invalid API Key']);
        return null;
    } else if ($response != "200"){
        echo json_encode(['success' => FALSE, 'error' => 'API Error']);
        return null;
    }

    // Respond with status and api key
    $json_data = json_decode($data, true);
    return $json_data["Rankings"];
}

function getMatches($api_key, $year, $event, $team){

    if($sort === "top"){
        $type = "top=".$k;
    } else {
        $type = "teamNumber=".$k;
    }
    // Get data from frc api
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "https://frc-api.firstinspires.org/v2.0/".$year."/matches/".$event."?teamNumber=".$team);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Accept: application/json",
    "Authorization: Basic ".$api_key
    ));

    $data = curl_exec($ch);
    $response = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
    curl_close($ch);
    
    if ($response === "401"){
        echo json_encode(['success' => FALSE, 'error' => 'Invalid API Key']);
        return null;
    } else if ($response != "200"){
        echo json_encode(['success' => FALSE, 'error' => 'API Error']);
        return null;
    }

    // Respond with status and api key
    $json_data = json_decode($data, true);
    return $json_data["Matches"];
}
?>