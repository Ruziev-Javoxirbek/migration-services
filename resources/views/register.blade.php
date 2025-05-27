@extends('layout')

@section('content')
    <h2 class="mb-4 text-center">Регистрация</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>❗ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/register" class="mx-auto" style="max-width: 500px;">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">ФИО</label>
            <input type="text" name="name" id="name"
                   class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email"
                   class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="tel" name="phone" id="phone"
                   class="form-control"
                   value="{{ old('phone') }}"
                   pattern="^\+7\d{10}$"
                   maxlength="12"
                   title="Введите номер в формате +7XXXXXXXXXX"
                   placeholder="+7XXXXXXXXXX"
                   required>
            <div class="form-text">Введите номер в формате <code>+7XXXXXXXXXX</code></div>
            <div class="invalid-feedback">Номер должен начинаться с +7 и содержать 11 цифр</div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" name="password" id="password"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-3">Зарегистрироваться</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const phoneInput = document.getElementById('phone');

            phoneInput.addEventListener('focus', function () {
                if (!this.value.startsWith('+7')) {
                    this.value = '+7';
                }
            });

            phoneInput.addEventListener('input', function () {
                let digits = this.value.replace(/\D/g, '');

                if (digits.startsWith('8')) {
                    digits = '7' + digits.slice(1);
                }

                digits = digits.slice(0, 11);
                this.value = '+' + digits;

                if (!/^\+7\d{10}$/.test(this.value)) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
        });
    </script>
@endsection
