<x-app>
    <h1 class="text-text-body text-4xl font-bold">Add Payment</h1>
    <form method="POST" action="{{route('payments.store')}}" class="inline-flex flex-col gap-4 text-text-body bg-dialogs p-8 rounded-md my-4">
        @csrf
        <div class="flex flex-col gap-2">
            <label for="tenant_id">Tenant</label>
            <select id="tenant_id" name="tenant_id" class="border border-text-secondary rounded-sm p-1">
                <option selected>-- Select a tenant --</option>
                @foreach($tenants as $tenant)
                    <option value="{{$tenant->getId()}}">{{$tenant->getName()}}</option>
                @endforeach
            </select>
            @if($errors->has('tenant_id'))
                <p class="text-red-600">{{$errors->get('tenant_id')[0]}}</p>
            @endif
        </div>
        <div class="flex flex-col gap-2">
            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount" class="border-text-secondary border rounded-sm p-1" placeholder="Amount" step="any">
            @if($errors->has('amount'))
                <p class="text-red-600">{{$errors->get('amount')[0]}}</p>
            @endif
        </div>
        <div class="flex flex-col gap-2">
            <label for="paid_at">Paid At</label>
            <input type="date" id="paid_at" name="paid_at" class="border-text-secondary border rounded-sm p-1">
            @if($errors->has('paid_at'))
                <p class="text-red-600">{{$errors->get('paid_at')[0]}}</p>
            @endif
        </div>
        <button type="submit" class="bg-base p-2 rounded-md font-semibold cursor-pointer hover:bg-cards">Create</button>
    </form>
</x-app>
