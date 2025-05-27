@extends('layout')

@section('content')
    <h2>Заявки на перевод документов</h2>

    @foreach ($requests as $request)
        <div style="border:1px solid #ccc; padding: 15px; margin-bottom: 20px;">
            <h4>Заявка #{{ $request->id }} от {{ $request->user->name }}</h4>
            <p><strong>Тип документа:</strong> {{ $request->document_type }}</p>
            <p><strong>Способ получения:</strong> {{ $request->delivery_type }}</p>
            @if ($request->delivery_type === 'доставка')
                <p><strong>Адрес доставки:</strong> {{ $request->delivery_address }}</p>
            @endif

            <p><strong>Загруженные файлы:</strong></p>
            <ul>
                @foreach ($request->uploaded_files ?? [] as $file)
                    <li><a href="{{ $file }}" target="_blank">📎 Открыть файл</a></li>
                @endforeach
            </ul>

            {{-- Форма для загрузки переведённого файла --}}
            @if (!$request->translated_file_path)
                <form method="POST" action="/admin/translations/{{ $request->id }}/upload" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="translated_file" required>
                    <button type="submit">Загрузить перевод</button>
                </form>
            @else
                <p>📂 <strong>Переведённый файл:</strong>
                    <a href="{{ $request->translated_file_path }}" target="_blank">Скачать</a>
                </p>
            @endif

            {{-- Обновление статуса --}}
            <form method="POST" action="/admin/translations/{{ $request->id }}/status">
                @csrf
                <label>Статус:</label>
                <select name="status">
                    <option value="ожидает" @selected($request->status == 'ожидает')>Ожидает</option>
                    <option value="в процессе" @selected($request->status == 'в процессе')>В процессе</option>
                    <option value="готово" @selected($request->status == 'готово')>Готово</option>
                </select>
                <button type="submit">Обновить</button>
            </form>
        </div>
    @endforeach
@endsection
