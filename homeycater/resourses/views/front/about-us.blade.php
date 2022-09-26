@extends('front.website-layout')
@section('css')

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
				<a href="javascript:void(0)">About us</a>
			</div>
		</div>
	</div>
</section>
@endsection

@section('content')
    <div class="row">
        <div class="pl-4 col-lg-5 col-md-5 pr-2">
            <img class="rounded img-fluid" src="{{ asset('frontend/img/about.jpg') }}" alt="Card image cap">
        </div>
        <div class="col-lg-7 col-md-6 pl-1 pr-1 ab_text">
            <h2 class="mt-1 mb-1">Save more with GO! We give you the lowest prices on all your grocery needs.</h2>
            <h5 class="mt-2">Our Vision</h5>
            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here,</p>
            <h5 class="mt-4">Our Goal</h5>
            <p>When looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, Lorem Ipsum has been the industry's standard dummy text ever since.</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="pl-4 col-lg-5 col-md-5 pr-2">
            <img class="rounded img-fluid" src="{{ asset('frontend/img/slider/slider2.jpg') }}" alt="Card image cap">
        </div>
        <div class="col-lg-7 col-md-6 pl-1 pr-1 ab_text">
            <h2 class="mt-1 mb-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </h2>
            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here,</p>
        </div>
    </div>
@endsection
