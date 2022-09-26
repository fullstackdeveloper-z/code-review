<?php

namespace App\Http\Livewire\Admin\Ad;

use Livewire\Component;
use App\Models\Ad;
use App\Models\Photo;
use App\Models\Video;
use App\Rules\Videolength;
use Livewire\WithFileUploads;

class AdUpdateForm extends Component
{
    use WithFileUploads;
    public $ad_id, $first_name, $last_name, $company, $type_of_business, $publish_start_date,
    $publish_end_date, $duration, $address, $city, $state, $country, $phone, $email, $im_id,
    $comments, $url, $adable_type, $adable_id, $type,$published;

    public $ad_type="slider";

    public $media_type = 'image';

    public $width = 1920;
    public $height = 1024;

    public $ad_file;
    public $front=false;

    public $imageRule = [
            'ad_file' => 'required|mimes:jpg,bmp,png,svg,jpeg|max:2056|dimensions:width=300,height=300',
        ];
    public $adable_data;    
    
    public function mount(Ad $ad) {
        $this->ad_id =  $ad->id;
        $this->first_name = $ad->first_name;
        $this->last_name = $ad->last_name;
        $this->company = $ad->company;
        $this->type_of_business = $ad->type_of_business;
        $this->publish_start_date = $ad->publish_start_date;
        $this->publish_end_date = $ad->publish_end_date;
        $this->duration = $ad->duration;
        $this->address = $ad->address;
        $this->city = $ad->city;
        $this->state = $ad->state;
        $this->country = $ad->country;
        $this->phone = $ad->phone;
        $this->email = $ad->email;
        $this->im_id = $ad->im_id;
        $this->comments = $ad->comments;
        $this->url = $ad->url;
        $this->adable_type = $ad->adable_type;
        $this->adable_id = $ad->adable_id;
        $this->ad_type = $ad->type; 
        $this->media_type =  ($ad->adable_type =='App\Models\Photo') ? 'image': 'video';
        if($ad->adable_type == 'App\Models\Photo') {
            $this->adable_data = Photo::find($ad->adable_id);
         }else{
             $this->adable_data = Video::find($ad->adable_id);
        }
        $this->published = $ad->published; 
    }    


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
                    'ad_file' => ['exclude_if:ad_file,null', 'mimes:mp4', 'max:100056', new Videolength],
                 ], [
                    'ad_file.mimes' => 'Please choose the video with extension(.mp4)',
                    'ad_file.max' => 'Please choose video under size of 10 MB',
                ]);
        } else {
            $this->validate([
                'ad_file' => "exclude_if:ad_file,null|mimes:jpg,bmp,png,svg,jpeg|max:2056|dimensions:width=".$this->width.",height=".$this->height,
            ], [
                'ad_file.mimes' => 'Please choose the image with extension(.jpg,.bmp,.png,.svg,.jpeg)',
                'ad_file.max' => 'Please choose image under size of 2 MB',
                'ad_file.dimensions' => 'Please choose image dimensions '.$this->width.' * '.$this->height.' only'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.ad.ad-update-form');
    }


    public function save($id) {
      //  dd($this);
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
                    'ad_file' => ['exclude_if:ad_file,null|mimes:mp4', 'max:100056', new Videolength],
                 ], [
                    'ad_file.mimes' => 'Please choose the video with extension(.mp4)',
                    'ad_file.max' => 'Please choose video under size of 10 MB',
                ]);
        } else {
            $this->validate([
                'ad_file' => "exclude_if:ad_file,null|mimes:jpg,bmp,png,svg,jpeg|max:2056|dimensions:width=".$this->width.",height=".$this->height,
            ], [
                'ad_file.mimes' => 'Please choose the image with extension(.jpg,.bmp,.png,.svg,.jpeg)',
                'ad_file.max' => 'Please choose image under size of 2 MB',
                'ad_file.dimensions' => 'Please choose image dimensions '.$this->width.' * '.$this->height.' only'
            ]);
        }
        $adable_id = $this->adable_id;
        $adable_type = $this->adable_type;
        if($this->media_type == 'video') {
            $path = storage_path().'/app/public/';
          
            $video =  Video::find($this->adable_id);
            if($this->ad_file !=null){
                if(!empty($video) && $video->video !=null){
                    $file_old = $path.$video->video;
                    if(file_exists($file_old)){
                     unlink($file_old);
                   }
                   $video->video = $this->ad_file->store('ad','public');  
                }else{
                   $video = new Video();
                   $video->video = $this->ad_file->store('ad','public'); 
                }
                $video->save();
                $adable_id = $video->id;
            }
            $adable_type = 'App\Models\Video';
        } else {
            $photo =  Photo::find($this->adable_id);
            $path = storage_path().'/app/public/';
            if($this->ad_file !=null){
                if($photo->image !=null){
                    $file_old = $path.$photo->image;
                    if(file_exists($file_old)){
                     unlink($file_old);
                   }
                   $photo->image = $this->ad_file->store('ad','public');  
                }else{
                   $photo->image = $this->ad_file->store('ad','public'); 
                }
                $photo->save();
                $adable_id = $photo->id;
            }
           
           // $photo->image = $this->ad_file->store('ads', 'public');
        
            $adable_type = 'App\Models\Photo';
        }

        $ad =  Ad::find($id);
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
            session()->flash('success', 'Ad updated successfully.');
        } else {
            session()->flash('error', 'Ad not updated successfully.');
        }


        if($this->front){
            return redirect()->route('web.advertise.with.us');
        }else{
            return redirect()->route('admin.ads.lists');
        }
    }
}
