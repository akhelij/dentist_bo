<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use App\Traits\KeepTrace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intervention extends Model
{
    use HasFactory, SoftDeletes;    
    use BelongsToTenant, KeepTrace;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>'
     * 
     */
    protected $fillable = [
        'patient_id',
        'dents',
        'descriptions',
        'total_amount',
        'tenant_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
