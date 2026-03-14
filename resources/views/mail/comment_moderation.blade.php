@extends('layouts.app') {{-- если используете основной лейаут --}}

@section('content')
    <h1>Модерация комментариев</h1>

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @forelse($comments as $comment)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $comment->author }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $comment->created_at->format('d.m.Y H:i') }}</h6>
                <p class="card-text">{{ $comment->text }}</p>

                {{-- Форма принятия --}}
                <form action="{{ route('comments.accept', $comment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success btn-sm">Принять</button>
                </form>

                {{-- Форма отклонения --}}
                <form action="{{ route('comments.reject', $comment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Отклонить</button>
                </form>
            </div>
        </div>
    @empty
        <p>Нет комментариев, ожидающих модерации.</p>
    @endforelse
@endsection