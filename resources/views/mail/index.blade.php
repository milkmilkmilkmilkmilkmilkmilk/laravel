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
                <a href="/comments/accept/{{ $comment->id }}" class="btn btn-success">Принять</a>
                <a href="/comments/reject/{{ $comment->id }}" class="btn btn-danger">Отклонить</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $comments->links() }}

@endsection
