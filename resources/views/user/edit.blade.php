@extends('layouts.layout')

@section('title')
    مشاهده بلاگ های شما
@endsection

@section('content')
    <main class="main">

        <div class="site-breadcrumb">
            {{-- <div class="site-breadcrumb-bg" style="background: url(assets/img/breadcrumb/01.jpg)"></div> --}}

            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">نمایه من</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="/"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li class="active">نمایه من</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="user-area bg py-100">
            <div class="container">
                <div class="row">
                    @include('user.right-panel')

                    <div class="col-lg-9">
                        <div class="user-wrapper">
                            <div class="row">
                                <!-- ویرایش اطلاعات کاربر -->
                                <div class="col-lg-12">
                                    <div class="user-card">
                                        <h4 class="user-card-title">اطلاعات نمایه</h4>
                                        <div class="user-form">
                                            <form action="{{ route('edit-profile', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>نام</label>
                                                            <input type="text" class="form-control" name="name"
                                                                value="{{ old('name', $user->name) }}" placeholder="نام"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>نام کاربری</label>
                                                            <input type="text" class="form-control" name="username"
                                                                value="{{ old('username', $user->username) }}"
                                                                placeholder="نام کاربری" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>نام</label>
                                                            <textarea type="text" rows="10" class="form-control" name="description"
                                                                placeholder="بیوگرافی"
                                                                >{{ old('description', $user->description) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="theme-btn"><span class="far fa-user"></span>
                                                    ذخیره تغییرات</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- تغییر رمز عبور -->
                                <div class="col-lg-12">
                                    <div class="user-card">
                                        <h4 class="user-card-title">تغییر رمز عبور</h4>
                                        <div class="col-lg-12">
                                            <div class="user-form">
                                                <form action="{{ route('change-password', $user->id) }}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>گذرواژه قدیمی</label>
                                                                <input type="password" class="form-control"
                                                                    name="current_password" placeholder="گذرواژه قدیمی"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>گذرواژه جدید</label>
                                                                <input type="password" class="form-control" name="password"
                                                                    placeholder="گذرواژه جدید" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>تایپ مجدد رمز عبور</label>
                                                                <input type="password" class="form-control"
                                                                    name="password_confirmation"
                                                                    placeholder="تایپ مجدد رمز عبور" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="theme-btn"><span
                                                            class="far fa-key"></span> رمز عبور را تغییر دهید</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>
@endsection
