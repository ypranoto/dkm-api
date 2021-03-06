<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
