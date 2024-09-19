<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use App\Console\Commands\GenerateBillingStatement;
use Illuminate\Support\Facades\Schedule;

Schedule::command(GenerateBillingStatement::class)->everyTwoSeconds();
