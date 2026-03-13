@extends('layout') 
@section('content')

<div class="article-list">
  @foreach($articles as $article)
    <article class="article-card card mb-4 border-0 shadow-sm">
      <div class="row g-0">
        <div class="col-md-8">
          <div class="card-body d-flex flex-column h-100">
            <div class="article-meta mb-2">
              <span class="article-date">
                {{ $article->date }}
              </span>
            </div>

            <h2 class="article-title h5 mb-2">
              {{ $article->name }}
            </h2>

            <p class="article-short text-muted mb-2">
              {{ $article->shortDesc }}
            </p>

            <p class="article-desc mb-0">
              {{ $article->desc }}
            </p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="article-image-wrapper h-100 d-flex align-items-center justify-content-center p-2 p-md-3">
            <a href="/full_image/{{ $article->full_image }}" class="article-image-link">
              <img
                src="{{ URL::asset($article->preview_image) }}"
                alt="{{ $article->name }}"
                class="img-fluid rounded article-image"
              >
            </a>
          </div>
        </div>
      </div>
    </article>
  @endforeach
</div>

@endsection
