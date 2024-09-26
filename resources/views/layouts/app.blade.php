<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Site Title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="">

    <div class="flex h-screen relative">

        <div class="w-64 sticky">
            <x-sidebar/>
        </div>

        <div class="flex flex-col flex-grow">

            <main class="flex-grow ">
                <div class="container mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
@livewireScripts
<script src="{{ asset('js/app.js') }}"></script>

</html>
