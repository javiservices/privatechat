<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['name'] == 'admin') {
    file_put_contents('../chat/messages.json', "");
}
session_destroy();

header('Location: ../index.php');