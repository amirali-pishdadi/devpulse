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
                    <h4 class="breadcrumb-title">ورود به سیستم</h4>
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
                            <img src="/assets/img/logo/Untitled-1.png" alt="">
                            <p>به حساب خود وارد شوید</p>
                        </div>
                        <form action="/login" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>آدرس ایمیل</label>
                                <input name="email" type="email" class="form-control" placeholder="ایمیل شما">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>رمز عبور</label>
                                <input name="password" type="password" class="form-control" placeholder="گذرواژه شما">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="remember">
                                    <label class="form-check-label" for="remember">
                                        مرا به خاطر بسپار
                                    </label>
                                </div>
                                <a href="/password/forgot" class="forgot-pass">گذرواژه را فراموش کرده‌اید؟</a>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn"><i class="far fa-sign-in"></i> ورود</button>
                            </div>
                        </form>
                        <div class="login-footer">
                            <p>حساب ندارید؟ <a href="/register">ثبت نام کنید.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </main>
@endsection
