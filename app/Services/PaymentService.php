<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PaymentService
{
    /**
     * @return Collection<int, Payment>
     */
    public function all(): Collection
    {
        return $this->query()
            ->with('tenant')
            ->get();
    }

    public function commit(Payment $payment): Payment
    {
        return tap($payment)->save();
    }

    /**
     * @param int $tenantId
     * @return int
     */
    public function forTenantIdSum(int $tenantId): int
    {
        return $this->query()
            ->selectRaw('SUM(amount) as sum')
            ->where('tenant_id', $tenantId)
            ->groupBy('tenant_id')
            ->first()
            ->sum;
    }

    /**
     * @return Builder<Payment>
     */
    private function query(): Builder
    {
        return Payment::query();
    }

}
