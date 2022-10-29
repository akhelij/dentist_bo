<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use App\Traits\KeepTrace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;    
    use BelongsToTenant, KeepTrace;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'intervention_id',
        'amount',
        'tenant_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
