@extends('front.website-layout')
@section('css')
<style>
    .figure img{
        height: 150px !important;
        width: auto
    }
</style>
@endsection


{{-- @section('breadcrumb')
    <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="#">
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
@endsection --}}

@section('content')
<section>

    <div class="card card-body account-right">
        <div class="widget">
            <div class="section-header">
                <h5 class="heading-design-h5">
                    Profile
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
                <livewire:admin.cater.cater-dish-data-table :user-id="$user->id" :front="true">
                <livewire:admin.cater.cater-gallery-datatable :user-id="$user->id" :front="true">
                <livewire:admin.cater.cater-video-datatable :user-id="$user->id" :front="true">
            </div>

        </div>
    </div>

</section>
@endsection

@section('js')

@endsection
