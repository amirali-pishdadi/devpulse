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
                    <ul class="breadcrumb-menu">
                        <li><a href="/"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li><a href="/articles"> مقالات </a></li>
                        <li><a href="/category/{{ $article->category->slug }}"> {{ $article->category->name }} </a></li>

                        <li class="active">{{ $article->title }}</li>

                    </ul>
                </div>
            </div>
        </div>


        <div class="blog-single-area py-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-xxl-9 mx-auto">
                        <div class="blog-single-wrapper">
                            <div class="blog-single-content">
                                @php
                                    $user = App\Models\User::findOrFail((int) $article->author_id);
                                    $imagePath = "uploads/{$user->username}/{$article->slug}/$article->featured_image_url";
                                    $imageSrc = file_exists(public_path($imagePath))
                                        ? asset($imagePath)
                                        : asset('images/default-profile.jpg');
                                @endphp
                                <div class="blog-thumb-img">
                                    <img src="{{ $imageSrc }}" alt="thumb">
                                </div>
                                <div class="blog-info">
                                    <div class="blog-meta">
                                        <div class="blog-meta-left">
                                            <ul>
                                                <li><i class="far fa-user"></i><a
                                                        href="#">{{ $article->user->name }}</a></li>
                                                <li>

                                                    <i
                                                        class="far fa-comments"></i>{{ $article->comments->where('is_checked', true)->count() }}
                                                    نظر
                                                </li>
                                                <li><i class="far fa-thumbs-up"></i>{{ $article->likes_count }} لایک</li>
                                                <li><i class="far fa-eye"></i>{{ $article->views_count }} بازدید</li>

                                                @if (Auth::check() && Auth::user()->is_admin)
                                                    <li><i class="far fa-edit"></i><a
                                                            href="/articles/{{ $article->slug }}/edit">ویرایش مقاله</a>
                                                    </li>
                                                    <li><i class="far fa-trash"></i><a
                                                            href="/delete-article/{{ $article->slug }}">حذف مقاله</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="blog-meta-right">
                                        </div>
                                    </div>
                                    <div class="blog-details">
                                        <h3 class="blog-details-title mb-20">{{ $article->title }}</h3>
                                        {{-- <p class="mb-10">{!! nl2br(e($article->content)) !!}</p> --}}
                                        <div class="blog-details-pa  mb-10">
                                            <p class="mb-10">
                                                <x-markdown>
                                                    <div id="pos-article-display-card-103139"></div>‌


                                                    {!! $article->content !!}

                                                </x-markdown>
                                                <script>
                                                    document.querySelectorAll('.blog-details-pa a').forEach(link => {
                                                        link.addEventListener('click', function(e) {
                                                            e.preventDefault();
                                                            window.open(this.href, '_blank');
                                                        });
                                                    });
                                                </script>
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="blog-details-tags pb-20">
                                            <h5> برچسب‌ها: </h5>
                                            <ul>
                                                @foreach ($article->tags as $tag)
                                                    <li><a href="/tag/{{ $tag->name }}">{{ $tag->title }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-9 col-xxl-9">
                                            <button class="btn btn-like " data-id="{{ $article->id }}">
                                                <i class="far fa-heart "></i><span id="likes-count-{{ $article->id }}">
                                                    {{ $article->likes_count }}</span>
                                            </button>
                                        </div>
                                        <div class="col-lg-3 col-xxl-3">

                                            <!-- Telegram -->
                                            <a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ $article->title }}"
                                                target="_blank" class="btn btn-primary" style="background-color: #55acee;">
                                                <i class="fab fa-telegram"></i>
                                            </a>

                                            <!-- LinkedIn -->
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ $article->title }}&summary={{ $article->excerpt }}"
                                                target="_blank" class="btn btn-primary" style="background-color: #0082ca;">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>

                                            <!-- WhatsApp -->
                                            <a href="https://api.whatsapp.com/send?text={{ $article->title }} {{ urlencode(request()->url()) }}"
                                                target="_blank" class="btn btn-primary" style="background-color: #25d366;">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script>
                                        $(document).on('click', '.btn-like', function() {
                                            const articleId = $(this).data('id');
                                            $.ajax({
                                                url: '/articles/' + articleId + '/like',
                                                type: 'POST',
                                                data: {
                                                    _token: '{{ csrf_token() }}'
                                                },
                                                success: function(response) {
                                                    if (response.success) {
                                                        $('#likes-count-' + articleId).text(response.likes_count);
                                                    }
                                                }
                                            });
                                        });
                                    </script>

                                    <div class="blog-author">
                                        <div class="author-info">
                                            <h6>نویسنده</h6>
                                            <h3 class="author-name">{{ $article->user->name }}</h3>
                                            <div>
                                                <p>
                                                    {{ $article->user->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="pos-article-display-103104"></div>
                                <div class="blog-comments mb-0">
                                    <h3>نظرات ({{ $article->comments->where('is_checked', true)->count() }})</h3>
                                    <div class="blog-comments-wrapper">
                                        @foreach ($article->comments->where('is_checked', true) as $comment)
                                            <div class="blog-comments-single">
                                                <div class="blog-comments-content">
                                                    <h5>{{ $comment->user->name }}</h5>
                                                    <span><i class="far fa-clock"></i>
                                                        {{ $comment->created_at->format('Y-m-d') }}</span>
                                                    <p>{{ $comment->content }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if (Auth::check())
                                        <div class="blog-comments-form">
                                            <h3>نظر بدهید</h3>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <form action="/create-comment" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <textarea name="content" class="form-control" rows="5" placeholder="نظر شما"></textarea>
                                                        </div>
                                                        <input type="hidden" name="user_id"
                                                            value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="article_id"
                                                            value="{{ $article->id }}">
                                                        <button type="submit" class="theme-btn">نظر ارسال کنید <i
                                                                class="far fa-paper-plane"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    @if ($relatedArticles->isNotEmpty())
                                        <h4>مقاله های مرتبط</h4>

                                        <div class="row">
                                            @foreach ($relatedArticles as $related)
                                                <x-blog-card :article="$related" />
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xxl-3 mx-auto d-none d-lg-block sticky-div">
                        <div class="popular-articles">
                            <h5>پربازدیدترین مطالب</h5>
                            @foreach ($mostViewed as $mArticle)
                                <div class="article-item">
                                    <div class="article-thumbnail">
                                        @php
                                            $user = App\Models\User::findOrFail((int) $mArticle->author_id);
                                            $imagePath = "uploads/{$user->username}/{$mArticle->slug}/$mArticle->featured_image_url";
                                            $imageSrc = file_exists(public_path($imagePath))
                                                ? asset($imagePath)
                                                : asset('images/default-profile.jpg');
                                        @endphp
                                        <div>
                                            <img src="{{ $imageSrc }}" alt="thumb">
                                        </div>
                                    </div>
                                    <h6>
                                        <a
                                            href="{{ route('articleShow', ['slug' => $mArticle->slug]) }}">{{ $mArticle->title }}</a>
                                    </h6>
                                </div>
                            @endforeach
                        </div>
                        <div class="ads-article">
                            <div id="pos-article-display-103508"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
