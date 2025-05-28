@extends('layout')

@section('content')
    <h3 class="mb-4">Мои заявления</h3>

    @if (auth()->user() && !auth()->user()->is_admin && !auth()->user()->email_verified_at)
        <div class="alert alert-warning">
            📩 Ваш email не подтверждён.
            <br>
            <a href="{{ route('verification.notice') }}">Нажмите здесь, чтобы повторно отправить письмо</a>
        </div>
    @endif

    @forelse ($forms as $form)
        <div class="card mb-4 shadow-sm border">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <span>Заявление №{{ $form->id }}</span>
                <span class="text-muted small">{{ $form->created_at->format('d.m.Y H:i') }}</span>
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
                    <tr><th>Документ</th><td>{{ $form->doc_type }}, №{{ $form->doc_number }} — {{ $form->doc_issued }} по {{ $form->doc_expiry }}</td></tr>
                </table>

                <h6 class="text-primary mt-4">2. Место пребывания</h6>
                <p>
                    <strong>Адрес:</strong> {{ $form->stay_region }}, {{ $form->stay_district }}, {{ $form->stay_city }},
                    ул. {{ $form->stay_street }}, д.{{ $form->stay_house }}
                    @if($form->stay_korpus) корп. {{ $form->stay_korpus }} @endif
                    @if($form->stay_stroenie) стр. {{ $form->stay_stroenie }} @endif
                    @if($form->stay_flat) кв. {{ $form->stay_flat }} @endif
                    <br><strong>Период:</strong> {{ $form->stay_from }} — {{ $form->stay_to }}
                    <br><strong>Телефон:</strong> {{ $form->phone }}
                </p>

                <h6 class="text-primary mt-4">3. Миграционная карта</h6>
                <table class="table table-sm">
                    <tr><th>Серия / Номер</th><td>{{ $form->migration_card_series }} / {{ $form->migration_card_number }}</td></tr>
                    <tr><th>Документ</th><td>{{ $form->migration_card_identity_doc }}</td></tr>
                    <tr><th>Цель визита</th><td>{{ $form->visit_purpose }}</td></tr>
                    <tr><th>Срок</th><td>{{ $form->visit_from }} — {{ $form->visit_to }}</td></tr>
                </table>

                <h6 class="text-primary mt-4">4. Принимающая сторона</h6>
                <p>
                    <strong>ФИО:</strong> {{ $form->host_surname }} {{ $form->host_name }} {{ $form->host_patronymic }}<br>
                    <strong>Гражданство:</strong> {{ $form->host_citizenship }},
                    <strong>Дата рождения:</strong> {{ $form->host_birth_date }},
                    <strong>Пол:</strong> {{ $form->host_gender }}<br>
                    <strong>Место рождения:</strong> {{ $form->host_birth_place }}<br>
                    <strong>Паспорт:</strong> №{{ $form->host_doc_number }} — {{ $form->host_doc_issued }} по {{ $form->host_doc_expiry }}
                </p>

                <h6 class="text-primary mt-4">5. Адрес проживания принимающей стороны</h6>
                <p>
                    {{ $form->host_region }}, {{ $form->host_district }}, {{ $form->host_city }}, ул. {{ $form->host_street }}, д.{{ $form->host_house }}
                    @if($form->host_korpus) корп. {{ $form->host_korpus }} @endif
                    @if($form->host_stroenie) стр. {{ $form->host_stroenie }} @endif
                    @if($form->host_flat) кв. {{ $form->host_flat }} @endif
                    <br><strong>Телефон:</strong> {{ $form->host_phone }}
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

                @if ($form->admin_file_path)
                    <p><strong>Ответ от администратора:</strong>
                        <a href="{{ $form->admin_file_path }}" target="_blank">Скачать файл</a>
                    </p>
                @endif

                <p><strong>Статус:</strong>
                    <span class="badge bg-{{ $form->status === 'завершено' ? 'success' : ($form->status === 'в работе' ? 'warning' : 'secondary') }}">
                        {{ ucfirst($form->status) }}
                    </span>
                </p>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Вы ещё не отправляли заявлений.</div>
    @endforelse

    <hr class="my-5">

    <h3 class="mb-4">Мои переводы</h3>
    @forelse ($translations as $request)
        <div class="card mb-4 shadow-sm border">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <span>Заявка на перевод №{{ $request->id }}</span>
                <span class="text-muted small">{{ $request->created_at->format('d.m.Y H:i') }}</span>
            </div>
            <div class="card-body">
                <p><strong>Тип документа:</strong> {{ $request->document_type }}</p>
                <p><strong>Способ получения:</strong> {{ $request->delivery_type }}</p>
                @if ($request->delivery_type === 'доставка')
                    <p><strong>Адрес доставки:</strong> {{ $request->delivery_address }}</p>
                @endif

                <p><strong>Загруженные файлы:</strong></p>
                <ul>
                    @foreach ($request->uploaded_files as $file)
                        <li><a href="{{ $file }}" target="_blank">📎 Открыть</a></li>
                    @endforeach
                </ul>

                @if ($request->translated_file_path)
                    <p><strong>📂 Переведённый файл:</strong>
                        <a href="{{ $request->translated_file_path }}" target="_blank">Скачать перевод</a>
                    </p>
                @else
                    <p class="text-muted">Перевод пока не готов.</p>
                @endif

                <p><strong>Статус:</strong>
                    <span class="badge bg-{{ $request->status === 'готов' ? 'success' : ($request->status === 'в процессе' ? 'warning' : 'secondary') }}">
                        {{ ucfirst($request->status) }}
                    </span>
                </p>
            </div>
        </div>
    @empty
        <div class="alert alert-info">У вас пока нет заявок на перевод документов.</div>
    @endforelse
@endsection
