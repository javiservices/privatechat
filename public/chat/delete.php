<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['name'] == 'admin') {
    if (file_put_contents('messages.json', "") !== false) {
        echo json_encode(["status" => "OK"]);
    }
}