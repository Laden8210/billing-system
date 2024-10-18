<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing System</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100"> <!-- Added a background color -->

    <nav class="flex justify-between items-center px-5 py-3 bg-slate-900">
        <div>
            <h1 class="text-white font-bold text-lg">JCLC Billing</h1>
        </div>

        <div>
            <a href="{{ route('login') }}" class="border border-2 border-white px-4 py-2 rounded text-white hover:bg-white hover:text-slate-900 transition duration-300">Login</a>
        </div>
    </nav>

    <div class="flex justify-center items-center h-screen">
        <div class="border rounded shadow-lg px-8 py-6 bg-white" style="width: 500px;">
            <h1 class="font-bold text-2xl text-center mb-4">Welcome to JCLC Billing System</h1>
            <p class="text-gray-500 text-center mb-6">
                Manage your internet connection billing and payments with ease. Stay up-to-date with your account balance, download invoices, and access subscription details effortlessly.
            </p>

            <div class="flex justify-center">
                <a href="{{ route('download.app') }}" class="px-4 py-2 bg-blue-500 text-white text-center rounded hover:bg-blue-600 transition duration-300">Download Application</a>
            </div>
        </div>
    </div>


</body>
</html>
