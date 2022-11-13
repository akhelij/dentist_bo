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
        'descriptions',
        'total_amount',
        'tenant_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $hidden = ['tenant_id'];

    protected $with = ['history', 'patient'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function payments()
    {
       return $this->hasMany(Payment::class)->orderby('id','desc');
    }

    public function history()
    {
       return $this->hasMany(InterventionHistory::class)->orderby('id','desc');
    }
}
