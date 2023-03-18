<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lara CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.tiny.cloud/1/jy2k175ddz1rp6uv967142cb1jq2gpc0u438c2vb0j5flls7/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('posts.index') }}">{{ __('frontend.project_title') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page"
                                href="{{ route('posts.index') }}">{{ __('frontend.home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('posts.index') }}">{{ __('frontend.posts') }}</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('frontend.change_language') }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown mx-1">
                                <li><a class="dropdown-item" href="#">{{ __('frontend.mm_unicode') }}</a></li>
                                <li><a class="dropdown-item" href="#">{{ __('frontend.mm_zawgyi') }}</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">{{ __('frontend.en') }}</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link btn btn-sm btn-warning" aria-current="page"
                                href="{{ route('clear-cache') }}">{{ __('frontend.clear_cache') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">{{ Auth::user()->name }}</a>
                        </li>

                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <a class="nav-link" aria-current="page" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">{{ __('frontend.logout') }}</a>
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
