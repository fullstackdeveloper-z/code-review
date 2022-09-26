<nav class=" navbar-expand-lg navbar-light food-menu-2 pad-none-mobile">
    <div class="collapse navbar-collapse" id="navbarText">
       <ul class="navbar-nav  margin-auto">
            <li class="nav-item">
                <a href="{{ route('web.home') }}" class="nav-link active_menu- menu_1 {{Route::currentRouteName()=='web.home' ?'active_menu' :"" }}"><i class="mdi mdi-home"></i> Home</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('web.about.us') }}" class="nav-link menu_2 {{Route::currentRouteName()=='web.about.us' ?'active_menu' :"" }}">About Us</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('web.all.caters') }}" class="nav-link menu_2 {{Route::currentRouteName()=='web.all.caters' ?'active_menu' :"" }}">Caters</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('web.faqs') }}" class="nav-link menu_3  {{Route::currentRouteName()=='web.faqs' ?'active_menu' :"" }}">FAQ</a>
            </li>
          
            <li class="nav-item">
                <a class="nav-link menu_5 {{Route::currentRouteName()=='web.contact.us' ?'active_menu' :"" }}"  href="{{ route('web.contact.us') }}">Contact</a>
            </li>


            <li class="nav-item">
                <a class="nav-link menu_6" href="{{ route('web.advertise.with.us') }}">Advertise</a>
            </li>

            @guest
                @if (Route::has('web.register'))
                    <li class="nav-item">
                        <a class="nav-link menu_4" href="{{ route('web.register') }}">Register</a>
                    </li>
                @endif

                @if (Route::has('web.login'))
                    <li class="nav-item">
                        <a class="nav-link menu_4" href="{{ route('web.login') }}">Login</a>
                    </li>
                @endif
            @else
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link menu_4" href="{{ route('web.user.profile') }}">Profile</a>
                </li> --}}
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="{{ route('web.user.profile') }}"
                            >
                            {{ __('Profile') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('web.logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('web.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest

       </ul>
    </div>
 </nav>
