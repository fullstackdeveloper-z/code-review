@extends('front.website-layout')
@section('css')
    <title>All Caters || {{ env('APP_NAME') }}</title>
@endsection
@section('breadcrumb')
<section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a href="{{ route('web.home') }}">
					<strong>
						<span class="mdi mdi-home"></span> Home
					</strong>
				</a>
				<span class="mdi mdi-chevron-right"></span>
				<a href="javascript:void(0)">Caters</a>
			</div>
		</div>
	</div>
</section>
@endsection
@section('content')
<style>
.wrap_filter_new{box-shadow: 0 2px 8px 0 rgb(0 0 0 / 6%);
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
    margin-bottom: 13px;
    background-color: #fff!important;
    padding: 14px; padding-bottom: 14px;}
   .wrap_filter_new select{}
   .wrap_filter_new .form-control{}
   .wrap_filter_new button{    width: 100%;
    padding: 8px;}

    .wrap_filter_new small{    margin-bottom: 0;
    color: red;
    font-size: 12px;
    padding: 0 4px;}

</style>


    <section class="product-items-slider section-padding">
        <div class="container">
            <div class="section-header">
                <h5 class="heading-design-h5">All Caters</h5>
            </div>
            <section id="menu-6" class="index_sec">

                <div class="wrap_filter_new">
                <div class="row">
                    <div class="col-md-5">
                        <select name="search_select" id="search_select" class="form-control select-input placeholder-active active focused">
                            <option value="">Select one</option>
                           <option value="neighborhood" {{ Request::get('option') =='neighborhood' ? 'selected' : '' }}>Neighborhood</option>
                           <option value="town"  {{ Request::get('option') =='town' ? 'selected' : '' }}>Town</option>
                           <option value="city" {{ Request::get('option') =='city' ? 'selected' : '' }}>City</option>
                           <option value="dish_type"  {{ Request::get('option') =='dish_type' ? 'selected' : '' }}>Dish Type</option>
                           <option value="home_delivery" {{ Request::get('option') =='home_delivery' ? 'selected' : '' }}>Home Delivery</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <input type="search" class="form-control" name="search" id="search" placeholder="Search" value="{{ Request::get('keyword') ?? '' }}">
                    </div>
                    <div class="col-md-2">
                        <button id="search_btn" class="btn btn-secondary" >Search</button>
                    </div>
                  
                </div>
                <small class="error" style="display: none">Error code</small>
            </div>
                <div class="row">
                  
                    @forelse ($caters as $cater)
                    <div class="col-lg-4 col-md-4 col-sm-6 ">
                        <div class="menu-6-item bg-white">
                            <div class="menu-6-img rel">
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
                                            <div class="item">
                                                <a href="#">
                                                    <img class="img-fluid" src="{{asset('frontend/img/no_image.png') }}" height="200px" alt="First slide">
                                                </a>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-6-txt rel">
                                <h5 class="h5-sm">{{ @$cater->user->name }}</h5>
                                <p class="grey-color">{{ Str::words(@$cater->user->cater->intro, 10)  }}</p>
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
          
            {{ $caters->appends(['option' =>Request::get('option'),'keyword' => Request::get('keyword')])->links('pagination::category-pagination') }}
            </section>
        </div>
    </section>

@endsection
@section('js')
<script>
   
    $(document).ready(function(){
        $('body').on('click',"#search_btn", function() {
        
        var search_keyword = $('#search').val();
        var search_select = $('#search_select :selected').val();
        if(($.trim(search_keyword) == '') || ($.trim(search_select)=='')){
            
            return false;
        }else{
            window.location.href="?option="+search_select+"&keyword="+search_keyword;
        }
        }); 
    });
    </script>
@endsection

