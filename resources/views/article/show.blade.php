@extends('layout')

@section('content')

@if(session()->has('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
@endif

<div class="card mb-4" style="width: 100%;">
    <div class="card-body">
        <h5 class="card-title text-center">{{ $article->title }}</h5>
        <h6 class="card-subtitle mb-2 text-body-secondary">{{ $article->date_public }}</h6>
        <p class="card-text">{{ $article->text }}</p>

        @can('create')
        <div class="btn-toolbar mt-3" role="toolbar">
            <a href="/article/{{ $article->id }}/edit" class="btn btn-primary me-3">Edit article</a>
            <form action="/article/{{ $article->id }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger me-3">Delete article</button>
            </form>
        </div>
        @endcan
    </div>
</div>

<h4>Comments</h4>

<ul class="list-group mb-4">
    @forelse ($comments as $comment)
        <li class="list-group-item">
            {{-- Текст комментария --}}
            <div id="comment-text-{{ $comment->id }}" class="mb-2">
                {{ $comment->text }}
            </div>

            {{-- Форма редактирования (по умолчанию скрыта) --}}
            <form id="edit-form-{{ $comment->id }}" 
                  action="{{ route('comments.update', $comment) }}" 
                  method="POST" 
                  class="d-none mb-2">
                @csrf
                @method('PATCH')
                <textarea name="text" class="form-control mb-2" rows="2">{{ $comment->text }}</textarea>
                <button type="submit" class="btn btn-sm btn-success me-2">Save</button>
                <button type="button" class="btn btn-sm btn-secondary" onclick="cancelEdit({{ $comment->id }})">Cancel</button>
            </form>

            {{-- Проверка прав доступа --}}
            @can('update', $comment)
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-warning me-2" onclick="showEditForm({{ $comment->id }})">
                    Edit
                </button>
            </div>
            @endcan

            @can('delete', $comment)
            <div class="d-flex align-items-center mt-2">
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
            @endcan
        </li>
    @empty
        <li class="list-group-item">No comments yet.</li>
    @endforelse
</ul>

<h5>Add a Comment</h5>
<form action="{{ route('comments.store') }}" method="POST">
    @csrf
    <input type="hidden" name="article_id" value="{{ $article->id }}">
    <div class="mb-3">
        <textarea name="text" class="form-control" placeholder="Write your comment..." rows="3">{{ old('text') }}</textarea>
        @error('text')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-success">Add Comment</button>
</form>

{{-- Скрипт для показа формы редактирования --}}
<script>
function showEditForm(id) {
    document.getElementById(`comment-text-${id}`).classList.add('d-none');
    document.getElementById(`edit-form-${id}`).classList.remove('d-none');
}

function cancelEdit(id) {
    document.getElementById(`comment-text-${id}`).classList.remove('d-none');
    document.getElementById(`edit-form-${id}`).classList.add('d-none');
}
</script>

@endsection
