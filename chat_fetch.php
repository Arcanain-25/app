<?php
$mysqli = new mysqli("localhost", "root", "", "rpg_database");
if ($mysqli->connect_error) exit;

$result = $mysqli->query("SELECT * FROM chat_messages ORDER BY id DESC LIMIT 20");
$rows = array_reverse($result->fetch_all(MYSQLI_ASSOC));

foreach ($rows as $row) {
    echo "<p><strong style='color:#f39c12'>" . htmlspecialchars($row['username']) . "</strong>: " . htmlspecialchars($row['message']) . "</p>";
}
?>
