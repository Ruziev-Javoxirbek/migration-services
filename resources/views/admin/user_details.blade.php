@extends('layout')

@section('content')
    <h2 class="mb-4">Заявления и переводы: {{ $user->name }} ({{ $user->email }})</h2>

    <h4 class="mt-4">Заявления</h4>
    @forelse($forms as $form)
        <div class="card p-3 mb-3">
            <strong>Заявление #{{ $form->id }}</strong> от {{ $form->created_at->format('d.m.Y H:i') }}<br>
            Статус: <span class="badge bg-{{ $form->status === 'завершено' ? 'success' : ($form->status === 'в работе' ? 'warning' : 'secondary') }}">
                {{ ucfirst($form->status) }}
            </span>
        </div>
    @empty
        <div class="alert alert-info">Нет заявлений.</div>
    @endforelse

    <h4 class="mt-4">Заявки на перевод</h4>
    @forelse($translations as $request)
        <div class="card p-3 mb-3">
            <strong>Заявка #{{ $request->id }}</strong> от {{ $request->created_at->format('d.m.Y H:i') }}<br>
            Тип документа: {{ $request->document_type }}<br>
            Статус: <span class="badge bg-{{ $request->status === 'готов' ? 'success' : ($request->status === 'в процессе' ? 'warning' : 'secondary') }}">
                {{ ucfirst($request->status) }}
            </span>
        </div>
    @empty
        <div class="alert alert-info">Нет заявок на перевод.</div>
    @endforelse

    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-4">← Назад к списку пользователей</a>
@endsection
