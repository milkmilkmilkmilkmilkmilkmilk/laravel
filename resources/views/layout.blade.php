<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Vite CSS + JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Navbar</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" href="/article">Article</a>
                    </li>

                    @can('create')
                        <li class="nav-item">
                            <a class="nav-link active" href="/article/create">Create Article</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('comments.moderation') }}">
                                Comment moderation
                            </a>
                        </li>
                    @endcan

                    <li class="nav-item">
                        <a class="nav-link active" href="/about">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="/contact">Contacts</a>
                    </li>
                </ul>

                <div class="d-flex">
                    @guest
                        <a href="/auth/signin" class="btn btn-outline-success me-2">Sign In</a>
                        <a href="/auth/login" class="btn btn-outline-success">Sign Out</a>
                    @endguest

                    @auth
                        <a href="/auth/logout" class="btn btn-outline-success">Exit</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>

<main>
    <div class="container mt-5">

        <!-- Vue mount -->
        <div id="app">

        </div>

        @yield('content')

    </div>
</main>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
    