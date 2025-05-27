@extends('layout')

@section('content')
    <h2>Список документов</h2>

    @foreach ($documents as $doc)
        <div class="border p-3 mb-3 rounded bg-light">
            📄 {{ $doc->original_name }} ({{ $doc->type }}) <br>
            <strong>Заявка:</strong> #{{ $doc->order->id }} ({{ $doc->order->type }}) <br>
            <strong>Пользователь:</strong> {{ $doc->order->user->name ?? 'Неизвестно' }} <br>
            <a href="{{ url('/documents/' . $doc->id) }}">Подробнее</a>
            <a href="{{ url('/document/edit/' . $doc->id) }}">✏️ Редактировать</a> |
            <a href="{{ url('/document/destroy/' . $doc->id) }}" onclick="return confirm('Удалить документ?')">🗑️ Удалить</a>
        </div>
    @endforeach
@endsection
