<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use App\Traits\CascadesDeletes;
use App\Traits\KeepTrace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;
    use BelongsToTenant, KeepTrace;
    use CascadesDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'birthdate',
        'job',
        'address',
        'phone',
        'notes',
        'tenant_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $cascadeDeletes = ['interventions'];

    public function interventions()
    {
        return $this->hasMany(Intervention::class)->orderby('id','desc');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'model');
    }
}
