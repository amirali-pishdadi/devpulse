@extends('layouts.layout')

@section('title')
    فراموشی رمز عبور
@endsection

@section('content')
    <main class="main">

        <div class="site-breadcrumb">
            {{-- <div class="site-breadcrumb-bg" style="background: url(assets/img/breadcrumb/01.jpg)"></div> --}}

            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">فراموشی رمز عبور</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="/"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li class="active">ورود به سیستم</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="login-area py-100">
            <div class="container">
                <div class="col-md-7 col-lg-5 mx-auto">
                    <div class="login-form">
                        <div class="login-header">
                            <p>رمز خود را فراموش کرده اید ؟</p>
                        </div>
                        <form action="/password/forgot" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>آدرس ایمیل</label>
                                <input name="email" type="email" class="form-control" placeholder="ایمیل شما">
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn"><i class="far fa-sign-in"></i> ورود</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
