<?php

namespace App\Http\Livewire\Admin\Cater;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class CaterAddForm extends Component
{
    use WithFileUploads;
    public $front = false;
    public $email, $name, $password, $intro, $gender="male", $neighborhood, $town, $city, $how_many_times_hire=0,
     $notice, $speciality, $covid_vaccinated = 'no', $cleaniess=1,$home_delivery='no', $large_order_catering,$min_order_catering,$phone;
    public $personal_pic, $description,$state,$country;
    public $highen_care  = [];
    public function render()
    {
        return view('livewire.admin.cater.cater-add-form');
    }

    public function save() {
      // dd($this);
        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'gender' => 'required',
            'intro' => 'required',
            'neighborhood' => 'required',
            'town' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'notice' => 'required',
            'speciality' => 'required',
            'description' => 'required',
            'personal_pic' => 'required|mimes:png,jpeg,jpg,svg',
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
            'state.required' => 'please enter state',
            'country.required' => 'please enter country',
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
        $user = new User();

        $user->name = $this->name;
        $user->email = $this->email;
        $user->user_type = 'cater';
        $user->password = Hash::make($this->password);
        $user->user_type = 'cater';

        $image = $this->personal_pic->store('caters', 'public');
        $res = $user->save();

        $user->covidDetails()->create([
            'covid_vaccinated' => $this->covid_vaccinated,
            'cleaniess' => $this->cleaniess,
            'highen_care' => json_encode($this->highen_care),
        ]);

        $user->cater()->create([
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
            'state' => $this->state ,
            'country' => $this->country ,
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
                session()->flash('success', 'cater created successfully.');
            } else {
                session()->flash('error', 'cater not created successfully.');
            }
            return redirect()->route('admin.caters.lists');
        }

    }
}
