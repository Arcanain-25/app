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
        <a href="Register.php" class="btn">🔱 Начать Путешествие</a>
    <?php endif; ?>
</div>

    
    <div class="search-container">
   
        <input type="text" id="searchInput" placeholder="Введите имя игрока" onkeyup="searchPlayer()">
    </div>

    <div id="answerContainer">
    <table class="tooltip-table" id="searchResults">
        <!-- Тут будут строки tr с подсказками -->
    </table>
</div>


 <!-- Контейнер для уведомлений -->
 <div id="notification-container"></div>

  <!-- Кнопка вызова помощника -->
  <button id="assistant-toggle">🤖</button>

<!-- Окно помощника -->
<div id="assistant-container">
    <div id="assistant-header">🧙‍♂️ Мистический Советник</div>
    <div id="assistant-messages">Привет, Искатель! Чем могу помочь?</div>
    <input type="text" id="assistant-input" placeholder="Спроси меня..." onkeypress="handleInput(event)">
</div>

<button id="voice-toggle">🎤</button>

<!-- 💬 Чат -->
<div id="chat-box" style="width: 90%; max-width: 500px; margin: 50px auto; background: rgba(0,0,0,0.7); padding: 15px; border-radius: 10px; color: #fff;">
    <h3 style="text-align: center; color: #f39c12;">💬 Чат Гильдии</h3>
    <div id="messages" style="height: 200px; overflow-y: scroll; border: 1px solid #f39c12; padding: 10px; margin-bottom: 10px;"></div>
    <input type="text" id="chat-message" placeholder="Напиши сообщение..." style="width: 75%; padding: 8px;">
    <button onclick="sendMessage()" style="padding: 8px 15px; background: #f39c12; color: #fff; border: none; border-radius: 5px;">📨</button>
</div>


<h3>Владыка игры обновлеает мир!!!!!!!
    
</h3>

<div class="vote-container">
    <button class="vote-button" onclick="vote('up')">👍</button>
    <button class="vote-button" onclick="vote('down')">👎</button>
</div>

<div id="vote-count">Голосов: 0</div>




<footer>☽ &copy; 2025 RPG Apocalypse - Все права защищены</footer>



<!-- 🧠 AJAX скрипт -->
<script>
function sendMessage() {
    const msg = document.getElementById("chat-message").value;
    if (msg.trim() === "") return;

    fetch("chat_handler.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "message=" + encodeURIComponent(msg)
    }).then(() => {
        document.getElementById("chat-message").value = "";
        loadMessages();
    });
}

function loadMessages() {
    fetch("chat_fetch.php")
        .then(response => response.text())
        .then(data => {
            const msgBox = document.getElementById("messages");
            msgBox.innerHTML = data;
            msgBox.scrollTop = msgBox.scrollHeight;
        });
}

setInterval(loadMessages, 3000); // обновление каждые 3 секунды
window.onload = loadMessages;

function vote(type) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "vote.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                document.getElementById('vote-count').innerText = "Голосов: " + response.vote_count;
            } else {
                alert(response.message);
            }
        }
    };

    xhr.send("vote_type=" + type);
}
// Функция для получения случайного уведомления
function getNotification() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "random_notification.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const notification = xhr.responseText;
            showNotification(notification); // Показываем уведомление
        }
    };
    xhr.send();
}

// Функция для получения случайного уведомления
function getNotification() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "random_notification.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const notification = xhr.responseText;
            showNotification(notification); // Показываем уведомление
        }
    };
    xhr.send();
}

// Функция для отображения уведомления на странице
function showNotification(message) {
    const notificationContainer = document.getElementById('notification-container');
    const newNotification = document.createElement('div');
    newNotification.classList.add('notification');
    newNotification.textContent = message;

    // Добавляем новое уведомление в контейнер
    notificationContainer.appendChild(newNotification);

    // Убираем уведомление через 5 секунд
    setTimeout(() => {
        newNotification.remove();
    }, 5000);  // Уведомление исчезает через 5 секунд
}

// Вызываем функцию для случайных уведомлений каждую минуту
setInterval(getNotification, 40000); // Каждые 60 секунд


function searchPlayer() {
            const username = document.getElementById('searchInput').value.trim();
            if (username.length === 0) {
                document.getElementById('searchResults').innerHTML = ''; // Очистить результаты, если поле пустое
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open("GET", "searchPlayer.php?username=" + encodeURIComponent(username), true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('searchResults').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }


       


</script>


</body>
<script src="JS/iiss.js" defer ></script>

</html>
