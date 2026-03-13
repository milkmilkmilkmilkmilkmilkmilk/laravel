{{-- resources/views/mail/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Модерация комментариев</h1>

    @if(session('message'))
        <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    @if($comments->count() > 0)
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 p-2">ID</th>
                    <th class="border border-gray-300 p-2">Комментарий</th>
                    <th class="border border-gray-300 p-2">Пользователь</th>
                    <th class="border border-gray-300 p-2">Статья</th>
                    <th class="border border-gray-300 p-2">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td class="border border-gray-300 p-2">{{ $comment->id }}</td>
                        <td class="border border-gray-300 p-2">{{ $comment->text }}</td>
                        <td class="border border-gray-300 p-2">{{ $comment->user->name ?? 'Гость' }}</td>
                        <td class="border border-gray-300 p-2">{{ $comment->article->title ?? 'Нет статьи' }}</td>
                        <td class="border border-gray-300 p-2 flex gap-2">
                            {{-- Форма для одобрения (PATCH) --}}
                            <form action="{{ route('comments.accept', $comment->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                    Одобрить
                                </button>
                            </form>

                            {{-- Форма для отклонения (DELETE) --}}
                            <form action="{{ route('comments.reject', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Отклонить
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Пагинация --}}
        <div class="mt-4">
            {{ $comments->links() }}
        </div>
    @else
        <p>Нет комментариев на модерацию.</p>
    @endif
</div>
@endsection
