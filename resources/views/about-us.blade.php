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
                    <h4 class="breadcrumb-title">درباره ما</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="/"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li class="active">درباره ما</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="about-area py-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-left wow fadeInLeft" data-wow-delay=".25s"
                            style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInLeft;">
                            <div class="about-img">
                                <img src="assets/img/about/about.jpg" alt="">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-right wow fadeInRight" data-wow-delay=".25s"
                            style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInRight;">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline justify-content-start">
                                    <i class="flaticon-drive"></i> درباره ما
                                </span>
                            </div>
                            <p>
                                ما یک سایت نوپا و پرانگیزه هستیم که هدف اصلی ما ارائه‌ی مقالات ارزشمند و به‌روز در حوزه‌های
                                مختلف فناوری است. تیم ما با علاقه و تخصص در زمینه‌های زیر فعالیت می‌کند:
                            <ul>
                                <li>
                                    دنیای تکنولوژی: انتشار خبرها و تحلیل‌های به‌روز از فناوری‌های نوین و محصولات دیجیتال.
                                </li>
                                <li>
                                    برنامه‌نویسی: آموزش‌ها، نکات کاربردی، و معرفی زبان‌ها و ابزارهای جدید در دنیای کدنویسی.
                                </li>
                                <li>
                                    ارز دیجیتال: تحلیل بازار، آموزش مفاهیم پایه و پیشرفته، و بررسی فناوری‌های مرتبط با
                                    بلاکچین.
                                </li>
                            </ul>
                            ما به‌دنبال آن هستیم که با ارائه محتوای مفید و دقیق، همراه شما در مسیر یادگیری و به‌روز بودن
                            باشیم. اینجا مکانی برای ایده‌پردازی، آشنایی با ترندهای جدید و کسب دانش است.

                            <h5>چرا ما؟</h5>

                            تخصص: مطالب ما توسط نویسندگان آشنا با فناوری و بازار آماده می‌شود.
                            ساده و کاربردی: ما تلاش می‌کنیم مفاهیم پیچیده را به زبانی ساده و قابل‌درک ارائه دهیم.
                            همراهی با مخاطب: پیشنهادات و نظرات شما برای ما اهمیت ویژه‌ای دارد و به بهبود مستمر محتوای
                            سایت کمک می‌کند.
                            اگر به موضوعات فناوری، برنامه‌نویسی یا دنیای ارزهای دیجیتال علاقه‌مند هستید، همراه ما باشید
                            و دانش خود را گسترش دهید.
                            </p>
                            <a href="/contact-us" class="theme-btn mt-4">با ما در ارتباط باشید<i
                                    class="fas fa-arrow-left-long"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="counter-area pt-50 pb-50">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-sm-6">
                        <div class="counter-box">
                            <div class="icon">
                                <img src="assets/img/icon/assets/img/icon/article-svgrepo-com.svg" alt="">
                            </div>
                            <div class="counter-info">
                                <div class="counter-amount">
                                    <span class="counter" data-count="+" data-to="{{ App\Models\Article::all()->count() }}"
                                        data-speed="3000">{{ App\Models\Article::all()->count() }}</span>
                                    <span class="counter-sign">+</span>
                                </div>
                                <h6 class="title">مقاله نوشته شده</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="counter-box">
                            <div class="icon">
                                <img src="assets/img/icon/employee.svg" alt="">
                            </div>
                            <div class="counter-info">
                                <div class="counter-amount">
                                    <span class="counter" data-count="+" data-to="{{ App\Models\User::all()->count() }}"
                                        data-speed="3000">{{ App\Models\User::all()->count() }}</span>
                                    <span class="counter-sign">+</span>
                                </div>
                                <h6 class="title">کاربر سایت</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="team-area pt-100 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">تیم ما</span>
                            <h2 class="site-title">با <span>تیم</span></h2> متخصص ما آشنا شوید
                            <div class="heading-divider"></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-delay=".25s"
                            style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <div class="team-img">
                                <img src="assets/img/team/01.jpg" alt="thumb">
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5><a href="#">چاد اسمیت</a></h5>
                                    <span>مدیر ارشد</span>
                                </div>
                            </div>
                            <div class="team-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-delay=".50s"
                            style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                            <div class="team-img">
                                <img src="assets/img/team/02.jpg" alt="thumb">
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5><a href="#">مالیسا فی</a></h5>
                                    <span>کارشناس سئو</span>
                                </div>
                            </div>
                            <div class="team-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-delay=".75s"
                            style="visibility: visible; animation-delay: 0.75s; animation-name: fadeInUp;">
                            <div class="team-img">
                                <img src="assets/img/team/03.jpg" alt="thumb">
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5><a href="#">آرون رودری</a></h5>
                                    <span>مدیر عامل و بنیانگذار</span>
                                </div>
                            </div>
                            <div class="team-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-delay="1s"
                            style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;">
                            <div class="team-img">
                                <img src="assets/img/team/04.jpg" alt="thumb">
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5><a href="#">تونی پیناکو</a></h5>
                                    <span> بازاریاب دیجیتال</span>
                                </div>
                            </div>
                            <div class="team-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}


        {{-- <div class="video-area pb-120">
            <div class="container-fluid px-0">
                <div class="video-content" style="background-image: url(assets/img/video/01.jpg);">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="video-wrapper">
                                <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=ckHzmP1evNU">
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}


        {{-- <div class="feature-area bg-white pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fal fa-truck"></i>
                            </div>
                            <div class="feature-content">
                                <h4>تحویل رایگان</h4>
                                <p>سفارش‌های بیش از 120 ریال</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fal fa-sync"></i>
                            </div>
                            <div class="feature-content">
                                <h4>بازپرداخت</h4>
                                <p>بازگرداندن ظرف 30 روز</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fal fa-wallet"></i>
                            </div>
                            <div class="feature-content">
                                <h4>پرداخت مطمئن</h4>
                                <p>پرداخت 100% ایمن</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fal fa-headset"></i>
                            </div>
                            <div class="feature-content">
                                <h4>پشتیبانی 24/7</h4>
                                <p>با ما تماس بگیرید</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="newsletter-area pt-60 pb-60">
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
