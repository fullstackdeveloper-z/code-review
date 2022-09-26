<div>
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <!--begin::Form-->
     <form class="form" wire:submit.prevent='save()'>
         <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Name </label>
                        <input type="text" class="form-control form-control-solid" wire:model="name" placeholder="Name" />
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control form-control-solid" wire:model="email" placeholder="Email" />
                        @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control form-control-solid" wire:model="password" placeholder="Password" />
                        @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control form-control-solid" wire:model="gender">
                            {{-- <option ></option> --}}
                            <option value="male">male</option>
                            <option value="female">female</option>
                            <option value="other">other</option>
                        </select>
                        @error('gender') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Intro</label>
                        <textarea class="form-control form-control-solid" wire:model="intro" placeholder="Intro" ></textarea>
                        @error('intro') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Speciality</label>
                        <textarea class="form-control form-control-solid" wire:model="speciality" placeholder="Speciality" ></textarea>
                        @error('speciality') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control form-control-solid" wire:model="description" placeholder="Description" ></textarea>
                        @error('description') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Neighborhood</label>
                        <textarea class="form-control form-control-solid" wire:model="neighborhood" placeholder="Neighborhood" ></textarea>
                        @error('neighborhood') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Town</label>
                        <input type="text" class="form-control form-control-solid" wire:model="town" placeholder="Town" />
                        @error('town') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
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
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Covid Vaccinated</label>
                        <select class="form-control form-control-solid" wire:model="covid_vaccinated" placeholder="Covid Vaccinated" >
                            <option value="no">no</option>
                            <option value="yes">yes</option>
                        </select>
                        @error('covid_vaccinated') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Cleaniess</label>
                        <select class="form-control form-control-solid" wire:model="cleaniess" placeholder="Cleaniess" >
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                        @error('cleaniess') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Highen Care</label>
                        <div class="checkbox-inline">
                            <label class="checkbox" for="head_cover">
                                <input type="checkbox" wire:model="highen_care"  value="head_cover" id="head_cover"/>
                                <span></span>
                                Head Cover
                            </label>
                            <label class="checkbox" for="gloves">
                                <input type="checkbox" wire:model="highen_care" value="gloves" id="gloves" />
                                <span></span>
                                Gloves
                            </label>
                            <label class="checkbox" for="mask">
                                <input type="checkbox" wire:model="highen_care" value="mask" id="mask"/>
                                <span></span>
                                Mask
                            </label>
                            <label class="checkbox" for="apran">
                                <input type="checkbox" wire:model="highen_care" value="apran" id="apran" />
                                <span></span>
                                 Apran
                            </label>
                        </div>
                        @error('highen_care') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Notice</label>
                        <select class="form-control form-control-solid" wire:model="notice" placeholder="Home Delivery" >
                            <option ></option>
                            <option value="4 hours">4 Hours</option>
                            <option value="12 hours">12 Hours</option>
                            <option value="1 day">1 day</option>
                            <option value="2 day">2 day</option>
                            <option value="3 day">3 day</option>
                            <option value="1 week">1 Week</option>
                        </select>
                        @error('notice') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="number" class="form-control form-control-solid" wire:model="phone" placeholder="Contact Number" />
                        @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Is Home Delivery</label>
                        <select class="form-control form-control-solid" wire:model="home_delivery" placeholder="Home Delivery" >
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                        @error('home_delivery') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
              

            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Minimun Order Catering</label>
                        <input type="number" class="form-control form-control-solid" wire:model="min_order_catering" placeholder="Minimum Order Catering" />   
                        @error('min_order_catering') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Large Order Catering</label>
                        <input type="number" class="form-control form-control-solid" wire:model="large_order_catering" placeholder="Large Order Catering" />   
                        @error('large_order_catering') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

            </div>
             @if ($personal_pic)
                 <div class="form-group">
                     <label>Photo Preview:</label>
                     <p>
                         <img src="{{ $personal_pic->temporaryUrl() }}" height="200px">
                     </p>
                 </div>
             @endif
             <div class="form-group">
                 <label>Image</label>

                 <input type="file" wire:model="personal_pic" class="form-control form-control-solid" />
                 @error('personal_pic') <span class="text-danger error">{{ $message }}</span>@enderror
             </div>

         </div>
         <div class="card-footer">
             <button type="submit" class="btn btn-primary mr-2">Submit</button>
             <button type="reset" class="btn btn-secondary">Cancel</button>
         </div>
     </form>
 <!--end::Form-->
 </div>
