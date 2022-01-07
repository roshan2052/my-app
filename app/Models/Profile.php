<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = ['user_id', 'full_name', 'address', 'mobile', 'email', 'dob', 'image', 'facebook_url', 'instagram_url', 'linkedin_url', 'github_url', 'short_bio'];

    public function getFullNameAttribute($value)
    {
       return ucwords(strtolower($value));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
