@extends('layout')

@section('content')
    <div class="container mt-5" style="max-width: 500px;">
        @if (Auth::check())
            <div class="alert alert-success text-center">
                <h4>Добро пожаловать, {{ Auth::user()->name }}!</h4>
                <a href="{{ url('/logout') }}" class="btn btn-outline-danger mt-3">Выйти</a>
            </div>
        @else
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title mb-4 text-center">Вход</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="form-control" placeholder="Введите email">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" name="password" required class="form-control" placeholder="Введите пароль">
                        </div>

                        <button type="submit" class="btn btn-success w-100">Войти</button>
                    </form>

                    <p class="mt-3 text-center">
                        Нет аккаунта?
                        <a href="{{ url('/register') }}">Зарегистрироваться</a>
                    </p>
                </div>
            </div>
        @endif
    </div>
@endsection
