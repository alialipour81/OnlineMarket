<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <script src="//cdn.ckeditor.com/4.19.1/full/ckeditor.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('link_css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-10">
                      @yield('content')
                  </div>
                  <div class="col-md-2 text-center">
                      <ul class="list-group">
                          <li class="list-group-item">
                              <a href="{{ route('categories.index') }}" class="text-decoration-none">دسته بندی ها</a>
                          </li>
                          <li class="list-group-item">
                              <a href="{{ route('tags.index') }}" class="text-decoration-none">  برچسپ ها</a>
                          </li>
                          <li class="list-group-item">
                              <a href="{{ route('posters.index') }}" class="text-decoration-none">  پوستر ها</a>
                          </li>
                          <li class="list-group-item">
                              <a href="{{ route('sliders.index') }}" class="text-decoration-none">  اسلایدر ها</a>
                          </li>
                          <li class="list-group-item">
                              <a href="{{ route('brands.index') }}" class="text-decoration-none">  برند ها</a>
                          </li>
                          <li class="list-group-item">
                              <a href="{{ route('products.index') }}" class="text-decoration-none">   محصولات</a>
                          </li>
                          <li class="list-group-item">
                              <a href="{{ route('comments.index') }}" class="text-decoration-none">   نظرات</a>
                          </li>
                          <li class="list-group-item">
                              <a href="{{ route('amazings.index') }}" class="text-decoration-none">   شگفت انگیزها</a>
                          </li>
                          <li class="list-group-item">
                              <a href="{{ route('offers.index') }}" class="text-decoration-none">    پیشنهادات لحظه ای</a>
                          </li>
                          <li class="list-group-item">
                              <a href="{{ route('users-markets.index') }}" class="text-decoration-none">    فروشگاه ها  </a>
                          </li>
                          <li class="list-group-item">
                              <a href="{{ route('users.index') }}" class="text-decoration-none">    کاربران   </a>
                          </li>
                          <li class="list-group-item">
                              <a href="{{ route('favourites.index') }}" class="text-decoration-none">    علاقه مندی ها   </a>
                          </li>
                          <li class="list-group-item">
                              <a href="{{ route('discounts.index') }}" class="text-decoration-none">   تخفیف ها   </a>
                          </li>
                          <li class="list-group-item">
                              <a href="{{ route('orders.index') }}" class="text-decoration-none">   سفارش ها    </a>
                          </li>
                          <li class="list-group-item">
                              <a href="{{ route('emails.index') }}" class="text-decoration-none">     ایمیل    </a>
                          </li>

                      </ul>
                  </div>
              </div>
          </div>
        </main>
    </div>
</body>
</html>
