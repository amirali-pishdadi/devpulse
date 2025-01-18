@extends('layouts.layout')

@section('title')
    نبض توسعه دهنده | جدید ترین خبر های دنیای برنامه نویسی
@endsection
@section('content')

    <main class="main">

        <div class="ads">
            <div id="pos-article-display-103141"></div>
        </div>
        <!-- Hero Section: New Articles in Slider -->
        <div class="hero-section3 hs3-2">
            <div class="container">
                <div class="product-area pt-80">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 mx-auto">
                                <div class="site-heading text-center">
                                    <span class="site-title-tagline">پیشنهاد سردبیر</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($sliderArticles as $article)
                                <x-blog-card :article="$article" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Popular Articles Section -->
        <div class="product-area pt-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">مقالات محبوب</span>
                            <h2 class="site-title"><span>مقالات برتر</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($articles as $article)
                        <x-blog-card :article="$article" />
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Popular Tags Section -->
        <div class="tags-area pt-80 d-none d-md-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="site-heading text-center">
                    <span class="site-title-tagline">برچسب‌ها</span>
                    <h2 class="site-title">برچسب‌های <span>محبوب</span></h2>
                </div>
            </div>
        </div>
        <div class="blog-details-tags pb-20 m-5">
            <h5> برچسب‌ها: </h5>
            <ul>
                @foreach ($tags as $tag)
                    <li><a href="/tag/{{ $tag->name }}">{{ $tag->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>




    </main>
@endsection
