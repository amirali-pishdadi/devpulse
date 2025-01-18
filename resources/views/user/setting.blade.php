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
                    <h4 class="breadcrumb-title">تنظیمات</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="/"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li class="active">تنظیمات</li>
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
                            <div class="user-card user-setting">
                                <h4 class="user-card-title">تنظیمات</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h6 class="mb-3">حذف حساب</h6>
                                        <div class="user-form">
                                            <div class="form-group">
                                                <select class="select mb-4" name="reason" required>
                                                    <option value>دلیل را انتخاب کنید</option>
                                                    <option value="1">حذف اکانت به دلیل عدم استفاده از سایت</option>
                                                    <option value="2">حذف اکانت به دلیل مشکلات امنیتی</option>
                                                    <option value="3" selected>حذف اکانت به دلیل علاقه نداشتن به محتوای
                                                        سایت</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <textarea class="form-control" name="details" cols="30" rows="4" placeholder="دلیل خود را شرح دهید" required></textarea>
                                            </div>

                                            <form action="{{ route('deleteAccount') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="theme-btn">
                                                    <span class="far fa-trash-can"></span> حذف حساب
                                                </button>
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

    </main>
@endsection
