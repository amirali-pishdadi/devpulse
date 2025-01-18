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
                    <h4 class="breadcrumb-title">مقاله جدید</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="/"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li class="active">مقاله جدید</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="login-area py-100">
            <div class="container">
                <div class="col-md-12 mx-auto">
                    <div class="login-form">
                        <div class="login-header">
                            <p>یک مقاله جدید بسازید</p>
                        </div>
                        <form action="/create-article" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Title -->
                            <div class="form-group">
                                <label for="title">عنوان مقاله</label>
                                <input name="title" type="text" class="form-control"
                                    placeholder="عنوان مقاله را وارد کنید" required minlength="5" maxlength="255">
                            </div>

                            <!-- Slug -->
                            <div class="form-group">
                                <label for="slug">ایدی مناسب</label>
                                <input name="slug" type="text" class="form-control" placeholder="slug را وارد کنید"
                                    required minlength="5" maxlength="255">
                            </div>

                            <!-- Content -->
                            <div class="form-group">
                                <label for="content">محتوای مقاله</label>
                                <textarea rows="10" name="content" class="form-control" placeholder="متن مقاله را وارد کنید" required
                                    minlength="50"></textarea>
                            </div>

                            <!-- Excerpt -->
                            <div class="form-group">
                                <label for="excerpt">خلاصه</label>
                                <input name="excerpt" type="text" class="form-control"
                                    placeholder="خلاصه‌ای کوتاه از مقاله وارد کنید" required maxlength="255">
                            </div>

                            <!-- Tags -->
                            <div class="form-group">
                                <label for="tags">برچسب‌ها (با ویرگول جدا کنید)</label>
                                <input name="tags" type="text" class="form-control"
                                    placeholder="مثال: تکنولوژی, برنامه‌نویسی, توسعه وب" required>
                            </div>

                            <!-- Category -->
                            <div class="form-group">
                                <label for="category">دسته‌بندی</label>
                                <select name="category" class="form-control" required>
                                    <option value="">انتخاب دسته‌بندی</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Featured Image -->
                            <div class="form-group">
                                <label for="featured_image_url">تصویر اصلی</label>
                                <input name="featured_image_url" type="file" class="form-control" accept="image/jpg"
                                    required>
                            </div>

                            <!-- Reading Time -->
                            <div class="form-group">
                                <label for="reading_time">مدت زمان خواندن (به دقیقه)</label>
                                <input name="reading_time" type="number" class="form-control" placeholder="مثال: 5"
                                    required min="1">
                            </div>

                            <div class="form-check form-switch">

                                <input name="is_pinned" class="form-check-input" type="checkbox" value="1"
                                    id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked">پیشنهاد سردبیر </label>

                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn">
                                    <i class="far fa-paper-plane"></i> ثبت مقاله
                                </button>
                            </div>
                        </form>


                    </div>
                </div>
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
                <img src="assets/img/newsletter/01.png" alt="">
            </div>
            <div class="newsletter-img-2">
                <img src="assets/img/newsletter/02.png" alt="">
            </div>
        </div> --}}

    </main>
@endsection
