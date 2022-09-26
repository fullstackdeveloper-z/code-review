@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <livewire:admin.includes.sub-header :text="'Caters - View'" />
        <!--end::Subheader-->
        <!--begin::Entry-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <!--begin::Details-->
                        <div class="d-flex mb-9">
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between flex-wrap mt-1">
                                    <div class="d-flex mr-3">
                                        <span class="text-dark-75  font-size-h5 font-weight-bold mr-3">Contact Detail</span>
                                        <span><i class="flaticon2-email text-success font-size-h5"></i><span></span>
                                    </div>
                                </div>
                                <!--end::Title-->
                                <div class="d-flex flex-wrap justify-content-between mt-1">
                                    <div class="d-flex flex-column flex-grow-1 pr-8">
                                        <span class="font-weight-bold text-dark-50">Name : {{ $contact->name }}</span>
                                        <span class="font-weight-bold text-dark-50">Email : {{ $contact->email }}</span>
                                        <span class="font-weight-bold text-dark-50">Phone : {{ $contact->phone }}</span>
                                        <span class="font-weight-bold text-dark-50">Message : {{ $contact->message }}</span>
                                        <span class="font-weight-bold text-dark-50">Created at : {{  $contact->created_at ? $contact->created_at->format('d-m-Y H:i:s'): '' }}</span>
                                    </div>
                                    
                                </div>
                         
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details-->
                    </div>
                </div>
                <!--end::Card-->           
            </div>
            <!--end::Container-->
        </div>
    </div>
    <!--end::Content-->
@endsection


