document.addEventListener("DOMContentLoaded", function () {
    // Эффект вспышки при клике на картинку
    const warriorImg = document.getElementById("warrior-img");
    warriorImg.addEventListener("click", (event) => {
        const flash = document.createElement("div");
        flash.classList.add("flash-effect");
        flash.style.left = `${event.pageX - 75}px`;
        flash.style.top = `${event.pageY - 75}px`;
        document.body.appendChild(flash);

        setTimeout(() => flash.remove(), 1000);  // Удаляем вспышку через 1 секунду
    });

    // Анимация появления элементов при прокрутке
    const revealElements = document.querySelectorAll(".reveal");
    const checkVisibility = () => {
        revealElements.forEach(el => {
            if (el.getBoundingClientRect().top <= window.innerHeight) {
                el.classList.add("visible");
            }
        });
    };
    window.addEventListener("scroll", checkVisibility);
    checkVisibility(); // Запуск проверки сразу при загрузке

    // Магический эффект для заголовков h1 и h2
    const title = document.querySelector("h1");
    const subHeaders = document.querySelectorAll("h2");

    // Эффект свечения для h1
    title.addEventListener("mouseenter", () => {
        title.style.textShadow = "0 0 15px #FF9800, 0 0 30px #FF9800";
    });
    title.addEventListener("mouseleave", () => {
        title.style.textShadow = "none";
    });

    // Эффект свечения для h2
    subHeaders.forEach(header => {
        header.addEventListener("mouseenter", () => {
            header.style.textShadow = "0 0 15px #FF9800, 0 0 30px #FF9800";
        });
        header.addEventListener("mouseleave", () => {
            header.style.textShadow = "none";
        });
    });

    // Функция для показа подсказки при наведении
    const tooltips = document.querySelectorAll(".tooltip");
    tooltips.forEach(tooltip => {
        tooltip.addEventListener("mouseenter", () => {
            const tooltipText = tooltip.querySelector(".tooltiptext");
            tooltipText.style.visibility = 'visible';
            tooltipText.style.opacity = '1';
        });
        tooltip.addEventListener("mouseleave", () => {
            const tooltipText = tooltip.querySelector(".tooltiptext");
            tooltipText.style.visibility = 'hidden';
            tooltipText.style.opacity = '0';
        });
    });

    // Функция для создания строк с уровнями и подсказками
    function createLevelRows(data3) {
        return data3.map(item => {
            return `
                <tr class="tooltip">
                    <td><b>${item.name}</b></td>
                    <td>
                        <span class="tooltiptext">
                            <b>${item.description}</b>
                            <br><br>
                            ${item.levels.map(level => {
                                return `<b>Уровень ${level.level}:</b> ${level.description}<br>`;
                            }).join('')}
                        </span>
                        ${item.description}
                    </td>
                </tr>
            `;
        }).join('');
    }

    // Заполнение таблицы навыков
    if (skillsData3) {
        document.getElementById('skills').innerHTML = createLevelRows(skillsData3);
    }

    // Заполнение таблицы талантов
    if (talentsData3) {
        document.getElementById('talents').innerHTML = createLevelRows(talentsData3);
    }

    // Обработчик для ссылок
    const links = document.querySelectorAll("a"); // Все ссылки
    const loadingScreen = document.getElementById("loading-screen");

    links.forEach(link => {
        link.addEventListener("click", function (event) {
            if (this.target === "_blank" || this.href.startsWith("mailto:") || this.href.startsWith("#")) {
                return; // Игнорируем внешние ссылки и якоря
            }
            event.preventDefault(); // Остановить мгновенный переход

            loadingScreen.classList.add("active"); // Показать экран загрузки

            setTimeout(() => {
                window.location.href = this.href; // Переход на новую страницу
            }, 1500); // Время ожидания перед переходом (1.5 секунды)
        });
    });
});
