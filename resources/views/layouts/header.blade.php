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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="/">🏛 Migration Service</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-3">
            <li class="nav-item"><a class="nav-link" href="/services">Наши услуги</a></li>
            <li class="nav-item"><a class="nav-link" href="/apply">Первичная регистрация</a></li>
            <li class="nav-item"><a class="nav-link" href="/translations/create">Перевод документов</a></li>
            @guest
                <li class="nav-item"><a class="nav-link" href="/register">Зарегистрироваться</a></li>
            @endguest
            @auth
                <li class="nav-item"><a class="nav-link" href="/profile">Профиль</a></li>
                @if (auth()->check() && auth()->user()->is_admin)
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.forms') }}">📄 Заявления</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.translations') }}">🌐 Переводы</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">👥 Пользователи</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="/dashboard">Мои заявления</a></li>
                @endif
                <li class="nav-item"><a class="nav-link" href="/logout">Выйти</a></li>
            @endauth
        </ul>
    </div>
</nav>
</body>
</html>
