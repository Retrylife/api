<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Construct api key
    $api_key = base64_encode($_POST["user"].":".$_POST["pass"]);

    // Check if the key is valid
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://frc-api.firstinspires.org/v2.0/2018/alliances/onwat");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Accept: application/xml",
    "Authorization: Basic ".$api_key
    ));

    curl_exec($ch);
    $response = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
    curl_close($ch);
    
    if ($response != "200"){
        echo json_encode(['success' => FALSE, 'error' => 'Invalid Credentials']);
        return;
    }


    // Save in a cookie for 10 days
    setcookie("frc_api_key", $api_key, time() + (60*60*24*10));

    // Respond with status and api key
    echo json_encode(['success' => TRUE, 'key' => $api_key]);
}else{
    echo json_encode(['success' => FALSE, 'error' => 'Invalid Method']);
}
?>