<div>
    <!--begin::Form-->
     <form class="form" wire:submit.prevent='save({{ $ad_id }})'>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control form-control-solid" wire:model="first_name" placeholder="First Name" />
                        @error('first_name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control form-control-solid" wire:model="last_name" placeholder="Last Name" />
                        @error('last_name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control form-control-solid" wire:model="email" placeholder="Email" />
                        @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control form-control-solid" wire:model="phone" placeholder="Phone" />
                        @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" class="form-control form-control-solid" wire:model="company" placeholder="Company" />
                        @error('company') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Type of Business</label>
                        <input type="text" class="form-control form-control-solid" wire:model="type_of_business" placeholder="Type of Business" />
                        @error('type_of_business') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>IM ID</label>
                        <input type="text" class="form-control form-control-solid" wire:model="im_id" placeholder="IM ID" />
                        @error('im_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Comments</label>
                        <textarea class="form-control form-control-solid" wire:model="comments" placeholder="Comments" ></textarea>
                        @error('comments') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>


            <hr>
            <div class="row mt-4">
                <div class="col-sm-12">
                    <h6>Address</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control form-control-solid" wire:model="address" placeholder="Address" ></textarea>
                        @error('address') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control form-control-solid" wire:model="city" placeholder="City" />
                        @error('city') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control form-control-solid" wire:model="state" placeholder="State" />
                        @error('state') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control form-control-solid" wire:model="country" placeholder="Country" />
                        @error('country') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>


            <hr>
            <div class="row mt-4">
                <div class="col-sm-12">
                    <h6>Ad Details</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Publish From</label>
                        <input type="date" class="form-control form-control-solid" wire:model="publish_start_date" placeholder="Publish From Date" />
                        @error('publish_start_date') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Publish To</label>
                        <input type="date" class="form-control form-control-solid" wire:model="publish_end_date" placeholder="Publish To Date" />
                        @error('publish_end_date') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ad Type</label>
                        <select class="form-control form-control-solid" wire:model="ad_type" placeholder="Ad Type" >
                            <option value="slider" >Slider</option>
                            <option value="top">Top</option>
                            <option value="side" >Side</option>
                        </select>
                        @error('ad_type') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Target Url</label>
                        <input type="url" class="form-control form-control-solid" wire:model="url" placeholder="http://xyz.com" />
                        @error('url') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Media Type</label>
                        <select class="form-control form-control-solid" wire:model="media_type" placeholder="Media Type" >
                            <option value="image" >Image</option>
                            <option value="video" >Video</option>
                        </select>
                        @error('media_type') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Duration</label>
                        <input type="number" class="form-control form-control-solid" wire:model="duration" placeholder="Duration" />
                        @error('duration') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Publish/Draft</label>
                        <select class="form-control form-control-solid" wire:model="published" placeholder="Media Type" >
                            <option value="1" >Publish</option>
                            <option value="0" >Draft</option>
                        </select>
                        @error('media_type') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
               
            </div>
        
            @if ($adable_data)
                @if($adable_type == 'App\Models\Video')
                    <div class="form-group">
                        <label>Old Video:</label>
                        <p>
                            <video height="200px" controls>
                                <source src="{{ asset('storage/'.$adable_data->video) }}" type="video/mp4">
                                Your browser does not support the html video tag.
                            </video>
                        </p>
                    </div>
                @else
                    <div class="form-group">
                        <label>Old Image:</label>
                        <p>
                            <img src="{{ asset('storage/'.$adable_data->image) }}" height="200px">
                        </p>
                    </div>
                @endif
            @endif


            @if ($ad_file)
                @if($media_type == 'video')
                    <div class="form-group">
                        <label>Preview:</label>
                        <p>
                            <video height="200px" controls>
                                <source src="{{ $ad_file->temporaryUrl() }}" type="video/mp4">
                                Your browser does not support the html video tag.
                            </video>
                        </p>
                    </div>
                @else
                    <div class="form-group">
                        <label>Preview:</label>
                        <p>
                            <img src="{{ $ad_file->temporaryUrl() }}" height="200px">
                        </p>
                    </div>
                @endif
            @endif
            <div class="form-group">
                <label>File</label>
                <input type="file" wire:model="ad_file" class="form-control form-control-solid" accept="video/*|image/*" />
                @error('ad_file') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
     </form>
 <!--end::Form-->
 </div>
