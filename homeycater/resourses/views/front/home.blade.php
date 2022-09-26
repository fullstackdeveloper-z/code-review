@extends('front.website-layout')
@section('css')
    <title>Home || {{ env('APP_NAME') }}</title>
@endsection

@section('content')
    <section class="food-carousel-two ">
        <div class="carousel-slider-main text-center" >
            <div class="owl-carousel rounded overflow-hidden shadow-sm baner_slider" id="carousel_for_video">
                @forelse (getAds('slider') as $ad)
                 @if ($ad->type =='slider')
                   @if ($ad->adable_type=='App\Models\Photo')
                   <div class="item">
                    <a href="{{$ad->url }}"><img class="img-fluid" src="{{ asset('storage/'.$ad->image->image) }}" alt="First slide" ></a>
                   </div>
                   @else
                    <div class="item" >
                        <a href="{{$ad->url }}">
                            <video class="video" muted autoplay="autoplay" loop="loop" preload="auto" >
                                <source src="{{ asset('storage/'.$ad->video->video) }}"></source>
                            </video>
                        </a>
                    </div>
                   @endif
                 @endif
                @empty
                @endforelse
            </div>
        </div>
    </section>
    <section class="section-padding wrap_m_cl">
        <div class="container">
            <h2 class=" head_con">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</h2>
            <hr>
                <p>When looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, Lorem Ipsum has been the industry's standard dummy text ever since. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor</p>
        </div>
    </section>
    <section class="product-items-slider section-padding">
        <div class="container">
            <div class="section-header">
                <h5 class="heading-design-h5">Category List <span><a href="{{ route('web.all.categories') }}">View All <i class="mdi mdi-arrow-right"></i></a></span></h5>
            </div>
            <section id="menu-6" class="index_sec">
                <div class="row">
                    @forelse ($categories as $category)
                        <div class="col-lg-4 col-md-4 col-sm-6 ">
                            <div class="menu-6-item bg-white">
                                <div class="menu-6-img rel">

                                <a href="{{ route('web.dishes', $category->slug) }}">
                                    <div class="hover-overlay">
                                        <!-- Image -->

                                        <img class="img-fluid" src="{{ !empty($category->image)? asset('storage/'.$category->image):  asset('frontend/img/chicken.png') }}" alt="{{ $category->name }}">

                                    </div>
                                </a>
                                </div>
                                <div class="menu-6-txt rel">

                                <h5 class="h5-sm">{{ $category->name }}</h5>
                                <p class="grey-color">{{ Str::limit($category->description,55) }}</p>
                                <div class="add-to-cart bg-yellow ico-10">myCarousel
                                    <a href="{{ route('web.dishes', $category->slug) }}" class="btn btn-secondary btn-sm"><span class="flaticon-shopping-bag"></span>More Info <i class="mdi mdi-arrow-right"></i></a>
                                </div>
                                </div>

                            </div>
                        </div>
                    @empty
                    @endforelse


                </div>
                <!-- End row -->
                {{ $categories->links('pagination::category-pagination') }}
            </section>
        </div>
    </section>

@endsection

@section('js')
<script>
var owl = $('.baner_slider');
owl.on('changed.owl.carousel', function(event) {
   autoplayHoverPause:true
})
</script>
@endsection

