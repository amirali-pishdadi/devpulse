@extends('layouts.layout')

@section('title')
    درباره ما
@endsection
@section('content')
    <main class="main">

        <div class="site-breadcrumb">
            {{-- <div class="site-breadcrumb-bg" style="background: url(assets/img/breadcrumb/01.jpg)"></div> --}}

            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">با ما تماس بگیرید</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="/"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li class="active">با ما تماس بگیرید</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="contact-area py-100">
            <div class="container">
                <div class="contact-wrapper">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="contact-form">
                                <div class="contact-form-header">
                                    <h2>ارتباط با ما
                                    </h2>
                                    <p>اگر سوال، پیشنهاد یا درخواست خاصی دارید، می‌توانید از طریق فرم زیر با ما در ارتباط
                                        باشید. تیم ما در اسرع وقت پاسخگوی شما خواهد بود.</p>
                                    <ul>
                                        <li>اطلاعات تماس خود را وارد کنید</li>
                                        <li>پیام خود را ارسال کنید</li>
                                    </ul>
                                    <p>ما مشتاقانه منتظر شنیدن نظرات و بازخوردهای شما هستیم.</p>
                                </div>
                                <form method="post" action="/send-email" id="contact-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="name" class="form-control" name="name"
                                                    placeholder="نام" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" id="email" class="form-control" name="email"
                                                    placeholder="ایمیل شما" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="subject" class="form-control" name="subject"
                                            placeholder="موضوع" required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" id="message" cols="30" rows="4" class="form-control"
                                            placeholder="پیام خود را بنویسید"></textarea>
                                    </div>
                                    <button type="submit" class="theme-btn">ارسال
                                        پیام <i class="far fa-paper-plane"></i></button>
                                    <div class="col-md-12 my-3">
                                        <div class="form-messege text-success"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="contact-map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96708.34194156103!2d-74.03927096447748!3d40.759040329405195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4a01c8df6fb3cb8!2sSolomon%20R.%20Guggenheim%20Museum!5e0!3m2!1sen!2sbd!4v1619410634508!5m2!1sen!2s"
                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div> --}}

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
