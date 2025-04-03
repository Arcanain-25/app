document.getElementById("register-form").addEventListener("submit", function(event) {
    event.preventDefault();  // Отменяем стандартную отправку формы

    // Получаем данные из формы
    let formData = new FormData(this);

    // Отправляем данные на сервер через fetch
    fetch("register.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())  // Преобразуем ответ сервера в JSON
    .then(data => {
        let messageElement = document.getElementById("register-message");

        // Проверяем, если регистрация успешна
        if (data.success) {
            messageElement.style.color = "green";  // Зелёный цвет для успеха
            messageElement.innerText = data.message;
            this.reset();  // Очищаем форму
        } else {
            messageElement.style.color = "red";  // Красный цвет для ошибки
            messageElement.innerText = data.message;
        }
    })
    .catch(error => {
        console.error("Ошибка:", error);
        document.getElementById("register-message").innerText = "Произошла ошибка. Попробуйте снова!";
    });
});
