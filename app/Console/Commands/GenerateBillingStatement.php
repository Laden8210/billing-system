<?php

namespace App\Console\Commands;

use App\Models\BillingStatement;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Exception;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class GenerateBillingStatement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-billing-statement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Billing statement generation command";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting billing statement generation...');

        try {
            $subscriptions = Subscription::where('sn_status', 'active')->get();

            if ($subscriptions->isEmpty()) {
                $this->warn('No active subscriptions found.');
                return;
            }

            foreach ($subscriptions as $sub) {
                $existingBilling = BillingStatement::where('subscription_id', $sub->subscription_id)
                    ->whereMonth('bs_billingdate', Carbon::now()->month)
                    ->whereYear('bs_billingdate', Carbon::now()->year)
                    ->first();

                if ($existingBilling) {
                    $this->info("Billing statement for Subscription ID: {$sub->subscription_id} already exists for this month.");
                    continue;
                }

                // Create new billing statement if not exists
                $billing = new BillingStatement();
                $billing->subscription_id = $sub->subscription_id;
                $billing->bs_amount = $sub->plan->snplan_fee;
                $billing->bs_status = 'unpaid';
                $billing->bs_duedate = Carbon::now()->addMonth()->addDays(5)->format('Y-m-d');
                $billing->bs_billingdate = Carbon::now()->addMonth()->format('Y-m-d');
                $billing->save();

                $this->info("Billing statement generated for Subscription ID: {$sub->subscription_id}");
            }

        } catch (Exception $e) {
            // Log the error
            Log::error('Error generating billing statement: ' . $e->getMessage());

            $this->error('Failed to generate billing statements. Check the logs for more details.');
        }

        $this->info('Billing statement generation process completed.');
    }
}
