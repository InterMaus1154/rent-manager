<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenantRequest;
use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TenantController extends Controller
{
    public function __construct(private TenantService $tenants)
    {
    }

    public function index(): View
    {
        $tenants = $this->tenants->all();
        return view('tenants.index', compact('tenants'));
    }

    public function store(StoreTenantRequest $request): RedirectResponse
    {
        $name = $request->input('name');

        $tenant = new Tenant();
        $tenant->setName($name);

        $this->tenants->commit($tenant);
        return redirect()->route('tenants.index');
    }
}
