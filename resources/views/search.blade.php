@extends('layouts.layout')

@section('title')
    نتایج جستجو
@endsection
@section('content')
    <main class="main">

        <div class="site-breadcrumb">
            {{-- <div class="site-breadcrumb-bg" style="background: url(assets/img/breadcrumb/01.jpg)"></div> --}}

            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">نتایج جستجو</h4>
                </div>
            </div>
        </div>


        <div class="user-area bg py-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="search-results-card">
                            <h4 class="search-results-title">نتایج جستجو برای "{{ $searchTerm }}"</h4>

                            <!-- Articles Section -->
                            <h5 class="mt-4">مقالات</h5>
                            <div class="table-responsive">
                                <table class="table table-borderless text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>عنوان</th>
                                            <th>لینک</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($articles as $index => $article)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $article->title }}</td>
                                                <td>
                                                    <a href="/article/{{ $article->slug }}"
                                                        class="btn btn-outline-secondary btn-sm rounded-2">
                                                        مشاهده
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">هیچ مقاله‌ای یافت نشد.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Categories Section -->
                            <h5 class="mt-4">دسته‌بندی‌ها</h5>
                            <div class="table-responsive">
                                <table class="table table-borderless text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نام</th>
                                            <th>لینک</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $index => $category)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <a href="/category/{{ $category->slug }}"
                                                        class="btn btn-outline-secondary btn-sm rounded-2">
                                                        مشاهده
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">هیچ دسته‌بندی‌ای یافت نشد.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tags Section -->
                            <h5 class="mt-4">برچسب‌ها</h5>
                            <div class="table-responsive">
                                <table class="table table-borderless text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نام</th>
                                            <th>لینک</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tags as $index => $tag)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $tag->title }}</td>
                                                <td>
                                                    <a href="/tag/{{ $tag->name }}"
                                                        class="btn btn-outline-secondary btn-sm rounded-2">
                                                        مشاهده
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">هیچ برچسبی یافت نشد.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>
@endsection
