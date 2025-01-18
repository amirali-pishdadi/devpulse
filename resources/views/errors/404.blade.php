<!DOCTYPE html>
<html lang="en">

<head>

  @include('layouts.header')

</head>

<body>
  
  <div class="container">

    <div class="row" style="margin-top:10%">
        <!-- 404 Error Text -->
      <div class="col-md-12">
        <div class="text-center">
          <div class="error mx-auto" data-text="404">404</div>
          <p class="lead text-gray-800 mb-5">Page Not Found</p>
          <p class="text-gray-500 mb-0">همچین صفحه وجود نداره داداش</p>
          {{-- {{dd(auth()->user())}}; --}}
            <a href="/">&larr;برگشت به خانه</a>

        </div>
      </div>
    </div>

    </div>


    @include('layouts.footer')

</body>

</html>
