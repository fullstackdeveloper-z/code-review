@extends('front.website-layout')
@section('css')
    <title>All Categories || {{ env('APP_NAME') }}</title>
@endsection
@section('content')

    <section class="product-items-slider section-padding">
        <div class="container">
            <div class="section-header">
                <h5 class="heading-design-h5">All Categories</h5>
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
                                    <div class="add-to-cart bg-yellow ico-10">
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
