<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing System</title>


    @vite(['resources/css/theme.css', 'resources/js/theme.js'])
</head>

<div id="preloader">
    <div class="loader-container">
        <img src="{{ asset('images/logo.jpg') }}" class="loader-logo">
        <p class="loader-text">JCLC Billing System</p>
    </div>
</div>
<main class="main" id="top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container">
            <a href="/" class="navbar-brand d-flex align-items-center fw-bold fs-2" href="index.html">
                <img src="{{ asset('image/logo.png') }}" alt="Logo" style="height: 60px;">
                <div class="text-warning">JCLC</div>
                <div class="text-secondary">BILLING</div>
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto pt-2 pt-lg-0">
                    <li class="nav-item" data-anchor="data-anchor"><a class="nav-link fw-medium active"
                            aria-current="page" href="#home">Download App</a></li>

                </ul>
                <form class="ps-lg-5">
                    @if (Auth::user() == null)
                        <a href="/login" class="btn btn-lg btn-primary rounded-pill order-0" type="submit">Login</a>
                    @else
                        <a href="/dashboard" class="btn btn-lg btn-primary rounded-pill order-0"
                            type="submit">Dashboard</a>
                    @endif
                </form>
            </div>
        </div>
    </nav>
    <section class="py-0" id="home">
        <div class="bg-holder"
            style="background-image:url('{{ asset('images/hero-bg.png') }}');background-position:bottom;background-size:cover;">
        </div>

        <div class="container position-relative">
            <div class="row align-items-center py-8">
                <div class="col-md-5 col-lg-6 order-md-1 text-center text-md-end">
                    <img class="img-fluid" src="{{ asset('image/mobile_hero.png') }}" width="650" alt="" />
                </div>
                <div class="col-md-7 col-lg-6 text-center text-md-start">
                    <h1 class="mb-4 display-3 fw-bold lh-sm">JCLC <br class="d-block d-lg-none d-xl-block" />
                        Billing Management System</h1>
                    <p class="mt-3 mb-4 fs-1">Efficiently Manage WiFi Payments and Billing Records – Organized,
                        Accurate, and Hassle-Free! <br class="d-none d-lg-block" /></p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-6">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 order-md-0 text-center text-md-start">
                    <img class="img-fluid mb-4" src="{{ asset('image/wifi_management_vector.png') }}" width="550"
                        alt="" />
                </div>
                <div class="col-md-6 text-center text-md-start offset-md-1">
                    <h6 class="fw-bold fs-4 display-3 lh-sm">About the System</h6>
                    <p class="my-4 pe-xl-5">
                        The JCLC Billing Management System is designed to streamline payment tracking, manage
                        records, and ensure accurate billing for all subscribers. This system provides administrators
                        with a centralized platform to monitor transactions, generate reports, and maintain payment
                        history with ease.
                    </p>
                    <p class="my-4 pe-xl-5">
                        With automated record-keeping and a user-friendly interface, managing WiFi billing has never
                        been this efficient!
                    </p>
                    <a class="btn btn-lg btn-primary rounded-pill hover-top" href="#" role="button">Learn
                        more</a>
                </div>
            </div>
        </div>
    </section>

</main>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/is_js/0.9.0/is.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>

<link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400&amp;display=swap"
    rel="stylesheet">
</body>

</html>
