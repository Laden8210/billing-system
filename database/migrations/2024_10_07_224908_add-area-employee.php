<?php

use App\Models\Employee;
use App\Models\SubscriptionArea;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('remittances', function (Blueprint $table) {
            $table->foreignIdFor(Employee::class, 'employee_id')->nullable();
            $table->foreignIdFor(SubscriptionArea::class, 'subscriptionarea_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
