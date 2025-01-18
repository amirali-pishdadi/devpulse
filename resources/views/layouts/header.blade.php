<header class="header">

    <div class="header-middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-5 col-lg-3 col-xl-3">
                    <div class="header-middle-logo">
                        <a class="navbar-brand" href="/">
                            <img src="/assets/img/logo/Untitled-1.png" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="d-none d-lg-block col-lg-6 col-xl-5">
                    <div class="header-middle-search">
                        <form action="/search" method="GET">
                            <div class="search-content">
                                <input type="text" name="search" class="form-control"
                                    placeholder="در اینجا جستجو کنید..." value="{{ request('search') }}">
                                <button type="submit" class="search-btn"><i class="far fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-7 col-lg-3 col-xl-4">
                    <div class="header-middle-right">
                        @if (Auth::check())
                            <ul class="header-middle-list">
                                <li><a href="/edit/user/{{ Auth::user()->username }}" class="list-item"><i
                                            class="far fa-user-circle"></i></a></li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-navigation">
        <nav class="navbar navbar-expand-lg">
            <div class="container position-relative">
                <a class="navbar-brand" href="/">
                    <img src="/assets/img/logo/Untitled-1.png" class="logo-scrolled" alt="logo">
                </a>
                <div class="category-all">
                    <button class="category-btn" type="button">
                        <i class="far fa-grid-2-plus"></i><span>همه دسته بندی ها</span>
                    </button>
                    <ul class="main-category hide-category">
                        @php
                            $categories = App\Models\Category::all();
                        @endphp
                        @foreach ($categories as $category)
                            <li>
                                <a href="/category/{{ $category->slug }}">

                                    <span>{{ $category->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="mobile-menu-right">
                    <div class="search-btn">
                        <button type="button" class="nav-right-link"><i class="far fa-search"></i></button>
                        <div class="mobile-search-form">
                            <form action="/search" method="GET">
                                <div class="search-content">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="در اینجا جستجو کنید..." value="{{ request('search') }}">
                                    <button type="submit" class="search-btn"><i class="far fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-mobile-icon"><i class="far fa-bars"></i></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link active" href="/">صفحه
                                اصلی</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/about-us">درباره ما</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="/articles">همه مقالات</a>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="/contact-us">تماس با ما</a>

                        </li>
                        @if (!Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="/login">ورود</a>

                            </li>
                        @endif
                    </ul>
                    @if (Auth::check() && Auth::user()->is_admin)
                        <div class="nav-right">
                            <div class="nav-right-btn">
                                <a href="/create-article" class="theme-btn">مقاله بنویسید</a>
                            </div>
                        </div>
                        <div class="nav-right">
                            <div class="nav-right-btn">
                                <a href="/admin" class="theme-btn">پنل مدیران</a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </nav>
    </div>
</header>
