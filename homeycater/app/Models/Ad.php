<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'company', 'type_of_business', 'publish_start_date',
        'publish_end_date', 'duration', 'address', 'city', 'state', 'country', 'phone',
        'email', 'im_id', 'comments', 'url', 'adable_type', 'adable_id', 'type'
    ];

    public function adable()
    {
        return $this->morphTo();
    }

    public function video(){
      return $this->hasOne(Video::class,'id','adable_id');
    }

    public function image(){
        return $this->hasOne(Photo::class,'id','adable_id');
    }
}
