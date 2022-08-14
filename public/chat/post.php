<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$jsonFile = "messages.json";
$messages = json_decode(file_get_contents($jsonFile), 1);
$messages[] = [
    'user' => $_SESSION['name'],
    'msg' => $_POST['msg'],
    'time' => date('H:i')
];

if (file_put_contents($jsonFile, json_encode($messages)) !== false) {
    echo json_encode(["status" => "OK"]);
}