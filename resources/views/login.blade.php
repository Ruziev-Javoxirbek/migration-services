{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>Вход в систему</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--@if (Auth::check())--}}
{{--    <h2>Добро пожаловать, {{ Auth::user()->name }}!</h2>--}}
{{--    <a href="{{ url('/logout') }}">Выйти</a>--}}
{{--@else--}}
{{--    <h2>Вход</h2>--}}
{{--    @if ($errors->any())--}}
{{--        <div style="color:red;">--}}
{{--            {{ $errors->first() }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <form method="POST" action="{{ url('/login') }}">--}}
{{--        @csrf--}}
{{--        <label>Email:</label><br>--}}
{{--        <input type="email" name="email" value="{{ old('email') }}" required><br><br>--}}

{{--        <label>Пароль:</label><br>--}}
{{--        <input type="password" name="password" required><br><br>--}}

{{--        <button type="submit">Войти</button>--}}
{{--    </form>--}}
{{--@endif--}}

{{--</body>--}}
{{--</html>--}}

@extends('layout')

@section('content')
    @if (Auth::check())
        <h2>Добро пожаловать, {{ Auth::user()->name }}!</h2>
        <a href="{{ url('/logout') }}">Выйти</a>
    @else
        <h2>Вход</h2>
        @if ($errors->any())
            <div style="color:red;">
                {{ $errors->first() }}
            </div>
        @endif
        <p>Нет аккаунта? <a href="/register">Зарегистрироваться</a></p>
        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required><br><br>

            <label>Пароль:</label><br>
            <input type="password" name="password" required><br><br>

            <button type="submit">Войти</button>
        </form>
    @endif
@endsection
