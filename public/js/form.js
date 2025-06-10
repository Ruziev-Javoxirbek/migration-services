document.addEventListener('DOMContentLoaded', () => {
    const validateField = (input, pattern, errorMessage) => {
        input.addEventListener('input', () => {
            if (!input.value.match(pattern) && input.value !== '') {
                input.classList.add('is-invalid');
                input.setCustomValidity(errorMessage);
            } else {
                input.classList.remove('is-invalid');
                input.setCustomValidity('');
            }
        });
    };

    // английские поля
    validateField(document.querySelector('[name="surname_en"]'), /^[A-Za-z\s]+$/, 'Введите только латинские буквы');
    validateField(document.querySelector('[name="name_en"]'), /^[A-Za-z\s]+$/, 'Введите только латинские буквы');
    validateField(document.querySelector('[name="patronymic_en"]'), /^[A-Za-z\s]*$/, 'Введите только латинские буквы');

    // русские поля
    validateField(document.querySelector('[name="surname_ru"]'), /^[А-Яа-яЁё\s]+$/, 'Введите только русские буквы');
    validateField(document.querySelector('[name="name_ru"]'), /^[А-Яа-яЁё\s]+$/, 'Введите только русские буквы');
    validateField(document.querySelector('[name="patronymic_ru"]'), /^[А-Яа-яЁё\s]*$/, 'Введите только русские буквы');
});

document.addEventListener('DOMContentLoaded', () => {
    function setupPhoneValidation(inputId) {
        const input = document.getElementById(inputId);

        input.addEventListener('focus', function () {
            if (this.value === '') {
                this.value = '+';
            }
        });

        input.addEventListener('input', function () {
            if (!this.value.startsWith('+')) {
                this.value = '+' + this.value.replace(/\D/g, '');
            }

            let digits = this.value.slice(1).replace(/\D/g, '').slice(0, 12);
            this.value = '+' + digits;

            if (digits.length < 10 || digits.length > 11) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    }

    setupPhoneValidation('phone');
    setupPhoneValidation('host_phone');
});

function previewFiles(input) {
    const previewContainer = document.getElementById('preview-container');
    previewContainer.innerHTML = '';

    const files = input.files;
    for (const file of files) {
        const reader = new FileReader();

        reader.onload = function(e) {
            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '200px';
                img.style.margin = '10px';
                img.style.cursor = 'pointer';
                img.onclick = () => openFullImage(e.target.result); // 🔍

                previewContainer.appendChild(img);
            } else {
                const p = document.createElement('p');
                p.textContent = `📄 ${file.name}`;
                previewContainer.appendChild(p);
            }
        };

        reader.readAsDataURL(file);
    }
}
document.addEventListener('DOMContentLoaded', () => {
    const onlyDigitsFields = ['host_house', 'host_flat', 'stay_house', 'stay_flat'];

    onlyDigitsFields.forEach(fieldName => {
        const input = document.getElementsByName(fieldName)[0];
        if (input) {
            input.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, ''); // удаляет все нецифры
            });
        }
    });
});

function openFullImage(src) {
    const fullImg = document.createElement('img');
    fullImg.src = src;
    fullImg.style.position = 'fixed';
    fullImg.style.top = '0';
    fullImg.style.left = '0';
    fullImg.style.width = '100vw';
    fullImg.style.height = '100vh';
    fullImg.style.objectFit = 'contain';
    fullImg.style.background = 'rgba(0,0,0,0.9)';
    fullImg.style.zIndex = '1000';
    fullImg.style.cursor = 'zoom-out';

    fullImg.onclick = () => document.body.removeChild(fullImg); // закрытие по клику
    document.body.appendChild(fullImg);
}

document.addEventListener('DOMContentLoaded', function () {
    const regionSelect = document.getElementById('region');
    const citySelect = document.getElementById('city');
    const hostRegion = document.getElementById('host_region');
    const hostCity = document.getElementById('host_city');

    const data = {
        "Ханты-Мансийский автономный округ — Югра": [
            "Ханты-Мансийск", "Сургут", "Нижневартовск", "Нефтеюганск", "Когалым",
            "Нягань", "Мегион", "Радужный", "Пыть-Ях", "Урай", "Лангепас",
            "Лянтор", "Югорск", "Советский", "Белоярский", "Покачи"
        ],
        "Москва": [
            "Москва"
        ],
        "Приморский край": [
            "Владивосток", "Находка", "Уссурийск", "Арсеньев", "Большой Камень", "Партизанск"
        ]
    };

    function updateCityOptions(regionSelect, citySelect) {
        const selectedRegion = regionSelect.value;
        citySelect.innerHTML = '<option value="">Выберите город</option>';

        if (data[selectedRegion]) {
            data[selectedRegion].forEach(function (city) {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
        }
    }

    if (regionSelect && citySelect) {
        regionSelect.addEventListener('change', function () {
            updateCityOptions(regionSelect, citySelect);
        });
    }

    if (hostRegion && hostCity) {
        hostRegion.addEventListener('change', function () {
            updateCityOptions(hostRegion, hostCity);
        });
    }
});
