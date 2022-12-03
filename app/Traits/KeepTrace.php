<?php

namespace App\Traits;

trait KeepTrace
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function bootKeepTrace()
    {
        static::creating(function($model) {
            $model->created_by = auth()->user()?->id;
        });

        static::updating(function($model) {
            $model->updated_by = auth()->user()?->id;
        });

        static::deleting(function($model) {
            $model->deleted_by = auth()->user()?->id;
        });
    }
}
