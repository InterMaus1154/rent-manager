@props(['withHeader' => true])
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rent Management</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-base">
@if($withHeader)
    <header class="flex items-center justify-between gap-4 p-4 bg-menus">
        <h1 class="text-text-body text-4xl">Rent Management</h1>
        <nav class="text-text-body text-xl flex items-center gap-4">
            <a class="hover:text-text-secondary transition-colors" href="{{route('dashboard.index')}}">Home</a>
            @guest
                <a class="hover:text-text-secondary transition-colors" href="{{route('auth.login.view')}}">Admin</a>
            @endguest
            @auth
                <form method="POST" action="{{route('auth.logout')}}">
                    @csrf
                    <button class="cursor-pointer hover:text-text-secondary transition-colors">Logout</button>
                </form>
            @endauth
        </nav>
    </header>
@endif

<main>
    {{$slot}}
</main>
</body>
</html>
