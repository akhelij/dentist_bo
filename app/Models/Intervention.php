<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use App\Traits\KeepTrace;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $with = ['history', 'payments'];

    protected $appends = ['last_updated_at', 'paid'];

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function lastUpdatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->history?->first()?->updated_at,
        );
    }

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function paid(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->payments?->sum('amount'),
        );
    }

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
