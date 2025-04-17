<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "rpg_database");

// Проверка соединения с базой данных
if ($mysqli->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Ошибка подключения к базе данных']));
}

// Проверяем, что запрос выполнен методом POST и есть параметр 'vote_type'
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vote_type'])) {
    $vote_type = $_POST['vote_type'];  // Получаем тип голоса (up или down)

    // Если голос за, увеличиваем количество голосов
    if ($vote_type === 'up') {
        $mysqli->query("UPDATE votes SET count = count + 1 WHERE id = 1");
    } 
    // Если голос против, уменьшаем количество голосов
    elseif ($vote_type === 'down') {
        $mysqli->query("UPDATE votes SET count = count - 1 WHERE id = 1");
    }

    // Получаем актуальное количество голосов
    $result = $mysqli->query("SELECT count FROM votes WHERE id = 1");
    $row = $result->fetch_assoc();

    // Возвращаем результат в формате JSON
    echo json_encode(['status' => 'success', 'vote_count' => $row['count']]);
} else {
    // Если не был передан параметр vote_type
    echo json_encode(['status' => 'error', 'message' => 'Не указан тип голоса']);
}
?>

