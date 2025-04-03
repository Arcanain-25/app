<?php
// Параметры подключения к базе данных
$servername = "localhost";
$username = "root"; // Замените на имя пользователя вашей базы данных
$password = ""; // Замените на пароль вашей базы данных
$dbname = "rpg_database"; // Используйте вашу базу данных "rpg_database"

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Хешируем пароль
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Проверка на существование пользователя с таким email
    $sql_check = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        echo "Этот email уже зарегистрирован.";
    } else {
        // Запрос на добавление пользователя в базу данных
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Пользователь успешно зарегистрирован!";
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    }

    // Закрытие соединения
    $conn->close();
}
?>
