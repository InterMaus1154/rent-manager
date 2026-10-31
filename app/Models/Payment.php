<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $table = 'payments';

    protected $casts = [
        'paid_at' => 'date',
    ];

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getAmount(): int
    {
        return $this->getAttribute('amount');
    }

    public function getAmountFormatted(): string
    {
        return number_format($this->getAmount()/100, 2);
    }

    public function getPaidAt(): Carbon
    {
        return $this->getAttribute('paid_at');
    }

    public function setTenantId(int $id): void
    {
        $this->setAttribute('tenant_id', $id);
    }

    public function setAmount(int $amount): void
    {
        $this->setAttribute('amount', $amount);
    }

    public function setPaidAt(Carbon $value): void
    {
        $this->setAttribute('paid_at', $value);
    }

    public static function make(int $tenantId, int $amount, Carbon $paidAt): Payment
    {
        $payment = new Payment();
        $payment->setTenantId($tenantId);
        $payment->setAmount($amount);
        $payment->setPaidAt($paidAt);
        return $payment;
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
