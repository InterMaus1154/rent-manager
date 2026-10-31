<x-app :with-header="false">
    <div class="h-screen w-full flex justify-center items-center">
        <div class="flex flex-col gap-8 rounded-md p-8 bg-dialogs">
            <h1 class="text-text-body text-4xl font-bold text-center">Admin Login</h1>
            @if($errors->has('login_invalid'))
                <p class="text-red-600">{{$errors->get('login_invalid')[0]}}</p>
            @endif
            <form method="POST" action="{{route('auth.login')}}" class="flex flex-col gap-4 text-text-body">
                @csrf
                <div class="flex flex-col gap-2">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="border-text-secondary border rounded-sm p-1" placeholder="Username">
                    @if($errors->has('username'))
                        <p class="text-red-600">{{$errors->get('username')[0]}}</p>
                    @endif
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="border-text-secondary border rounded-sm p-1" placeholder="Password">
                    @if($errors->has('password'))
                        <p class="text-red-600">{{$errors->get('password')[0]}}</p>
                    @endif
                </div>
                <div class="flex flex-col gap-2">
                    <label for="secret">Secret</label>
                    <input type="password" id="secret" name="secret" class="border-text-secondary border rounded-sm p-1" placeholder="Secret">
                    @if($errors->has('secret'))
                        <p class="text-red-600">{{$errors->get('secret')[0]}}</p>
                    @endif
                </div>
                <button type="submit" class="bg-base p-2 rounded-md font-semibold cursor-pointer hover:bg-cards">Login</button>
            </form>
        </div>
    </div>
</x-app>
