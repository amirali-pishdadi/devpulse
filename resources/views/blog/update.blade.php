@extends('layouts.layout')

@section('title')
    ویرایش مقاله
@endsection

@section('content')
    <main class="main">
        <div class="site-breadcrumb">
            <div class="site-breadcrumb-bg" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})"></div>
            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">ویرایش مقاله</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="/"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li class="active">ویرایش مقاله</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="login-area">
            <div class="container">
                <div class="col-md-12 mx-auto">
                    <div class="login-form">
                        <div class="login-header">
                            <p>مقاله خود را ویرایش کنید</p>
                        </div>
                        <form action="/articles/{{ $article->slug }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Title -->
                            <div class="form-group">
                                <label for="title">عنوان مقاله</label>
                                <input name="title" type="text" class="form-control"
                                    placeholder="عنوان مقاله را وارد کنید" value="{{ old('title', $article->title) }}"
                                    required minlength="5" maxlength="255">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Slug -->
                            <div class="form-group">
                                <label for="slug">ایدی مقاله</label>
                                <input name="slug" type="text" class="form-control"
                                    placeholder="اسلاگ وارد کنید" value="{{ old('slug', $article->slug) }}"
                                    required minlength="5" maxlength="255">
                                @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Content -->
                            <div class="form-group">
                                <label for="content">محتوای مقاله</label>
                                <textarea rows="10" name="content" class="form-control" placeholder="متن مقاله را وارد کنید" required
                                    minlength="50">{{ old('content', $article->content) }}</textarea>
                                @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Excerpt -->
                            <div class="form-group">
                                <label for="excerpt">خلاصه</label>
                                <input name="excerpt" type="text" class="form-control"
                                    placeholder="خلاصه‌ای کوتاه از مقاله وارد کنید"
                                    value="{{ old('excerpt', $article->excerpt) }}" maxlength="255">
                                @error('excerpt')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tags -->
                            <div class="form-group">
                                <label for="tags">برچسب‌ها (با ویرگول جدا کنید)</label>
                                <input name="tags" type="text" class="form-control"
                                    placeholder="مثال: تکنولوژی, برنامه‌نویسی, توسعه وب"
                                    value="{{ old('tags', $article->tags->pluck('title')->implode(', ')) }}" required>
                                @error('tags')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="form-group">
                                <label for="category">دسته‌بندی</label>
                                <select name="category" class="form-control" required>
                                    <option value="">انتخاب دسته‌بندی</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->slug }}"
                                            {{ old('category', $article->category->slug) == $category->slug ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Featured Image -->
                            <div class="form-group">
                                <label for="featured_image_url">تصویر اصلی</label>
                                <input name="featured_image_url" type="file" class="form-control"
                                    accept="image/jpg">
                                @error('featured_image_url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Reading Time -->
                            <div class="form-group">
                                <label for="reading_time">مدت زمان خواندن (به دقیقه)</label>
                                <input name="reading_time" type="number" class="form-control" placeholder="مثال: 5"
                                    value="{{ old('reading_time', $article->reading_time) }}" required min="1">
                                @error('reading_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn">
                                    <i class="far fa-paper-plane"></i> ویرایش مقاله
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
