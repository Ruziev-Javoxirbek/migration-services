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
<h2>Документ: {{ $document->original_name }}</h2>

<p><strong>Тип:</strong> {{ $document->type }}</p>
<p><strong>Прикреплён к заявке:</strong> #{{ $document->order->id }} ({{ $document->order->type }})</p>
<p><strong>Пользователь:</strong> {{ $document->order->user->name ?? 'Неизвестно' }}</p>
@if ($document->translation)
    <h3>Перевод</h3>
    <p>Файл перевода: {{ $document->translation->translated_file_path }}</p>
    <p>Нотариально заверен: {{ $document->translation->notarized ? 'Да' : 'Нет' }}</p>
    <p>Доставка: {{ $document->translation->delivered ? 'Да' : 'Нет' }}</p>
    @if ($document->translation->delivered)
        <p>Адрес доставки: {{ $document->translation->delivery_address }}</p>
    @endif
@else
    <p>Перевод ещё не добавлен.</p>
@endif
</body>
</html>
