document.addEventListener("DOMContentLoaded", () => {
    // Подсветка ячеек стата при наведении
    const statCells = document.querySelectorAll("#stats td");
    statCells.forEach(cell => {
        cell.addEventListener("mouseenter", () => {
            cell.style.color = "cyan";
            cell.style.fontSize = "18px";
        });
        cell.addEventListener("mouseleave", () => {
            cell.style.color = "white";
            cell.style.fontSize = "16px";
        });
    });

    // Подсветка ячеек навыков при наведении
    const skillsCells = document.querySelectorAll("#skills td");
    skillsCells.forEach(cell => {
        cell.addEventListener("mouseenter", () => {
            cell.style.color = "cyan";
            cell.style.fontSize = "18px";
        });
        cell.addEventListener("mouseleave", () => {
            cell.style.color = "white";
            cell.style.fontSize = "16px";
        });
    });

    // Эффект вспышки при клике на картинку
    const necromancerImg = document.getElementById("necromancer-img");
    necromancerImg.addEventListener("click", (event) => {
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
    function createLevelRows(data) {
        return data.map(item => {
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
    if (skillsData) {
        document.getElementById('skills').innerHTML = createLevelRows(skillsData);
    }

    // Заполнение таблицы талантов
    if (talentsData) {
        document.getElementById('talents').innerHTML = createLevelRows(talentsData);
    }
});
