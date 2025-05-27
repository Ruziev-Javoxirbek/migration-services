<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@extends('layout')

@section('content')
    <h2>Добавить документ</h2>

    <form method="POST" action="{{ url('/document') }}">
        @csrf

        <label>Название:</label>
        <input type="text" name="original_name" class="form-control mb-2" required>

        <label>Путь к файлу:</label>
        <input type="text" name="file_path" class="form-control mb-2" required>

        <label>Тип документа:</label>
        <select name="type" class="form-select mb-2" required>
            <option style="display:none">Выберите тип</option>
            <option value="passport">Паспорт</option>
            <option value="diploma">Диплом</option>
            <option value="residence_permit">ВНЖ</option>
            <option value="custom">Другое</option>
        </select>

        <label>К заявке:</label>
        <select name="order_id" class="form-select mb-3" required>
            <option style="display:none">Выберите заявку</option>
            @foreach ($orders as $order)
                <option value="{{ $order->id }}">#{{ $order->id }} — {{ $order->type }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
</body>
</html>
