<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "rpg_database");
if ($mysqli->connect_error) {
    exit('Ошибка подключения: ' . $mysqli->connect_error);
}

// Проверка, был ли передан параметр 'username' в GET-запросе
if (isset($_GET['username']) && !empty($_GET['username'])) {
    $username = $mysqli->real_escape_string($_GET['username']); // Получаем имя игрока

    // Выполняем запрос для поиска сообщений с этим именем пользователя
    $query = "SELECT * FROM chat_messages WHERE username LIKE '%$username%' ORDER BY id DESC LIMIT 10"; // Ищем до 10 сообщений
    $result = $mysqli->query($query);

    // Проверяем, есть ли результаты
    if ($result->num_rows > 0) {
        // Выводим каждый найденный результат
        while ($row = $result->fetch_assoc()) {
            echo "<div class='message'><strong>" . htmlspecialchars($row['username']) . "</strong>: " . htmlspecialchars($row['message']) . "</div>";
        }
    } else {
        echo "<p>Сообщения для пользователя '$username' не найдены.</p>";
    }
} else {
    echo "<p>Введите имя пользователя для поиска.</p>";
}

$mysqli->close();
?>
