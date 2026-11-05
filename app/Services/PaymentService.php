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
            ->orderBy('paid_at', 'desc')
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
        $db = $this->query()
            ->selectRaw('SUM(amount) as sum')
            ->where('tenant_id', $tenantId)
            ->groupBy('tenant_id')
            ->first();

        return is_null($db) ? 0 : $db->sum;
    }

    /**
     * @return Builder<Payment>
     */
    private function query(): Builder
    {
        return Payment::query();
    }

}
