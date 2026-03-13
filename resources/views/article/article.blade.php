@extends('layout')
@section('content')

@if(session()->has('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
</div>
@endif

<table class="table">
  <thead>
    <tr>
      <th scope="col">Date public</th>
      <th scope="col">Title</th>
      <th scope="col">Text</th>
      <th scope="col">Author</th>
    </tr>
  </thead>
  <tbody>
    @foreach($articles as $article)
    <tr>
      <th scope="row">{{ $article->date_public }}</th>
      <td><a href="/article/{{ $article->id }}">{{ $article->title }}</a></td>
      <td>{{ $article->text }}</td>
      <td>{{ $article->user?->name ?? 'Без автора' }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

<!-- Пагинация -->
<div class="d-flex justify-content-center mt-3">
    {{ $articles->links() }}
</div>
@endsection
