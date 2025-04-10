<?php
session_start();
include('db_connect.php'); // Подключаем файл с настройками для базы данных

// Проверка, если данные переданы через GET
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['username']) && isset($_GET['password'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];

    // Проверяем, существует ли пользователь с таким username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Сравниваем пароль (без хеширования)
        if ($password === $user['password']) {
            // Сохраняем информацию о пользователе в сессии
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Перенаправляем на страницу личного кабинета
            header("Location: profile.php");
            exit();
        } else {
            $error = "Неверный пароль!";
        }
    } else {
        $error = "Пользователь с таким именем не найден!";
    }

    // Закрытие подготовленного запроса
    $stmt->close();
}

// Закрытие соединения с базой данных в самом конце
// Закрытие соединения можно сделать позже, если необходимо, но не в момент выполнения запроса.
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в RPG</title>
    <link rel="stylesheet" href="CSS/styles7.css">
</head>
<body>

<video autoplay muted loop id="bg-video">
        <source src="https://www.desktophut.com/files/o7dQQuI96xjqpHx_Space%20DreamScene%20Live%20Wallpaper.mp4" type="video/mp4">
        Ваш браузер не поддерживает видео.
    </video>


    <div class="container">
        <h1>⚔️ Вход в RPG - Приключение ⚔️</h1>
        <p>Введите ваше имя пользователя и пароль</p>

        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="login.php" method="GET">
            <input type="text" name="username" placeholder="Имя пользователя" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Войти</button>
        </form>

        <p>Нет аккаунта? <a href="register.php">Зарегистрируйтесь</a></p>
    </div>

    <footer>☽ &copy; 2025 RPG Adventure</footer>
</body>
</html>
