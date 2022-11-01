<?php

namespace App\Models;
use App\Traits\CreatedUpdatedBy;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends BaseModel
{
    use HasFactory,CreatedUpdatedBy;

    protected $fillable = ['title','key','status','created_by','updated_by'];

    public function scopeRegisteredWithinDays($query, $days) {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function testings(){
        return $this->hasMany(Testing::class);
    }

    public static function boot(){
        parent::boot();

        static::deleting(function ($model){
            $model->testings()->delete();
        });
    }

}
