@extends('front.website-layout')
@section('css')
<style>
    .error{
        color:red;
    }
</style>
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
				<a href="javascript:void(0)">Contact us</a>
			</div>
		</div>
	</div>
</section>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h3 class="mt-1 mb-5">Get In Touch</h3>
        <h6 class="text-dark"><i class="mdi mdi-home-map-marker"></i> Address :</h6>
        <p>Plot No 170 Lorem ipsum, Unit 9 Lorem ipsum Odisha 225014.</p>
        <h6 class="text-dark"><i class="mdi mdi-phone"></i> Phone :</h6>
        <p>+91 12345-XXX, (+91) 123 456 XXXX</p>
        <h6 class="text-dark"><i class="mdi mdi-deskphone"></i> Mobile :</h6>
        <p>(+20) 220 145 XXXX, +91 12345-6XXXX</p>
        <h6 class="text-dark"><i class="mdi mdi-email"></i> Email :</h6>
        <p><a href="" class="__cf_email__">Info@gmail.com</a></p>

        <div class="footer-social"><span>Follow : </span>
            <a href="#"><i class="mdi mdi-facebook"></i></a>
            <a href="#"><i class="mdi mdi-twitter"></i></a>
            <a href="#"><i class="mdi mdi-instagram"></i></a>
            <a href="#"><i class="mdi mdi-google"></i></a>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="col-lg-12 col-md-12 section-title text-left mb-4">
        <h2>Contact Us</h2>
    </div>
    <form class="col-lg-12 col-md-12" method="post"  id="contactForm" novalidate action="{{ route('web.savecontact') }}">
       @csrf
        <div class="control-group form-group">
            <div class="controls">
                <label>Full Name <span class="text-danger">*</span></label>
                <input name="name" value="{{ old('name') }}" type="text" placeholder="Full Name" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                <p class="help-block"></p>
                @if($errors->has('name'))
                <div class="error">{{ $errors->first('name') }}</div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="control-group form-group col-md-6">
                <label>Phone Number <span class="text-danger">*</span></label>
                <div class="controls">
                    <input name="phone" value="{{ old('phone') }}" type="tel" placeholder="Phone Number" class="form-control" id="phone" required data-validation-required-message="Please enter your phone number.">
                </div>
                @if($errors->has('phone'))
                <div class="error">{{ $errors->first('phone') }}</div>
            @endif
            </div>
            <div class="control-group form-group col-md-6">
                <div class="controls">
                    <label>Email Address <span class="text-danger">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
                </div>
                @if($errors->has('email'))
                    <div class="error">{{ $errors->first('email') }}</div>
                @endif
            </div>

        </div>
        <div class="control-group form-group">
            <div class="controls">
                <label>Message <span class="text-danger">*</span></label>
                <textarea name="message" rows="4" cols="100" placeholder="Message" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none">{{ old('message') }}</textarea>
            </div>
            @if($errors->has('message'))
              <div class="error">{{ $errors->first('message') }}</div>
            @endif
        </div>
        <div id="success">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </li>
                       
                    </ul>
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-success">Send Message</button>
    </form>
    </div>
</div>
@endsection
