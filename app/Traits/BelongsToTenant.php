<?php

namespace App\Traits;

use App\Scopes\TenantScope;
use App\Models\Tenant;

trait BelongsToTenant
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function bootBelongsToTenant()
    {
        static::addGlobalScope(new TenantScope);
        static::creating(function($model) {
            $model->tenant_id  = session('tenant_id');
        });
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}