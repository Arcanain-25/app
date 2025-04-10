// Пример динамического изменения данных
document.getElementById('username').textContent = 'Игрок_1'; // Меняйте это значение для различных пользователей

// Динамическое изменение статистики
document.getElementById('strength').textContent = 18;
document.getElementById('intelligence').textContent = 14;
document.getElementById('stamina').textContent = 20;
document.getElementById('luck').textContent = 12;

// Функция для выхода
function logout() {
    alert("Вы вышли из системы!");
    // Очистка данных сессии и переход на страницу входа
}

// Функция для генерации инвентаря
function generateInventory() {
    const items = [
        'Меч силы (Оружие)', 
        'Зелье лечения (Зелье)', 
        'Магический свиток (Магия)', 
        'Щит защиты (Оборудование)', 
        'Книга знаний (Книга)', 
        'Артефакт древней силы (Артефакт)', 
        'Сапоги скорости (Обувь)', 
        'Кристалл удачи (Артефакт)', 
        'Пояс из драконьей кожи (Оборудование)'
    ];

    // Очистка старого инвентаря
    const inventoryList = document.getElementById('inventory');
    inventoryList.innerHTML = '';

    // Генерация случайного количества предметов
    const randomItemCount = Math.floor(Math.random() * 5) + 3; // Генерируем от 3 до 7 предметов
    const selectedItems = [];

    // Случайный выбор предметов
    for (let i = 0; i < randomItemCount; i++) {
        const randomIndex = Math.floor(Math.random() * items.length);
        const selectedItem = items[randomIndex];
        if (!selectedItems.includes(selectedItem)) {
            selectedItems.push(selectedItem);
        }
    }

    // Добавляем выбранные предметы в инвентарь
    selectedItems.forEach(item => {
        const listItem = document.createElement('li');
        listItem.textContent = item;
        inventoryList.appendChild(listItem);
    });
}