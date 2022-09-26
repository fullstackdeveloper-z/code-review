<header>
    <div class="container">
       <div class="row no-gutters">
          <div class="col-lg-3 col-3">
             <a class="navbar-brand" href="{{ route('web.home') }}"> <img src="{{ asset('frontend/img/logo.png') }}" alt="logo"> </a>
          </div>

           <div class="col-9 menu_trigger">
             <nav class="navbar navbar-light navbar-expand-lg k bg-faded food-menu">
                <div class="container">
                   <button class="navbar-toggler navbar-toggler-white" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon"></span>
                   </button>
                </div>
             </nav>
           </div>

          <div class="col-lg-9 col-12">
             @include('front.includes.menu')
          </div>
       </div>
    </div>
 </header>
