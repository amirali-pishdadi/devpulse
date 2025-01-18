@extends('layouts.layout')

@section('title')
    وبلاگ
@endsection

@section('content')
    <main class="main">

        <div class="site-breadcrumb">
            {{-- <div class="site-breadcrumb-bg" style="background: url(assets/img/breadcrumb/01.jpg)"></div> --}}

            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">شبکه وبلاگ</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="/"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li class="active">شبکه وبلاگ</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="blog-area py-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">وبلاگ ما</span>
                            <h2 class="site-title">آخرین اخبار و <span>وبلاگ</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($articles as $article)
                        <x-blog-card :article="$article" />
                    @endforeach
                </div>

                {{ $articles->links('pagination.custom') }}
            </div>
        </div>


        {{-- <div class="newsletter-area pt-60 pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="newsletter-content">
                            <h3>دریافت کوپن تخفیف <span>20%</span></h3>
                            <p>با مشترک شدن در خبرنامه ما</p>
                            <div class="subscribe-form">
                                <form action="#">
                                    <input type="email" class="form-control" placeholder="آدرس ایمیل معتبر شما">
                                    <button class="theme-btn" type="submit">
                                        اشتراک <i class="far fa-paper-plane"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="newsletter-img-1">
                <img src="assets/img/newsletter/01.png" alt>
            </div>
            <div class="newsletter-img-2">
                <img src="assets/img/newsletter/02.png" alt>
            </div>
        </div> --}}

    </main>
@endsection
