<!DOCTYPE html>
<html lang="en">
   <head>
      @include('front.includes.styles')
      @livewireStyles
      {{-- <link rel="stylesheet"
            href="{{ asset(mix('/css/app.css')) }}"> --}}
      @yield('css')
   </head>
   <body>
        <div class="navbar-top pt-2 pb-2">
            <div class="container">
                <div class="row">
                <div class="col-lg-6 col-md-4">
                    <a href="#" class="mb-0 text-white">
                    <i class="mdi mdi-email-outline"></i>  foodinfo@gmail.com  </a>
                </div>
                <div class="col-lg-6 col-md-8 text-right top_right">
                    <a href="#" class="text-white"><i class="mdi mdi-facebook"></i> Facebook</a>
                    <a href="#" class="text-white ml-1 mr-1 center_bor"><i class="mdi mdi-instagram"></i> Instagram</a>
                    <a href="#" class="text-white" ><i class="mdi mdi-google"></i> Google</a>
                </div>
                </div>
            </div>
        </div>
        @include('front.includes.header')
        @yield('breadcrumb')
     @include('front.ads.top-ads')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    @yield('content')
                </div>
                <div class="col-lg-3">
                    @include('front.ads.side-ads')
                </div>
            </div>
        </div>
    </section>

        {{-- @yield('content') --}}

    @include('front.includes.footer')
    @include('front.includes.scripts')
    {{-- <script src="{{ asset(mix('/js/app.js')) }}"></script> --}}
    @livewireScripts
    @yield('js')

   </body>
</html>
