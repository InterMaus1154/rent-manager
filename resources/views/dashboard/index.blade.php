<x-app>
    <div class="my-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($tenantSums as $name => $data)
            <div class="bg-cards border-menus border rounded-md p-4 flex flex-col gap-2 justify-center">
                <h2 class="text-center text-3xl text-text-body">{{$name}} {{$data['percentage']}}%</h2>
                <div class="flex gap-2 justify-center items-center text-text-secondary text-xl">
                    £{{$data['paid']}} / £{{$perTenantAmount}}
                </div>
            </div>
        @endforeach
    </div>
    <div class="my-2">
        <table class="w-full text-left border-collapse rounded-md overflow-hidden">
            <thead class="bg-menus text-text-body">
            <tr>
                <th class="p-3 font-semibold">Id</th>
                <th class="p-3 font-semibold">Name</th>
                <th class="p-3 font-semibold">Amount</th>
                <th class="p-3 font-semibold">Paid At</th>
            </tr>
            </thead>
            <tbody class="text-text-body">
            @foreach($payments as $payment)
                <tr class="even:bg-dialogs">
                    <td class="p-3">{{$payment->getId()}}</td>
                    <td class="p-3">{{$payment->tenant->getName()}}</td>
                    <td class="p-3">£{{$payment->getAmountFormatted()}}</td>
                    <td class="p-3">{{$payment->getPaidAt()->format('d F Y')}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app>
