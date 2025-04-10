
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация RPG</title>
    <link rel="stylesheet" href="CSS/styles7.css">
</head>
<body>
<video autoplay muted loop id="bg-video">
        <source src="https://www.desktophut.com/files/o7dQQuI96xjqpHx_Space%20DreamScene%20Live%20Wallpaper.mp4" type="video/mp4">
        Ваш браузер не поддерживает видео.
    </video>

    <div class="container">
        <h1>⚔️ RPG - Регистрация ⚔️</h1>
        <p>Присоединяйся к приключению и напиши свою собственную легенду!</p>

        <form action="db_connect.php" method="POST">
            <input type="text" id="username" name="username" placeholder="Ваше имя" required>
            <input type="email" id="email" name="email" placeholder="Ваш email" required>
            <input type="password" id="password" name="password" placeholder="Пароль" required>
            <button type="submit">Зарегистрироваться</button>
        </form>

        <button type="button" onclick="window.location.href='gardian.php';" class="btn">
            Путешествие в RPG
        </button>
        <p>Уже есть аккаунт? <a href="login.php">Войдите здесь</a></p>
    </div>

    <footer>☽ &copy; 2025 RPG Adventure - Все права защищены</footer>

</body>
</html>


