@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <section class="section dashboard">
        <div class="row">


            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Revenue <span>| This Month</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>Php. {{ $revenue }}</h6>
                                <span class="text-success small pt-1 fw-bold">8%</span> <span
                                    class="text-muted small pt-2 ps-1">increase</span>

                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Outstanding Bill <span></span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $outstandingBill }}</h6>
                                <span class="text-success small pt-1 fw-bold">8%</span> <span
                                    class="text-muted small pt-2 ps-1">increase</span>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Total Remittance <span></span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>₱{{ number_format($remittance, 2) }}</h6>
                                <span class="text-success small pt-1 fw-bold">8%</span> <span
                                    class="text-muted small pt-2 ps-1">increase</span>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12">
                <div class="card recent-sales overflow-auto">



                    <div class="card-body">
                        <h5 class="card-title">New Subscriber Subscription <span></span></h5>

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Area</th>
                                    <th scope="col">SUBSCRIPTION PLAN</th>
                                    <th scope="col">DATE</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscribers as $subscriber)
                                    <tr>

                                        <td> {{ $subscriber->sr_fname . ' ' . $subscriber->sr_lname }}</td>
                                        <td> {{ $subscriber->sr_street . ' ' . $subscriber->sr_city . ' ' . $subscriber->sr_province }}
                                        </td>
                                        <td> {{ $subscriber->subscriptions->first()->snplan_bandwidth ?? 'N/A' }}
                                        </td>
                                        <td>{{ $subscriber->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>

        </div>

    </section>


@endsection
