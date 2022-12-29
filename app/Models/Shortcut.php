<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class Shortcut extends Model
{
    use BelongsToTenant;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'shortcut_content',
        'type',
        'tenant_id'
    ];

    public $timestamps = false;
}
