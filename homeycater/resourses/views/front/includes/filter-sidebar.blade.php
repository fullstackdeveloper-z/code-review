<div class="col-lg-3 col-md-4 col-sm-4 pa_h">
    <div class="shop-filters">
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#filter_one" aria-expanded="false" aria-controls="collapsefour">
                    City <span class="mdi mdi-chevron-down float-right"></span>
                    </button>
                    </h5>
                </div>
                <div id="filter_one" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    <div class="list-group">
                        @forelse (getCities() as $city)
                            <label class="container_check">{{ $city->city }}
                                <input type="radio" value="{{ $city->city }}" name="city" class="menu-filter" {{ request()->has('city') && Request::get('city') ==$city->city ? 'checked' : '' }}>
                                <span class="checkmark_check"></span>
                            </label>
                        @empty
                        @endforelse
                    </div>
                </div>
                </div>
            </div>
          
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#filter_two" aria-expanded="false" aria-controls="collapsefour">
                        Town  <span class="mdi mdi-chevron-down float-right"></span>
                        </button>
                    </h5>
                </div>
                <div id="filter_two" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <div class="list-group town">
                            @forelse (getTowns() as $town)
                                <label class="container_check">{{ $town->town }}
                                    <input type="radio"  name="town" value="{{ $town->town }}" class="menu-filter" {{ request()->has('town') && Request::get('town') == $town->town ? 'checked' : '' }}>
                                    <span class="checkmark_check"></span>
                                </label>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#filter_three" aria-expanded="false" aria-controls="collapsefour">
                        Neighborhood <span class="mdi mdi-chevron-down float-right"></span>
                        </button>
                    </h5>
                </div>
                <div id="filter_three" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <div class="list-group neighborhood">
                            @forelse (getNeighborhood() as $neighborhood)
                            <label class="container_check">{{ $neighborhood->neighborhood }}
                                <input type="radio" name="neighborhood" value="{{$neighborhood->neighborhood}}" class="menu-filter" {{ request()->has('neighborhood') && Request::get('neighborhood') == $neighborhood->neighborhood ? 'checked' : '' }}>
                                <span class="checkmark_check"></span>
                            </label>
                            @empty
                            @endforelse
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#filter_four" aria-expanded="false" aria-controls="collapsefour">
                        Main category dishes <span class="mdi mdi-chevron-down float-right"></span>
                        </button>
                    </h5>
                </div>
                <div id="filter_four" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <div class="list-group">
                            @forelse (getFoodCategories() as $food_category)
                            <label class="container_check">{{ $food_category->name }}
                                <input type="radio" name="food_category" value="{{$food_category->id }}" class="menu-filter" >
                                <span class="checkmark_check"></span>
                            </label>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#filter_five" aria-expanded="false" aria-controls="collapsefour">
                        Home Delivery  <span class="mdi mdi-chevron-down float-right"></span>
                        </button>
                    </h5>
                </div>
                <div id="filter_five" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <div class="list-group">
                            <label class="container_check">Yes
                                <input type="radio" name="home_delivery" value="yes" class="menu-filter" {{ request()->has('home_delivery') && Request::get('home_delivery') == 'yes' ? 'checked' : '' }}>
                                <span class="checkmark_check"></span>
                            </label>
                            <label class="container_check">No
                                <input type="radio" name="home_delivery" value="no" class="menu-filter"  {{ request()->has('home_delivery') && Request::get('home_delivery') == 'no' ? 'checked' : '' }}>
                                <span class="checkmark_check"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#filter_six" aria-expanded="false" aria-controls="collapsefour">
                        Large order Catering <span class="mdi mdi-chevron-down float-right"></span>
                        </button>
                    </h5>
                </div>
                <div id="filter_six" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <div class="list-group">
                            @forelse (getLargeOrderCatering() as $catering)
                            <label class="container_check">{{ $catering->large_order_catering }}
                                <input type="radio" name="large_order_catering" value="{{ $catering->large_order_catering }}" class="menu-filter"  {{ request()->has('large_order_catering') && Request::get('large_order_catering') == $catering->large_order_catering ? 'checked' : '' }}>
                                <span class="checkmark_check"></span>
                            </label>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>