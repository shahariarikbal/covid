<!doctype html>
<html lang="en">
<head>
  <title>Covid &mdash; @yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    

  @include('frontend.includes.style')
  @stack('styles')

</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>


  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    
    @include('frontend.includes.header')

    

    @yield('content')

    @include('frontend.includes.footer')

  </div> <!-- .site-wrap -->

  @include('frontend.includes.script')
  @stack('scripts')


</body>
</html>