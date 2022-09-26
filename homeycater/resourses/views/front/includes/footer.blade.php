<section class="footer section-padding py-5">
    <div class="container">
        <div class="row py-lg-4">
           <div class="col-xl-2 col-md-2 col-sm-6">
              <div class="footer-brand">
                 <img class="img-fluid" src="{{ asset('frontend/img/logo.png') }}">
              </div>
           </div>
           <div class="col-xl-2 col-md-2 col-sm-6 col-6">
              <h6 class="mb-4">Hot link</h6>
              <ul>
                 <li><a href="{{ route('web.home') }}">Home</a></li>
                 <li><a href="{{ route('web.about.us') }}">About Us</a></li>
                  <li><a href="{{ route('web.contact.us') }}">Contact Us</a></li>

              </ul>
           </div>
           <div class="col-xl-2 col-md-2 col-sm-6 col-6">
             <h6 class="mb-4">Hot link</h6>
              <ul>
                 <li><a href="{{ route('web.register') }}">Cater Sign up</a></li>
                 <li><a href="{{ route('web.advertise.with.us') }}">Advertise with us</a></li>
              </ul>
           </div>
           <div class="col-xl-2 col-md-2 col-sm-6">
                <h6 class="mb-4">Hot link</h6>
                <ul>
                    <li><a href="{{ route('web.faqs') }}">FAQ</a></li>
                    <li><a href="javascript:void(0)">Term/Policies</a></li>
                </ul>
           </div>
           <div class="col-xl-4 col-md-4 col-sm-6">
                <h6 class="mb-4">Keyword</h6>
                <div class="Keyword_tag">
                    <span>Keyword 1</span>
                    <span>Keyword 2</span>
                    <span>Keyword 3</span>
                    <span>Keyword 4</span>
                    <span>Keyword 5</span>
                    <span>Keyword 6</span>
                    <span>Keyword 7</span>
                </div>

           </div>
        </div>
    </div>
</section>
<section class="pt-4 pb-4 footer-bottom">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-12 col-sm-12">
                <p class="mt-1 mb-0 text-center">&copy; Copyright {{ date('Y') }} <strong class="text-dark">{{ env('APP_NAME') }}</strong>.  All Rights
                    Reserved<br>
                </p>
            </div>
        </div>
    </div>
</section>
