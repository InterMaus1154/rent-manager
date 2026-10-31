<x-app>
    <h1 class="text-text-body text-4xl font-bold">Tenants</h1>
    <form method="POST" action="{{route('tenants.store')}}" class="inline-flex flex-col gap-4 text-text-body bg-dialogs p-8 rounded-md my-4">
        @csrf
        <div class="flex flex-col gap-2">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="border-text-secondary border rounded-sm p-1" placeholder="Name">
            @if($errors->has('name'))
                <p class="text-red-600">{{$errors->get('name')[0]}}</p>
            @endif
        </div>
        <button type="submit" class="bg-base p-2 rounded-md font-semibold cursor-pointer hover:bg-cards">Create</button>
    </form>
    <div class="my-2">
        <table class="w-full text-left border-collapse rounded-md overflow-hidden">
            <thead class="bg-menus text-text-body">
            <tr>
                <th class="p-3 font-semibold">Id</th>
                <th class="p-3 font-semibold">Name</th>
            </tr>
            </thead>
            <tbody class="text-text-body">
            @foreach($tenants as $tenant)
                <tr class="even:bg-dialogs">
                    <td class="p-3">{{$tenant->getId()}}</td>
                    <td class="p-3">{{$tenant->getName()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const input = document.querySelector("input[name='name']");
            input.focus();
        });
    </script>
</x-app>
