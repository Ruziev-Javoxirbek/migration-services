@extends('layout')

@section('content')
    <h2 class="mb-4">Пользователи</h2>
    @foreach ($users as $user)
        <div class="card mb-3 p-3">
            <a href="{{ route('admin.users.show', $user->id) }}"><strong>{{ $user->name }}</strong></a> ({{ $user->email }})<br>
            Телефон: {{ $user->phone }}<br>
            Статус: {{ $user->is_admin ? 'Админ' : 'Пользователь' }}
            @if (!$user->is_admin)
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="margin-top: 10px;" onsubmit="return confirm('Удалить пользователя?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Удалить</button>
                </form>
            @endif
        </div>
    @endforeach
@endsection
