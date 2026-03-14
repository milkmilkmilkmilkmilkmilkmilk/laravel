@extends('layout')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

<h2>Модерация комментариев</h2>

<table class="table">
    <thead>
        <tr>
            <th>Дата</th>
            <th>Автор</th>
            <th>Статья</th>
            <th>Текст</th>
            <th>Действия</th>
        </tr>
    </thead>

    <tbody>
    @foreach($comments as $comment)
        <tr>
            <td>{{ $comment->created_at }}</td>
            <td>{{ $comment->user->name }}</td>
            <td>
                <a href="/article/{{ $comment->article->id }}">
                    {{ $comment->article->title }}
                </a>
            </td>
            <td>{{ $comment->text }}</td>
            <td>
                <form action="{{ route('comments.accept', $comment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">Принять</button>
                </form>

                <form action="{{ route('comments.reject', $comment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Отклонить</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $comments->links() }}

@endsection
