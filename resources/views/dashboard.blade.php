@extends('layout')

@section('content')
    <h3 class="mb-4">Мои заявления</h3>
    @if (auth()->user() && !auth()->user()->is_admin && !auth()->user()->email_verified_at)
        <div class="alert alert-warning">
            📩 Ваш email не подтверждён.
            <br>
            <a href="{{ route('verification.notice') }}">Нажмите здесь, чтобы повторно отправить письмо</a>
        </div>
    @endif

    @forelse ($forms as $form)
        {{-- Весь блок формы (как у тебя) --}}
        <div class="card mb-4 shadow-sm border">
            {{-- ... --}}
        </div>
    @empty
        <div class="alert alert-info">Вы ещё не отправляли заявлений.</div>
    @endforelse

    <hr class="my-5">

    <h3 class="mb-4">Мои переводы</h3>
    @forelse ($translations as $request)
        <div class="card mb-4 shadow-sm border">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <span>Заявка на перевод №{{ $request->id }}</span>
                <span class="text-muted small">{{ $request->created_at->format('d.m.Y H:i') }}</span>
            </div>
            <div class="card-body">
                <p><strong>Тип документа:</strong> {{ $request->document_type }}</p>
                <p><strong>Способ получения:</strong> {{ $request->delivery_type }}</p>
                @if ($request->delivery_type === 'доставка')
                    <p><strong>Адрес доставки:</strong> {{ $request->delivery_address }}</p>
                @endif

                <p><strong>Загруженные файлы:</strong></p>
                <ul>
                    @foreach ($request->uploaded_files as $file)
                        <li><a href="{{ $file }}" target="_blank">📎 Открыть</a></li>
                    @endforeach
                </ul>

                @if ($request->translated_file_path)
                    <p><strong>📂 Переведённый файл:</strong>
                        <a href="{{ $request->translated_file_path }}" target="_blank">Скачать перевод</a>
                    </p>
                @else
                    <p class="text-muted">Перевод пока не готов.</p>
                @endif

                <p><strong>Статус:</strong>
                    <span class="badge bg-{{ $request->status === 'готов' ? 'success' : ($request->status === 'в процессе' ? 'warning' : 'secondary') }}">
                        {{ ucfirst($request->status) }}
                    </span>
                </p>
            </div>
        </div>
    @empty
        <div class="alert alert-info">У вас пока нет заявок на перевод документов.</div>
    @endforelse
@endsection
