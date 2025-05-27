@extends('layout')

@section('content')
    <h2 class="mb-4">Список заявлений (для администратора)</h2>
    <form method="GET" action="{{ route('admin.forms') }}" style="margin-bottom: 20px;">
        <label for="status">Фильтр по статусу:</label>
        <select name="status" onchange="this.form.submit()">
            <option value="">— Все —</option>
            <option value="Ожидает ответа" {{ request('status') === 'Ожидает ответа' ? 'selected' : '' }}>Ожидает ответа</option>
            <option value="Обработано" {{ request('status') === 'Обработано' ? 'selected' : '' }}>Обработано</option>
            <option value="Отклонено" {{ request('status') === 'Отклонено' ? 'selected' : '' }}>Отклонено</option>
        </select>
    </form>
    @foreach ($forms as $form)
        <div class="card mb-4 shadow-sm border">
            <div class="card-header bg-light">
                <h5 class="mb-0">Заявление №{{ $form->id }}</h5>
            </div>
            <div class="card-body">
                <h6 class="text-primary">1. Иностранный гражданин</h6>
                <table class="table table-sm">
                    <tr><th>ФИО (EN)</th><td>{{ $form->surname_en }} {{ $form->name_en }} {{ $form->patronymic_en }}</td></tr>
                    <tr><th>ФИО (RU)</th><td>{{ $form->surname_ru }} {{ $form->name_ru }} {{ $form->patronymic_ru }}</td></tr>
                    <tr><th>Гражданство</th><td>{{ $form->citizenship }}</td></tr>
                    <tr><th>Дата рождения</th><td>{{ $form->birth_date }}</td></tr>
                    <tr><th>Пол</th><td>{{ $form->gender }}</td></tr>
                    <tr><th>Место рождения</th><td>{{ $form->birth_place }}</td></tr>
                    <tr><th>Документ</th><td>{{ $form->doc_type }}, №{{ $form->doc_number }}, выдан {{ $form->doc_issued }}, действует до {{ $form->doc_expiry }}</td></tr>
                </table>

                <h6 class="text-primary mt-4">2. Место пребывания</h6>
                <p>
                    <strong>Регион:</strong> {{ $form->stay_region }},
                    <strong>Район:</strong> {{ $form->stay_district }},
                    <strong>Город:</strong> {{ $form->stay_city }}<br>
                    <strong>Адрес:</strong> ул. {{ $form->stay_street }}, д.{{ $form->stay_house }}
                    @if($form->stay_korpus) корп. {{ $form->stay_korpus }} @endif
                    @if($form->stay_stroenie) стр. {{ $form->stay_stroenie }} @endif
                    @if($form->stay_flat) кв. {{ $form->stay_flat }} @endif<br>
                    <strong>Период:</strong> с {{ $form->stay_from }} по {{ $form->stay_to }}<br>
                    <strong>Телефон:</strong> {{ $form->phone }}
                </p>

                <h6 class="text-primary mt-4">3. Миграционная карта</h6>
                <table class="table table-sm">
                    <tr><th>Серия</th><td>{{ $form->migration_card_series }}</td></tr>
                    <tr><th>Номер</th><td>{{ $form->migration_card_number }}</td></tr>
                    <tr><th>Удостоверяющий документ</th><td>{{ $form->migration_card_identity_doc }}</td></tr>
                    <tr><th>Цель визита</th><td>{{ $form->visit_purpose }}</td></tr>
                    <tr><th>Срок</th><td>с {{ $form->visit_from }} по {{ $form->visit_to }}</td></tr>
                </table>

                <h6 class="text-primary mt-4">4. Принимающая сторона</h6>
                <table class="table table-sm">
                    <tr><th>ФИО</th><td>{{ $form->host_surname }} {{ $form->host_name }} {{ $form->host_patronymic }}</td></tr>
                    <tr><th>Гражданство</th><td>{{ $form->host_citizenship }}</td></tr>
                    <tr><th>Дата рождения</th><td>{{ $form->host_birth_date }}</td></tr>
                    <tr><th>Пол</th><td>{{ $form->host_gender }}</td></tr>
                    <tr><th>Место рождения</th><td>{{ $form->host_birth_place }}</td></tr>
                    <tr><th>Паспорт</th><td>№{{ $form->host_doc_number }}, выдан {{ $form->host_doc_issued }}, действует до {{ $form->host_doc_expiry }}</td></tr>
                </table>

                <h6 class="text-primary mt-4">5. Адрес проживания принимающей стороны</h6>
                <p>
                    <strong>Регион:</strong> {{ $form->host_region }},
                    <strong>Город:</strong> {{ $form->host_city }}<br>
                    <strong>Адрес:</strong> ул. {{ $form->host_street }}, д.{{ $form->host_house }}
                    @if($form->host_korpus) корп. {{ $form->host_korpus }} @endif
                    @if($form->host_stroenie) стр. {{ $form->host_stroenie }} @endif
                    @if($form->host_flat) кв. {{ $form->host_flat }} @endif<br>
                    <strong>Телефон:</strong> {{ $form->host_phone }}
                </p>

                @php
                    $docs = $form->document_path ? json_decode($form->document_path, true) : [];
                @endphp
                @if (!empty($docs))
                    <h6 class="text-primary mt-4">Загруженные документы</h6>
                    <ul>
                        @foreach ($docs as $doc)
                            <li><a href="{{ $doc }}" target="_blank">📄 Открыть документ</a></li>
                        @endforeach
                    </ul>
                @endif

                <hr>

                <form method="POST" action="/admin/forms/{{ $form->id }}/upload" enctype="multipart/form-data" class="d-flex align-items-center gap-2 mt-2">
                    @csrf
                    <input type="file" name="admin_file" class="form-control" required>
                    <button type="submit" class="btn btn-primary">Отправить файл пользователю</button>
                </form>

                @if ($form->admin_file_path)
                    <p class="mt-2 mb-0">📎 Отправленный файл:
                        <a href="{{ Storage::disk('s3')->url($form->admin_file_path) }}" target="_blank">Скачать</a>
                    </p>
                @endif
                <form method="POST" action="/admin/forms/{{ $form->id }}/status" style="margin-top: 10px;">
                    @csrf
                    @method('PUT')
                    <label for="status">Статус:</label>
                    <select name="status" onchange="this.form.submit()">
                        <option value="Ожидает ответа" {{ $form->status === 'Ожидает ответа' ? 'selected' : '' }}>Ожидает ответа</option>
                        <option value="Обработано" {{ $form->status === 'Обработано' ? 'selected' : '' }}>Обработано</option>
                        <option value="Отклонено" {{ $form->status === 'Отклонено' ? 'selected' : '' }}>Отклонено</option>
                    </select>
                </form>
                <form method="POST" action="{{ route('admin.forms.destroy', $form->id) }}" onsubmit="return confirm('Удалить это заявление?');" style="margin-top: 10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection
