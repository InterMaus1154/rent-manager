<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private PaymentService $payments, private TenantService $tenants)
    {
    }

    public function index(): View
    {
        $payments = $this->payments->all();
        $tenants = $this->tenants->all();

        $numTenants = $tenants->count();

        $perTenantAmount = round(config('rent.total_rent') / $numTenants, 2);

        $tenantSums = [];
        foreach ($tenants as $tenant) {
            $paid = round(($this->payments->forTenantIdSum($tenant->getId()) / 100), 2);
            $percentage = round(($paid / $perTenantAmount) * 100, 2);
            $tenantSums[$tenant->getName()] = [
                'paid' => $paid,
                'percentage' => $percentage
            ];
        }

        return view('dashboard.index', compact('payments', 'tenants', 'perTenantAmount', 'tenantSums'));
    }
}
