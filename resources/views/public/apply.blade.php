@extends('layout')

@section('content')
    <h2>Форма на подготовку заявления для регистрации</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ url('/apply') }}" enctype="multipart/form-data">
        @csrf

        <h4>1. Иностранный гражданин</h4>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Фамилия (RU)</label>
                <input name="surname_ru" class="form-control" required>
                <div class="invalid-feedback">Введите только русские буквы</div>
            </div>
            <div class="col-md-6">
                <label>Фамилия (EN)</label>
                <input name="surname_en" class="form-control" required>
                <div class="invalid-feedback">Введите только английские буквы</div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Имя (RU)</label>
                <input name="name_ru" class="form-control" required>
                <div class="invalid-feedback">Введите только русские буквы</div>
            </div>
            <div class="col-md-6">
                <label>Имя (EN)</label>
                <input name="name_en" class="form-control" required>
                <div class="invalid-feedback">Введите только английские буквы</div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Отчество (при наличии) (RU)</label>
                <input name="patronymic_ru" class="form-control">
                <div class="invalid-feedback">Введите только русские буквы</div>
            </div>
            <div class="col-md-6">
                <label>Отчество (при наличии) (EN)</label>
                <input name="patronymic_en" class="form-control">
                <div class="invalid-feedback">Введите только английские буквы</div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Гражданство</label>
                <select name="citizenship" class="form-select" required>
                    <option value="Азербайджан">Армения</option>
                    <option value="Азербайджан">Азербайджан</option>
                    <option value="Азербайджан">Казахстан</option>
                    <option value="Узбекистан">Узбекистан</option>
                    <option value="Таджикистан">Таджикистан</option>
                    <option value="Кыргызстан">Кыргызстан</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Дата рождения</label>
                <input type="date" name="birth_date" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Пол</label>
                <select name="gender" class="form-select">
                    <option>мужской</option>
                    <option>женский</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Место рождения</label>
                <input name="birth_place" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Тип документа</label>
                <select name="doc_type" class="form-select">
                    <option>Заграничный паспорт</option>
                    <option>Внутренний-национальный</option>
                    <option>ID-карта</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Серия и №</label>
                <input name="doc_number" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Дата выдачи</label>
                <input type="date" name="doc_issued" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Действителен до</label>
                <input type="date" name="doc_expiry" class="form-control" required>
            </div>
        </div>

        <h4 class="mt-4">2. Место пребывания (регистрация)</h4>
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Область</label>
                <select name="stay_region" id="region" class="form-select" required>
                    <option value="">Выберите область</option>
                    <option value="Ханты-Мансийский автономный округ — Югра">Ханты-Мансийский автономный округ — Югра</option>
                    <option value="Москва">Московская</option>
                    <option value="Приморский край">Приморский край</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Район</label>
                <input name="stay_district" class="form-control" >
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Город</label>
                <select name="stay_city" id="city" class="form-select" required>
                    <option value="">Сначала выберите область</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Улица</label>
                <input name="stay_street" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Дом</label>
                <input name="stay_house" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Корпус</label>
                <input name="stay_korpus" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Строение</label>
                <input name="stay_stroenie" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Квартира</label>
                <input name="stay_flat" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Заявленный срок пребывания с</label>
                <input type="date" name="stay_from" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>До</label>
                <input type="date" name="stay_to" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Телефон</label>
                <input name="phone" id="phone" class="form-control" required maxlength="12">
                <div class="invalid-feedback">Введите только цифры</div>
            </div>
        </div>

        <h4>3. Миграционная карта</h4>
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Серия</label>
                <input name="migration_card_series" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>№</label>
                <input name="migration_card_number" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Документ, удостоверяющий личность</label>
                <input name="migration_card_identity_doc" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Цель визита</label>
                <select name="visit_purpose" class="form-select">
                    <option>Служебный</option>
                    <option>Туризм</option>
                    <option>Коммерческий</option>
                    <option>Учёба</option>
                    <option>Работа</option>
                    <option>Частный</option>
                    <option>Транзит</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Срок пребывания с</label>
                <input type="date" name="visit_from" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>До</label>
                <input type="date" name="visit_to" class="form-control" required>
            </div>
        </div>

        <h4>4. Принимающая сторона</h4>
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Фамилия</label>
                <input name="host_surname" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Имя</label>
                <input name="host_name" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Отчество</label>
                <input name="host_patronymic" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Гражданство</label>
                <input name="host_citizenship" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Дата рождения</label>
                <input type="date" name="host_birth_date" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Пол</label>
                <select name="host_gender" class="form-select">
                    <option>мужской</option>
                    <option>женский</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Место рождения</label>
                <input name="host_birth_place" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Документ, удостоверяющий личность: Серия и №</label>
                <input name="host_doc_number" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Дата выдачи</label>
                <input type="date" name="host_doc_issued" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Действителен до</label>
                <input type="date" name="host_doc_expiry" class="form-control" required>
            </div>
        </div>

        <h4 class="mt-4">5. Место проживания принимающей стороны</h4>
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Область</label>
                <select name="host_region" id="host_region" class="form-select" required>
                    <option value="">Выберите область</option>
                    <option value="Ханты-Мансийский автономный округ — Югра">Ханты-Мансийский автономный округ — Югра</option>
                    <option value="Москва">Московская</option>
                    <option value="Приморский край">Приморский край</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Район</label>
                <input name="host_district" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Город</label>
                <select name="host_city" id="host_city" class="form-select" required>
                    <option value="">Сначала выберите область</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Улица</label>
                <input name="host_street" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Дом</label>
                <input name="host_house" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Корпус</label>
                <input name="host_korpus" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Строение</label>
                <input name="host_stroenie" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Квартира</label>
                <input name="host_flat" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Телефон</label>
                <input name="host_phone" id="host_phone" class="form-control" required maxlength="12">
                <div class="invalid-feedback">Введите только цифры</div>
            </div>
        </div>
        <h4 class="mt-4">6. Загрузка документов</h4>

        <p class="mb-3">
            🔹 Пожалуйста, загрузите отсканированные или сфотографированные документы:
        </p>
        <ul>
            <li>страницу паспорта иностранного гражданина с фотографией (лицевая сторона);</li>
            <li>все страницы паспорта с отметками, штампами и печатями;</li>
            <li>миграционную карту;</li>
            <li>дактилоскопия пальцев (при наличии);</li>
            <li>свидетельство о рождении (при регистрации ребенка);</li>
            <li>страницу паспорта принимающей стороны с фотографией и штампом о регистрации;</li>
            <li>документ, подтверждающий право собственности на жильё (ЕГРН) или иной документ на дом.</li>
        </ul>
        <div class="mb-3">
            <label>Скан/фото документа (PDF, JPG, PNG)</label>
            <input type="file" name="document_files[]" class="form-control" accept=".pdf,.jpg,.jpeg,.png" multiple onchange="previewFiles(this)">
            <div id="preview-container" style="margin-top: 15px;"></div>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="agree" id="agreement" required>
            <label class="form-check-label" for="agreement">
                Я согласен(а) с <a href="#" data-bs-toggle="modal" data-bs-target="#agreementModal">условиями обработки персональных данных</a>.
            </label>
        </div>

        <!-- Модальное окно -->
        <div class="modal fade" id="agreementModal" tabindex="-1" aria-labelledby="agreementModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agreementModalLabel">Согласие на обработку персональных данных</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body" style="white-space: pre-line;">
                        В соответствии с Федеральным законом от 27.07.2006 № 152-ФЗ «О персональных данных» я, субъект персональных данных, выражаю своё согласие на обработку моих персональных данных, указанных мною в настоящей веб-форме.

                        Цели обработки персональных данных:
                        – оформление и подготовка заявлений для временной регистрации по месту пребывания;
                        – взаимодействие со мной по вопросам, связанным с оформлением миграционных документов;
                        – предоставление миграционных, юридических и сопутствующих услуг.

                        Обработка персональных данных включает в себя: сбор, систематизацию, накопление, хранение, уточнение (обновление, изменение), использование, передачу (в том числе поручение обработки третьим лицам при необходимости), обезличивание, блокирование, уничтожение персональных данных.

                        Согласие предоставляется на срок, необходимый для достижения вышеуказанных целей, и может быть отозвано мною в любой момент путём подачи письменного уведомления.

                        Я подтверждаю, что ознакомлен(а) с условиями обработки персональных данных, предоставленных в рамках использования данного веб-приложения, и даю своё осознанное согласие на их обработку.

                        Ознакомлен(а), согласен(а).
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Отправить заявку</button>
    </form>
    <script src="{{ asset('js/form.js') }}"></script>
@endsection



{{--@extends('layout')--}}

{{--@section('content')--}}
{{--    <h2>Подать заявку на подготовку заявления для регистрации</h2>--}}

{{--    @if(session('success'))--}}
{{--        <div class="alert alert-success">{{ session('success') }}</div>--}}
{{--    @endif--}}

{{--    <form method="POST" action="{{ url('/apply') }}">--}}
{{--        @csrf--}}

{{--        <h4>1. Иностранный гражданин</h4>--}}

{{--        <div class="mb-3"><label>Фамилия (EN)</label><input name="surname_en" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Фамилия (RU)</label><input name="surname_ru" class="form-control" required></div>--}}

{{--        <div class="mb-3"><label>Имя (EN)</label><input name="name_en" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Имя (RU)</label><input name="name_ru" class="form-control" required></div>--}}

{{--        <div class="mb-3"><label>Отчество (при их налиции) (EN)</label><input name="patronymic_en" class="form-control"></div>--}}
{{--        <div class="mb-3"><label>Отчество (при их налиции) (RU)</label><input name="patronymic_ru" class="form-control"></div>--}}

{{--        <div class="mb-3">--}}
{{--            <label>Гражданство</label>--}}
{{--            <select name="citizenship" class="form-select" required>--}}
{{--                <option value="Узбекистан">Узбекистан</option>--}}
{{--                <option value="Таджикистан">Таджикистан</option>--}}
{{--                <option value="Кыргызстан">Кыргызстан</option>--}}
{{--                <option value="Азербайджан">Азербайджан</option>--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <div class="mb-3"><label>Дата рождения</label><input type="date" name="birth_date" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Пол</label><select name="gender" class="form-select"><option>мужской</option><option>женский</option></select></div>--}}
{{--        <div class="mb-3"><label>Место рождения</label><input name="birth_place" class="form-control" required></div>--}}

{{--        <div class="mb-3"><label>Тип документа</label>--}}
{{--            <select name="doc_type" class="form-select">--}}
{{--                <option>айди</option>--}}
{{--                <option>загран</option>--}}
{{--                <option>внутренний-национальный</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        <div class="mb-3"><label>Серия и №</label><input name="doc_number" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Дата выдачи</label><input type="date" name="doc_issued" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Действителен до</label><input type="date" name="doc_expiry" class="form-control" required></div>--}}

{{--        <h4 class="mt-4">2. Место пребывания (регистрация)</h4>--}}
{{--        <div class="mb-3"><label>Область</label><input name="region" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Район</label><input name="district" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Город</label><input name="city" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Улица</label><input name="street" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Дом</label><input name="house" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Корпус</label><input name="korpus" class="form-control"></div>--}}
{{--        <div class="mb-3"><label>Строение</label><input name="stroenie" class="form-control"></div>--}}
{{--        <div class="mb-3"><label>Квартира</label><input name="flat" class="form-control"></div>--}}
{{--        <div class="mb-3"><label>Заявленный срок пребывания с</label><input type="date" name="doc_issued" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>До</label><input type="date" name="doc_expiry" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Телефон</label><input name="phone" class="form-control" required></div>--}}

{{--        <h4>3. Миграционная карта</h4>--}}
{{--        <div class="mb-3"><label>Серия</label><input name="doc_number" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>№</label><input name="doc_number" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Документ, удостверяющий личность</label><input name="doc_number" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Цель визита</label>--}}
{{--            <select name="gender" class="form-select">--}}
{{--                <option>Служебный</option>--}}
{{--                <option>Туризм</option>--}}
{{--                <option>Коммерческий</option>--}}
{{--                <option>Учёба</option>--}}
{{--                <option>Работа</option>--}}
{{--                <option>Частный</option>--}}
{{--                <option>Транзит</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        <div class="mb-3"><label>Срок пребывания с</label><input type="date" name="doc_issued" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>До</label><input type="date" name="doc_expiry" class="form-control" required></div>--}}

{{--        <h4>4. Принимающая сторона</h4>--}}

{{--        <div class="mb-3"><label>Фамилия</label><input name="surname_ru" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Имя</label><input name="name_ru" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Отчество (при их налиции)</label><input name="patronymic_ru" class="form-control"></div>--}}
{{--        <div class="mb-3"><label>Гражданство</label><input name="region" class="form-control"></div>--}}

{{--        <div class="mb-3"><label>Дата рождения</label><input type="date" name="birth_date" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Пол</label><select name="gender" class="form-select"><option>мужской</option><option>женский</option></select></div>--}}
{{--        <div class="mb-3"><label>Место рождения</label><input name="birth_place" class="form-control" required></div>--}}

{{--        <div class="mb-3"><label>Документ, удостверяющий личность (Серия и №)</label><input name="doc_number" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Дата выдачи</label><input type="date" name="doc_issued" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Действителен до</label><input type="date" name="doc_expiry" class="form-control" required></div>--}}

{{--        <h4 class="mt-4">5. Место проживания</h4>--}}
{{--        <div class="mb-3"><label>Область</label><input name="region" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Район</label><input name="district" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Город</label><input name="city" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Улица</label><input name="street" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Дом</label><input name="house" class="form-control" required></div>--}}
{{--        <div class="mb-3"><label>Корпус</label><input name="korpus" class="form-control"></div>--}}
{{--        <div class="mb-3"><label>Строение</label><input name="stroenie" class="form-control"></div>--}}
{{--        <div class="mb-3"><label>Квартира</label><input name="flat" class="form-control"></div>--}}
{{--        <div class="mb-3"><label>Телефон</label><input name="phone" class="form-control" required></div>--}}

{{--        <button type="submit" class="btn btn-success mt-3">Отправить заявку</button>--}}
{{--    </form>--}}
{{--@endsection--}}
