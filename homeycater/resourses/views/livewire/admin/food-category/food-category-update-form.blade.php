<div>
    <!--begin::Form-->

     <form class="form" wire:submit.prevent='save({{ $category_id }})'>
         <div class="card-body">
             <div class="form-group">
                 <label>Name</label>
                 <input type="text" class="form-control form-control-solid" wire:model="name" placeholder="Name" />
                 @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
             </div>

             @if ($old_image)
                 <div class="form-group">
                     <label>Old Photo :</label>
                     <p>
                         <img src="{{ asset('storage/'.$old_image) }}" height="200px">
                     </p>
                 </div>
             @endif
             @if ($image)
                 <div class="form-group">
                     <label>Photo Preview:</label>
                     <p>
                         <img src="{{ $image->temporaryUrl() }}" height="200px">
                     </p>
                 </div>
             @endif
             <div class="form-group">
                 <label>Image</label>

                 <input type="file" wire:model="image" class="form-control form-control-solid" />
                 @error('image') <span class="text-danger error">{{ $message }}</span>@enderror
             </div>
             <div class="form-group">
                 <label for="">Description</label>
                 <textarea class="form-control form-control-solid" wire:model="description" placeholder="Please enter description - (optional)" rows="3"></textarea>
                 @error('description') <span class="text-danger error">{{ $message }}</span>@enderror
             </div>

             <div class="form-group">
                 <label for="">Tags</label>
                 <textarea class="form-control form-control-solid" wire:model="tags" placeholder="Please enter tags spearated by pipe(|) - (optional)" rows="3"></textarea>
                 @error('tags') <span class="text-danger error">{{ $message }}</span>@enderror
             </div>

             <div class="form-group">
                 <label for="">Keywords</label>
                 <textarea class="form-control form-control-solid" wire:model="keywords" placeholder="Please enter keywords spearated by comma(,) - (optional)" rows="3"></textarea>
                 @error('keywords') <span class="text-danger error">{{ $message }}</span>@enderror
             </div>

             <div class="form-group">
                <label for="">Position</label>
                <input type="number" class="form-control form-control-solid" wire:model="position" placeholder="Please set position" />
                @error('position') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
         </div>
         <div class="card-footer">
             <button type="submit" class="btn btn-primary mr-2">Submit</button>
             <button type="reset" class="btn btn-secondary">Cancel</button>
         </div>
     </form>
 <!--end::Form-->
 </div>
