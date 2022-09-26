
    @forelse ($caters as $cater)
        <div class="col-sm-6 col-lg-6">
            <div class="menu-6-item bg-white">

                <div class="pro_img_slider">

                    <div class=" text-center">
                        <div class="owl-carousel owl-carousel-slider rounded overflow-hidden shadow-sm category-slider">
                            @forelse ($cater->user->gallery as $gallery)
                                <div class="item">
                                    <a href="#">
                                        <img class="img-fluid" src="{{ asset('storage/'.$gallery->image) }}" height="200px" alt="First slide">
                                    </a>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            <div class="menu-6-txt rel">
                <h5 class="h5-sm">{{ $cater->user->name }}</h5>
                <p class="grey-color">{{ $cater->user->cater->intro }}</p>
                <div class="add-to-cart bg-yellow ico-10">
                    <a href="{{ route('web.cater.profile',$cater->user->id) }}" class="btn btn-secondary btn-sm"><span class="flaticon-shopping-bag"></span>More Info <i class="mdi mdi-arrow-right"></i></a>
                </div>
            </div>

            </div>
        </div>
    @empty
    @endforelse

 
