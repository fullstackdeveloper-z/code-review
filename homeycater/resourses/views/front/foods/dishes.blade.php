@extends('front.website-layout')
@section('css')
    <title>Dishes || {{ env('APP_NAME') }}</title>
@endsection
@section('content')

<section class="section-padding wrap_m_cl">
    <div class="container">
       <h2 class="head_con">Lorem ipsum dolor sit amet, consectetuer. </h2>
        <hr>
       <p>{{ $category->description}}</p>
    </div>
 </section>


   <section class="product_listing">
       <div class="pro_l_head">
         <h3>Product Listing <span>{{ $category->name }}</span></h3>
       </div>
       <div class="grid_data_create">

            @forelse ($dishes as $dish)
                <div class="product_listing_h" style="border-color: {{ $dish->color }};">
                    <a href="{{ route('web.caters', $dish->slug) }}" style="color: {{ $dish->color }};">{{ $dish->name }}</a>
                </div>
            @empty
                <h5 class="text-center">No! Dishes found, please try anothor category.</h5>
            @endforelse



       </div>
       {{ $dishes->links('pagination::category-pagination') }}
   </section>

@endsection
