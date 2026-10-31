<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;
use App\Services\PaymentService;
use App\Services\TenantService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct(private TenantService $tenants, private PaymentService $payments)
    {
    }

    public function create(): View
    {
        $tenants = $this->tenants->all();
        return view('payments.create', compact('tenants'));
    }

    public function store(StorePaymentRequest $request): RedirectResponse
    {
        $payment = Payment::make(
            tenantId: $request->input('tenant_id'),
            amount: $request->input('amount') * 100,
            paidAt: $request->date('paid_at'));

        $this->payments->commit($payment);

        return to_route('dashboard.index');
    }
}
