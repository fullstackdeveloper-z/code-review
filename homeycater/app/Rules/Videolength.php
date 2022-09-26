<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Owenoj\LaravelGetId3\GetId3;

class Videolength implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /** video duration validation  'video_length:30' */
        if($value != null){
            if(!empty($value->getClientOriginalExtension()) && ($value->getClientOriginalExtension() == 'mp4')){

                $track = GetId3::fromDiskAndPath($value->disk, "livewire-tmp/".$value->getFilename());
    
                $duration = $track->getPlaytimeSeconds();
                    return (round($duration) <= 30) ? true : false;
            }else{
                return false;
            }
        }else{
            return true;
        }
       
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'please select video under 30 seconds.';
    }
}
