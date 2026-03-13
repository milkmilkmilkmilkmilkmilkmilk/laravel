@component('mail::message')
# Новый комментарий

Добавлен комментарий:

@component('mail::panel')
{{ $comment->text }}
@endcomponent

Для статьи: {{ $article_title }}.  
Автор комментария: {{ $author }}.

Спасибо,<br>
{{ config('app.name') }}
@endcomponent

