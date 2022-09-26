@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <livewire:admin.includes.sub-header :text="'Food Dish - Update Dish'" />
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Dashboard-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">Update Dish</h3>
                    </div>
                    <!--begin::Form-->
                    <livewire:admin.food-dish.food-dish-update-form :foodDish="$foodDish"/>
                    {{-- <form class="form">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control form-control-solid" wire:model="name" placeholder="Name" />
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control form-control-solid" />
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea class="form-control form-control-solid" wire:model="description" placeholder="Please enter description - (optional)" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Tags</label>
                                <textarea class="form-control form-control-solid" wire:model="tags" placeholder="Please enter tags spearated by pipe(|) - (optional)" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Keywords</label>
                                <textarea class="form-control form-control-solid" wire:model="keywords" placeholder="Please enter keywords spearated by comma(,) - (optional)" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form> --}}
                    <!--end::Form-->
                </div>
                <!--end::Card-->

            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
@endsection
