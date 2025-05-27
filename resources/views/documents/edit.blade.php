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
<h2>Редактировать документ</h2>

<form method="POST" action="{{ url('/document/update/' . $document->id) }}">
    @csrf

    <label>Название:</label><br>
    <input type="text" name="original_name" value="{{ $document->original_name }}"><br><br>

    <label>Путь к файлу:</label><br>
    <input type="text" name="file_path" value="{{ $document->file_path }}"><br><br>

    <label>Тип документа:</label><br>
    <select name="type">
        <option style="display:none">Выберите тип</option>
        <option value="passport" {{ $document->type == 'passport' ? 'selected' : '' }}>Паспорт</option>
        <option value="diploma" {{ $document->type == 'diploma' ? 'selected' : '' }}>Диплом</option>
        <option value="residence_permit" {{ $document->type == 'residence_permit' ? 'selected' : '' }}>ВНЖ</option>
        <option value="custom" {{ $document->type == 'custom' ? 'selected' : '' }}>Другое</option>
    </select><br><br>

    <label>Заявка:</label><br>
    <select name="order_id">
        <option style="display:none">Выберите заявку</option>
        @foreach ($orders as $order)
            <option value="{{ $order->id }}" {{ $document->order_id == $order->id ? 'selected' : '' }}>
                #{{ $order->id }} — {{ $order->type }}
            </option>
        @endforeach
    </select><br><br>

    <button type="submit">Обновить</button>
</form>

</body>
</html>
