@extends('layouts.layout')

@section('title')
    تغییر رمز عبور
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
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ request('token') }}">

                            <div class="form-group">
                                <label>آدرس ایمیل</label>
                                <input name="email" type="email" class="form-control" placeholder="ایمیل شما">
                            </div>
                            <div class="form-group">
                                <label>رمز عبور جدید</label>
                                <input name="password" type="password" class="form-control" placeholder="گذرواژه شما">
                            </div>
                            <div class="form-group">
                                <label>تکرار رمز عبور جدید</label>
                                <input name="password_confirmation" type="password" class="form-control"
                                    placeholder="تکرار گذرواژه شما">
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn"><i class="far fa-sign-in"></i> تغییر رمز</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
