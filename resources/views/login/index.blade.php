<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@600&family=Lobster&family=Pacifico&family=Montserrat:wght@700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="src/images/logo-with-bg.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <script src="https://kit.fontawesome.com/8d62d56333.js" crossorigin="anonymous"></script>
    @vite(['resources/css/style.css', 'resources/js/theme.js'])

    <link rel="icon" type="image/png" href="{{ asset('image/logo.png') }}">
    <title>@yield('title', 'Your App Name')</title>
</head>

<body>

    <div id="preloader">
        <div class="loader-container">
            <img src="{{ asset('images/logo.jpg') }}" class="loader-logo">
            <p class="loader-text">JCLC Billing System</p>
        </div>
    </div>

    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="/" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('images/logo.jpg') }}" alt="logo" class="img-fluid rounded"
                                        width="100px">

                                </a>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                    </div>
                                </div>
                                <form id="login-form" class="text-start row g-3 p-3" method="POST"
                                    action="{{ route('login') }}">
                                    @csrf
                                    <div id="login-alert" class="alert d-none"></div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <a>{{ $error }}</a>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="mb-2">
                                        <label for="username" class="form-label text-black">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Enter your  username" required>
                                    </div>

                                    <div class="mb-2 position-relative">
                                        <label for="password" class="form-label text-black">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Enter your password" required>
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <script>
                                        document.getElementById('togglePassword').addEventListener('click', function() {
                                            let passwordField = document.getElementById('password');
                                            let icon = this.querySelector('i');

                                            if (passwordField.type === "password") {
                                                passwordField.type = "text";
                                                icon.classList.remove("fa-eye");
                                                icon.classList.add("fa-eye-slash");
                                            } else {
                                                passwordField.type = "password";
                                                icon.classList.remove("fa-eye-slash");
                                                icon.classList.add("fa-eye");
                                            }
                                        });
                                    </script>

                                    <div class="text-end mb-2">
                                        <a class="text-decoration-none" href="/forgotPassword">Forgot password?</a>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" id="login-btn" class="btn btn-primary">Login</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

</body>

</html>
