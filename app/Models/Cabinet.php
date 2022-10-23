<?php

namespace App\Models;

use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cabinet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'loation',
        'email',
        'website',
        'tanant_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
    
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new TenantScope);
        static::creating(function($model) {
            if(session()->has('tenant_id')) {
                $model->tenant_id = session('tenant_id');
                $model->created_by = auth()->user->id;
            }
        });        

        static::updating(function($model) {
            $model->updated_by = auth()->user->id;
        });
        
        static::deleting(function($model) {
            $model->deleted_by = auth()->user->id;
        });
    }
}
