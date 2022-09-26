@extends('front.website-layout')
@section('css')
    <title>Cater Listing || {{ env('APP_NAME') }}</title>
    <style>
        .category-slider img {
    height: 195px;
}
</style>
@endsection
@section('content')
<section class="section-padding wrap_m_cl">
    <div class="container">
       <h2 class="head_con">Lorem ipsum dolor sit amet, consectetuer. </h2>
        <hr>
       <p>When looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, Lorem Ipsum has been the industry's standard dummy text ever since. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor</p>
    </div>
 </section>


<section class="shop-list section-padding" id="shop-list">
    <div class="row">
        @include('front.includes.filter-sidebar')
        <div class="col-lg-9 col-md-8 col-sm-8" >
            <div class="shop-head">
                <div class="head_veg">
                    <a href="#"><span class="mdi mdi-home"></span> Home</a> <span class="mdi mdi-chevron-right"></span> <a href="#">Caters Category</a> <span class="mdi mdi-chevron-right"></span> <a href="#">Caters List</a>
                </div>
            </div>
            <section class="product-items-slider section-padding">
                <div class="">
                    <div class="section-header">
                        <h5 class="heading-design-h5">Caters List</h5>
                    </div>
                    <section id="menu-6" class="">
                        <div class="row" id="cater-list">
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
                                        <h5 class="h5-sm">{{ @$cater->user->name }}</h5>
                                        <p class="grey-color">{{ Str::words(@$cater->user->cater->intro, 15)  }}</p>
                                        <div class="add-to-cart bg-yellow ico-10">
                                            <a href="{{ route('web.cater.profile',@$cater->user->id) }}" class="btn btn-secondary btn-sm"><span class="flaticon-shopping-bag"></span>More Info <i class="mdi mdi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    <!-- End row -->
                    </section>
                </div>
            </section>
            {{ $caters->appends(['city' =>Request::get('city'),'town' =>Request::get('town'),'neighborhood' =>Request::get('neighborhood'),'home_delivery'=>Request::get('home_delivery'),'large_order_catering'=>Request::get('large_order_catering')])->links('pagination::category-pagination') }}
        </div>
    </div>
    
</section>
@endsection
@section('js')
<script>
function filter(){
    city =  $("input[name='city']:checked").val();
    town =  $("input[name='town']:checked").val();
    neighborhood =  $("input[name='neighborhood']:checked").val();
    food_category =  $("input[name='food_category']:checked").val();
    home_delivery =  $("input[name='home_delivery']:checked").val();
    large_order_catering =  $("input[name='large_order_catering']:checked").val();
    window.location.href="?city="+city+"&town="+town+"&neighborhood="+neighborhood+"&home_delivery="+home_delivery+"&large_order_catering="+large_order_catering+"&food_category="+food_category;
}
$(document).ready(function(){
    $('body').on('change',".menu-filter", function() {
        filter();
    });
   
});
</script>
@endsection
