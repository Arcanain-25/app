<?php
session_start();
$loggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPG Система Апокалипсиса</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>

    <video autoplay muted loop id="bg-video">
        <source src="https://www.desktophut.com/files/dsDxaWCcmLz8yYY_Space%20Portal%20Hd%20Live%20Wallpaper.mp4" type="video/mp4">
        Ваш браузер не поддерживает видео.
    </video>

    <div class="container">
        <h1>⚔ RPG Система Апокалипсиса ⚔</h1>
        <p>Древняя тьма пробудилась, а твоя судьба вписана в звезды.</p>
        
        <?php if ($loggedIn): ?>
            <p>Добро пожаловать, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!</p>
            <a href="logout.php" class="btn">🚪 Выйти</a>
        <?php else: ?>
            <a href="gardian.php" class="btn">🔱 Начать Путешествие</a>
        <?php endif; ?>
    </div>

    <button id="assistant-toggle">🤖</button>

    <div id="assistant-container">
        <div id="assistant-header">🧙‍♂️ Мистический Советник</div>
        <div id="assistant-messages">Привет, Искатель! Чем могу помочь?</div>
        <input type="text" id="assistant-input" placeholder="Спроси меня..." onkeypress="handleInput(event)">
    </div>

    <button id="voice-toggle">🎤</button>

    <div id="register-container">
        <h2>Регистрация</h2>
        <form id="register-form" action="register.php" method="POST">
            <input type="text" id="username" name="username" placeholder="Имя" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="tel" id="phone" name="phone" placeholder="Телефон (необязательно)">
            <input type="password" id="password" name="password" placeholder="Пароль" required>
            <button type="submit">Зарегистрироваться</button>
        </form>
        <p id="register-message"></p>
    </div>

    <footer>☽ &copy; 2025 RPG Apocalypse - Все права защищены</footer>
    <script src="JS/iiss.js"></script>

</body>
</html>


