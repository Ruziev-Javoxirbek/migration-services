@extends('layout')

@section('content')
    <div class="container">
        <h2 class="mb-4">Запрос на перевод документа</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>❗ {{ $error }}</li>@endforeach</ul>
            </div>
        @endif
        <form method="POST" action="/translations" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Тип документа:</label>
                <select name="document_type" class="form-select" required>
                    <option value="">-- выберите --</option>
                    <option value="паспорт">Паспорт</option>
                    <option value="метрика">Свидетельство о рождении</option>
                    <option value="диплом">Диплом</option>
                    <option value="другое">Другое</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Способ получения перевода:</label>
                <select name="delivery_type" class="form-select" required>
                    <option value="самовывоз">Самовывоз</option>
                    <option value="доставка">Доставка курьером</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Адрес доставки (если выбрана доставка):</label>
                <input type="text" name="delivery_address" class="form-control" placeholder="Город, улица, дом..." value="{{ old('delivery_address') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Загрузите скан/фото документа:</label>
                <input type="file" name="files[]" multiple class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
@endsection
