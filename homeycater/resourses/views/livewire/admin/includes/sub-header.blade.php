<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ $text }}</h5>
            <!--end::Page Title-->
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Actions-->
            @if(!empty($addButton))
                <a class="btn btn-success ml-auto" href="{{ $addButton }}">
                    <i class="fas fa-plus mr-1"></i> {{ __('New') }}
                </a>
            @endif

        </div>
        <!--end::Toolbar-->
    </div>
</div>
