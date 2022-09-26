<div>
    <!--begin::Form-->
    <form class="form"  wire:submit.prevent='save()'>
        <div class="card-body">

            <div class="form-group">
                <label>Category</label>
                <select class="form-control form-control-solid" wire:model="category_id" placeholder="Name" >
                    <option value="">Please select category</option>
                    @forelse ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @empty
                    @endforelse
                </select>
                @error('category_id') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control form-control-solid" wire:model="name" placeholder="Name" />
                @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Color</label>
                <input type="color" class="form-control form-control-solid" wire:model="color" />
                @error('color') <span class="text-danger error">{{ $message }}</span>@enderror
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
    </form>
    <!--end::Form-->
</div>
