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

    <div class="flex h-screen justify-center items-center">
        <div class="shadow-lg rounded-lg p-2 w-1/4">
            <form action="{{ route('reset-password') }}" method="POST">
                @csrf
                <h1 class="text-2xl font-bold text-center mb-5">Change Password</h1>
                <p class="text-slate-700 text-center mb-5">Enter the OTP and the new password</p>
                <div class="grid grid-flow-row gap-5 p-2">

                    <div>
                        <label for="otp">OTP</label>
                        <input type="text" id="otp" class="outline-none border border-slate-950 w-full px-2 py-2 rounded"
                            name="otp" required>
                    </div>

                    @if ($errors->has('otp'))
                        <div class="text-red-900 text-sm mt-2 bg-red-200 px-2 py-2 rounded">
                            {{ $errors->first('otp') }}
                        </div>
                    @endif

                    <div>
                        <label for="npassword">New Password</label>
                        <input type="password" id="npassword" class="outline-none border border-slate-950 w-full px-2 py-2 rounded"
                            name="npassword" required>
                    </div>

                    @if ($errors->has('npassword'))
                        <div class="text-red-900 text-sm mt-2 bg-red-200 px-2 py-2 rounded">
                            {{ $errors->first('npassword') }}
                        </div>
                    @endif

                    <div>
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" id="cpassword" class="outline-none border border-slate-950 w-full px-2 py-2 rounded"
                            name="cpassword" required>
                    </div>

                    @if ($errors->has('cpassword'))
                        <div class="text-red-900 text-sm mt-2 bg-red-200 px-2 py-2 rounded">
                            {{ $errors->first('cpassword') }}
                        </div>
                    @endif

                    <div>
                        <button type="submit" class="w-full py-2 bg-blue-900 hover:bg-blue-800 text-white rounded">Confirm</button>
                    </div>

                </div>
            </form>

            @if (session('error'))
                <div class="text-red-900 text-sm mt-2 bg-red-200 px-2 py-2 rounded text-center">
                    {{ session('error') }}
                </div>
            @endif



            @if (session('success'))
                <div class="text-green-900 text-sm mt-2 bg-green-200 px-2 py-2 rounded text-center">
                    {{ session('success') }}<a href="{{route('login')}}">Login Now</a>
                </div>
            @endif

        </div>
    </div>

    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
