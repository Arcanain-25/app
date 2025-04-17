<?php
session_start();

// Если сессия не установлена, перенаправляем на страницу входа
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Профиль RPG</title>
  <link rel="stylesheet" href="CSS/profile.css" />
  <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
</head>
<body>

  <!-- Видеофон -->
  <video autoplay muted loop id="bg-video">
    <source src="https://play.vsthemes.org/fhd/50/1050.webm" type="video/webm">
  </video>

  <!-- Основной контейнер -->
  <div class="container">
    <!-- Левый блок (Аватар) -->
    <div class="profile-left">
      <div class="profile-image">
        <div class="avatar-frame">
          <div class="avatar-glow"></div>
          <img src="https://zefirka.club/wallpapers/uploads/posts/2023-02/1677035558_zefirka-club-p-chernii-mag-art-4.jpg" alt="Аватар">
          <div class="flame-ring"></div>
          <div class="magic-runes">⭑⟁⭒𓂀✵☼✦𖤐</div>
        </div>
      </div>
      <h1>Привет, <?php echo $_SESSION['username']; ?>!</h1>
      
      <!-- Новая таблица с 5 кнопками -->
      <div class="button-table">
        <table id="button-table">
          <thead>
            <tr>
              <th>Действие</th>
              <th>Кнопка</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Профиль Некроманта</td>
              <td><a href="gardian.php" class="button-link"><button class="button">Перейти</button></a></td>
            </tr>
            <tr>
              <td>Профиль Воина</td>
              <td><a href="ASAD.php" class="button-link"><button class="button">Перейти</button></a></td>
            </tr>
            <tr>
              <td>Профиль Мага</td>
              <td><a href="" class="button-link"><button class="button">Перейти</button></a></td>
            </tr>
            <tr>
              <td>Профиль Целителя</td>
              <td><a href="Voin.php" class="button-link"><button class="button">Перейти</button></a></td>
            </tr>
            <tr>
              <td>История</td>
              <td><a href="hol.php" class="button-link"><button class="button">Перейти</button></a></td>
            </tr>
            <tr>
              <td>Регистрация</td>
              <td><a href="Register.php" class="button-link"><button class="button">Зарегистрироваться</button></a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Центральный блок (Статы и Инвентарь) -->
    <div class="profile-stats">
      <h2>Статы персонажа</h2>
      <table>
        <tr>
          <th>Характеристика</th>
          <th>Значение</th>
        </tr>
        <tr>
          <td>Уровень</td>
          <td>66</td>
        </tr>
        
        <!-- Сила -->
        <tr>
          <td>Сила</td>
          <td>
            <button onclick="changeStat('strength', -1)">−</button>
            <span id="strength">999</span>
            <button onclick="changeStat('strength', 1)">+</button>
          </td>
        </tr>

        <!-- Магия -->
        <tr>
          <td>Магия</td>
          <td>
            <button onclick="changeStat('magic', -1)">−</button>
            <span id="magic">666</span>
            <button onclick="changeStat('magic', 1)">+</button>
          </td>
        </tr>

        <!-- Выносливость -->
        <tr>
          <td>Выносливость</td>
          <td>
            <button onclick="changeStat('stamina', -1)">−</button>
            <span id="stamina">420</span>
            <button onclick="changeStat('stamina', 1)">+</button>
          </td>
        </tr>

        <!-- Удача -->
        <tr>
          <td>Удача</td>
          <td>
            <button onclick="changeStat('luck', -1)">−</button>
            <span id="luck">13</span>
            <button onclick="changeStat('luck', 1)">+</button>
          </td>
        </tr>

        <!-- Кнопка для генерации случайных статистик -->
        <tr>
          <td>Генерация статистики</td>
          <td>
            <button onclick="generateRandomStats()">Сгенерировать</button>
          </td>
        </tr>
      </table>

      <!-- Инвентарь -->
      <h3>Инвентарь</h3>
      <div class="inventory">
        <div class="sector">
          <h4>⚔️ Оружие</h4>
          <ul>
            <li>Клинок Бездны</li>
            <li>Посох Тьмы</li>
          </ul>
        </div>
        <div class="sector">
          <h4>🧪 Зелья</h4>
          <ul>
            <li>Зелье Ярости</li>
            <li>Зелье Тени</li>
          </ul>
        </div>
        <div class="sector">
          <h4>📜 Артефакты</h4>
          <ul>
            <li>Свиток Тьмы</li>
            <li>Маска Безликого</li>
          </ul>
        </div>
        <div class="sector">
          <h4>💎 Ресурсы</h4>
          <ul>
            <li>Небесные нити: 4000</li>
            <li>Золото: 250 500</li>
          </ul>
        </div>
        <!-- Случайный Лут -->
        <div class="sector">
          <h4>🎲 Случайный Лут</h4>
          <ul id="inventory"></ul>
          <button class="skull-button" onclick="generateInventory()">
            Сгенерировать Лут
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Сайдбар (Выход) -->
  <div class="sidebar">
    <a href="login.php" onclick="logout()">Выйти</a>
  </div>

  <script src="JS/profile.js" defer></script>
</body>

</html>

