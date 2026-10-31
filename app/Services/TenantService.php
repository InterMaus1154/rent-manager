<?php

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TenantService
{

    /**
     * @return Collection<int, Tenant>
     */
    public function all(): Collection
    {
        return $this->query()->select(['id', 'name'])->get();
    }

    public function commit(Tenant $tenant): Tenant
    {
        return tap($tenant)->save();
    }

    /**
     * @return Builder<Tenant>
     */
    private function query(): Builder
    {
        return Tenant::query();
    }
}
