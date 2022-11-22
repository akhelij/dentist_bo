<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use App\Traits\KeepTrace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    use BelongsToTenant, KeepTrace;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'patient_id',
        'date',
        'tenant_id',
        'created_by',
        'updated_by'
    ];
}
