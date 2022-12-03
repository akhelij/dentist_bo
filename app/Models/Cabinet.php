<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use App\Traits\KeepTrace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cabinet extends Model
{
    use HasFactory, SoftDeletes;
    use BelongsToTenant, KeepTrace;

    protected $fillable = [
        'name',
        'phone',
        'location',
        'email',
        'website',
        'tenant_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
