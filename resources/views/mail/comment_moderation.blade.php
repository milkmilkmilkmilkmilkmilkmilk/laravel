@component('mail::message')
# Новый комментарий требует модерации

Добавлен комментарий с текстом:

@component('mail::panel')
{{ $comment->text }}
@endcomponent

Для статьи: {{ $article_title }}.  
Автор комментария: {{ $author }}.

@component('mail::button', ['url' => route('comments.moderation')])
Перейти к модерации
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
