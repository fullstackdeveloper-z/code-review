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
                    <a href="javascript:void(0)">Cater Login</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
<section>

    <div class="card card-body account-right">
        <div class="widget">
            <div class="section-header">
                <h5 class="heading-design-h5">
                    Cater Login
                </h5>
            </div>
            <div>

                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ Session::get('error') }}.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form class="form" method="post" action="{{ route('web.login.post') }}">
                    @csrf
                    <div class="card-body">
                       <div class="row">
                           <div class="col-sm-8 offset-sm-2">
                               <div class="form-group">
                                   <label>Email</label>
                                   <input type="email" class="form-control form-control-solid" name="email" placeholder="Email" />
                                   @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                               </div>
                           </div>
                       </div>

                       <div class="row">
                           <div class="col-sm-8 offset-sm-2">
                               <div class="form-group">
                                   <label>Password</label>
                                   <input type="password" class="form-control form-control-solid" name="password" placeholder="Password" />
                                   @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                               </div>
                           </div>
                       </div>

                       <div class="row">
                            <div class="col-sm-8 offset-sm-2">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="d-flex justify-content-center links">
                                Don't have an account? <a href="{{ route('web.register') }}"  class="ml-2 text-danger">Register with us</a>
                            </div>
                            {{-- <div class="d-flex justify-content-center links">
                                <a class="text-danger" href="#">Forgot your password?</a>
                            </div> --}}
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>

</section>
@endsection

@section('js')

@endsection
