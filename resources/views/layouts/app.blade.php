<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', $article->title ?? '') - {{ env('APP_NAME', 'wiki.php') }}</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css')}}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/prism.css')}}" type="text/css">
    </head>
    <body class="line-numbers bg-white">
        <nav class="navbar navbar-dark bg-dark navbar-expand-md mb-2">
            <a class="navbar-brand" href="{{ route('home') }}">{{ env('APP_NAME', 'Wiki.php') }}</a>

            <!-- search -->
            <form class="form-inline my-2 my-lg-0" action="{{ route('articles.search') }}" method="get">
              <input name="keyword" class="form-control mr-sm-2" type="search" value="{{ $keyword ?? '' }}" placeholder="Search articles" aria-label="Search articles">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Authentication Links -->
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @can('auth', Auth::user())
                                <a class="dropdown-item" href="{{ route('user.auth') }}">Authorization</a>
                                <div class="dropdown-divider"></div>
                                @endcan

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>

            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </body>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('javascript')
</html>
