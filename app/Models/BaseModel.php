<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class,'updated_by');
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value == 'publish'? 1: 0;
    }

    public function getStatusAttribute($value)
    {
        return $value == 1? 'publish' : 'un-publish';
    }

    public function scopeActive($query) {
        return $query->where('status', 1);
    }

    // public static function boot(){
    //     parent::boot();

    //     static::saving(function ($model){
    //         $model->exists ? $model->updated_by = auth()->id() : $model->created_by = auth()->id();
    //     });
    // }

}
