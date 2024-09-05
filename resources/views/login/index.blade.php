<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Site Title')</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
    @livewireStyles
</head>

<body class="">

    <div class="flex h-screen justify-center items-center">

        <div class="shadow-lg rounded-lg p-2 w-1/4">
            <form action="{{ route('login-user') }}" method="POST">
                @csrf
                <h1 class="text-2xl font-bold text-center mb-5">Welcome</h1>
                <p class="text-slate-700 text-center mb-5">Enter your details to sign in to your action</p>
                <div class="grid grid-flow-row gap-5 p-2">
                    <div>
                        <label for="">Contact Number</label>
                        <input type="text" class="outline-none border border-slate-950 w-full px-2 py-2 rounded"
                            name="contact_number">
                    </div>
                    <div>
                        <label for="">Password</label>
                        <input type="password" class="outline-none border border-slate-950 w-full px-2 py-2 rounded"
                            name="password">
                    </div>

                    @if ($errors->has('email'))
                        <div class="text-red-900 text-sm mt-2 bg-red-200 px-2 py-2 rounded">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <div>
                        <button class="w-full py-2 bg-blue-900 hover:bg-blue-800 text-white rounded">Login</button>
                    </div>
                    <div class="text-center">
                        <a href="#" class="text-blue-900 hover:text-blue-800 text-center">Forgot Password?</a>
                    </div>
                </div>
            </form>

        </div>

    </div>
</body>
@livewireScripts
<script src="{{ asset('js/app.js') }}"></script>

</html>
