@extends('layouts.layout')

@section('title')
    وبلاگ
@endsection
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <main class="main">

        <div class="site-breadcrumb">
            {{-- <div class="site-breadcrumb-bg" style="background: url(assets/img/breadcrumb/01.jpg)"></div> --}}

            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">ثبت نام</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="/"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li class="active">ثبت نام</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="login-area py-100">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="login-form">
                        <div class="login-header">
                            <img src="/assets/img/logo/Untitled-1.png" alt="">
                            <p>حساب خود را ایجاد کنید</p>
                        </div>
                        <form id="registration-form" action="/register" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>نام کامل</label>
                                <input name="name" type="text" class="form-control" placeholder="نام شما">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>آدرس ایمیل</label>
                                <input name="email" type="email" class="form-control" placeholder="ایمیل شما">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>نام کاربری</label>
                                <input name="username" type="text" class="form-control" placeholder="نام کاربری"
                                    minlength="8">
                                @error('username')
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
                            <div class="form-group">
                                <label>تکرار رمز عبور</label>
                                <input name="password_confirmation" type="password" class="form-control"
                                    placeholder="تکرار گذرواژه شما">
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-check form-group">
                                <input class="form-check-input" type="checkbox" value="" id="agree">
                                <label class="form-check-label" for="agree">
                                    من با شرایط خدمات موافقم
                                </label>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn"><i class="far fa-paper-plane"></i> ثبت نام</button>
                            </div>
                        </form>
                        <div class="login-footer">
                            <p>از قبل حساب کاربری دارید؟ <a href="/login">ورود شوید.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="verification-modal" tabindex="-1" aria-labelledby="verificationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verificationModalLabel">تایید ایمیل</h5>
                    </div>
                    <div class="modal-body">
                        <p>کد تایید به ایمیل شما ارسال شده است. لطفا کد را وارد کنید.</p>
                        <input type="text" id="verification-code" class="form-control" placeholder="کد تایید"
                            maxlength="6">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="verify-btn" class="btn btn-danger">تایید</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('registration-form');
                const verificationModal = new bootstrap.Modal(document.getElementById('verification-modal'));
                const verifyBtn = document.getElementById('verify-btn');
                const verificationCodeInput = document.getElementById('verification-code');
                let sentCode = '';

                // Handle form submission
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const email = document.querySelector('input[name="email"]').value;

                    if (!email) {
                        alert('لطفاً آدرس ایمیل خود را وارد کنید.');
                        return;
                    }

                    // Generate a 6-digit random code
                    sentCode = Math.floor(100000 + Math.random() * 900000).toString();

                    // Send the verification code via an API call
                    fetch('/send-code', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                email,
                                code: sentCode
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('خطا در ارتباط با سرور.');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {

                                verificationModal.show();
                            } else {
                                alert(data.message || 'خطا در ارسال کد تایید. لطفاً دوباره تلاش کنید.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('خطا در ارسال کد تایید. لطفاً دوباره تلاش کنید.');
                        });
                });

                // Handle verification button click
                verifyBtn.addEventListener('click', function() {
                    if (verificationCodeInput.value === sentCode) {
                        alert('ایمیل شما تایید شد. ثبت‌نام انجام می‌شود.');
                        verificationModal.hide();
                        form.submit(); // Submit the form after successful verification
                    } else {
                        alert('کد وارد شده صحیح نیست. لطفاً دوباره تلاش کنید.');
                    }
                });
            });
        </script>
    </main>
@endsection
