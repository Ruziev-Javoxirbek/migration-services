@extends('layout')

@section('content')
    <h3>Подтверждение Email</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p>Для доступа к полному функционалу, подтвердите ваш email. Проверьте почту и перейдите по ссылке.</p>

    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button class="btn btn-primary">Отправить повторно</button>
    </form>
@endsection
