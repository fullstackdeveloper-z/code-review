<div>
    <!--begin::Form-->
     <form class="form" wire:submit.prevent='save()'>
        <div class="card-body">


            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Show Ads in Side</label>
                        <input type="number" min="1" class="form-control form-control-solid" wire:model="sidebar_ads" placeholder="Show Ads in Side" />
                        @error('sidebar_ads') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
     </form>
 <!--end::Form-->
 </div>
