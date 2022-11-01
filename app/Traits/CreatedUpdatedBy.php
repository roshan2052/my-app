<?php

namespace App\Traits;

trait CreatedUpdatedBy
{
    public static function bootCreatedUpdatedBy()
    {
        static::saving(function ($model){
            $model->exists ? $model->updated_by = auth()->id() : $model->created_by = auth()->id();
        });
    }
}
