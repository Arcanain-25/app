<?php
session_start();
if (!isset($_SESSION['username']) || empty($_POST['message'])) exit;

$mysqli = new mysqli("localhost", "root", "", "rpg_database");
if ($mysqli->connect_error) exit;

$user = $mysqli->real_escape_string($_SESSION['username']);
$msg = $mysqli->real_escape_string($_POST['message']);

$mysqli->query("INSERT INTO chat_messages (username, message) VALUES ('$user', '$msg')");
?>
