<?php

function request($endpoint, $params){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://devrant.com/api".$endpoint."?".$params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Accept: application/json"
    ));

    $data = curl_exec($ch);
    $response = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
    curl_close($ch);
    
    if ($response == 400){
        echo json_encode(['success' => FALSE, 'error' => 'Bad Request']);
        return null;
    } else if ($response != "200"){
        echo json_encode(['success' => FALSE, 'error' => 'API Error']);
        return null;
    }

    // Respond with status and api key
    $json_data = json_decode($data, true);

    if($json_data["success"]){
        return $json_data;
    }else{
        echo json_encode(['success' => FALSE, 'error' => 'External API Error']);
        return null;
    }
}

function newestIds(){
    $rants = request("/devrant/rants", "app=3&sort=recent&limit=2");
    $ids = [[$rants["rants"][0]["id"], $rants["rants"][0]["created_time"]], [$rants["rants"][1]["id"], $rants["rants"][1]["created_time"]]];
    return $ids;
}

function getRant($id){
    return request("/devrant/rants/".$id, "app=3");
}
    

?>