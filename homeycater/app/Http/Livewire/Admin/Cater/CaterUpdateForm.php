<?php

namespace App\Http\Livewire\Admin\Cater;

use App\Models\User;
use App\Models\Cater;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class CaterUpdateForm extends Component
{   

    use WithFileUploads;
    public $front = false;
    public $user_id, $cater_id, $email, $name, $password, $intro, $gender="male", $neighborhood, $town, $city, $how_many_times_hire=0,
     $notice, $speciality, $covid_vaccinated = 'no', $cleaniess=1 ,$home_delivery='no', $large_order_catering,$min_order_catering,$phone;
    public $personal_pic, $description,$old_personal_pic,$state,$country;
    public $highen_care  = [];
    
    public function mount($user) {
         
         $this->user_id                =  $user->id;
         $this->cater_id               =  $user->cater->id;
         $this->email                  =  $user->email;
         $this->name                   =  $user->name;
         $this->intro                  =  $user->cater->intro;
      
         $this->description            =  $user->cater->description;
         $this->gender                 =  $user->cater->gender;
         $this->neighborhood           =  $user->cater->neighborhood;
         $this->town                   =  $user->cater->town;
         $this->city                   =  $user->cater->city;
         $this->how_many_times_hire    =  $user->cater->how_many_times_hire;
         $this->notice                 =  $user->cater->notice;
         $this->speciality             =  $user->cater->speciality;
         $this->home_delivery          =  $user->cater->home_delivery;
         $this->large_order_catering   =  $user->cater->large_order_catering;
         $this->min_order_catering     =  $user->cater->min_order_catering;
         $this->phone                  =  $user->cater->phone;
         $this->state                  =  $user->cater->state;
         $this->country                =  $user->cater->country;
         $this->covid_vaccinated       =  $user->covidDetails->covid_vaccinated;
         $this->cleaniess              =  $user->covidDetails->cleaniess;
         $this->highen_care            =  json_decode($user->covidDetails->highen_care);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
         $this->old_personal_pic       =  $user->cater->personal_pic;
       
     }    
     

    public function render()
    {
        return view('livewire.admin.cater.cater-update-form');
    }

    public function save($id) {
        // dd("hello");

        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$this->user_id ,
            'password' => 'exclude_if:password,null|min:8|max:20',
            'gender' => 'required',
            'intro' => 'required',
            'neighborhood' => 'required',
            'town' => 'required',
            'city' => 'required',
            'notice' => 'required',
            'speciality' => 'required',
            'description' => 'required',
            'personal_pic' => 'exclude_if:personal_pic,null|mimes:png,jpeg,jpg,svg',
            'large_order_catering'=>'required',
            'min_order_catering'=>'required',
            'phone' =>'required|digits:10'
        ], [
            'name.required' => 'please enter name',
            'email.required' => 'please enter email',
            'email.unique' => 'please enter unique email',
            'password.required' => 'please enter password',
            'password.min' => 'please enter min 8 characters password',
            'password.max' => 'please enter max 20 characters password',
            'gender.required' => 'please enter gender',
            'intro.required' => 'please enter intro',
            'neighborhood.required' => 'please enter neighborhood',
            'town.required' => 'please enter town',
            'city.required' => 'please enter city',
            'notice.required' => 'please enter notice',
            'speciality.required' => 'please enter speciality',
            'description.required' => 'please enter description',
            'personal_pic.required' => 'please enter personal picture',
            'personal_pic.mimes' => 'please enter mimes type png,jpeg,jpg,svg',
            'large_order_catering.required' => 'please enter maximum number of catering',
            'min_order_catering.required' => 'please enter minimum number of catering',
            'phone.required' => 'please enter contact number',
            'phone.digits' => 'Contact number should be 10 digits',
        ]);


            // dd("vishal");
         //dd($this);
        $user = User::find($id);

        $user->name = $this->name;
        $user->email = $this->email;
        $user->user_type = 'cater';
        if($this->password !=null){
            $user->password = Hash::make($this->password);
        }
      
        $user->user_type = 'cater';
        $res = $user->save();
        
        $image = $this->old_personal_pic;
    
        $path = storage_path().'/app/public/';
        if($this->personal_pic !=null){
            if($user->cater->personal_pic !=null){
                $file_old = $path.$user->cater->personal_pic;
                if(file_exists($file_old)){
                    unlink($file_old);
                }
                $image = $this->personal_pic->store('caters', 'public');
            }else{
                $image = $this->personal_pic->store('caters', 'public');
            }
            
            
        }
           
           // $photo->image = $this->ad_file->store('ads', 'public');
        
            $adable_type = 'App\Models\Photo';
      
        $user->covidDetails()->update([
            'covid_vaccinated' => $this->covid_vaccinated,
            'cleaniess' => $this->cleaniess,
            'highen_care' => json_encode($this->highen_care),
        ]);

        $user->cater()->update([
            'intro' => $this->intro,
            'gender' => $this->gender,
            'neighborhood' => $this->neighborhood,
            'town' => $this->town,
            'city' => $this->city,
            'notice' => $this->notice,
            'speciality' => $this->speciality,
            'description' => $this->description,
            'personal_pic' => $image,
            'home_delivery' => $this->home_delivery,
            'large_order_catering' => $this->large_order_catering,
            'min_order_catering' => $this->min_order_catering,
            'phone' => $this->phone,
            'state' =>  $this->state,
            'country' =>  $this->country,
        ]);

        if($this->front) {
            if($res) {
                session()->flash('success', 'you are registered with us successfully.');
            } else {
                session()->flash('error', 'you are not registered with us. please try again.');
            }
            return redirect()->route('web.register');
        } else {

            if($res) {
                session()->flash('success', 'cater updated successfully.');
            } else {
                session()->flash('error', 'cater not updated successfully.');
            }
            return redirect()->route('admin.caters.lists');
        }

    }


}
