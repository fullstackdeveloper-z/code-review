<?php

namespace App\Http\Livewire\Admin\Ad;

use App\Models\Ad;
use App\Models\Photo;
use App\Models\Video;
use App\Rules\Videolength;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Owenoj\LaravelGetId3\GetId3;

class AdCreateForm extends Component
{

    use WithFileUploads;
    //first_name
    public $first_name, $last_name, $company, $type_of_business, $publish_start_date,
    $publish_end_date, $duration, $address, $city, $state, $country, $phone, $email, $im_id,
    $comments, $url, $adable_type, $adable_id, $type,$published;

    public $ad_type="slider";

    public $media_type = 'image';

    public $width = 1920;
    public $height = 1024;
    public $front = false;

    public $ad_file;

    public $imageRule = [
            'ad_file' => 'required|mimes:jpg,bmp,png,svg,jpeg|max:2056|dimensions:width=300,height=300',
        ];

    public function updatedAdType() {
        if($this->ad_type == 'side') {
            $this->width = 300;
            $this->height = 300;
        } else if($this->ad_type == 'top') {
            $this->width = 400;
            $this->height = 200;
        } else {
            $this->width = 1920;
            $this->height = 1024;
        }
    }
    public function updatedAdFile() {
        if($this->ad_type == 'side') {
            $this->width = 300;
            $this->height = 300;
        } else if($this->ad_type == 'top') {
            $this->width = 400;
            $this->height = 200;
        } else {
            $this->width = 1920;
            $this->height = 1024;
        }
        if($this->media_type == 'video') {
            $this->validate([
                    'ad_file' => ['required', 'mimes:mp4', 'max:100056', new Videolength],
                 ], [
                    'ad_file.required' => 'Please choose video (required)',
                    'ad_file.mimes' => 'Please choose the video with extension(.mp4)',
                    'ad_file.max' => 'Please choose video under size of 10 MB',
                ]);
        } else {
            $this->validate([
                'ad_file' => "required|mimes:jpg,bmp,png,svg,jpeg|max:2056|dimensions:width=".$this->width.",height=".$this->height,
            ], [
                'ad_file.required' => 'Please choose image (required)',
                'ad_file.mimes' => 'Please choose the image with extension(.jpg,.bmp,.png,.svg,.jpeg)',
                'ad_file.max' => 'Please choose image under size of 2 MB',
                'ad_file.dimensions' => 'Please choose image dimensions '.$this->width.' * '.$this->height.' only'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.ad.ad-create-form');
    }

    public function save() {

        $this->validate([
                    'first_name' => ['required'],
                    'last_name' => ['required'],
                    'email' => ['required','email'],
                    'phone' => ['required','min:11','numeric'],
                    'company' => ['required'],
                    'type_of_business' => ['required'],
                    'im_id' => ['required'],
                    'address' => ['required'],
                    'city' => ['required'],
                    'state' => ['required'],
                    'country' => ['required'],
                    'publish_start_date' => ['required'],
                    'publish_end_date' => ['required'],
                    'url' => ['required','url'],
        ]);
        if($this->media_type == 'video') {
            $this->validate([
                    'ad_file' => ['required', 'mimes:mp4', 'max:100056', new Videolength],
                 ], [
                    'ad_file.required' => 'Please choose video (required)',
                    'ad_file.mimes' => 'Please choose the video with extension(.mp4)',
                    'ad_file.max' => 'Please choose video under size of 10 MB',
                ]);
        } else {
            $this->validate([
                'ad_file' => "required|mimes:jpg,bmp,png,svg,jpeg|max:2056|dimensions:width=".$this->width.",height=".$this->height,
            ], [
                'ad_file.required' => 'Please choose image (required)',
                'ad_file.mimes' => 'Please choose the image with extension(.jpg,.bmp,.png,.svg,.jpeg)',
                'ad_file.max' => 'Please choose image under size of 2 MB',
                'ad_file.dimensions' => 'Please choose image dimensions '.$this->width.' * '.$this->height.' only'
            ]);
        }
        $adable_id = null;
        $adable_type = 'App\Models';
        if($this->media_type == 'video') {
            $photo = new Video();
            $photo->video = $this->ad_file->store('ad', 'public');
            $photo->save();

            $adable_id = $photo->id;
            $adable_type = 'App\Models\Video';
        } else {
            $photo = new Photo();
            $photo->image = $this->ad_file->store('ad', 'public');
            $photo->save();

            $adable_id = $photo->id;
            $adable_type = 'App\Models\Photo';
        }

        $ad = new Ad();
        $ad->first_name = $this->first_name;
        $ad->last_name = $this->last_name;
        $ad->company = $this->company;
        $ad->type_of_business = $this->type_of_business;
        $ad->publish_start_date = $this->publish_start_date;
        $ad->publish_end_date = $this->publish_end_date;
        $ad->duration = $this->duration;
        $ad->address = $this->address;
        $ad->city = $this->city;
        $ad->state = $this->state;
        $ad->country = $this->country;
        $ad->phone = $this->phone;
        $ad->email = $this->email;
        $ad->im_id = $this->im_id;
        $ad->comments = $this->comments;
        $ad->url = $this->url;
        $ad->type = $this->ad_type;

        $ad->adable_id = $adable_id;
        $ad->adable_type = $adable_type;
        $ad->published = $this->published;


        if ($ad->save()) {
            session()->flash('success', 'ad created successfully.');
        } else {
            session()->flash('error', 'ad not created successfully.');
        }

        if($this->front){
            return redirect()->route('web.advertise.with.us');
        }else{
            return redirect()->route('admin.ads.lists');
        }
    }
}
