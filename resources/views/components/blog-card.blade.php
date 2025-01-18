@php
    $user = App\Models\User::findOrFail(( int )$article->author_id);
    $imagePath = "uploads/{$user->username}/{$article->slug}/$article->featured_image_url";
    $imageSrc = file_exists(public_path($imagePath)) ? asset($imagePath) : asset('images/default-profile.jpg');
@endphp

<div class="col-md-6 col-lg-4">
    <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
        <div class="blog-item-img">
            <img src="{{ $imageSrc }}" alt="Thumb">
        </div>
        <div class="blog-item-info">
            <div class="blog-item-meta">
                <ul>
                    <li><i class="far fa-user-circle"></i> توسط {{ $article->user->name }}</li>
                    <li><i class="far fa-calendar-alt"></i>{{ $article->created_at->format('Y-m-d') }}</li>
                </ul>
            </div>
            <h4 class="blog-title">
                <a href="/article/{{ $article->slug }}">{{ $article->title }}</a>
            </h4>
            <p>{{ $article->excerpt }}</p>
            <a class="theme-btn" href="/article/{{ $article->slug }}">بیشتر بخوانید<i class="fas fa-arrow-left-long"></i></a>
        </div>
    </div>
</div>
